<?php
    include ('functions.php');
     $pay=new atwLive();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $link_name=$_POST['name'];
        $link_desc=$_POST['description'];
        $link_currency=$_POST['currency'];
               $link_amount=$_POST['amount'];
            //    $link_url='slug';
               $salt=rand(346485,9998655);
               $link_token=md5($salt);
               $link_date=Date("d-m-Y");
            //    $link_slug="slug";
                $redirect_url=$_POST['redirect_url'];
                 $video_token=$_POST['video_token'];
                  $link_status="active";
                   $link_type=$_POST['link_type'];

                   


        $url = "https://api.paystack.co/page";

        $fields = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'amount' => $_POST['amount'],
            'currency' => $_POST['currency'],
            'redirect_url' => $_POST['redirect_url']
        ];

        $fields_string = http_build_query($fields);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer sk_live_1bfa8a1a01779d12a322a3ead7446d2076708402",
            "Cache-Control: no-cache",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($http_code == 200) { // Payment page creation successful
            // Parse JSON response
            $response = json_decode($result, true);

            // Save payment details to database
            try {
                $paystack_slug=$response['data']['slug'];
                if($link_type=="paystack"){
                    $link_url="https://paystack.com/pay/".$paystack_slug;
                    $link_slug=$paystack_slug;
                }
                $pay->add_payment_link( $link_name, $link_desc, $link_currency, $link_amount, $link_url, $link_token, $link_date, $link_slug, $redirect_url, $video_token, $link_status, $link_type);

               
                // $stmt->bindParam(':paystack_page_id', $response['data']['id']); // Assuming the Paystack API response contains a unique ID for the created page
               

                echo "Payment details saved to database successfully.";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Failed to create Paystack page. HTTP code: $http_code";
        }

       
    }
    ?>