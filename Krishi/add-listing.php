<?php
$addlisting = 'active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

$states = getStates($con);
$categories = get_category($con);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add New Lisiting</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $baseurl; ?>admin/">Home</a></li>
            <li class="breadcrumb-item active">Add New Lisiting</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>



<?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']) {

                    if(isset($_POST['adSubmit'])){
                        
                        
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
                            $insArr['posted_by'] = $_SESSION['admin_token'];
                            $insArr['category']=$_POST['category'];
                            $insArr['price']=$_POST['price'];
                            $insArr['subcategory']=$_POST['subcategory'];
                            $insArr['more_category']=$_POST['more_category'];
                            
                            $insArr['created_at']=$created_at;
                            $insArr['slug']=$slug;
                           
                            
                            $addListing = "INSERT INTO `listings` (`name`, `phone`, `posted_by`, `state`, `city`, `address`, `information`,`pictures` ,`title`, `category`,`subcategory`,`price`,`created_at`,`slug`,`more_category`) VALUES (:name,:phone,:posted_by,:state,:city,:address,:information,:pictures,:title,:category,:subcategory,:price,:created_at,:slug,:more_category)";
                            
                            $stm = $con->prepare($addListing);
                            $stm->execute($insArr);
                            
                           echo "<script>swal('Success!', 'Listing Added successfully.', 'success').then(function() {
                                  window.location = 'listings';
                              })</script>";

                            
                            
                    }
                }
    
        $_SESSION['token'] = get_random_string(60);

                
                ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">

            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
              <div class="card-body">
                  
                  <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Pictures</label>
                  <div class="col-sm-10">
                    <input type='file' class="form-control" id="pictures" accept='image/*' name="pictures[]" multiple>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" placeholder="Enter here..." required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Category</label>
                  <div class="col-sm-10">

                    <select class="form-control" name="category" id="category">
                      <option value="">Choose Category</option>
                                                <?php foreach($categories as $cat){ ?>
                                                <option value="<?=$cat->id;?>"><?=$cat->cat_name;?></option>
                                                <?php } ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Sub Category</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="subcategories" name="subcategory" required>
                      <option value=''>Choose Sub Category</option>

                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">More Subcategory</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="morecategories" name="more_category" required>
                      <option value=''>Choose Sub Category</option>

                    </select>
                  </div>
                </div>

                
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Price</label>
                  <div class="col-sm-10">
                        <input type="text" name="price" class="form-control" id="price" placeholder="eg. 1,20,000">
                  </div>
                </div>


               


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">State</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="state" id="state" required>
                      <option value=''>Choose State</option>
                      <?php foreach ($states as $state) { ?>
                        <option value='<?= $state->id; ?>'><?= $state->state_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">City</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="cities" name="city" required>
                      <option value=''>Choose City</option>

                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Full Address</label>
                  <div class="col-sm-10">
                      <input type="text" name="address" class="form-control" id="address" placeholder="Address" required>
                  </div>
                </div>
               

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Detailed Information</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="" name="information" rows="5" required></textarea>
                  </div>
                </div>





                   <div class="form-group row">
                  <div class="col-sm-12">
                     <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group title">
                                        <label for="inputname1" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="inputname1" placeholder="Name" value="Admin">
                                    </div>
                                </div>
                                <!--<div class="col-lg-4 col-md-4 col-sm-12">-->
                                <!--    <div class="form-group email">-->
                                <!--        <label for="inputEmail1" class="form-label">Email</label>-->
                                <!--        <input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email"  value="" required>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group phone">
                                        <label for="inputphone1" class="form-label">Phone </label>
                                        <input type="text" name="phone" class="form-control" id="inputphone1" placeholder="Phone"  value="" required>
                                    </div>
                                </div>
                               
                            </div>
                  </div>
                </div>
                <div class="text-center"> <button type="submit" class="btn btn-info" name="adSubmit">Submit</button></div>





              </div>
              
              
            </form>

          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>

<script>
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

  function displayDivDemo(id, elementValue) {
    document.getElementById(id).style.display = elementValue.value == '1' ? 'none' : '';
    document.getElementById('imgdiv').style.display = elementValue.value == '1' ? '' : 'none';


  }
</script>
<?php include 'private/footer.php'; ?>