<?php require('private/autoload.php');
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
    <title>Log In</title>

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
                            if (isset($_POST['email']) && isset($_POST['password'])) {

                                extract($_POST);
                               
                                $data = array(
                                    'email' => $email,
                                    'password' => $password,
                                );

                               

                                $apiUrl = $apiUrl . 'login.php';
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
                                        $_SESSION['userId'] = $result['userId'];
                                        $_SESSION['login']=true;
                                        echo "<script>window.location='home'</script>";

                                        
                                    } elseif ($result['message'] === 2) {
                                         $_SESSION['errorMsg']  = 'Your password is incorrect.';
                                         echo "<script>window.location='login'</script>";
                                    }elseif ($result['message'] === 3) {
                                         $_SESSION['errorMsg']  = 'You are blocked by Landsbazzar. Contact support team.';
                                         echo "<script>window.location='login'</script>";
                                    }else{
                                          $_SESSION['errorMsg']  = 'Provided email does not exists.';
                                          echo "<script>window.location='login'</script>";
                                    }
                                } else {
                                    $_SESSION['errorMsg'] = 'Error: ' . $result['message'];
                                    echo "<script>window.location='login'</script>";
                                }
                           

                            }
                        }
                        ?>
                        
                    <div class="log-in-box">
                        <div class="log-in-title text-center">
                            <h3>Welcome To Krishisampark</h3>
                            <h4>Log In Your Account</h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" id="login-form" method="POST" action="">
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
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox"
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                        </div>
                                        <!-- <a href="forgot.html" class="forgot-password">Forgot Password?</a> -->
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button id="login-btn" class="btn btn-animation w-100 justify-content-center" type="submit">Log
                                        In</button>
                                </div>
                            </form>
                        </div>

                        <div class="other-log-in">
                            <h6>or</h6>
                        </div>

                       
                        <div class="sign-up-box">
                            <h4>Don't have an account?</h4>
                            <a href="register">Sign Up</a>
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
<?php } ?>