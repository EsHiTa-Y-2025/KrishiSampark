<?php
$properties='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

$properties = showAllAds($con,'Property');
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
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $sno=1; foreach($properties as $p):
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
                    <td><?=$p->address;?></td>
                    <td>
                        <a href="featured_status?id=<?=$p->id;?>&is_featured=<?=$p->is_featured;?>" class="badge badge-<?php if($p->is_featured==1){ echo "warning";}else{ echo "secondary" ;}?>"><?php if($p->is_featured==1){ echo "Featured";}else{ echo "Not Featured" ;}?></a>
                        
                        <!--<a href="listing_status?id=<?=$p->id;?>&is_verified=<?=$p->is_verified;?>" class="badge badge-primary"><?php if($p->is_verified==1){ echo "Verified";}else{ echo "Verify" ;}?></a>-->
                        <a href="<?=$baseurl.'property/'.$p->slug;?>" target="_blank" class="badge badge-success">View</a>
                        <a href="" class="badge badge-warning">Edit</a>
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