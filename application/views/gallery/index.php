

<h3 class="text-primary">Gallery</h3><br>

<ul class="list-group">

    <li class="list-group-item">
        <span class="badge">14</span>
            Image Group1
    </li>

    <li class="list-group-item">
        <span class="badge">10</span>
            Image Group2
    </li>

</ul>

<?php $colum_count=0 ?>
<?php foreach ( $aPictures as $key => $data ):?>

    <?php if($colum_count == 0):?>

        <div class="row">

    <?php endif; ?>

        <?php if($colum_count <= 3):?>

            <div class="col-md-3">
                <figure>
                    <a class="captionBoxImage" href="<?php echo getImage('picture_gallery', $data->image_name, 'large',array("only_url"=>true)); ?>">
                        <img src="<?php echo getImage('picture_gallery', $data->image_name,'display_image',array("only_url"=>true)); ?>" alt="">
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


<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url()?>asset/js/home/jquery.js"></script>
<script src="<?php echo base_url()?>asset/js/home/bootstrap.min.js"></script>





<div id="captionBox"></div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="<?php echo base_url()?>asset/js/home/exif.js"></script>
<script src="<?php echo base_url()?>asset/js/home/captionbox.js"></script>
<script src="<?php echo base_url()?>asset/js/home/home_gallery.js"></script>
