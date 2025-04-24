<?php. require('private/header.php');
if(isset($_SESSION['login'])){

$states = getStates($con);

$isPosted = checkFreeListing($con,$userData->userId);
$checkPlan = checkPlans($con,$userData->userId);

$isSubscribed = $checkPlan[0]['is_subscribed'];
$plan = $checkPlan[0]['plan'];

if($isSubscribed==0){
    if($isPosted=='no'){
        $allowPosting = true;
    }else{
        $allowPosting = false;
    }
    
}else{
    $allowPosting = true;
}
?>

<!-- Submit Property start -->
<div class="submit-property content-area mt-4">
    <div class="container">
        <div class="my-address">
            <div class="row">
                <?php if(!$allowPosting){ ?>
                <div class="col-md-12">
                    
                    <div class="notification-box">
                        <h3>You have already submitted a property ad. To post additional properties, please subscribe to our premium plan. </h3>
                        
                      
  <p>As per our policy, each user is allowed to post only one property. If you wish to post additional properties, we offer a subscription plan that provides unlimited properties listings.</p><br>
  <p>With our premium plan, you can showcase multiple properties, increase your reach, and attract more potential buyers or tenants. To subscribe, simply visit our subscription page and choose the plan that suits your needs.</p><br>
  <p>Thank you for using our service. We value your business and look forward to assisting you in your property listings.</p>

    <a href="plans" class='btn btn-danger mt-4 btn-round'>Check out our yearly subscription plans</a>

                    </div>
                </div>
                
                <?php }else{ ?>
                
                <div class="col-md-12">
                    <div class="notification-box">
                        <h3>Post your property for FREE with India's leading local search engine </h3>
                    </div>
                </div>
                
                         
               
                <div class="col-md-12">
                    <div class="submit-address">

                
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']) {

                    if(isset($_POST['adSubmit'])){
                        
                        if($isSubscribed==1){
                            if($plan=='Silver'){
                                $is_plus=1;
                                $is_verified=0;
                                $is_trusted=0;
                            }elseif($plan=='Gold'){
                                $is_plus=1;
                                $is_verified=1;
                                $is_trusted=0;
                            }else{
                                $is_plus=1;
                                $is_verified=1;
                                $is_trusted=1;
                            }
                        }else{
                           $is_plus=0;
                                $is_verified=0;
                                $is_trusted=0;
                        }

                        $created_at=date('d-m-Y H:i:s');
                        $date = date('d M, Y'); 
                        
                        
                        if(isset($_POST['amenities'])){
                            $amenities=implode(',',$_POST['amenities']);    
                        }else{
                            $amenities='';
                        }
                        
                    
                        $targetDir = "media/";
                        $pictures = array();
    
                        $imageFiles = $_FILES['pictures'];
        
                            // Loop through each uploaded file
                            for ($i = 0; $i < count($imageFiles['name']); $i++) {
                                $imageFileName = $imageFiles['name'][$i];
                                $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
                                $imageTmpName = $imageFiles['tmp_name'][$i];
                        
                                // Generate a unique name for the uploaded file
                                $uniqueName = uniqid() . '.' . $imageFileType;
                        
                                // Move the uploaded file to the target directory
                                $targetPath = $targetDir . $uniqueName;
                                if (move_uploaded_file($imageTmpName, $targetPath)) {
                                    $pictures[]=$targetPath;
                                } else {
                                    $_SESSION['errorMsg'] = 'Something went wrong';
                                    echo "<script>window.location='add-property';</script>";
                                    exit;
                                }
                            }
                            
                            $pictures = implode(',',$pictures);
                         
                            $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($_POST['title'])));
                            $insArr['slug']=$slug;
                            
                            $insArr['name']=$_POST['name'];
                            $insArr['email']=$_POST['email'];
                            $insArr['phone']=$_POST['phone'];
                            $insArr['city']=$_POST['city'];
                            $insArr['state']=$_POST['state'];
                            $insArr['address']=$_POST['address'];
                            $insArr['postalcode']=$_POST['postalcode'];
                            $insArr['amenities']=$amenities;
                            $insArr['title']=$_POST['title'];
                            $insArr['information']=$_POST['information'];
                            $insArr['rooms']=$_POST['rooms'];
                            $insArr['area']=$_POST['area'];
                            $insArr['bathrooms']=$_POST['bathrooms'];
                            $insArr['pictures']=$pictures;
                            $insArr['status_type']=$_POST['status_type'];
                            $insArr['property_type']=$_POST['property_type'];
                            $insArr['ad_type']="Property";
                            $insArr['posted_by']=$_POST['posted_by'];
                            $insArr['date']=$date;
                            $insArr['price']=$_POST['price'];
                            $insArr['created_at']=$created_at;
                            
                            $insArr['is_trusted']=$is_trusted;
                            $insArr['is_verified']=$is_verified;
                            $insArr['is_plus']=$is_plus;
                           
                            
                            $addListing = "INSERT INTO `listings`(`date`,`name`, `email`, `phone`, `posted_by`, `state`, `city`, `address`, `postalcode`, `amenities`, `information`, `title`, `rooms`, `bathrooms`, `area`, `pictures`, `status_type`, `property_type`, `ad_type`,`created_at`,`price`,`slug`,`is_plus`,`is_verified`,`is_trusted`) VALUES (:date,:name,:email,:phone,:posted_by,:state,:city,:address,:postalcode,:amenities,:information,:title,:rooms,:bathrooms,:area,:pictures ,:status_type,:property_type,:ad_type,:created_at,:price,:slug,:is_plus,:is_verified,:is_trusted)";
                            
                            $stm = $con->prepare($addListing);
                            $stm->execute($insArr);
                            
                             $_SESSION['successMsg'] = 'Your property submitted successfully. We will verify it before publishing.';
                             echo "<script>window.location='my-ads';</script>";

                            
                            
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
                                            <label>Upload Pictures</label>
                                            <input type='file' class="form-control" id="pictures" accept='image/*' name="pictures[]" multiple required >

                                        </div>
                                    </div>
                                    
                                 
                                    
                                   
                                   </div>
                                    <div id="propertyDetails" class="row ">
                                    
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group propertytitle">
                                            <label for="title" class="form-label">Property Title</label>
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Property Title" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="selectpicker search-fields" name="status_type" required>
                                                <option>For Sale</option>
                                                <option>For Rent</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="selectpicker search-fields" name="property_type" required>
                                                <option>Apartment</option>
                                                <option>House</option>
                                                <option>Commercial</option>
                                                <option>Plots</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group area">
                                            <label for="area" class="form-label">Area/Location</label>
                                            <input type="text" name="area" class="form-control" id="area" placeholder="SqFt">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Rooms</label>
                                            <select class="selectpicker search-fields" name="rooms" required>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Bathrooms</label>
                                            <select class="selectpicker search-fields" name="bathrooms" required>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                    
                                     <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group propertytitle">
                                            <label for="price" class="form-label">Property price</label>
                                            <input type="number" name="price" class="form-control" id="price" placeholder="eg. 100000" required>
                                        </div>
                                    </div>
                                    
                              
                           
                            <h3 class="heading-2">Location</h3>
                            <div class="row mb-30">
                                
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control search-fields" id="state"  name="state" required>
                                            <option value=''>Choose State</option>
                                            <?php foreach($states as $state) { ?>
                                            <option value='<?=$state->id;?>'><?=$state->state_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select class="form-control search-fields" id="cities" name="city" required>
                                            <option value=''>Choose City</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <div class="form-group address">
                                        <label for="address" class="form-label">Full Address</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                    <div class="form-group address">
                                        <label for="postalcode" class="form-label">Postal Code</label>
                                        <input type="text" name="postalcode" class="form-control" id="postalcode" placeholder="Postal Code" required>
                                    </div>
                                </div>
                            </div>
                            <h3 class="heading-2">Detailed Information</h3>
                            <div class="row mb-50">
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        
                                        <textarea name="information" class="form-control" rows="3" placeholder="Detailed Information" required></textarea>
                                    </div>
                                </div>
                            </div>
                           <div id="features">
                            <h3 class="heading-2">Features </h3>
                            <div class="row mb-40">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="checkbox checkbox-theme checkbox-circle">
                                                <input id="checkbox1" type="checkbox" name="amenities[]" value="Free Parking">
                                                <label for="checkbox1">
                                                    Free Parking
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-theme checkbox-circle">
                                                <input id="checkbox2" type="checkbox" name="amenities[]" value="Air Condition">
                                                <label for="checkbox2">
                                                    Air Condition
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-theme checkbox-circle">
                                                <input id="checkbox4" type="checkbox" name="amenities[]" value="Swimming Pool">
                                                <label for="checkbox4">
                                                    Swimming Pool
                                                </label>
                                            </div>
                                           
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            
                                            <div class="checkbox checkbox-theme checkbox-circle">
                                                <input id="checkbox5" type="checkbox" name="amenities[]" value="Laundry Room">
                                                <label for="checkbox5">
                                                    Laundry Room
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-theme checkbox-circle">
                                                <input id="checkbox6" type="checkbox" name="amenities[]" value="Window Covering">
                                                <label for="checkbox6">
                                                    Window Covering
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="checkbox checkbox-theme checkbox-circle">
                                                <input id="checkbox7" type="checkbox" name="amenities[]" value="Central Heating">
                                                <label for="checkbox7">
                                                    Central Heating
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-theme checkbox-circle">
                                                <input id="checkbox8" type="checkbox" name="amenities[]" value="Alarm">
                                                <label for="checkbox8">
                                                    Alarm
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            </div>
                            <h3 class="heading-2">Contact Details</h3>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group title">
                                        <label for="inputname1" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="inputname1" placeholder="Name" value="<?=$userData->name;?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group email">
                                        <label for="inputEmail1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email"  value="<?=$userData->email;?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group phone">
                                        <label for="inputphone1" class="form-label">Phone (optional)</label>
                                        <input type="text" name="phone" class="form-control" id="inputphone1" placeholder="Phone"  value="<?=$userData->phone;?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <button id="submitBtn" name="adSubmit" type='submit' class="btn-4 btn-round-3">Submit Property</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php } ?>
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

// Get the select box and div elements
    var ad_type = document.getElementById('ad_type');
    var features = document.getElementById('features');
    var propertyDetails = document.getElementById('propertyDetails');
    var service = document.getElementById('service');
    var serviceType = document.getElementById('serviceType');

    ad_type.addEventListener('change', function() {
      // Get the selected option value
      var selectedValue = ad_type.value;
      console.log(selectedValue);
      if (selectedValue === 'Service') {
          
        propertyDetails.style.display='none'; 
        features.style.display='none'; 
        service.style.display=''; 
        serviceType.style.display='';
        
      } else if (selectedValue === 'Real Estate') {
        propertyDetails.style.display=''; 
        features.style.display=''; 
        service.style.display='none'; 
        serviceType.style.display='none';
      }
    });
</script>

<?php require('private/footer.php'); }else{
    $_SESSION['errorMsg']='Please first login to post an ad';
echo "<script>window.location='login';</script>";

}?>