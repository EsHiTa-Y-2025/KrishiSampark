<?php
$leads='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';



    $sql = 'SELECT leads.*,listings.title,listings.subcategory,categories.cat_name from leads inner join listings on listings.id = leads.ad_id  inner join categories on listings.subcategory = categories.id';
    if(isset($_GET['id'])){
        $adId=$_GET['id'];
        $sql.= ' where ad_id=:ad_id';
    }
    $sql.= ' ORDER BY leads.id desc';
    $statement = $con->prepare($sql);
    if(isset($_GET['id'])){
        $statement->execute(['ad_id'=>$adId]);
    }else{
        $statement->execute();
    }
    
    $leads = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Leads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leads</li>
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
                    <th>Contact Number</th>
                    <th>Service Title</th>
                    <th>Category</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($leads as $p):
                     
                     ?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?=$p->name;?></td>
                    <td><?=$p->contact;?></td>
                    <td><?=$p->title;?></td>
                    <td><?=$p->cat_name;?></td>
                    <td><?=$p->date;?></td>
                    
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