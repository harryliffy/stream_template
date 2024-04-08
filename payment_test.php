<link rel="stylesheet" href="payments_style.css">

<?php
  require_once 'Twilio/autoload.php'; 
 
  use Twilio\Rest\Client; 
require_once('admin/src/functions.php');
$core= new atwLive();

//  html bosy for error and sucess -
$error_body='<div class="card"><div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
  <i style="color:red" class="checkmark">✗</i>
</div>
  <h3 style="color:black" >Error occured, try again</h3> 
  <p>We have not received your purchase request;<br/> check and try again shortly!</p>
  <p><a href="index">Go back to home page</a></p>
 <br>
</div>';

function success_body($retrived_ticket){
  echo '<div class="card"><div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
  <i class="checkmark">✓</i>
</div>
  <h1>Success</h1> 
  <p>We received your purchase request;<br/> You will recieve your ticket shortly!</p>
 <br>
 <small>Ticket passcode</small>
<div class="verification" >'.$retrived_ticket.'</div>
<p><a target="blank" href="index">Watch now</a></p>
</div>';
}
//  end html body for error and sucess *



// send ticket  email -
function send_ticket_email($user_email, $fullname, $token, $usercode, $date){

  $host = "atwlive.com"; //replace this with your domain's SMTP address
  $username = "tickets@atwlive.com";
  $passwords = "########";
  $port="465";
  $to = $user_email;
  $subject = "JayClef Concert Ticket";
  $headers = "MIME-Version: 1.0\n"; 
       $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n"; 
       $headers .= "X-Priority: 1 (Highest)\n"; 
       $headers .= "X-MSMail-Priority: High\n"; 
       $headers .= "Importance: High\n";
  $headers .= 'From: Advanced Teamworks Ltd <tickets@atwlive.com>' . "\r\n";
  //$headers .= 'Cc: myboss@example.com' . "\r\n";
  // header section and info ends
  
  //messgae section starts from here
  $message = '<!doctype html>
  <html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Simple Transactional Email</title>
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
    <body style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
      <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">JayClef concert Ticket successful.</span>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
        <tr>
          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
          <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
            <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
  
              <!-- START CENTERED WHITE CONTAINER -->
              <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">
  
                <!-- START MAIN CONTENT AREA -->
                <tr>
                  <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                      <tr>
                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                          <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Hi '.$fullname.',</p>
                          <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Just wanted to let you know that your ticket for the JayClef Live in concert on 11th Dec. 2022 has been purchased successfully!</p>
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%;" width="100%">
                            <tbody>
                              <tr>
                                <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                    <tbody>
                                      <tr>
                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #3498db;" valign="top" align="center" bgcolor="#3498db"> <a href="https://atwlive.com" style="border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #3498db; border-color: #3498db; color: #ffffff;">'.$usercode.'</a> </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">If you have any questions or need to make changes to your ticket, please contact us at tickets@atwlive.com.</p>
                          <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Thanks again for choosing www.atwlive.com. </p>
                          <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Best Regards.</p>
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
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                  <tr>
                    <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
                      
                      <br> Dont like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">Unsubscribe</a>.
                    </td>
                  </tr>
                  <tr>
                    <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
                      Powered by <a href="http://atw.center" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">ATW Live</a>.
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
  echo "mail sent successful";
  
  }else{
    echo "mail send failed";
  }
  
  }
  // end passcode email *

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
    "authorization: Bearer sk_live",
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
  $user_phone= $tranx->data->customer->phone;
  $date=Date("d-m-y h:i:s");
  $video_id="jayclef_concert";
  $payment_ref=$_GET['reference'];
  $ticket_token=md5(rand(28697, 276*600));

  $token=md5(rand(286997, 276*700));
  // generate code
  $random = time() . rand(10*45, 100*98);
  $encoded= md5($random);
  $passcode_trans= strtoupper($encoded);
  $usercode=substr($passcode_trans, 0, 7);
  // end code
// insert new transaction if payment recieved and new refernce number
  $success=$core->get_ticket($fullname, $user_phone, $user_email, $video_id, $usercode, $payment_ref, $ticket_token, $date);
  if ($success="1"){
  // send ticket sms

     // fetch ticket
     $paid_code=$core->get_ticket_details($payment_ref);
    if ($paid_code=="no data"){
      // if no customer reference
      $retrived_ticket="no ticket";
      // show error page
      echo $error_body;
    }else{
      // if customer reference  exist

// send ticket email
      extract($paid_code);
      $retrived_ticket=$passcode;
  send_ticket_email($user_email, $fullname, $token, $retrived_ticket, $date);
      $body= success_body($passcode);
      echo $body;
    include("sms_test.php");
    send_sms($fullname, $passcode, $user_phone);
      }
  // echo 'good';
 // Rest part of the code that gives value to user, adds ordered items and payment info to database, sends email and delete the cart items or unset session (depending if a client or guest)
  }else{
    // echo 'whats';
  }
}