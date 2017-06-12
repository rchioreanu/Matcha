"use strict";

function checkPassword (passwd) {
	var small = /[a-z]/
	var capital = /[A-Z]/
	var num = /[0-9]/

	if (passwd.length < 8)
		return false;
	if (!small.test(passwd))
		return false;
	if (!capital.test(passwd))
		return false;
	if (!num.test(passwd))
		return false;
	return true;
}

$("#bdate").change(function () {
	var date = $("#bdate").val();
	var bdate = new Date(date);
	var today = new Date();
	var age = Math.floor((today-bdate) / (365.25 * 24 * 60 * 60 * 1000));

	if (age < 18) {
		$("#alert").html('<div class = "alert error">You have to be over 18 to sign up!</div>');
		$("#alert").css('color', 'red');
		$("#submit").prop('disabled', true);
	}
	else {
		$("#alert").html('');
		$("#submit").prop('disabled', false);
	}
});

$("#email").change(function () {
	var email = $("#email").val();
	var patt = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;

	if (!patt.test(email)) {
		$("#emailAlert").html('<div class = "alert error">The email is not valid</div>');
		$("#emailAlert").css('color', 'red');
		$("#submit").prop('disabled', true);
	}
	else {
		$("#emailAlert").html('');
		$("#submit").prop('disabled', false);
	}
});

$("#remail").change(function () {
	var email = $("#email").val();
	var remail = $("#remail").val();

	if (email != remail) {
		$("#remailAlert").html('<div class = "alert error">The email addresses differ</div>');
		$("#remailAlert").css('color', 'red');
		$("#submit").prop('disabled', true);
	}
	else {
		$("#remailAlert").html('');
		$("#submit").prop('disabled', false);
	}
});

$("#psw").change(function () {
	var psw = $("#psw").val();

	if (!checkPassword(psw)) {
		$("#pswAlert").html('<div class = "alert error">The password must contain small, capital letters and numbers</div>');
		$("#pswAlert").css('color', 'red');
		$("#submit").prop('disabled', true);
	}
	else {
		$("#pswAlert").html('');
		$("#submit").prop('disabled', false);
	}
});

$("#rpsw").change(function () {
	var psw = $("#psw").val();
	var rpsw = $("#rpsw").val();

	if (psw != rpsw) {
		$("#rpswAlert").html('<div class = "alert error">The passwords do not match</div>');
		$("#rpswAlert").css('color', 'red');
		$("#submit").prop('disabled', true);
	}
	else {
		$("#rpswAlert").html('');
		$("#submit").prop('disabled', false);
	}
});

$(function () {
	$("bdate").datepicker({
		dateFormat: 'mm/dd/yyy'
	});
});
