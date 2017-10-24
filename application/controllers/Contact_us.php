<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {


	public function __construct() {

		parent::__construct();

	}

    public function index(){

        $this->load->model('Contact_us_model');

		if( ! empty($_POST) ) {


			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('email_id', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');

			if( $this->form_validation->run() == TRUE) {

				$aEnquiry = array();
				$iAccountNo = 0;
				$aUserData = $aProfileData = array();
				// verify uniqueness of email id
				if( ! $this->account_model->isEmailExists( $this->input->post('email') ) ) {

					$aUserData = $aProfileData = array();

					$error	= FALSE;
					// Generate account number
					$aConfig = array(
									'table' => 'users',
									'field' => 'account_no',
								);
					$iAccountNo = $this->common_model->generateUniqueNumber($aConfig);

					//salt the password
					$sPassword 	= NULL;
					$sSalt 		= $this->authentication->getSalt();
					$sHash 		= $this->account_model->getPasswordHash($sSalt, $sPassword);


					$aUserData['account_no']	= $iAccountNo;
					$aUserData['username'] 		= NULL;

					$aUserData['salt']			= $sSalt;
					$aUserData['hash']			= $sHash;

					$aUserData['type']			= $this->mcontents['aUserTypesFlipped']['guest'];

					$aUserData['online_status']	= $this->mcontents['aOnlineStatusesFlipped']['offline'];
					$aUserData['salutation']	= NULL;

					$aUserData['first_name']	= safeText('first_name');
					$aUserData['middle_name']	= safeText('middle_name');
					$aUserData['last_name']		= safeText('last_name');

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
				}

				$aEnquiry['account_number']		= $iAccountNo;
				$aEnquiry['firstname']			= $this->input->post('first_name');
				//$aEnquiry['middlename']			= $this->input->post('middle_name');
				$aEnquiry['lastname']			= $this->input->post('last_name');
				$aEnquiry['email']				= $this->input->post('email_id');
				$aEnquiry['contact_number'] 	= $this->input->post('contact_number');
				$aEnquiry['message']  			= $this->input->post('message');
				$aEnquiry['purpose']  			= $this->input->post('purpose');
				$aEnquiry['created_on']  		= date('Y-m-d H:i:s');


				$this->Contact_us_model->put_enquiry( $aEnquiry );

				$this->session->set_flashdata('message','Success!!!');

            }
        }

        $this->mcontents['aEnquiry_purposes'] = $this->data_model->getDataItem('enquiry_purposes', 'id-title');
        loadTemplate('Contact_us/Contact_us');
    }

	public function list_enquiries() {

		$this->load->model('Contact_us_model');
		$this->mcontents['aEnquiry_purposes'] = $this->data_model->getDataItem('enquiry_purposes', 'id-title');
		$this->mcontents['aEnquiries'] = $this->Contact_us_model->get_enquiries();
		$this->mcontents['page_heading'] = 'Enquiries';
		$this->mcontents['load_js'][] = 'list_enquiries/reply.js';
		loadAdminTemplate('Contact_us/enquiries/list_enquiries');

	}

	public function add_enquiry_reply() {

		$this->load->model('Contact_us_model');
	  	$enquiry_id = $this->input->post('enquiry_id');
		$message 	= $this->input->post('reply_message');
		$aEnquiry_reply = array();

			$aEnquiry_reply['enquiry_id']  = $enquiry_id;
			$aEnquiry_reply['author_id']   = 1;
			$aEnquiry_reply['message']     = $message;
			$aEnquiry_reply['created_on']  = date('Y-m-d H:i:s');


			$this->Contact_us_model->put_enquiry_reply( $aEnquiry_reply );
			redirect(base_url().'contact_us/list_enquiries');
	}

	public function view_conversation() {

		$enquiry_id = $this->input->get('id');
		$this->mcontents['aEnquiry'] 	   = $this->Contact_us_model->get_enquiry($enquiry_id);
		$this->mcontents['aEnquiry_reply'] = $this->Contact_us_model->get_enquiry_reply($enquiry_id);
		loadTemplate('Contact_us/conversation');
		//this->load->view('enquiry/conversation', $aConversation_Data);
	}

	public function add_conversation() {

		$message 	= $this->input->post('message');
		$enquiry_id = $this->input->get('id');
		$aEnquiry_reply = array();

			$aEnquiry_reply['enquiry_id']  = $enquiry_id;
			$aEnquiry_reply['author_id']   = 1;
			$aEnquiry_reply['message']     = $message;
			$aEnquiry_reply['created_on']  = date('Y-m-d H:i:s');

		$this->Contact_us_model->put_enquiry_reply( $aEnquiry_reply );
		$this->mcontents['aEnquiry'] 	   = $this->Contact_us_model->get_enquiry($enquiry_id);
		$this->mcontents['aEnquiry_reply'] = $this->Contact_us_model->get_enquiry_reply($enquiry_id);
		loadTemplate('Contact_us/conversation');
	}
}
