<?php
$job='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from jobs ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $services = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Job</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Job</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){
  
  $filename = $_FILES['icon']['name'];
  if($filename!=''){
  $file_size = $_FILES["icon"]["size"];
  $filesize=$file_size/1024;
  $allowed = array('gif', 'png', 'jpg','webp','jpeg');
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  
  if (in_array($ext, $allowed)) {
      $file_type = 'is_image';
      $filedate= date('Ymd')."icon".date('His');
            $insertfile = "img/".$filedate.".".$ext ;
            move_uploaded_file($_FILES["icon"]["tmp_name"], '../'.$insertfile);
  }else{
    $error=3;
    echo "<script>swal('Error!', 'Failed to post.File must be an image', 'error').then(function() {
      window.location = 'add-post';
  })</script>";
  }
  }else{
    $insertfile='NA';
  }
    date_default_timezone_set('Asia/Kolkata');
    $todaydate =  date('d/m/y');

    extract($_POST);
    
    $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($title)));

        if($error == ''){
            $arr['title']=$title;
            $arr['date']=$todaydate;
            $arr['icon']=$insertfile;
            $arr['slug']=$slug;
            $arr['description']=$description;
                  $addcity = "insert into jobs (title,date,description,icon,slug) values(:title,:date,:description,:icon,:slug)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'add-job';</script>";
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
                    <label  class="col-sm-2 col-form-label">Job Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="icon" required>
                    </div>
                  </div>


                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control"  name="description" id="summernote" required></textarea>
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
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Date</th>

                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($services as $p):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><img src="<?=$baseurl.$p->icon;?>" width="40px"></td>
                    <td><?=$p->title;?></td>
                    <td><?=$p->date;?></td>
                    
                    <td>
                      
                      <a href="edit-job?id=<?=$p->id;?>" class="badge badge-warning" >Edit</a>
                      <a href="delete?id=<?=$p->id;?>&type=Job" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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