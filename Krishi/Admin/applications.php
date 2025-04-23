<?php
$applications='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

    $sql = 'SELECT * from applications ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $applications = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Job Applications</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Job Applications</li>
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
                    <th>Mobile Number</th>
                    <th>Message</th>
                    <th>Job Title</th>
                    <th>Resume</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($applications as $p):
                     
                     ?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?=$p->name;?></td>
                    <td><?=$p->email;?></td>
                    <td><?=$p->phone;?></td>
                    <td><?=$p->message;?></td>
                    <td><?=$p->title;?></td>
                    <td><a href="<?=$baseurl.$p->resume;?>" target="_blank">View</a></td>
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