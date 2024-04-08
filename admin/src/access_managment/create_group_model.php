<?php

	require_once ('../functions.php');
	if(isset($_POST['btn-group']))
	{
		$group_name = trim($_POST['group-name']);
        $video_id = trim($_POST['group-video']);
		$group_type =trim($_POST['group-type']);
		$salt= rand(3985758, 999867677484);
        $group_token = md5($salt);
		$created_date = Date('d-m-Y H:i:s');
		   
		try
		{		 
			$user = new atwLive();
			$user->add_access_group( $group_name, $video_id, $group_type, $group_token, $created_date);		
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>