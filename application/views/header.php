<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?php echo isset($page_title)? $page_title : getTitle();?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<!-- css -->
	<link href="<?php echo base_url()?>asset/themes/default_theme/css/moderna/bootstrap.min.css" rel="stylesheet" />

	<link href="<?php echo base_url()?>asset/themes/default_theme/css/moderna/style.css" rel="stylesheet" />

	<!-- Theme skin -->
	<link href="<?php echo base_url()?>asset/themes/default_theme/css/moderna/default.css" rel="stylesheet" />

	<?php //JQUERY UI ?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php echo load_files('css');?>
	<?php //p($this->mcontents['load_css']);?>

	<!-- =======================================================
    Theme Name: Moderna
    Theme URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
	======================================================= -->

</head>

<body>
	<div id="wrapper">
		<!-- start header -->
		<header>
			<?php //HEADER MENU ?>
			<div class="navbar navbar-default navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
						<a class="navbar-brand" href="<?php echo $c_base_url;?>"><span>S</span>ense</a>
					</div>
					<div class="navbar-collapse collapse ">
						<ul class="nav navbar-nav">

							<li class="active"><a href="<?php echo $c_base_url;?>" >Home</a></li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0"
									data-close-others="false">About <b class=" icon-angle-down"></b></a>
								<ul class="dropdown-menu">
									<li>
					                    <a href="<?php echo $c_base_url;?>about_us" class="">About Us</a>
					                </li>
					                <li><hr class="small">
										<li>
						                    <a href="<?php echo $c_base_url;?>trustees" class="">Trustees Of Institution</a>
						                </li>
						                <li>
						                    <a href="<?php echo $c_base_url;?>mission" class="">Mission And Vision</a>
						                </li>
						                <li>
						                    <a href="<?php echo $c_base_url;?>about_life" class="">About Life</a>
						                </li>
									</li>

								</ul>
							</li>
							<li><a href="<?php echo $c_base_url;?>gallery" >Gallery</a></li>
							<li><a href="<?php echo $c_base_url;?>contact_us">Contact Us</a></li>
							<?php if($this->authentication->is_user_logged_in(false)): ?>

								<li><a href="<?php echo $c_base_url;?>logout">Logout</a></li>

							<?php endif ?>

						</ul>
					</div>
				</div>
			</div>
		</header>
		<!-- end header -->
		<section id="content">
			<div class="container">
