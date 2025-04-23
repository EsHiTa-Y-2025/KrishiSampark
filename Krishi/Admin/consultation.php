<?php
$consultation='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from consultation ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $consultations = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>Consultation </h1>
          </div>
          <div class="col-sm-3">
            <a class="btn btn-success" href="con-req">View App Requests</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){

    extract($_POST);
    
      $filename = $_FILES['photo']['name'];
  if($filename!=''){
  $file_size = $_FILES["photo"]["size"];
  $filesize=$file_size/1024;
  $allowed = array('gif', 'png', 'jpg','webp','jpeg');
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  
  if (in_array($ext, $allowed)) {
      
      $filedate= date('Ymd')."card".date('His');
            $insertfile = "media/consultation/".$filedate.".".$ext ;
            move_uploaded_file($_FILES["photo"]["tmp_name"], '../'.$insertfile);
  }else{
    $error=3;
    echo "<script>swal('Error!', 'Failed to post.File must be an image', 'error').then(function() {
      window.location = 'category';
  })</script>";
  }
  }else{
    $insertfile='NA';
  }
   
    
   
        if($error == ''){
            
            $arr['start_time']=$start_time;
            $arr['duration']=$duration;
            $arr['conducted_by']=$conducted_by;
            $arr['photo']=$insertfile;
            $arr['title']=$title;
            $arr['link']=$link;
            $arr['mode']=$mode;
            $arr['date']=$date;
           
                  $addcity = "INSERT INTO `consultation`(`photo`,`start_time`, `duration`, `conducted_by`,`date`,`title`,`link`,`mode`) VALUES (:photo,:start_time,:duration,:conducted_by,:date,:title,:link,:mode)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'consultation';</script>";
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
                    <label  class="col-sm-2 col-form-label" > Consultation Mode*</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="mode" required>
                          <option selected disabled>Choose</option>
                          <option>Online</option>
                          <option>Offline</option>
                      </select>
                    </div>
                  </div>
                  
                <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" > Date</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="date" required>
                    </div>
                  </div>
                 
                 <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title" placeholder='' required>
                    </div>
                  </div>
                  
                
                 <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Start Time</label>
                    <div class="col-sm-10">
                      <input type="time" class="form-control" name="start_time" placeholder='' required>
                    </div>
                  </div>
                  
                  <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Duration</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="duration" placeholder='eg. 1 hour'>
                    </div>
                  </div>
                  
                   <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Photo</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="photo" accept="image/*" required>
                    </div>
                  </div>
                  
                  <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Conducted By</label>
                    <div class="col-sm-10">
                      <textarea type="text" class="form-control" id="summernote" name="conducted_by" placeholder=''></textarea>
                    </div>
                  </div>
                  
                 
                  <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Online consultation link (Zoom , Google Meet, Microsoft Teams)</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="link" placeholder='' >
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
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>Photo</th>
                    <th>Conducted By</th>
                    <th>Duration</th>
                    <th>Mode</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($consultations as $consultation):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?=$consultation->date;?></td>
                    <td><?=$consultation->start_time;?></td>
                    <td><img src="<?php echo $baseurl.$consultation->photo;?>" style="width:100px"></td>
                    <td><?=$consultation->conducted_by;?></td>
                    <td><?=$consultation->duration;?></td>
                    <td><?=$consultation->mode;?></td>
                    <td>
                        <a href="view-requests?id=<?=$consultation->id;?>" class="badge badge-warning">View Requests</a>
                      <a href="delete?id=<?=$consultation->id;?>&type=Consultation" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>
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