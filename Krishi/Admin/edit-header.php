<?php
$header='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from header where id=:id';
    $statement = $con->prepare($sql);
    $statement->execute(['id'=>$_GET['id']]);
    $headers = $statement->fetchAll(PDO::FETCH_OBJ);
    if(count($headers)>0){
        $hd=$headers;
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
            <h1>Edit Header Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Header Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){

    extract($_POST);
    $filename = $_FILES["logo"]["name"];
    $filename2 = $_FILES["fav"]["name"];
    if($filename!=''){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $tempname = $_FILES['logo']['tmp_name'];
            $logo = "img/".date('Ymd')."logo".date('His').".".$ext2;
            move_uploaded_file($tempname,"../".$logo);
    }else{
        $logo=$oldlogo;
    }
    
    if($filename2!=''){
        $ext2 = pathinfo($filename2, PATHINFO_EXTENSION);
        $tempfav = $_FILES['fav']['tmp_name'];
            $fav = "img/".date('Ymd')."fav".date('His').".".$ext;
            move_uploaded_file($tempfav,"../".$fav);
    }else{
        $fav=$oldfav;
        
    }
    
    
    
        if($error == ''){

        
            $arr['fav']=$fav;
            $arr['logo']=$logo;
            $arr['title']=$title;
           
                  $addcity = "update header set fav=:fav,logo=:logo,title=:title where id=1";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'header';</script>";
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
                    <label  class="col-sm-2 col-form-label">Website Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title" value="<?=$hd->title;?>"  required>
                    </div>
                  </div>

                  <input type="hidden" value="<?=$hd->logo;?>" name="oldlogo">
                  <input type="hidden" value="<?=$hd->fav;?>" name="oldfav">
                 

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label" >Logo</label>
                    <div class="col-sm-10">
                    <img src="<?=$baseurl.$hd->logo;?>" width="200px">
                      <input type="file" class="form-control" name="logo" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label" >Fav Icon</label>
                    <div class="col-sm-10">
                    <img src="<?=$baseurl.$hd->fav;?>" width="200px">
                      <input type="file" class="form-control" name="fav" required>
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