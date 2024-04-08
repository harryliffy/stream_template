<?php 
 
// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
require_once 'Twilio/autoload.php'; 
 
use Twilio\Rest\Client; 
 
 function send_sms($full_name, $passcode, $user_phone){
    $c_date="14-Feb-2024";
    $live_link="https://atwlive.com";
$sid    = "##############"; 
$token  = "###################"; 

$template =  "Hello ".$full_name.", \nYour ticket for Lets Be Honest By Dike Chukwumerije Live has been purchased \nTicket Code:".$passcode." \n  Date:".$c_date." \n Streaming link:".$live_link."" ;

$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create($user_phone, // to 
                           array( 
                               "from" => "+16592700707", 
                               "messagingServiceSid" => "MGbee4ff21188c987682291b7125f1bde1",      
                               "body" => $template 
                           ) 
                  ); 
//  echo $user_phone;
// print($message->sid);

 }
 $full_name = "Harry";
 $passcode = "7685FCT";
 $user_phone = "+2348022759194";
 
 // Call the function
 send_sms($full_name, $passcode, $user_phone);
 ?>
            