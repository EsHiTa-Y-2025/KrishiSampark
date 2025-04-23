<?php
$contact='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

    $sql = 'SELECT * from contact_leads ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $contacts = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact Enquiries</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contact Enquiries</li>
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
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Message</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($contacts as $p):
                     
                     ?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?=$p->name;?></td>
                    <td><?=$p->email;?></td>
                    <td><?=$p->phone;?></td>
                    <td><?=$p->message;?></td>
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