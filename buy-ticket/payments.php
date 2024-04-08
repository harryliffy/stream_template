<?php

require_once('../admin/src/functions.php');
$core= new atwLive();
// Assuming $this->DBconn is your database connection object

// Function to generate and insert 50 records recursively
function generate_and_insert_tickets_recursively($ticket_count) {
  $success_count = 0;
  for ($i = 0; $i < $ticket_count; $i++) {
      // Generate random data for each ticket
      $full_name = "ATWLive " . ($i + 1);
      $phone = "09037034192"; // Update with your logic to generate phone numbers
      $email = "vafrica" . ($i + 1) . "@atwlive.com";
      // $video_id = "video_id_" . ($i + 1);
      // $passcode = "passcode_" . ($i + 1);
      $payment_ref = "payment_ref_" . ($i + 1);
      $created_date = date('Y-m-d H:i:s');

  
      // $date=Date("d-m-y h:i:s");
      $video_id="V_africa";
      // $payment_ref=$_GET['reference'];
      $ticket_token=md5(rand(28697, 276*600));
    
      $token=md5(rand(286997, 276*700));
      // generate code
      $random = time() . rand(100*45, 100*98);
      $encoded= md5($random);
      $passcode_trans= strtoupper($encoded);
      $passcode=substr($passcode_trans, 0, 7);


      // Insert ticket using your function
      $result = $core->get_ticket($full_name, $phone, $email, $video_id, $passcode, $payment_ref, $ticket_token, $created_date);
      
      // Check if ticket insertion was successful
      if ($result === "2") {
          $success_count++;
      }
  }
  return $success_count;
}
 
// Call the function to generate and insert 50 records
$success_count = generate_and_insert_tickets_recursively(3);

// Output success count
echo "Successfully inserted " . $success_count . " tickets.";
