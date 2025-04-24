<?php require('private/header.php');?>

<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1>Change Password</h1>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="breadcrumb-area">
                    <ul>
                        <li><a href="<?=$baseurl;?>">Home</a></li>
                        <li><span>/</span>Change Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- Change password start -->
<div class="change-password content-area-14">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
               
                <?php $changePassword='active'; require('private/accountSidebar.php');?>
            </div>
            <div class="col-lg-8 col-md-12">
                <!-- My address start -->
                <div class="my-address">
                    <h3 class="heading-2">Change Password</h3>
                    <form action="index.html" method="GET">
                        
                        <div class="form-group">
                            <label for="inputpassword2" class="form-label">New Password</label>
                            <input type="password" name="new-password" class="form-control" id="inputpassword2" placeholder="Confirm New Password">
                        </div>
                        <div class="form-group">
                            <label for="inputpassword3" class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm-new-password" class="form-control" id="inputpassword3" placeholder="New Password">
                        </div>
                        <a href="" class="btn-4 btn-round-3">Save Changes</a>
                    </form>
                </div>
                <!-- My address end -->
            </div>
        </div>
    </div>
</div>
<!-- Change password end -->
<?php require('private/footer.php');?>
