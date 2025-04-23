<?php
$team='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from team where id=:id';
    $statement = $con->prepare($sql);
    $statement->execute(['id'=>$_GET['id']]);
    $teams = $statement->fetchAll(PDO::FETCH_OBJ);
    if(count($teams)<1){
      echo "<script>window.location='home'</script>";
    }else{
      $teams=$teams[0];
    }
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit <?=$teams->name;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Team</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){

    extract($_POST);

    $filename = $_FILES['image']['name'];

    if($filename!=''){
    $file_size = $_FILES["image"]["size"];
    $filesize=$file_size/1024;
    $allowed = array('gif', 'png', 'jpg','webp','jpeg');
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
      if (in_array($ext, $allowed)) {
          $file_type = 'is_image';
          $filedate= date('Ymd')."teammember".date('His');
                $insertfile = "img/".$filedate.".".$ext ;
                move_uploaded_file($_FILES["image"]["tmp_name"], '../'.$insertfile);
      }else{
        $error=3;
        echo "<script>swal('Error!', 'Failed to post.File must be an image', 'error').then(function() {
          window.location = 'team';
      })</script>";
      }
    }else{
      $insertfile=$oldimage;
    }
    
        

    
   
        if($error == ''){

        
            $arr['designation']=$designation;
            $arr['name']=$name;
            $arr['image']=$insertfile;
            $arr['id']=$_GET['id'];
           
                  $addcity = "UPDATE `team` SET `name`=:name,`designation`=:designation,`image`=:image WHERE id=:id";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'team';</script>";
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
                    <label  class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name"  value="<?=$teams->name;?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Designation</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="designation"  value="<?=$teams->designation;?>"  required>
                    </div>
                  </div>

                  <div class="form-group row" >
                 
                    <label  class="col-sm-2 col-form-label" >Image</label>
                    <div class="col-sm-2">
                      <img src="<?=$baseurl.$teams->image;?>" width="150px">
                      <input type="hidden" class="form-control" name="oldimage" value="<?=$teams->image;?>">
                    </div>
                    <div class="col-sm-8">
                      <input type="file" class="form-control" name="image">
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="form_data">Submit</button>
                 
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