
var enquiry_id;
var reply_message;

$("label[name=reply]").click(function() {
    //alert($(this).attr("data-enquiry"));
    enquiry_id = $(this).attr("data-enquiry");
});


$('#postForm').submit(function(e) {

    //console.log(enquiry_id);
    e.preventDefault();
    reply_message = $('#message').val();


        $.ajax({

            type:"POST",
            url:'http://localhost/prasad/sense/sense/contact_us/add_enquiry_reply',
            data:
            {
                enquiry_id:enquiry_id,
                reply_message:reply_message
            },
            success: function(message) {

                console.log("Success");
                $('#enq_reply').modal('hide');
                $('#message').val('');
            },
            error: function(){

                console.log("Error");

            }

        });

    //$('#enq_reply').modal('hide');
});
