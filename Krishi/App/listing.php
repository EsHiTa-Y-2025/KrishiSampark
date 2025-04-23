<?php require_once('private/autoload.php');
$ad = getListingById($con,$_GET['id']);

if(!is_object($ad) && $ad==2){
    echo "<script>window.history.back();</script>";
    exit;
}

$pictures = explode(',',$ad->pictures);

$products = getStoreProducts($con,$ad->id);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="<?=$baseurl;?>img/krishi.png" type="image/png" />
    <title><?=$ad->title;?> | Krishisampark</title>

    <link rel="stylesheet" href="vender/bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" href="vender/icons/icofont.min.css" />

    <link rel="stylesheet" href="vender/slick/slick/slick.css" />
    <link rel="stylesheet" href="vender/slick/slick/slick-theme.css" />

    <link href="vender/fontawesome/css/all.min.css" rel="stylesheet" />

    <link href="vender/sidebar/demo.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet" href="css/style.css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
 <style>

.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999999;
}

.spinner {
    border: 4px solid rgba(0, 0, 0, 0.3);
    border-top: 4px solid #333;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.content {
    display: none;
}

    </style>
    
  </head>

  <body>
    <div class="bg-white shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="gap-3 d-flex align-items-center">
          <a onclick='window.history.back()'
            ><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i
          ></a>
          <h3 class="fw-bold m-0"><?=$ad->title;?></h3>
        </div>
        
        <!--<div class="ms-auto gap-3 d-flex align-items-center">-->
        <!--  <button-->
        <!--    type="button"-->
        <!--    class="btn krishisampark-btn border btn-sm rounded-md"-->
            
        <!--  >-->
        <!--    <span>₹</span>&nbsp;<?=$ad->price;?>-->
        <!--  </button>-->
         
        <!--</div>-->
      </div>
    </div>
    <div class="shadow-sm">
   <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
<!--  <ol class="carousel-indicators">-->
<!--  <?php foreach ($pictures as $index => $picture) { ?>-->
<!--    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$index;?>" <?php if ($index === 0) echo 'class="active"'; ?>></li>-->
<!--  <?php } ?>-->
<!--</ol>-->

  <div class="carousel-inner">
  <?php foreach ($pictures as $index => $picture) { ?>
    <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
      <img src="<?=$baseurl.$picture;?>" class="d-block w-100 rounded" style="height:350px" alt="Image <?=$index+1;?>">
    </div>
  <?php } ?>
</div>

  <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">-->
  <!--  <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
  <!--  <span class="visually-hidden">Previous</span>-->
  <!--</a>-->
  <!--<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">-->
  <!--  <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
  <!--  <span class="visually-hidden">Next</span>-->
  <!--</a>-->
</div>
</div>

    <div class="px-3 pt-3">
      <div class="row align-items-start justify-content-between">
        <div class="col-12">
          <h1 class="fw-bold mb-1"><?=$ad->title;?><?php if($ad->is_verified){ ?>
                                    <img src="<?=$baseurl;?>app/img/verified.png" title='Verified' style="width:17px;margin-bottom:5px"></a>
                                    <?php } ?></h1>
        <h5>₹<?=$ad->price;?>  <?php if($ad->ad_type=='Property'){ ?> | <?=$ad->rooms;?> BHK <?php } ?></h5>
        <h6 class='text-muted'>Posted on <?=$ad->created_at;?></h6>
          
          <span class=" text-muted">
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

    

    <div class="px-3 py-2">
      <div class="row">
        <div class="col-12">
          <hr>
           
           <div>
                  <h3>Information</h3>
               <?=$ad->information;?>
              </div>
           </div>

          
        </div>
      </div>
    </div>
    

    <div class="p-5"></div>
  <div class="fixed-bottom p-3">
      <div class="d-grid">
        
            <button class="btn krishisampark-btn btn-lg text-white"  id='openPopupButton'>Show Number</button>
            <a href="tel:<?=$ad->phone;?>" class="btn krishisampark-btn btn-lg text-white"  id='adNumber' style='display:none'><?=$ad->phone;?></a>
        
      </div>
    </div>
    
    <?php if(count($products)>0){ ?>
    
     <div class="ps-3 py-3 bg-light">
      <div class="d-flex align-items-center justify-content-between mb-3 pe-3">
        <div class="d-flex align-items-center gap-2">
          <div>
            <img src="<?=$baseurl;?>app/img/krishi.png" alt class="img-fluid ch-30 cw-30" />
          </div>
          <div>
            <h5 class="fw-bold mb-0">Our Products</h5>
            <p class="text-muted m-0">check out now</p>
          </div>
        </div>
        <div>
          
        </div>
      </div>
      <div class="px-0">
        <div class="multipleitems">
      <?php foreach ($products as $index => $ad) {
          $pictures = explode(',', $ad->image);
          $picture = $pictures[0];
         
          $activeClass = ($index === 0) ? 'active' : '';
        ?>
          <div class="item pe-3">
            <a href="product-detail?id=<?= $ad->id; ?>" class="text-decoration-none link-dark">
              <div class="card bg-light border-0">
                <div class="product-offer-back">


                  <img src="<?= $baseurl . $picture; ?>" style='height:120px;width:100%' class="img-fluid rounded-md" />

                </div>

                <div class="card-body px-0 pb-0 pt-2">
                  <h5 class="fw-bold mb-0"><?= $ad->title; ?></h5>
                  <p class="text-muted m-0 mt-1 small">₹<?= $ad->price; ?></p>
                </div>
              </div>
            </a>
          </div>

        <?php } ?>
    </div>
      </div>
    </div>
 <div class="p-5"></div>
    
    <?php } ?>
   


<div class="modal" id="myPopup">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Contact Information</h5>
        <button type="button" class="btn krishisampark-btn" id="closePopup" >&times;</button>
      </div>
      <div class="modal-body">
          <div id="error"></div>
        <form id="leadform" style='display:'>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <div class="form-group name">
                                        <input type="text" name="name" value="<?php if(isset($userData->name)) echo $userData->name;?>" id="leadName" class="form-control" placeholder="Name*" aria-label="Full Name" required>
                                    </div>
                                </div>
                               
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <div class="form-group number">
                                        <input type="text" name="phone" value="<?php if(isset($userData->phone)) echo $userData->phone;?>" id="leadPhone" class="form-control" placeholder="Contact Number*" aria-label="Phone Number" required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="send-btn text-center">
                                        <button onclick="submitForm();" id="btnSubmit" type="button" class="btn krishisampark-btn text-white">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
        <p id="popupContent" style='display:none' class='text-bold'></p>
      </div>
    </div>
  </div>
</div>




 <script>
function submitForm() {
    $('#btnSubmit').innerHTML='Submitting...';
    var leadPhone = $('#leadPhone').val();
    var leadName = $('#leadName').val();
    var ad_id=<?=$ad->id;?>;
    if(leadPhone!='' && leadName!=''){
    $.ajax({
      url: "<?=$baseurl;?>ajax/submitLead.php",
      type: "POST",
      data: {
        leadName: leadName,
        leadPhone: leadPhone,
        ad_id:ad_id
      },
      cache: false,
      success: function(dataResult) {
        $('#myPopup').modal('hide');
        $('#adNumber').show();
        $('#openPopupButton').hide();
      }
    });
    }else{
        $('#error').html('<div class="alert alert-danger" role="alert">Please fill required fields.</div>');
    }
  
}



    $(document).ready(function() {
  
  $('#openPopupButton').click(function() {
    
    var phone = <?=$ad->phone;?>;
  
   
    $('#popupContent').text(phone);
    
    
    $('#myPopup').modal('show');
  });
  
   $('#closePopup').click(function() {
    
    $('#myPopup').modal('hide');
  });
});

</script>


    <script
      src="vender/jquery/jquery.min.js"
      type="5432bc89cc64e0020ba1f0ad-text/javascript"
    ></script>
    <script
      src="vender/bootstrap/js/bootstrap.bundle.min.js"
      type="5432bc89cc64e0020ba1f0ad-text/javascript"
    ></script>

    <script
      src="vender/slick/slick/slick.min.js"
      type="5432bc89cc64e0020ba1f0ad-text/javascript"
    ></script>

    <script
      src="vender/sidebar/hc-offcanvas-nav.js"
      type="5432bc89cc64e0020ba1f0ad-text/javascript"
    ></script>

    <script
      src="js/custom.js"
      type="5432bc89cc64e0020ba1f0ad-text/javascript"
    ></script>
    <script
      src="https://askbootstrap.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
      data-cf-settings="5432bc89cc64e0020ba1f0ad-|49"
      defer
    ></script>
    <script
      defer
      src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
      integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
      data-cf-beacon='{"rayId":"7dcef2101b140ffa","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}'
      crossorigin="anonymous"
    ></script>
  </body>
</html>
