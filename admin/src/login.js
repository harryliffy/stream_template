$('document').ready(function () {
	/* validation */
	$("#login-form").validate({
		rules: {
			password: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
		},
		messages: {
			password: {
				required: "please enter your password"
			},
			user_email: "please enter your email address",
		},
		submitHandler: submitForm
	});
	/* validation */

	/* login submit */
	function submitForm() {
		var data = $("#login-form").serialize();
		//	var test= $("#callback").val();	
		$.ajax({

			type: 'POST',
			url: 'src/login_model.php',
			data: data,
			beforeSend: function () {
				$("#error").fadeOut();
				$("#btn-login").html('<span ></span> Sending ..');
			},
			success: function (response) {
				if (response == "ok") {

					$("#btn-login").html('Processing');
					setTimeout(' window.location.href = "Dashboard.GettingStarted"; ', 2000);
				} else {
					$("#error").fadeIn(1000, function () {
						$("#error").html('<div class="alert alert-danger" role="alert"><strong>' + response + '</strong></div>');
						$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span>Login');
					});
				}
			}
		});
		// return false;
	}
	/* login submit */
});