<?php
$addproperty = 'active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
$states = getStates($con);

// $sqlforcats = 'SELECT * FROM category order by name';
//         $stmcat = $con->prepare($sqlforcats);
//         $stmcat->execute();
//         $categories = $stmcat->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add New Property</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $baseurl; ?>admin/">Home</a></li>
            <li class="breadcrumb-item active">Add New Property</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']) {

    if (isset($_POST['adSubmit'])) {



      $created_at = date('d-m-Y H:i:s');
      $date = date('d M, Y');


      if (isset($_POST['amenities'])) {
        $amenities = implode(',', $_POST['amenities']);
      } else {
        $amenities = '';
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
        if (move_uploaded_file($imageTmpName, '../'.$targetPath)) {
          $pictures[] = $targetPath;
        } else {
          echo "<script>swal('Error!', 'Picture cannot upload.', 'error').then(function() {
                                  window.location = 'add-property';
                              })</script>";
          exit;
        }
      }

      $pictures = implode(',', $pictures);

      $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($_POST['title'])));
      $insArr['slug'] = $slug;

      $insArr['name'] = $_POST['name'];
      $insArr['email'] = $_POST['email'];
      $insArr['phone'] = $_POST['phone'];
      $insArr['city'] = $_POST['city'];
      $insArr['state'] = $_POST['state'];
      $insArr['address'] = $_POST['address'];
      $insArr['postalcode'] = $_POST['postalcode'];
      $insArr['amenities'] = $amenities;
      $insArr['title'] = $_POST['title'];
      $insArr['information'] = $_POST['information'];
      $insArr['rooms'] = $_POST['rooms'];
      $insArr['area'] = $_POST['area'];
      $insArr['bathrooms'] = $_POST['bathrooms'];
      $insArr['pictures'] = $pictures;
      $insArr['status_type'] = $_POST['status_type'];
      $insArr['property_type'] = $_POST['property_type'];
      $insArr['ad_type'] = "Property";
      $insArr['posted_by'] = $_SESSION['admin_token'];
      $insArr['date'] = $date;
      $insArr['price'] = $_POST['price'];
      $insArr['created_at'] = $created_at;


      $addListing = "INSERT INTO `listings`(`date`,`name`, `email`, `phone`, `posted_by`, `state`, `city`, `address`, `postalcode`, `amenities`, `information`, `title`, `rooms`, `bathrooms`, `area`, `pictures`, `status_type`, `property_type`, `ad_type`,`created_at`,`price`,`slug`) VALUES (:date,:name,:email,:phone,:posted_by,:state,:city,:address,:postalcode,:amenities,:information,:title,:rooms,:bathrooms,:area,:pictures ,:status_type,:property_type,:ad_type,:created_at,:price,:slug)";

      $stm = $con->prepare($addListing);
      $stm->execute($insArr);

      echo "<script>swal('Success!', 'Property Added successfully.', 'success').then(function() {
                                  window.location = 'properties';
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
                  <label class="col-sm-2 col-form-label">Property Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" placeholder="Enter here..." required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">

                    <select class="form-control" name="status_type">
                      <option>For Sale</option>
                      <option>For Rent</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Type</label>
                  <div class="col-sm-10">

                    <select class="form-control" name="property_type">
                      <option>Apartment</option>
                      <option>House</option>
                      <option>Commercial</option>
                      <option>Garage</option>
                      <option>Lot</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Area</label>
                  <div class="col-sm-10">


                    <input type="text" name="area" class="form-control" id="area" placeholder="SqFt">

                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Pictures</label>
                  <div class="col-sm-10">
                    <input type='file' class="form-control" id="pictures" accept='image/*' name="pictures[]" multiple>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Bathrooms</label>
                  <div class="col-sm-10">

                    <select class="form-control" name="bathrooms">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Rooms</label>
                  <div class="col-sm-10">

                    <select class="form-control" name="rooms">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
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
                      <option value=''>Select City</option>

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
                  <label class="col-sm-2 col-form-label">Postal Code</label>
                  <div class="col-sm-10">

                                        <input type="text" name="postalcode" class="form-control" id="postalcode" placeholder="Postal Code" required>
                  </div>
                </div>



                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Detailed Information</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="" name="information" rows="5" required></textarea>
                    <!--<span class="text-danger text-sm">Maximum length 4000 letters.</span>-->
                  </div>
                </div>






                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Features</label>
                  <div class="col-sm-10">
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


                   <div class="form-group row">
                  <div class="col-sm-12">
                     <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group title">
                                        <label for="inputname1" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="inputname1" placeholder="Name" value="Admin">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group email">
                                        <label for="inputEmail1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email"  value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group phone">
                                        <label for="inputphone1" class="form-label">Phone</label>
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
        url: "<?= $baseurl; ?>ajax/getCities.php",
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

  function displayDivDemo(id, elementValue) {
    document.getElementById(id).style.display = elementValue.value == '1' ? 'none' : '';
    document.getElementById('imgdiv').style.display = elementValue.value == '1' ? '' : 'none';


  }
</script>
<?php include 'private/footer.php'; ?>