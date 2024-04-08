
$('document').ready(function()
{ 
     /* validation */
	 $("#forgot-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			verify_email: {
            required: true,
            email: true
            },
	   },
       messages:
	   {
            password:{
                      required: "please enter your password"
                     },
            user_email: "please enter your email address",
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#forgot-form").serialize();
			var test= $("#test").val();	
			$.ajax({
				
			type : 'POST',
			url  : 'src/forgot_model.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-forgot").html('<span ></span> Sending ..');
			},
			success :  function(response)
			   {						
					if(response=="1"){
									
						$("#btn-forgot").html('Sent');
                        // setTimeout(' window.location.href = "wallet/index"; ',2000);  
                        $("#error").fadeIn(1000, function(){
                            $("#error").html('<div class="alert alert-success">Email sent successfully! </div>');
                        });
                        }
					else{
									
						$("#error").fadeIn(1000, function(){						
				$("#error").html('<div class="alert alert-danger">'+response+' </div>');
											$("#btn-forgot").html('<span class="glyphicon glyphicon-log-in"></span>Send');
									});
			  		}
			  }
			});
				return false;
		}
	   /* login submit */
});