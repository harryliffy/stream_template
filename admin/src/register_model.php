<?php

	require_once ('functions.php');

	if(isset($_POST['btn-register']))
	{
		
		$user_name = trim($_POST['fullname']);
        $user_email = trim($_POST['email']);
		$user_username =trim($_POST['username']);
		$user_phone = trim($_POST['phone']);
		$status = rand(10000,999999);
		$user_password = trim($_POST['password']);
		$user_Amount = "0";
		$user_verify = "0";
		$salt= rand(3985758, 999867677484);
        $user_token = md5($salt);
		$user_code = rand(1000,9999);
		$createdate = Date('d-m-Y H:i:s');
		$user_id="";
    
		try
		{
		 
			$user = new user();
			$user->Register($user_id, $user_name, $user_email, $user_username, $user_phone, $user_password, $status,  $user_verify, $user_token, $createdate, $user_Amount);
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>