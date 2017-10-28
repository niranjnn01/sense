
    $( document ).ready(function() {

        $('.carousel').carousel({

            interval: 10000

        });


        $('#captionBox').CaptionBox({
              disableRightClick: false,
			  alterUrlFlag: false
        });
    });
