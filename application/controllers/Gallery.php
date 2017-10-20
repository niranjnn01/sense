<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->config('gallery_config');
		$this->load->model('gallery_model');

		$this->mcontents['aImageGalleryItemStatuses'] 		= $this->data_model->getDataItem('image_gallery_item_statuses');
		$this->mcontents['aImageGalleryItemStatusTitles'] 	= $this->data_model->getDataItem('image_gallery_item_statuses', 'id-title');

		$this->mcontents['aImageGalleryItemStatusesFlipped'] = array_flip($this->mcontents['aImageGalleryItemStatuses']);
		$this->mcontents['sCurrentMainMenu'] 	= 'gallery';
	}


	/**
	 *
	 * Picture gallery
	 *
	 */
	 public function index() {


 		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Picture Gallery ';

 		$this->mcontents['iLimit'] 				= 20;

 		// only authorized personal can access this page.
 		$this->authentication->is_admin_logged_in(true, 'user/login');

 		// get image categories
 		$this->load->model('categories_model');
 		$aPictureGalleryCategories = $this->categories_model->get_categories_by_group('name', 'picture_gallery');
 		$this->mcontents['aPictureGalleryCategories'] = $this->data_model->getDataInFormat($aPictureGalleryCategories, 'id-name');
 		$this->mcontents['aPictureGalleryCategoriesFlipped'] = $this->data_model->getDataInFormat($aPictureGalleryCategories, 'id-name');
 		$this->mcontents['aPictureGalleryCategoriesFlipped'] = array_flip($this->mcontents['aPictureGalleryCategories']);


 		// validate category input
 		$sCategory = safeText('category', false, 'get');
 		$this->mcontents['iCategory'] = NULL;
 		if( in_array($sCategory, $this->mcontents['aPictureGalleryCategories']) ) {
 			$this->mcontents['iCategory'] = $this->mcontents['aPictureGalleryCategoriesFlipped'][$sCategory];
 		}

 		// get offset
 		$this->mcontents['iOffset'] = safeText('offset', false, 'get') ? safeText('offset', false, 'get') : 0;


 	// p($this->mcontents['iCategory']);

 		$aWhere = $aOrWhere = $aOrderBy = $aWhere = array();


 		if( ! is_null($this->mcontents['iCategory']) ) {
 			$aWhere['IG.category'] = $this->mcontents['iCategory'];
 		}



 		$aOrderBy = array('IG.created_on' => 'DESC');

 		$this->mcontents['iTotal'] 		= $this->gallery_model->getGalleryPicturesCount($aWhere, array(), $aOrWhere);
 		$this->mcontents['aPictures'] 	= $this->gallery_model->getGalleryPictures(
 																			$this->mcontents['iLimit'],
 																			$this->mcontents['iOffset'],
 																			$aWhere,
 																			$aOrderBy,
 																			$aOrWhere
 																			);

 		//p($this->db->last_query());
 		//p($this->mcontents['aPictures']);

 		/* Pagination */
 		$sUriSegment = 'gallery/listing';
 		$sUriString = preprocess_query_string_for_pagination($sUriSegment);

 		$this->load->library('pagination');
 		$this->aPaginationConfiguration = array();
 		$this->aPaginationConfiguration['base_url'] 	= c('base_url') . $sUriSegment . '?' . $sUriString;
 		$this->aPaginationConfiguration['total_rows'] 	= $this->mcontents['iTotal'];
 		$this->aPaginationConfiguration['per_page'] 	= $this->mcontents['iLimit'];
 		$this->aPaginationConfiguration['uri_segment'] 	= 4;
 		$this->pagination->customizePagination();
 		$this->mcontents['iOffset'] 					= $this->mcontents['iOffset'];
 		$this->pagination->initialize($this->aPaginationConfiguration);
 		$this->mcontents['sPagination'] 				= $this->pagination->create_links();
 		/* Pagination - End */


 		

 		loadAdminTemplate('gallery/index');
 	}


	/**
	 *
	 * Picture gallery
	 *
	 */
	public function listing() {


		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Picture Gallery ';

		$this->mcontents['iLimit'] 				= 20;

		// only authorized personal can access this page.
		$this->authentication->is_admin_logged_in(true, 'user/login');

		// get image categories
		$this->load->model('categories_model');
		$aPictureGalleryCategories = $this->categories_model->get_categories_by_group('name', 'picture_gallery');
		$this->mcontents['aPictureGalleryCategories'] = $this->data_model->getDataInFormat($aPictureGalleryCategories, 'id-name');
		$this->mcontents['aPictureGalleryCategoriesFlipped'] = $this->data_model->getDataInFormat($aPictureGalleryCategories, 'id-name');
		$this->mcontents['aPictureGalleryCategoriesFlipped'] = array_flip($this->mcontents['aPictureGalleryCategories']);


		// validate category input
		$sCategory = safeText('category', false, 'get');
		$this->mcontents['iCategory'] = NULL;
		if( in_array($sCategory, $this->mcontents['aPictureGalleryCategories']) ) {
			$this->mcontents['iCategory'] = $this->mcontents['aPictureGalleryCategoriesFlipped'][$sCategory];
		}

		// get offset
		$this->mcontents['iOffset'] = safeText('offset', false, 'get') ? safeText('offset', false, 'get') : 0;


	// p($this->mcontents['iCategory']);

		$aWhere = $aOrWhere = $aOrderBy = $aWhere = array();


		if( ! is_null($this->mcontents['iCategory']) ) {
			$aWhere['IG.category'] = $this->mcontents['iCategory'];
		}



		$aOrderBy = array('IG.created_on' => 'DESC');

		$this->mcontents['iTotal'] 		= $this->gallery_model->getGalleryPicturesCount($aWhere, array(), $aOrWhere);
		$this->mcontents['aPictures'] 	= $this->gallery_model->getGalleryPictures(
																			$this->mcontents['iLimit'],
																			$this->mcontents['iOffset'],
																			$aWhere,
																			$aOrderBy,
																			$aOrWhere
																			);

		//p($this->db->last_query());
		//p($this->mcontents['aPictures']);

		/* Pagination */
		$sUriSegment = 'gallery/listing';
		$sUriString = preprocess_query_string_for_pagination($sUriSegment);

		$this->load->library('pagination');
		$this->aPaginationConfiguration = array();
		$this->aPaginationConfiguration['base_url'] 	= c('base_url') . $sUriSegment . '?' . $sUriString;
		$this->aPaginationConfiguration['total_rows'] 	= $this->mcontents['iTotal'];
		$this->aPaginationConfiguration['per_page'] 	= $this->mcontents['iLimit'];
		$this->aPaginationConfiguration['uri_segment'] 	= 4;
		$this->pagination->customizePagination();
		$this->mcontents['iOffset'] 					= $this->mcontents['iOffset'];
		$this->pagination->initialize($this->aPaginationConfiguration);
		$this->mcontents['sPagination'] 				= $this->pagination->create_links();
		/* Pagination - End */


		$this->mcontents['load_js'][] = 'gallery/image_gallery_listing.js';

		loadAdminTemplate('gallery/listing');
	}


	/**
	 *
	 * Upload a picture
	 * @return [type] [description]
	 */
	public function upload() {

		$this->authentication->is_admin_logged_in(true, 'user/login');

		$this->mcontents['page_heading'] = 'Upload Image';

		// get image categories
		$this->load->model('categories_model');
		$aPictureGalleryCategories = $this->categories_model->get_categories_by_group('name', 'picture_gallery');
		$this->mcontents['aPictureGalleryCategories'] = $this->data_model->getDataInFormat($aPictureGalleryCategories, 'id-name');
		$this->mcontents['aPictureGalleryCategoriesTitles'] = $this->data_model->getDataInFormat($aPictureGalleryCategories, 'id-title');
		$this->mcontents['aPictureGalleryCategoriesFlipped'] = array_flip($this->mcontents['aPictureGalleryCategories']);

		if( isset( $_FILES['gallery_picture'] ) && $_FILES['gallery_picture']['error'] != 4 ) {

			// we need a different name for each image in gallery
			$this->load->helper('string');
			$sImageName = '';
			do {

				$sRandomString = random_string('alnum', 10);
				$sImageName = $sRandomString . '.jpg';

				$this->db->where('image_name', $sImageName);
			} while ( $this->db->get('image_gallery')->row() );


			if( $sImageName ) {

				$this->load->helper('custom_upload');
				$aConfig = array(
								'file_name' => $sImageName,
								'append_real_name' => false
							);
				$aUploadData 	= uploadFile('image', 'picture_gallery', 'gallery_picture', $aConfig);
// p($this->merror);
				if( empty($this->merror['error']) ) {

					$aImageData = array(
						'image_name' 	=> $aUploadData['file_name'],
						'category' 		=> safeText('category'),
						'title' 		=> safeText('title'),
						'description' 	=> safeHtml('description'),
						'status' 		=> $this->mcontents['aImageGalleryItemStatusesFlipped']['active'],
						'created_on' 	=> date('Y-m-d H:i:s')
					);

					// p($aImageData);
					// exit;

					$this->db->insert('image_gallery', $aImageData);

					sf('success_message', 'Image has been uploaded to gallery');
					redirect('gallery/upload');
				}

			} else {

			}
		}


		loadAdminTemplate('gallery/upload');
	}


	/**
	 *
	 * edit a picture
	 * @return [type] [description]
	 */
	public function edit($iImageId=0) {

		$this->authentication->is_admin_logged_in(true, 'user/login');

		$this->mcontents['page_heading'] = 'Edit Image';

		// see if we have this image
		if( ! $this->mcontents['oImage'] = $this->gallery_model->getSingleImage($iImageId) ) {

			sf('error_message', 'Image you are looking for could not be found');
			redirect('gallery/listing');
		}


		// require image helper
		$this->load->helper('image');

		// get image categories
		$this->load->model('categories_model');
		$aPictureGalleryCategories = $this->categories_model->get_categories_by_group('name', 'picture_gallery');
		$this->mcontents['aPictureGalleryCategories'] = $this->data_model->getDataInFormat($aPictureGalleryCategories, 'id-name');
		$this->mcontents['aPictureGalleryCategoriesTitles'] = $this->data_model->getDataInFormat($aPictureGalleryCategories, 'id-title');
		$this->mcontents['aPictureGalleryCategoriesFlipped'] = array_flip($this->mcontents['aPictureGalleryCategories']);


		if( isset( $_POST ) && ! empty( $_POST ) ) {

			// validate category
			$bCategoryValidated = false;
			if( array_key_exists(safeText('category'), $this->mcontents['aPictureGalleryCategories']) ) {
				$bCategoryValidated = true;
			}

			// validate status
			$bStatusValidated = false;
			if( array_key_exists(safeText('status'), $this->mcontents['aImageGalleryItemStatuses']) ) {
				$bStatusValidated = true;
			}

			if( $bCategoryValidated &&  $bStatusValidated ) {

				$aImageData = array(
					'category' 		=> safeText('category'),
					'title' 		=> safeText('title'),
					'description' 	=> safeHtml('description'),
					'status' 		=> safeText('status')
				);


				$this->db->where('id', $this->mcontents['oImage']->id);
				$this->db->update('image_gallery', $aImageData);

				sf('success_message', 'Image has been uploaded to gallery');
				redirect('gallery/edit/' . $this->mcontents['oImage']->id);
			}
		}

		loadAdminTemplate('gallery/edit');
	}


	/**
	 *
	 * Delete the specified image and redirect to gallery listing page.
	 *
	 * @param  [type] $iImageId [description]
	 * @return [type]           [description]
	 */
	function delete($iImageId) {


		// only authorized personal can access this page.
		$this->authentication->is_admin_logged_in(true, 'user/login');


		if($oImage = $this->gallery_model->getSingleImage($iImageId)) {

			$this->gallery_model->deleteImage($oImage);
			sf('success_message', 'Image has been removed from system.');

		} else {
			sf('error_message', 'Could not find the image you requested.');
		}

		redirect('gallery/listing');

	}

}

/* End of file campaign.php */
/* Location: ./application/controllers/campaign.php */
