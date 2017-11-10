<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {


	public function __construct() {

		parent::__construct();

	}

    public function index(){


		$this->load->model('contact_us_model');

		$this->load->library('emailer');
		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Contact Us';

		if( ! empty($_POST) ) {


			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('email_id', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');

			// get the general purpose template
			$oPurposeDetails = $this->contact_us_model->getPurposeBy('name', 'general');

			if( $this->form_validation->run() == TRUE) {

				$aEnquiry = array();
				$iAccountNo = 0;
				$aUserData = $aProfileData = array();
				// verify uniqueness of email id
				if( ! $this->account_model->isEmailExists( $this->input->post('email_id') ) ) {

					$aUserData = $aProfileData = array();

					$error	= FALSE;
					// Generate account number
					$aConfig = array(
									'table' => 'users',
									'field' => 'account_no',
								);
					$iAccountNo = $this->common_model->generateUniqueNumber($aConfig);


					$this->load->helper('string');
					//salt the password

					$sPassword 	= random_string('alnum',6);
					log_message('error', 'username-'.$this->input->post('email_id').', password-'.$sPassword);
					$sSalt 		= $this->authentication->getSalt();
					$sHash 		= $this->account_model->getPasswordHash($sSalt, $sPassword);


					$aUserData['account_no']	= $iAccountNo;
					$aUserData['username'] 		= $this->input->post('email_id');

					$aUserData['salt']			= $sSalt;
					$aUserData['hash']			= $sHash;

					$aUserData['type']			= $this->mcontents['aUserTypesFlipped']['guest'];

					$aUserData['online_status']	= $this->mcontents['aOnlineStatusesFlipped']['offline'];
					$aUserData['salutation']	= NULL;

					$aUserData['first_name']	= safeText('first_name');
					$aUserData['middle_name']	= "";
					$aUserData['last_name']		= "";

					$aUserData['email_id']		= safeText('email_id');
					$aUserData['status']		= $this->mcontents['aUserStatusesFlipped']['active'];

					$aUserData['created_on']	= date('Y-m-d H:i:s');

					// profile data
					$aProfileData['user_account_no'] 	= $iAccountNo;
					$aProfileData['gender'] 			= $this->mcontents['aGendersFlipped']['unspecified'];


					if(!$error) {

						//start transaction
						$this->db->trans_start();

						$this->db->set ($aUserData);
						$this->db->insert('users');

						 //fetch the inserted user
						$oUser = $this->user_model->getUserBy('account_no', $iAccountNo);
	//p($oUser);exit;
					  if( $oUser ) {

							// create profile for user.
							$this->account_model->createUserProfile($oUser, $aProfileData);

							//End transaction
							$this->db->trans_complete();
						}
					}

					$aEnquiry['account_number']		= $iAccountNo;
					$aEnquiry['firstname']			= $this->input->post('first_name');
					//$aEnquiry['middlename']			= $this->input->post('middle_name');
					$aEnquiry['lastname']			= $this->input->post('last_name');
					$aEnquiry['email']				= $this->input->post('email_id');
					$aEnquiry['contact_number'] 	= $this->input->post('contact_number');
					$aEnquiry['message']  			= $this->input->post('message');
					//$aEnquiry['purpose']  			= $this->input->post('purpose');
					$aEnquiry['created_on']  		= date('Y-m-d H:i:s');


					$new_enquiry = $this->Contact_us_model->put_enquiry( $aEnquiry );



					//sending mail to new user to follw the enquiry.
					// populate the key value pairs to replace into email body and subject.
				   $aEmailData = array(
					 'receiver_name' => safeText('first_name'),
					 'email'	   => 'sense123@gmail.com',
					 'name'        => 'SENSE',
					 'subject'	   => 'Enquiry created',
					 'message'     => 'Your Enquiry is Created, Username:'.safeText('email_id').'and Password'.$sPassword.'click the link to view http://sense.org.in/contact_us/view_conversation?id='.$new_enquiry->id
				   );

				   $oEmailTemplate = $this->contact_us_model->getEmailTemplateBy('id', $oPurposeDetails->email_template_id);

				   //USING PHPMAILER TO SEND EMAIL
				   $aSettings = array(

					   'to'       => array( safeText('email_id') => safeText('first_name') ),
     		          'from_email'   => $aEmailData['email'],
     		          'from_name'    => $aEmailData['name'],
     		          'cc'       => array(),
     		          'reply_to'     => array($aEmailData['email'] => $aEmailData['name']), // email_id => name pairs
     		          'bcc'       => array(),
     		          'email_contents' => $aEmailData, // placeholder keywords to be replaced with this data
     		          'template_name' => $oEmailTemplate->name, //name of template to be used

				   );

				   list($bMailSentStatus, $sErrorMessage) = $this->emailer->send($aSettings);

				}

				else {

					$this->db->select('*');
				    $this->db->where('email', $this->input->post('email_id'));
				    $enquiry = $this->db->get('enquiries');
					$enquiry = $enquiry->result();

					$aEnquiry_reply = array();
					foreach($enquiry as $key => $data):

						$aEnquiry_reply['enquiry_id']  		= $data->id;
						$aEnquiry_reply['author_account']   = $data->account_number;
						$aEnquiry_reply['message']     		= $this->input->post('message');
						$aEnquiry_reply['created_on']  		= date('Y-m-d H:i:s');

					endforeach;

					$this->Contact_us_model->put_enquiry_reply( $aEnquiry_reply );

				}

				//send the email



		        // populate the key value pairs to replace into email body and subject.
		        $aEmailData = array(
		          'receiver_name' => $oPurposeDetails->reciever_name,
		          'name'        => safeText('first_name'),
		          'email'     	=> safeText('email_id'),
		          'telephone'   => safeText('contact_number'),
		          'message'     => safeHtml('message'),
		        );

		        $oEmailTemplate = $this->contact_us_model->getEmailTemplateBy('id', $oPurposeDetails->email_template_id);

		        //USING PHPMAILER TO SEND EMAIL
		        $aSettings = array(

		          'to'       => array($oPurposeDetails->target_email => $oPurposeDetails->reciever_name),
		          'from_email'   => $aEmailData['email'],
		          'from_name'    => $aEmailData['name'],
		          'cc'       => array(),
		          'reply_to'     => array($aEmailData['email'] => $aEmailData['name']), // email_id => name pairs
		          'bcc'       => array(),
		          'email_contents' => $aEmailData, // placeholder keywords to be replaced with this data
		          'template_name' => $oEmailTemplate->name, //name of template to be used



		        );

				list($bMailSentStatus, $sErrorMessage) = $this->emailer->send($aSettings);

				if( ! $bMailSentStatus ) {

		          sf('error_message', 'There was some problem. Please try back later.');
		          redirect('contact_us');

		        } else {

		          sf('success_message', $oPurposeDetails->success_message);
		          redirect('contact_us');
		        }


            }
        }

        $this->mcontents['aEnquiry_purposes'] = $this->data_model->getDataItem('enquiry_purposes', 'id-title');

		//$this->mcontents['load_css'][] = 'moderna/fancybox/jquery.fancybox.css';
		//$this->mcontents['load_css'][] = 'moderna/jcarousel.css';
		//$this->mcontents['load_css'][] = 'moderna/flexslider.css';

		$this->mcontents['load_js'][] = 'moderna/jquery.fancybox.pack.js';
		$this->mcontents['load_js'][] = 'moderna/jquery.fancybox-media.js';
		//$this->mcontents['load_js'][] = 'moderna/google-code-prettify/prettify.js';
		$this->mcontents['load_js'][] = 'moderna/jquery.flexslider.js';
		$this->mcontents['load_js'][] = 'moderna/animate.js';
		$this->mcontents['load_js'][] = 'moderna/custom.js';
		//$this->mcontents['load_js'][] = 'moderna/portfolio/jquery.quicksand.js';
		//$this->mcontents['load_js'][] = 'moderna/portfolio/setting.js';


		requireFrontEndValidation();
        $this->mcontents['load_js'][] = 'validation/contact_us.js';

        loadTemplate('contact_us/contact_us');
    }

	public function list_enquiries() {


		$this->authentication->is_admin_logged_in(true,'user/login');

			$this->load->model('Contact_us_model');
			$this->mcontents['aEnquiry_purposes'] = $this->data_model->getDataItem('enquiry_purposes', 'id-title');
			$this->mcontents['aEnquiries'] = $this->Contact_us_model->get_enquiries();
			$this->mcontents['page_heading'] = 'Enquiries';
			loadAdminTemplate('contact_us/enquiries/list_enquiries');

	}

	public function add_enquiry_reply() {

		$this->load->model('Contact_us_model');
	  	$enquiry_id = $this->input->post('enquiry_id');
		$message 	= $this->input->post('reply_message');
		$aEnquiry_reply = array();

			$aEnquiry_reply['enquiry_id']		= $enquiry_id;
			$aEnquiry_reply['author_account'] 	= $this->session->ACCOUNT_NO;
			$aEnquiry_reply['message']     		= $message;
			$aEnquiry_reply['created_on']  		= date('Y-m-d H:i:s');


			$this->Contact_us_model->put_enquiry_reply( $aEnquiry_reply );
			redirect(base_url().'contact_us/list_enquiries');
	}

	//finding the conversation page of user who logged in
	public function get_conversation() {

		$account_no = safeText('account_no', false, 'get');
		//get enquiry using account number.
		if( !$enquiry = $this->Contact_us_model->getenquiryby('account_number',$account_no ) )
		{
			if( $this->authentication->is_admin_logged_in(false) ) {

				redirect('contact_us/list_enquiries');

			}
			else {

				redirect('home');
			}

		}

		$_GET['id'] = $enquiry->id;
		$this->view_conversation();
	}



	public function view_conversation() {


		// only logged in user has access
		$this->authentication->is_user_logged_in(true, 'user/login');

		// get enquiry id
		$enquiry_id = safeText('id', false, 'get');






		// only the enquirer or admin can see the enquiry.
		$aWhere = array('account_number' => s('ACCOUNT_NO'));

		if( ! $this->mcontents['oEnquiry'] 	   = $this->Contact_us_model->get_enquiry_details($enquiry_id, $aWhere) ) {

			if( $this->mcontents['oEnquiry'] = $this->Contact_us_model->get_enquiry_details($enquiry_id) ) {

				if( ! $this->authentication->is_admin_logged_in(false) ) {
					sf('error_message', 'Enquiry not found');
					redirect('user/home');
				}
			}
			else {
				sf('error_message', 'Enquiry not found');
				redirect('user/home');
			}
		}




		if( ! empty($_POST) ) {

			$message 	= $this->input->post('message');
			$aEnquiry_reply['enquiry_id']  		= $enquiry_id;
			$aEnquiry_reply['author_account']   = $this->session->ACCOUNT_NO;
			$aEnquiry_reply['message']     		= $message;
			$aEnquiry_reply['created_on']  		= date('Y-m-d H:i:s');

			$this->Contact_us_model->put_enquiry_reply( $aEnquiry_reply );
		}


		$this->mcontents['aEnquiry_reply'] = $this->Contact_us_model->get_enquiry_reply_details($enquiry_id);

// p($this->mcontents['aEnquiry_reply']);
// exit;

		requireFrontEndValidation();
		$this->mcontents['load_js'][] = 'validation/conversation.js';

		loadTemplate('contact_us/conversation');

	}

}
