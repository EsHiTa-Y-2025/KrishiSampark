<?php 
$mainPage='active';
if(isset($_GET['slug'])){
require('private/header.php');

$userCity = $userData->city;
$state = getStateByCity($con,$userCity);
if(!is_object($state) && $state==2){
    $stateAds = array();
}else{
    $state_id = $state->state_id;
    $stateAds = getStateAd($con,$_GET['slug'],$state_id,$userCity);
    $anotherAds = getStateAnotherAd($con,$_GET['slug'],$state_id,$userCity);
}

$category = getCat($con,$_GET['slug']);
$subcats = getMoreSubCat($con,$category->id);
$ads = getAd($con,$_GET['slug'],$userCity);


if($ads==2){
    echo "<script>window.history.back();</script>";
    exit;
} 
?>
  <body class="bg-light">

  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex landsbazzar-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0">
            
             <?php
                            if ($lang == 'en') {
                                echo  $category->cat_name ;
                            } elseif ($lang == 'kannad' && !empty($category->cat_name_kannad)) {
                                echo $category->cat_name_kannad;
                            } elseif ($lang == 'marathi' && !empty($category->cat_name_marathi)) {
                                echo $category->cat_name_marathi;
                            } else {
                                echo $category->cat_name ;
                            }
                            ?>    
        
         </h3>
      </div>
     
    </div>
  </div>
  <?php if (!empty($subcats)) : ?>
    <div class="p-3 brands-list">
    
        
           
            <div class="row  g-4">
                
                    <?php foreach ($subcats as $subcategory) : ?>
                        <div class="col-4">
                            <a href="listings?slug=<?=$subcategory->slug;?>" class="text-decoration-none link-dark">
                                <div class="card border-0 bg-light">
                                    <div class="m-auto back">
                                        <img src="<?= $baseurl.$subcategory->cat_icon ?>" class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#">
                                    </div>
                                    <div class="card-body text-center px-0 pb-0">
                                        <h6 class="card-title mb-1" style="white-space:normal">
                                            
                                            
                                            <?php
                            if ($lang == 'en') {
                                echo  $subcategory->cat_name ;
                            } elseif ($lang == 'kannad' && !empty($subcategory->cat_name_kannad)) {
                                echo $subcategory->cat_name_kannad;
                            } elseif ($lang == 'marathi' && !empty($subcategory->cat_name_marathi)) {
                                echo $subcategory->cat_name_marathi;
                            } else {
                                echo $subcategory->cat_name ;
                            }
                            ?>
                                            
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                
            </div>
       

</div>
<?php else: ?>



    <div class="p-3">
      
      <div class="row gy-3">
          
        <?php 
        if(count($ads)>0){
        foreach($ads as $ad){ 
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
    
        <div class="card rounded-4 shadow border-0">
            <div class="">
                <div class="row">
                    
                    <div class="col-4" style='padding-right:0px!important'>
                        <a href="listing-detail?id=<?=$ad->id;?>" class="text-decoration-none link-dark">
                        <img src="<?=$baseurl.$picture;?>" style='height:100px;width:100%' alt class="img-fluid rounded-top p-2" />
                        </a>
                    </div>
                    

                    <div class="col-8 py-3">
                        <div class="row">
    <div class="col-8">
        <a href="listing-detail?id=<?=$ad->id;?>" class="text-decoration-none link-dark">
            <!-- Plus Member icon -->
            <?php if($ad->is_plus){ ?>
                <span class='krishisampark-bg1 border-light border p-1 mt-3'><i class='fa fa-plus'></i> Plus Member</span>
            <?php } ?>

            <!-- Trusted icon -->
            <?php if($ad->is_trusted){ ?>
                <span class='krishisampark-bg2 border-warning border p-1 mt-3'><i class='fa fa-handshake'></i> Trusted</span>
            <?php } ?>

            <div class="h4 mt-<?php if($ad->is_plus){ echo "2"; } ?> fw-bold">
                <?=$ad->title;?>
            </div>
            <span style='font-size:14px'><i class='fa fa-map-marker-alt'></i> <?=$ad->city_name.', '.$ad->state_name;?></span><br>
            <span>₹ <?=$ad->price;?></span>
        </a>
    </div>

    <div class="col-4">
        <!-- Share icon and text -->
        <span  style="float: right; margin-right: 20px;text-align:center;">
            <img src="img/whatsapp.webp" style="width:40px"  data-id="<?=$ad->id?>" onclick="shareAd(this)"><br>
            <b style='font-size:15px'><?=getLanguageString($con,$lang,'share');?></b>
        </span>
    </div>
</div>


                    </div>
                </div>
            </div>
        </div>
    
</div>

        <?php } }  
        if(count($stateAds)>0){
                    echo "<br><h3>Nearby Listings</h3>";

        foreach($stateAds as $ad){ 
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
    
        <div class="card rounded-4 shadow border-0">
            <div class="">
                <div class="row">
                    
                    <div class="col-4" style='padding-right:0px!important'>
                        <a href="listing-detail?id=<?=$ad->id;?>" class="text-decoration-none link-dark">
                        <img src="<?=$baseurl.$picture;?>" style='height:100px;width:100%' alt class="img-fluid rounded-top p-2" />
                        </a>
                    </div>
                    

                    <div class="col-8 py-3">
                        <div class="row">
    <div class="col-8">
        <a href="listing-detail?id=<?=$ad->id;?>" class="text-decoration-none link-dark">
            <!-- Plus Member icon -->
            <?php if($ad->is_plus){ ?>
                <span class='krishisampark-bg1 border-light border p-1 mt-3'><i class='fa fa-plus'></i> Plus Member</span>
            <?php } ?>

            <!-- Trusted icon -->
            <?php if($ad->is_trusted){ ?>
                <span class='krishisampark-bg2 border-warning border p-1 mt-3'><i class='fa fa-handshake'></i> Trusted</span>
            <?php } ?>

            <div class="h4 mt-<?php if($ad->is_plus){ echo "2"; } ?> fw-bold">
                <?=$ad->title;?>
            </div>
            <span style='font-size:14px'><i class='fa fa-map-marker-alt'></i> <?=$ad->city_name.', '.$ad->state_name;?></span><br>
            <span>₹ <?=$ad->price;?></span>
        </a>
    </div>

    <div class="col-4">
        <!-- Share icon and text -->
        <span  style="float: right; margin-right: 20px;text-align:center;">
            <img src="img/whatsapp.webp" style="width:40px"  data-id="<?=$ad->id?>" onclick="shareAd(this)"><br>
            <b style='font-size:15px'><?=getLanguageString($con,$lang,'share');?></b>
        </span>
    </div>
</div>


                    </div>
                </div>
            </div>
        </div>
    
</div>

        <?php } }
        
        if(count($anotherAds)>0){
                    echo "<br><h3>Related Listings</h3>";

        foreach($anotherAds as $ad){ 
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
    
        <div class="card rounded-4 shadow border-0">
            <div class="">
                <div class="row">
                    
                    <div class="col-4" style='padding-right:0px!important'>
                        <a href="listing-detail?id=<?=$ad->id;?>" class="text-decoration-none link-dark">
                        <img src="<?=$baseurl.$picture;?>" style='height:100px;width:100%' alt class="img-fluid rounded-top p-2" />
                        </a>
                    </div>
                    

                    <div class="col-8 py-3">
                        <div class="row">
    <div class="col-8">
        <a href="listing-detail?id=<?=$ad->id;?>" class="text-decoration-none link-dark">
            <!-- Plus Member icon -->
            <?php if($ad->is_plus){ ?>
                <span class='krishisampark-bg1 border-light border p-1 mt-3'><i class='fa fa-plus'></i> Plus Member</span>
            <?php } ?>

            <!-- Trusted icon -->
            <?php if($ad->is_trusted){ ?>
                <span class='krishisampark-bg2 border-warning border p-1 mt-3'><i class='fa fa-handshake'></i> Trusted</span>
            <?php } ?>

            <div class="h4 mt-<?php if($ad->is_plus){ echo "2"; } ?> fw-bold">
                <?=$ad->title;?>
            </div>
            <span style='font-size:14px'><i class='fa fa-map-marker-alt'></i> <?=$ad->city_name.', '.$ad->state_name;?></span><br>
            <span>₹ <?=$ad->price;?></span>
        </a>
    </div>

    <div class="col-4">
        <!-- Share icon and text -->
        <span  style="float: right; margin-right: 20px;text-align:center;">
            <img src="img/whatsapp.webp" style="width:40px"  data-id="<?=$ad->id?>" onclick="shareAd(this)"><br>
            <b style='font-size:15px'><?=getLanguageString($con,$lang,'share');?></b>
        </span>
    </div>
</div>


                    </div>
                </div>
            </div>
        </div>
    
</div>

        <?php } }?>
        
      </div>
    </div>
    
    <?php endif; ?>
    
   <script>
    // JavaScript code on your website
    function shareAd(shareIcon) {
        
        var adId = shareIcon.getAttribute("data-id");

        var shareUrl = "https://krishisampark.in/app/listing?id=" + adId;
        var shareMessage = "Check out this amazing listing on Krishisampark!";
        
        Android.shareContent(shareMessage, shareMessage+' '+shareUrl);
        
    }
</script>



<?php require('private/footer.php');?>
<?php  }?>
