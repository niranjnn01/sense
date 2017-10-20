<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->

<head>
    <title><?php echo @$page_title? $page_title : getTitle();?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;"/>
    <link rel="shortcut icon" href="<?php echo $this->config->item('static_image_url');?>favicon.ico"/>
    <link rel="apple-touch-glyphicon glyphicon-precomposed" sizes="144x144" href="<?php echo $this->config->item('base_url');?>asset/img/apple-touch-glyphicon glyphicon-144-precomposed.png"/>
    <link rel="apple-touch-glyphicon glyphicon-precomposed" sizes="114x114" href="<?php echo $this->config->item('base_url');?>asset/img/apple-touch-glyphicon glyphicon-114-precomposed.png"/>
    <link rel="apple-touch-glyphicon glyphicon-precomposed" sizes="72x72" href="<?php echo $this->config->item('base_url');?>asset/img/apple-touch-glyphicon glyphicon-72-precomposed.png"/>
    <link rel="apple-touch-glyphicon glyphicon-precomposed" href="<?php echo $this->config->item('base_url');?>asset/img/apple-touch-glyphicon glyphicon-57-precomposed.png"/>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <?php echo load_files('css');?>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	<script type="text/javascript">var base_url = '<?php echo c('base_url');?>';</script>
</head>


<body style="padding-top:0px;">




<div class="container-fluid">
<div class="row">
	<div class="col-xs-2">
		<!--<a href="<?php echo c('base_url');?>"  title="<?php echo c('website_name');?>">
			<img src="<?php echo $c_static_image_url, c('logo_image_name');?>" alt="<?php echo $c_website_title;?>"/>
		</a>-->
        <h1><?php echo $this->config->item('website_title');?></h1>
		<hr/>


        <?php

        $aAdminMenuTree = array(


    array(
    'section_title' => 'Home',
        'links' => array(),
        'url' => $this->config->item('base_url') . 'home',
        'opened' => false,
    ),

	array(
		'section_title' =>'Users',
		'links' => array(
			array(
				'title' => 'Users',
				'uri' => 'user/listing',
                'opened' => false
			),
			array(
				'title' => 'Create User',
				'uri' => 'user/create',
                'opened' => false
			),
		),
        'opened' => ($sCurrentMainMenu == 'users') ? true : false,
	),


	array(
		'section_title' =>'Gallery',
		'links' => array(
			array(
				'title' => 'List Images',
				'uri' => 'gallery/listing',
                'opened' => false
			),
			array(
				'title' => 'Upload new Image',
				'uri' => 'gallery/upload',
                'opened' => false
			),
		),
        'opened' => ($sCurrentMainMenu == 'gallery') ? true : false,
	),


	array(
		'section_title' => 'Sitepages',
		'links' => array(
			array(
				'title' => 'List',
				'uri' => 'page/listing',
                'opened' => false
			),
		),
        'opened' => ($sCurrentMainMenu == 'sitepages') ? true : false,
	),

	array(
		'section_title' => 'Contact Us',
		'links' => array(
            array(
				'title' => 'Add Purpose',
				'uri' => 'contact_purpose/add_purpose',
                'opened' => false
			),
			array(
				'title' => 'List Purposes',
				'uri' => 'contact_purpose/listing',
                'opened' => false
			),
		),
        'opened' => ($sCurrentMainMenu == 'contact_us') ? true : false,
	),




	array(
		'section_title' => 'Logout',
        'links' => array(),
        'url' => $c_base_url . 'logout',
        'opened' => false,
	),

);
?>

		<?php echo getAccordion_vertical_menu( $aAdminMenuTree );?>


	</div>
	<div class="col-xs-10">

        <h2><?php echo $page_heading;?></h2>
