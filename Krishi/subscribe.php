<?php
$users='active';
if(isset($_GET['user'])){
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from users where userId=:userId';
    $statement = $con->prepare($sql);
    $statement->execute(['userId'=>$_GET['user']]);
    $user = $statement->fetchAll(PDO::FETCH_OBJ);
    $user = $user[0];
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subscribe </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Subscribe</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){
 
    $created_at=date('d-m-Y H:i:s');

    extract($_POST);
    
        if($error == ''){
            $arr['plan']=$plan;
            $arr['is_subscribed']=1;
            $arr['userId']=$user->userId;
            
            $addSubsription = "INSERT INTO `subscriptions`(`userId`, `plan`, `date`,`status`) VALUES (:userId,:plan,:date,:status)";
            $Subsstm = $con->prepare($addSubsription);
            if($Subsstm->execute(['userId'=>$user->userId,'plan'=>$plan,'date'=>$created_at,'status'=>'Success'])){
                
                        if($plan=='Silver'){
                                $is_plus=1;
                                $is_verified=0;
                                $is_trusted=0;
                            }elseif($plan=='Gold'){
                                $is_plus=1;
                                $is_verified=1;
                                $is_trusted=0;
                            }else{
                                $is_plus=1;
                                $is_verified=1;
                                $is_trusted=1;
                            }
                        
                 $arr['is_trusted']=$is_trusted;
                 $arr['is_verified']=$is_verified;
                 $arr['is_plus']=$is_plus;
                        
                 $subscribe = "update users set is_subscribed=:is_subscribed , plan=:plan,is_verified=:is_verified,is_plus=:is_plus,is_trusted=:is_trusted where userId=:userId";
                  $stm = $con->prepare($subscribe);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'users'
                                  </script>";
                  }
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
                    <label  class="col-sm-2 col-form-label">Plan</label>
                    <div class="col-sm-10">
                      <select type="text" class="form-control" name="plan" required>
                        <option disabled>Choose Plan</option>
                        <option>Silver</option>
                        <option>Gold</option>
                        <option>Diamond</option>
                      </select>
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
<?php include 'private/footer.php';
}else{
    echo "<script> window.location = 'pages';</script>";
}
?>