<?php
	// session_start();
	require_once 'functions.php';

	if(isset($_POST['btn-login']))
	{
		$reference=$_SESSION['bitbank_sess_logon_id'];
		
	//	$user_email = trim($_POST['email']);
			$code = trim($_POST['verify_email']);

		
		try
		{	
		$core=new User();
	    $core->verify($reference, $code);
			
		
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}else{
		echo 'permission required';
	}

?>