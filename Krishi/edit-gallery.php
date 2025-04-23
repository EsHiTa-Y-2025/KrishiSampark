<?php
$gallery='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
$sql = 'SELECT * from gallery where id=:id';
    $statement = $con->prepare($sql);
    $statement->execute(['id'=>$_GET['id']]);
    $gallery = $statement->fetchAll(PDO::FETCH_OBJ);
    if(count($gallery)>0){
        $g=$gallery[0];
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
            <h1>Edit gallery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){
  extract($_POST);

  $image_all = array('gif', 'png', 'jpg','webp','jpeg');
  $video_all = array('mp4');
  $filename = $_FILES['file_url']['name'];
  if($filename!=''){
      
    $file_size = $_FILES["file_url"]["size"];
    $filesize=$file_size/1024;
    if($filesize<500){

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
        if (in_array($ext, $video_all)) {
            $file_type = 'Video';
        }elseif(in_array($ext, $image_all)){
            $file_type =  'Image';
        }
    
    
        $filedate= date('Ymd')."gallery".date('His');
        $insertfile = "img/".$filedate.".".$ext ;
        move_uploaded_file($_FILES["file_url"]["tmp_name"], '../'.$insertfile);
    }else{
        $error='Size';
        echo "<script>swal('Error!', 'File size must be less than 500kb', 'error').then(function() {
                            window.history.back();
                        })</script>";
      }

  }else{
    $insertfile=$oldurl;
    $file_type=$oldtype;
  }
        if($error == ''){

            $arr['type']=$file_type;
            $arr['url']=$insertfile;
            $arr['id']=$_GET['id'];
            
            $addpackages = "update gallery set url=:url , type=:type where id=:id";
            $stm = $con->prepare($addpackages);
            if($stm->execute($arr)){
                      echo "<script>swal('Success!', 'Gallery Updated successfully.', 'success').then(function() {
                                  window.location = 'gallery';
                              })</script>";
            }
        }else{
          echo 'error';
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
                    <label  class="col-sm-2 col-form-label">File</label>
                    <div class="col-sm-10">

                    <?php if($g->type=='Image'){ ?>
                            <img src="<?=$baseurl.$g->url;?>" width="320" height="240">
                        <?php }else{ ?>    
                            <video width="320" height="240" controls>
                                <source src="<?=$baseurl.$g->url;?>" type="video/mp4">
                                </video>
                        <?php } ?>
                        <input type="hidden" name="oldurl" value="<?=$g->url;?>">
                        <input type="hidden" name="oldtype" value="<?=$g->type;?>">
                      <input type="file" class="form-control" name="file_url" >
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