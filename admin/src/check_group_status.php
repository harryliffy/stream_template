<?php
include('functions.php');
// Retrieve the video token from the URL parameters
$videoToken = $_GET['video_token'];

$pay = new atwLive();
$output = $pay->pay_group_exist($videoToken);

if ($output) {

    $link_output =$pay->fetch_link_details($videoToken);

    //  $pay->pay_group_exist($videoToken);

if ($link_output && count($link_output) > 0) {
    // Iterate over each payment and display details
    $a=count($link_output);
  
   
        echo '<div class="mb-5 card-body">
        <h2 class="small-title">Available Payment Methods</h2>
        <div class="row row-cols-1 row-cols-xl-3 g-2">';
         foreach ($link_output as $payment) {
        
            echo '<div class="col">
                <div class="card h-100 hover-scale-up">
                    <div class="card-body pb-0">
                        <div class="d-flex flex-column align-items-center mb-4">
                            <div
                                class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Paystack.png/220px-Paystack.png" width="100" />
                            </div>
                            <div class="cta-4 text-primary mb-1">'. $payment['link_name'].'</div>
                            <div class="text-muted sh-3"></div>
                            <div class="display-4">'. $payment['link_currency'].' '. $payment['link_amount'].'</div>
                            <div class="text-small text-muted mb-1">Ticket Price</div>
                        </div>
                        <p class="text-alternate mb-0 text-center">
                        <div class="text-small text-muted mb-1">Description</div>
                        '. $payment['link_description'].'</p>
                    </div>
                    <div class="card-footer pt-0 border-0">
                        
                        <div class="d-flex justify-content-center">
                            <a target="_blank" href="'. $payment['link_url'].'"
                                class="btn btn-icon btn-icon-start btn-foreground hover-outline stretched-link">
                                <i data-acorn-icon="chevron-right"></i>
                                <span>Preview Link</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>';
    }
    while($a < 3){
        echo '<div class="col">
                <div class="card h-100 hover-scale-up">
                    <div class="card-body pb-0">
                        <div class="d-flex flex-column align-items-center mb-4">
                        
                            <div class="cta-4 text-primary mb-1">New Payment </div>
                            <div class="text-muted sh-3"></div>
                            
                            <div class="text-small text-muted mb-1">User/Month</div>
                        </div>
                        <div class="text-center">
                        <img src="img/illustration/icon-launch.webp" class="theme-filter" alt="launch">
                        <div class="cta-1">There is no Payment Method!</div>
                        <div class="cta-3 text-primary mb-4">Would you like to create one?</div>
                        <a href="#" class="btn btn-primary btn-lg" onclick="openModal()">NEW PAYMENT</a>
                    </div>
                    </div>
                    <div class="card-footer pt-0 border-0">
                        <div class="mb-4">
                                                     
                         
                           
                        </div>
                        <div class="d-flex justify-content-center">
                          
                        </div>
                    </div>
                </div>
            </div>';
        $a++;
    }
    echo '
    </div>
</div>';
}
    
} else {
    echo '<div class="card-body sh-50 d-flex align-items-center justify-content-center">
            <div class="text-center">
                <img src="img/illustration/icon-launch.webp" class="theme-filter" alt="launch">
                <div class="cta-1">There is no Payment Method!</div>
                <div class="cta-3 text-primary mb-4">Would you like to create one?</div>
                <a href="#" class="btn btn-primary btn-lg" onclick="openModal()">NEW PAYMENT</a>
            </div>
        </div>';
}
?>
