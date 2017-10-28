<?php showMessage();?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="row">

        <div class="col-md-12">

            <div class="row carousel-holder">

                <div class="col">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="500000">

                        <div class="carousel-inner">
                            <?php foreach ( $carousel_images as $key => $data ):?>
                            <div class="item <?php echo $key == 0 ? 'active' : '';?>">

                                        <img class="slide-image" src="<?php echo $data['url']?>" alt="">

                                            <div class="carousel-caption box">
                                                <div class="row">
                                                    <div class="col-md-12 col-md-offset-1">
                                                        <h4 class="text-left image_caption"><?php echo $data['title'] ?></h3>
                                                        <p class="text-left"><?php echo $data['description'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                            </div>
                            <?php endforeach; ?>

                                <a class="left carousel-control arrow_position" href="#carousel-example-generic" data-slide="prev">
                                    <span class="fa fa-angle-left " style="font-size:48px"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="fa fa-angle-right" style="font-size:48px"></span>
                                </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3 class="text-primary text-left">Life</h3><br>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>

        <?php $this->load->view('home/home_gallery') ?>


<div id="captionBox"></div>
