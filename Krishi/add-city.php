<?php
$addCity = 'active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
$states = getStates($con);
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New City</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Add New City</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){

    extract($_POST);
 
   
        if($error == ''){
            $arr['state_id']=$state_id;
            $arr['city_name']=$name;
           
           
                  $addcity = "insert into cities (city_name,state_id) values(:city_name,:state_id)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'cities';</script>";
                  }
        }

      


}
    $_SESSION['token'] = get_random_string(60);
    ?>

     
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
          <div class="col-md-12">
             
            <div class="card card-primary">
             
             <form class="form-horizontal" method="POST"  enctype="multipart/form-data">
             <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                <div class="card-body">

                

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">City Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name"  placeholder="" required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                  <label class="col-sm-2 col-form-label">State</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="state_id"  required>
                      <option value='' disabled selected>Choose State</option>
                      <?php foreach ($states as $state) { ?>
                        <option value='<?= $state->id; ?>'><?= $state->state_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                 
                  
                </div>
              
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="form_data">Submit</button>
                 
                </div>
                
              </form>

            </div>
             
          </div>
        </div>
      </div>
    </section>

  </div>
<?php include 'private/footer.php';?>