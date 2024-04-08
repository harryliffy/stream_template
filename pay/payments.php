<link rel="stylesheet" href="../payments_style.css">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-213002364-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-213002364-1');
</script>
<link href="../images/favicon.png" rel="apple-touch-icon" sizes="72x72">
<!-- <link href="ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon"> -->
<link href="../images/favicon.png" rel="shortcut icon">
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f41f;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
         .code-instructions {
            color: #007bff;
            font-weight: bold;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .success-message {
            color: #28a745;
            font-weight: bold;
        }
    </style>


<?php
  require_once '../Twilio/autoload.php'; 
 
  use Twilio\Rest\Client; 
require_once('../admin/src/functions.php');
$core= new atwLive();

//  html bosy for error and sucess -
$error_body='<div class="container">
<h1>Order Failed</h1>
<p>Let\'s Be Honest By Dike Chukwumerije.</p>
<p style="color:red;">An error occured while procesing your ticket!</p> 
<br>
To access your event or service, please wait and try again.</p>
<p></p>
<br>
<small><span >For help or to resolve issues call <a href="tel:+2349037034192">+234 9037034192</a></span></small>
</div>';

//  html bosy for error and sucess -
$error_none='<div class="container">
<h1>Try Again</h1>
<p>Let\'s Be Honest By Dike Chukwumerije.</p>
<p style="color:red;">No ticket found for this reference!</p> 
<br>
To access your event or service, please wait and try again.</p>
<p></p>
<br>
<small><span >For help or to resolve issues call <a href="tel:+2349037034192">+234 9037034192</a></span></small>
</div>';

function success_body($retrived_ticket){
  echo '<div class="container">
  <h1>Order Completed</h1>
  <p>Let\'s Be Honest By Dike Chukwumerije.</p>
  <p class="success-message">Your ticket has been successfully purchased!</p> 
<br>
<small>Ticket code</small>
<h1>'.$retrived_ticket.'</h1>

To access your event or service, please make sure to save your ticket code.</p>
  <p class="code-instructions">Instructions: Copy or take a screenshot of the ticket code for future reference.</p> 
  <p></p>
<br>
<small><span >For help or to resolve issues call <a href="tel:+2349037034192">+234 9037034192</a></span></small>
  </div>';
}



//  end html body for error and sucess *



$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';

if(!$reference){

  echo $error_body;

}

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer sk_live_1bfa8a1a01779d12a322a3ead7446d2076708402",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);

if(!$tranx->status){
  // there was an error from the API
  // die('API returned error: ' . $tranx->message);
  echo $error_body;
}

if('success' == $tranx->data->status){
  //set data variables
  $user_email= $tranx->data->customer->email;
  $fullname= $tranx->data->customer->first_name;
  $user_phones= $tranx->data->customer->phone;
  // echo $user_phone;
  $date=Date("d-m-y h:i:s");
  $video_id="Lets Be Honest";
  $payment_ref=$_GET['reference'];
  $ticket_token=md5(rand(28697, 276*600));
  $tokenz=md5(rand(5656697, 276*900));
  $token=md5(rand(286997, 276*700));
  // generate code
  $random = time() . rand(10*45, 100*98);
  $encoded= md5($random);
  $passcode_trans= strtoupper($encoded);
  $usercode=substr($passcode_trans, 0, 7);
  $login_session="";
  // end code
// insert new transaction if payment recieved and new refernce number
  $success=$core->get_ticket($fullname, $user_phones, $user_email, $video_id, $usercode, $payment_ref, $ticket_token, $date, $login_session);
  if ($success=="1"){
  // send ticket sms
// include("../sms_test.php");
    // $trimmed_phone = str_replace(' ', '', $user_phone);
    // $trimmed_phone = $user_phone;
    // send_sms($fullname, $usercode, $user_phone);
     // fetch ticket
     $paid_code=$core->get_ticket_details($payment_ref);
    if ($paid_code=="no data"){
      // if no customer reference
      $retrived_ticket="no ticket";
      // show error page
      echo $error_body;
    }else{
      // echo $error_none; 
      // if customer reference  exist

// send ticket email
      extract($paid_code);
      $retrived_ticket=$passcode;
  
      $body= success_body($passcode);
      echo $body;
     
    
      }
  // echo 'good';
 // Rest part of the code that gives value to user, adds ordered items and payment info to database, sends email and delete the cart items or unset session (depending if a client or guest)
  }
  // #############

  if ($success=="2"){
    // send ticket sms
  // include("../sms_test.php");
      // $trimmed_phone = str_replace(' ', '', $user_phone);
      // $trimmed_phone = $user_phone;
      // send_sms($fullname, $usercode, $user_phone);
       // fetch ticket
       $paid_code=$core->get_ticket_details($payment_ref);
      if ($paid_code=="no data"){
        // if no customer reference
        $retrived_ticket="no ticket";
        // show error page
        echo $error_body;
      }else{
        // echo $error_none; 
        // if customer reference  exist
  
  // send ticket email
        extract($paid_code);
        $retrived_ticket=$passcode;
    // send_ticket_email($user_email, $fullname, $token, $retrived_ticket, $date);
        $body= success_body($passcode);
        echo $body;
        $core->send_ticket_email($user_email, $fullname, $tokenz, $retrived_ticket, $date);
      
      
        }
    // echo 'good';
   // Rest part of the code that gives value to user, adds ordered items and payment info to database, sends email and delete the cart items or unset session (depending if a client or guest)
    }

    if (!$success=="2" || !$success=="1" ){
          // echo 'whats';
          echo $error_body;
        }
}