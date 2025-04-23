<?php
$job='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

$sql = 'SELECT * FROM jobs where id=:id';
$statement = $con->prepare($sql);
$statement->execute(['id'=>$_GET['id']]);
$pages = $statement->fetchAll(PDO::FETCH_OBJ);
if(count($pages)>0){
    $p=$pages[0];
}

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit <?=$p->title;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit <?=$p->title;?></li>
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
    $file_type = 'is_image';
    $filedate= date('Ymd')."icon".date('His');
          $insertfile = "img/".$filedate.".".$ext ;
          move_uploaded_file($_FILES["icon"]["tmp_name"], '../'.$insertfile);
}else{
  $error=3;
  echo "<script>swal('Error!', 'Failed to post.File must be an image', 'error').then(function() {
    window.location = 'add-job';
})</script>";
}
}else{
  $insertfile=$oldimage;
}


       


        if(strlen($description)>14000){
          $error='Size is too large';
          echo strlen($description);
          echo "<script>swal('Error!', 'Description size is too large.', 'error').then(function() {
           window.history.back();
        })</script>";
        }
            
   
    
        if($error == ''){
          
        
        $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($title)));

           
          $arr['title']=$title;
          $arr['slug']=$slug;
          $arr['icon']=$insertfile;
          $arr['description']=$description;
          $arr['id']=$_GET['id'];

           
            
            $addposts = "UPDATE `jobs` SET `title`=:title,`description`=:description,`icon`=:icon,`slug`=:slug WHERE id=:id";
            $stm = $con->prepare($addposts);
            if($stm->execute($arr)){
                      echo "<script>swal('Success!', 'Job Updated successfully.', 'success').then(function() {
                                  window.history.go(-2);
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
                    <label  class="col-sm-2 col-form-label">Post Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title"  value="<?=$p->title;?>" required>
                    </div>
                  </div>

                   <input type="hidden" value="<?=$p->icon;?>" name="oldimage">
                
                
                  <div class="form-group row" >
                 
                    <label  class="col-sm-2 col-form-label" >Icon</label>
                    <div class="col-sm-10">
                      <img src="<?=$baseurl.$p->icon;?>" width="200px">
                      <input type="file" class="form-control" name="icon">
                    </div>
                  </div>



                 
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10" >
                      <textarea class="form-control" id="summernote" name="description" rows="12" required><?=$p->description;?></textarea>
                      <span class="text-danger text-sm">Maximum length 4000 letters.</span>
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