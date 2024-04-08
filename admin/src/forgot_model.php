<?php
	// session_start();
	require_once 'functions.php';

	if(isset($_POST['btn-forgot']))
	{
		
		$user_email = trim($_POST['verify_email']);
		//	$password = trim($_POST['password']);

		
		try
		{	
		$core=new User();  
	   $output= $core->email_exist($user_email);
			if ($output){
                $data=$core->email_fetch($user_email);
                $fullname=$data['user_fullname'];
                $token=$data['user_token'];
                $usercode=$data['user_username'];

               $mailing= $core->password_reset_email($user_email, $fullname, $token, $usercode);
                // echo "1";  
                if ($mailing){
                    echo '1';
                } 
            }else{
                echo 'No account with this email found';
            }
		
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}else{
		echo 'Access permission required';
	}

?>