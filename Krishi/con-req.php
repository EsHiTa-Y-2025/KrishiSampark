<?php
$consultation='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

    $sql = 'SELECT consultation_requests.*,users.name,users.phone from consultation_requests inner join users on users.userId = consultation_requests.user_id where consultation_id=:consultation_id order by consultation_requests.id desc';
    $stm = $con->prepare($sql);
    $stm->execute(['consultation_id'=>"NA"]);
    $consultations = $stm->fetchAll(PDO::FETCH_OBJ);
    
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consultation Requests </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Consultation Requests</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    
    
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
                    <th>Date</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Message</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($consultations as $consultation):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?=$consultation->date;?></td>
                    <td><?=$consultation->name;?></td>
                    <td><?=$consultation->phone;?></td>
                     <td><?=$consultation->message;?></td>
                    
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