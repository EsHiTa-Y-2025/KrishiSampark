<?php 
$mainPage ='active';
if(isset($_GET['variety_keyword'])){
require('private/header.php');

$ads = getVarietyListing($con,$_GET['variety_keyword'],$userData->city);
if($ads==2 || count($ads)<1){
   
} 
?>
  <body class="bg-light">

  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a onclick='window.history.back()'><i class="bi bi-arrow-left d-flex landsbazzar-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0"><?=$_GET['variety_keyword'];?> Listings</h3>
      </div>
     
    </div>
  </div>
  


    <div class="p-3">
      
      <div class="row gy-3">
          
        <?php 
        if($ads!=2 && count($ads)>0){
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
        <div class="col-12 col-md-4 col-lg-4 mt-3">
    
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
            <span  style='font-size:14px'><i class='fa fa-map-marker-alt'></i> <?=$ad->city_name.', '.$ad->state_name;?></span><br>
            <span>₹ <?=$ad->price;?></span>
        </a>
    </div>

    <div class="col-4">
        <!-- Share icon and text -->
        <span  style="float: right; margin-right: 20px;text-align:center;">
            <img src="img/whatsapp.webp" style="width:40px"  data-id="<?=$ad->id?>" onclick="shareAd(this)"><br>
            <b style='font-size:15px'>Share</b>
        </span>
    </div>
</div>
                </div>
            </div>
        </div>
    
</div>
        <?php } }else{ echo "<h5>No listing found</h5>"; } ?>
        
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
