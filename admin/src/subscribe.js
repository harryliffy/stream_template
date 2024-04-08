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
			url: 'https://atwlive.com/admin/src/subscribe_model.php',
			data: data,
			beforeSend: function () {
				$("#error").fadeOut();
				$("#btn-login").html('<span ></span> Sending ..');
			},   
			success: function (response) {
				if (response=="This email has already subscribed! Click the play to watch"){
					$("#form-in4").show();
				}
				if (response == "ok") {
					$("#form-in4").show();
					$("#btn-login").html('Processing');
					$("#form-in").hide();
					$("#form-in1").hide();
					$("#form-in2").hide();
					$("#form-in3").hide();
					$("#error").fadeIn(1000, function () {
						$("#error").html('<div class="alert alert-danger" style="text-align: -webkit-center;" role="alert"><div ><img width="140px" src="https://cdn2.iconfinder.com/data/icons/weby-flat-vol-1/512/1_Approved-check-checkbox-confirm-green-success-tick-512.png" /><br><b>Subscription Succesful.</b> Watch for free using your phone number or email as passcode. Enjoy<br></div></div>');
						$("#btn-watch").html('<p>Click the play button to watch.</p>');
					});
					
					
					// setTimeout(' window.location.href = "Dashboard.GettingStarted"; ', 2000);
				} else {
					$("#error").fadeIn(1000, function () {
						$("#error").html('<div class="alert alert-danger" role="alert"><strong>' + response + '</strong></div>');
						$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span>Continue');  
					});
				}
			}
		});
		// return false;
	}
	/* login submit */
});