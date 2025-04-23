<?php
$category='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
$sql = 'SELECT * from categories where id=:id';
    $statement = $con->prepare($sql);
    $statement->execute(['id'=>$_GET['id']]);
    $cat = $statement->fetchAll(PDO::FETCH_OBJ);
    if(count($cat)>0){
        $cat=$cat[0];
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
            <h1>Edit Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){
  extract($_POST);
  
  $filename = $_FILES['cat_icon']['name'];
  if($filename!=''){
  $file_size = $_FILES["cat_icon"]["size"];
  $filesize=$file_size/1024;
  $allowed = array('gif', 'png', 'jpg','webp','jpeg');
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  
  if (in_array($ext, $allowed)) {
      
      $filedate= date('Ymd')."card".date('His');
            $insertfile = "media/categories/".$filedate.".".$ext ;
            move_uploaded_file($_FILES["cat_icon"]["tmp_name"], '../'.$insertfile);
  }else{
    $error=3;
    echo "<script>swal('Error!', 'Failed to post.File must be an image', 'error').then(function() {
      window.location = 'category';
  })</script>";
  }
  }else{
    $insertfile="$old_cat_icon";
  }
  
   
        if($error == ''){

            $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($cat_name)));
            $arr['cat_name']=esc($cat_name);
            $arr['slug']=$slug;
            $arr['cat_icon']=$insertfile;
            $arr['id']=$_GET['id'];
            $arr['cat_name_marathi']=$cat_name_marathi;
            $arr['cat_name_kannad']=$cat_name_kannad;
            
            $addpackages = "update categories set cat_name=:cat_name , slug=:slug,cat_icon=:cat_icon, cat_name_marathi=:cat_name_marathi,cat_name_kannad=:cat_name_kannad where id=:id";
            $stm = $con->prepare($addpackages);
            if($stm->execute($arr)){
                      echo "<script>swal('Success!', 'Category Updated successfully.', 'success').then(function() {
                                  window.location = 'category';
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
                    <label  class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="cat_name" value="<?=$cat->cat_name;?>"   required>
                    </div>
                  </div>
                  
                   <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Category Name In Kannad</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="cat_name_kannad" value="<?=$cat->cat_name_kannad;?>"   required>
                    </div>
                  </div>
                  
                   <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Category Name In Marathi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="cat_name_marathi" value="<?=$cat->cat_name_marathi;?>"   required>
                    </div>
                  </div>
                    
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Category Icon</label>
                    <div class="col-sm-10">
                        <img src="<?=$baseurl.$cat->cat_icon;?>" style='width:100px'>
                         <input type="file" class="form-control" name="cat_icon">
                          <input type="hidden" class="form-control" name="old_cat_icon" value="<?=$cat->cat_icon;?>">
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