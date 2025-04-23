<?php
$listings='active';
$cities ='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

 $sql = 'SELECT listings.*,states.state_name,cities.city_name,users.is_verified,users.is_plus,users.is_trusted FROM listings 
            inner join states on states.id = listings.state 
            inner join cities on cities.id=listings.city 
            inner join users on users.userId=listings.posted_by
            where is_deleted=:is_deleted AND listings.city=:city ORDER BY listings.id DESC';
    $stm = $con->prepare($sql);
    $stm->execute(['is_deleted'=>0,'city'=>$_GET['city']]);
    $listings = $stm->fetchAll(PDO::FETCH_OBJ);
    
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 
    <section class="content pt-3">
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
                    <th>Title</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $sno=1; 
                    foreach($listings as $p):
                    $pictures = explode(',',$p->pictures);
                     $picture=$pictures[0];
                    ?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td>
                      <img src="<?=$baseurl.$picture;?>" width="100px">
                    </td>
                    <td><?=$p->title;?> <?php if($p->is_verified){ ?>
                                    <img src="<?=$baseurl;?>img/verified.png" style="width:17px;margin-bottom:5px"></a>
                                    <?php } ?></td>
                    <td><?=$p->name;?></td>
                    <td><?=$p->city_name;?></td>
                    <td><?=$p->phone;?></td>
                    <td><?=$p->created_at;?></td>
                    <td><a href="updatelisting?id=<?=$p->id;?>&status=<?=$p->status;?>" class="badge badge-<?php if($p->status==1){ echo 'success';}else{ echo 'danger';}?>"><?php if($p->status==1){ echo 'Active';}else{ echo 'Inactive';}?></a></td>
                    
                    <td>
                                                 <a href="view-listing?id=<?=$p->id;?>" class="badge badge-primary">View</a>

                        <a href="featured_status?id=<?=$p->id;?>&is_featured=<?=$p->is_featured;?>" class="badge badge-<?php if($p->is_featured==1){ echo "warning";}else{ echo "secondary" ;}?>"><?php if($p->is_featured==1){ echo "Featured";}else{ echo "Not Featured" ;}?></a>
                       
                        <a href="<?=$baseurl;?>admin/leads?id=<?=$p->id;?>" class="badge badge-success">View Leads</a>
                        <a href="edit-listing?id=<?=$p->id;?>" class="badge badge-warning">Edit</a>
                        <a href="delete?id=<?=$p->id;?>&type=Listing" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>
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