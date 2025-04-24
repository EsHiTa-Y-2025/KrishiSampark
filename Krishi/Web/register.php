<?php require_once('private/autoload.php');
if(!isset($_SESSION['login'])){
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Landsbazzar | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-submenu.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/leaflet.css" type="text/css">
    <link rel="stylesheet" href="css/map.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="fonts/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" type="text/css" href="fonts/linearicons/style.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="css/dropzone.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/initial.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="css/skins/default.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="img/landsbazzar.png" type="image/x-icon">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="css/ie10-viewport-bug-workaround.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script  src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script  src="js/html5shiv.min.js"></script>
    <script  src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!--<div class="page_loader"></div>-->

    <!-- Login section start -->
    <div class="login-section">
        <div class="container-fluid">
            <div class="row login-box">
                <div class="col-lg-6 align-self-center pad-0 form-section">
                    <div class="form-inner">
                        <a href="<?= $baseurl; ?>" class="">
                            <img src="img/landsbazzar-logo.png" width="100%" alt="logo">
                        </a>



                       
                        
                        <h3>Create an account</h3>
                        
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
                            
                                    header('Location: register');

                            }
                        }
                        ?>
                        
                        <form action="" method="POST">
                            <div class="form-group clearfix">
                                <input name="name" type="text" class="form-control" placeholder="Full Name" aria-label="Full Name" required>
                            </div>
                            <div class="form-group clearfix">
                                <input name="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                            </div>

                            <div class="form-group clearfix">
                                <input name="phone" type="number" class="form-control" placeholder="Mobile Number" required>
                            </div>
                            <div class="form-group clearfix">
                                <input name="password" type="password" class="form-control" placeholder="Password" aria-label="Password" required>
                            </div>

                            <div class="form-group clearfix">
                                <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" aria-label="Password" required>
                            </div>
                            <div class="form-group clearfix checkbox">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberme" required>
                                    <label class="form-check-label" for="rememberme">
                                        I agree to the terms of service
                                    </label>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <button type="submit" class="btn-md btn-theme w-100">Register</button>
                            </div>
                            <!--<div class="extra-login clearfix">-->
                            <!--    <span>Or Login With</span>-->
                            <!--</div>-->
                        </form>
                        <!--<div class="clearfix"></div>-->
                        <!--<div class="social-list">-->
                        <!--    <a href="#" class="facebook-bg">-->
                        <!--        <i class="fa fa-facebook"></i>-->
                        <!--    </a>-->
                        <!--    <a href="#" class="twitter-bg">-->
                        <!--        <i class="fa fa-twitter"></i>-->
                        <!--    </a>-->
                        <!--    <a href="#" class="google-bg">-->
                        <!--        <i class="fa fa-google"></i>-->
                        <!--    </a>-->
                        <!--    <a href="#" class="linkedin-bg">-->
                        <!--        <i class="fa fa-linkedin"></i>-->
                        <!--    </a>-->
                        <!--</div>-->
                        <p>Already a member? <a href="login">Login here</a></p>
                    </div>
                </div>
                <div class="col-lg-6 bg-color-15 pad-0 none-992 bg-img">
                    <div class="info clearfix">
                        <h1>Welcome to <span>Landsbazzar</span></h1>
                        <p>LANDS BAZZAR is a Dharwad- Karnataka based real estate company, dealing in various real estate segments. The company was established in 2022 and is owned and managed by Mr. Sameer Kazi & Mr. Eliyas Kazi. The company has made swift progress in the domain, under his expert tutelage and is name to reckon with. Our vast portfolio of real estate services includes Vastu Consultancy, Property Legal Advisory, Property Loan Consultancy, Property Buying Services, Property Selling Services, Property Rental Services, Paying Guest Services </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login section end -->

    <!-- Full Page Search -->
    <div id="full-page-search">
        <button type="button" class="close">×</button>
        <form action="index.html#">
            <input type="search" value="" placeholder="type keyword(s) here" />
            <button type="submit" class="btn btn-sm button-theme">Search</button>
        </form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap-submenu.js"></script>
    <script src="js/rangeslider.js"></script>
    <script src="js/jquery.mb.YTPlayer.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.scrollUp.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/leaflet.js"></script>
    <script src="js/leaflet-providers.js"></script>
    <script src="js/leaflet.markercluster.js"></script>
    <script src="js/dropzone.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.filterizr.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.js"></script>
    <script src="js/maps.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/app.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <!-- Custom javascript -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

</body>

</html>
<?php }else{
header('Location: home');
}?>
