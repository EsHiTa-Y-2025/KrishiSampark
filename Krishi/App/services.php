<?php require('private/header.php');
$categories = get_category($con);
$ads = showFeaturedAds($con,'Property');
$businessads = showFeaturedAds($con,'Business');
$recentAds = showRecentAds($con, 'Property');
$trustedAds = showTrustedAds($con,'Property');


?>
  <body class="">
    
 <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex landsbazzar-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0">Services</h3>
      </div>
     
    </div>
  </div>
  
  
  <div class="sticky-top bg-white px-3 py-2">
<div class="input-group bg-white shadow rounded-md border p-1 overflow-hidden">
<input type="text" class="shadow-none form-control border-0 ps-1" placeholder="Search business...">
<span class="input-group-text border-0 bg-white"><i class="fa-solid fa-magnifying-glass text-danger"></i></span>
</div>
</div>
    
<div class="p-3 ">
   <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/sliders/slider1.jpg" class="d-block w-100 rounded" alt="Image 1">
    </div>
    <div class="carousel-item">
      <img src="img/sliders/slider2.jpg" class="d-block w-100 rounded" alt="Image 2">
    </div>
    <div class="carousel-item">
      <img src="img/sliders/slider3.jpg" class="d-block w-100 rounded" alt="Image 3">
    </div>
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

   
    
     
     <div class="p-3 bg-gray">
      <h3 class="fw-bold mb-3">Our Business Categories</h3>
      <div class="row align-items-end g-4">
          <?php foreach($categories as $cat) { ?>
          
        <div class="col-3">
          <a href="category?slug=<?=$cat->slug;?>" class="text-decoration-none">
            <div class="card border-0">
              <img
                src="<?=$baseurl.$cat->cat_icon;?>"
                class="img-fluid m-auto rounded-pill"
                style='width:37px;height:35px'
                alt="#"
              />
              <div class="card-body text-center px-0 pb-0">
                <p class="card-title m-0" style='font-size:13px;color:#000;'><?=substr($cat->cat_name,0,10).'..';?></p>
              </div>
            </div>
          </a>
        </div>
        
        <?php } ?>
       
       
       
      </div>

     
    </div>
    

 
 <div class="ps-3 py-3 bg-light">
      <div class="d-flex align-items-center justify-content-between mb-3 pe-3">
        <div class="d-flex align-items-center gap-2">
          <div>
            <img src="<?=$baseurl;?>img/fav.png" alt class="img-fluid ch-30 cw-30" />
          </div>
          <div>
            <h5 class="fw-bold mb-0">Featured Business</h5>
            <p class="text-muted m-0">check out now</p>
          </div>
        </div>
        <div>
          <a
            href="business"
            class="text-decoration-none text-danger fw-bold"
            >See all</a
          >
        </div>
      </div>
      
      <div class="px-0">
        <div class="multipleitems">
            
            <?php foreach($businessads as $index => $ad) {
        $pictures = explode(',', $ad->pictures);
        $picture = $pictures[0];
        $targetDate = DateTime::createFromFormat('d-m-Y H:i:s', $ad->created_at);
        $currentDate = new DateTime();
        $timeDifference = $currentDate->diff($targetDate);
        
        if ($timeDifference->days > 0) {
          $time = $timeDifference->days . ' days';
        } elseif ($timeDifference->h > 0) {
          $time = $timeDifference->h . ' hours';
        } else {
          $time = $timeDifference->i . ' minutes';
        }
        
        // Add the "active" class to the first item
        $activeClass = ($index === 0) ? 'active' : '';
      ?>
          <div class="item pe-3">
            <a href="listing-detail?id=<?=$ad->id;?>" class="text-decoration-none link-dark">
              <div class="card bg-light border-0">
                <div class="product-offer-back">
                  <img src="<?=$baseurl.$picture;?>" style='height:120px;width:100%'  class="img-fluid rounded-md" />
                  
                </div>

                <!--<div class="product-rating shadow-sm">-->
                <!--  <span class="badge bg-success"-->
                <!--    ><?=$ad->status_type;?></span>-->
                <!--</div>-->
                <div class="card-body px-0 pb-0 pt-2">
                  <h5 class="fw-bold mb-0"><?=$ad->title;?></h5>
                  <p class="text-muted m-0 mt-1 small"><?=$ad->city_name.' '.$ad->state_name;?></p>
                </div>
              </div>
            </a>
          </div>

          <?php } ?>
        </div>
      </div>
    </div>

<div class="container p-4" style='background:#e5dfed;box-shadow: 0px 0px 5px #aaaaaa;'>
    <div class="row">
     <div class="col-8">
        <h2>Need Assitance?</h2>
        <h4>Call Landsbazzar Expert Now +919738207273</h4> 
     </div>
     <div class="col-4">
         <a href="tel:919738207273" class="landsbazzar-bg1 btn mt-3 text-white">Call now</a>
     </div>
        </div>
    </div>
 
 
<?php require('private/footer.php');?>
