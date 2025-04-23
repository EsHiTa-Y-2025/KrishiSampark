<?php include 'private/autoload.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

 
    <!-- Title -->
    <title>Krishisampark</title>

    <!-- Favicon -->
    <!-- <link rel="icon" href="img/core-img/favicon.ico"> -->
   
    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Web App Manifest -->
    <link rel="manifest" href="manifest.json">
</head>

<body>
   


    <div style="text-align:center;margin-top:180px;">
        <img src="<?=$baseurl;?>app/img/krishi.png" style="width:80%" alt="logo">
    </div>   
    
    <?php 
    if (isset($_COOKIE['userLoggedIn']) && isset($_COOKIE['krishiUserId']) && $_COOKIE['userLoggedIn'] == true) {
        $_SESSION['userId'] = $_COOKIE['krishiUserId'];
        $_SESSION['login']=true;
        
    }
    ?>
    
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        
        setTimeout("preventBack()", 0);
        
        window.onunload = function () { null };
       
         setTimeout(function(){
            window.location='main';
         }, 2000);
      
    </script>

    <!-- All JavaScript Files -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/slideToggle.min.js"></script>
    <script src="js/internet-status.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/rangeslider.min.js"></script>
    <script src="js/vanilla-dataTables.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/dark-rtl.js"></script>
    <script src="js/active.js"></script>
    <script src="js/pwa.js"></script>
</body>



</html>