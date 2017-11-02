

		<section id="content">

			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h4>Get in touch with us by filling <strong>contact form below</strong></h4>

						<?php showMessage();?>

						<!-- <div id="sendmessage">Your message has been sent. Thank you!</div>
						<div id="errormessage"></div> -->

						<form action="<?php echo base_url()?>contact_us" method="post" role="form" class="contactForm" id="contactUsForm">

							<div class="form-group">
								<input type="text" name="first_name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo set_value('first_name'); ?>" />
								<div class="validation"></div>
							</div>

							<div class="form-group">
								<input type="email" class="form-control" name="email_id" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" value="<?php echo set_value('email_id'); ?>"/>
								<div class="validation"></div>
							</div>

							<div class="form-group">
								<input type="text" class="form-control" name="contact_number" id="contact" placeholder="Your Contact Number" data-rule="number" data-msg="Please enter a valid contact number" value="<?php echo set_value('contact_number'); ?>" />
								<div class="validation"></div>
							</div>

							<div class="form-group">
					            <select class="form-control" name="purpose">
			                        <?php foreach ( $aEnquiry_purposes as $key=>$data ):?>
			                              <option value="<?php echo $key?>"><?php echo $data ?></option>";
			                        <?php endforeach;?>
			                    </select>
			                </div>

							<div class="form-group">
								<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message" value="<?php echo set_value('message'); ?>"></textarea>
								<div class="validation"></div>
							</div>

							<div class="text-center"><button type="submit" class="btn btn-theme">Send Message</button></div>
						</form>

					</div>

					<div class="col-md-6">
						<h4 style="text-align: center;">Address</h4>
						<address style="text-align: center;">
							<br>Building Number
							<br>Street
							<br>City
							<br>District
							<br>State
							<br>Phone :0471 1434325
							<br>E-mail:example@gmail.com
						</address>
					</div>

				</div>
			</div>

			<h4 style="text-align: center;">We are here...</h4>
			<div class="map">
				<div id="google-map" data-latitude="40.713732" data-longitude="-74.0092704"></div>
			</div>
			
		</section>
