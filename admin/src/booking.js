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
			user_email: "please enter ticket passcode",
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
			url: '../admin/src/booking_model.php',
			data: data,
			beforeSend: function () {
				$("#result").fadeOut();
				$("#btn-login").html('<img src="../admin/src/loader.gif" width="38" />');
			},
			success: function (response) {
				if (response == "ok") {
	
					// $("#openMyPopup").click();
					// $('#login-form').trigger("reset");
					// $("#btn-login").html('Watch <i class="lni lni-play"></i>');
					// $("#btn-login").html('Processing');
					// setTimeout(' window.location.href = "Dashboard.GettingStarted"; ', 2000);
				} else {
					$("#result").fadeIn(1000, function () {
						$("#result").html('<div class="col-md-4 alert alert-danger" role="alert"><strong>' + response + '</strong></div>');
						$("#btn-login").html('Watch <i class="lni lni-play"></i>'); 
					$("#result").fadeOut(5000);
					});
				}
			}
		});
		// return false;
	}
	/* login submit */
});