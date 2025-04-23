<?php 
$animalsPage='active';
require('private/header.php');
$categories = get_category($con);
$userCity = $userData->city;
$animals = showAnimals($con,$userCity);
$locationName='';
if(!empty($userCity)){
    $locationName = getLocationName($con,$userData->city);
    $locationName = $locationName->city_name;
}
?>

  <body class="bg-light">

  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0">Animals <?php "in ".$locationName!=''? $locationName : "";?></h3>
      </div>
     
    </div>
  </div>
  


    <div class="p-3">
      
      <div class="row gy-3">
          
        <?php 
        if(count($animals)>0){
        foreach($animals as $ad){ 
                 $pictures = explode(',',$ad->pictures);
                         
                         $picture=$pictures[0];
                         
                         $targetDate = DateTime::createFromFormat('d-m-Y H:i:s',  $ad->created_at);
            $currentDate = new DateTime();
            
            $timeDifference = $currentDate->diff($targetDate);
            
            if ($timeDifference->days > 0) {
                $time = $timeDifference->days . ' days';
            } elseif ($timeDifference->h > 0) {
                $time = $timeDifference->h . ' hours';
            } else {
                $time = $timeDifference->i . ' minutes';
            }

                ?>
        <div class="col-12 col-md-4">
          <a href="listing-detail?id=<?=$ad->id;?>" class="text-decoration-none link-dark">
            <div class="card rounded-4 shadow border-0 overflow-hidden">
              <div class="position-relative">
                <div class="product-back">
                  <img src="<?=$baseurl.$picture;?>" style='height:200px;width:100%' alt class="img-fluid rounded-top" />
                </div>
<?php if($ad->is_featured==1){ ?>
              <div class="product-rating shadow-sm">
                  <span class="badge bg-warning">
                     Featured
                      </span>
                </div>
                
                <?php } ?>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <div class="h3 fw-bold"><?=$ad->title;?>
                   <?php if($ad->is_verified){ ?>
                                    <img src="<?=$baseurl;?>app/img/verified.png" style="width:12px"></a>
                                    <?php } ?>
                  </div>
                  
                </div>
                <div
                  class="d-flex justify-content-between text-muted h6 m-0 fw-normal"
                >
                  <div><?=$ad->city_name.', '.$ad->state_name;?></div>
                  <div><?=$time;?> ago</div>
                </div>
              </div>
              
            </div>
          </a>
        </div>
        <?php } }else{ echo "<h2>No animal found</h2>"; } ?>
        
      </div>
    </div>
<?php require('private/footer.php');?>