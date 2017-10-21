
    $( document ).ready(function() {

        $('.carousel').carousel({

            interval: 10000

        }); 


        $('#captionBox').CaptionBox({
              disableRightClick: true,
			  alterUrlFlag: false
        });
    });
