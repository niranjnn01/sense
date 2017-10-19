<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {


	public function __construct() {

		parent::__construct();

	}

	public function index()
	{

		$this->load->model('Categories_model');


		if( !empty($_POST) ) {

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');

			if( $this->form_validation->run() == TRUE ) {

				$aCategory = array();

				$aCategory['name']       		= $this->input->post('name');
				$aCategory['title']       		= $this->input->post('title');
				$aCategory['description'] 		= $this->input->post('description');
				$aCategory['group_id']  	    = $this->input->post('category_group');
				$aCategory['created_on'] 		= date('Y-m-d H:i:s');

				$category_status = $this->data_model->getDataItem('category_status', 'id-title');
				$category_status = array_flip($category_status);

				$aCategory['status']			= $category_status['Active'];

				$this->Categories_model->put_category( $aCategory );
				$this->session->set_flashdata('message','Success!!!');
			}
		}


		$aResult_Category_groups = $this->Categories_model->get_category_groups();
		$this->mcontents['aResult_Category_groups'] = $aResult_Category_groups;
		$this->mcontents['aCategory_group'] = $this->data_model->getDataItem('category_groups', 'id-title');
 		p($this->mcontents['aCategory_group']);
// exit;
		//print_r($aCategory_group);
		loadAdminTemplate('category/create_category');
		//$this->load->view('category/create_category', $aResult_Category_groups);
	}

	public function get_categories() {

		$aCategories = $this->Categories_model->get_categories();

	}

	public function get_categories_by_group() {

		$group_id = 1;
		$aCategories = $this->Categories_model->get_categories_by_group($group_id);

	}

	public function edit_category() {


		$id = $this->input->get('id');
		$this->load->model('Categories_model');

		if( !empty($_POST) ) {

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');

			if( $this->form_validation->run() == TRUE) {

				$aCategory['id']				= $id;
				$aCategory['title'] 	    	= $this->input->post('title');
				$aCategory['description']   	= $this->input->post('description');
				$aCategory['category_status']	= $this->input->post('category_status');

				$this->Categories_model->update_category($aCategory);
				$this->session->set_flashdata('message','Success!!!');

			}

		}

		$aCategory_groups = $this->Categories_model->get_category_groups();
		$aCategory = $this->Categories_model->get_category_by_id($id);
		$aCategory_status = $this->Categories_model->get_category_status();

		$this->mcontents['aCategory_groups'] = $aCategory_groups;
		$this->mcontents['aCategory'] = $aCategory;
		$this->mcontents['aCategory_status'] = $aCategory_status;
		loadAdminTemplate('category/edit_category');
		//$this->load->view('category/edit_category', $aCategory_Data);

	}

	public function category_group() {

		$this->load->model('Categories_model');

		if( !empty($_POST) ) {

			$this->form_validation->set_rules('group_name', 'Group Name', 'required');
			$this->form_validation->set_rules('group_title', 'Group Title', 'required');

			if( $this->form_validation->run() == TRUE ) {

				$aCategory = array();

				$aCategory_group['name'] 		= $this->input->post('group_name');
				$aCategory_group['title'] 		= $this->input->post('group_title');

				$category_group_status = $this->data_model->getDataItem('category_group_status', 'id-title');
				$category_group_status = array_flip($category_group_status);

				$aCategory_group['status'] 	    = $category_group_status['Active'];
				$aCategory_group['created_on'] 	= date('Y-m-d H:i:s');

				$this->Categories_model->put_category_group( $aCategory_group );
				$this->session->set_flashdata('message','successfully added new group');
			}
		}

		$aCategory_groups = $this->Categories_model->get_category_groups();
		$aCategory_group_status = $this->Categories_model->get_category_group_status();
		$aCategories = $this->Categories_model->get_categories();
		$this->mcontents['aCategory_group'] = $aCategory_groups;
		$this->mcontents['aCategory_group_status'] = $aCategory_group_status;
		$this->mcontents['aCategories'] = $aCategories;

		loadAdminTemplate('category/add_category_group');
		//$this->load->view('category/add_category_group', $aCategory_group_Data);
	}

	public function edit_category_group() {

		$this->load->model('Categories_model');
		$id = $this->input->get('id');

		if( !empty($_POST) ) {

			$this->form_validation->set_rules('group_title', 'Title', 'required');

			$aCategory_group['id'] 	   = $this->input->get('id');
			$aCategory_group['title']  = $this->input->post('group_title');
			$aCategory_group['status'] = $this->input->post('category_group_status');

			if( $this->form_validation->run() == TRUE) {

				$this->Categories_model->update_category_groups($aCategory_group);
				$this->session->set_flashdata('message','Success!!!');

			}

		}


		$aCategory_groups = $this->Categories_model->get_category_groups();
		$aCategory_group_status = $this->Categories_model->get_category_group_status();

		$this->mcontents['aCategory_groups'] = $aCategory_groups;
		$this->mcontents['aCategory_group_status'] = $aCategory_group_status;
		loadAdminTemplate('category/edit_category_group');

	}

}
