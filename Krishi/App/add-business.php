<?php 
require('private/header.php');

$cities = getCitiesByState($con,2);

$categories = get_category($con);


?>
  <body>
    <div class="bg-white shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="gap-3 d-flex align-items-center">
          <a href="select-posting"
            ><i class="bi bi-arrow-left d-flex text-danger h2 m-0 back-page"></i
          ></a>
          <h3 class="fw-bold m-0">Add Business Free</h3>
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
                                    echo "<script>window.location='add-business';</script>";
                                }
                            }
                            
                            $pictures = implode(',',$pictures);
                         
                            $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($_POST['title'])));
                            
                            $insArr['name']=$_POST['name'];
                            $insArr['email']=$_POST['email'];
                            $insArr['phone']=$_POST['phone'];
                            $insArr['city']=$_POST['city'];
                            $insArr['state']=2;
                            $insArr['address']=$_POST['address'];
                            $insArr['postalcode']=$_POST['postalcode'];
                            $insArr['title']=$_POST['title'];
                            $insArr['information']=$_POST['information'];
                            $insArr['pictures']=$pictures;
                            $insArr['ad_type']="Business";
                            $insArr['posted_by']=$_POST['posted_by'];
                            $insArr['date']=$date;
                            $insArr['service_type']=$_POST['service_type'];
                            $insArr['price']=$_POST['price'];
                            $insArr['mode_of_payment']=$_POST['mode_of_payment'];
                            $insArr['est_year']=$_POST['est_year'];
                            $insArr['open_time']=$_POST['open_time'];
                            $insArr['created_at']=$created_at;
                            $insArr['slug']=$slug;
                           
                            
                            $addListing = "INSERT INTO `listings` (`date`,`name`, `email`, `phone`, `posted_by`, `state`, `city`, `address`, `postalcode`, `information`,`pictures` ,`title`, `ad_type`,`service_type`,`price`,`mode_of_payment`,`est_year`,`open_time`,`created_at`,`slug`) VALUES (:date,:name,:email,:phone,:posted_by,:state,:city,:address,:postalcode,:information,:pictures,:title,:ad_type,:service_type,:price,:mode_of_payment,:est_year,:open_time,:created_at,:slug)";
                            
                            $stm = $con->prepare($addListing);
                            $stm->execute($insArr);
                            
                             $_SESSION['successMsg'] = 'Your business submitted successfully. We will verify it before publishing.';
                             echo "<script>window.location='add-business';</script>";

                            
                            
                    }
                }
    
        $_SESSION['token'] = get_random_string(60);

                
                ?>
                
   <form method="POST" enctype="multipart/form-data" class="form" >
       
       <div class="p-3">
      <div class="mb-4 bg-primary p-3 text-white rounded">
        <h3>
          Post your business for FREE with India's leading local search engine
        </h3>
      </div>
     
          
         
                     
                            <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                                    <input type="hidden" name="posted_by" value="<?=$userData->userId;?>">

             <div class="mb-3">
            <label class="form-label text-dark">Upload Pictures (More than one)*</label>
                                            <input type='file' class="shadow-none form-control" id="pictures" accept='image/*' name="pictures[]" multiple required >
          </div>
          
          <div class="mb-3">
            <label class="form-label text-dark">Business Title*</label>
            <input type="text" class="shadow-none form-control" name="title" value="" required>
          </div>

          <div class="mb-3">
            <label class="form-label text-dark">Business Type*</label>
            <select class="shadow-none form-control"  name="service_type" required>
                                                <option value="">Choose</option>
                                                <?php foreach($categories as $cat){ ?>
                                                <option value="<?=$cat->id;?>"><?=$cat->cat_name;?></option>
                                                <?php } ?>
                                            </select>
          </div>

          

          <div class="mb-3">
             <label for="price" class="form-label">Price</label>
                                            <input type="text" name="price" class="shadow-none form-control" id="price" placeholder="eg. 1,20,000">
          </div>
          
          <div class="mb-3">
            <label for="est_year" class="form-label">Establishment Year</label>
                                            <input type="number" name="est_year" class="shadow-none form-control" id="est_year" placeholder="eg. 2017">
          </div>
          
           <div class="mb-3">
                                                        <label for="mode_of_payment" class="form-label">Mode Of Payment</label>

                                            <input type="text" name="mode_of_payment" class="shadow-none form-control" id="mode_of_payment" placeholder="eg. Credit Cards,Debit Cards,UPI">
          </div>
          
          <div class="mb-3">
            <label for="open_time" class="form-label">Timings</label>
                                            <input type="text" name="open_time" class="shadow-none form-control" id="open_time" placeholder="eg. 10:00am-5:00pm">
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
            <input type="number" value="<?=$userData->phone;?>" name="phone" class="shadow-none form-control"  readonly/>
          </div>
            
         
       
      </div>
    
   
    <div class="p-5"></div>

    <div class="fixed-bottom p-3">
      <div class="d-grid">
        <button type="submit" id="submit-btn" class="btn landsbazzar-bg1 btn-lg">Submit</button>
      </div>
    </div>
     
     </form>
     
      <script>
    // Add an event listener to the form submission
        document.getElementsByClassName('form')[0].addEventListener('submit', function (e) {
      // Prevent the form from submitting
      e.preventDefault();

      // Display the "Registering..." message
      document.getElementById('submit-btn').textContent = 'Please wait...';

      setTimeout(function () {
        document.getElementsByClassName('form')[0].submit();
      }, 2000);
    });
  </script>
  

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
    
   
  </body>
</html>
