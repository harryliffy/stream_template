$('document').ready(function () {
	/* validation */
	$("#access-group").validate({
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
		var data = $("#access-group").serialize();
		//	var test= $("#callback").val();	
		$.ajax({

			type: 'POST',
			url: 'src/access_managment/create_group_model.php',
			data: data,
			beforeSend: function () {
				$("#error").fadeOut();
				$("#btn-group").html('<span ></span> Sending ..');
			},
			success: function (response) {
				if (response == "1") {

					$("#btn-group").html('Saved');
					$("#error").fadeIn(1000, function () {
						$("#error").html('<div class="alert alert-success" role="alert"><strong>Access group created successful</strong></div>');
						$("#btn-group").html('<span class="glyphicon glyphicon-log-in"></span>Login');
					});
					// setTimeout(' window.location.href = "Dashboard.GettingStarted"; ', 2000);
				} else {
					$("#error").fadeIn(1000, function () {
						$("#error").html('<div class="alert alert-danger" role="alert"><strong>' + response + '</strong></div>');
						$("#btn-group").html('<span class="glyphicon glyphicon-log-in"></span>Login');
					});
				}
			}
		});
		// return false;
	}
	/* login submit */
});