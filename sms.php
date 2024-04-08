<?php

// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK


// Use the REST API Client to make requests to the Twilio REST API


// Your Account SID and Auth Token from twilio.com/console
$sid = 'ACff698a6e9f34925ce945ff11fb5321a6';
$token = 'fea799486b6d06bc3587d276532033d5';

// Use the client to do fun stuff like send text messages!
$billing_phone="+2349037034192";
$id = $sid;
$url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages";
$from = "+19033081583";
$to = $billing_phone ; // twilio trial verified number
$template =  "Hello ".$full_name.", \n Your ticket for JayClef Live in concert ticket has been purchased \n Ticket Code:".$passcode." \n  Date:".$c_date." \n Streaming link:".$live_link."" ;


//$body = "Dear ".$billing_first_name.", Your transfer for Order #".$order_id." is not confirmed yet. Confirm it to proceed your order. cigsnet.com";
$body = $template;
$data = array (
    'From' => $from,
    'To' => $to,
    'Body' => $body,
);
$post = http_build_query($data);
$x = curl_init($url );
curl_setopt($x, CURLOPT_POST, true);
curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
curl_setopt($x, CURLOPT_POSTFIELDS, $post);
$y = curl_exec($x);
curl_close($x);
// var_dump($post);
// var_dump($y);


?>