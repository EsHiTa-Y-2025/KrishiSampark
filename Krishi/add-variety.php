<?php
if(isset($_GET['category'])){
$category='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $varieties = get_variety($con,$_GET['category']);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Variety</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Variety</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   
    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){
  extract($_POST);
  
  $filename = $_FILES['icon']['name'];
  if($filename!=''){
  $file_size = $_FILES["icon"]["size"];
  $filesize=$file_size/1024;
  $allowed = array('gif', 'png', 'jpg','webp','jpeg');
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  
  if (in_array($ext, $allowed)) {
      
      $filedate= date('Ymd')."card".date('His');
            $insertfile = "media/categories/".$filedate.".".$ext ;
            move_uploaded_file($_FILES["icon"]["tmp_name"], '../'.$insertfile);
  }else{
    $error=3;
    echo "<script>swal('Error!', 'Failed to post.File must be an image', 'error').then(function() {
                                  window.location = 'add-variety?category={$_GET['category']}';
  })</script>";
  }
  }else{
    $insertfile='NA';
  }
   
        if($error == ''){


            $arr['name']=esc($name);
            $arr['icon']=$insertfile;
            $arr['cat_id']=$_GET['category'];
            $arr['name_marathi']=$name_marathi;
            $arr['name_kannad']=$name_kannad;
            
            $addpackages = "INSERT INTO `more_varieties` (`cat_id`, `name`, `icon`, `name_kannad`, `name_marathi`) VALUES (:cat_id,:name,:icon,:name_kannad,:name_marathi)";
            $stm = $con->prepare($addpackages);
            if($stm->execute($arr)){
                      echo "<script>swal('Success!', 'Variety Added successfully.', 'success').then(function() {
                                  window.location = 'add-variety?category={$_GET['category']}';
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
                    <label  class="col-sm-2 col-form-label">Variety Name In English</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name"  placeholder="Enter here..." required>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Variety Name In Kannad</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name_kannad"   required>
                    </div>
                  </div>
                  
                   <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Variety Name In Marathi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name_marathi"  required>
                    </div>
                  </div>
                  
                  
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Variety Icon</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="icon" accept="image/*"  required>
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
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($varieties as $p):
                     
                     ?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><img src="<?=$baseurl.$p->icon;?>" width="100px"></td>
                    <td><?=$p->name;?></td>
                    <td>
                     
                      <!-- <a href="category-posts?cat_id=<?=$p->id;?>" class="badge badge-warning">View Posts</a> -->
                      <a href="delete?id=<?=$p->id;?>&type=Variety" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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
<?php include 'private/footer.php'; } else{ echo "<script>window.location='index'"; }?>