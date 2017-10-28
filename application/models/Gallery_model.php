<?php
class Gallery_model extends CI_Model{

	function __construct(){

		parent::__construct();

	}

	function getSingleImage($iImageId) {

		$this->db->where('id', $iImageId);
		$oRow = $this->db->get('image_gallery')->row();

		//p( $this->db->last_query() );exit;

		return $oRow;
	}


    /**
     *
     * expecting either image object or image id
     *
     */
    function deleteImage($input) {

		$oImage = $input;

		if( is_numeric($input) ) {
			$oImage = $this->getSingleImage($input);
		}

		// delete the file
		$this->load->helper('custom_file');
		deleteFile('image', 'picture_gallery', $oImage->image_name);


		// delete from database
		$this->db->where('id', $oImage->id);
		$this->db->delete('image_gallery');
    }



	function deleteResourceThumbnails( $iResourceId ) {

		$this->load->helper('image');

		$oResource = $this->getResourceBy('uid', $iResourceId);

		$aResourceTypePath 	= $this->config->item('resource_type_path');
		$file_path 			= $aResourceTypePath[ $this->aResourceType['image'] ].'thumbnails/';

		$aInfo 				= explode('.', $oResource->file_name);

		$aThumbnailDimension = c('resource_image_thumbnail_dimensions');

		foreach ( $aThumbnailDimension as $size => $thumb_image_size ) {

			$image = getThumbFileName($aInfo[0], $size , $aInfo[1]);
			@unlink( $file_path.$image );
		}

	}

	/**
	 * [getGalleryPicturesCount description]
	 * @param  array  $aWhere [description]
	 * @return [type]         [description]
	 */
	function getGalleryPicturesCount($aWhere=array(), $aOrderBy=array(), $aOrWhere=array()) {

		$iCount = 0;

		$this->db->select('COUNT(IG.id) count');

		if( $aWhere ) {

			$this->db->where($aWhere, false);

		}

		if( $aOrWhere ) {

			foreach($aOrWhere AS $aItem){
				$this->db->or_where($aItem, false);
			}
		}


		$this->db->join('categories C', 'IG.category = C.id');

		if( $oRow = $this->db->get('image_gallery IG')->row() ) {

			$iCount = $oRow->count;
		}

		//p($this->db->last_query());

		return $iCount;

		//$this->db->get('image_gallery IG')->result();
	}

	/**
	 * Get a list of images
	 * @param  integer $iLimit  [description]
	 * @param  integer $iOffset [description]
	 * @param  array   $aWhere  [description]
	 * @return [type]           [description]
	 */
	function getGalleryPictures($iLimit=0, $iOffset=0, $aWhere=array(), $aOrderBy=array(), $aOrWhere=array()) {

		$this->db->select('IG.*, C.title category_title');

		if( $iLimit || $iOffset ) {

			$this->db->limit($iLimit, $iOffset);
		}

		if( $aWhere ) {

			$this->db->where($aWhere, false);

		}

		if( $aOrWhere ) {

			foreach($aOrWhere AS $aItem){
				$this->db->or_where($aItem, false);
			}
		}

		if( $aOrderBy ) {

			foreach($aOrderBy AS $sKey => $sItem){

				$this->db->order_by($sKey, $sItem);
			}

		}

		$this->db->join('categories C', 'IG.category = C.id');
		$query =  $this->db->get('image_gallery IG');

		 //p($this->db->last_query());

		return $query->result();
	}




	function renameImageThumbnails ( $oResource, $sNewFileName ) {

		$this->load->helper('image');

		$aResourceTypePath 	= $this->config->item('resource_type_path');
		$file_path 			= $aResourceTypePath[ $this->aResourceType['image'] ].'thumbnails/';
		//p('rename test');exit;
		//p( c('resource_image_thumbnail_dimensions') );

		renameThumbnails( $file_path, $file_path, $oResource->file_name, $sNewFileName, c('resource_image_thumbnail_dimensions') );
	}

}
