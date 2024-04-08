<?php
    include ('functions.php');
    $resource=trim($_POST['access-code']);
    if ($resource==""){
        echo "Please enter a valid access code";
    }else{
               $authenticate=new atwLive();
             $authenticate->video_access($resource); // instant ticket
            //  $authenticate-> subscribers_access($resource); // subscribers ticket
    }

	 
?>