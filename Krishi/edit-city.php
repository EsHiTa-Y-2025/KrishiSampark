<?php
$cities='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
$states = getStates($con);

    $sql = 'SELECT * from cities where id=:id';
    $statement = $con->prepare($sql);
    $statement->execute(['id'=>$_GET['id']]);
    $city = $statement->fetchAll(PDO::FETCH_OBJ);
    if(count($city)>0){
        $city=$city[0];
    }else{
        echo "<script>window.history.back();</script>";
    }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit <?=$city->city_name;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active"> <?=$city->city_name;?></li>
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

        
            $arr['city_name']=$city_name;
            $arr['state_id']=$state_id;

            $arr['id']=$_GET['id'];
            
                  $update = "UPDATE `cities` SET `city_name`=:city_name,`state_id`=:state_id WHERE id=:id";
                  $stm = $con->prepare($update);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'cities';</script>";
                  }
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
             
             <form class="form-horizontal" method="POST"  enctype="multipart/form-data">
             <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                <div class="card-body">

                
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">City Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="city_name" value="<?=$city->city_name;?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                  <label class="col-sm-2 col-form-label">State</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="state_id" id="state_id" required>
                      <option value='' disabled selected>Choose State</option>
                      <?php foreach ($states as $state) { ?>
                        <option <?php if($city->state_id==$state->id) echo "selected"; ?> value='<?= $state->id; ?>'><?= $state->state_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="form_data">Update</button>
                 
                </div>
                <!-- /.card-footer -->
              </form>

            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>

  </div>
<?php include 'private/footer.php';?>