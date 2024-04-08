<?php


// End navigation class

Class Mailing{
       
        protected   $dir="https://dashboard.adashi.ng/data/";


############### SIGN UP EMAIL ##################
// 6.1 sign up email
public function signup_email($user_email, $fullname, $token){

    //password reset hash
    //$id_hash=base64_encode($id);
     $token_hash=base64_encode(md5($token));

    $user_hash=sha1(base64_encode($user_email));
    
    // backend change password link
   //  $link="https://americaremedics.com/password-recovery?temp=".$token_hash."&key=".$user_hash."&pnt=".$id_hash;
   
    $host = "adashi.com.ng"; //replace this with your domain's SMTP address
    $username = "support@adashi.com.ng";
    $passwords = "F!r3Cr@k3r5s";
    $port="465";
    
     $to = $user_email;
    $subject = "Welcome to Adashi Nigeria";
    
    
      $headers = "MIME-Version: 1.0\n"; 
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n"; 
            $headers .= "X-Priority: 1 (Highest)\n"; 
            $headers .= "X-MSMail-Priority: High\n"; 
            $headers .= "Importance: High\n";
    $headers .= 'From: Adashi Nigeria <support@adashi.com.ng>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";
       
    // header section and info ends
    
    //messgae section starts from here
   
    $message = '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em "Helvetica Neue",Arial,Helvetica">
    <tbody>
        <tr width="100%">
            <td valign="top" align="left" style="background:#eef0f1;font:15px/1.25em "Helvetica Neue",Arial,Helvetica">
                <table style="border:none;padding:0 18px;margin:50px auto;width:500px">
                    <tbody>
                        <tr width="100%" height="60">
                            <td valign="top" align="left" style="border-top-left-radius:4px;border-top-right-radius:4px;background:#3b2a56  url(https://ci5.googleusercontent.com/proxy/EX6LlCnBPhQ65bTTC5U1NL6rTNHBCnZ9p-zGZG5JBvcmB5SubDn_4qMuoJ-shd76zpYkmhtdzDgcSArG=s0-d-e1-ft#https://trello.com/images/gradient.png) bottom left repeat-x;padding:10px 18px;text-align:center">
                                <img  width="155" src="https://adashi.com.ng/images/logo.png" title="Americare" style="font-weight:bold;font-size:18px;color:#fff;vertical-align:top" class="CToWUd" /> </td>
                        </tr>
                        <tr width="100%">
                            <td valign="top" align="left" style="background:#fff;padding:18px">
                                <img width="580" src="https://adashi.com.ng/images/signup_email_banner.png" />
                                <h1 style="font-size:20px;margin:16px 0;color:#333;text-align:center"> Thank you for registering! </h1>

                                <p style="font:15px/1.25em "Helvetica Neue",Arial,Helvetica;color:#333;text-align:center"> 
                                We are happy you decided. to join us. Here at Adashi, We think of ourselves and customers as a big family. That mean we help you solve your savings problems.</p> 
                               
                                <p style="font:15px/1.25em "Helvetica Neue",Arial,Helvetica;color:#333;text-align:center"> 
                                The right service and rewarding relationship awaits you.
                                 </p>

                                <div style="background:#f6f7f8;border-radius:3px">
                                    <br>

                                    <p style="text-align:center">
                                        <a href="" style="color:#343e4f;font:26px "Helvetica Neue",Arial,Helvetica;text-decoration:none;font-weight:bold"
                                            target="_blank">Hello '.$fullname.',</a>
                                    </p>

                                    <p style="font:15px/1.25em "Helvetica Neue",Arial,Helvetica;margin-bottom:0;text-align:center">
                                        <a href="" style="border-radius:3px;background:#3B2A56;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 6px;padding:10px 18px;text-decoration:none;width:180px;text-align: center;"
                                            target="_blank"> Verify Email</a>
                                    </p>

                                    <br>
                                    <br> </div>

                                <p style="font:14px/1.25em "Helvetica Neue",Arial,Helvetica;color:#333">
                                    <strong>Didn\'t Request?</strong> You are recieving this email because you are a registered customer on Adashi website.
                                    <a href="#" style="color:#306f9c;text-decoration:none;font-weight:bold"
                                        target="_blank">Learn more »</a>
                                </p>

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
 if (mail($to,$subject, $message, $headers, '-fsupport@adashi.com.ng')){
    // mail sent successful
       
    }
      
}
// 6.1 end sign up email

############### END SIGN UP EMAIL #############

############### EMAIL VERIFICATION EMAIL ##################
// 6.1 sign up email
public function verification_email($user_email, $fullname, $token){

    //password reset hash
    //$id_hash=base64_encode($id);
     $token_hash=base64_encode($token);
     $salt=rand(3883991,9938848484);
     $user_hash=md5($salt);
    //$user_hash=sha1(base64_encode($user_email));
    
    // backend change password link
    $link="https://americaremedics.com/email-activation?temp=".$token_hash."&key=".$user_hash;
   

    $host = "americaremedics.com"; //replace this with your domain's SMTP address
    $username = "support@americaremedics.com";
    $passwords = "b)#m-!XK(Pdak";
    $port="465";
    
     $to = $user_email;
    $subject = "Email Verification";
    
    
      $headers = "MIME-Version: 1.0\n"; 
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n"; 
            $headers .= "X-Priority: 1 (Highest)\n"; 
            $headers .= "X-MSMail-Priority: High\n"; 
            $headers .= "Importance: High\n";
    $headers .= 'From: Americare Medical Distributors <support@americaremedics.com>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";
       
    // header section and info ends
    
    //messgae section starts from here
   
    $message = '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em "Helvetica Neue",Arial,Helvetica">
    <tbody>
        <tr width="100%">
            <td valign="top" align="left" style="background:#eef0f1;font:15px/1.25em "Helvetica Neue",Arial,Helvetica">
                <table style="border:none;padding:0 18px;margin:50px auto;width:500px">
                    <tbody>
                        <tr width="100%" height="60">
                            <td valign="top" align="left" style="border-top-left-radius:4px;border-top-right-radius:4px;background:#e2e1e1 url(https://ci5.googleusercontent.com/proxy/EX6LlCnBPhQ65bTTC5U1NL6rTNHBCnZ9p-zGZG5JBvcmB5SubDn_4qMuoJ-shd76zpYkmhtdzDgcSArG=s0-d-e1-ft#https://trello.com/images/gradient.png) bottom left repeat-x;padding:10px 18px;text-align:center">
                                <img  width="155" src="https://americaremedics.com/assets/images/logo.png" title="Americare" style="font-weight:bold;font-size:18px;color:#fff;vertical-align:top" class="CToWUd" /> </td>
                        </tr>
                        <tr width="100%">
                            <td valign="top" align="left" style="background:#fff;padding:18px">
                                <img width="580" src="https://americaremedics.com/assets/images/banner/signup.png" />
                                <h1 style="font-size:20px;margin:16px 0;color:#333;text-align:center"> Verify email address! </h1>

                                <p style="font:15px/1.25em "Helvetica Neue",Arial,Helvetica;color:#333;text-align:center"> 
                                Click on the Verify Now to activate your Americare Medical Distributors Account </p>

                                <div style="background:#f6f7f8;border-radius:3px">
                                    <br>

                                    <p style="text-align:center">
                                        <a href="" style="color:#343e4f;font:26px "Helvetica Neue",Arial,Helvetica;text-decoration:none;font-weight:bold"
                                            target="_blank">Hello '.$fullname.',</a>
                                    </p>

                                    <p style="font:15px/1.25em "Helvetica Neue",Arial,Helvetica;margin-bottom:0;text-align:center">
                                        <a href="'.$link.'" style="border-radius:3px;background: #bf353e;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 6px;padding:10px 18px;text-decoration:none;width:180px;text-align: center;"
                                            target="_blank"> Verify Now!</a>
                                    </p>

                                    <br>
                                    <br> </div>

                                <p style="font:14px/1.25em "Helvetica Neue",Arial,Helvetica;color:#333">
                                    <strong>Didn\'t Request?</strong> You are recieving this email because you are a registered customer on Americare Medical Distributor website.
                                    <a href="#" style="color:#306f9c;text-decoration:none;font-weight:bold"
                                        target="_blank">Learn more »</a>
                                </p>

                            </td>

                        </tr>

                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>';
    $message.='';

    if (mail($to,$subject, $message, $headers, '-fsupport@americaremedics.com')){
    
       //  echo $message;
       echo "1";
    }
      
}
// 6.1 end sign up email



############### END ACCOUNT VERIFICATION EMAIL #############



    } // end mailing class
?>