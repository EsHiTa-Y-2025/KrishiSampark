<?php
$homes='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

$sql = 'SELECT * FROM home_sections where id=:id';
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

$filename = $_FILES['image']['name'];

if($filename!=''){
$file_size = $_FILES["image"]["size"];
$filesize=$file_size/1024;
$allowed = array('gif', 'png', 'jpg','webp','jpeg','avif');
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (in_array($ext, $allowed)) {
    $file_type = 'is_image';
    $filedate= date('Ymd')."home".date('His');
          $insertfile = "img/".$filedate.".".$ext ;
          move_uploaded_file($_FILES["image"]["tmp_name"], '../'.$insertfile);
}else{
  $error=3;
  echo "<script>swal('Error!', 'Failed to post.File must be an image', 'error').then(function() {
    window.location = 'home-sections';
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

          $arr['image']=$insertfile;
          $arr['content']=$content;
          $arr['position']=$position;
          $arr['id']=$_GET['id'];

           
            
            $addposts = "UPDATE `home_sections` SET `title`=:title,`content`=:content,`image`=:image,`position`=:position WHERE id=:id";
            $stm = $con->prepare($addposts);
            if($stm->execute($arr)){
                      echo "<script>swal('Success!', 'Section Updated successfully.', 'success').then(function() {
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
                    <label  class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title"  value="<?=$p->title;?>" required>
                    </div>
                  </div>

                   <input type="hidden" value="<?=$p->image;?>" name="oldimage">
                
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Image Position</label>
                    <div class="col-sm-10">
                      <select type="text" class="form-control" name="position" required>
                        <option disabled>Select</option>
                        <option <?php if($p->position=='Left') echo 'selected'; ?>>Left</option>
                        <option <?php if($p->position=='Right') echo 'selected'; ?>>Right</option>
                      </select>
                    </div>
                  </div>
                
                  <div class="form-group row" >
                 
                    <label  class="col-sm-2 col-form-label" >Image</label>
                    <div class="col-sm-10">
                      <?php if($p->image!='NA') { ?><img src="<?=$baseurl.$p->image;?>" width="200px"><?php } ?>
                      <input type="file" class="form-control" name="image">
                    </div>
                  </div>



                 
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10" >
                      <textarea class="form-control" id="summernote" name="content" rows="3" required><?=$p->content;?></textarea>
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