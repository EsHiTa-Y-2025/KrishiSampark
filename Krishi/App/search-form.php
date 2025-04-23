<?php require('private/header.php');
$cities = getCitiesByState($con,2);

$categories = get_category($con);
?>
<style>
  .form-check-input[type="radio"] {
    width: 16px;
    height: 16px;
    margin-right: 5px;
    appearance: none;
    border: 2px solid #ccc;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
  }

  .form-check-input[type="radio"]:checked {
    background-color: #000;
  }
</style>

  <body class="bg-light">
  <div class="bg-white shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="gap-3 d-flex align-items-center">
          <a href="main"
            ><i class="bi bi-arrow-left d-flex landsbazzar-text h2 m-0 back-page"></i
          ></a>
          <h3 class="fw-bold m-0">Filter</h3>
        </div>
      </div>
    </div>
    
    <div>  
    
    <div class="p-3">
      
        
       <div class="relevance-back mb-3 ">
           <h4>I am looking for</h4>
        <div class="relevance-scroll d-flex gap-2">
        <div class="">
        <input type="radio" class="btn-check" name="property_type" value="Buy" id="btnradio1" <?php if(isset($_GET['property_type'])) if($_GET['property_type']=='Buy') echo "checked"; ?>>
        <label class="btn landsbazzar-outline-btn-1 btn rounded" for="btnradio1"><i class="fa fa-home" style='font-size:13px'></i> Buy</label>
        </div>
        <div class="">
        <input type="radio" class="btn-check" name="property_type" value="Rent" id="btnradio2" <?php if(isset($_GET['property_type'])) if($_GET['property_type']=='Rent') echo "checked"; ?>>
        <label class="btn landsbazzar-outline-btn-1 btn rounded" for="btnradio2"><i class="fa fa-search"  style='font-size:13px'></i> Rent</label>
        </div>
        <div class="">
        <input type="radio" class="btn-check" name="property_type" value="Commercial" id="btnradio3" <?php if(isset($_GET['property_type'])) if($_GET['property_type']=='Commercial') echo "checked"; ?>>
        <label class="btn landsbazzar-outline-btn-1 btn rounded" for="btnradio3"><span><i class="fa fa-building"  style='font-size:13px'></i> Commercial</label>
        </div>
         <div class="">
        <input type="radio" class="btn-check" name="property_type" value="Plots" id="btnradio4" <?php if(isset($_GET['property_type'])) if($_GET['property_type']=='Plots') echo "checked" ;?>>
        <label class="btn landsbazzar-outline-btn-1 btn rounded" for="btnradio4"><span><i class="fa fa-bar-chart"  style='font-size:13px'></i> Plots</label>
        </div>
        </div>
        </div>
     
    </div>
    
    
    
    <div class="p-3">
<label class="form-label h3">Choose city</label>
        <?php foreach($cities as $city) { ?>
          <div class="form-check">
            <input type="radio" class="form-check-input" name="city" id="city<?=$city->id;?>" value="<?=$city->id;?>" required>
            <label class="form-check-label h3" for="city<?=$city->id;?>"><?=$city->city_name;?></label>
          </div>
          <?php } ?>
          
          <!--<h2>Bedrooms</h2>-->
        
          <!--<div class="form-check">-->
          <!--  <input type="radio" class="form-check-input" name="rooms" id="rooms1" value="1">-->
          <!--  <label class="form-check-label h3" for="rooms1">1 BHK</label>-->
          <!--</div>-->
          
          <!--<div class="form-check">-->
          <!--  <input type="radio" class="form-check-input" name="rooms" id="rooms2" value="2">-->
          <!--  <label class="form-check-label h3" for="rooms2">2 BHK</label>-->
          <!--</div>-->
          
          <!--<div class="form-check">-->
          <!--  <input type="radio" class="form-check-input" name="rooms" id="rooms3" value="3">-->
          <!--  <label class="form-check-label h3" for="rooms3">3 BHK</label>-->
          <!--</div>-->
          
          <!--<div class="form-check">-->
          <!--  <input type="radio" class="form-check-input" name="rooms" id="rooms4" value="4">-->
          <!--  <label class="form-check-label h3" for="rooms4">4 BHK</label>-->
          <!--</div>-->
          
          <div class="mb-0 mt-3">
            <label class="form-label h3">Bedrooms</label>
            <div class="d-flex gap-2">
            <input type="radio" class="btn-check" name="rooms" id="room1" value="1" >
            <label class="btn landsbazzar-outline-btn-1 btn-sm " style='width:100px;'  for="room1">1 BHK</label>
            <input type="radio" class="btn-check" name="rooms" id="room2" value="2">
            <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100px;'  for="room2">2 BHK</label>
            <input type="radio" class="btn-check" name="rooms" id="room3" value="3">
            <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100px;'  for="room3">3 BHK</label>
            <input type="radio" class="btn-check" name="rooms" id="room4" value="4">
            <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100px;'  for="room4">4 BHK</label>
            </div>
            </div>
            
            <div class="mb-0 mt-3">
            <label class="form-label h3">Bathrooms</label>
            <div class="d-flex gap-2">
            <input type="radio" class="btn-check " name="bathrooms" id="bathrooms1" value="1" >
            <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:80px' for="bathrooms1">1</label>
            <input type="radio" class="btn-check" name="bathrooms" id="bathrooms2" value="2">
            <label class="btn landsbazzar-outline-btn-1 btn-sm"  style='width:80px' for="bathrooms2">2</label>
            <input type="radio" class="btn-check" name="bathrooms" id="bathrooms3" value="3">
            <label class="btn landsbazzar-outline-btn-1 btn-sm"  style='width:80px' for="bathrooms3">3</label>
            <input type="radio" class="btn-check" name="bathrooms" id="bathrooms4" value="4">
            <label class="btn landsbazzar-outline-btn-1 btn-sm"  style='width:80px' for="bathrooms4">4 </label>
            </div>
            </div>
            
            
            <div class="mb-0 mt-3">
            <label class="form-label h3">Possession</label>
            <div class="d-flex gap-2">
                <input type="radio" class="btn-check " name="possession" id="possession" value="Ready to move" >
                <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100%' for="possession">Ready to move</label>
                <input type="radio" class="btn-check" name="possession" id="possession1" value="In 1 year">
                <label class="btn landsbazzar-outline-btn-1 btn-sm"  style='width:100%' for="possession1">In 1 year</label>
                 <input type="radio" class="btn-check" name="possession" id="possession2" value="In 2 years">
                <label class="btn landsbazzar-outline-btn-1 btn-sm"  style='width:100%' for="possession2">In 2 years</label>
                 <input type="radio" class="btn-check" name="possession" id="possession3" value="In 3 years">
                <label class="btn landsbazzar-outline-btn-1 btn-sm"  style='width:100%' for="possession3">In 3 years</label>
            </div>
            </div>
            
            <div class="mb-0 mt-3">
            <label class="form-label h3">Facing</label>
            <div class="d-flex gap-2">
                <input type="radio" class="btn-check " name="facing" id="facing" value="North-West" >
                <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100%' for="facing">North-West</label>
                <input type="radio" class="btn-check " name="facing" id="facing1" value="South-East" >
                <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100%' for="facing1">South-East</label>
                <input type="radio" class="btn-check " name="facing" id="facing2" value="South-West" >
                <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100%' for="facing2">South-West</label>
                <input type="radio" class="btn-check " name="facing" id="facing3" value="North-East" >
                <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100%' for="facing3">North-East</label>
            </div>
            </div>
            
            <div class="mb-0 mt-3">
            <label class="form-label h3">Listed By</label>
            <div class="d-flex gap-2">
                <input type="radio" class="btn-check " name="listed_by" id="Agent" value="Agent" >
                <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100%' for="Agent">Agent</label>
                <input type="radio" class="btn-check " name="listed_by" id="Owner" value="Owner" >
                <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100%' for="Owner">Owner</label>
                <input type="radio" class="btn-check " name="listed_by" id="Builder" value="Builder" >
                <label class="btn landsbazzar-outline-btn-1 btn-sm" style='width:100%' for="Builder">Builder</label>
                
            </div>
            </div>
            
            <div class="mb-0 mt-3">
            <label class="form-label h3">Budget</label>
            <div class="d-flex gap-2">
            <select class="form-control" name="budget_min">
                <option value="100000">₹1 Lac</option>
                <option value="200000">₹2 Lac</option>
                <option value="300000">₹3 Lac</option>
                <option value="400000">₹4 Lac</option>
                <option value="500000">₹5 Lac</option>
            </select>
            <select class="form-control" name="budget_max">
                <option value="1000000">₹10 Lac</option>
                <option value="2000000">₹20 Lac</option>
                <option value="3000000">₹30 Lac</option>
                <option value="4000000">₹40 Lac</option>
                <option value="5000000">₹50 Lac</option>
                
            </select>
            
            </div>
            </div>
        
          
   </div>


    
  <div class="p-5"></div>

    <div class="fixed-bottom p-3">
      <div class="d-grid">
        <button type="button" id="submit-btn" class="btn landsbazzar-bg1 btn-lg">Search</button>
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
