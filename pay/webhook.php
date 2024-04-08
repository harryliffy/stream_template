<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Report</title>
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
</head>
<body>
  

<?php
require_once('../admin/src/functions.php');
$core= new atwLive(); 
// The library needs to be configured with your account's secret key.
// Ensure the key is kept out of any version control system you might be using.

require_once('vendor/autoload.php'); // Include the Stripe PHP library

\Stripe\Stripe::setApiKey('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');



// Assuming you have the Checkout Session ID stored in a variable called $sessionId
$sessionId = $_GET['checkout_session_id'];

//  success body
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
    </div>';
  }
// success body

//  error body
function error_body(){
    echo '<div class="container">
    <h1>Error Occured</h1>
    <p>Let\'s Be Honest By Dike Chukwumerije.</p>
    <p style="color:red;">An error occured while procesing your ticket!</p> 
    <br>
    
    
    To access your event or service, please wait and try again.</p>
    
    </div>';
  }
// error body

try {
    // Retrieve the Checkout Session
    $session = \Stripe\Checkout\Session::retrieve($sessionId);

      // if the session id is set;

      if (isset($sessionId)){

    // Now you can access the payment details
    // echo "Payment Status: " . $session->payment_status . "\n";
    // echo "Payment Intent ID: " . $session->payment_intent . "\n";

    // echo  $session->customer_email. "\n";
    // echo  $session->customer_phone. "\n";
    // echo "Customer ID: " . $session->customer . "\n";
    // print_r($session);
    $json_readable = json_encode($session, JSON_PRETTY_PRINT);
    $data = json_decode($json_readable, true);

    // Extract email and phone number
    $user_email = $data['customer_details']['email'];
    $user_phone = $data['customer_details']['phone'];
    $fullname = $data['customer_details']['name'];

    // success_body($vv);
    // echo $user_email;
    // echo $user_phone ;
    // echo $fullname;

    $date=Date("d-m-y h:i:s");
    $video_id="Lets Be Honest";
    $payment_ref=$sessionId;
    $ticket_token=md5(rand(28697, 276*600));
  
    $token=md5(rand(286997, 276*700));
    // generate code
    $random = time().rand(19*45, 180*28);
    $encoded= md5($random);
    $passcode_trans= strtoupper($encoded);
    $usercode=substr($passcode_trans, 0, 7);
    $login_session="";
    // end code
  // insert new transaction if payment recieved and new refernce number
    $success=$core->get_ticket($fullname, $user_phone, $user_email, $video_id, $usercode, $payment_ref, $ticket_token, $date, $login_session);
    if ($success=="1"  || $success=="2"){
    // send ticket sms
    
    // include("../sms_test.php");
    // $trimmed_phone = str_replace(' ', '', $user_phone);

    // send_sms($fullname, $usercode, $trimmed_phone);
  
       // fetch ticket
       $paid_code=$core->get_ticket_details($payment_ref);
      if ($paid_code=="no data"){
        // if no customer reference
        $retrived_ticket="no ticket";
        // show error page
         error_body();
      }else{
        // if customer reference  exist
  
  // send ticket email
        extract($paid_code);
        $retrived_ticket=$passcode;
    // send_ticket_email($user_email, $fullname, $token, $retrived_ticket, $date);
       success_body($passcode);
       $core->send_ticket_email($user_email, $fullname, $token, $retrived_ticket, $date);
      // include("sms_test.php");
      // send_sms($fullname, $passcode, $phone);
        }
    // echo 'good';
   // Rest part of the code that gives value to user, adds ordered items and payment info to database, sends email and delete the cart items or unset session (depending if a client or guest)
    }else{
      // echo 'whats';
      error_body();
    }


      }else{
        error_body();
      }
    // You can access more information from the $session object as needed
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle any errors that occur during the API request
    // echo 'Error: ' . $e->getError()->message . "\n";
    error_body();
} catch (Exception $e) {
    // Handle any other errors
    // echo 'Error: ' . $e->getMessage() . "\n";
    error_body();
}

?>


</body>
</html>