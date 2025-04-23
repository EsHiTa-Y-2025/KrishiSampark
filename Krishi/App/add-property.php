<?php require('private/header.php');
$cities = getCitiesByState($con,2);

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
  <body>
    <div class="bg-white shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="gap-3 d-flex align-items-center">
          <a href="select-posting"
            ><i class="bi bi-arrow-left d-flex text-danger h2 m-0 back-page"></i
          ></a>
          <h3 class="fw-bold m-0">Add Property</h3>
        </div>
      </div>
    </div>
                  <?php
// Display success message
if (isset($_SESSION['successMsg'])) {
    echo '<div class="m-2"><div class="alert alert-success" role="alert">' . $_SESSION['successMsg'] . '</div></div>';
    unset($_SESSION['successMsg']);
}

// Display error message
if (isset($_SESSION['errorMsg'])) {
    echo '<div class="m-2"><div class="alert alert-danger" role="alert">' . $_SESSION['errorMsg'] . '</div></div>';
    unset($_SESSION['errorMsg']);
}
?>
                
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']) {

                    if(isset($_POST['title'])){
                        
                        

                        $created_at=date('d-m-Y H:i:s');
                        $date = date('d M, Y'); 
                        
                        
                        if(isset($_POST['amenities'])){
                            $amenities=implode(',',$_POST['amenities']);    
                        }else{
                            $amenities='';
                        }
                        
                    
                        $targetDir = "../media/";
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
                           
                            
                            $addListing = "INSERT INTO `listings`(`date`,`name`, `email`, `phone`, `posted_by`, `state`, `city`, `address`, `postalcode`, `amenities`, `information`, `title`, `rooms`, `bathrooms`, `area`, `pictures`, `status_type`, `property_type`, `ad_type`,`created_at`,`price`,`slug`) VALUES (:date,:name,:email,:phone,:posted_by,:state,:city,:address,:postalcode,:amenities,:information,:title,:rooms,:bathrooms,:area,:pictures ,:status_type,:property_type,:ad_type,:created_at,:price,:slug)";
                            
                            $stm = $con->prepare($addListing);
                            $stm->execute($insArr);
                            
                             $_SESSION['successMsg'] = 'Your ad submitted successfully. We will verify it before publishing.';
                             echo "<script>window.location='add-property';</script>";

                            
                            
                    }
                }
    
        $_SESSION['token'] = get_random_string(60);

                
                ?>
                
   <form method="POST" enctype="multipart/form-data" id="submit-form">
        <?php if(!$allowPosting){ ?>
     <div class="p-3">
        
        <div class="mb-4 bg-primary p-3 text-white rounded">
         <h3>You have already submitted a property ad. To post additional properties, please subscribe to our premium plan. </h3>
                        
                      
  <p>As per our policy, each user is allowed to post only one property. If you wish to post additional properties, we offer a subscription plan that provides unlimited properties listings.</p><br>
  <p>With our premium plan, you can showcase multiple properties, increase your reach, and attract more potential buyers or tenants. To subscribe, simply visit our subscription page and choose the plan that suits your needs.</p><br>
  <p>Thank you for using our service. We value your business and look forward to assisting you in your property listings.</p>

    <a href="plans" class='btn btn-danger mt-4 btn-round'>Check out our yearly subscription plans</a>
      </div> 
      </div> 
      
       <?php }else{ ?>
       <div class="p-3">
      <div class="mb-4 bg-primary p-3 text-white rounded">
        <h3>
          Post your property for FREE with India's leading local search engine
        </h3>
      </div>
     
          
         
                     
                            <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                                    <input type="hidden" name="posted_by" value="<?=$userData->userId;?>">

             <div class="mb-3">
            <label class="form-label text-dark">Upload Pictures (More than one)*</label>
                                            <input type='file' class="shadow-none form-control" id="pictures" accept='image/*' name="pictures[]" multiple required >
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Property Title*</label>
            <input type="text" class="shadow-none form-control" name="title" value="" required>
          </div>

          <div class="mb-3">
            <label class="form-label text-dark">Status*</label>
            <select
              type="text"
              class="shadow-none form-control"
              name="status_type"
              required
            >
              <option selected disabled>Choose</option>
              <option>For Sale</option>
              <option>For Rent</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label text-dark">Type*</label>
            <select class="shadow-none form-control" name="property_type" required>
              <option>Apartment</option>
              <option>House</option>
              <option>Commercial</option>
              <option>Plots</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label text-dark">Area/Location</label>
            <input type="text" name="area" class="shadow-none form-control"  required/>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Rooms*</label>
            <select class="shadow-none form-control" name="rooms" required>
               <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Bathrooms*</label>
            <select class="shadow-none form-control" name="bathrooms" required>
              <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Property Price</label>
            <input type="number" name="price" class="shadow-none form-control" required />
          </div>
          
           <div class="mb-3">
            <label class="form-label text-dark fw-bold">Detailed Information</label>
            <textarea
              name="information"
              class="shadow-none form-control text-muted"
              value=""
              rows="3"
              required
            ></textarea>
          </div>
          
            <h3 class="">Features </h3>
                            <div class="mb-3">
                                            <div class="">
                                                <input id="checkbox1" type="checkbox" name="amenities[]" value="Free Parking">
                                                <label for="checkbox1">
                                                    Free Parking
                                                </label>
                                            </div>
                                            <div class="">
                                                <input id="checkbox2" type="checkbox" name="amenities[]" value="Air Condition">
                                                <label for="checkbox2">
                                                    Air Condition
                                                </label>
                                            </div>
                                            <div class="">
                                                <input id="checkbox4" type="checkbox" name="amenities[]" value="Swimming Pool">
                                                <label for="checkbox4">
                                                    Swimming Pool
                                                </label>
                                          </div>
                                            <div class="">
                                                <input id="checkbox5" type="checkbox" name="amenities[]" value="Laundry Room">
                                                <label for="checkbox5">
                                                    Laundry Room
                                                </label>
                                            </div>
                                            <div class="">
                                                <input id="checkbox6" type="checkbox" name="amenities[]" value="Window Covering">
                                                <label for="checkbox6">
                                                    Window Covering
                                                </label>
                                           </div>
                                            <div class="">
                                                <input id="checkbox7" type="checkbox" name="amenities[]" value="Central Heating">
                                                <label for="checkbox7">
                                                    Central Heating
                                                </label>
                                            </div>
                                            <div class="">
                                                <input id="checkbox8" type="checkbox" name="amenities[]" value="Alarm">
                                                <label for="checkbox8">
                                                    Alarm
                                                </label>
                                            </div>
                                            
                            </div>
                            
                            
          
          <h3>Address Details</h3>
          
          <input type="hidden" name="state" value="2">
          <div class="mb-3">
            <label class="form-label text-dark">City*</label>
            <select class="shadow-none form-control" name="city" required>
                              <option selected disabled>Choose</option>
                <?php foreach($cities as $city){ ?>
                    <option value="<?=$city->id;?>"><?=$city->city_name;?></option>   
                <?php } ?>
            </select>
          </div>
          
           <div class="mb-3">
            <label class="form-label text-dark">Full Address</label>
            <input type="text" name="address" class="shadow-none form-control"  required/>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Postal Code</label>
            <input type="text" name="postalcode" class="shadow-none form-control"  required/>
          </div>
            
            
            <p>Contact Details</p>
          
            <div class="mb-3">
            <label class="form-label text-dark">Name</label>
            <input type="text" value="<?=$userData->name;?>" name="name" class="shadow-none form-control"  required/>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Email</label>
            <input type="email" value="<?=$userData->email;?>" name="email" class="shadow-none form-control"  readonly/>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Phone</label>
            <input type="number" value="<?=$userData->phone;?>" name="phone" class="shadow-none form-control"  required/>
          </div>
            
         
       
      </div>
    
   
    <div class="p-5"></div>

    <div class="fixed-bottom p-3">
      <div class="d-grid">
        <button type="submit" id="submit-btn"  class="btn landsbazzar-bg1 btn-lg">Submit</button>
      </div>
    </div>
     <?php } ?>
     </form>

    <script
      src="vender/jquery/jquery.min.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>
    <script
      src="vender/bootstrap/js/bootstrap.bundle.min.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>

    <script
      src="vender/slick/slick/slick.min.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>

    <script
      src="vender/sidebar/hc-offcanvas-nav.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>

    <script
      src="js/custom.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>
    <script
      src="https://askbootstrap.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
      data-cf-settings="12f990073857c990e213daed-|49"
      defer
    ></script>
    <script
      defer
      src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
      integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
      data-cf-beacon='{"rayId":"7dcef2b2ad770da6","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}'
      crossorigin="anonymous"
    ></script>
    
     <script>
    // Add an event listener to the form submission
    document.getElementById('submit-form').addEventListener('submit', function (e) {
      // Prevent the form from submitting
      e.preventDefault();

      // Display the "Registering..." message
      document.getElementById('submit-btn').textContent = 'Please wait...';

      // Submit the form after a short delay (simulating registration process)
      setTimeout(function () {
        document.getElementById('submit-form').submit();
      }, 2000);
    });
  </script>
  </body>
</html>
