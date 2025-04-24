<?php include 'private/header.php'; ?>

<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1>Contact Us</h1>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="breadcrumb-area">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><span>/</span>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- Contact 2 start -->
<div class="contact-2 content-area-5">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <p>Get in touch.</p>
            <h1>Contact us</h1>
        </div>
        <div class="contact-info">
            <div class="row">
                <!--<div class="col-md-3 col-sm-6 mrg-btn-50">-->
                <!--    <i class="flaticon-location"></i>-->
                <!--    <p class="strong">Office Address</p>-->
                <!--    <p>20/F Green Road, Dhaka</p>-->
                <!--</div>-->
                <div class="col-md-4 col-sm-6 mrg-btn-50">
                    <i class="flaticon-technology-1"></i>
                    <p class="strong">Phone Number</p>
                    <p>+91 7483801233</p>
                </div>
                <div class="col-md-4 col-sm-6 mrg-btn-50">
                    <i class="flaticon-envelope"></i>
                    <p class="strong">Email Address</p>
                    <p>info@krishisampark.in</p>
                </div>
                <div class="col-md-4 col-sm-6 mrg-btn-50">
                    <i class="flaticon-globe"></i>
                    <p class="strong">Web</p>
                    <p>www.krishisampark.in</p>
                </div>
            </div>
        </div>
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

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
            	
            	extract($_POST);
            	$created_at=date('d-m-Y H:i:s');
            	
                $arr['name']=$name;
                $arr['phone']=$phone;
                $arr['email']=$email;
                $arr['message']=$message;
                $arr['date']=$created_at;
                        
                        $add = "INSERT INTO `contact_leads` (`name`, `email`, `phone`,`message`, `date`) VALUES (:name,:email,:phone,:message,:date)";
                        $stm = $con->prepare($add);
                        if($stm->execute($arr)){
                            $_SESSION['successMsg'] = 'Your enquiry has been submitted successfully.';
                            echo "<script>window.location='contact';</script>";
                        }else{
                            $_SESSION['successMsg'] = 'Something went wrong.Try Again';
                            echo "<script>window.location='contact';</script>";
                        }
                            }
	    
	}
?>

        <form action="" method="POST" >
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group name">
                                <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Full Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group email">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group number">
                                <input type="text" name="phone" class="form-control" placeholder="Phone" aria-label="Phone Number">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group message">
                                <textarea  class="form-control" name="message" placeholder="Write message" aria-label="Write message"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="send-btn text-center">
                                <button type="submit" class="btn-4 btn-round-3">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </form>
    </div>
</div>
<!-- Contact end -->
<?php include 'private/footer.php'; ?>