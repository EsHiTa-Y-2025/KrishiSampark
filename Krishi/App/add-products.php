<?php
require('private/header.php');
if(isset($_GET['store_id'])){
?>

<body>
  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0">Add Product</h3>
      </div>
    </div>
  </div>
  <?php
  // Display success message
  if (isset($_SESSION['successMsg'])) {
    echo '<div class="m-2"><div class="alert alert-success" role="alert">' . $_SESSION['successMsg'] . '</div></div>';
    unset($_SESSION['successMsg']);
  }

  // Display error message
  if (isset($_SESSION['errorMsg'])) {
    echo '<div class="m-2"><div class="alert alert-danger" role="alert">' . $_SESSION['errorMsg'] . '</div></div>';
    unset($_SESSION['errorMsg']);
  }
  ?>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']) {

    if (isset($_POST['title'])) {


      $targetDir = "media/";
                        $pictures = array();
    
                        $imageFiles = $_FILES['pictures'];
        
                            // Loop through each uploaded file
                            for ($i = 0; $i < count($imageFiles['name']); $i++) {
                                $imageFileName = $imageFiles['name'][$i];
                                $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
                                $imageTmpName = $imageFiles['tmp_name'][$i];
                        
                                // Generate a unique name for the uploaded file
                                $uniqueName = uniqid() . '.' . $imageFileType;
                        
                                // Move the uploaded file to the target directory
                                $targetPath = $targetDir . $uniqueName;
                                if (move_uploaded_file($imageTmpName, '../'.$targetPath)) {
                                    $pictures[]=$targetPath;
                                } 
                            }
                            
                            $pictures = implode(',',$pictures);
                         
                            $insArr['title']=$_POST['title'];
                            $insArr['image']=$pictures;
                            $insArr['price']=$_POST['price'];
                            $insArr['description']=$_POST['description'];
                            $insArr['store_id']=$_GET['store_id'];
                            
                            
                            $addProduct = "INSERT INTO `products`( `title`, `image`, `price`, `description`, `store_id`) VALUES (:title,:image,:price,:description,:store_id)";
                            
                            $stm = $con->prepare($addProduct);
                            $stm->execute($insArr);

      $id = $con->lastInsertId();

      //  $_SESSION['successMsg'] = 'Your ad submitted successfully. We will verify it before publishing.';
      echo "<script>window.location='success-product?id={$id}&store_id={$_GET['store_id']}';</script>";
    }
  }

  $_SESSION['token'] = get_random_string(60);


  ?>

  <form method="POST" enctype="multipart/form-data" class="form">

    <div class="p-3">
    



      <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
      <input type="hidden" name="posted_by" value="<?= $userData->userId; ?>">

      <div class="mb-3">
        <label class="form-label text-dark">Upload Picture*</label>
        <input type='file' class="shadow-none form-control" id="pictures" accept='image/*' name="pictures[]"  required>
      </div>

      <div class="mb-3">
        <label class="form-label text-dark">Product Title*</label>
        <input type="text" class="shadow-none form-control" name="title" value="" required>
      </div>
      
       <div class="mb-3">
        <label class="form-label text-dark">Product Price*</label>
        <input type="text" class="shadow-none form-control" name="price" value="" required>
      </div>
      
       <div class="mb-3">
        <label class="form-label text-dark">Product Description*</label>
        <textarea class="shadow-none form-control" rows='6' name="description" value="" required></textarea>
      </div>

     
     

    </div>


    <div class="p-5"></div>

    <div class="fixed-bottom p-3">
      <div class="d-grid">
        <button type="submit" id="submit-btn" class="btn krishisampark-bg1 btn-lg text-white">Submit</button>
      </div>
    </div>

  </form>



  <script src="vender/jquery/jquery.min.js" type="12f990073857c990e213daed-text/javascript"></script>
  <script src="vender/bootstrap/js/bootstrap.bundle.min.js" type="12f990073857c990e213daed-text/javascript"></script>

  <script src="vender/slick/slick/slick.min.js" type="12f990073857c990e213daed-text/javascript"></script>

  <script src="vender/sidebar/hc-offcanvas-nav.js" type="12f990073857c990e213daed-text/javascript"></script>

  <script src="js/custom.js" type="12f990073857c990e213daed-text/javascript"></script>
  <script src="https://askbootstrap.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="12f990073857c990e213daed-|49" defer></script>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816" integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw==" data-cf-beacon='{"rayId":"7dcef2b2ad770da6","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>


</body>

</html>

<?php }else{
 echo "<script>window.location='404'</script>";
}?>