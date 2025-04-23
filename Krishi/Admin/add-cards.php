<?php
$allpages='active';
if(isset($_GET['id'])){
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from cards where page_id=:page_id ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute(['page_id'=>$_GET['id']]);
    $cards = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Card</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Cards</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){
  $id=$_GET['id'];
  $filename = $_FILES['image']['name'];
  if($filename!=''){
  $file_size = $_FILES["image"]["size"];
  $filesize=$file_size/1024;
  $allowed = array('gif', 'png', 'jpg','webp','jpeg');
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  
  if (in_array($ext, $allowed)) {
      $file_type = 'is_image';
      $filedate= date('Ymd')."card".date('His');
            $insertfile = "img/".$filedate.".".$ext ;
            move_uploaded_file($_FILES["image"]["tmp_name"], '../'.$insertfile);
  }else{
    $error=3;
    echo "<script>swal('Error!', 'Failed to post.File must be an image', 'error').then(function() {
      window.location = 'add-post';
  })</script>";
  }
  }else{
    $insertfile='NA';
  }
  $url='add-cards?id='.$id;
    
    extract($_POST);
    
        if($error == ''){
            $arr['title']=$title;
            $arr['page_id']=$id;
            $arr['type']=$type;
            $arr['image']=$insertfile;
            $arr['description']=$description;
                  $addcity = "insert into cards (type,title,description,image,page_id) values(:type,:title,:description,:image,:page_id)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'add-cards?id={$id}'
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
                    <label  class="col-sm-2 col-form-label">Card Type</label>
                    <div class="col-sm-10">
                      <select type="text" class="form-control" name="type" required>
                        <option disabled>Select</option>
                        <option>Image</option>
                        <option>Icon</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Choose file</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="image" required>
                    </div>
                  </div>
                  

                  


                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control"  name="description"></textarea>
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
                    <th>Title</th>
                    <th>Description</th>
                   
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($cards as $p):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><img src="<?=$baseurl.$p->image;?>" width="40px"></td>
                    <td><?=$p->title;?></td>
                    <td><?php if($p->description!=''){ echo $p->description; }else{ echo "NA"; }?></td>
                   
                    <td>
                      
                      <!--<a href="edit-card?id=<?=$p->id;?>" class="badge badge-warning" >Edit</a>-->
                      <a href="delete?id=<?=$p->id;?>&type=Card" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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
}else{
    echo "<script> window.location = 'pages';</script>";
}
?>