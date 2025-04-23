<?php
$blogs='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from blogs ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $blogs = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blogs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Blogs</li>
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
                    <th>Featured Image</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($blogs as $blog):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><img src="<?=$baseurl.'media/blogs/'.$blog->image;?>" width="140px"></td>
                    <td><?=$blog->title;?></td>
                    
                    <td><?=$blog->date;?></td>
                    <td>
                      
                      <a href="edit-blog?id=<?=$blog->id;?>" class="badge badge-warning" >Edit</a>
                      <a href="delete?id=<?=$blog->id;?>&type=Blogs" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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