<?php require('private/autoload.php');
if(!isset($_SESSION['login']) && isset($_SESSION['data'])){
if(isset($_SESSION['selected_language'])){
    $lang = $_SESSION['selected_language'];    
}else{
    $lang = 'en';
}

?>
<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="img/krishi.png" type="image/png" />
    <title>Krishisampark</title>

    <link rel="stylesheet" href="vender/bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" href="vender/icons/icofont.min.css" />

    <link rel="stylesheet" href="vender/slick/slick/slick.css" />
    <link rel="stylesheet" href="vender/slick/slick/slick-theme.css" />

    <link href="vender/fontawesome/css/all.min.css" rel="stylesheet" />

    <link href="vender/sidebar/demo.css" rel="stylesheet" />

    <link rel="stylesheet" href="css/style.css" />
    <!--<style>-->
    <!--    *{-->
    <!--        font-size:18px;-->
    <!--    }-->
    <!--</style>-->
  </head>
  <body>
<div class="bg-white sticky-top shadow-sm p-3">
  <div class="d-flex align-items-center">
    <div class="gap-3 d-flex align-items-center">
      <a href="register"
        ><i class="bi bi-arrow-left d-flex text-danger h2 m-0 back-page"></i
      ></a>
      <h3 class="fw-bold m-0">OTP Verification</h3>
    </div>
    
  </div>
</div>

<div class="text-center px-2 my-5 h5">
  <div><h2><?=getLanguageString($con,$lang,'we_have_sent_a_verification_code_to');?></h2></div>
  <div class="fw-bold mt-2"><h2>+91 <?=$_SESSION['data']['phone'];?></h2></div>
  
   <?php

// Display error message
if (isset($_SESSION['errorMsg'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMsg'] . '</div>';
    unset($_SESSION['errorMsg']);
}
?>
</div>
<?php
                       
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            
                                $otp = $_SESSION['otp'];
                                if($otp == $_POST['otp_code']){
                                $data = $_SESSION['data'];

                                $apiUrl = $apiUrl . 'register.php';
                                $ch = curl_init($apiUrl);


                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


                                $response = curl_exec($ch);


                                if ($response === false) {
                                    die('cURL error: ' . curl_error($ch));
                                }


                                curl_close($ch);

                               
                                $result = json_decode($response, true);
                                if ($result['success'] === true) {
                                    if ($result['message'] === 1) {
                                        
                                        setcookie('userLoggedIn', true, time() + (30 * 24 * 60 * 60), '/');
                                        setcookie('krishiUserId', $result['user_id'], time() + (30 * 24 * 60 * 60), '/');
                                    
                                    $_SESSION['userId'] = $result['user_id'];
                                    $_SESSION['login']=true;
                                    
                                    echo "<script>window.location='main'</script>";
                                        
                                    } else {
                                         $_SESSION['errorMsg']  = 'Something went wrong.';
                                          echo "<script>window.location='register'</script>";
                                    }
                                } else {
                                    $_SESSION['errorMsg'] = 'Error: ' . $result['message'];
                                     echo "<script>window.location='register'</script>";
                                }
                                
                               

                            
                                }else{
                                   $_SESSION['errorMsg']  = 'Wrong OTP.';

                                    echo "<script>window.location='otp_verify'</script>";

                                }
                        }
                        ?>
<form method="POST" action="">
<div class="text-center px-5">
  <div class="mb-3">
    <div>
     <input
            class="shadow-none form-control px-0 text-center"
            type="number"
            placeholder="Enter 4 digit otp"
            value="<?=$_SESSION['otp'];?>"
            required
            name="otp_code"
            oninput="this.value = this.value.replace(/\D/g, '').substring(0, 4);"
        />

    </div>
    
  </div>
  <!--<div class="d-flex d-grid gap-2 mb-3">-->
  <!--  <button type="button" class="btn btn-outline-secondary w-50 btn-sm">-->
  <!--    Resend SMS in 15-->
  <!--  </button>-->
  <!--  <button type="button" class="btn btn-outline-secondary w-50 btn-sm">-->
  <!--    Call me in 15-->
  <!--  </button>-->
  <!--</div>-->
 
</div>

<div class="bg-white text-center">
  <button type="submit" class="btn krishisampark-btn btn-lg text-white"><?=getLanguageString($con,$lang,'continue');?></button>
</div>

</form>



    <script
      src="vender/jquery/jquery.min.js"
      type="cb92e66072300611785244f0-text/javascript"
    ></script>
    <script
      src="vender/bootstrap/js/bootstrap.bundle.min.js"
      type="cb92e66072300611785244f0-text/javascript"
    ></script>

    <script
      src="vender/slick/slick/slick.min.js"
      type="cb92e66072300611785244f0-text/javascript"
    ></script>

    <script
      src="vender/sidebar/hc-offcanvas-nav.js"
      type="cb92e66072300611785244f0-text/javascript"
    ></script>

    <script
      src="js/custom.js"
      type="cb92e66072300611785244f0-text/javascript"
    ></script>
    <script
      src="https://askbootstrap.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
      data-cf-settings="cb92e66072300611785244f0-|49"
      defer
    ></script>
    <script
      defer
      src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
      integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
      data-cf-beacon='{"rayId":"7dcef2cba8c30da6","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}'
      crossorigin="anonymous"
    ></script>
    
      <script>
    // Add an event listener to the form submission
    document.getElementById('login-form').addEventListener('submit', function (e) {
      // Prevent the form from submitting
      e.preventDefault();

      // Display the "Registering..." message
      document.getElementById('login-btn').textContent = 'Please wait...';

      // Submit the form after a short delay (simulating registration process)
      setTimeout(function () {
        document.getElementById('login-form').submit();
      }, 2000);
    });
  </script>
  </body>

 
</html>
<?php } ?>