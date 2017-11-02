
		<section id="featured">
			<!-- start slider -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<!-- Slider -->
						<div id="main-slider" class="flexslider">
							<ul class="slides">
								<li>
									<img src="<?php echo base_url()?>asset/img/moderna/slides/1.jpg" alt="" />
									<div class="flex-caption">
										<h3>Lorem</h3>
										<p>Duis fermentum auctor ligula ac malesuada. Mauris et metus odio, in pulvinar urna</p>
										<a href="#" class="btn btn-theme">Learn More</a>
									</div>
								</li>
								<li>
									<img src="<?php echo base_url()?>asset/img/moderna/slides/2.jpg" alt="" />
									<div class="flex-caption">
										<h3>lorem</h3>
										<p>Sodales neque vitae justo sollicitudin aliquet sit amet diam curabitur sed fermentum.</p>
										<a href="#" class="btn btn-theme">Learn More</a>
									</div>
								</li>
								<li>
									<img src="<?php echo base_url()?>asset/img/moderna/slides/3.jpg" alt="" />
									<div class="flex-caption">
										<h3>Lorem</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit donec mer lacinia.</p>
										<a href="#" class="btn btn-theme">Learn More</a>
									</div>
								</li>
							</ul>
						</div>
						<!-- end slider -->
					</div>
				</div>
			</div>



		</section>
		<section class="callaction">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="big-cta">
							<div class="cta-text">
								<h2><span>About LIFE</span></h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">


							<div class="col-lg-3">

							</div>
							<div class="col-lg-3">

							</div>
							<div class="col-lg-3">

							</div>
							<div class="col-lg-3">
								<div class="box">

								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- divider -->
				<div class="row">
					<div class="col-lg-12">
						<div class="solidline">
						</div>
					</div>
				</div>
				<!-- end divider -->
				<!-- Portfolio Projects -->
				<div class="row">
					<div class="col-lg-12">
						<h4 class="heading">What's New</h4>
						<div class="row">
							<section id="projects">
								<ul id="thumbs" class="portfolio">

									<?php foreach ( $aPictures as $key => $data ):?>
									<!-- Item Project and Filter Name -->
									<li class="col-lg-3 design" data-id="id-0" data-type="web">
										<div class="item-thumbs">
											<!-- Fancybox - Gallery Enabled - Title - Full Image -->
											<a class="hover-wrap fancybox" data-fancybox-group="gallery" title="<?php echo $data->title ?>" href="<?php echo getImage('picture_gallery', $data->image_name, 'large',array("only_url"=>true)); ?>">
						<span class="overlay-img"></span>
						<span class="overlay-img-thumb font-icon-plus"></span>
						</a>
											<!-- Thumb Image and Description -->
											<img src="<?php echo getImage('picture_gallery', $data->image_name,'display_image',array("only_url"=>true)); ?>" alt="<?php echo $data->description ?>">
										</div>
									</li>
									<!-- End Item Project -->

									<?php endforeach; ?>
									<br><br><a href="<?php echo base_url()?>gallery"><label style="float: right;">View More..</label></a>
							</section>
						</div>
					</div>
				</div>

			</div>
		</section>
