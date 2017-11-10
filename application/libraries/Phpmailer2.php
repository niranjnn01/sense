<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'third_party/phpmailer/PHPMailer.php');
require_once(APPPATH . 'third_party/phpmailer/Exception.php');
require_once(APPPATH . 'third_party/phpmailer/SMTP.php');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class Phpmailer2 {

	public function __construct() {

        $this->CI = & get_instance();
    }


	/**
	 * Specify details as mentioned in the settings array and send email
	 * @param  array  $aSettings [description]
	 * @return [type]            [description]
	 */
	public function send ($aSettings= array()) {


		$bMailSent = false;

		$bWriteToLog = true;

		$mail = new PHPMailer(true);

		try {

			//Server settings
			$mail->SMTPDebug = 0;                                           // Enable verbose debug output
			$mail->isSMTP();                                                // Set mailer to use SMTP
			$mail->Host = $this->CI->config->item('smtp_host');             // Specify main and backup SMTP servers
			$mail->SMTPAuth = $this->CI->config->item('smtp_auth');         // Enable SMTP authentication
			$mail->Username = $this->CI->config->item('smtp_username');     // SMTP username
			$mail->Password = $this->CI->config->item('smtp_password');     // SMTP password
			$mail->SMTPSecure = $this->CI->config->item('smtp_secure');     // Enable TLS encryption, `ssl` also accepted
			$mail->Port = $this->CI->config->item('smtp_port');             // TCP port to connect to


			// Character Set of email
			$mail->CharSet = 'utf-8';

			// Who is sending email
			$mail->setFrom($aSettings['from_email'], $aSettings['from_name']);

			// Add recipient(s)
			foreach($aSettings['to'] AS $sEmail => $sName){
				$mail->addAddress($sEmail, $sName);
			}

			// Reply To
			foreach($aSettings['reply_to'] AS $sEmail => $sName){
				$mail->addReplyTo($sEmail, $sName);
			}

			// Add attachements if present
			if( ! is_array( $aSettings['attachment'] ) ) {
				$aSettings['attachment'] = (array) $aSettings['attachment'];
			}
			if ( $aSettings['attachment'] ) {

				foreach( $aSettings['attachment'] AS $sAttachment ) {

					if ( !empty( $sAttachment ) ) {

						$mail->AddAttachment($sAttachment);
					}
				}
			}


			// Set email format to HTML
			$mail->isHTML(true);

			// Subject
			$mail->Subject = $aSettings['subject'];

			// Body
			$mail->Body    = $aSettings['mail_body'];

			// Alternate body. in case HTML view is not possible.
			$mail->AltBody = '...';

			// send the email
			if( ! $mail->send() ) {

				log_message('error', 'PHPMAILER ERROR ' . $mail->ErrorInfo);

			} else {

				$bMailSent = true;
			}

		} catch (Exception $e) {

			//write to log
			if( $bWriteToLog ) {

				log_message('error', $mail->ErrorInfo);
			}
		}

		return $bMailSent;
	}

}
