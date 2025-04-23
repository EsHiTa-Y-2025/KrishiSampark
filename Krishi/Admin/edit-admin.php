<?php
$addadmin='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

      
$sql = 'SELECT * FROM admin where id=:id';
$statement = $con->prepare($sql);
$statement->execute(['id'=>$_GET['id']]);
$admins = $statement->fetchAll(PDO::FETCH_OBJ);
if(count($admins)>0){
    $adm=$admins[0];
    $acc=explode(',', $adm->role);
}
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Edit Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Edit Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
<?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']){
        $email = $_POST['email'];

        // print_r($_POST);
        if($error == ''){

          if(isset($_POST['role'])){
            $role=implode(',',$_POST['role']);
          }else{
            $role='All';
          }

            $name=esc($_POST['name']);
            $type=$_POST['type'];

            $password=$_POST['password'];
            if($password!=''){
              $password=password_hash($password,PASSWORD_BCRYPT);
            }else{
              $password=$_POST['oldpassword'];
            }

            $arr['username']=$name;
            $arr['role']=$role;
            $arr['password']=$password;
            $arr['email']=$email;
            $arr['id']=$_POST['id'];
            $arr['type']=$type;
            

            $addadmin = "UPDATE `admin` SET `username`=:username,`email`=:email,`password`=:password,`role`=:role,`type`=:type WHERE id=:id";
            $stm = $con->prepare($addadmin);
            if($stm->execute($arr)){
                    echo "<script>swal('Success!', 'Admin updated successfully.', 'success').then(function() {
                            window.location = 'add-admin';
                        })</script>";
            }
        }

}
    $_SESSION['token'] = get_random_string(60);
    ?>
             <form class="form-horizontal" method="POST" enctype="multipart/form-data">
               <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                <div class="card-body">
                  
                  <input type="hidden" name="id" value="<?=$adm->id;?>">
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Admin Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" value="<?=$adm->username;?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Admin Type</label>
                    <div class="col-sm-10">
                      <select type="text" class="form-control" name="type" onchange="displayDivDemo('hideValuesOnSelect', this)" required>
                        <option <?php if($adm->type=='Admin'){ echo 'selected'; } ?>>Admin</option>
                        <option <?php if($adm->type=='Sub Admin'){ echo 'selected'; } ?>>Sub Admin</option>
                      </select>
                    </div>
                  </div>

                   <div class="form-group row" id="hideValuesOnSelect" style="display: <?php if($adm->type=='Sub Admin'){ echo ''; }else { echo 'none'; } ?>;">
                    <label  class="col-sm-2 col-form-label">Role</label>
                      <div class="col-sm-10">
                        
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="Pages" name="role[]" <?php if(in_array("Pages",$acc)){ echo 'checked'; } ?> value="Pages">
                          <label for="Pages" class="custom-control-label">Pages</label>
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" <?php if(in_array("Career",$acc)){ echo 'checked'; } ?> id="Career" name="role[]" value="Career">
                          <label for="Career" class="custom-control-label">Career</label>
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" <?php if(in_array("Posts",$acc)){ echo 'checked'; } ?> id="Posts" name="role[]" value="Posts">
                          <label for="Posts" class="custom-control-label">Posts</label>
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" <?php if(in_array("Appearance",$acc)){ echo 'checked'; } ?> id="Appearance" name="role[]" value="Appearance">
                          <label for="Appearance" class="custom-control-label">Appearance</label>
                        </div>
                        
                      </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" value="<?=$adm->email;?>"  required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="hidden" name="oldpassword" value="<?=$adm->password;?>">
                      <input type="text" class="form-control" name="password" placeholder="Enter new password if want to change else leave blank" >
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

  <script>
   function displayDivDemo(id,elementValue) {
      
      document.getElementById(id).style.display = elementValue.value == 'Admin' ? 'none' : '';
   }
</script>
<?php include 'private/footer.php';?>