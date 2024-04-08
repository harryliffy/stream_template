<?php
// header("Access-Control-Allow-Origin: https://admin.atwlive.com");

include_once('header.php');
?>


     
<style>
  .vd-bg {
    object-fit: cover;
    opacity: 0.2;
  }
</style>
<header class="slider">
  <div class="main-slider">
    <div class="swiper-wrapper">
      <video playsinline class="slide-inner bg-image vd-bg video-bg" autoplay muted loop>
        <source src="vafrica.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>



      <!-- end swiper-slide -->
      <div class="swiper-slide" style="position: absolute; margin-top: 10px;">
        <!-- <div class="slide-inner bg-image" data-background="images/atw-live-landing2.jpg"> -->
        <div class="container" data-swiper-parallax="200">
          <div class="row" style="background-color:#000000a6; border-radius: 21px; padding: 25px; min-height: 74vh;">
            <div
              style="background:url('v_africa1.jpg'); background-repeat:no-repeat; background-size:cover; min-height:43vh"
              class="col-lg-6 col-sm-4">
              <!-- <img height="350px" srcset=""> -->
            </div>
            <div class="col-lg-6 col-sm-4 m-auto">

              <div class="my-auto p-8" style="">
                <h3 class="mt-2 text-brand-text font-bold" style="font-weight: 900;"> REVCON Abuja</h3>
                <b href="#" class="block mt-1 text-lg leading-tight font-medium hover:underline" style="color: #d39638;"> Live streaming</b>

                <br>
            
                <br>

                <p class="mt-2">     <a href="#" class="col-md-12 col-lg-10 mt-4" style="color: #fff;border-radius: 15px;background-color: #353533;font-size: 14px;padding:8px;"><i class="lni lni-lock-alt"></i> Watch with access code</a> <br>
                
                   </p>
                    <form style="margin: auto;" name="login-form" id="login-form" method="post" novalidate="novalidate">

                <div id="result" style="display: none;">
                  <div class="col-md-12 alert alert-danger" role="alert"><strong>Wrong/invalid passcode</strong></div>
                </div>

                <!-- <h2>Don't have a ticket? <a target="_blank" href="pay/" class="play-btn-2" >Buy ticket</a></h2> -->

                <div class="row">
                  <div class="col-7" style="padding-right:0;"><input style="height:66px; width:100%" class="access-code"
                      type="" placeholder="Enter access code" name="access-code" id="access-code"></div>
                  <div class="col-4" style="padding-left:0;">
                    <button class="play-btn-1" type="submit" id="btn-login" name="btn-login">Watch </button>
                  </div>
                </div>

              </form>
                    <p class="mt-2"> <b>V-AFRICA 2024. REVCON is here. Get ready as we bring its unstoppable magic all the way to Abuja, Nigeria.</b><br></p>

              </div>
             
            </div>
          </div>
          <?php
if (isset($_GET['ticket'])) {
    $ticket_code = $_GET['ticket'];
    echo '<script>
            var numberToFill = "' . $ticket_code . '"; 
            var accessCodeInput = document.getElementById("access-code");
            accessCodeInput.value = numberToFill;
            var playButton = document.getElementById("btn-login");
            // playButton.click();
          </script>';
} else {
    // Handle the case when the 'ticket' parameter is not set
}
?>

        </div>
        <!-- end container -->
        <!-- </div> -->
        <!-- end slide-inner -->
      </div>
      <!-- end swiper-slide -->
    </div>
    <!-- end swiper-wrapper -->
    <div class="swiper-pagination"></div>
    <!-- end swiper-pagination -->
  </div>
  <!-- end main-slider -->
</header>
<!-- end slider -->

<main>
  
<div id="openMyPopup" class="video-btn" data-toggle="modal"
          data-src="https://player.castr.com/live_0eea5c60d7fa11eebedcb70a9648f67f"
          data-target="#myModal"></div>
        
<section>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <style>
      /* body {margin:2rem;} */
      .modal-backdrop.show {
        z-index: -100 !important;
        padding-right: 0 !important;

      }

      .modal-open .modal {
        padding-right: 0 !important;
        background-color: #000;
      }

      .modal-dialog {
        max-width: 800px;
        margin: 30px auto;
      }



      .modal-body {
        position: relative;
        padding: 0px;
      }

      .close {
        position: absolute;
        /* right:-30px; */
        top: 0;
        z-index: 999;
        font-size: 2rem;
        font-weight: normal;
        color: #ffffff;
        opacity: 1;
      }
    </style>

  <!-- Modal -->
    <div class="modal fade" id="myModal" style="padding-right:0px!important" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">


          <div class="modal-body">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <!-- 16:9 aspect ratio -->
            <div class="embed-responsive ">
              <div id="pagg"> </div>
              <!-- <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe> -->
            </div>
 

          </div>

        </div>
      </div>
    </div>



    <script src="script.js"></script>
    </section>
  <!-- end footer -->
</main>

<!-- <script language="javascript" type="text/javascript" src="//play.webvideocore.net/js/dplayer.js"></script>
<script language="javascript">

// var vars = {clip_id:"alo0hdi7ii0o",transparent:"true",repeat:"",bg_color:"#ffffff",fs_mode:"2",only_fs:1,fs_popin:"1",close_button:"1",brand_new_window:"1",auto_hide:"1",stretch_video:"",bg_transp:"40",player_color_ratio:0.6,rid:164842612442,start_volume:"34",skinAlpha:"50",colorBase:"#250864",colorIcon:"#ffffff",colorHighlight:"#7f54f8",direct:"false",viewers_limit:0,cc_position:"bottom",cc_positionOffset:70,cc_multiplier:0.03,cc_textColor:"#ffffff",cc_textOutlineColor:"#ffffff",cc_bkgColor:"#000000",cc_bkgAlpha:0.1,force_size:"false",no_controls:"",play_button:"1",play_button_style:"pulsing",sleek_player:"1"};
// var svp_player = new SVPDynamicPlayer("", "", "720", "405", {skin:"3"}, vars);
// svp_player.addListener(window, 'load', function() {svp_player.getObject("svp_164842612442").onclick=function(){OpenFullScreen(164842612442);return false;};});
// svp_player.execute();

</script> -->
<!-- JS FILES -->

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="js/bootstrap.min.js"></script>
<script src="admin/src/validation.min.js"></script>
<script type="text/javascript" src="admin/src/access.js"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script src="tec-vibes/script.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/fancybox.min.js"></script>
<!--<script src="js/scripts.js"></script>-->

<!-- <script  src="./script.js"></script> -->
</body>
</html>