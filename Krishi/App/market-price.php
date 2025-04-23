<?php 
$marketPricePage='active';
require('private/header.php');
$marketPrices = getMarketPrices($con);
?>

<body>

    <div class="bg-white shadow-sm p-3">
        <div class="d-flex align-items-center">
            <div class="gap-3 d-flex align-items-center">
                <a href="main"><i class="bi bi-arrow-left d-flex text-danger h2 m-0 back-page"></i></a>
                <h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'market_price');?></h3>
            </div>
           
        </div>
    </div>

   
    <div class="bg-light p-3">
        <h5 class="m-0"><?=getLanguageString($con,$lang,'market_price');?></h5>
    </div>
    <div class="p-3">
        
        <?php foreach($marketPrices as $marketPrice) :?>
        <div class="row">
            <div class="col-8">
            <div class="mb-2">
                <div class="mb-3">
                    <a href="preview-image?id=<?=$marketPrice->id;?>"><img src="<?=$baseurl;?>media/market_prices/<?=$marketPrice->image;?>" alt class="mr-5" style='width:100%;height:100px'></a>
                    <p style='font-size:15px;font-weight:500' class="mt-2">
                        
                         <?php
                            if ($lang == 'en') {
                                echo  $marketPrice->title ;
                            } elseif ($lang == 'kannad' && !empty($marketPrice->title_kannad)) {
                                echo $marketPrice->title_kannad;
                            } elseif ($lang == 'marathi' && !empty($marketPrice->title_marathi)) {
                                echo $marketPrice->title_marathi;
                            } else {
                                echo $marketPrice->title ;
                            }
                            ?>    
                    </p>  
                </div>
            </div>
          </div>
             <div class="col-4 mt-4">
                <!-- Share icon and text -->
                <span  style="float: right; margin-right: 20px;text-align:center;">
                    <img src="img/whatsapp.webp" style="width:40px" data-id="<?=$marketPrice->id?>" onclick="shareAd(this)"><br>
                    <b style='font-size:15px'><?=getLanguageString($con,$lang,'share');?></b>
                </span>
            </div>
            
        </div>
        <hr>
        
        <?php endforeach; ?>
        
    </div>
    
     <script>
    // JavaScript code on your website
    function shareAd(shareIcon) {
        
        var marketId = shareIcon.getAttribute("data-id");

        var shareUrl = "https://krishisampark.in/app/preview-image?id=" + marketId;
        var shareMessage = "Check out this amazing market price on Krishisampark!";
        
        Android.shareContent(shareMessage, shareMessage+' '+shareUrl);
        
    }
</script>



   <?php require('private/footer.php');?>