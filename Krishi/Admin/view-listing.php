<?php
$listings='active';

require 'private/autoload.php';
require 'private/header.php';
require 'private/sidebar.php';

$ad = getListingById($con,$_GET['id']);

if(!is_object($ad) && $ad==2){
    echo "<script>window.history.back();</script>";
    exit;
}

$pictures = explode(',',$ad->pictures);

$products = getStoreProducts($con,$ad->id);

$timestamp = strtotime($ad->created_at);

$day = date("d", $timestamp);
$month = date("F", $timestamp);
$year = date("Y", $timestamp);
$time = date("h:i A", $timestamp);

$posted_on = $day.' '.$month.', '.$year.' at '.$time;
?>

   <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid bg-white p-2">
          
   
    <div class="container mt-2">
        <div class="">
   <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">


  <div class="carousel-inner">
  <?php foreach ($pictures as $index => $picture) { ?>
    <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
      <img src="<?=$baseurl.$picture;?>" class="d-block w-100 rounded" style="height:350px" alt="Image <?=$index+1;?>">
    </div>
  <?php } ?>
</div>

</div>
</div>
    </div>
    

    <div class="px-3 pt-3">
      <div class="row align-items-start justify-content-between">
        <div class="col-12">
          <h1 class="fw-bold mb-1"><?=$ad->title;?><?php if($ad->is_verified){ ?>
                                    <img src="<?=$baseurl;?>app/img/verified.png" title='Verified' style="width:17px;margin-bottom:5px"></a>
                                    <?php } ?></h1>
        <h3>₹<?=$ad->price;?>  <?php if($ad->ad_type=='Property'){ ?> | <?=$ad->rooms;?> BHK <?php } ?></h3>
        <h6 class='text-muted' style='font-size:16px'>Posted on <?=$posted_on;?></h6>
          
          <span class=" text-dark" style='font-size:17px'>
          <?=$ad->address.', '.$ad->city_name.', '.$ad->state_name;?>
          </span>
          <?php if($ad->is_plus || $ad->is_trusted){ ?>
          <div class="d-flex align-items-center gap-2 mt-2">
            <div>
               <?php if($ad->is_plus){ ?>
                                     <a class='krishisampark-text border-danger border p-1 mt-3' style='font-size:13px'><i class='fa fa-plus'></i> Plus Member</a>
                                <?php }  if($ad->is_trusted){ ?>
                                    <a class='text-success border-success border p-1 mt-3' style='font-size:13px'><i class='fa fa-handshake'></i> Trusted</a>
                                <?php } ?>
            </div>
            
          </div>
          <?php } ?>
        </div>
        
      </div>
    </div>

    
 <?php if ($ad->lactation || $ad->milk_capacity || $ad->age || $ad->information) { ?>
    <div class="px-3 py-2">
      <div class="row">
        <div class="col-12">
          <hr>
           
           <div>
              
                  <h3 style='font-size:20px'>Information</h3>
                 
                  <?php

                    if ($ad->lactation || $ad->milk_capacity || $ad->age) {
                        echo '<p><ul>';
                        
                        if ($ad->lactation) {
                            echo '<li>Lactation : ' . $ad->lactation . '</li>';
                        }
                    
                        if ($ad->milk_capacity) {
                            echo '<li>Milk Capacity : ' . $ad->milk_capacity . '</li>';
                        }
                    
                        if ($ad->age) {
                            echo '<li>Age : ' . $ad->age . '</li>';
                        }
                    
                        echo '</ul></p>';
                    }
                    ?>

               <p style='font-size:17px'><?=$ad->information;?></p>
              </div>
           </div>

          
        </div>
      </div>
       <?php } ?>
    </div>

</div>

   



<?php include 'private/footer.php';?>