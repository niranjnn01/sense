
        <?php foreach ( $aEnquiry as $data_enquiry ):?>
        <h2 class="text-primary"><?php echo $data_enquiry->firstname." ".$data_enquiry->lastname;?></h2>
        <h5 class="text-success">Email</h5><h4 class="text-primary"><?php echo $data_enquiry->email;?></h4>
        <h5 class="text-success">Contact Number</h5><h4 class="text-primary"> <?php echo $data_enquiry->contact_number;?></h4>
        <h5 class="text-success">Enquiry</h5><h4 class="text-primary"> <?php echo $data_enquiry->message;?></h4>
        <?php endforeach; ?>

        <div class="container">
            <?php foreach ( $aEnquiry_reply as $data_reply ):?>
            <div class="row">
                <div class="col-md-6">

                        <?php if( $data_reply->author_account == $this->session->ACCOUNT_NO ):?>
                            <div style="border-style: groove;border-color: #92a8d1;background-color: #e8e9ed; padding-right: 30px; padding-left: 30px;">
                            <h5 class="text-success" style="text-align:left"><?php echo $this->session->FULL_NAME ?><h4>
                            <h4 class="text-primary" style="text-align:left"><?php echo $data_reply->message ?><h4>
                            </div>
                        <?php endif; ?>

                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">

                        <?php if( $data_reply->author_account != $this->session->ACCOUNT_NO) :?>
                            <div style="border-style: groove;border-color: #92a8d1;background-color: #e8e9ed; padding-right: 30px; padding-left: 30px;">
                            <h5 class="text-success" style="text-align:right"><?php echo $this->session->FULL_NAME ?><h4>
                            <h4 class="text-primary" style="text-align:right"><?php echo $data_reply->message ?><h4>
                            </div>
                        <?php endif; ?>

                </div>
            </div>
             <?php endforeach; ?>
        <div>

        <br>
        <form class="forms"
              action="<?php echo base_url()?>contact_us/view_conversation?id=<?php echo $data_enquiry->id ?>"
              method="post"
              id="sendReply"
              
              >
            <div class="form-group">
                <textarea class="form-control"
                          name="message"
                          id="message"
                          rows="4"
                          cols="400"
                          placeholder = "Type your message..."></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="" value="Enter" class="btn btn-info">
            </div>
        </form>
