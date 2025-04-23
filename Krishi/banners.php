<?php
$banners='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from banners ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $banners = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banners</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Banners</li>
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
      if($filesize<100){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $tempname = $_FILES['image']['tmp_name'];
        $featured_img = date('Ymd')."landsbazzar".date('His').".".$ext ;
        move_uploaded_file($tempname,"../media/banners/".$featured_img);
      }else{
        $error=1;
        echo "<script>swal('Error!', 'File size must be less than 100kb', 'error').then(function() {
                            window.history.back();
                        })</script>";
      }
    }else{
      $featured_img='';
    }
  
   
        if($error == ''){
          
            $arr['image']=$featured_img;
           
                  $addcity = "insert into banners (image) values(:image)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'banners';</script>";
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
                    <label  class="col-sm-2 col-form-label" >Banner Image*</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" accept="image/*" name="image" required>
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
                    <th>Banner Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($banners as $banner):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><img src="<?=$baseurl.'media/banners/'.$banner->image;?>" width="140px"></td>
                   
                    <td>
                      
                      <!--<a href="edit-blog?id=<?=$banner->id;?>" class="badge badge-warning" >Edit</a>-->
                      <a href="delete?id=<?=$banner->id;?>&type=Banner" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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