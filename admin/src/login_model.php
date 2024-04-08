<?php
    include ('functions.php');
	$varUsername=trim($_POST['email']);
$varPassword=trim($_POST['password']);
// check and snitise input
// echo $varUsername;
     $authenticate=new atwLive();
     $authenticate->Login($varUsername, $varPassword);

	 
?>