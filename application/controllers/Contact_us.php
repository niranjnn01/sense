<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {


	public function __construct() {

		parent::__construct();

	}

    public function index(){

        $this->load->model('Contact_us_model');
		if( ! empty($_POST) ) {


			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');

			if( $this->form_validation->run() == TRUE) {

				$aEnquiry = array();

				$aEnquiry['firstname']			= $this->input->post('fname');
				$aEnquiry['lastname']			= $this->input->post('lname');
				$aEnquiry['email']				= $this->input->post('email');
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
}
