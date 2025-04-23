<?php require('private/header.php');
$cities = getCitiesByState($con,2);
$property = getPropertyById($con,$_GET['id']);
$pictures = explode(',',$property->pictures);
$amenities = explode(',',$property->amenities);

if(!is_object($property) && $property==2){
    echo "<script>window.history.back();</script>";
    exit;
}

?>
  <body>
    <div class="bg-white shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="gap-3 d-flex align-items-center">
          <a href="listing-detail?id=<?=$_GET['id'];?>"
            ><i class="bi bi-arrow-left d-flex text-danger h2 m-0 back-page"></i
          ></a>
          <h3 class="fw-bold m-0">Edit Property</h3>
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
                        
                        
                        
                        if(isset($_POST['amenities'])){
                            $amenities=implode(',',$_POST['amenities']);    
                        }else{
                            $amenities='';
                        }
                        
                    
                        // $targetDir = "../media/";
                        // $pictures = array();
    
                        // $imageFiles = $_FILES['pictures'];
        
                        //     // Loop through each uploaded file
                        //     for ($i = 0; $i < count($imageFiles['name']); $i++) {
                        //         $imageFileName = $imageFiles['name'][$i];
                        //         $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
                        //         $imageTmpName = $imageFiles['tmp_name'][$i];
                        
                        //         // Generate a unique name for the uploaded file
                        //         $uniqueName = uniqid() . '.' . $imageFileType;
                        
                        //         // Move the uploaded file to the target directory
                        //         $targetPath = $targetDir . $uniqueName;
                        //         if (move_uploaded_file($imageTmpName, $targetPath)) {
                        //             $pictures[]=$targetPath;
                        //         } else {
                        //             $_SESSION['errorMsg'] = 'Something went wrong';
                        //             echo "<script>window.location='add-property';</script>";
                        //             exit;
                        //         }
                        //     }
                            
                        //     $pictures = implode(',',$pictures);
                         
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
                            // $insArr['pictures']=$pictures;
                            $insArr['status_type']=$_POST['status_type'];
                            $insArr['property_type']=$_POST['property_type'];
                            $insArr['price']=$_POST['price'];
                            $insArr['id']=$_GET['id'];

                            
                            $addListing = "UPDATE listings set `name`=:name,`email`=:email, `phone`=:phone, `state`=:state, `city`=:city, `address`=:address, `postalcode`=:postalcode, `information`=:information,`title`=:title,`price`=:price,`slug`=:slug,`rooms`=:rooms,`area`=:area,`bathrooms`=:bathrooms,`amenities`=:amenities,`status_type`=:status_type,`property_type`=:property_type where id=:id";

                            
                            $stm = $con->prepare($addListing);
                            $stm->execute($insArr);
                            
                             $_SESSION['successMsg'] = 'Your ad updated successfully.';
                             echo "<script>window.location='edit-property?id={$_GET['id']}';</script>";

                            
                            
                    }
                }
    
        $_SESSION['token'] = get_random_string(60);

                
                ?>
                
   <form method="POST" enctype="multipart/form-data" id="submit-form">
       
       <div class="p-3">
      
          
         
                     
                            <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                                    <input type="hidden" name="posted_by" value="<?=$userData->userId;?>">

             <div class="mb-3">
                  <?php foreach($pictures as $picture){ ?>
                                            <img src="<?=$baseurl.$picture;?>" style='width:40%;height:100px'>
                                            <?php } ?>
            <!--<br><label class="form-label text-dark mt-2">Pictures*</label>-->
            <!--                                <input type='file' class="shadow-none form-control" id="pictures" accept='image/*' name="pictures[]" multiple required >-->
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Property Title*</label>
            <input type="text" class="shadow-none form-control" name="title" value="<?=$property->title;?>" required>
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
              <option <?php if($property->status_type=="For Sale") echo "selected" ;?> value="For Sale">For Sale</option>
              <option <?php if($property->status_type=="For Rent") echo "selected" ;?> value="For Rent">For Rent</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label text-dark">Type*</label>
            <select class="shadow-none form-control" name="property_type" required>
              <option <?php if($property->property_type=="Apartment") echo "selected" ;?> value="Apartment">Apartment</option>
              <option <?php if($property->property_type=="House") echo "selected" ;?> value="House">House</option>
              <option <?php if($property->property_type=="Commercial") echo "selected" ;?> value="Commercial">Commercial</option>
              <option <?php if($property->property_type=="Plots") echo "selected" ;?> value="Plots">Plots</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label text-dark">Area/Location</label>
            <input type="text" name="area" class="shadow-none form-control" value="<?=$property->area;?>" required/>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Rooms*</label>
            <select class="shadow-none form-control" name="rooms" required>
               <option  <?php if($property->rooms==1) echo "selected" ;?> value=1>1</option>
                                                <option  <?php if($property->rooms==2) echo "selected" ;?> value=2>2</option>
                                                <option  <?php if($property->rooms==3) echo "selected" ;?> value=3>3</option>
                                                <option <?php if($property->rooms==4) echo "selected" ;?> value=4>4</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Bathrooms*</label>
            <select class="shadow-none form-control" name="bathrooms" required>
              <option  <?php if($property->bathrooms==1) echo "selected" ;?> value=1>1</option>
                                                <option  <?php if($property->bathrooms==2) echo "selected" ;?> value=2>2</option>
                                                <option  <?php if($property->bathrooms==3) echo "selected" ;?> value=3>3</option>
                                                <option <?php if($property->bathrooms==4) echo "selected" ;?> value=4>4</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Property Price</label>
            <input type="number" name="price" class="shadow-none form-control" value="<?=$property->price;?>" required />
          </div>
          
           <div class="mb-3">
            <label class="form-label text-dark fw-bold">Detailed Information</label>
            <textarea
              name="information"
              class="shadow-none form-control text-muted"
              value=""
              rows="3"
              required
            ><?=$property->information;?></textarea>
          </div>
          
            <h3 class="">Features </h3>
                            <div class="mb-3">
                                            <div class="">
                                                <input id="checkbox1" type="checkbox" name="amenities[]" value="Free Parking" 
                                                <?php if(in_array('Free Parking',$amenities)) echo "checked"; ?>
                                                >
                                                <label for="checkbox1">
                                                    Free Parking
                                                </label>
                                            </div>
                                            <div class="">
                                                <input id="checkbox2" type="checkbox" name="amenities[]" value="Air Condition"
                                                <?php if(in_array('Air Condition',$amenities)) echo "checked"; ?>
                                                >
                                                <label for="checkbox2">
                                                    Air Condition
                                                </label>
                                            </div>
                                            <div class="">
                                                <input id="checkbox4" type="checkbox" name="amenities[]" value="Swimming Pool"
                                                <?php if(in_array('Swimming Pool',$amenities)) echo "checked"; ?>
                                                >
                                                <label for="checkbox4">
                                                    Swimming Pool
                                                </label>
                                          </div>
                                            <div class="">
                                                <input id="checkbox5" type="checkbox" name="amenities[]" value="Laundry Room"
                                                <?php if(in_array('Laundry Room',$amenities)) echo "checked"; ?>
                                                >
                                                <label for="checkbox5">
                                                    Laundry Room
                                                </label>
                                            </div>
                                            <div class="">
                                                <input id="checkbox6" type="checkbox" name="amenities[]" value="Window Covering"
                                                <?php if(in_array('Window Covering',$amenities)) echo "checked"; ?>
                                                >
                                                <label for="checkbox6">
                                                    Window Covering
                                                </label>
                                           </div>
                                            <div class="">
                                                <input id="checkbox7" type="checkbox" name="amenities[]" value="Central Heating"
                                                <?php if(in_array('Central Heating',$amenities)) echo "checked"; ?>
                                                >
                                                <label for="checkbox7">
                                                    Central Heating
                                                </label>
                                            </div>
                                            <div class="">
                                                <input id="checkbox8" type="checkbox" name="amenities[]" value="Alarm"
                                                <?php if(in_array('Alarm',$amenities)) echo "checked"; ?>
                                                >
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
                    <option <?php if($property->city==$city->id) echo "selected" ;?> value="<?=$city->id;?>"><?=$city->city_name;?></option>   
                <?php } ?>
            </select>
          </div>
          
           <div class="mb-3">
            <label class="form-label text-dark">Full Address</label>
            <input type="text" name="address" class="shadow-none form-control" value="<?=$property->address;?>" required/>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Postal Code</label>
            <input type="text" name="postalcode" class="shadow-none form-control" value="<?=$property->postalcode;?>"  required/>
          </div>
            
            
            <p>Contact Details</p>
          
            <div class="mb-3">
            <label class="form-label text-dark">Name</label>
            <input type="text" value="<?=$userData->name;?>" name="name" class="shadow-none form-control" value="<?=$property->name;?>" required/>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Email</label>
            <input type="email" value="<?=$userData->email;?>" name="email" class="shadow-none form-control" value="<?=$property->email;?>" readonly/>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Phone</label>
            <input type="number" value="<?=$userData->phone;?>" name="phone" class="shadow-none form-control" value="<?=$property->phone;?>"  required/>
          </div>
            
         
       
      </div>
    
   
    <div class="p-5"></div>

    <div class="fixed-bottom p-3">
      <div class="d-grid">
        <button type="submit" id="submit-btn"  class="btn landsbazzar-bg1 btn-lg text-white">Update</button>
      </div>
    </div>
     
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
