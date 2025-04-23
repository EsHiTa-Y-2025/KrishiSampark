<?php 
$mainPage='active';
require('private/header.php');
if(isset($_GET['keyword'])){
    extract($_GET);
    $categories = get_category($con);
    $userCity = $userData->city;
    
    if(empty($userCity)){
        $sql = 'SELECT listings.*, states.state_name, cities.city_name,users.is_verified,users.is_plus,users.is_trusted FROM listings 
            INNER JOIN states ON states.id = listings.state 
            INNER JOIN cities ON cities.id = listings.city 
            INNER JOIN users on users.userId=listings.posted_by
            WHERE (title LIKE :keyword OR information LIKE :keyword) AND is_deleted=:is_deleted 
            ORDER BY is_featured DESC, listings.id DESC';
        $stm = $con->prepare($sql);
        $stm->execute(['keyword' => "%$keyword%",'is_deleted'=>0]);    
    }else{
        $sql = 'SELECT listings.*, states.state_name, cities.city_name,users.is_verified,users.is_plus,users.is_trusted FROM listings 
            INNER JOIN states ON states.id = listings.state 
            INNER JOIN cities ON cities.id = listings.city 
            INNER JOIN users on users.userId=listings.posted_by
            WHERE listings.city = :city AND (title LIKE :keyword OR information LIKE :keyword) AND is_deleted=:is_deleted 
            ORDER BY is_featured DESC, listings.id DESC';
        $stm = $con->prepare($sql);
        $stm->execute(['city' => $userCity, 'keyword' => "%$keyword%",'is_deleted'=>0]);
    }
    
    $results = $stm->fetchAll(PDO::FETCH_OBJ);
    
?>

<body>
    <div class="bg-white shadow-sm p-3">
        <div class="d-flex align-items-center">
            <div class="gap-3 d-flex align-items-center">
                <a href="main"><i class="bi bi-arrow-left d-flex krishisampark-text  h2 m-0 back-page"></i></a>
                <h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'search_results');?></h3>
            </div>
            
        </div>
    </div>
    
    <div class="p-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="fw-bold mb-0"><?=getLanguageString($con,$lang,'search_results');?> : <?php echo count($results);?></h3>

        </div>
        <div class="row g-3">

            <?php 
        if(count($results)>0){
        foreach($results as $ad){ 
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
            <span><i class='fa fa-map-marker-alt'></i> <?=$ad->city_name.', '.$ad->state_name;?></span><br>
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

        <?php } }else{ echo "<p class='text-muted'>No search results</p>"; } ?>

            
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

  
    
<?php require('private/footer.php'); } else{
 header('Location:search-form');
}?>