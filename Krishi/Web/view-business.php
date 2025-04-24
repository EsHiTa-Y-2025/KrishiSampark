<?php. require('private/header.php');
if(isset($_SESSION['login'])){
$categories = get_category($con);

$states = getStates($con);
$business = getBusinessById($con,$userData->userId);
$pictures = explode(',',$business->pictures);
?>

<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1>Edit Business</h1>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="breadcrumb-area">
                    <ul>
                        <li><a href="<?=$baseurl;?>">Home</a></li>
                        <li><span>/</span>Edit Business</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- Submit Property start -->
<div class="my-profile content-area">
    <div class="container">
        <div class="row">
                 <div class="col-lg-4 col-md-12 col-sm-12">
               
               
               <?php $viewBusiness='active'; require('private/accountSidebar.php');?>
               
            </div>
            
              
                         
               
                 <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="submit-address">
                        
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
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']) {

                    if(isset($_POST['adSubmit'])){
                        
                        
                        
                    
                        // $targetDir = "media/";
                        // $pictures = array();
    
                        // $imageFiles = $_FILES['pictures'];
        

                        //     for ($i = 0; $i < count($imageFiles['name']); $i++) {
                        //         $imageFileName = $imageFiles['name'][$i];
                        //         $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
                        //         $imageTmpName = $imageFiles['tmp_name'][$i];
                        
                               
                        //         $uniqueName = uniqid() . '.' . $imageFileType;
                        
                               
                        //         $targetPath = $targetDir . $uniqueName;
                        //         if (move_uploaded_file($imageTmpName, $targetPath)) {
                        //             $pictures[]=$targetPath;
                        //         } else {
                        //             $_SESSION['errorMsg'] = 'Something went wrong';
                        //      echo "<script>window.location='add-business';</script>";
                        //         }
                        //     }
                            
                            // $pictures = implode(',',$pictures);
                         
                            $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($_POST['title'])));
                            
                            $insArr['name']=$_POST['name'];
                            $insArr['email']=$_POST['email'];
                            $insArr['phone']=$_POST['phone'];
                            $insArr['city']=$_POST['city'];
                            $insArr['state']=$_POST['state'];
                            $insArr['address']=$_POST['address'];
                            $insArr['postalcode']=$_POST['postalcode'];
                            $insArr['title']=$_POST['title'];
                            $insArr['information']=$_POST['information'];
                            // $insArr['pictures']=$pictures;
                            // $insArr['ad_type']="Business";
                            $insArr['id']=$business->id;
                            $insArr['service_type']=$_POST['service_type'];
                            $insArr['price']=$_POST['price'];
                            $insArr['mode_of_payment']=$_POST['mode_of_payment'];
                            $insArr['est_year']=$_POST['est_year'];
                            $insArr['open_time']=$_POST['open_time'];
                            $insArr['slug']=$slug;
                           
                            
                            $addListing = "UPDATE listings set `name`=:name, `email`=:email, `phone`=:phone, `state`=:state, `city`=:city, `address`=:address, `postalcode`=:postalcode, `information`=:information,`title`=:title,`service_type`=:service_type,`price`=:price,`mode_of_payment`=:mode_of_payment,`est_year`=:est_year,`open_time`=:open_time,`slug`=:slug where id=:id";
                            
                            $stm = $con->prepare($addListing);
                            $stm->execute($insArr);
                            
                             $_SESSION['successMsg'] = 'Your business updated successfully.';
                             echo "<script>window.location='view-business';</script>";

                            
                            
                    }
                }
    
        $_SESSION['token'] = get_random_string(60);

                
                ?>
                        
                        
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                            <h3 class="heading-2">Basic Information</h3>
                            <div class="search-contents-sidebar mb-30">
                                <div class="row">
                                    <input type="hidden" name="posted_by" value="<?=$userData->userId;?>">
                                    
                                    
                                     <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Uploaded Pictures</label><br>
                                            <?php foreach($pictures as $picture){ ?>
                                            <img src="<?=$baseurl.$picture;?>" style='width:200px;height:160px'>
                                            <?php } ?>
                                            <!--<input type='file' class="form-control" id="pictures" accept='image/*' name="pictures[]" multiple  >-->

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 col-sm-12" id="service">
                                        <div class="form-group propertytitle">
                                            <label for="title" class="form-label">Business Title</label>
                                            <input type="text" value="<?=$business->title;?>" name="title" class="form-control" id="title" placeholder="Business Title">
                                        </div>
                                    </div>
                                    
                                     <div class="col-lg-4 col-md-6 col-sm-12" id="serviceType">
                                        <div class="form-group">
                                            <label>Business Type</label>
                                            <select class="form-control" name="service_type" required>
                                                <option value="">Choose</option>
                                                <?php foreach($categories as $cat){ ?>
                                                <option <?php if($business->service_type==$cat->id) echo 'selected'; ?> value="<?=$cat->id;?>"><?=$cat->cat_name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                     
                                     <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group propertytitle">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" value="<?=$business->price;?>" name="price" class="form-control" id="price" placeholder="eg. 1,20,000">
                                        </div>
                                    </div>
                                    
                                     <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group propertytitle">
                                            <label for="est_year" class="form-label">Establishment Year</label>
                                            <input type="number" value="<?=$business->est_year;?>" name="est_year" class="form-control" id="est_year" placeholder="eg. 2017">
                                        </div>
                                    </div>
                                    
                                    
                                     <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group propertytitle">
                                            <label for="mode_of_payment" class="form-label">Mode Of Payment</label>
                                            <input type="text" value="<?=$business->mode_of_payment;?>" name="mode_of_payment" class="form-control" id="mode_of_payment" placeholder="eg. Credit Cards,Debit Cards,UPI ">
                                        </div>
                                    </div>
                                    
                                     <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group propertytitle">
                                            <label for="open_time" class="form-label">Timings</label>
                                            <input type="text" value="<?=$business->open_time;?>" name="open_time" class="form-control" id="open_time" placeholder="eg. 10:00am-5:00pm">
                                        </div>
                                    </div>
                                    
                                   
                                   </div>
                                    

                              
                           
                            <h3 class="heading-2">Location</h3>
                            <div class="row mb-30">
                                
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control" id="state"  name="state" required>
                                            <option value=''>Choose State</option>
                                            <?php foreach($states as $state) { ?>
                                            <option <?php if($state->id==$business->state) echo 'selected'; ?> value='<?=$state->id;?>'><?=$state->state_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select class="form-control " id="cities" name="city" required>
                                            <option value='<?=$business->city;?>'><?=$business->city_name;?></option>
                                            
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <div class="form-group address">
                                        <label for="address" class="form-label">Full Address</label>
                                        <input type="text" value="<?=$business->address;?>" name="address" class="form-control" id="address" placeholder="Address" required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <div class="form-group address">
                                        <label for="postalcode" class="form-label">Postal Code</label>
                                        <input type="text" value="<?=$business->postalcode;?>" name="postalcode" class="form-control" id="postalcode" placeholder="Postal Code" required>
                                    </div>
                                </div>
                            </div>
                            <h3 class="heading-2">Detailed Information</h3>
                            <div class="row mb-50">
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        
                                        <textarea name="information" class="form-control" rows="3" placeholder="Detailed Information" required><?=$business->information;?></textarea>
                                    </div>
                                </div>
                            </div>
                         
                            <h3 class="heading-2">Contact Details</h3>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group title">
                                        <label for="inputname1" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="inputname1" placeholder="Name" value="<?=$business->name;?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group email">
                                        <label for="inputEmail1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email"  value="<?=$business->email;?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group phone">
                                        <label for="inputphone1" class="form-label">Phone (optional)</label>
                                        <input type="text" name="phone" class="form-control" id="inputphone1" placeholder="Phone"  value="<?=$business->phone;?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <button id="submitBtn" name="adSubmit" type='submit' class="btn-4 btn-round-3">Update </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


 <script>
$(document).ready(function() {
  $('#state').on('change', function() {
      var state_id = this.value;
      $.ajax({
        url: "<?=$baseurl;?>ajax/getCities.php",
        type: "POST",
        data: {
          state_id: state_id
        },
        cache: false,
        success: function(dataResult){
          $("#cities").html(dataResult);
        }
      });
    
    
  });
});


</script>

<?php require('private/footer.php'); }else{
    $_SESSION['errorMsg']='Please first login to post an ad';
echo "<script>window.location='login';</script>";

}?>