<?php
$menus='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from header_menus';
    $statement = $con->prepare($sql);
    $statement->execute();
    $menus = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;

    $sqlForpages = 'SELECT * from pages ORDER BY page_title';
    $smp = $con->prepare($sqlForpages);
    $smp->execute();
    $pages = $smp->fetchAll(PDO::FETCH_OBJ);

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Header Menus</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){

    extract($_POST);
   
   
        if($error == ''){
          if($slug==''){
            $slug = $baseurl.'page/'.preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($page)));
          }
          if($page_title==''){
            $arr['page']=$page;
          }else{
            $arr['page']=$page_title;
          }
            $arr['slug']=$slug;
            $arr['type']=$type;
           
                  $addcity = "insert into header_menus (page,slug,type) values(:page,:slug,:type)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'header-menus';</script>";
                  }
        }

    


}
    $_SESSION['token'] = get_random_string(60);
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
             
             <form class="form-horizontal" method="POST"  enctype="multipart/form-data">
             <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                <div class="card-body">

                 <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">View Type</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="type" required>
                          <option>None</option>
                          <option>Dropdown</option>
                      </select>
                    </div>
                  </div>
                  
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Menu Type</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="menu_type" onchange="displayDivDemo(this.value)">
                          <option>Pages</option>
                          <option>Custom Links</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" id="title" style="display: none;">
                    <label class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="page_title">
                    </div>
                  </div>

                  <div class="form-group row" id="slug" style="display: none;">
                    <label class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="slug">
                    </div>
                  </div>

                  <div class="form-group row" id="pages" style="display: ;">
                    <label  class="col-sm-2 col-form-label">Page</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="page">
                    
                        <?php foreach($pages as $p): ?>
                          <option><?=$p->page_name;?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>

                 
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="form_data">Submit</button>
                 
                </div>
                <!-- /.card-footer -->
              </form>

            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
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
                    <th>Page</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($menus as $p):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><?=$p->page;?></td>
                    <td>
                      <?php if($p->type=='Dropdown'){ ?>
                        <a href="drop-menus?id=<?=$p->id;?>" class="badge badge-info">Add Menus</a>
                      <?php } ?>  
                      <a href="delete?id=<?=$p->id;?>&type=Menu" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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
  <script>
   function displayDivDemo(elementValue) {
    
      if(elementValue=='Pages'){
        document.getElementById('pages').style.display = '';
        document.getElementById('title').style.display = 'none';
        document.getElementById('slug').style.display = 'none';
      }else{

        document.getElementById('pages').style.display = 'none';
        document.getElementById('title').style.display = '';
        document.getElementById('slug').style.display = '';
      }
    }
</script>
<?php include 'private/footer.php';?>