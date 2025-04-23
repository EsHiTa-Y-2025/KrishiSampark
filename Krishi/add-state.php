<?php
$addState = 'active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New State</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Add New State</li>
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
            
            $arr['state_name']=$state_name;
           
           
                  $addcity = "insert into states (state_name) values(:state_name)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'states';</script>";
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
                    <label  class="col-sm-2 col-form-label">State Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="state_name"  placeholder="" required>
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