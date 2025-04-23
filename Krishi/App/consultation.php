<?php 
$consultationPage='active';
require('private/header.php');
$consultations = getConsultations($con);

?>
  <body>
    <div class="bg-white shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="gap-3 d-flex align-items-center">
          <a href="main"
            ><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i
          ></a>
          <h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'book_consultation');?></h3>
        </div>
        <!--<div class="ms-auto gap-3 d-flex align-items-center">-->
        <!--  <a href="support.html" class="text-decoration-none text-danger"-->
        <!--    ><i class="fa-solid fa-comment-dots"></i>&nbsp;Support</a-->
        <!--  >-->
        <!--  <a href="notifications.html" class="link-dark"-->
        <!--    ><i class="bi bi-bell d-flex m-0 h2"></i-->
        <!--  ></a>-->
        <!--  <a class="toggle osahan-toggle text-dark m-0" href="#"-->
        <!--    ><i class="bi bi-list d-flex m-0 h1"></i-->
        <!--  ></a>-->
        <!--</div>-->
      </div>
    </div>
    
    <div class="pt-3 text-center">
        <a href="request-consultation" class="btn krishisampark-btn text-white"><?=getLanguageString($con,$lang,'request_consultation');?></a>
    </div>
    <div class="p-3">
        
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
     
      <!--<div class="my-3 bg-success-subtle p-2 text-success text-center rounded">-->
      <!--  This order with Meshi Vaishnu Dhaba was delivered-->
      <!--</div>-->
      <!--<div class="d-flex align-items-center justify-content-between">-->
        
        <!--<div>-->
        <!--  <a href="#" class="btn btn-outline-danger rounded-pill btn-sm"-->
        <!--    >Mark as favourite</a-->
        <!--  >-->
        <!--</div>-->
      <!--</div>-->
      
      <?php foreach($consultations as $consultation): 
      
        $consultationDateTime = $consultation->date .' '. $consultation->start_time;
        $currentDateTime = date('Y-m-d H:i:s');
    

      
      ?>
      <div class="m-0">
        <div class="d-flex justify-content-between align-items-center  gap-3 mb-3">
          <!--<img src="img/veg.jpg" alt class="img-fluid ch-20" />-->
          <div class="lh-sm">
            <h4 class="mb-1"><?=$consultation->title;?></h4>
            <div class="text-dark ">
               <h5><?=getLanguageString($con,$lang,'start_time');?> : <?=$consultation->start_time;?> <br><?=getLanguageString($con,$lang,'date');?> : <?=date('d/m/Y', strtotime($consultation->date));?> <br> <?=getLanguageString($con,$lang,'mode');?> : <?=$consultation->mode;?> <br> <?=getLanguageString($con,$lang,'duration');?> : <?=$consultation->duration;?></h5>
            </div>
          </div>
          
          <div class="fs-5 fw-bold">
              <?php if($consultation->mode=='Online'){ 
                if ($currentDateTime >= $consultationDateTime) {
                    ?>
                    <a href="<?=$consultation->link;?>" class="btn krishisampark-btn rounded-pill btn-sm"><?=getLanguageString($con,$lang,'join_consultation');?></a>
                    <?php
                }else{
                    ?>
                    <a href="request-consultation?id=<?=$consultation->id;?>" class="btn krishisampark-btn rounded-pill btn-sm"><?=getLanguageString($con,$lang,'join_consultation');?></a>
                    <?php
                }
              ?>
              
              <?php } else{ ?>
              <a href="request-consultation?id=<?=$consultation->id;?>" class="btn krishisampark-btn rounded-pill btn-sm"><?=getLanguageString($con,$lang,'book_consultation');?></a>
              <?php } ?>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            
          <div class="d-flex align-items-center ">
              
            <h5><?=$consultation->conducted_by;?></h5>
          </div>
          <div class="fs-5 fw-bold">
              <img src="<?php echo $baseurl.$consultation->photo;?>" style="width:80px;border-radius:20px">
          </div>
        </div>
      </div>
      <hr />
<?php endforeach; ?>
    </div>
    <div class="pb-5 pt-3"></div>

   

   <?php require('private/footer.php');?>