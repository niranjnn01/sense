
        <div class="container">
        <?php foreach ( $oEnquiry as $data_enquiry ):?>

        <div class="text-info">
        <span class="h4">Enquirer Name&nbsp;&nbsp;&nbsp;:&nbsp;</span>
            <?php echo $data_enquiry->firstname." ".$data_enquiry->lastname;?>&nbsp;(<?php echo $data_enquiry->email;?>)<br><br>
            <p><span class="h4">Contact Number&nbsp;:&nbsp;&nbsp;</span><?php echo $data_enquiry->contact_number;?></p>
        </div>


        <div class="row">
            <div class="col-md-12">
                    <div class="guest_message">
                        <div>
                            <span class="text-info h4"><?php echo $data_enquiry->firstname?></span>
                            &nbsp;<?php echo date("h i a d M Y ",strtotime($data_enquiry->created_on))?>
                            <br><br><p class="text-info">Enquiry  :<?php echo $data_enquiry->message;?></p>
                        </div>
                    </div>

            </div>
        </div>


        <?php endforeach; ?>





            <?php foreach ( $aEnquiry_reply as $data_reply ):?>

                <?php $sClass= '';?>
                <?php if( $data_reply->user_type != $this->mcontents['aUserTypesFlipped']['guest'] ):?>
                    <?php $sClass= 'staff_admin_msg';?>
                <?php endif; ?>


                <div class="row">
                    <div class="col-md-12">


                            <div class="guest_message <?php echo $sClass;?>">
                                <div>
                                    <span class="text-info h4"><?php echo $data_reply->full_name;?></span>
                                    &nbsp;<?php echo date("d M Y ",strtotime($data_reply->created_on))?>
                                </div>
                                <br><p class="text-info"><?php echo $data_reply->message ?></p>
                            </div>

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
