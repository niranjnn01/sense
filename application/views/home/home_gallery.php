<div class="row">

    <h3 class="text-primary">What's new</h3><br>


    <?php foreach ( $aPictures as $key => $data ):?>
    <div class="col-md-3">
        <figure class="gallery-image">
            <a class="captionBoxImage" href="<?php echo getImage('picture_gallery', $data->image_name, 'large',array("only_url"=>true)); ?> ?>">
                <img src="<?php echo getImage('picture_gallery', $data->image_name,'display_image',array("only_url"=>true)); ?>" alt="">
                <figcaption class="customCaption">
                  <p class="img_name"><?php echo $data->title ?></p>
                  <p><?php echo $data->description ?></p>
                </figcaption>
            </a>
        </figure>
    </div>
    <?php endforeach; ?>

</div>

<br><a href="<?php base_url()?>gallery"><label style="float: right;">View more images</label></a>
