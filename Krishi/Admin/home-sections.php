<?php
$homes='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from home_sections ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $sections = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Sections</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){
 
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
    $insertfile='NA';
  }
  
    extract($_POST);
    
        if($error == ''){
            $arr['title']=$title;
            $arr['image']=$insertfile;
            $arr['content']=$content;
            $arr['position']=$position;
            
                  $addcity = "insert into home_sections (title,content,image,position) values(:title,:content,:image,:position)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'home-sections'
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

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Image Position</label>
                    <div class="col-sm-10">
                      <select type="text" class="form-control" name="position" required>
                        <option disabled>Select</option>
                        <option>Left</option>
                        <option>Right</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Choose image</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                  </div>
                  

                  


                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Content</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="summernote" name="content"></textarea>
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
                    <th>Title</th>
                    <th>Content</th>
                    <th>Position</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($sections as $p):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?php if($p->image!='NA'){ ?><img src="<?=$baseurl.$p->image;?>" width="140px"><?php }else { echo 'NA'; }?></td>
                    <td><?=$p->title;?></td>
                    <td><?php if($p->content!=''){ echo $p->content; }else{ echo "NA"; }?></td>
                    <td><?=$p->position;?></td>
                    <td>
                      
                      <a href="edit-section?id=<?=$p->id;?>" class="badge badge-warning" >Edit</a>
                      <a href="delete?id=<?=$p->id;?>&type=Section" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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