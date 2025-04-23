<?php
$blogs='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

$category = get_category($con);
    $sql = 'SELECT * from blogs where id=:id';
    $statement = $con->prepare($sql);
    $statement->execute(['id'=>$_GET['id']]);
    $blogs = $statement->fetchAll(PDO::FETCH_OBJ);
    if(count($blogs)>0){
        $p=$blogs[0];
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
            <h1>Edit <?=$p->title;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active"> <?=$p->title;?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){

    extract($_POST);
    $filename = $_FILES["image"]["name"];
    if($filename!=''){
      $file_size = $_FILES["image"]["size"];
      $filesize=$file_size/1024;
      if($filesize<500){
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $tempname = $_FILES['image']['tmp_name'];
            $featured_img = date('Ymd')."page".date('His').".".$ext ;
            move_uploaded_file($tempname,"../media/blogs/".$featured_img);
          }else{
            $error='3';
            echo "<script>swal('Error!', 'File size must be less than 500kb', 'error').then(function() {
                                window.history.back();
                            })</script>";
          }
      }else{
        $featured_img=$oldimg;
      }
      
      if(strlen($description)>14000){
          $error='Size is too large';
         
          echo "<script>swal('Error!', 'Description size is too large.', 'error').then(function() {
           window.history.back();
        })</script>";
        }
    
   
        if($error == ''){

            $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($title)));

        
            $arr['description']=$description;
            $arr['title']=$title;
            $arr['image']=$featured_img;
            $arr['slug']=$slug;
            $arr['category']=$category;
            $arr['description_marathi']=$description_marathi;
            $arr['description_kannad']=$description_kannad;
            $arr['title_kannad']=$title_kannad;
            $arr['title_marathi']=$title_marathi;
            $arr['id']=$_GET['id'];
            
                  $addcity = "UPDATE `blogs` SET `title`=:title,`description`=:description,`image`=:image,`slug`=:slug,`category`=:category,`description_marathi`=:description_marathi,`description_kannad`=:description_kannad,`title_kannad`=:title_kannad,`title_marathi`=:title_marathi WHERE id=:id";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'blogs';</script>";
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

                <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Featured Image</label>
                    <div class="col-sm-10">
                      <?php if ($p->image!='') { ?>
                        <img src="<?=$baseurl.'media/blogs/'.$p->image;?>" width="150px" class="py-2">
                        <input type="hidden" name="oldimg" value="<?=$p->image;?>" >
                        <?php } ?>
                   
                      <input type="file" class="form-control" name="image" >
                    </div>
                  </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="category">
                          <option value="0">NA</option>
                          <?php foreach($category as $cat){ ?>
                          <option <?php if($p->category == $cat->id ) echo "selected"; ?> value="<?=$cat->id;?>"><?=$cat->cat_name;?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Title in English</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title" value="<?=$p->title;?>"   required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Title in Kannad</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title_kannad"  value="<?=$p->title_kannad;?>"   required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Title in Marathi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title_marathi" value="<?=$p->title_marathi;?>"   required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Description in English</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="description" id="" ><?=$p->description;?></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Description in Kannad</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="description_kannad" id=""><?=$p->description_kannad;?></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Description in Marathi</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="description_marathi" id=""><?=$p->description_marathi;?></textarea>
                    </div>
                  </div>

              

                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="form_data">Update</button>
                 
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