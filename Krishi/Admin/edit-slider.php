<?php
$Sliders='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

      
$sql = 'SELECT * FROM sliders where id=:id';
$statement = $con->prepare($sql);
$statement->execute(['id'=>$_GET['id']]);
$media = $statement->fetchAll(PDO::FETCH_OBJ);
if(count($media)>0){
    $m=$media[0];    
}else{
    echo "<script>window.location='home'</script>";
}

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
<?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){


    $filename = $_FILES["image"]["name"];
    if($filename!=''){
    $file_size = $_FILES["image"]["size"];
    $filesize=$file_size/1024;
    if($filesize<500){
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
     $tempname = $_FILES['image']['tmp_name'];
            $insertfile = "img/sliders/".date('Ymd')."banosys".date('His').".".$ext ;
            move_uploaded_file($tempname,"../".$insertfile);
            
    }else{
        $error='Size';
        echo "<script>swal('Error!', 'File size must be less than 500kb', 'error').then(function() {
                            window.history.back();
                        })</script>";
      }
    
    }else{
        $insertfile=$_POST['oldimage'];
    }

    
   
        if($error == ''){


          
            $arr['image']=$insertfile;
            $arr['id']=$_GET['id'];
            
            
                  $addcity = "update sliders set image=:image where id=:id";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'sliders';</script>";
                  }
        }

      


}
    $_SESSION['token'] = get_random_string(60);
    ?>
             <form class="form-horizontal" method="POST"   enctype="multipart/form-data">
               <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                <div class="card-body">
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Upload image</label>
                    <div class="col-sm-10">
                          <img src="<?=$baseurl.$m->image;?>" width="320" height="240">
                      <input type="file" class="form-control" name="image" id="image" >
                    </div>
                  </div>
                  <input type="hidden" name="oldimage" value="<?=$m->image;?>">
                  
                
              
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