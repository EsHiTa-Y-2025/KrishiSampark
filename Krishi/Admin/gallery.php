<?php
$gallery='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from gallery ORDER BY id desc';
    $statement = $con->prepare($sql);
    $statement->execute();
    $gallery = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gallery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){
  $id=$_GET['id'];

  $image_all = array('gif', 'png', 'jpg','webp','jpeg');
  $video_all = array('mp4');
  $filename = $_FILES['file_url']['name'];
  
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
  
    
    extract($_POST);
    
        if($error == ''){
            $arr['type']=$file_type;
            $arr['url']=$insertfile;
           
                  $addcity = "insert into gallery (type,url) values(:type,:url)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'gallery'
                                  </script>";
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

               

                  <!-- <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Type</label>
                    <div class="col-sm-10">
                      <select type="text" class="form-control" name="type" required>
                        <option disabled>Select</option>
                        <option>Image</option>
                        <option>Video</option>
                      </select>
                    </div>
                  </div> -->

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Choose file</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="file_url" required>
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

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
           <div class="col-12">
             <div class="card">
             
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No</th>
                    <th>File</th>
                    <th>Type</th>
                   
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($gallery as $p):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td>
                        <?php if($p->type=='Image'){ ?>
                            <img src="<?=$baseurl.$p->url;?>" width="320" height="240">
                        <?php }else{ ?>    
                            <video width="320" height="240" controls>
                                <source src="<?=$baseurl.$p->url;?>" type="video/mp4">
                                </video>
                        <?php } ?>
                    </td>
                    <td><?=$p->type;?></td>
                    
                    <td>
                      
                      <a href="edit-gallery?id=<?=$p->id;?>" class="badge badge-warning" >Edit</a>
                      <a href="delete?id=<?=$p->id;?>&type=Gallery" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>
                     
                    </td>
                  </tr>
                  <?php $sno++; endforeach; ?>
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
           </div>
        </div> <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
<?php include 'private/footer.php';

?>