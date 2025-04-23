<?php
$logos='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from technology ORDER BY id desc';
    $statement = $con->prepare($sql);
    $statement->execute();
    $logos = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Logo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Logo</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){

    
        if($error == ''){

            $total = count($_FILES['images']['name']);

            $more_images="";
  
            // Loop through each file
            for($i=0; $i<$total; $i++) {
  
              $file_name = $_FILES["images"]["name"][$i];
              //Get the temp file path
              $tmpFilePath = $_FILES['images']['tmp_name'][$i];
              $ex = pathinfo($file_name, PATHINFO_EXTENSION);
              
  
              //Make sure we have a filepath
              if ($tmpFilePath != ""){
                //Setup our new file path
                $filepath = "img/".date('Ymd').$i.date('His').".".$ex;
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, "../".$filepath)) {
                  $more_images.=$filepath.",";
                }
              }
            }
            
            $arr['image']=$more_images;
           
                  $addlogos = "insert into technology (image) values(:image)";
                  $stm = $con->prepare($addlogos);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'logos';</script>";
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
                    <label  class="col-sm-2 col-form-label" >Logos</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="images[]" multiple required>
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
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($logos as $p):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td>
                        <?php 
                            $images = explode(',',$p->image);
                            for($i=0;$i<count($images)-1;$i++){
                        ?>
                        <img src="<?=$baseurl.$images[$i];?>" width="100px">
                        <?php } ?>
                    </td>
                    <td>
                      
                      <a href="delete?id=<?=$p->id;?>&type=Logos" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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