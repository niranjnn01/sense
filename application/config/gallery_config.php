<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Common Settings
|--------------------------------------------------------------------------
|
|
*/


$CI = & get_instance();

$config['picture_gallery_url'] = $CI->config->config['base_url'].'uploads/picture_gallery/';
$config['picture_gallery_path'] = $CI->config->config['base_path'].'uploads'.DS.'picture_gallery'.DS;

$config['picture_gallery_upload_settings'] = array(

	'upload_path'		    => $config['picture_gallery_path'],
	'allowed_types'		    =>  'png|jpg|jpeg',
	'types_description'	    => '', //will appear in the drop-down box for "file types" field in the "select files" window
	'file_name'			    => '',
	'overwrite'			    => false,
	'max_size'			    => 20480,
	'max_width'			    => 4000, //in pixels
	'max_height'		    => 4000, //in pixels
	'max_filename'		    => 0,
	'encrypt_name'		    => false,
	'remove_spaces'		    => true,
	'extension'			    => '',
	'create_thumbnails'     => true,
    'append_real_name'	    => true,
);

$config['picture_gallery_thumbnail_dimensions'] = array (

	'tiny'             => array('width' => 50, 'height' => 50),
	'small'            => array('width' => 100, 'height' => 100),
	'normal'           => array('width' => 200, 'height' => 200),
    'display_image'    => array('width' => 250, 'height' => 150),
	'large'            => array('width' => 800, 'height' => 800),
);
