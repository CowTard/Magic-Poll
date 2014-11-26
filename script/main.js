$(document).ready(function() {
	$('#register-form').hide();
	
	$('#register-link').click(function() {
		$('#login-form').hide();
		$('#register-form').show();
	});
	
	$('#login-link').click(function() {
		$('#register-form').hide();
		$('#login-form').show();
	});
});
