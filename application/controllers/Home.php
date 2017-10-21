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

									"title"       => "caption1",
									"description" => "description1",
									"url"         => "http://localhost/prasad/sense/sense/asset/img/carousel_mages/image1.jpg"
								),
								array(
									"title"       => "caption2",
									"description" => "description2",
									"url"         => "http://localhost/prasad/sense/sense/asset/img/carousel_mages/image1.jpg"
								),
								array(
									"title"       => "caption3",
									"description" => "description3",
									"url"         => "http://localhost/prasad/sense/sense/asset/img/carousel_mages/image1.jpg"
								)

						  );

		$home_gallery_images = array(

									array(
										"title"       => "caption1",
										"description" => "Kerala has the lowest positive population growth rate in India, 3.44%;
														  the highest Human Development Index (HDI),
														  0.712 in 2015; the highest literacy rate, 93.91% in the 2011 census; the highest life expectancy,
														  77 years;and the highest sex ratio, 1,084 women per 1,000 men. The state has witnessed significant emigration,",
										"url_thump"   => "http://localhost/prasad/sense/sense/asset/img/home/img4_thumb.jpg",
										"url"         => "http://localhost/prasad/sense/sense/asset/img/home/image1.jpg"
									),

									array(
										"title"       => "caption2",
										"description" => "Kerala has the lowest positive population growth rate in India, 3.44%;
														  the highest Human Development Index (HDI),
														  0.712 in 2015; the highest literacy rate, 93.91% in the 2011 census; the highest life expectancy,
														  77 years;and the highest sex ratio, 1,084 women per 1,000 men. The state has witnessed significant emigration,",
										"url_thump"   => "http://localhost/prasad/sense/sense/asset/img/home/img4_thumb.jpg",
										"url"         => "http://localhost/prasad/sense/sense/asset/img/home/image2.jpg"
									),
									array(
										"title"       => "caption3",
										"description" => "Kerala has the lowest positive population growth rate in India, 3.44%;
														  the highest Human Development Index (HDI),
														  0.712 in 2015; the highest literacy rate, 93.91% in the 2011 census; the highest life expectancy,
														  77 years;and the highest sex ratio, 1,084 women per 1,000 men. The state has witnessed significant emigration,",
										"url_thump"   => "http://localhost/prasad/sense/sense/asset/img/home/img4_thumb.jpg",
										"url"         => "http://localhost/prasad/sense/sense/asset/img/home/image3.jpg"
									),
									array(
										"title"       => "caption4",
										"description" => "Kerala has the lowest positive population growth rate in India, 3.44%;
														  the highest Human Development Index (HDI),
														  0.712 in 2015; the highest literacy rate, 93.91% in the 2011 census; the highest life expectancy,
														  77 years;and the highest sex ratio, 1,084 women per 1,000 men. The state has witnessed significant emigration,",
										"url_thump"   => "http://localhost/prasad/sense/sense/asset/img/home/img4_thumb.jpg",
										"url"         => "http://localhost/prasad/sense/sense/asset/img/home/image4.jpg"
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


		$this->mcontents['home_gallery_images'] = $home_gallery_images;

		// carousel files
		$this->mcontents['load_css'][] = 'carousel.css';

		// pop up files
		$this->mcontents['load_css'][] = 'captionbox.css';
		$this->mcontents['load_js']['links'][] = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js';
		$this->mcontents['load_js'][] = 'home/exif.js';
		$this->mcontents['load_js'][] = 'home/captionbox.js';



		loadTemplate('home/home');

		//p($this->session->userdata);
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
