<?php
$allposts='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

$sql = 'SELECT * FROM listings where id=:id';
$statement = $con->prepare($sql);
$statement->execute(['id'=>$_GET['id']]);
$listings = $statement->fetchAll(PDO::FETCH_OBJ);
if(count($listings)>0){
    $p=$listings[0];
}

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Listing</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Listing</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){
extract($_POST);

//  $imageFiles = $_FILES['pictures'];
        
//                             // Loop through each uploaded file
//                             for ($i = 0; $i < count($imageFiles['name']); $i++) {
//                                 $imageFileName = $imageFiles['name'][$i];
//                                 $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
//                                 $imageTmpName = $imageFiles['tmp_name'][$i];
                        
//                                 // Generate a unique name for the uploaded file
//                                 $uniqueName = uniqid() . '.' . $imageFileType;
                        
//                                 // Move the uploaded file to the target directory
//                                 $targetPath = $targetDir . $uniqueName;
//                                 if (move_uploaded_file($imageTmpName, '../'.$targetPath)) {
//                                     $pictures[]=$targetPath;
//                                 } 
//                             }
       


//       $pictures = implode(',',$pictures);
                         
                            $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($_POST['title'])));
            
   
    
        if($error == ''){

            $arr['title']=$title;
            $arr['title_kannad']=$title_kannad;
            $arr['title_marathi']=$title_marathi;
            $arr['information']=$information;
            $arr['information_kannad']=$information_kannad;
            $arr['information_marathi']=$information_marathi;
            
            $arr['id']=$_GET['id'];

            $arr['slug']=$slug;
          
            $update = "UPDATE `listings` SET `title`=:title,`title_kannad`=:title_kannad,`title_marathi`=:title_marathi,`information`=:information,`information_kannad`=:information_kannad,`information_marathi`=:information_marathi,`slug`=:slug WHERE id=:id";
            $stm = $con->prepare($update);
            if($stm->execute($arr)){
                      echo "<script>swal('Success!', 'Listing Updated successfully.', 'success').then(function() {
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
                    
                  <!--  <input type="hidden" value="<?=$p->pictures;?>" name="oldimage">-->
                  
                  
                  <!--<div class="form-group row" >-->
                 
                  <!--  <label  class="col-sm-2 col-form-label" >Image</label>-->
                  <!--  <div class="col-sm-10">-->
                  <!--    <img src="<?=$baseurl.$p->pictures;?>" width="200px">-->
                  <!--    <input type="file" class="form-control" name="pictures">-->
                  <!--  </div>-->
                  <!--</div>-->

               


                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title"  value="<?=$p->title;?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Title in Kannad</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title_kannad"  value="<?=$p->title_kannad;?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Title in Marathi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title_marathi"  value="<?=$p->title_marathi;?>" required>
                    </div>
                  </div>


                 
                  
                  

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Information</label>
                    <div class="col-sm-10">
                      <textarea class="form-control"   name="information" rows="3" required><?=$p->information;?></textarea>

                    </div>
                  </div>

                 
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Information in Kannad</label>
                    <div class="col-sm-10">
                      <textarea class="form-control"  name="information_kannad" rows="3" required><?=$p->information_kannad;?></textarea>

                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Information in Marathi</label>
                    <div class="col-sm-10">
                      <textarea class="form-control"   name="information_marathi" rows="3" required><?=$p->information_marathi;?></textarea>

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