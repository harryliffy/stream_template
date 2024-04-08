<?php
    include ('functions.php');
	$email=trim($_POST['email']);
$phone=trim($_POST['phone']);



$collector_phone =trim($_POST['phone']);
        $string = str_replace(' ', '', $collector_phone);
        $country_dial_code =trim($_POST['country_dial_code']);
        $phone_number=$country_dial_code.$string;
  
// check and snitise input
// echo $varUsername;
     $authenticate=new atwLive();
     $authenticate-> subscribe( $email, $phone_number );

    // echo $varUsername.$phone; 

	 
?>