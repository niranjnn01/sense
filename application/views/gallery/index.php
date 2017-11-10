
		<section id="content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<ul class="portfolio-categ filter" role="tablist">
						    <?php $category = $this->input->get('category'); ?>
						    <li role="presentation" class="<?php echo $category ? '' : 'active';?>"><a href="<?php echo base_url()?>/gallery?category=">All<span class="badge"></span></a></li>
						    <?php foreach ( $aPictureGalleryCategories as $key => $data ):?>
						          <li role="presentation" class ="<?php echo $data == $category ? 'active' : '';?>" id = "image_category" ><a href="<?php echo base_url()?>/gallery?category=<?php echo $data ?>"><?php echo $data ?><span class="badge"></span></a></li>
						    <?php endforeach; ?>
						</ul><br><br>

						<div class="clearfix">
						</div>

						<?php $colum_count=0 ?>
						<?php foreach ( $aPictures as $key => $data ):?>

						    <?php if($colum_count == 0):?>

						        <div class="row">

						    <?php endif; ?>

						        <?php if($colum_count <= 3):?>


										<section id="projects">
											<ul id="thumbs" class="portfolio">

												<!-- Item Project and Filter Name -->
												<li class="item-thumbs col-lg-3 design">
													<!-- Fancybox - Gallery Enabled - Title - Full Image -->
													<a class="hover-wrap fancybox" data-fancybox-group="gallery" title="<?php echo $data->title ?>" href="<?php echo getImage('picture_gallery', $data->image_name, 'large',array("only_url"=>true)); ?>">
														<span class="overlay-img"></span>
														<span class="overlay-img-thumb font-icon-plus"></span>
													</a>
													<!-- Thumb Image and Description -->
													<img src="<?php echo getImage('picture_gallery', $data->image_name,'large',array("only_url"=>true)); ?>" alt="<?php echo $data->description ?>">
												</li>
												<!-- End Item Project -->

											</ul>
										</section>
						                <?php $colum_count++; ?>


						        <?php endif; ?>

						    <?php if($colum_count == 4): ?>

						        </div><br>
						        <?php $colum_count=0 ?>

						    <?php endif; ?>

						<?php endforeach; ?>
						</div>

						</div>
						<div style="width:10%; margin: 0px auto 0px auto">
							<?php echo $sPagination;?>
						</div>

							<!--<div id="pagination">
							<span class="all">Page 1 of 3</span>
							<span class="current">1</span>
							<a href="#" class="inactive">2</a>
							<a href="#" class="inactive">3</a>
						</div>-->
				</div>
			</div>
		</section>
