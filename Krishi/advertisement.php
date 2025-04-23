<?php
$advertisement='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
$sql = 'SELECT * from advertisment ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $cat = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Ad</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Add Ads</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){

    $link = $_POST['link'];
    $filename = $_FILES["image"]["name"];
    $file_size = $_FILES["image"]["size"];

    $filesize=$file_size/1024;
    if($filesize<500){
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    
   
        if($error == ''){


            $tempname = $_FILES['image']['tmp_name'];
            $insertfile = "img/ads/".date('Ymd')."asianviews".date('His').".".$ext ;
            move_uploaded_file($tempname,"../".$insertfile);

        
            $arr['link']=$link;
            $arr['image']=$insertfile;
           
                  $addcity = "insert into advertisment (link,image) values(:link,:image)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'advertisement';</script>";
                  }
        }

      }else{
        echo "<script>swal('Error!', 'File size must be less than 500kb', 'error').then(function() {
                            window.history.back();
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
             
             <form class="form-horizontal" method="POST"  enctype="multipart/form-data">
             <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                <div class="card-body">

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="link"  placeholder="Enter here..." required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label" >Image</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="image" required>
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
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($cat as $p):
                     
                     ?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><a href="<?=$p->link;?>" target="_blank"><img src="<?=$baseurl.$p->image;?>" width="100px"></a></td>
                    <td>
                      
                      <a href="delete?id=<?=$p->id;?>&type=Ad" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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
<?php include 'private/footer.php';?>