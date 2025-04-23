<?php 
require('private/header.php');
$ad = getProductById($con,$_GET['id']);

if(!is_object($ad) && $ad==2){
    echo "<script>window.history.back();</script>";
    exit;
}

$pictures = explode(',',$ad->image);

?>

  <body>
    <div class="bg-white shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="gap-3 d-flex align-items-center">
          <a onclick='window.history.back()'
            ><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i
          ></a>
          <h3 class="fw-bold m-0">View <?=$ad->title;?></h3>
        </div>
        
        <!--<div class="ms-auto gap-3 d-flex align-items-center">-->
        <!--  <button-->
        <!--    type="button"-->
        <!--    class="btn krishisampark-btn border btn-sm rounded-md"-->
            
        <!--  >-->
        <!--    <span>₹</span>&nbsp;<?=$ad->price;?>-->
        <!--  </button>-->
         
        <!--</div>-->
      </div>
    </div>
    <div class="shadow-sm">
   <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
 

  <div class="carousel-inner">
  <?php foreach ($pictures as $index => $picture) { ?>
    <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
      <img src="<?=$baseurl.$picture;?>" class="d-block w-100 rounded" style="height:350px" alt="Image <?=$index+1;?>">
    </div>
  <?php } ?>
</div>

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </a>
</div>
</div>

    <div class="px-3 pt-3">
      <div class="row align-items-start justify-content-between">
        <div class="col-12">
          <h1 class="fw-bold mb-1"><?=$ad->title;?></h1>
             <h5>₹<?=$ad->price;?></h5>
       
        </div>
          <hr>
           
      </div>
    </div>

    

    <div class="px-3 py-2">
      <div class="row">
        <div class="col-12">
        
           <div>
                  <h3>Description</h3>
               <?=$ad->description;?>
              </div>
           </div>

          
        </div>
      </div>
    </div>
    
     
    <div class="p-5"></div>
 <?php require('private/footer.php');?>