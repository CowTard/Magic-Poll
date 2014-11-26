$(document).ready(function() {
	$('#registerform').hide();
	
	$('#register-link').click(function() {
		$('#loginform').hide();
		$('#registerform').show();
	});
	
	$('#login-link').click(function() {
		$('#registerform').hide();
		$('#loginform').show();
	});
});
