<?php
 include ('functions.php');
 $pub_status=$_POST['pub_status'];
 $pub_date=$_POST['broadcast_date'];
 $video_title=$_POST['title'];
        $video_category=$_POST['category'];
        $video_description=$_POST['desc'];
        $video_url=$_POST['url'];
        $video_payment_type='payment_id';
        $salt1= Rand(62467537859,7472475625728539);
        $salt2=Rand(523524626,86867475757537357);
        $salt3=$salt1.$salt2;
        $video_token=md5($salt3);
        $created_date=Date('d M Y H:i:s');
        $video_id;
        $subdomain=$_POST['subdomain'];
        
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $path = 'data/'; // upload directory
    if($_FILES['image'])
    {
       

        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));  
        // can upload same image using rand function
        $final_image = time().$img;
        // check's valid format
        if(in_array($ext, $valid_extensions))
        {
            $paths = $path.strtolower($final_image);
            $video=new atwLive();
            $result=$video->add_Video($video_id, $video_title, $video_category, $video_description, $final_image,  $video_url, $video_payment_type, $video_token, $created_date,$pub_date, $pub_status, $subdomain);
 
        //  echo  $video_title;
        //  echo $video_category;
        //  echo $video_description;
        //  echo $video_token;
        if ($result){
            $video->create_dns($subdomain);
                            $link='src/'.$paths;
                            move_uploaded_file($tmp,$paths); // file upload
                            echo "<img width='150' src='$link' />";
        }else{
            echo 'error occured saving data';
        }
            
                
            
        }
        else
        {
            echo 'invalid';
        }
    }
?>