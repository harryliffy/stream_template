$('document').ready(function (e) {
	/* validation */
	$("#add-video-form").validate({
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
		var data = $("#add-video-form").serialize();
		//	var test= $("#callback").val();	
		e.preventDefault();
		$.ajax({

			
			url: 'src/add_video_model.php',
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$("#error").fadeOut();
				$("#btn-add").html('<span ></span> Sending ..');
			},
			success: function (response) {
				if (response == 'invalid') {
					$("#error").fadeIn(1000, function () {
						$("#error").html('<div class="alert alert-danger" role="alert"><strong>' + response + '</strong></div>');
						$("#btn-add").html('<span class="glyphicon glyphicon-log-in"></span>Login');
					});
					} else {
						$("#uploadStatus").html(response);
						// setTimeout(' window.location.href = "Dashboard.GettingStarted"; ', 2000);
					
				}
			},
			error: function(e)
			{
				 $("#uploadStatus").html(e);
			}
		});
		// return false;
	}
	/* login submit */
});