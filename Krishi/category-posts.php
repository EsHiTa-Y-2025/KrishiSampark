<?php
if(isset($_GET['cat_id'])){
    $category='active';

require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

    $sql = 'SELECT posts.*,category.name from posts inner join category on category.id=posts.cat_id where cat_id=:cat_id ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute(['cat_id'=>$_GET['cat_id']]);
    $posts = $statement->fetchAll(PDO::FETCH_OBJ);
    if(count($posts)<1){
        echo "<script>window.history.back();</script>";
    }
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category Posts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Posts</li>
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
                    <th>Title</th>
                    <th>Post Type</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($posts as $p):
                     
                     ?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?=$p->title;?></td>
                    <td><?php echo $p->post_type=='1'?'Image':'Video';?></td>
                    <td><?=$p->name;?></td>
                    <td><a href="status?id=<?=$p->id;?>&status=<?=$p->status;?>&post_type=news" class="badge badge-<?php if($p->status=='Active'){ echo 'success';}else{ echo 'danger';}?>"><?=$p->status;?></a></td>
                    <td><?=$p->views;?></td>
                    <td><?=$p->date;?></td>
                    <td>
                      
                       <a href="post?id=<?=$p->id;?>" class="badge badge-warning">View</a>
                      <a href="edit-post?post_id=<?=$p->post_id;?>" class="badge badge-primary">Edit</a>
                      <a href="delete?id=<?=$p->id;?>&type=Post" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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
    <!-- /.content -->

  </div>
<?php include 'private/footer.php';
}?>