    <h2 class="text-primary">Contact Us</h2><br>
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-primary">Submit Your Query</h3>
            <h4 class="text-success"><?php echo $this->session->flashdata('message'); ?></h4>
            <h4 class="text-danger"><?php echo validation_errors(); ?></h4><br>

            <form class="forms" action="<?php echo base_url()?>contact_us" method="post" style="width : 300px; height : 400px">

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text"
                           class="form-control"
                           placeholder="first name"
                           name       ="first_name"
                           value      ="<?php echo set_value('first_name'); ?>">
               </div>

               <div class="form-group">
                   <label>Middle Name</label>
                   <input type       ="text"
                          class      ="form-control"
                          placeholder="Middle name"
                          name       ="middle_name"
                          value      ="<?php echo set_value('middle_name'); ?>">
              </div>

               <div class="form-group">
                   <label>Last Name</label>
                   <input type       ="text"
                          class      ="form-control"
                          placeholder="last name"
                          name       ="last_name"
                          value      ="<?php echo set_value('lname'); ?>">
              </div>

              <div class="form-group">
                  <label>E-mail</label>
                  <input type       ="text"
                         class      ="form-control"
                         placeholder="email"
                         name       ="email_id"
                         value      ="<?php echo set_value('email'); ?>">
              </div>

              <div class="form-group">
                  <label>Contact Number</label>
                  <input type       ="text"
                         class      ="form-control"
                         placeholder="contact number"
                         name       ="contact_number"
                         value      ="<?php echo set_value('contact_number'); ?>">
              </div>

              <div class="form-group">
                  <label>Purpose</label>
                  <select class="form-control" name="purpose">
                      <?php foreach ( $aEnquiry_purposes as $key=>$data ):?>
                            <option value="<?php echo $key?>"><?php echo $data ?></option>";
                      <?php endforeach;?>
                  </select>
              </div>

              <div class="form-group">
                  <label>Message</label>
                  <textarea class    ="form-control"
                          placeholder="message"
                          name       ="message"
                          value      ="<?php echo set_value('message'); ?>"></textarea>
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>

            </form>

        </div>

        <div class="col-md-6">
            <h3 class="text-primary">Address</h3><br>
            <h4 class="text-default">Address address</h4><br>
            <h3 class="text-primary">We are here..</h3><br>

            <div id="map" style="width:400px;height:400px;background:yellow;float: center;"></div>

            <script>
            function myMap() {
            var mapOptions = {
                center: new google.maps.LatLng(51.5, -0.12),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.HYBRID
            }
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            }
            </script>

            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>

        </div>

    </div>
