<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Emailer {

	public function __construct() {

        $this->CI = & get_instance();
    }

    public function send ($aSettings= array()) {


		// Merge the settings
        $aDefaults = array(
            'to' 						=> array(), // email_id => name pairs
            'from_email' 				=> '',
            'from_name'					=> '',
            'cc' 						=> array(),
            'reply_to' 					=> array(), // email_id => name pairs
            'bcc' 						=> array(),
            'email_contents' 			=> array(), // placeholder keywords to be replaced with this data
            'template_name' 			=> '', //name of template to be used
            'attachment' 				=> array(),
            'wrapping_template_name' 	=> 'default_mail_template',
            'template_from_config' 		=> false, //is the template to be taken from the config file
            'preview' 					=> false, // should the function return a preview of the email? or send it?
            'subject' 					=> '',	// if present, this will be used. ignoring all others
            'mail_body' 				=> '',	// if present, this will be used. ignoring all others

            'mailer' 					=> $this->CI->config->item('mailer'), //SMTP or mail() etc
        );

        $aSettings = array_merge($aDefaults, $aSettings);

		// Initialize Stuff
		$mail_subject 		= '';
		$email_body 		= '';


		// this function will return following two data items
		$bMailSentStatus 	= false;
		$sErrorMessage 		= '';

		// used in the code to see if we can proceed further from a given point.
		$bProceed 			= true;


		/**
		 *
		 * Check if the emails are given in expected format or not.
		 */
		if( ! is_array($aSettings['to']) || ! is_array($aSettings['reply_to']) ) {
			$bProceed = false;
			$sErrorMessage = 'Wrong input format';
		}


		/**
		 *
		 * Get the mail body and subject
		 */
		if( $bProceed ) {

			if( $aSettings['template_from_config'] ) {


				$bProceed = false;
				$sErrorMessage = 'Cannot proceed further';

				 // To Test later
				// 	$result_array       = c('email_template_' . $aSettings['template_name']);

			} else {

				if( ! $oEmailTemplate = $this->getEmailTemplate( $aSettings['template_name'] ) ) {

					if( $aSettings['subject'] == '' || $aSettings['mail_body'] == '' ) {
						$bProceed = false;
						$sErrorMessage = 'Email Template "'. $aSettings['template_name'] .'" could not be fetched';
					}


				}
			}

			// if subject / email body was directly specified, then we will use them always
			$mail_subject = $aSettings['subject'] ? $aSettings['subject'] : $oEmailTemplate->subject;
			$email_body = $aSettings['mail_body'] ? $aSettings['mail_body'] : $oEmailTemplate->message;
		}




		if( $bProceed ) {

			/**
			 *
			 * routines to do with the mail body and subject (old part of code)
			 */

			// providing a wrapping template(common template for all emails sent from this website) .
			// and replacing content into email body
			$aSettings['mail_body'] = $this->generateEmailBody($aSettings['email_contents'], $email_body, $aSettings['wrapping_template_name'], $aSettings['template_from_config']);

			// replacing into email subject
			// the following step can be avoided if we can do the mergin at an earlier stage
			// ( Now the merging is done inside the  generateEmailBody() function, and the changes are not available here,
			// when we are trying to replace into the subject line)

			// replacing content into email body
			$aSettings['email_contents'] = array_merge( $this->CI->config->item('email_template_default_variables'), $aSettings['email_contents'] );
			$aSettings['subject'] = $mail_subject = replaceInto($aSettings['email_contents'], $mail_subject);
		}



		if( $bProceed ) {

			// send the email
			$bMailSentStatus = $this->send_using_PhpMailer($aSettings);

			if( $bMailSentStatus == false ) {
				$sErrorMessage = 'Email could not be sent.';
			}
		}

		return array($bMailSentStatus, $sErrorMessage);
    }


	/**
	 * Send email using PHPMailer library
	 * @param  [type] $aSettings [description]
	 * @return [type]            [description]
	 */
    function send_using_PhpMailer($aSettings) {

		$this->CI->load->library('phpmailer2');

		return $this->CI->phpmailer2->send($aSettings);
    }



	/**
	 * Fetch email template from Database.
	 * @param  [type] $sEmailTempateName [description]
	 * @return [type]                    [description]
	 */
	function getEmailTemplate ($sEmailTempateName) {


        $this->CI->db->select('subject AS subject, body AS message');
        $this->CI->db->from('email_templates');
        $this->CI->db->where('name', $sEmailTempateName);
        $select_query   = 	$this->CI->db->get();

		return $select_query->row();
	}


    /**
     * generates the email body with the specified template
     *
     * THE CODE NEEDS TO BE REWRITTEN FOR MORE CLARITY AND POSSIBLE IMPROVED PERFORMANCE
     *
     * @param array $aEmailVariables
     * @param string $sEmailBody
     * @param string $sTemplateName
     * @return string
     */
    function generateEmailBody($aEmailVariables, $sEmailBody, $sTemplateName, $bFromConfig) {


        $sEmailTemplate = '';
        // if($bFromConfig){
        //     $aEmailTemplate = c( 'email_template_' . $sTemplateName );
        //     $sEmailTemplate = $aEmailTemplate['body'];
        // } else {
        //     $sEmailTemplate = $this->getEmailTemplate( $sTemplateName );
        // }

        $aEmailTemplateVariables = $aDefaultEmailTemplateVariables = $this->CI->config->item('email_template_default_variables');



        // get the template variables which are specific to this template
        if( c('email_template_variables__'.$sTemplateName) ){
            $aEmailTemplateVariables = array_merge($aDefaultEmailTemplateVariables , c('email_template_variables__'.$sTemplateName));
        }



        //if any of the $aEmailTemplateVariables are being used inside the custom content of the email,
        // then they do no get a change to get replaced into the custom content.
        // so we are merging the $aEmailVariables and $aEmailTemplateVariables.
        $aEmailVariables = array_merge($aEmailVariables, $aEmailTemplateVariables);



        //UNDERSTANDING : We want to retain any place holders that were not replaced, to
        // stay in tact, so that we can replace them with the common variables used for all templates. (in the next step)
        // hence the 3rd parameter is false
        $aEmailTemplateVariables['template_email_body'] = replaceInto($aEmailVariables, $sEmailBody, false);

		// var_dump($sEmailTemplate);
		// exit;

        //UNDERSTANDING : try to replace any left over place holders with the variables which are common for all templates
        $sReturn = '';
        if ( $sEmailTemplate ) {
            $sReturn = replaceInto($aEmailTemplateVariables, $sEmailBody);
        } else {
            $sReturn = $aEmailTemplateVariables['template_email_body'];
        }

        //UNDERSTANDING : ok, now we are left with those place holders which are not replaced
        // in step 1 or two.(because they were empty). replace them now
        $sReturn = replaceInto($aEmailVariables, $sReturn);

        return $sReturn;
        //return $sEmailTemplate ? replaceInto($aEmailTemplateVariables, $sEmailTemplate) : $aEmailTemplateVariables['template_email_body'];

    }

}
