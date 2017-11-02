$(document).ready(function(){
$("#contactUsForm").validate({
	rules: {
		first_name: {required:true},
		email_id: {required:true, email:true},
		contact_number:{required:true},
		message: {required:true},
		contact_us_purpose:{
			required:true,
			min:1,
			}
	},
	messages: {
		contact_us_purpose:{min:"This field is required"}
	}

});
});
