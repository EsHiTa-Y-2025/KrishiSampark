<?php
$addblog='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

    $category = get_category($con);

    $sql = 'SELECT * from blogs ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $blogs = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Blog</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Add New Blog</li>
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
      if($filesize<120){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $tempname = $_FILES['image']['tmp_name'];
        $featured_img = date('Ymd')."landsbazzar".date('His').".".$ext ;
        move_uploaded_file($tempname,"../media/blogs/".$featured_img);
      }else{
        $error=1;
        echo "<script>swal('Error!', 'File size must be less than 120kb', 'error').then(function() {
                            window.history.back();
                        })</script>";
      }
    }else{
      $featured_img='';
    }

    $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($title)));

    $Checkquery = "select * from blogs where slug = :slug limit 1";
    $checkstm = $con->prepare($Checkquery);
    $check = $checkstm->execute(['slug'=>$slug]);
    if(($check)){
        $data = $checkstm->fetchAll(PDO::FETCH_OBJ);
        if(is_array($data) && count($data)>0){
            $slug = $slug.'-'.date('His');
        }
    }
    
    if(strlen($description)>14000){
          $error='Size is too large';
         
          echo "<script>swal('Error!', 'Description size is too large.', 'error').then(function() {
           window.history.back();
        })</script>";
        }

    
   
        if($error == ''){
            $arr['description']=$description;
            $arr['title']=$title;
            $arr['image']=$featured_img;
            $arr['category']=$category;
            $arr['description_marathi']=$description_marathi;
            $arr['description_kannad']=$description_kannad;
            $arr['title_kannad']=$title_kannad;
            $arr['title_marathi']=$title_marathi;
            $arr['slug']=$slug;
            $arr['date']=date("d-m-Y");
           
                  $addcity = "insert into blogs (title,description,image,slug,date,category,title_marathi,title_kannad,description_kannad,description_marathi) values(:title,:description,:image,:slug,:date,:category,:title_marathi,:title_kannad,:description_kannad,:description_marathi)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'blogs';</script>";
                  }
        }

      


}
    $_SESSION['token'] = get_random_string(60);
    ?>

     
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
          <div class="col-md-12">
             
            <div class="card card-primary">
             
             <form class="form-horizontal" method="POST"  enctype="multipart/form-data">
             <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                <div class="card-body">

                <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Featured Image*</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" accept="image/*" name="image" required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="category">
                          <option  value="0">NA</option>
                          <?php foreach($category as $cat){ ?>
                          <option value="<?=$cat->id;?>"><?=$cat->cat_name;?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Title in English</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title"  placeholder="Type here..." required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Title in Kannad</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title_kannad"  placeholder="Type here..." required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Title in Marathi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title_marathi"  placeholder="Type here..." required>
                    </div>
                  </div>


                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Description in English</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="description" id="summernote"></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Description in Kannad</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="description_kannad" id="summernote2"></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Description in Marathi</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="description_marathi" id="summernote3"></textarea>
                    </div>
                  </div>

                 
                  
                </div>
              
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="form_data">Submit</button>
                 
                </div>
                
              </form>

            </div>
             
          </div>
        </div>
      </div>
    </section>

  </div>
<?php include 'private/footer.php';?>