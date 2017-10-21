<?php showMessage();?>
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

                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
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
                    Kerala has the lowest positive population growth rate in India, 3.44%; the highest Human Development Index (HDI),
                    0.712 in 2015; the highest literacy rate, 93.91% in the 2011 census; the highest life expectancy, 77 years;
                     and the highest sex ratio, 1,084 women per 1,000 men. The state has witnessed significant emigration,
                     especially to Arab states of the Persian Gulf during the Gulf Boom of the 1970s and early 1980s,
                     and its economy depends significantly on remittances from a large Malayali expatriate community.
                     Hinduism is practised by more than half of the population, followed by Islam and Christianity.
                     The culture is a synthesis of Aryan and Dravidian cultures,[6] developed over millennia,
                     under influences from other parts of India and abroad.
                </p>
            </div>
        </div>

        <?php $this->load->view('home/home_gallery') ?>

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
