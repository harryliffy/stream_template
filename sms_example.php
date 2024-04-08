




<?php 
 
// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
require_once '/path/to/vendor/autoload.php'; 
 
use Twilio\Rest\Client; 
 
$sid    = "###############"; 
$token  = "[AuthToken]"; 
$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create("+2349037034192", // to 
                           array(  
                               "messagingServiceSid" => "MGbee4ff21188c987682291b7125f1bde1",      
                               "body" => "Your concert tickets" 
                           ) 
                  ); 
 
print($message->sid);