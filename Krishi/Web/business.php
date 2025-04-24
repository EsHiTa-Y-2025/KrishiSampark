<?php require('private/header.php');
$business = getBusinessBySlug($con,$_GET['slug']);

if(!is_object($business) && $business==2){
    echo "<script>window.history.back();</script>";
    exit;
}

$pictures = explode(',',$business->pictures);
?>
<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1><?=$business->title;?></h1>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="breadcrumb-area">
                    <ul>
                        <li><a href="<?=$baseurl;?>">Home</a></li>
                        <li><span>/</span><?=$business->title;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->


<!-- Properties details page start -->
<div class="properties-details-page content-area-17">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12">
                <div class="properties-details-section">
                    <!-- Heading properties start -->
                    <div class="heading-properties-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <h3><?=$business->title;?>
                                    <?php if($business->is_verified){ ?>
                                    <img src="<?=$baseurl;?>img/verified.png" title='Verified' style="width:17px;margin-bottom:5px"></a>
                                    <?php }  if($business->is_plus){ ?>
                                     <a class='text-danger p-1 mt-3' style='font-size:13px'><i class='fa fa-plus'></i> Plus Member</a>
                                <?php }  if($business->is_trusted){ ?>
                                    <a class='text-success p-1 mt-3' style='font-size:13px'><i class='fa fa-handshake-o'></i> Trusted</a>
                                <?php } ?>
                                    </h3>
                                    
                                    <p><i class="fa fa-map-marker"></i> <?=$business->city_name.' '.$business->state_name;?></p>
                                </div>
                                <div class="pull-right">
                                    <h3 class="text-right">₹<?=$business->price;?></h3>
                                    <!--<p>$9350/SqFt</p>-->
                                </div>

                            </div>
                            <div class="pull-left mt-3">
                                    <button class='btn btn-success' id='openPopupButton'><i class='fa fa-phone'></i> Show Number</button>
                                </div>
                        </div>
                    </div>
                    <!-- Heading properties end -->

                    <!-- Properties slider section start -->
                    <div class="properties-slider-section">
                        <div class="slider slider-for">
                            <?php for($i=0;$i<count($pictures);$i++){ ?>
                                <div><img src="<?=$baseurl.$pictures[$i];?>" style="height:500px" class="w-100 img-fluid" alt="photo"></div>
                            <?php } ?>
                        </div>
                        <div class="slider slider-nav mt-2">
                           <?php for($i=0;$i<count($pictures);$i++){ ?>
                                <div><img src="<?=$baseurl.$pictures[$i];?>"  style="height:100px"  class="w-100 img-fluid" alt="photo"></div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Properties slider section end -->

                    <!-- Tabbing box start -->
                    <div class="tabbing tabbing-box mb-40">
                        <!--<ul class="nav nav-tabs" id="myTab" role="tablist">-->
                        <!--    <li class="nav-item" role="presentation">-->
                        <!--        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Description</button>-->
                        <!--    </li>-->
                        <!--    <li class="nav-item" role="presentation">-->
                        <!--        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Floor Plans</button>-->
                        <!--    </li>-->
                        <!--    <li class="nav-item" role="presentation">-->
                        <!--        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Details</button>-->
                        <!--    </li>-->
                        <!--    <li class="nav-item" role="presentation">-->
                        <!--        <button class="nav-link" id="contact-tab-5" data-bs-toggle="tab" data-bs-target="#contact-5" type="button" role="tab" aria-controls="contact-5" aria-selected="false">Location</button>-->
                        <!--    </li>-->
                        <!--    <li class="nav-item" role="presentation">-->
                        <!--        <button class="nav-link" id="contact-tab-6" data-bs-toggle="tab" data-bs-target="#contact-6" type="button" role="tab" aria-controls="contact-6" aria-selected="false">Video</button>-->
                        <!--    </li>-->
                        <!--    <li class="nav-item" role="presentation">-->
                        <!--        <button class="nav-link" id="contact-tab-4" data-bs-toggle="tab" data-bs-target="#contact-4" type="button" role="tab" aria-controls="contact-4" aria-selected="false">Similar Properties</button>-->
                        <!--    </li>-->
                        <!--</ul>-->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="accordion accordion-flush" id="accordionFlushExample7">
                                    <div class="accordion-item">
                                        <div class="properties-description mb-50">
                                            <h3 class="heading-2">
                                                Information
                                            </h3>
                                            <p><?=$business->information;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            
                           
                            
                        </div>
                    </div>
                  
                    <!-- Contact 1 start -->
                    <div class="contact-1 mb-50">
                        <h3 class="heading">Enquire Now</h3>
                        <form id="contact_form" action="" method="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group name">
                                        <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Full Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group email">
                                        <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group number">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone" aria-label="Phone Number">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group message">
                                        <textarea  class="form-control" name="message" placeholder="Write message" aria-label="Write message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="send-btn">
                                        <button type="submit" class="btn-4 btn-round-3">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Contact 1 end -->
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar-right">
                    <!-- Advanced search start -->
                    <div class="widget advanced-search">
                        <h3 class="sidebar-title">Address</h3>
                        <p><?=$business->address.' '.$business->city_name.' '.$business->state_name;?></p>
                        <h3 class="sidebar-title">Mode Of Payment</h3>
                        <p><?=$business->mode_of_payment;?></p>
                        <h3 class="sidebar-title">Timings</h3>
                        <p><?=$business->open_time;?></p>
                        <h3 class="sidebar-title">Established In</h3>
                        <p><?=$business->est_year;?></p>
                    </div>
                   
                    
                    <div class="widget helping-center">
                        <h3 class="sidebar-title">Helping Center</h3>
                        <ul class="contact-link">
                            <li>
                                <i class="flaticon-location"></i>
                                Dharwad, Hubbali
                            </li>
                            <li>
                                <i class="flaticon-technology-1"></i>
                                <a href="tel:+919738207273">
                                    +91 9738207273
                                </a>
                            </li>
                            <li>
                                <i class="flaticon-envelope"></i>
                                <a href="mailto:connect@landsbazzar.com">
                                    connect@landsbazzar.com
                                </a>
                            </li>
                        </ul>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Popup -->
<div class="modal" id="myPopup">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Contact Information</h5>
        <button type="button" class="btn btn-danger" id="closePopup" >&times;</button>
      </div>
      <div class="modal-body">
          <div id="error"></div>
        <form id="leadform" style='display:'>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <div class="form-group name">
                                        <input type="text" name="name" id="leadName" class="form-control" placeholder="Name*" aria-label="Full Name" required>
                                    </div>
                                </div>
                               
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <div class="form-group number">
                                        <input type="text" name="phone" id="leadPhone" class="form-control" placeholder="Contact Number*" aria-label="Phone Number" required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="send-btn">
                                        <button onclick="submitForm();" id="btnSubmit" type="button" class="btn-4 btn-round-3">Submit</button>
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
    var ad_id=<?=$business->id;?>;
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
        $('#leadform').hide();
        $('#popupContent').show();
      }
    });
    }else{
        $('#error').html('<div class="alert alert-danger" role="alert">Please fill required fields.</div>');
    }
  
}



    $(document).ready(function() {
  
  $('#openPopupButton').click(function() {
    
    var phone = <?=$business->phone;?>;
  
   
    $('#popupContent').text(phone);
    
    
    $('#myPopup').modal('show');
  });
  
   $('#closePopup').click(function() {
    
    $('#myPopup').modal('hide');
  });
});

</script>

<?php require('private/footer.php');?>
