<?php
$admins='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

      
$sql = 'SELECT * FROM admin  order by id desc';
$statement = $con->prepare($sql);
$statement->execute();
$admins = $statement->fetchAll(PDO::FETCH_OBJ);
$c=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Create Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Create Employee</li>
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
    

    if(!preg_match('/^[\w\-]+@[\w\-]+.[\w\-]+$/', $email)){
        $error="Please Enter A Valid Email";
        echo "<script>swal('Error!', 'Please enter a valid email address', 'error').then(function() {
                            window.history.go(-1);
                        })</script>";
    }

        $Checkquery = "select email from admin where email = :email limit 1";
        $checkstm = $con->prepare($Checkquery);
        $check = $checkstm->execute(['email'=>$email]);
        if(($check)){
            $data = $checkstm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($data) && count($data)>0){
                $error='Email already exists';
                 echo "<script>swal('Error!', 'Email already exists', 'error').then(function() {
                            window.history.go(-1);
                        })</script>";
            }
        }

      



        date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
        $date = date('d-m-Y H:i:s');
        


        $tokenstat=true;
        $token=bin2hex(random_bytes(15)); 
        while($tokenstat)
          {
            $tokenque="select admin_url from admin where admin_url=:token limit 1";
            $stmfortokenque = $con->prepare($tokenque);
            $checktoken = $stmfortokenque->execute(['token'=>$token]);
            if(($checktoken)){
                $data = $stmfortokenque->fetchAll(PDO::FETCH_OBJ);
                if(is_array($data) && count($data)>0)
                {
                    $token=bin2hex(random_bytes(15)); 
                }
                else
                {
                $tokenstat=false;
                }
            }
          }


        if($error == ''){
            $name=esc($_POST['name']);
            $type=esc($_POST['type']);
            $password=esc($_POST['password']);
            $password=password_hash($password,PASSWORD_BCRYPT);

            if(isset($_POST['role'])){
              $role=implode(',',$_POST['role']);
            }else{
              $role='All';
            }

            $arr['username']=$name;
            $arr['password']=$password;
            $arr['email']=$email;
            $arr['admin_url']=$token;
            $arr['date']=$date;
            $arr['type']=$type;
            $arr['role']=$role;
            

            $addadmin = "insert into admin (role,admin_url,username,password,email,date,type) values(:role,:admin_url,:username,:password,:email,:date,:type)";
            $stm = $con->prepare($addadmin);
            if($stm->execute($arr)){
                    echo "<script>swal('Success!', 'Admin added successfully.', 'success').then(function() {
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
                  
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Employee Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" placeholder="Enter name..." required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Employee Type</label>
                    <div class="col-sm-10">
                      <select type="text" class="form-control" name="type" onchange="displayDivDemo('hideValuesOnSelect', this)" required>
                        <option disabled>Select</option>
                        <option>Admin</option>
                        <option>Sub Admin</option>
                      </select>
                    </div>
                  </div>
                  
                   <div class="form-group row" id="hideValuesOnSelect" style="display: none;">
                    <label  class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="Pages" name="role[]" value="Pages">
                          <label for="Pages" class="custom-control-label">Pages</label>
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="Career" name="role[]" value="Career">
                          <label for="Career" class="custom-control-label">Career</label>
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="Posts" name="role[]" value="Posts">
                          <label for="Posts" class="custom-control-label">Posts</label>
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="Appearance" name="role[]" value="Appearance">
                          <label for="Appearance" class="custom-control-label">Appearance</label>
                        </div>
                        
                      </div>
                  </div>
                  
                  

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" placeholder="Enter email..." required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="password" placeholder="Enter password..." required>
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


    <!-- Main content -->
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
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Type</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Action</th>
                          
                            
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($admins as $user): ?>                              
                  <tr>
                    <td ><?=$c;?></td>
                            <td ><?=$user->username;?></td>
                            <td ><?=$user->email;?></td>
                            <td ><?=$user->type;?></td>
                            <td ><?=$user->role;?></td>
                            <td ><?=$user->date;?></td>

                             <td>

                             <div class="btn-group align-top">
                                <a class="btn btn-sm btn-danger badge" href="edit-admin?id=<?=$user->id;?>">Edit</a>
                                 </div>

                              <div class="btn-group align-top">
                                <a class="btn btn-sm btn-primary badge" href="delete?id=<?=$user->id;?>&type=Admin">Delete</a>
                                 </div>
                             </td> 
                  </tr>
                  <?php $c++; endforeach; ?>
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
  <script>
   function displayDivDemo(id,elementValue) {
      
      document.getElementById(id).style.display = elementValue.value == 'Admin' ? 'none' : '';
   }
</script>
<?php include 'private/footer.php';?>