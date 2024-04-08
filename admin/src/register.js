
$('document').ready(function()
{ 
	var link= "";
     /* validation */
	 $("#register-form").validate({  
      rules:
	  {
			fullname: {
			required: true,
			},
			email: {
            required: true,
            email: true
            },
            terms: {
                required: true,
                },
	   },
       messages:
	   {
            fullname:"please enter your Fullname",
            email: "please enter your email address",
            terms: "you must accept conditions to continue",
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#register-form").serialize();	
			$.ajax({
				
			type : 'POST',
			url  : 'src/register_model.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-register").html('<span ></span> Sending ..');
			},
			success :  function(response)
			   {						
					if(response=="1"){
									
						$("#btn-register").html('Please wait');
						setTimeout(' window.location.href = "'+link+'"; ',2000);
					}
					else{
									
						$("#error").fadeIn(1000, function(){						
				$("#error").html('<div class="alert alert-notice" role="alert"><div class="alert-icon"><svg class="woox-icon icon-notification"><use xlink:href="#icon-notification"></use></svg></div><strong>Message!</strong>'+ response +'<a href="#" class="icon-close"><svg class="woox-icon icon-del"><use xlink:href="#icon-close-cross"></use></svg></a></div>');
											$("#btn-register").html('<span class="glyphicon glyphicon-log-in"></span> Signup');
									});
			  		}
			  }
			});
				return false;
		}
	   /* login submit */
});