<?php 
require('private/header.php');
$categories = get_category($con);

$userAds = userAds($con,$userData->userId);
?>

  <body class="bg-light">

  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex landsbazzar-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0">My Properties</h3>
      </div>
     
    </div>
  </div>
  


    <div class="p-3">
      
      <div class="row gy-3">
          
        <?php 
        if(count($userAds)>0){
        foreach($userAds as $ad){ 
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
                
                
                <div class="product-rating shadow-sm">
                  <span class="badge bg-<?php if($ad->is_featured==1){ echo "warning"; }else { echo "success"; }?>">
                      <?php if($ad->is_featured==1){ echo "Featured"; }else { echo $ad->status_type; }?>
                      </span>
                </div>
              
                
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <div class="h3 fw-bold"><?=$ad->title;?>
                   <?php if($ad->is_verified){ ?>
                                    <img src="<?=$baseurl;?>img/verified.png" style="width:12px"></a>
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
        <?php } }else{ echo "<h2>No property found</h2>"; } ?>
        
      </div>
    </div>
 <script
      src="vender/jquery/jquery.min.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>
    <script
      src="vender/bootstrap/js/bootstrap.bundle.min.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>

    <script
      src="vender/slick/slick/slick.min.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>

    <script
      src="vender/sidebar/hc-offcanvas-nav.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>

    <script
      src="js/custom.js"
      type="12f990073857c990e213daed-text/javascript"
    ></script>
    <script
      src="https://askbootstrap.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
      data-cf-settings="12f990073857c990e213daed-|49"
      defer
    ></script>
    <script
      defer
      src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
      integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
      data-cf-beacon='{"rayId":"7dcef2b2ad770da6","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}'
      crossorigin="anonymous"
    ></script>
    
    
  </body>
</html>