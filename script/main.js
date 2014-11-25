$(document).ready(function() {
	$('#registerform').hide();
	document.getElementById('registerform').onclick = hideLoginForm;
	$('#loginlink').onclick = hideRegisterForm;
});

function hideRegisterForm() {
alert('ola');
	$('#registerform').hide();
	$('#loginform').show();
}

function hideLoginForm() {
	$('#loginform').hide();
	$('#registerform').show();
}
