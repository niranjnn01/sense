        <?php foreach ( $aEnquiry as $data_enquiry ):?>
        <h5 class="text-success">Name</h5><h4 class="text-primary"><?php echo $data_enquiry->firstname." ".$data_enquiry->lastname;?></h4>
        <h5 class="text-success">Email</h5><h4 class="text-primary"><?php echo $data_enquiry->email;?></h4>
        <h5 class="text-success">Contact Number</h5><h4 class="text-primary"> <?php echo $data_enquiry->contact_number;?></h4>
        <h5 class="text-success">Enquiry</h5><h4 class="text-primary"> <?php echo $data_enquiry->message;?></h4>
        <?php endforeach; ?>

        <div class="container">
            <?php foreach ( $aEnquiry_reply as $data_reply ):?>
            <div class="row">
                <div class="col-md-6">
                    <?php if( $data_reply->author_id != 1) {?>
                        <h5 class="text-success"><?php echo $data_reply->author_id ?><h4>
                        <h4 class="text-primary"><?php echo $data_reply->message ?><h4>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <?php if( $data_reply->author_id == 1) {?>
                        <h5 class="text-success"><?php echo $data_reply->author_id ?><h4>
                        <h4 class="text-primary"><?php echo $data_reply->message ?><h4>
                    <?php } ?>
                </div>
            </div>
             <?php endforeach; ?>
        <div>

        <br>
        <form class="forms"
              action="<?php echo base_url()?>contact_us/add_conversation?id=<?php echo $data_enquiry->id ?>"
              method="post"
              id="postForm"
              style="width : 300px; height : 400px">
            <div class="form-group">
                <textarea class="form-control"
                          name="message"
                          id="message"
                          rows="4"
                          cols="100"
                          placeholder = "Type your message..."></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="" value="Enter" class="btn btn-primary">
            </div>
        </form>
