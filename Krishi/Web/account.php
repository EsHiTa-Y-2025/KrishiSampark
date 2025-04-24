<?php require('private/header.php');

$checkLogin = check_user_login($con);
?>

<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1>My Account</h1>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="breadcrumb-area">
                    <ul>
                        <li><a href="<?=$baseurl;?>">Home</a></li>
                        <li><span>/</span>My Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- My profile start -->
<div class="my-profile content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
               
               
               <?php $account='active'; require('private/accountSidebar.php');?>
               
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
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


                <!-- My address start-->
                <div class="my-address">
                     <?php 
                        $error='';
                        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']){
                          extract($_POST);
                           
                                if($error == ''){
                        
                                    
                                    $arr['name']=esc($name);
                                    
                                    $arr['userId']=$userData->userId;
                                    
                                    $addpackages = "update users set name=:name where userId=:userId";
                                    $stm = $con->prepare($addpackages);
                                    if($stm->execute($arr)){
                                          $_SESSION['successMsg']  = 'Account updated successfully.';
                                          echo "<script>window.location='account';</script>";
                                    }
                                }else{
                                         $_SESSION['errorMsg']  = 'Something went wrong.';
                                          echo "<script>window.location='account';</script>";
                                }
                        }
                        $_SESSION['token'] = get_random_string(60);
                        ?>
                    <h3 class="heading-2">My Account</h3>
                    <form action="" method="POST">
                         <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                        <div class="form-group">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" name="name" id="name" class="form-control"  value="<?=$userData->name;?>">
                        </div>
                       
                        <div class="form-group">
                            <label for="inputphone1" class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" id="inputphone1" value="<?=$userData->phone;?>" readonly>
                        </div>
                        <!--<div class="form-group">-->
                        <!--    <label for="inputEmail1" class="form-label">Email</label>-->
                        <!--    <input type="email" name="email" class="form-control" id="inputEmail1" value="<?=$userData->email;?>" readonly>-->
                        <!--</div>-->
                        
                        <button type='submit' class="btn-4 btn-round-3">Save Changes</button>
                    </form>
                </div>
                <!-- My address end -->
            </div>
        </div>
    </div>
</div>
<!-- My profile end -->
<?php require('private/footer.php');?>