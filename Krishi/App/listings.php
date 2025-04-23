<?php 
$mainPage ='active';
if(isset($_GET['slug'])){
require('private/header.php');

$category = getCat($con,$_GET['slug']);

$varieties = get_variety($con,$category->id);

$state = getStateByCity($con,$userData->city);
if(!is_object($state) && $state==2){
    $stateAds = array();
}else{
    $state_id = $state->state_id;
    $stateAds = getSubAdByState($con,$_GET['slug'],$state_id,$userData->city);
    $anotherAds = getSubAdAnother($con,$_GET['slug'],$state_id,$userData->city);
}

$ads = getSubAd($con,$_GET['slug'],$userData->city);

if($ads==2){
    echo "<script>window.history.back();</script>";
    exit;
} 
?>
  <body class="bg-light">

  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a onclick='window.history.back()'><i class="bi bi-arrow-left d-flex landsbazzar-text h2 m-0 back-page"></i></a>
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
  


<?php if (!empty($varieties)) {

?>

  <div class="p-3 sticky-top shadow-sm" style='background: linear-gradient(to right, rgb(134 171 65), rgb(255 147 10));'>
        <form method="GET" action="variety-listing">
        
      <div class="input-group bg-white rounded-md border-0 p-1 mb-3 overflow-hidden">
       
        <input class="shadow-none form-control border-0 border-end" name="variety_keyword" required placeholder="<?=getLanguageString($con,$lang,'search_varieties');?>...">
                 <button type='submit' class="input-group-text text-decoration-none border-0 bg-white"><i class="fa-solid fa-magnifying-glass krishisampark-text"></i></button>

        
      </div>
     </form>
    </div>
  
   
<?php } ?>

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
        <div class="col-12 col-md-4 mt-3">
    
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
            
            <?php if($ad->is_plus){ ?>
                <span class='krishisampark-bg1 border-light border p-1 mt-3'><i class='fa fa-plus'></i> Plus Member</span>
            <?php } ?>

            
            <?php if($ad->is_trusted){ ?>
                <span class='krishisampark-bg2 border-warning border p-1 mt-3'><i class='fa fa-handshake'></i> Trusted</span>
            <?php } ?>

            <div class="h4 mt-<?php if($ad->is_plus){ echo "2"; } ?> fw-bold">
                 <?php
                            if ($lang == 'en') {
                                echo  $ad->title ;
                            } elseif ($lang == 'kannad' && !empty($ad->title_kannad)) {
                                echo $ad->title_kannad;
                            } elseif ($lang == 'marathi' && !empty($ad->title_marathi)) {
                                echo $ad->title_marathi;
                            } else {
                                echo $ad->title ;
                            }
                            ?>    
            </div>
            
            <span  style='font-size:14px'><i class='fa fa-map-marker-alt'></i> <?=$ad->city_name.', '.$ad->state_name;?></span><br>
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
        <div class="col-12 col-md-4 mt-3">
    
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
            
            <?php if($ad->is_plus){ ?>
                <span class='krishisampark-bg1 border-light border p-1 mt-3'><i class='fa fa-plus'></i> Plus Member</span>
            <?php } ?>

            
            <?php if($ad->is_trusted){ ?>
                <span class='krishisampark-bg2 border-warning border p-1 mt-3'><i class='fa fa-handshake'></i> Trusted</span>
            <?php } ?>

            <div class="h4 mt-<?php if($ad->is_plus){ echo "2"; } ?> fw-bold">
                 <?php
                            if ($lang == 'en') {
                                echo  $ad->title ;
                            } elseif ($lang == 'kannad' && !empty($ad->title_kannad)) {
                                echo $ad->title_kannad;
                            } elseif ($lang == 'marathi' && !empty($ad->title_marathi)) {
                                echo $ad->title_marathi;
                            } else {
                                echo $ad->title ;
                            }
                            ?>    
            </div>
            
            <span  style='font-size:14px'><i class='fa fa-map-marker-alt'></i> <?=$ad->city_name.', '.$ad->state_name;?></span><br>
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
        <div class="col-12 col-md-4 mt-3">
    
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
            
            <?php if($ad->is_plus){ ?>
                <span class='krishisampark-bg1 border-light border p-1 mt-3'><i class='fa fa-plus'></i> Plus Member</span>
            <?php } ?>

            
            <?php if($ad->is_trusted){ ?>
                <span class='krishisampark-bg2 border-warning border p-1 mt-3'><i class='fa fa-handshake'></i> Trusted</span>
            <?php } ?>

            <div class="h4 mt-<?php if($ad->is_plus){ echo "2"; } ?> fw-bold">
                 <?php
                            if ($lang == 'en') {
                                echo  $ad->title ;
                            } elseif ($lang == 'kannad' && !empty($ad->title_kannad)) {
                                echo $ad->title_kannad;
                            } elseif ($lang == 'marathi' && !empty($ad->title_marathi)) {
                                echo $ad->title_marathi;
                            } else {
                                echo $ad->title ;
                            }
                            ?>    
            </div>
            
            <span  style='font-size:14px'><i class='fa fa-map-marker-alt'></i> <?=$ad->city_name.', '.$ad->state_name;?></span><br>
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
        <?php } }
        
         ?>
        
      </div>
    </div>
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
