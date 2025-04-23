<?php require('private/autoload.php');
if(!isset($_SESSION['login'])){

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
  </head>
  <body>
    
    <div class="bg-white p-4 mt-3">
      <div class="text-center px-4 mb-4 mt-1">
        <img src="<?=$baseurl;?>app/img/krishi.png" style='width:50%'>
      </div>
      <!--<div class="d-flex gap-3 align-items-center justify-content-center mb-2">-->
      <!--  <div class="w-25">-->
      <!--    <hr />-->
      <!--  </div>-->
      <!--  <div class="text-muted">Sign Up </div>-->
      <!--  <div class="w-25">-->
      <!--    <hr />-->
      <!--  </div>-->
      <!--</div>-->
      <div class="mb-3">
             <?php
// Display success message
if (isset($_SESSION['successMsg'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['successMsg'] . '</div>';
    unset($_SESSION['successMsg']);
}

// Display error message
if (isset($_SESSION['errorMsg'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMsg'] . '</div>';
    unset($_SESSION['errorMsg']);
}
?>



                        <?php
                       
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (isset($_POST['name']) && isset($_POST['phone'])) {

                                extract($_POST);
                                if($name!='' && $phone!='' && $user_type!=''){
                                 if (strlen($phone) == 10) {
                                
                                $Checkquery = "select * from users where phone = :phone limit 1";
                                $checkstm = $con->prepare($Checkquery);
                                $check = $checkstm->execute(['phone'=>$phone]);
                                if(($check)){
                                    $userData = $checkstm->fetchAll(PDO::FETCH_OBJ);
                                    if(is_array($userData) && count($userData)<1){
                                        
                                   
                                    
                                $data = array(
                                    'name' => $name,
                                    'phone'=>$phone,
                                    'user_type' => $user_type,
                                    'language' => $language,
                                    'crops' => $crops
                                );
                                
                               
                                $otp = rand(1111,9999);
                                
                                $msg = "Your OTP is ".$otp." for creating account in Krishisampark";
                                $fields = array(
                                    "route" => "v3",
                                    "sender_id"=>"Cghpet",
                                    "message" => $msg,
                                    "language" => "english",
                                    "numbers" => $phone,
                                );
                        
                                $curl = curl_init();
                        
                                curl_setopt_array($curl, array(
                                  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                                  CURLOPT_RETURNTRANSFER => true,
                                  CURLOPT_ENCODING => "",
                                  CURLOPT_MAXREDIRS => 10,
                                  CURLOPT_TIMEOUT => 30,
                                  CURLOPT_SSL_VERIFYHOST => 0,
                                  CURLOPT_SSL_VERIFYPEER => 0,
                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                  CURLOPT_CUSTOMREQUEST => "POST",
                                  CURLOPT_POSTFIELDS => json_encode($fields),
                                  CURLOPT_HTTPHEADER => array(
                                    "authorization: s47DeUfVqJCQzv0PxYgknTRFmGMbAZOp6aXrjKlLh1NB2389dSlWp8jEctihPRsTrAHbZoCI0BgqukDd",
                                    "accept: */*",
                                    "cache-control: no-cache",
                                    "content-type: application/json"
                                  ),
                                ));
                        
                                $response = curl_exec($curl);
                                $err = curl_error($curl);
                        
                                curl_close($curl);
                        
                                if ($err) {
                                   $_SESSION['errorMsg']='Something went wrong.';
                                   echo "<script>window.location='register'</script>";
                                } else {
                                    $_SESSION['otp']=$otp;
                                    $_SESSION['data']=$data;
                                    echo "<script>window.location='otp_verify'</script>";
                                }
                               

                                    
                                    } else{
                                         $_SESSION['errorMsg']  = 'Provided mobile number already exists.';
                                           echo "<script>window.location='register'</script>";
                                    }
                                }else{
                                   $_SESSION['errorMsg']='Something went wrong.'; 
                                    echo "<script>window.location='register'</script>";
                                }
                                
                            }else{
                                    $_SESSION['errorMsg']='Please enter a valid 10 digits number.';
                                 echo "<script>window.location='register'</script>";
                            }
                                }else{
                                   $_SESSION['errorMsg']='Please fill all required fields.'; 
                                    echo "<script>window.location='register'</script>";
                                }
                            
                                   

                            }
                        }
                        ?>
                        
          <form action="" method="POST" id="register-form">

          
          <div class="">
            <label class="h3 mb-3"><?=getLanguageString($con,$lang,'register_as');?> : </label><br>
            <input
              type="radio"
              class=""
              placeholde=""
              value="2"
              required
              checked
              name="user_type"
            /> <span class='h3 mb-5'> &nbsp;&nbsp;<?=getLanguageString($con,$lang,'seller');?></span>
            
            <input
              type="radio"
              class=""
              style='margin-left:10px'
              placeholde=""
              value="1"
              name="user_type"
              
            /> <span class='h3 mb-5'> &nbsp;&nbsp;<?=getLanguageString($con,$lang,'buyer');?></span>
            
          </div><br>
          
           
          
          <div class="input-group mb-3">
            
            <input
              type="text"
              class="shadow-none form-control rounded-3"
              placeholder="<?=getLanguageString($con,$lang,'enter_your_name');?>"
              value=""
              name="name"
              
            />
          </div>
          
           <div class="input-group mb-3">
            
            <input
              type="number"
              class="shadow-none form-control rounded-3"
              placeholder="<?=getLanguageString($con,$lang,'enter_mobile_number');?>"
              value=""
              name="phone"
              
            />
          </div>
          
          <div class="input-group mb-3">
            
            <select
              class="shadow-none form-control rounded-3"
              name="language">
                <option value="" disabled selected>Choose Langauge</option>
                 <option <?php if(isset($_SESSION['selected_language'])){ if($_SESSION['selected_language']=='en') echo "selected";  }?> value='en'>English</option>
                <option <?php if(isset($_SESSION['selected_language'])){ if($_SESSION['selected_language']=='kannad') echo "selected";  }?> value='kannad'>ಕನ್ನಡ</option>
                <option  <?php if(isset($_SESSION['selected_language'])){ if($_SESSION['selected_language']=='marathi') echo "selected";  }?> value='marathi'>मराठी</option>
            </select>
          </div>
          
          <div class="input-group mb-3">
            
            <input
              type="text"
              class="shadow-none form-control rounded-3"
              placeholder="<?=getLanguageString($con,$lang,'crops_that_i_grow');?>"
              value=""
              name="crops"
              
            />
          </div>
          
          <div class="d-grid">
            <button type="submit" class="btn krishisampark-btn text-white btn-lg" id="register-btn"><?=getLanguageString($con,$lang,'submit');?></button>
          </div>
        </form>
      </div>
      <div class="d-flex gap-3 align-items-center justify-content-center mb-2">
        <div class="w-50">
          <hr />
        </div>
        <div class="text-muted">or</div>
        <div class="w-50">
          <hr />
        </div>
      </div>
      
      
     
      <div class="text-center">
        <a href="login">  <h3 class=" mb-5 text-dark"><?=getLanguageString($con,$lang,'already_have_an_account');?></h3></a>
        
        <p class="h3 mb-2 text-dark">Change Language</p>
        <div class="justify-content-center gap-3 small">
            <div class="mb-1"><a href="#" class="link-dark h4" data-language="en">English</a></div>
                <div class="mb-1"><a href="#" class="link-dark h4" data-language="kannad">ಕನ್ನಡ</a></div>
                <div class="mb-1"><a href="#" class="link-dark h4" data-language="marathi">मराठी</a></div>
            </div>
        <!--<p class=" mb-2 text-dark">By continuing you agree to our</p>-->
        <!--<div class="d-flex justify-content-center gap-3 small">-->
        <!--  <div><a href="#" class="link-dark">Terms of Service</a></div>-->
        <!--  <div><a href="#" class="link-dark">Privacy Policy</a></div>-->
        <!--  <div><a href="#" class="link-dark">Content Policy</a></div>-->
        <!--</div>-->
      </div>
    </div>

   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.link-dark').click(function (e) {
            e.preventDefault();
            var selectedLanguage = $(this).data('language');

            $.ajax({
                type: 'POST',
                url: 'set_language.php',
                data: { language: selectedLanguage },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {

                        location.reload(); // Reload the page for changes to take effect
                    } else {

                        console.error('Error setting language: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle AJAX error if necessary
                    console.error('AJAX Error: ' + error);
                }
            });
        });
    });
</script>
    

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
    document.getElementById('register-form').addEventListener('submit', function (e) {
      // Prevent the form from submitting
      e.preventDefault();

      // Display the "Registering..." message
      document.getElementById('register-btn').textContent = '<?=getLanguageString($con,$lang,'please_wait');?>...';

      // Submit the form after a short delay (simulating registration process)
      setTimeout(function () {
        document.getElementById('register-form').submit();
      }, 2000);
    });
  </script>
  </body>

  
</html>
<?php } ?>