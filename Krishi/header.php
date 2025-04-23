<?php
$header='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from header ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $headers = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <?php if(count($headers)<1){ ?>
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Header Settings</h1>
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
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $ext2 = pathinfo($filename2, PATHINFO_EXTENSION);
    
        if($error == ''){


            $tempfav = $_FILES['fav']['tmp_name'];
            $fav = "img/".date('Ymd')."fav".date('His').".".$ext;
            move_uploaded_file($tempfav,"../".$fav);

            $tempname = $_FILES['logo']['tmp_name'];
            $logo = "img/".date('Ymd')."logo".date('His').".".$ext2;
            move_uploaded_file($tempname,"../".$logo);

        
            $arr['fav']=$fav;
            $arr['logo']=$logo;
            $arr['title']=$title;
           
                  $addcity = "insert into header (logo,title,fav) values(:logo,:title,:fav)";
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
                      <input type="text" class="form-control" name="title"  placeholder="Enter here..." required>
                    </div>
                  </div>

                 

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label" >Logo</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="logo" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label" >Fav Icon</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="fav" required>
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
<?php }else{ ?>
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
                    <th>Logo</th>
                    <th>Title</th>
                    <th>Fav</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($headers as $h):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><a href="<?=$baseurl.$h->logo;?>" target="_blank"><img src="<?=$baseurl.$h->logo;?>" width="100px"></a></td>
                    <td><?=$h->title;?></td>
                    <td><a href="<?=$baseurl.$h->fav;?>" target="_blank"><img src="<?=$baseurl.$h->fav;?>" width="100px"></a></td>
                    
                    <td>
                        <a href="edit-header?id=<?=$h->id;?>" class="badge badge-warning">Edit</a>
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
    <?php } ?>
  </div>
<?php include 'private/footer.php';?>