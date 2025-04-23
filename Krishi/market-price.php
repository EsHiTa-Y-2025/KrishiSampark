<?php
$market_price='active';
require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';
    $sql = 'SELECT * from market_price ORDER BY id desc;';
    $statement = $con->prepare($sql);
    $statement->execute();
    $market_prices = $statement->fetchAll(PDO::FETCH_OBJ);
    $sno=1;
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Market Prices</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$baseurl;?>admin/">Home</a></li>
              <li class="breadcrumb-item active">Market Prices</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && isset($_POST['form_data'])){

    extract($_POST);
    
    $filename = $_FILES["image"]["name"];
    if($filename!=''){
      $file_size = $_FILES["image"]["size"];
      $filesize=$file_size/1024;
      if($filesize<200){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $tempname = $_FILES['image']['tmp_name'];
        $featured_img = date('Ymd')."krishisampark".date('His').".".$ext ;
        move_uploaded_file($tempname,"../media/market_prices/".$featured_img);
      }else{
        $error=1;
        echo "<script>swal('Error!', 'File size must be less than 100kb', 'error').then(function() {
                            window.history.back();
                        })</script>";
      }
    }else{
      $featured_img='';
    }
  
   
        if($error == ''){
            
            $created_at = date('d/m/Y');
          
            $arr['image']=$featured_img;
            $arr['title']=$title;
            $arr['created_at']=$created_at;
            $arr['title_marathi']=$title_marathi;
            $arr['title_kannad']=$title_kannad;
           
                  $addcity = "INSERT INTO `market_price`( `title`, `image`, `created_at`,`title_marathi`,`title_kannad`) VALUES (:title,:image,:created_at,:title_marathi,:title_kannad)";
                  $stm = $con->prepare($addcity);
                  if($stm->execute($arr)){
                      echo "<script>
                                  window.location = 'market-price';</script>";
                  }
        }

      


}
    $_SESSION['token'] = get_random_string(60);
    ?>

     
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
          <div class="col-md-12">
             
            <div class="card card-primary">
             
             <form class="form-horizontal" method="POST"  enctype="multipart/form-data">
             <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                <div class="card-body">

                <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" > Image*</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" accept="image/*" name="image" required>
                    </div>
                  </div>
                  

                
                 <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Title in English</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title" required>
                    </div>
                  </div>
                  
                
                
                 <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Title in Kannad</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title_kannad" required>
                    </div>
                  </div>
                  
                
                
                 <div class="form-group row" >
                    <label  class="col-sm-2 col-form-label" >Title in Marathi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="title_marathi" required>
                    </div>
                  </div>
                  
                </div>
              
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="form_data">Submit</button>
                 
                </div>
                
              </form>

            </div>
             
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
                    <th> Image</th>
                    <th>Title</th>
                    <th>Title In Kannad </th>
                    <th>Title In Marathi</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($market_prices as $market_price):?>
                  <tr>
                    <td><?=$sno;?></td>
                    <td><img src="<?=$baseurl.'media/market_prices/'.$market_price->image;?>" width="140px"></td>
                    <td><?=$market_price->title;?></td>
                    <td><?=$market_price->title_kannad;?></td>
                    <td><?=$market_price->title_marathi;?></td>
                    <td>
                      
                      <!--<a href="edit-blog?id=<?=$market_price->id;?>" class="badge badge-warning" >Edit</a>-->
                      <a href="delete?id=<?=$market_price->id;?>&type=MarketPrice" class="badge badge-danger" onclick="return confirm('Do you want to delete?');">Delete</a>

                     
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