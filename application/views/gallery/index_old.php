

<h3 class="text-primary">Gallery</h3><br>
<ul class="nav nav-pills" role="tablist">
    <?php $category = $this->input->get('category'); ?>
    <li role="presentation" class="<?php echo $category ? '' : 'active';?>"><a href="<?php echo base_url()?>/gallery?category=">All<span class="badge"></span></a></li>
    <?php foreach ( $aPictureGalleryCategories as $key => $data ):?>
          <li role="presentation" class ="<?php echo $data == $category ? 'active' : '';?>" id = "image_category" ><a href="<?php echo base_url()?>/gallery?category=<?php echo $data ?>"><?php echo $data ?><span class="badge"></span></a></li>
    <?php endforeach; ?>
</ul><br>

<?php $colum_count=0 ?>
<?php foreach ( $aPictures as $key => $data ):?>

    <?php if($colum_count == 0):?>

        <div class="row">

    <?php endif; ?>

        <?php if($colum_count <= 3):?>

            <div class="col-md-3">
                <figure class="gallery-image">
                    <a class="captionBoxImage" href="<?php echo getImage('picture_gallery', $data->image_name, 'large',array("only_url"=>true)); ?>">
                        <img src="<?php echo getImage('picture_gallery', $data->image_name,'display_image',array("only_url"=>true)); ?>">
                        <figcaption class="customCaption">
                          <p class="img_name"><?php echo $data->title ?></p>
                          <p><?php echo $data->description ?></p>
                        </figcaption>
                    </a>
                </figure>
                <?php $colum_count++; ?>
            </div>

        <?php endif; ?>

    <?php if($colum_count == 4): ?>

        </div><br>
        <?php $colum_count=0 ?>

    <?php endif; ?>

<?php endforeach; ?>
</div>
<div class="row">
	<span style="float:center;"><?php echo $sPagination;?></span>
</div>


<div id="captionBox"></div>
