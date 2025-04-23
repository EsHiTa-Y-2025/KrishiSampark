<?php
$home='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

function get_count($con,$table){
  $query="SELECT * FROM {$table}";
  $stm= $con->prepare($query);
  $stm->execute();
  $results = $stm->fetchAll(PDO::FETCH_OBJ);
  return count($results);
}

function get_count_lisitngs($con,$type){
    
  if($type=='Animal'){
     $query="SELECT * FROM listings where category = :cat_id";
  }else{
     $query="SELECT * FROM listings where category != :cat_id";
  }
  
  $stm= $con->prepare($query);
  $stm->execute(['cat_id'=>3]);
  $results = $stm->fetchAll(PDO::FETCH_OBJ);
  return count($results);
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
        

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h5><?=get_count($con,'users');?></h5>

                <p>All Users</p>
              </div>
              <div class="icon">
                <i class="fa fa-users text-white"></i>
              </div>
              
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h5><?=get_count_lisitngs($con,'Animal');?></h5>

                <p>Animals Listings</p>
              </div>
              <div class="icon">
                <i class="fa fa-list text-white"></i>
              </div>
              
            </div>
          </div>
          
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h5><?=get_count_lisitngs($con,'Service');?></h5>

                <p>Services Listings</p>
              </div>
              <div class="icon">
                <i class="fa fa-list text-white"></i>
              </div>
              
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h5><?=get_count($con,'blogs');?></h5>

                <p>Blogs</p>
              </div>
              <div class="icon">
                <i class="fa fa-image text-white"></i>
              </div>
              
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h5><?=get_count($con,'leads');?></h5>

                <p>Leads</p>
              </div>
              <div class="icon">
                <i class="fa fa-comments text-white"></i>
              </div>
              
            </div>
          </div>



       

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    


  </div>
<?php include 'private/footer.php';?>