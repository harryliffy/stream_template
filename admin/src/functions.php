<?php
 session_start();
    include('database.php'); 

    class analytics{  // Analytics

      protected $now;
      protected $DBconnect;
      public function __construct(){
      $databases= new Database();
      $dbs=$databases->db_con;
      $this->DBconns=$dbs;
              }

    Public function VideoCount(){

    }


            } // Analytics 


    class atwLive{

      protected $now;
      protected $DBconnect;
      public function __construct(){
      $database= new Database();
      $db=$database->db_con;
      $this->DBconn=$db;
              }


              public function test($email){
                $email_check=$this->DBconn->prepare("SELECT * FROM atwlivetw_admin WHERE admin_email=:uref");
                $email_check->execute(array(":uref"=>$email));
                $count=$email_check->rowCount();
                $query=$email_check->fetch(PDO::FETCH_ASSOC);
                if ($count > 0){
              //		return true;  // email exist
              echo $query['admin_name'].' User Count '.$count;
                  // $this->update_email_status($reference);
                }else{
                //	return false;  // email does not exist
            echo "error occured";
            
                }

              }
// CGMI FORM




// Checking tickets
              public function video_access($resource){
                $sess="";
                $email_check=$this->DBconn->prepare("SELECT * FROM instant_ticket WHERE passcode=:uref");
                $email_check->execute(array(":uref"=>$resource));
                $count=$email_check->rowCount();
                $query=$email_check->fetch(PDO::FETCH_ASSOC);
                if ($count > 0){

                  // if ($query['login_session']=="logged_in"){
                  //     echo 'ticket already logged in';
                  // }else{
                      echo "ok";   
                    $this->update_video_login($resource);   /// new page
                  // }
              //		return true;  // email exist
           
                  // $this->update_email_status($reference);
                }else{
                //	return false;  // email does not exist
            echo "Wrong/invalid passcode";
            
                }

              }


// Checking subscribers
public function subscribers_access($resource){
  $sess="";
  $email_check=$this->DBconn->prepare("SELECT * FROM subscribers WHERE email=:uref OR phone=:uref");
  $email_check->execute(array(":uref"=>$resource));
  $count=$email_check->rowCount();
  $query=$email_check->fetch(PDO::FETCH_ASSOC);
  if ($count > 0){
    $_SESSION['ATW_sub_free'] = $resource;
        echo "ok";   
      
  }else{
  //	return false;  // email does not exist
echo "wrong passcode, use email/phone no. after subscribing";

  }

}
//sub functions




#### // Update email verificationstatus
public function update_video_login($reference) { 
  $status="logged_in";
  
      //Our UPDATE SQL statement.
               $sql = "UPDATE `instant_ticket` SET `login_session` = :ustatus WHERE passcode = :token";
               //Prepare our UPDATE SQL statement.
               
               $statement = $this->DBconn->prepare($sql);
                $statement->bindValue(':token', $reference);    //Bind our value to the parameter :id.
               $statement->bindValue(':ustatus', $status);  //Bind our :model parameter.
               $update = $statement->execute();    //Execute our UPDATE statement.
               if ($update){
              //     echo "1";
               }
              //  else{
              //    echo "account verification failed";
              //  }
  }
   // end 6.3
  
   #### // Update email verificationstatus
public function update_video_logout($reference) { 
  $status="";
  
      //Our UPDATE SQL statement.
               $sql = "UPDATE `instant_ticket` SET `login_session` = :ustatus WHERE passcode = :token";
               //Prepare our UPDATE SQL statement.
               
               $statement = $this->DBconn->prepare($sql);
                $statement->bindValue(':token', $reference);    //Bind our value to the parameter :id.
               $statement->bindValue(':ustatus', $status);  //Bind our :model parameter.
               $update = $statement->execute();    //Execute our UPDATE statement.
               if ($update){
              //     echo "1";
               }
              //  else{
              //    echo "account verification failed";
              //  }
  }
   // end 6.3
  

// ADD subscribers
public function subscribe( $email, $phone ){
  $salt=Date("d-m-Y h:i:s")."7578586996";
  $sub_token=md5($salt);
   $created_date=Date("d-m-Y");
  $query="SELECT * FROM subscribers WHERE email=:uref"; 
  $check=$this->item_exist($query, $email);
if ($check){ // check if email already exist
  echo 'This email has already subscribed! Click the play to watch';  
 
}else{
$stmt = $this->DBconn->prepare("INSERT INTO subscribers( email, phone, token, sub_date )
VALUES(:uemail, :uphone, :utoken, :usub_date)");
 

 $stmt ->bindParam(':uemail', $email);
 $stmt ->bindParam(':uphone', $phone);
 $stmt ->bindParam(':utoken', $sub_token);
 $stmt ->bindParam(':usub_date', $created_date);
$output= $stmt->execute();	      
// If execute is true
 if($output){   
      // if access group is registered logg
echo 'ok';
  }
else{
  
  echo "An error occured subscribing.Try again"; // wrong details 
  }
} //end email check

}
//// End subsccribers



        public function addActive($tabId, $tabId2){  /// get started pagee

          echo '<script>
             var element = document.getElementById("'.$tabId.'");
             element.classList.add("active");
             var element = document.getElementById("'.$tabId2.'");
             element.classList.add("active");
             
          </script>';
      
      }


      public function navigation($tabId){

        echo '<script>
           var element = document.getElementById("'.$tabId.'");
           element.classList.add("current-menu-item");
           
        </script>';
        
        }
// ******************item exist*************** */

public function item_exist($query, $text){
	try{
		$email_check=$this->DBconn->prepare($query);
		$email_check->execute(array(":uref"=>$text));
		$count=$email_check->rowCount();
		$query=$email_check->fetch(PDO::FETCH_ASSOC);
		if ($count > 0){
			return true;  // item exist
		}else{
			return false;  // email does not exist
		}
	}catch(PDOException $exception){
		echo 'item exist error:'.$exception->getMessage();
	}
}
// *********** End check if email adreess exist**** */


  // ******************check verification code*************** */

public function verify($reference, $code){
	try{
		$email_check=$this->DBconn->prepare("SELECT * FROM users WHERE user_token=:uref AND user_status=:ucode");
		$email_check->execute(array(":uref"=>$reference, ":ucode"=>$code));
		$count=$email_check->rowCount();
		$query=$email_check->fetch(PDO::FETCH_ASSOC);
		if ($count > 0){
	//		return true;  // email exist
      $this->update_email_status($reference);
		}else{
		//	return false;  // email does not exist
echo "wrong verification code";

		}
	}catch(PDOException $exception){
		echo 'email exist function error:'.$exception->getMessage();
	}
}
// *********** check verification code**** */

// ******************check if email adreess exist*************** */

public function email_exist($email_ref){
	try{
		$email_check=$this->DBconn->prepare("SELECT * FROM atwlivetw_admin WHERE admin_email=:uref");
		$email_check->execute(array(":uref"=>$email_ref));
		$count=$email_check->rowCount();
		$query=$email_check->fetch(PDO::FETCH_ASSOC);
		if ($count > 0){
		//	return true;  // email exist
    echo "exist";
		}else{
		//	return false;  // email does not exist
    echo "email does not exist";
		}
	}catch(PDOException $exception){
		echo 'email exist function error:'.$exception->getMessage();
	}
}
// *********** End check if email adreess exist**** */


// ******************check if video url exist*************** */

public function video_url_exist($video_ref){
	try{
		$email_check=$this->DBconn->prepare("SELECT * FROM atwlivetw_video WHERE video_url=:uref");
		$email_check->execute(array(":uref"=>$video_ref));
		$count=$email_check->rowCount();
		$query=$email_check->fetch(PDO::FETCH_ASSOC);
		if ($count > 0){
			return true;  // email exist
   // echo "exist";
		}else{
			return false;  // email does not exist
   // echo "email does not exist";
		}
	}catch(PDOException $exception){
		echo 'email exist function error:'.$exception->getMessage();
	}
}
// *********** End check if email adreess exist**** */
        //******End user exist */

        Public function is_logged($auth_token){  // User Token authenticate function
          $stmtlog = $this->DBconn->prepare("SELECT * FROM atwlivetw_admin WHERE admin_token=:authT");
          $stmtlog->execute(array(":authT"=>$auth_token));
          $rowlog = $stmtlog->fetch(PDO::FETCH_ASSOC);
          $countlog = $stmtlog->rowCount();
          if ($countlog > 0){
            return $rowlog;
          }else{
            return false;
          } 
      
        }

        // ******************Fetch details by email for emailing*************** */

public function email_fetch($email_ref){
	try{
		$email_check=$this->DBconn->prepare("SELECT * FROM users WHERE user_email=:uref");
		$email_check->execute(array(":uref"=>$email_ref));
		$count=$email_check->rowCount();
		$query=$email_check->fetch(PDO::FETCH_ASSOC);
		if ($count > 0){
			return $query;  // email exist
		}else{
			return 'no data';  // email does not exist
		}
	}catch(PDOException $exception){
		echo 'email exist function error:'.$exception->getMessage();
	}
}
// *********** Fetch details by email for emailing**** */

        //**********login */
        public function Login($username, $password){  //Vendor Login authentication
     
			$stmt = $this->DBconn->prepare("SELECT * FROM atwlivetw_admin WHERE admin_email=:email and admin_password	=:upassword");
			$stmt->execute(array(":email"=>$username, ":upassword"=>$password));
			$count = $stmt->rowCount();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			// echo $count;
		if ($count > 0){
				// echo "user found";
       
			$_SESSION['adminAuthToken'] = $row['admin_token'];
		 	$_SESSION['adminName'] = $row['admin_name'];
		 	$_SESSION['adminEmailToken'] = $row['admin_email'];
        $result="ok";
				 echo $result; // log in;
			}else{  
				echo "Login failed, wrong credentials."; // wrong details 
			}
	
    } // End login function


    // list video in dropdown options
    public function video_options_list(){
    
        $stmt = $this->DBconn->prepare("SELECT * FROM atwlivetw_video");
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0 ){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
          
            $video_token=$row['video_token'];
            $video_title=$row['video_title'];
            $video_image=$row['video_image'];
            

            echo '  <option value="'.$video_token.'"><img src="data/'.$video_image.'" />'.$video_title.'</option>';
          }
                }else{
          echo ' <option disabled value="">No videos found</option>';
        }
       
    }
// list video in dropdown options

    // list video details
public function library_detail($video_token){
	try{
		$email_check=$this->DBconn->prepare("SELECT * FROM atwlivetw_video WHERE video_token=:uref");
		$email_check->execute(array(":uref"=>$video_token));
		$count=$email_check->rowCount();
		$query=$email_check->fetch(PDO::FETCH_ASSOC);
		if ($count > 0){
			return $query;  // email exist
		}else{
			return 'no data';  // email does not exist
		}
	}catch(PDOException $exception){
		echo 'Library details error:'.$exception->getMessage();
	}
}
// video details


    // list paid users
    public function payment_list(){
    
      $stmt = $this->DBconn->prepare("SELECT * FROM instant_ticket");
      $stmt->execute();
      $count = $stmt->rowCount();
      if ($count > 0 ){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
        
          $fullname=$row['fullname'];
          $email=$row['email'];
          $phone=$row['phone'];

          $passcode=$row['passcode'];
          $pay_ref=$row['payment_ref'];
          // $phone=$row['phone'];
          if (strpos($pay_ref, "paystack") !== false) {
           
            $currency="N5,000";
            // echo "Naira";
        } elseif (strpos($pay_ref, "cs_live") !== false) {
          $currency="$5.00";
            // echo "Dollar";
        } else {
          $currency="Generated";
      }
          

          echo '<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
          <div class="row g-0 h-100 align-content-center">
              <div
                  class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
                  <div class="text-muted text-small d-md-none">Name</div>
                  <div class="text-alternate">'.$fullname.' <small class="text-muted text-small">'.$phone.'</small></div>
              </div>
              <div
                  class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
                  <div class="text-muted text-small d-md-none">Amount</div>
                  <div class="text-alternate">'.$currency.' - <b>'.$passcode.'</b></div>
              </div>
              <div
                  class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
                  <div class="text-muted text-small d-md-none">Email</div>
                  <div class="text-alternate">'.$email.'</div>
              </div>
              <div
                  class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
                  <a class="link" href="#">
                      <i data-acorn-icon="download"></i>
                  </a>
              </div>
          </div>
      </div>';
        }
              }else{
        echo ' <span>No details found</span>';
      }
     
  }
// list paid users
// ############################


    // list paid users
    public function payment_list_v(){
    
      $stmt = $this->DBconn->prepare("SELECT * FROM instant_ticket_vafrica");
      $stmt->execute();
      $count = $stmt->rowCount();
      if ($count > 0 ){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
        
          $fullname=$row['fullname'];
          $email=$row['email'];
          $phone=$row['phone'];

          $passcode=$row['passcode'];
          $pay_ref=$row['payment_ref'];
          // $phone=$row['phone'];
          if (strpos($pay_ref, "paystack") !== false) {
           
            $currency="N5,000";
            // echo "Naira";
        } elseif (strpos($pay_ref, "cs_live") !== false) {
          $currency="$5.00";
            // echo "Dollar";
        } else {
          $currency="Generated";
      }
          

          echo '<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
          <div class="row g-0 h-100 align-content-center">
              <div
                  class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
                  <div class="text-muted text-small d-md-none">Name</div>
                  <div class="text-alternate">'.$fullname.' <small class="text-muted text-small">'.$phone.'</small></div>
              </div>
              <div
                  class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
                  <div class="text-muted text-small d-md-none">Amount</div>
                  <div class="text-alternate"> <b>'.$passcode.'</b></div>
              </div>
              <div
                  class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
                  <div class="text-muted text-small d-md-none">Email</div>
                  <div class="text-alternate">'.$email.'</div>
              </div>
              <div
                  class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
                  <a class="link" href="#">
                      <i data-acorn-icon="download"></i>
                  </a>
              </div>
          </div>
      </div>';
        }
              }else{
        echo ' <span>No details found</span>';
      }
     
  }
// list paid users

// #############################

//// Add video resource

public function add_Video($video_id, $video_title, $video_category, $video_description, $video_image, $video_url, $video_payment_type, $video_token, $created_date, $pub_date, $pub_status, $subdomain){
	$stmt = $this->DBconn->prepare("INSERT INTO atwlivetw_video (video_title, video_category, video_description, video_image, video_url, video_payment_type, video_token, created_date, video_pub_date, video_status, video_subdomain )
			VALUES( :video_title, :video_category, :video_description, :video_image, :video_url, :video_payment_type, :video_token, :created_date, :video_pub_date, :video_status, :subdomain)");
		   
		   $stmt ->bindParam(':video_title', $video_title);
		   $stmt ->bindParam(':video_category', $video_category);
           $stmt ->bindParam(':video_description', $video_description);
           $stmt ->bindParam(':video_image', $video_image);
         $stmt ->bindParam(':video_url', $video_url);
           $stmt ->bindParam(':video_payment_type', $video_payment_type);
		 $stmt ->bindParam(':video_token', $video_token);
     $stmt ->bindParam(':created_date', $created_date);
		   $stmt ->bindParam(':video_pub_date', $pub_date);
       $stmt ->bindParam(':video_status', $pub_status);
       $stmt ->bindParam(':subdomain', $subdomain);
       
		  $output= $stmt->execute();  
		   // return true;	
		
			// If execute is true
			 if($output){ 
return true;
}else{
  return false;
}
}
    

//// Add video resource
###############################


// ######### Edit Video
public function edit_Video($video_token, $video_title, $video_category, $video_description, $video_image, $video_url, $video_payment_type, $created_date, $pub_date, $pub_status) {
  $stmt = $this->DBconn->prepare("UPDATE atwlivetw_video 
                                  SET video_title = :video_title, 
                                      video_category = :video_category, 
                                      video_description = :video_description, 
                                      video_image = :video_image, 
                                      video_url = :video_url, 
                                      video_payment_type = :video_payment_type, 
                                      created_date = :created_date, 
                                      video_pub_date = :video_pub_date, 
                                      video_status = :video_status 
                                  WHERE video_token = :video_token");
 
  $stmt->bindParam(':video_token', $video_token);
  $stmt->bindParam(':video_title', $video_title);
  $stmt->bindParam(':video_category', $video_category);
  $stmt->bindParam(':video_description', $video_description);
  $stmt->bindParam(':video_image', $video_image);
  $stmt->bindParam(':video_url', $video_url);
  $stmt->bindParam(':video_payment_type', $video_payment_type);
  $stmt->bindParam(':created_date', $created_date);
  $stmt->bindParam(':video_pub_date', $pub_date);
  $stmt->bindParam(':video_status', $pub_status);
  
  $output = $stmt->execute();

  // If execute is true
  if ($output) { 
      echo 'good';
  } else {
      echo 'bad';
  }
}



// ##### End Edit video


// Delete Video
public function deleteVideoByToken($video_token) {
  // Prepare the SQL statement to fetch the file name
  $stmt_select = $this->DBconn->prepare("SELECT video_image FROM atwlivetw_video WHERE video_token = :video_token");
  $stmt_select->bindParam(':video_token', $video_token);
  $stmt_select->execute();

  // Fetch the file name from the database
  $file_row = $stmt_select->fetch(PDO::FETCH_ASSOC);
  $filename = $file_row['video_image'];

  // Delete the record from the database
  $stmt_delete = $this->DBconn->prepare("DELETE FROM atwlivetw_video WHERE video_token = :video_token");
  $stmt_delete->bindParam(':video_token', $video_token);
  $output = $stmt_delete->execute();

  // Check if the deletion was successful
  if ($output) {
      // Delete the file from the folder
      $file_path = __DIR__ . '/data/' . $filename; // Construct file path
      if (file_exists($file_path)) {
          unlink($file_path); // Delete the file
      }
      return true; // Return true if deletion is successful
  } else {
      return false; // Return false if deletion fails
  }
}

// delete Video

//// Add Booking resource

       public function add_Booking($booking_id, $booking_name, $booking_email, $booking_phone, $booking_date, $booking_type, $booking_location, $booking_status, $booking_token, $created_date){
	    $stmt = $this->DBconn->prepare("INSERT INTO atwlivetw_request (request_id, request_name, request_email, request_phone, request_date, request_type, request_location, request_status, request_token, created_date)
			VALUES( :urequest_id, :urequest_name, :urequest_email, :urequest_phone, :urequest_date, :urequest_type, :urequest_location, :urequest_status, :urequest_token, :ucreated_date)");
		   
		   $stmt ->bindParam(':urequest_name', $booking_name);
		   $stmt ->bindParam(':urequest_email', $booking_email);
       $stmt ->bindParam(':urequest_phone', $booking_phone);
       $stmt ->bindParam(':urequest_date', $booking_date);
       $stmt ->bindParam(':urequest_type', $booking_type);
       $stmt ->bindParam(':urequest_location', $booking_location);
		  $stmt ->bindParam(':urequest_status', $booking_status);
      $stmt ->bindParam(':ucreated_date', $created_date);
		   $stmt ->bindParam(':urequest_id', $booking_id);
		  $output= $stmt->execute();  
		   // return true;	
		
			// If execute is true
			 if($output){ 
echo 'good';
}else{
  echo 'bad';
}
}

//// Add Booking resource
###############################

//
////Registration for user 

public function Register($user_id, $user_name, $user_email, $user_username, $user_phone,  $user_password, $status,$user_verify, $user_token, $createdate, $user_Amount){
    $check=$this->email_exist($user_email);
	if ($check){ // check if email already exist
		echo 'An account with this email already exist!';
	}else{
	$stmt = $this->DBconn->prepare("INSERT INTO users( user_fullname, user_email, user_username, user_phone, user_password, user_status, user_verify, user_token, user_date, user_amount )
	VALUES(:uuser_name, :uuser_email, :uuser_username, :uuser_phone, :uuser_password, :uuser_status, :uuser_verify, :uuser_token, :ucreated_date, :uuser_amount)");
   
   $stmt ->bindParam(':uuser_name', $user_name);
   $stmt ->bindParam(':uuser_email', $user_email);
   $stmt ->bindParam(':uuser_username', $user_username);
   $stmt ->bindParam(':uuser_phone', $user_phone);
   $stmt ->bindParam(':uuser_status', $status);
   $stmt ->bindParam(':uuser_password', $user_password);
   $stmt ->bindParam(':uuser_verify', $user_verify);
   $stmt ->bindParam(':uuser_token', $user_token);
  // $stmt ->bindParam(':uuser_code', $user_code);
   $stmt ->bindParam(':ucreated_date', $createdate);
   $stmt ->bindParam(':uuser_amount', $user_Amount);

   //$stmt ->bindParam(':uuser_id', $user_id);
  $output= $stmt->execute();	      
	// If execute is true
	 if($output){   
        // if user is registered logg user in
      //  $this->verification_email($user_email, $user_name, $user_token, $user_username);  // send mail to address
		$this->Login($user_email, $user_password); 
		}
	else{
		
		echo "Error occured, signup failed.!"; // wrong details 
    }
 } //end email check

}
//// End registration
###############################


############### SEND TICKET EMAIL ##################
// 6.1 TIcket  email
public function send_ticket_email($user_email, $fullname, $token, $usercode, $date){

$host = "atwlive.com"; //replace this with your domain's SMTP address
$username = "tickets@atwlive.com";
$passwords = "v87ggXZwiPC";
$port="465";

$to = $user_email; 
$subject = "Ticket Purchase Confirmation";


$headers = "MIME-Version: 1.0\n";  
     $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n"; 
     $headers .= "X-Priority: 1 (Highest)\n"; 
     $headers .= "X-MSMail-Priority: High\n"; 
     $headers .= "Importance: High\n";
$headers .= 'From: Advanced Teamworks Ltd <tickets@atwlive.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

// header section and info ends

//messgae section starts from here

$message = '
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        @media only screen and (max-width: 620px) {
            table.body h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table.body p,
            table.body ul,
            table.body ol,
            table.body td,
            table.body span,
            table.body a {
                font-size: 16px !important;
            }

            table.body .wrapper,
            table.body .article {
                padding: 10px !important;
            }

            table.body .content {
                padding: 0 !important;
            }

            table.body .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table.body .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table.body .btn table {
                width: 100% !important;
            }

            table.body .btn a {
                width: 100% !important;
            }

            table.body .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }

            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }

            .btn-primary table td:hover {
                background-color: #34495e !important;
            }

            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }
    </style>
</head>

<body
    style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader"
        style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Lets
        Be Honest By Dike Chukwumerije Ticket Purchase Successfull.</span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body"
        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;"
        width="100%" bgcolor="#f6f6f6">
        <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
            <td class="container"
                style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;"
                width="580" valign="top">
                <div class="content"
                    style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main"
                        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;"
                        width="100%">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper"
                                style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;"
                                valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                    style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;"
                                    width="100%">
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"
                                            valign="top">
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                                Hi '.$fullname.',</p>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                                Thank you for purchasing Let\'s Be Honest By Dike Chukwumerije Ticket .
                                                We\'re thrilled to have you join us for this exciting experience!</p>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                                Below are the details of your purchase:</p>
                                            <p>Passcode: </p>
                                            <h1>'.$usercode.'</h1>
                                            <p>Event Name: Let\'s Be Honest By Dike Chukwumerije Ticket</p>
                                            <p>Date: 14 Feb. 2024</p>
                                            <p>Time: 7:00 PM</p>
                                            <p>Streaming Platform: <a href="https://atwlive.com">Atwlive.com</a></p>
                                            <p>Ticket Type: Online Streaming</p>



                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                                class="btn btn-primary"
                                                style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%;"
                                                width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td align="left"
                                                            style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;"
                                                            valign="top">
                                                            <table role="presentation" border="0" cellpadding="0"
                                                                cellspacing="0"
                                                                style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #3498db;"
                                                                            valign="top" align="center"
                                                                            bgcolor="#3498db"> <a
                                                                                href="#"
                                                                                style="border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #3498db; border-color: #3498db; color: #ffffff;">'.$usercode.'</a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                                Your streaming ticket is confirmed, and you re all set to enjoy the
                                                event from the comfort of your own home.


                                            </p>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                                If you have any questions or concerns regarding your purchase, feel free
                                                to reply to this email or contact our customer support team at <b>+234
                                                    913 709 3183</b>.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->

                    <!-- START FOOTER -->
                    <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                            style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;"
                            width="100%">
                            <tr>
                                <td class="content-block"
                                    style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;"
                                    valign="top" align="center">
                                    <span class="apple-link"
                                        style="color: #999999; font-size: 12px; text-align: center;">Adavanced Teamworks Sani Abacha Way,
                                        beside FCDA/NTA HQ, Central Business Dis, Abuja,  Nigeria</span>
                                    <br> Dont like these emails? <a href="http://i.imgur.com/CScmqnj.gif"
                                        style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">Unsubscribe</a>.
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block powered-by"
                                    style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;"
                                    valign="top" align="center">
                                    Powered by <a href="https://atwlive.com"
                                        style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">HTMLemail</a>.
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- END FOOTER -->

                </div>
            </td>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        </tr>
    </table>
</body>

</html>';
$message.='';
// echo $message;
if (mail($to,$subject, $message, $headers, '-ftickets@atwlive.com')){
// echo "mail sent successful";

}else{
  // echo "mail send failed";
}

}
// 6.1 end sign up email

############### SEND TICKET EMAIL #############


########## ACCESS MANAGEMENT

// ADD VIDEO ACCESS GROUP
public function add_access_group( $group_name, $video_id, $group_type, $group_token, $created_date){
  $query="SELECT * FROM access_group WHERE group_name=:uref"; 
  $check=$this->item_exist($query, $group_name);
if ($check){ // check if email already exist
  echo 'An access group with thuis name exist!';
}else{
$stmt = $this->DBconn->prepare("INSERT INTO access_group( group_name, video_id, group_type, group_token, created_date )
VALUES(:ugroup_name, :uvideo_id, :ugroup_type, :ugroup_token, :ucreated_date)");
 
 $stmt ->bindParam(':ugroup_name', $group_name);
 $stmt ->bindParam(':uvideo_id', $video_id);
 $stmt ->bindParam(':ugroup_type', $group_type);
 $stmt ->bindParam(':ugroup_token', $group_token);
 $stmt ->bindParam(':ucreated_date', $created_date);
$output= $stmt->execute();	      
// If execute is true
 if($output){   
      // if access group is registered logg
echo '1';
  }
else{
  
  echo "An error occured creating access group"; // wrong details 
  }
} //end email check

}
//// End FUNCTION

// fetch single acccess group details
public function access_group_details($group_token){
	try{
		$email_check=$this->DBconn->prepare("SELECT * FROM access_group WHERE group_token=:uref");
		$email_check->execute(array(":uref"=>$group_token));
		$count=$email_check->rowCount();
		$query=$email_check->fetch(PDO::FETCH_ASSOC);
		if ($count > 0){
			return $query;  // email exist
		}else{
			return 'no data';  // email does not exist
		}
	}catch(PDOException $exception){
		echo 'email exist function error:'.$exception->getMessage();
	}
}

// end fetch single acccess group details


###### END ACCESS MANAGEMENT

###### TICKET MANAGEMENT 
public function get_ticket( $full_name, $phone, $email, $video_id, $passcode, $payment_ref, $ticket_token, $created_date){
  $query="SELECT * FROM instant_ticket WHERE payment_ref=:uref"; 
  $check=$this->item_exist($query, $payment_ref);
  $login_session="";
if ($check){ // check if email already exist
  $a="1";
  return $a; 
  // echo '<p>Ticket sent to '.$email.'!</p>';
}else{
$stmt = $this->DBconn->prepare("INSERT INTO instant_ticket( fullname, email, phone, passcode, token, video_id, payment_ref, created_date, login_session )
VALUES(:ufullname, :uemail, :uphone, :upasscode, :utoken, :uvideo_id, :upayment_ref, :ucreated_date, :ulogin_session)");
 
 $stmt ->bindParam(':ufullname', $full_name);
 $stmt ->bindParam(':uemail', $email);
 $stmt ->bindParam(':uphone', $phone);
 $stmt ->bindParam(':upasscode', $passcode);
 $stmt ->bindParam(':utoken', $ticket_token);
 $stmt ->bindParam(':uvideo_id', $video_id);
 $stmt ->bindParam(':upayment_ref', $payment_ref);
 $stmt ->bindParam(':ucreated_date', $created_date);
 $stmt ->bindParam(':ulogin_session', $login_session);
$output= $stmt->execute();	      
// If execute is true
 if($output){   
      // if access group is registered logg 
      // $this->send_ticket_email($email, $full_name, $ticket_token, $passcode, $created_date);
      $b="2";
      return $b; 
  }else{
  
  echo "An errored generating your ticket"; // wrong details 
  }
} //end email check

}

##### generate ticket on succsfull payment


#### end genrate

// fetch single acccess group details
public function get_ticket_details($payment_ref){
	try{
		$get_ticket=$this->DBconn->prepare("SELECT * FROM instant_ticket WHERE payment_ref=:uref");
		$get_ticket->execute(array(":uref"=>$payment_ref));
		$count=$get_ticket->rowCount();
		$query=$get_ticket->fetch(PDO::FETCH_ASSOC);
		if ($count > 0){
			return $query;  // email exist
		}else{
			return 'no data';  // email does not exist
		}
	}catch(PDOException $exception){
		echo 'email exist function error:'.$exception->getMessage();
	}
}

// end fetch single acccess group details


############### end ticket management

// PAYMENTS GROUPS AND LINK


public function pay_group_exist($video_ref){
	
		$email_check=$this->DBconn->prepare("SELECT * FROM payment_link WHERE video_token=:uref");
		$email_check->execute(array(":uref"=>$video_ref));
		$count=$email_check->rowCount();
		$query=$email_check->fetch(PDO::FETCH_ASSOC);
		if ($count > 0){
			return true;  // email exist
		}else{
			return false;  // email does not exist
    }

}
// end function

//// Add Create payment link

public function add_payment_link( $link_name, $link_desc, $link_currency, $link_amount, $link_url, $link_token, $link_date, $link_slug, $redirect_url, $video_token, $link_status, $link_type){
  $stmt = $this->DBconn->prepare("INSERT INTO payment_link (link_name,	link_description, link_currency, link_amount, link_url, link_token, link_date, link_slug, redirect_url, video_token, link_status, link_type)
  VALUES( :ulink_name, :ulink_desc, :ulink_currency, :ulink_amount, :ulink_url, :ulink_token, :ulink_date, :ulink_slug, :uredirect_url, :uvideo_token, :ulink_status, :ulink_type)");
   
   $stmt ->bindParam(':ulink_name', $link_name);
   $stmt ->bindParam(':ulink_desc', $link_desc);
   $stmt ->bindParam(':ulink_currency', $link_currency);
   $stmt ->bindParam(':ulink_amount', $link_amount);
   $stmt ->bindParam(':ulink_url', $link_url);
   $stmt ->bindParam(':ulink_token', $link_token);
  $stmt ->bindParam(':ulink_date', $link_date);
  $stmt ->bindParam(':ulink_slug', $link_slug);
  $stmt ->bindParam(':uredirect_url', $redirect_url);
  $stmt ->bindParam(':uvideo_token', $video_token);
 $stmt ->bindParam(':ulink_status', $link_status);
 $stmt ->bindParam(':ulink_type', $link_type);
 
  
  $output= $stmt->execute();  
   // return true;	

  // If execute is true
   if($output){ 
echo 'ok';
}else{
echo 'bad';
}
}

//// Create payment link
###############################


// fetch payment details

public function fetch_link_details($video_ref){
	
  $email_check=$this->DBconn->prepare("SELECT * FROM payment_link WHERE video_token=:uref");
  $email_check->execute(array(":uref"=>$video_ref));
  $count=$email_check->rowCount();
  // $query=$email_check->fetch(PDO::FETCH_ASSOC);
  $rows = $email_check->fetchAll(PDO::FETCH_ASSOC);   
  // Check if any rows returned
  if (count($rows) > 0) {
      return $rows; 
  } else {
      // No payment records found for the given video token
      return false;
  }

}
// end fetch payment details

###############################


//  END PAYMENTS GROUPS AND LINK




### // CLOUDFLARE DNS
public function create_dns($subdomain){
// Replace with your Cloudflare API key and email
$apiKey = '6719a5261798e91c8f5351d5bcc97c21a1b17';
$email = 'advancedteamworks@gmail.com';

// $subdomain = $_POST['subdomain'];

$zoneID = '2cbd70ac0ebc607ca0de5bd07b6b0eb2'; // Get the Zone ID for your domain from Cloudflare

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.cloudflare.com/client/v4/zones/{$zoneID}/dns_records",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode(array(
        'type' => 'A',
        'name' => $subdomain . '.atwlive.com', // Replace with your domain
        'content' => '141.136.35.5', // Replace with your server IP
        'ttl' => 1,
        'proxied' => false
    )),
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "X-Auth-Email: {$email}",
        "X-Auth-Key: {$apiKey}"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // echo "Subdomain created successfully!";
    // echo 'good';
    $this->create_subdomain($subdomain);
}
  
}

####// CLOUDFLARE DNS


### // CREATE SUBDOMAIN

public function create_subdomain($subdomain){
      // cPanel credentials
      $cpanelUsername = 'atwlivetw';
      $cpanelPassword = 'Dgbn3EgWZ';
      $cpanelDomain = 'atwlive.com';
      
      // Subdomain details
      $subdomainz=$subdomain.'.'.$cpanelDomain;
      // $subdomain = 'mylive';
      $subdomainDir = '/public_html/'.$subdomainz;
      
      // Prepare API URL
      $apiUrl = "https://$cpanelUsername:$cpanelPassword@$cpanelDomain:2083/execute/SubDomain/addsubdomain";
      
      // Prepare POST data
      $postData = array(
          'domain' => $subdomain,
          'rootdomain' => $cpanelDomain,
          'dir' => $subdomainDir,
          'subdomain' => $subdomain
      );
      
      // Initialize cURL
      $curl = curl_init();
      
      // Set cURL options
      curl_setopt_array($curl, array(
          CURLOPT_URL => $apiUrl,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => http_build_query($postData),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYHOST => false,
          CURLOPT_SSL_VERIFYPEER => false
      ));
      
      // Execute cURL request
      $response = curl_exec($curl);
      
      // Check for errors
      if ($response === false) {
          echo "Error: " . curl_error($curl);
      } else {
          // Decode JSON response
          $result = json_decode($response, true);
      
          // Check if the subdomain was created successfully
          if (isset($result['status']) && $result['status'] == 1) {
              // echo "Subdomain created successfully!";
              echo 'good';
          } else {
              echo "Error creating subdomain: " . $result['statusmsg'];
          }
      }
      
      // Close cURL
      curl_close($curl);
      
  
       
      
}


 ###// END CREATE SUBDOMAIN 

// !!!!!!!!!!!!!!!!

########### VERIFICATION EMAIL ##################
// 6.1 verification  email
public function verification_email($user_email, $fullname, $token, $usercode){
          //password reset hash
    //$id_hash=base64_encode($id);
     $token_hash=base64_encode(md5($token));
     $user_hash=sha1(base64_encode($user_email));
     
     $id_hash=base64_encode($token);
     $token_hash=base64_encode(md5($token));
 
    $user_hash=base64_encode(md5($user_email));
    
    // backend change password link
     $link="https://=".$token_hash.'&key='.$user_hash.'&pnt='.$id_hash.'&str='.$token;
   
 $message.='';
 // echo $message;
  if (mail($to,$subject, $message, $headers, '-fno-reply@vistminers.online')){
     // mail sent successful
     return true;
        
     }
      
}
// 6.1 end sign up email

############### END VERIFICATIOB EMAIL #############



############### PASSWORD EMAIL ##################
// 6.1 verification  email
public function password_reset_email($user_email, $fullname, $token, $usercode){
    //password reset hash
//$id_hash=base64_encode($id);
$token_hash=base64_encode(md5($token));
$user_hash=sha1(base64_encode($user_email));

$id_hash=base64_encode($token);
$token_hash=base64_encode(md5($token));

$user_hash=base64_encode(md5($user_email));

// backend change password link
$link="https://vistminers.online/password-reset?temp=".$token_hash.'&key='.$user_hash.'&pnt='.$id_hash.'&str='.$token;




$host = "vistminers.online"; //replace this with your domain's SMTP address
$username = "no-reply@vistminers.online";
$passwords = "vW!W9TW7";
$port="465";

$to = $user_email;
$subject = "Vist Miners password reset ";


 $headers = "MIME-Version: 1.0\n"; 
       $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n"; 
       $headers .= "X-Priority: 1 (Highest)\n"; 
       $headers .= "X-MSMail-Priority: High\n"; 
       $headers .= "Importance: High\n";
$headers .= 'From: Vist Miners Inc <no-reply@vistminers.online>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";
  
// header section and info ends

//messgae section starts from here

$message = '
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em "Helvetica Neue",Arial,Helvetica">
<tbody>
<tr width="100%">
   <td valign="top" align="left" style="background:#eff0f1; font:15px/1.25em "Helvetica Neue",Arial,Helvetica">
       <table style="border:none;padding:0 18px;margin:50px auto;width:600px">
           <tbody>
               <tr width="100%" height="60">
                   <td valign="top" align="center" style="border-top-left-radius:4px;border-top-right-radius:4px;background:#f6f7f8  url(https://ci5.googleusercontent.com/proxy/EX6LlCnBPhQ65bTTC5U1NL6rTNHBCnZ9p-zGZG5JBvcmB5SubDn_4qMuoJ-shd76zpYkmhtdzDgcSArG=s0-d-e1-ft#https://trello.com/images/gradient.png) bottom left repeat-x;padding:10px 18px;text-align:center">
                       <img  width="155" src="https://vistminers.online/img/logo.png" title="Vist Miners" style="font-weight:bold;font-size:18px;color:#fff;vertical-align:top" class="CToWUd" /> </td>
               </tr>
               <tr width="100%">
                   <td valign="top" align="center" style="background:#fff;padding:45px">
                       <img width="300px" src="https://vistminers.online/img/email.png" />
                       <h3 style="font-family: lato; color: rgb(0, 0, 0); font-size: 24px; font-weight: 100;">Hello John Doe,</h3>
                       <h1 style="color: #000;font-size: 40px;margin-bottom: 0;font-weight: 400;line-height: 1.4;font-family: lato;"> Please verify your email </h1>

                       <p style="font-family: lato; font-size:24px; font-weight: 300;"> 
                           Amazing deals, updates, interesting news right in your inbox</p> 
                   

                       <div style="background:#ffffff;border-radius:3px">
                           <br>

                           <p style="font:15px/1.25em "Helvetica Neue",Arial,Helvetica;margin-bottom:0;text-align:center">
                               <a href="'.$link.'" style="border-radius: 5px;background: #14427b;color: #ffffff;padding: 10px 15px;display: inline-block;font-family: lato;text-decoration: none;"
                                   target="_blank"> Reset Password</a>
                           </p>

                           <br>
                           <br> </div>
                   </td>

               </tr>
               <tr>
                   <td valign="middle" style="background-color: #e6e8eb;padding: 18px;">
                     <table>
                         <tbody><tr>
                         <td valign="top" width="33.333%" style="padding-top: 20px;">
                           <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                             <tbody><tr>
                               <td style="text-align: left; padding-right: 10px;">
                                   <h3 style="color: #000;font-size: 20px;font-family: lato;">About</h3>
                                   <p style="font-size: 15px;line-height: 1.8;font-family: lato;color: rgba(0, 0, 0, 0.6);">Vist Miner is a bitcoin investment and mining service lets you invest and earn bitcoin using trading strategies and plans.</p>
                               </td>
                             </tr>
                           </tbody></table>
                         </td>
                         <td valign="top" width="33.333%" style="padding-top: 20px;">
                           <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">   
                             <tbody><tr>
                               <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                   <h3 style="color: #000;font-size: 20px;font-family: lato;">Contact Info</h3>
                                   <ul style="padding-left: 0;font-size: 15px;line-height: 1.8; list-style:none;font-family: lato;color: rgba(0, 0, 0, 0.6);">
                                             <li><span class="text">107  Shire Oak Road, Scaynes Hill, Sussex, England</span></li>
                                             <li><span class="text">+1 (931) 398 1861</span></li>
                                           </ul>
                               </td>
                             </tr>
                           </tbody></table>
                         </td>
                         <td valign="top" width="33.333%" style="padding-top: 20px;">
                           <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                             <tbody><tr>
                               <td style="text-align: left; padding-left: 10px;">
                                   <h3 style="color: #000;font-size: 20px;font-family: lato;">Useful Links</h3>
                                   <ul style="padding-left: 0;font-size: 15px;line-height: 1.8; list-style:none;font-family: lato;color: rgba(0, 0, 0, 0.6);">
                                             <li><a style="color: #000000;text-decoration: none;" href="#">Home</a></li>
                                             <li><a style="color: #000000;text-decoration: none;" href="#">About</a></li>
                                             <li><a style="color: #000000;text-decoration: none;" href="#">Services</a></li>
                                            
                                           </ul>
                               </td>
                             </tr>
                           </tbody></table>
                         </td>
                       </tr>
                     </tbody></table>
                   </td>
                 </tr>
            
           </tbody>
       </table>
       
   </td>
</tr>
</tbody>
</table>';
$message.='';
// echo $message;
if (mail($to,$subject, $message, $headers, '-fno-reply@vistminers.online')){
// mail sent successful
return true;
  
}

}
// 6.1 end sign up email

############### END PASSWORD RESET EMAIL #############


// ******************* fetch profile ****** */
// fetch logged in users profile

public function profile_exist($tokens){
  
	$stmtToken = $this->DBconn->prepare("SELECT * FROM users  WHERE user_token=:utokens");
		$stmtToken->execute(array(":utokens"=>$tokens));
		$countToken = $stmtToken->rowCount();
		$rowToken = $stmtToken->fetch(PDO::FETCH_ASSOC);
		if ($countToken > 0){  
		return $rowToken;   // fetch user ddata array
		}else{
			  return false;
		}
}

// ******************* fetch profile ****** */
############ verification email link to very email #######
 
public function verification($email, $token, $pnt){
    // activity tab
  //  $actID=""; $actName="Sent Verification email"; $actDesc="successful"; $actPage="email verification";  $usrToken=$email; $actToken=md5(Rand(34848,998474744)); $actDate=Date('d-m-Y H:i:s');
  /*  $checks=   $this->email_exist($email);
    if ($checks){
      */
        $stmt = $this->DBconn->prepare("SELECT * FROM users WHERE user_token=:uid");
			$stmt->execute(array(":uid"=>$pnt));
            $count = $stmt->rowCount();
            
           // $a=1;
            if ($count > 0){
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$tokk=$row['user_token'];
			$lock_tok=md5($tokk);
			if ($lock_tok == $token){
				return true;  //  if encrypted token is same as recieved from email verification
			}else{
				return false;
			}
			
            }else{
         return false;
            }
}  // end Verification link check function



#### // Update email verificationstatus
public function update_email_status($reference) { 
    $status="verified";
    
        //Our UPDATE SQL statement.
                 $sql = "UPDATE `users` SET `user_verify` = :ustatus WHERE user_token = :token";
                 //Prepare our UPDATE SQL statement.
                 
                 $statement = $this->DBconn->prepare($sql);
                  $statement->bindValue(':token', $reference);    //Bind our value to the parameter :id.
                 $statement->bindValue(':ustatus', $status);  //Bind our :model parameter.
                 $update = $statement->execute();    //Execute our UPDATE statement.
                 if ($update){
                     echo "1";
                 }else{
                   echo "account verification failed";
                 }
    } // end 6.3
    
    #### // Update email status




//*********

	Public function log_user($authID){

        $stmtlog_stat = $this->DBconn->prepare("SELECT * FROM users WHERE user_token=:authusers");
        $stmtlog_stat->execute(array(":authusers"=>$authID));
        $rowlog = $stmtlog_stat->fetch(PDO::FETCH_ASSOC);
        $countlog = $stmtlog_stat->rowCount();
        if ($countlog > 0){
		return $rowlog;
        }else{
            return false;
        }

} //  logged user details fetch 

###############################
Public function transact_user($authIDs){

	$stmtlog_stat = $this->DBconn->prepare("SELECT * FROM transfer WHERE transfer_token=:authusers");
	$stmtlog_stat->execute(array(":authusers"=>$authIDs));
	$rowlogs = $stmtlog_stat->fetch(PDO::FETCH_ASSOC);
	$countlog = $stmtlog_stat->rowCount();
	if ($countlog > 0){
	// return $rowlog['clientuser_name'];
	
	// $rows=extract($rowlogs);
	return $rowlogs;
	}else{
		return false;
	}

} //  transaction fetch



################failed transaction fetch###############
Public function transact_user_failed($authIDs){

	$stmtlog_stat = $this->DBconn->prepare("SELECT * FROM  fundstransferfailed WHERE transfer_token=:authusers");
	$stmtlog_stat->execute(array(":authusers"=>$authIDs));
	$rowlogs = $stmtlog_stat->fetch(PDO::FETCH_ASSOC);
	$countlog = $stmtlog_stat->rowCount();
	if ($countlog > 0){
	// return $rowlog['clientuser_name'];
	
	// $rows=extract($rowlogs);
	return $rowlogs;
	}else{
		return false;
	}

} // failed transaction fetch

####################
    public function multifactor($password, $authpin,$user_token){

        try
		{	
		
			$stmt = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_pin=:upin AND clientuser_password=:upass");
			$stmt->execute(array(":upin"=>$authpin, ":upass"=>$password));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
		
			if ($count > 0){
				// pin correct";
            
               echo "1"; // log in;
                 $_SESSION['kin_auth_token'] = $row['clientuser_token'];	
               //  return true;
			}
			else{
				
				echo "wrong credentials, try again.!"; // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

    }  //multifactor login pin & password

     
    Public function dashboard_user($authID){

        $stmtlog_stat = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_token=:authusers");
        $stmtlog_stat->execute(array(":authusers"=>$authID));
        $rowlog = $stmtlog_stat->fetch(PDO::FETCH_ASSOC);
        $countlog = $stmtlog_stat->rowCount();
        if ($countlog > 0){
		// return $rowlog['clientuser_name'];
		return $rowlog;
        }else{
            return false;
        }

} //  logged user details fetch


public function Fetchsummary($token){
    $stmtsummary = $this->DBconn->prepare("SELECT * FROM transaction WHERE process_account=:processingAccount");
    $stmtsummary->execute(array(":processingAccount"=>$token));
    while( $rowsummary=$stmtsummary->fetch(PDO::FETCH_ASSOC)){

        // echo $rowsummary['transaction_type'];
        echo '
        
            <div class="row1">
                <div class="cell" data-title="Date ">
                ';
                $origDate =  $rowsummary['date_created'];
         
        $newDate = date("d M, Y", strtotime($origDate));
        echo $newDate;
                
                echo'
              </div>
              <div class="cell" data-title="Type">
              '.$rowsummary['transaction_type'].'
              </div>
              <div class="cell" data-title="Account No">
              '.$rowsummary['transaction_account'].'
              </div>
              <div class="cell" data-title="Description">
            '.$rowsummary['transaction_description'].'
              </div>
              
              <div class="cell" data-title="Status">
              '.$rowsummary['transaction_depositor'].'
              </div>
              <div class="cell" data-title="Amount">'; 
              echo '<span class=""></span>' .number_format($rowsummary['transaction_amount'], 2).'
              </div>
            </div>';
        }
       // second set
       $stmtsummaryt = $this->DBconn->prepare("SELECT * FROM transfer WHERE owner_account=:uprocessingAccount");
    $stmtsummaryt->execute(array(":uprocessingAccount"=>$token));
    while( $rowsummaryt=$stmtsummaryt->fetch(PDO::FETCH_ASSOC)){

        // echo $rowsummary['transaction_type'];
        echo '
        
            <div class="row1">
                <div class="cell" data-title="Date ">
                ';
                $origDate =  $rowsummaryt['date_created'];
         
        $newDate = date("d M, Y", strtotime($origDate));
        echo $newDate;
                
                echo'
              </div>
              <div class="cell" data-title="Type">
              Debit
              </div>
              <div class="cell" data-title="Account No">
              '.$rowsummaryt['recipient_account'].'
              </div>
              <div class="cell" data-title="Description">
            '.$rowsummaryt['transaction_description'].'
              </div>
              
              <div class="cell" data-title="Status"><code>reciev</code>
              '.$rowsummaryt['recipient_name'].'
              </div> 
              <div class="cell" data-title="Amount">'; 
              echo '<span class=""></span>' .number_format($rowsummaryt['transaction_amount'], 2).'
              </div>  
            </div>';
        } 

}  // fetch summary function



// funds transfer unsuccessful

public function fundsTransferFailed($transfer_type,$recipient_name, $recipient_account,$routing,$bank_address,$amount,$sort_code,$description,$owner_account,$transaction_date,$transaction_token, $transfer_code, $irs_code, $imf_code, $transfer_id, $transfer_status, $irs_status, $imf_status )
{
	try
		{	
//get current user balance
$stmtacct = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_account=:uaccount");
$stmtacct->execute(array(":uaccount"=>$owner_account));
$rowacct=$stmtacct->fetch(PDO::FETCH_ASSOC);
$avialable=$rowacct['clientuser_amount']; // store account balance
$transferstatus=$rowacct['clientuser_status'];
$newsum=$avialable;
if ($transferstatus=="Dormant"){   // if account dormant      
echo 'Account Dormant...Please activate account and try again.';

	}   
	
        
        
		
	}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
} // end funds transfer function



// funds transfer unsuccessful

// fund transfer
public function fundsTransfer($transfer_type,$recipient_name, $recipient_account,$routing,$bank_address,$amount,$sort_code,$description,$owner_account,$transaction_date,$transaction_token, $transfer_code, $irs_code, $imf_code, $transfer_id, $transfer_status, $irs_status, $imf_status )
{
	try
		{	
//get current user balance
$stmtacct = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_account=:uaccount");
$stmtacct->execute(array(":uaccount"=>$owner_account));
$rowacct=$stmtacct->fetch(PDO::FETCH_ASSOC);
$avialable=$rowacct['clientuser_amount']; // store account balance
$transferstatus=$rowacct['clientuser_status'];
$newsum=$avialable;
if ($transferstatus=="Dormant"){   // if account dormant      
echo 'Account Dormant...Please activate account and try again.';

	}   
	else{

		if ($newsum > $amount ){

			$stmt = $this->DBconn->prepare("INSERT INTO transfer (transfer_id, transaction_type, recipient_name, recipient_account, routing_number, recipient_bank_address, transaction_amount, transaction_sort_code, transaction_description, owner_account, date_created, transfer_code, irs_code, imf_code, irs_status, imf_status, transfer_status, transfer_token )
			VALUES( :transfer_id, :transaction_type, :recipient_name, :recipient_account_no, :routing, :bank_address, :amount, :sort_code, :transaction_description, :owner_account, :transaction_date, :transfer_code, :irs_code, :imf_code, :irs_status, :imf_status, :transfer_status, :transfer_token)");
		   
		   $stmt ->bindParam(':transaction_type', $transfer_type);
		   $stmt ->bindParam(':recipient_name', $recipient_name);
           $stmt ->bindParam(':recipient_account_no', $recipient_account);
           $stmt ->bindParam(':routing', $routing);
         $stmt ->bindParam(':bank_address', $bank_address);
           $stmt ->bindParam(':amount', $amount);
		   $stmt ->bindParam(':sort_code', $sort_code);
		   $stmt ->bindParam(':transaction_description', $description);
           $stmt ->bindParam(':owner_account', $owner_account);
		   $stmt ->bindParam(':transaction_date', $transaction_date);
			 $stmt ->bindParam(':transfer_code', $transfer_code);
			 $stmt ->bindParam(':irs_code', $irs_code);
			 $stmt ->bindParam(':imf_code', $imf_code);
			 $stmt ->bindParam(':irs_status', $imf_status);
			 $stmt ->bindParam(':imf_status', $imf_status);
		  $stmt ->bindParam(':transfer_status', $transfer_status);
		 $stmt ->bindParam(':transfer_token', $transaction_token);
		   $stmt ->bindParam(':transfer_id', $transfer_id);
		  $output= $stmt->execute();  
		   // return true;	
		
			// If execute is true
			 if($output){                 
				// echo "transfer true";
                $_SESSION['kin_Auth0_tr_token'] = $transaction_token;   // transaction token
                $_SESSION['kin_transfer_amount'] = $amount;   // transaction token  
                $_SESSION['kin_account_number'] = $owner_account;   // account no
                $_SESSION['kin_account_Tdate'] = $transaction_date;   // date
                $_SESSION['kin_account_Tdesc'] = $description;   // description       
				 	// $_SESSION['auth_logon_session'] = $row['clientuser_id'];
			echo "ok"; // Add user
			
                
                }
			else{
				
				echo "Transaction unsuccessful, try again.!"; // wrong details 
			}
		   
		}
		else{
			echo "Insuficient funds to initiate transfer";
		}	                   
		}
	}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
} // end funds transfer function



// funds transfer off code
public function fundsTransferOff($transfer_type,$recipient_name, $recipient_account,$routing,$bank_address,$amount,$sort_code,$description,$owner_account,$transaction_date,$transaction_token, $transfer_code, $irs_code, $imf_code, $transfer_id, $transfer_status, $irs_status, $imf_status )
{
	try
		{	
//get current user balance
$stmtacct = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_account=:uaccount");
$stmtacct->execute(array(":uaccount"=>$owner_account));
$rowacct=$stmtacct->fetch(PDO::FETCH_ASSOC);
$avialable=$rowacct['clientuser_amount']; // store account balance
$transferstatus=$rowacct['clientuser_status'];
$newsum=$avialable;
if ($transferstatus=="Dormant"){   // if account dormant
echo 'Account Dormant...Please activate account and try again.';

	}   
	else{

		if ($newsum > $amount ){

			$stmt = $this->DBconn->prepare("INSERT INTO transfer (transfer_id, transaction_type, recipient_name, recipient_account, routing_number, recipient_bank_address, transaction_amount, transaction_sort_code, transaction_description, owner_account, date_created, transfer_code, irs_code, imf_code, irs_status, imf_status, transfer_status, transfer_token )
			VALUES( :transfer_id, :transaction_type, :recipient_name, :recipient_account_no, :routing, :bank_address, :amount, :sort_code, :transaction_description, :owner_account, :transaction_date, :transfer_code, :irs_code, :imf_code, :irs_status, :imf_status, :transfer_status, :transfer_token)");
		   
		   $stmt ->bindParam(':transaction_type', $transfer_type);
		   $stmt ->bindParam(':recipient_name', $recipient_name);
           $stmt ->bindParam(':recipient_account_no', $recipient_account);
           $stmt ->bindParam(':routing', $routing);
         $stmt ->bindParam(':bank_address', $bank_address);
           $stmt ->bindParam(':amount', $amount);
		   $stmt ->bindParam(':sort_code', $sort_code);
		   $stmt ->bindParam(':transaction_description', $description);
           $stmt ->bindParam(':owner_account', $owner_account);
		   $stmt ->bindParam(':transaction_date', $transaction_date);
			 $stmt ->bindParam(':transfer_code', $transfer_code);
			 $stmt ->bindParam(':irs_code', $irs_code);
			 $stmt ->bindParam(':imf_code', $imf_code);
			 $stmt ->bindParam(':irs_status', $imf_status);
			 $stmt ->bindParam(':imf_status', $imf_status);
		  $stmt ->bindParam(':transfer_status', $transfer_status);
		 $stmt ->bindParam(':transfer_token', $transaction_token);
		   $stmt ->bindParam(':transfer_id', $transfer_id);
		  $output= $stmt->execute();  
		   // return true;	
		
			// If execute is true
			 if($output){
                // echo "transfer true";
                $newsum = - $amount ;    // deduct account
                $sth = $this->DBconn->prepare('UPDATE `userauthentication` SET `clientuser_amount` = `clientuser_amount` + ? WHERE `clientuser_account` = ?');
                if ($sth->execute(array($newsum, $owner_account))){

              /*  $_SESSION['kin_Auth0_tr_token'] = $transaction_token;   // transaction token
                $_SESSION['kin_transfer_amount'] = $amount;   // transaction token  
                $_SESSION['kin_account_number'] = $owner_account;   // account no      
                $_SESSION['kin_account_Tdate'] = $transaction_date;   // date
                $_SESSION['kin_account_Tdesc'] = $description;   // description       
					 // $_SESSION['auth_logon_session'] = $row['clientuser_id'];
					 
					 */
			echo "ok"; // Add user
                    
                }
                else{
                    echo 'amount update failed';
                }
                }
			else{
				
				echo "Transaction unsuccessful, try again.!"; // wrong details 
			}
		   
		}
		else{
			echo "Insuficient funds to initiate transfer";
		}	                   
		}
	}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
} // end funds transfer off codes function


    Public function transferCode($codetoken, $transaction_track,$acctnumber){

      try
		{	
      $statdefault="0";
		// check transfer token
			$stmt = $this->DBconn->prepare("SELECT * FROM transfer WHERE transfer_token=:utrack AND transfer_status=:ustatus");
			$stmt->execute(array(":utrack"=>$transaction_track, ":ustatus"=>$statdefault));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			 if($row['transfer_code']==$codetoken){

				try {
				$stmtacct = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_account=:uaccount");
				$stmtacct->execute(array(":uaccount"=>$acctnumber));
				$rowacct=$stmtacct->fetch(PDO::FETCH_ASSOC);
				$avialable=$rowacct['clientuser_amount']; // store account balance

								// if account debit successful--update transfer status to successful
				$sth = $this->DBconn->prepare('UPDATE `transfer` SET `transfer_status` = `transfer_status` + ? WHERE `transfer_token` = ?');
				if ( $sth->execute(array(1, $transaction_track))){
					
					echo "1";  // response good
				}   
				else{
					echo 'wrong transfer passcode';  // transaction update failed
				}

				   }
				   catch(PDOException $e) {
					 echo $e->getMessage();
				   }

			}
			else{
				
            echo "wrong transfer code!"; // wrong details 
          }
            
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
    } // transfer code

    Public function irsCode($codetoken, $transaction_track,$acctnumber){

      try
		{	
      $statdefault="0";
		// check transfer token
			$stmt = $this->DBconn->prepare("SELECT * FROM transfer WHERE transfer_token=:utrack AND irs_status=:ustatus");
			$stmt->execute(array(":utrack"=>$transaction_track, ":ustatus"=>$statdefault));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			 if($row['irs_code']==$codetoken){
				$stmtacct = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_account=:uaccount");
				$stmtacct->execute(array(":uaccount"=>$acctnumber));
				$rowacct=$stmtacct->fetch(PDO::FETCH_ASSOC);
				$avialable=$rowacct['clientuser_amount']; // store account balance

								// if account debit successful--update irs status to successful
				$sth = $this->DBconn->prepare('UPDATE `transfer` SET `irs_status` = `irs_status` + ? WHERE `transfer_token` = ?');
				if ( $sth->execute(array(1, $transaction_track))){
					
					echo "1";  // response good
				}   
				else{
					echo 'verification failed';  // verifcation update failed
				}

			}
			else{
				
            echo "wrong irs code!"; // wrong details 
          }
            
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
    } // irs verification


      
    Public function imfCode($codetoken, $transaction_track,$acctnumber, $amount){

      try
		{	
      $statdefault="0";
		// check transfer token
			$stmt = $this->DBconn->prepare("SELECT * FROM transfer WHERE transfer_token=:utrack AND imf_status=:ustatus");
			$stmt->execute(array(":utrack"=>$transaction_track, ":ustatus"=>$statdefault));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			 if($row['imf_code']==$codetoken){
				$stmtacct = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_account=:uaccount");
				$stmtacct->execute(array(":uaccount"=>$acctnumber));
				$rowacct=$stmtacct->fetch(PDO::FETCH_ASSOC);
				$avialable=$rowacct['clientuser_amount']; // store account balance
$newsum= $avialable;
								// if account debit successful--update irs status to successful
				$sth = $this->DBconn->prepare('UPDATE `transfer` SET `imf_status` = `imf_status` + ? WHERE `transfer_token` = ?');
				if ( $sth->execute(array(1, $transaction_track))){
                    $newsum = - $amount ;    // deduct account
                    $sth = $this->DBconn->prepare('UPDATE `userauthentication` SET `clientuser_amount` = `clientuser_amount` + ? WHERE `clientuser_account` = ?');
                    if ($sth->execute(array($newsum, $acctnumber)))  {
                                        echo "1";  // response good
                                    } 
                                 } 
								   
				else{
					echo 'verification failed';  // verifcation update failed
				}

			}
			else{
				
            echo "wrong imf code!"; // wrong details 
          }
            
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
    } // irs verification

    Public function logged_user($authID, $authnum){

      $stmt = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_account=:ustatus");
			$stmt->execute(array(":ustatus"=>$authnum));
			$rowlog = $stmt->fetch(PDO::FETCH_ASSOC);
      $countlog = $stmt->rowCount();
      if ($countlog > 0){
      return $rowlog;
      }else{
          return false;
      }

} //  transaction alert logged user details



Public function logged_transaction($transactionID){

  $stmt = $this->DBconn->prepare("SELECT * FROM transfer WHERE transfer_token=:utoken");
  $stmt->execute(array(":utoken"=>$transactionID));
  $rowlog = $stmt->fetch(PDO::FETCH_ASSOC);
  $countlog = $stmt->rowCount();
  if ($countlog > 0){
  return $rowlog;
  }else{
      return false;
  }

} //  transaction alert logged user details

public function FetchAlertUser($userID, $token){ // fetch alert notification user details

    $stmtlog_stat = $this->DBconn->prepare("SELECT * FROM userauthentication WHERE clientuser_token=:authusers");
    $stmtlog_stat->execute(array(":authusers"=>$token));
    $rowlog = $stmtlog_stat->fetch(PDO::FETCH_ASSOC);
    $countlog = $stmtlog_stat->rowCount();
    if ($countlog > 0){
    return $rowlog;
    }else{
        return false;
    }
    
}

    }