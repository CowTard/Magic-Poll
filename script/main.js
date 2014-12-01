
	function showRegister(){
		$('#login-form').hide();
		$('#register-form').show();
	};

	function showLogin(){
		$('#register-form').hide();
		$('#login-form').show();
	};


$(document).ready(function() {

	$(function() {
		showRegister();
	});

	$(function() {
		showLogin();
	});

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