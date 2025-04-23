 <?php
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
if(isset($_GET['id'])){
$activeposts='active';

$sql = 'SELECT * FROM posts where id=:id';
$statement = $con->prepare($sql);
$statement->execute(['id'=>$_GET['id']]);
$packages = $statement->fetchAll(PDO::FETCH_OBJ);
if(count($packages)>0){
    $p=$packages[0];
}
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$p->title;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$p->title;?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?=$p->title;?></h3>
              <div class="col-12">
                <?php if($p->image!='NA'){ ?>
                
                <img src="<?=$baseurl.$p->image;?>" class="product-image" alt="Package Image">
               <?php }else{ ?>
                <iframe width="490" height="280" src="<?=$p->video_url;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <?php } ?>
              </div>

            </div>
            <div class="col-12 col-sm-6">
             
              <p><?=$p->description;?></p>
              <?php 
										$sqlforcomment = 'SELECT * from comments where post_id=:post_id ORDER BY id desc;';
										$stmcomment = $con->prepare($sqlforcomment);
										$stmcomment->execute(['post_id'=>$p->post_id]);
										$comments = $stmcomment->fetchAll(PDO::FETCH_OBJ);
										if(count($comments)>0){ ?>
              <div class="row">
                <div class="col-12 col-xl-12">
                  <p><strong>Comments :</strong></p>
                 <?php
                      foreach($comments as $cmt):
                        ?>
							
                  <p><strong><?=$cmt->name;?> :</strong> <?=$cmt->comment;?>  <a href="delete?id=<?=$cmt->id;?>&type=Comment" onclick="return confirm('Do you want to delete?');" class="badge badge-danger">Remove </a></p>
                  
                  <?php endforeach; ?>
                </div>
                
               </div>
               <?php } ?>
              <a href="javascript:void()" class="btn-sm btn-primary" onclick="window.history.back();">Go back</a>
              <hr>
            </div>
          </div>
         
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  </div>
  <!-- /.content-wrapper -->
<?php   } include 'private/footer.php';  ?>