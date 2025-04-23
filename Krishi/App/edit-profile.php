<?php require('private/header.php');?>

<body>

  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'edit_profile');?> </h3>
      </div>
     
    </div>
  </div>

  <div class="p-3 text-center bg-light">
    <div> <img src="<?php if(empty($userData->profile_pic)) echo "img/profile.png"; else echo $userData->profile_pic;?>" alt class="img-fluid cw-70 ch-70 rounded-pill mb-3">
    <h4 class='mt-2'><?=$userData->name;?>
                    <?php if($userData->is_verified){ ?>
                                    <img src="<?=$baseurl;?>img/verified.png" style="width:17px;margin-bottom:5px"></a>
                                    <?php } ?>
                    </h4>
                    <?php if($userData->plan!=NULL){ ?>
                    <h6>Plan : <?=$userData->plan;?></h6>
                    <?php } ?>
    </div>
   
  </div>
         <div class="px-3">
      <?php
      
      // Display success message
if (isset($_SESSION['successMsg'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['successMsg'] . '</div>';
    unset($_SESSION['successMsg']);
}

// Display error message
if (isset($_SESSION['errorMsg'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMsg'] . '</div>';
    unset($_SESSION['errorMsg']);
}
?>
    </div>

  <?php 
                        $error='';
                        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']){
                          extract($_POST);
                          
$image_all = array('png', 'jpg','webp','jpeg');

  $filename = $_FILES['profile']['name'];
  if($filename!=''){
      
    $file_size = $_FILES["profile"]["size"];
    $filesize=$file_size/1024;
    if($filesize<500){

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
        if (in_array($ext, $image_all)) {
            
            $filedate= date('Ymd')."krishisampark".date('His');
            $insertfile = "img/profiles/".$filedate.".".$ext ;
            move_uploaded_file($_FILES["profile"]["tmp_name"], $insertfile);
            $insertfile = $baseurl.'app/'.$insertfile;
            
        }else{
            $error = 'ImageError';
             $_SESSION['errorMsg']  = 'File must be image.';
                                         echo "<script>window.location='edit-profile';</script>";
        }

        
    }else{
        $error = 'ImageError';
        $_SESSION['errorMsg']  = 'File must be less than 500KB.';
                                         echo "<script>window.location='edit-profile';</script>";
    }
 }else{
     $insertfile = $old_profile;
 }


                           
                                if($error == ''){
                        
                                    
                                    $arr['name']=esc($name);
                                    
                                    $arr['userId']=$userData->userId;
                                    $arr['profile_pic']=$insertfile;
                                    $arr['language']=$language;
                                    
                                    
                                    $addpackages = "update users set name=:name,profile_pic=:profile_pic,language=:language where userId=:userId";
                                    $stm = $con->prepare($addpackages);
                                    if($stm->execute($arr)){
                                          $_SESSION['successMsg']  = getLanguageString($con,$language,'account_updated');
                                          echo "<script>window.location='edit-profile';</script>";
                                    }
                                }else{
                                         $_SESSION['errorMsg']  = 'Something went wrong.';
                                         echo "<script>window.location='edit-profile';</script>";
                                }
                        }
                        $_SESSION['token'] = get_random_string(60);
                        ?>
                   
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
  <div class="p-3">
    <div>
      
       <div class="mb-3">
          <label class="form-label text-muted"><?=getLanguageString($con,$lang,'choose_profle_picture');?></label>
          <div class="input-group">
            <input type="hidden" name="old_profile" value="<?=$userData->profile_pic;?>">
            <input type="file" name="profile" accept="image/*" class="shadow-none form-control">
            <!--<span class="input-group-text bg-white"><a href="#" class="text-decoration-none text-danger"> Change</a></span>-->
          </div>
        </div>


        <div class="mb-3">
          <label class="form-label text-muted"><?=getLanguageString($con,$lang,'name');?>*</label>
          <input type="text" name="name" class="shadow-none form-control" value="<?=$userData->name;?>">
        </div>

        <div class="mb-3">
          <label class="form-label text-muted"><?=getLanguageString($con,$lang,'phone_number');?></label>
          <div class="input-group">

            <input type="text" class="shadow-none form-control"  value="<?=$userData->phone;?>" readonly>
            <!--<span class="input-group-text bg-white"><a href="#" class="text-decoration-none text-danger"> Change</a></span>-->
          </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label text-muted"><?=getLanguageString($con,$lang,'preferred_language');?></label>
            <select
              class="shadow-none form-control rounded-3"
              name="language">
                <option value="" disabled selected>Choose Langauge</option>
                 <option <?php if($lang=='en') echo 'selected'; ?> value='en'>English</option>
                <option  <?php if($lang=='kannad') echo 'selected'; ?> value='kannad'>ಕನ್ನಡ</option>
                <option  <?php if($lang=='marathi') echo 'selected'; ?> value='marathi'>मराठी</option>
            </select>
        </div>
       

      
    </div>
  </div>
  <div class="p-5"></div>

  <div class="fixed-bottom p-3">
    <div class="d-grid">
      <button type="submit" class="btn krishisampark-bg1 btn-lg text-white"><?=getLanguageString($con,$lang,'update');?></button>
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