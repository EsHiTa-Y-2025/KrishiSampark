<?php
require('private/header.php');

$states = getStates($con);


$categories = get_sub_category_by_cat($con,3);


?>

<body>
  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'sell_your_animal');?></h3>
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

    if (isset($_POST['title'])) {


      $created_at=date('d-m-Y H:i:s');
                        
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
                                if (move_uploaded_file($imageTmpName, '../'.$targetPath)) {
                                    $pictures[]=$targetPath;
                                } 
                            }
                            
                            $pictures = implode(',',$pictures);
                         
                            $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($_POST['title'])));
                            
                            $insArr['name']=$_POST['name'];

                            $insArr['phone']=$_POST['phone'];
                            $insArr['city']=$_POST['city'];
                            $insArr['state']=$_POST['state'];
                            $insArr['address']=$_POST['address'];
                            $insArr['title']=$_POST['title'];
                            $insArr['information']=$_POST['information'];
                            $insArr['pictures']=$pictures;
                            $insArr['posted_by'] = $userData->userId;
                            $insArr['category']=3;
                            $insArr['price']=$_POST['price'];
                            $insArr['subcategory']=$_POST['subcategory'];
                            $insArr['lactation']=$_POST['lactation'];
                            $insArr['milk_capacity']=$_POST['milk_capacity'];
                            $insArr['age']=$_POST['age'];
                            $insArr['more_category']=$_POST['more_category'];
                            
                            $insArr['created_at']=$created_at;
                            $insArr['slug']=$slug;
                           
                            
                            $addListing = "INSERT INTO `listings` (`name`, `phone`, `posted_by`, `state`, `city`, `address`, `information`,`pictures` ,`title`, `category`,`subcategory`,`price`,`created_at`,`slug`,`more_category`,`milk_capacity`,`age`,`lactation`) VALUES (:name,:phone,:posted_by,:state,:city,:address,:information,:pictures,:title,:category,:subcategory,:price,:created_at,:slug,:more_category,:milk_capacity,:age,:lactation)";
                            
                            $stm = $con->prepare($addListing);
                            $stm->execute($insArr);

      $id = $con->lastInsertId();

      //  $_SESSION['successMsg'] = 'Your ad submitted successfully. We will verify it before publishing.';
      echo "<script>window.location='animal-added?id={$id}';</script>";
    }
  }

  $_SESSION['token'] = get_random_string(60);


  ?>

  <form method="POST" enctype="multipart/form-data" class="form">

    <div class="p-3">
      


      <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
      <input type="hidden" name="posted_by" value="<?= $userData->userId; ?>">

      <div class="mb-3">
        <label class="form-label text-dark"><?=getLanguageString($con,$lang,'upload_picture');?></label>
        <input type='file' class="shadow-none form-control" id="pictures" accept='image/*' name="pictures[]"  required>
      </div>

      <div class="mb-3">
        <label class="form-label text-dark"><?=getLanguageString($con,$lang,'title');?></label>
        <input type="text" class="shadow-none form-control" name="title" value="" required>
      </div>

      <div class="mb-3">
        <label class="form-label text-dark">Choose Category</label>
        <select class="shadow-none form-control" name="subcategory" id="category" required>

          <option value="" disabled selected>Choose Category</option>
                                                <?php foreach($categories as $cat){ ?>
                                                <option value="<?=$cat->subcategory_id;?>"><?=$cat->subcategory_name;?></option>
                                                <?php } ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label text-dark">Sub Category</label>
        <select class="shadow-none  form-control" id="subcategories" name="more_category" required>
                      <option value=''>Choose Sub Category</option>

                    </select>
      </div>
      

      
      <div class="mb-3">
        <label class="form-label text-dark"><?=getLanguageString($con,$lang,'lactation');?></label>
        <input type="text" class="shadow-none form-control" name="lactation" value="" required>
      </div>
      
      
      <div class="mb-3">
        <label class="form-label text-dark"><?=getLanguageString($con,$lang,'milk_capacity');?></label>
        <input type="text" class="shadow-none form-control" name="milk_capacity" value="" required>
      </div>
      
      <div class="mb-3">
        <label class="form-label text-dark"><?=getLanguageString($con,$lang,'age');?></label>
        <input type="text" class="shadow-none form-control" name="age" value="" required>
      </div>

      <div class="mb-3">
         <label for="price" class="form-label"><?=getLanguageString($con,$lang,'price');?></label>
                                        <input type="text" name="price" class="shadow-none form-control" id="price" placeholder="eg. 1,20,000">
      </div>

      <!--<div class="mb-3">-->
      <!--  <label for="est_year" class="form-label">Establishment Year</label>-->
      <!--                                  <input type="number" name="est_year" class="shadow-none form-control" id="est_year" placeholder="eg. 2017">-->
      <!--</div>-->



     





      <div class="mb-3">
        <label class="form-label text-dark fw-bold"><?=getLanguageString($con,$lang,'detailed_information');?></label>
        <textarea name="information" class="shadow-none form-control text-muted" value="" rows="3" ></textarea>
      </div>
      
  

      <h3><?=getLanguageString($con,$lang,'address_details');?></h3>

      <input type="hidden" name="state" value="2">
      <div class="mb-3">
        <label class="form-label text-dark"><?=getLanguageString($con,$lang,'state');?></label>
        <select class="shadow-none form-control" name="state" id="state" required>
          <option value="" disabled selected>Choose</option>
          <?php foreach ($states as $state) { ?>
            <option value="<?= $state->id; ?>"><?= $state->state_name; ?></option>
          <?php } ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label text-dark"><?=getLanguageString($con,$lang,'city');?></label>
        <select class="shadow-none form-control" name="city" id="cities" required>
          <option value="" disabled selected>Choose</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label text-dark"><?=getLanguageString($con,$lang,'full_address');?></label>
        <input type="text" name="address" class="shadow-none form-control" required />
      </div>

      <div class="mb-3">
        <label class="form-label text-dark"><?=getLanguageString($con,$lang,'postal_code');?></label>
        <input type="text" name="postalcode" class="shadow-none form-control" required />
      </div>


      <p>Contact Details</p>

      <div class="mb-3">
        <label class="form-label text-dark">Name</label>
        <input type="text" value="<?= $userData->name; ?>" name="name" class="shadow-none form-control" required />
      </div>


      <div class="mb-3">
        <label class="form-label text-dark">Phone</label>
        <input type="number" value="<?= $userData->phone; ?>" name="phone" class="shadow-none form-control" readonly />
      </div>



    </div>


    <div class="p-5"></div>

    <div class="fixed-bottom p-3">
      <div class="d-grid">
        <button type="submit" id="submit-btn" class="btn krishisampark-btn btn-lg text-white"><?=getLanguageString($con,$lang,'submit');?></button>
      </div>
    </div>

  </form>

  <script>
    // Add an event listener to the form submission
    document.getElementsByClassName('form')[0].addEventListener('submit', function(e) {
      // Prevent the form from submitting
      e.preventDefault();

      // Display the "Registering..." message
      document.getElementById('submit-btn').textContent = '<?=getLanguageString($con,$lang,'please_wait');?>...';

      setTimeout(function() {
        document.getElementsByClassName('form')[0].submit();
      }, 2000);
    });


    $(document).ready(function() {
      $('#state').on('change', function() {
        var state_id = this.value;
        $.ajax({
          url: "../ajax/getCities.php",
          type: "POST",
          data: {
            state_id: state_id
          },
          cache: false,
          success: function(dataResult) {
            $("#cities").html(dataResult);
          }
        });


      });
    });

    $(document).ready(function() {
      $('#category').on('change', function() {
        var parent_id = this.value;
        $.ajax({
          url: "../ajax/getSubCategories.php",
          type: "POST",
          data: {
            parent_id: parent_id
          },
          cache: false,
          success: function(dataResult) {
            $("#subcategories").html(dataResult);
          }
        });


      });
    });

    $(document).ready(function() {
      $('#subcategories').on('change', function() {
        var parent_id = this.value;
        $.ajax({
          url: "../ajax/getMoreCategories.php",
          type: "POST",
          data: {
            parent_id: parent_id
          },
          cache: false,
          success: function(dataResult) {
            $("#morecategories").html(dataResult);
          }
        });


      });
    });
  </script>

 
  <script src="vender/jquery/jquery.min.js" type="12f990073857c990e213daed-text/javascript"></script>
  <script src="vender/bootstrap/js/bootstrap.bundle.min.js" type="12f990073857c990e213daed-text/javascript"></script>

  <script src="vender/slick/slick/slick.min.js" type="12f990073857c990e213daed-text/javascript"></script>

  <script src="vender/sidebar/hc-offcanvas-nav.js" type="12f990073857c990e213daed-text/javascript"></script>

  <script src="js/custom.js" type="12f990073857c990e213daed-text/javascript"></script>
  <script src="https://askbootstrap.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="12f990073857c990e213daed-|49" defer></script>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816" integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw==" data-cf-beacon='{"rayId":"7dcef2b2ad770da6","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>


</body>

</html>