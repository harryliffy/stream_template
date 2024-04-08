<?php
$reference=$_GET['token'];
require_once('admin/src/functions.php');
$core= new atwLive();
$core->update_video_logout($reference);



?>