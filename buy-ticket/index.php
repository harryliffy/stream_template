<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ATW Live | Buy Ticket</title>
<meta name="author" content="ATW Live">
<meta name="description" content="ATW Live | Lets Be honest Ticket By Dike Chukwumerije">
<meta name="keywords" content="ATWLive, video, Advanced Teamworks, shows, tv, watch, online, streaming, stream, ads, trailer, , drama action, hollywood, cinema, rate">

  <link href="../images/favicon.png" rel="apple-touch-icon" sizes="72x72">
<!-- <link href="ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon"> -->
<link href="../images/favicon.png" rel="shortcut icon">
  <link href="output.css" rel="stylesheet">
  <style>
    .iti.iti--allow-dropdown{
      min-width:100%;
    
    }
    .iti__country-list {
      color:#000000!important;
    }
   
  </style>
</head>

<body class="bg-brand-dark">
  <img src="dike_bg.png" alt=""
    class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center">
  <div class="m-[15px] md:m-[87px] relative rounded-xl overflow-auto">
    <!-- <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl"> -->
    <div class=" mx-auto bg-brand-dark text-white rounded-xl shadow-md overflow-hidden">
      <div class="md:flex relative">
        <div class="md:shrink-0 relative">
          <img class="h-full w-full object-cover md:h-full md:w-[41rem]"
            src="https://atwlive.com/dike/dike-vod.jpg" alt="Modern building architecture">
          <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <button class="open-button1 play-button hover:bg-greeen-500"> <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-12 w-12 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z" />
              </svg></button>
          </div>
        </div>
        <div class="my-auto p-8">
          <div class="uppercase text-sm text-center text-brand-text font-bold md:text-2xl lg:text-2xl">Let's Be Honest (VOD)</div>
          <a href="#"
            class="uppercase block mt-1 text-center leading-tight text-[1.4rem] font-medium text-white md\:text-2xl lg\:text-2xl ">
            Video on Demand</a>
          <br>
          <?php 
// PHP code to extract IP 

function getVisIpAddr() { 
	
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
		return $_SERVER['HTTP_CLIENT_IP']; 
	} 
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
		return $_SERVER['HTTP_X_FORWARDED_FOR']; 
	} 
	else { 
		return $_SERVER['REMOTE_ADDR']; 
	} 
} 

// Store the IP address 
$vis_ip = getVisIPAddr(); 

// Display the IP address 
$ip = $vis_ip; 
  
// Use JSON encoded string and converts  
// it into a PHP variable 
$ipdat = @json_decode(file_get_contents( 
    "http://www.geoplugin.net/json.gp?ip=" . $ip)); 
   
// echo 'Country Name: ' . $ipdat->geoplugin_countryName . "\n"; 
// echo 'City Name: ' . $ipdat->geoplugin_city . "\n"; 
// echo 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n"; 
// echo 'Latitude: ' . $ipdat->geoplugin_latitude . "\n"; 
// echo 'Longitude: ' . $ipdat->geoplugin_longitude . "\n"; 
// echo 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n"; 
// echo 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n"; 
// echo 'Timezone: ' . $ipdat->geoplugin_timezone; 

?>

<script src="https://js.paystack.co/v2/inline.js"></script>
        <?php
if ($ipdat->geoplugin_countryName=='Nigeria'){
  echo '   <form class="space-y-4">
  <div class="uppercase text-4xl text-center text-brand-text font-bold">N 5,000</div>
  <p class="text-lg text-center text-black-700 mb-2">Single User PPV Ticket</p>
  <div>
    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full name</label>
    <div class="mt-2">
      <input id="name" name="name" type="text"  required style="color:grey; padding:2px"
        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
    </div>
  </div>

  <div>
    <div class="flex items-center justify-between">
      <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>

    </div>
    <div class="mt-2">
      <input id="email" name="email" type="email" required style="color:grey; padding:2px "
        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
    </div>
  </div>
  <div>
    <div class="flex items-center justify-between">
      <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Phone</label>

    </div>
    <div class="mt-2">
      <input id="phone" name="phone" type="tel" required style="color:grey"
        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            
    </div>
  </div>
  <input type="hidden" name="country_dial_code" id="country_dial_code"> 

  <div>
 <a href="#" onclick="payWithPaystack()"
      class="mt-2 flex w-full justify-center rounded-md bg-brand-dark px-3 py-1.5 text-lg font-semibold leading-6 text-white shadow-md hover:bg-off-white hover:text-brand-text">Pay
      Now</a>
  </div>
</form>';
  }else{ 
    echo ' <form class="space-y-4" >

    <p class="text-lg text-center text-black-700 mb-2">Single User PPV Ticket</p>
   <div>
    <script async
    src="https://js.stripe.com/v3/buy-button.js">
  </script>
  
  <stripe-buy-button
    buy-button-id="buy_btn_1OfMh6EuNIr6vidiXsMLDnlG"
    publishable-key="pk_live_51Oa2J6EuNIr6vidi3jwfUtsWuwRNaAZaXZXNggmwCVbZsEAHCrN4LdyWb8sH1HCYrasxknOJl3K1HiFQzomJcFXI00OXnu2EPR"
  >
  </stripe-buy-button>
    </div>
  </form>';
  }
  ?>

        </div>

      </div>
    </div>


    <dialog class="modal p-8 bg-modal rounded-xl text-black" id="modal">
      <button class="button font-bold close-button float-right hover:text-brand-text hover:underline">close X</button>
      <!-- <img src="img/timeless_bg.jpg" alt="" class="opacity-50 absolute inset-0 -z-10 h-full w-full object-cover object-right" /> -->

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="text-lg text-center text-black-700 mb-2">Provide your details and click pay to continue</h2>
        <br>
       


      </div>

    </dialog>
    <!-- end payment dialog -->


  </div>


  <script>
    function formatPhoneNumberForTwilio() {
    // Get the phone number input element and country code input element
    var phoneInput = document.getElementById('phone');
    // var phone = document.getElementById('phone').value;
    var countryCodeInput = document.getElementById('country_dial_code');

    // Get the phone number and country code values
    var phoneNumber = phoneInput.value.trim().replace(/[()-\s]/g, ''); // Trim white spaces, parentheses, and hyphens
    var countryCode = countryCodeInput.value.trim();
    phoneNumber = phoneNumber.replace(/^0+/, '');
    // Check if the phone number starts with the country code
    if (!phoneNumber.startsWith('+')) {
        // Add the country code to the phone number
        phoneNumber = '+' + countryCode + phoneNumber;
    }

    // Return the formatted phone number
    return phoneNumber;
}

// Example usage:

    function payWithPaystack() {
      var publicKey = '########';

      var name = document.getElementById('name').value;
      //  = document.getElementById('phone').value;
      var email = document.getElementById('email').value;

      var phones = formatPhoneNumberForTwilio(); 
      // console.log(phones); 

      
      // Validate the form fields
      if (!name || !phones || !email) {
        alert('Please fill in all the required fields.');
        return;
      }

      var handler = PaystackPop.setup({
        key: publicKey,
        email: email,
        firstname: name,
        // lastname: name,
        phone: phones,
        amount: 500000,
        currency: 'NGN',
        ref: 'paystack_' + Math.floor((Math.random() * 1000000000) + 1),
        callback: function (response) {
          window.location = "https://atwlive.com/pay/payments?reference=" + response.reference;
          // alert('Payment successful! Transaction reference: ' + response.reference);  
        },
        onClose: function () {
          alert('Transaction was not completed. Please try again.');
        }
      });

      handler.openIframe();
    }
  </script>





  <!-- <script src="./script.js"></script> -->

  <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
  <script src="country_code.js"></script>
</body>

</html>