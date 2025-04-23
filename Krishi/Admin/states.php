<?php
$states='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

$states = getStates($con);
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>States</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">States</li>
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
                   <th>State name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $sno=1; foreach($states as $state):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?=$state->state_name;?></td>
                    
                    <td>
                      <a href="edit-state?id=<?=$state->id;?>" class="btn btn-warning">Edit</a>
                      <!--<a href="delete?id=<?=$state->id;?>&type=Location" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>-->

                     
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