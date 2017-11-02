<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->config('gallery_config');
		$this->load->model('gallery_model');

		$this->mcontents['aImageGalleryItemStatuses'] 		= $this->data_model->getDataItem('image_gallery_item_statuses');
		$this->mcontents['aImageGalleryItemStatusTitles'] 	= $this->data_model->getDataItem('image_gallery_item_statuses', 'id-title');

		$this->mcontents['aImageGalleryItemStatusesFlipped'] = array_flip($this->mcontents['aImageGalleryItemStatuses']);
		$this->mcontents['sCurrentMainMenu'] 	= 'gallery';

	}

	function index() {


		$this->load->model('gallery_model');
		$this->mcontents['sCurrentMainMenu'] = 'home';

		$carousel_images = array(

								array(

									"title"       => "Lorem ipsum",
									"description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ",
									"url"         => $this->config->item('asset_url')."img/moderna/slides/1.jpg"
								),
								array(
									"title"       => "Lorem ipsum",
									"description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
									"url"         => $this->config->item('asset_url')."img/moderna/slides/2.jpg"
								),
								array(
									"title"       => "Lorem ipsum",
									"description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
									"url"         => $this->config->item('asset_url')."img/moderna/slides/3.jpg"
								)

						  );


		//redirect('survey');
		$this->mcontents['carousel_images'] = $carousel_images;
		$this->mcontents['iLimit'] 			= 4;


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


		// // carousel files
		// $this->mcontents['load_css'][] = 'carousel.css';
		//
		// // pop up files
		// $this->mcontents['load_css'][] = 'captionbox.css';
		// $this->mcontents['load_js']['links'][] = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js';
		// $this->mcontents['load_js'][] = 'home/exif.js';
		// $this->mcontents['load_js'][] = 'home/captionbox.js';
		// $this->mcontents['load_js'][] = 'home/home_gallery.js';


		$this->mcontents['load_css'][] = 'moderna/fancybox/jquery.fancybox.css';
		$this->mcontents['load_css'][] = 'moderna/jcarousel.css';
		$this->mcontents['load_css'][] = 'moderna/flexslider.css';



		$this->mcontents['load_js'][] = 'moderna/jquery.fancybox.pack.js';
		//$this->mcontents['load_js'][] = 'moderna/jquery.fancybox-media.js';
		//$this->mcontents['load_js'][] = 'moderna/google-code-prettify/prettify.js';
		$this->mcontents['load_js'][] = 'moderna/jquery.flexslider.js';
		//$this->mcontents['load_js'][] = 'moderna/animate.js';
		$this->mcontents['load_js'][] = 'moderna/custom.js';


        loadTemplate('home/index');
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
