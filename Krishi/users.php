<?php
$users='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

    $sql = 'SELECT users.*,cities.city_name from users left join cities on cities.id = users.city where is_admin!=:is_admin ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute(['is_admin'=>1]);
    $users = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
                    <th>Location</th>
                    <th>Phone</th>
                    <th>Crops that i grow</th>
                    <th>Date</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th>View Listings</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($users as $user):
                     
                     ?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?=$user->name;?></td>
                    <td><?=$user->city_name;?></td>
                    <td><?=$user->phone;?></td>
                    <td><?=$user->crops;?></td>
                    <td><?=$user->created_at;?></td>
                    <td><?php if($user->plan==NULL) echo "NA"; else echo $user->plan;?></td>
                    <td><a href="status?id=<?=$user->id;?>&status=<?=$user->status;?>" class="badge badge-<?php if($user->status==1){ echo 'success';}else{ echo 'danger';}?>"><?php if($user->status==1){ echo 'Active';}else{ echo 'Inactive';}?></a></td>
                    <!--<td>-->
                    <!--  <?php if($user->is_subscribed==0){ ?>-->
                    <!--    <a href="subscribe?user=<?=$user->userId;?>" class="badge badge-warning">Subscribe now</a>-->
                    <!--    <?php }else{ ?>-->
                    <!--    <a href="unsubscribe?user=<?=$user->userId;?>" class="badge badge-danger">Unsubscribe now</a>-->
                    <!--    <?php } ?>-->
                    <!--</td>-->
                    <td> <a href="user-listings?user=<?=$user->userId;?>" class="badge badge-warning">View Listings</a> </td>
                    
                    
                    
                    
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
    <!-- /.content -->

  </div>
<?php include 'private/footer.php';?>