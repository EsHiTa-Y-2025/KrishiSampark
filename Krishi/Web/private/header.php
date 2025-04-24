<?php require_once('private/autoload.php');

$lang = 'en';
if(isset($_SESSION['login'])){
    $userId = $_SESSION['userId'];
    $checkQuery = "SELECT * FROM users WHERE userId = :userId LIMIT 1";
    $checkStm = $con->prepare($checkQuery);
    $check = $checkStm->execute(['userId' => $userId]);
    if ($check) {
        $userData = $checkStm->fetchAll(PDO::FETCH_OBJ);
        
        if (is_array($userData) && count($userData) > 0) {
            $userData = $userData[0];
            $lang = $userData->language;

        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Krishisampark </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/bootstrap-submenu.css">
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?=$baseurl;?>css/leaflet.css" type="text/css">
    <link rel="stylesheet" href="<?=$baseurl;?>css/map.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?=$baseurl;?>fonts/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>fonts/linearicons/style.css">
    <link rel="stylesheet" type="text/css"  href="<?=$baseurl;?>css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css"  href="<?=$baseurl;?>css/dropzone.css">
    <link rel="stylesheet" type="text/css"  href="<?=$baseurl;?>css/slick.css">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/initial.css">
    <link rel="stylesheet" type="text/css"  href="<?=$baseurl;?>css/skins/default.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.min.js" integrity="sha512-JbRQ4jMeFl9Iem8w6WYJDcWQYNCEHP/LpOA11LaqnbJgDV6Y8oNB9Fx5Ekc5O37SwhgnNJdmnasdwiEdvMjW2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="https://krishisampark.in/app/img/krishi.png" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/ie10-viewport-bug-workaround.css">

  
    <script  src="<?=$baseurl;?>js/ie-emulation-modes-warning.js"></script>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     


</head>
<body>
<!--<div class="page_loader"></div>-->

<!-- Top header start -->
<header class="top-header th10 d-none d-lg-block d-md-block" id="top-header-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-7 col-7">
                <div class="list-inline">
                    <a href="tel:7483801233"><i class="fa fa-phone"></i>Need Support? +91 9481725226</a>
                    <a href="tel:info@landzbazaar.com"><i class="fa fa-envelope"></i>info@krishisampark.in</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-5">
                <ul class="top-social-media pull-right">
                    <?php if(!isset($_SESSION['login'])){ ?>
                    <li>
                        <a href="<?=$baseurl;?>login" class="sign-in"><i class="fa fa-sign-in"></i> Login</a>
                    </li>
                    <li>
                        <a href="<?=$baseurl;?>register" class="sign-in"><i class="fa fa-user"></i> Register</a>
                    </li>
                    <?php }else{ ?>
                     <li>
                        <a href="<?=$baseurl;?>account" class="sign-in"><?php if(empty($userData->name)) echo "Edit Profile"; else echo $userData->name; ?></a>
                    </li>
                    
                    <li>
                        <a href="<?=$baseurl;?>logout" class="sign-in"><i class="fa fa-sign-out"></i> Logout </a>
                    </li>
                    
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- Top header end -->

<!-- Main header start -->
<header class="main-header " id="main-header-1">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logos" href="<?=$baseurl;?>">
                 <img src="https://krishisampark.in/app/img/krishi.png" style='width:70px;height:70px' alt="logo" >  

            </a>
            <button class="navbar-toggler" id="drawer" type="button">
                <span class="fa fa-bars"></span>
            </button>
            <div class="navbar-collapse collapse w-100 justify-content-end" id="navbar">
                <ul class="navbar-nav ml-auto">
                   
                    <li class="nav-item ">
                        <a class="nav-link " href="<?=$baseurl;?>">
                            Home
                        </a>
                       
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="<?=$baseurl;?>about">
                            About
                        </a>
                       
                    </li>



                    <li class="nav-item ">
                        <a class="nav-link " href="<?=$baseurl;?>contact">
                            Contact 
                        </a>
                       
                    </li>
                    

                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- Main header end -->

<!-- Sidenav start -->
<nav id="sidebar" class="nav-sidebar">
    <!-- Close btn-->
    <div id="dismiss">
        <i class="fa fa-close"></i>
    </div>
    <div class="sidebar-inner">
        <div class="sidebar-logo">
                 <img src="<?=$baseurl;?>img/landsbazzar-logo.png" style='width:100%' alt="logo" >  
                            <!--<h3>LandsBazzar</h3>-->

        </div>
        <div class="sidebar-navigation">
            
            <ul class="menu-list">
                <li>
                    <a href="<?=$baseurl;?>">Home</a>
                </li>
                
                <li>
                    <a href="<?=$baseurl;?>about" >About</a>
                </li>
                <li>
                    <a href="<?=$baseurl;?>properties">Properties</a>
                </li>
                <li>
                    <a href="<?=$baseurl;?>businessess">Business</a>
                </li>
                
                <li>
                    <a href="<?=$baseurl;?>contact">Contact</a>
                </li>
                
                
                <!--<li>-->
                        
                <!--            <a class='btn btn-warning text-white mt-2' href="<?=$baseurl;?>add-property"> Add Property Free</a>-->
                     
                <!--    </li>-->
                    
                    <?php // if(isset($_SESSION['login'])){ $isSubmitted = checkIsFreeBusinessPosted($con,'Business',$userData->userId); }else{ $isSubmitted=false; } ?>
                    <!--<li class="nav-item">-->
                        <?php //  if($isSubmitted){
                            ?>
                                 <!--<a class='btn btn-dark text-white mt-2' href="<?=$baseurl;?>view-property"> View Business</a>-->
                            <?php
                      //  }else{ ?>
                             <!--<a class='btn btn-dark text-white mt-2' href="<?=$baseurl;?>add-property"> Add Business Free</a>-->
                        <?php // } ?>
                        

                    
                    <?php if(!isset($_SESSION['login'])){ ?>
                    <li>
                        <a class='btn btn-primary text-white mt-2' href="<?=$baseurl;?>login">Login</a>
                    </li>
                    <li>
                        <a class='btn btn-secondary text-white mt-2' href="<?=$baseurl;?>register">Register</a>
                    </li>
                    <?php }else{ ?>
                     <li>
                        <a class='btn btn-danger mt-2 text-white' href="<?=$baseurl;?>account" class="sign-in"><?php if(empty($userData->name)) echo "Edit Profile"; else echo $userData->name; ?></a>
                    </li>
                    
                    <li>
                        <a class='btn btn-secondary mt-2 text-white' href="<?=$baseurl;?>logout"> Logout </a>
                    </li>
                    
                    <?php } ?>
            </ul>
        </div>
        <div class="get-in-touch">
            <h3 class="heading">Get in Touch</h3>
            <div class="get-in-touch-box d-flex">
                <i class="flaticon-technology-1"></i>
                <div class="detail">
                    <a href="tel:+917483801233">+917483801233</a>
                </div>
            </div>
            <div class="get-in-touch-box d-flex">
                <i class="flaticon-envelope"></i>
                <div class="detail">
                    <a href="#">connnect@landsbazzar.com</a>
                </div>
            </div>
            <div class="get-in-touch-box d-flex mb-0">
                <i class="flaticon-globe"></i>
                <div class="detail">
                    <a href="#">info@landsbazzar.com</a>
                </div>
            </div>
        </div>
        <div class="get-social">
            <h3 class="heading">Get Social</h3>
            <a href="#" class="facebook-bg">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="#" class="twitter-bg">
                <i class="fa fa-twitter"></i>
            </a>
            <a href="#" class="google-bg">
                <i class="fa fa-google"></i>
            </a>
            <a href="#" class="linkedin-bg">
                <i class="fa fa-linkedin"></i>
            </a>
        </div>
    </div>
</nav>
<!-- Sidenav end -->