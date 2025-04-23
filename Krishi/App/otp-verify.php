<?php 
require('private/autoload.php');
if(!isset($_SESSION['login']) && isset($_SESSION['phone'])){

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
    <title>Krishisampark Otp Verification</title>

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
      <a href="login"
        ><i class="bi bi-arrow-left d-flex text-danger h2 m-0 back-page"></i
      ></a>
      <h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'otp_verification');?></h3>
    </div>
    
  </div>
</div>

<div class="text-center my-5 h5">
  <div><h2><?=getLanguageString($con,$lang,'we_have_sent_a_verification_code_to');?></h2></div>
  <div class="fw-bold mt-2"><h2>+91 <?=$_SESSION['phone'];?></h2></div>
  
   <?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Display error message
if (isset($_SESSION['errorMsg'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMsg'] . '</div>';
    unset($_SESSION['errorMsg']);
}
?>
</div>
<?php
                       
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            
                                $otp = $_SESSION['verification_otp'];
                                if($otp == $_POST['otp_code']){
                                $phone = $_SESSION['phone'];
                                
                                

                                date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
                        $date = date('d M, Y');
                        $userId = generateRandomString(10);
                    
                        $existingUser = true;
                    
                        while ($existingUser) {
                            $checkQuery = "SELECT * FROM users WHERE userId = :userId LIMIT 1";
                            $checkStmt = $con->prepare($checkQuery);
                            $checkUserId = $checkStmt->execute(['userId' => $userId]);
                    
                            if ($checkUserId) {
                                $data = $checkStmt->fetchAll(PDO::FETCH_OBJ);
                    
                                if (is_array($data) && count($data) < 1) {
                                    $existingUser = false;
                                } else {
                                    $userId = generateRandomString(10);
                                }
                            }
                        }
                        
                    
                            $Checkquery = "select * from users where phone = :phone limit 1";
                            $checkstm = $con->prepare($Checkquery);
                            $check = $checkstm->execute(['phone'=>$phone]);
                            if(($check)){
                                $data = $checkstm->fetchAll(PDO::FETCH_OBJ);
                                if(is_array($data) && count($data)<1){
                                    
                                    
                                    $createUser = "insert into users (status,created_at,phone,userId,profile_pic) values(:status,:created_at,:phone,:userId,:profile_pic)";
                                    $stm = $con->prepare($createUser);
                                    $stm->execute(['status'=>1,'created_at'=>$date,'phone'=>$phone,'userId'=>$userId,'profile_pic'=>'https://krishisampark.com/img/user.png']);
                                    
                                    
                                    setcookie('userLoggedIn', true, time() + (30 * 24 * 60 * 60), '/','');
                                    setcookie('krishiUserId', $userId, time() + (30 * 24 * 60 * 60), '/');
                                    
                                    $_SESSION['userId'] = $userId;
                                    $_SESSION['login']=true;
                                   
                                    echo "<script>window.location='main'</script>";
                                    
                                }else{
                                    
                                    setcookie('userLoggedIn', true, time() + (30 * 24 * 60 * 60), '/');
                                    setcookie('krishiUserId', $data[0]->userId, time() + (30 * 24 * 60 * 60), '/');
                                    
                                    $_SESSION['userId'] = $data[0]->userId;
                                    $_SESSION['login']=true;
                                    
                                    echo "<script>window.location='main'</script>";
                                    
                                }
                            }
                            
                                }else{
                                   $_SESSION['errorMsg']  = 'Wrong OTP.';

                                    echo "<script>window.location='otp-verify'</script>";

                                }
                        }
                        ?>
<form method="POST" action="" id="otp-form">
<div class="text-center px-5">
  <div class="mb-3">
    <div>
     <input
            class="shadow-none form-control px-0 text-center"
            type="number"
            placeholder="<?=getLanguageString($con,$lang,'enter_four_digit_code');?>"
            value="<?php echo $_SESSION['verification_otp'];?>"
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
// Check if the WebOTP API is available in the browser
if ("OTPCredential" in window) {
  // Request an OTP using the WebOTP API
  navigator.credentials.get({
    otp: { transport: ["sms"] },
    signal: new AbortController().signal,
  })
  .then(function (otp) {
    // Extract the OTP from the response
    const otpCode = otp.code;

    // Fill the OTP input field with the received OTP
    const otpInput = document.querySelector("input[name='otp_code']");
    if (otpInput) {
      otpInput.value = otpCode;

      // Automatically submit the form
      otpInput.closest("form").submit();
    }
  })
  .catch(function (error) {
    console.error("Error getting OTP:", error);
  });
}
</script>



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