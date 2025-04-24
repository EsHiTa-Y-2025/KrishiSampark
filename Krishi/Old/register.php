<?php require_once('private/autoload.php');
if(!isset($_SESSION['login'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Krishisampark">
    <meta name="keywords" content="Krishisampark">
    <meta name="author" content="Krishisampark">
    <!--<link rel="icon" href="assets/images/favicon/1.png" type="image/x-icon">-->
    <title>Register | Krishisampark</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick/slick-theme.css">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bulk-style.css">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>

    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

   

   

    <!-- log in section start -->
    <section class="log-in-section background-image-2 section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
               
  
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
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
                            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

                                extract($_POST);
                                if($password==$confirm_password){
                                    
                                $data = array(
                                    'name' => $name,
                                    'email' => $email,
                                    'password' => $password,
                                    'phone'=>$phone
                                );

                               

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
                                        $_SESSION['successMsg'] = 'You are registered successfully with us..';
                                    } elseif ($result['message'] === 0) {
                                         $_SESSION['errorMsg']  = 'Provided email or mobile number already exists.';
                                    }
                                } else {
                                    $_SESSION['errorMsg'] = 'Error: ' . $result['message'];
                                }
                            }else{
                                $_SESSION['errorMsg']='Password does not match.';
                            }
                            
                                    echo "<script>window.location='register'</script>";

                            }
                        }
                        ?>
                        
                    <div class="log-in-box">
                        <div class="log-in-title text-center">
                            <h3>Welcome To Krishisampark</h3>
                            <h4>Log In Your Account</h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" id="register-form" method="POST" action"">
                                
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                                        <label for="name">Full Name</label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" class="form-control" name="phone" placeholder="Mobile Number" required>
                                        <label for="phone">Mobile Number</label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password" required>
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" class="form-control" name="confirm_password"
                                            placeholder="Confirm Password" required>
                                        <label for="password">Confirm Password</label>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <button id="register-btn" class="btn btn-animation w-100 justify-content-center" type="submit">Register</button>
                                </div>
                            </form>
                        </div>

                        <div class="other-log-in">
                            <h6>or</h6>
                        </div>

                       
                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="login">Sign in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- log in section end -->

   

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->
    
     <script>
    // Add an event listener to the form submission
    document.getElementById('register-form').addEventListener('submit', function (e) {
      // Prevent the form from submitting
      e.preventDefault();

      // Display the "Registering..." message
      document.getElementById('register-btn').textContent = 'Please wait...';

      // Submit the form after a short delay (simulating registration process)
      setTimeout(function () {
        document.getElementById('register-form').submit();
      }, 2000);
    });
  </script>

    <!-- latest jquery-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bootstrap/popper.min.js"></script>

    <!-- feather icon js-->
    <script src="assets/js/feather/feather.min.js"></script>
    <script src="assets/js/feather/feather-icon.js"></script>

    <!-- Slick js-->
    <script src="assets/js/slick/slick.js"></script>
    <script src="assets/js/slick/slick-animation.min.js"></script>
    <script src="assets/js/slick/custom_slick.js"></script>

    <!-- Lazyload Js -->
    <script src="assets/js/lazysizes.min.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
</body>

</html>
<?php }else{
header('Location: home');
}?>