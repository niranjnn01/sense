$(document).ready(function(){
$( "#datepicker" ).datepicker(
	{
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange : "-100:-5"
	}
);
});
