<?php
include('functions.php');
$video_token = $_POST['video_token'];
$user=new atwLive();
$output=$user->deleteVideoByToken($video_token);
if ($output){
    

    // echo $output;
    echo '<span class="alert alert-info" >Record deleted successfully.</span>';
} else {
    echo '<span class="alert alert-danger" >Error deleting record.</span>';
}
?>