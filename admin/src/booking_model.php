<?php
    include ('functions.php');
    // $resource=trim($_POST['access-code']);
    $booking_type=trim($_POST['booking_type']);
    $booking_date=trim($_POST['booking_date']);
    $fullname=trim($_POST['fullname']);
    $user_email=trim($_POST['email']);
    $location=trim($_POST['location']);
    
    if ($resource==""){
        echo "Please enter valid access code";
    }else{
               $authenticate=new atwLive();
             $authenticate->video_access($resource);
    }

	 
?>