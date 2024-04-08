
$('document').ready(function()
{ 

	var link= "";
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			user_email: {
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
			var data = $("#login-form").serialize();
			var test= $("#test").val();	
			$.ajax({
				
			type : 'POST',
			url  : 'src/verify_model.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<span ></span> Sending ..');
			},
			success :  function(response)
			   {						
					if(response=="1"){
									
						$("#btn-login").html('Processing');
						setTimeout(' window.location.href = "'+link+'"; ',2000);   
					}
					else{
									
						$("#error").fadeIn(1000, function(){						
							$("#error").html('<div class="alert alert-notice" role="alert"><div class="alert-icon"><svg class="woox-icon icon-notification"><use xlink:href="#icon-notification"></use></svg></div><strong>'+ response +'</strong><a href="#" class="icon-close"><svg class="woox-icon icon-del"><use xlink:href="#icon-close-cross"></use></svg></a></div>');
							$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span>Login');
									});
			  		}
			  }
			});
				return false;
		}
	   /* login submit */
});