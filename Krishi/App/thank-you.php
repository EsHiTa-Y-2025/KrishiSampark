<?php require('private/header.php');?>
  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'success');?></h3>
      </div>
      
    </div>
  </div>
  <div class="my-5">
    <div class="text-center">
      <div class="mb-3 px-5"><img src="img/green-tick.png" style='width:200px' class="img-fluid px-5" alt="#"></div>
      <div class="h1 mt-3 text-success mb-1"><?=getLanguageString($con,$lang,'your_service_submitted_successfully');?>!<br><?=getLanguageString($con,$lang,'we_will_approve_after_verify');?></div>
      
    </div>
  </div>

  <div class="d-grid fixed-bottom gap-2 p-3">
    <a href="listing-detail?id=<?=$_GET['id'];?>" class="btn krishisampark-btn text-white btn-lg"><?=getLanguageString($con,$lang,'view_your_service');?></a>
    <a href="add-service" class="btn krishisampark-bg btn-lg  text-white"><?=getLanguageString($con,$lang,'add_more');?></a>
  </div>

 

  <script src="vender/jquery/jquery.min.js" type="2a92c80c2686f8bbe7e31ef8-text/javascript"></script>
  <script src="vender/bootstrap/js/bootstrap.bundle.min.js" type="2a92c80c2686f8bbe7e31ef8-text/javascript"></script>

  <script src="vender/slick/slick/slick.min.js" type="2a92c80c2686f8bbe7e31ef8-text/javascript"></script>

  <script src="vender/sidebar/hc-offcanvas-nav.js" type="2a92c80c2686f8bbe7e31ef8-text/javascript"></script>

  <script src="js/custom.js" type="2a92c80c2686f8bbe7e31ef8-text/javascript"></script>
  <script src="https://askbootstrap.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="2a92c80c2686f8bbe7e31ef8-|49" defer></script>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816" integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw==" data-cf-beacon='{"rayId":"7dcef3102f4973cb","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>
</body>


</html>