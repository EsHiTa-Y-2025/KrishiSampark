<?php 
require('private/header.php');

$userAds = userAnimals($con,$userData->userId);
?>

  <body class="bg-light">

  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0">My Animals</h3>
      </div>
     
    </div>
  </div>
  


    <div class="p-3">
        
         <?php
// Display success message
if (isset($_SESSION['successMsg'])) {
    echo '<div class="m-2"><div class="alert alert-success" role="alert">' . $_SESSION['successMsg'] . '</div></div>';
    unset($_SESSION['successMsg']);
}

// Display error message
if (isset($_SESSION['errorMsg'])) {
    echo '<div class="m-2"><div class="alert alert-danger" role="alert">' . $_SESSION['errorMsg'] . '</div></div>';
    unset($_SESSION['errorMsg']);
}
?>
     
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
                  <a class='btn btn-danger delete-button' data-id="<?=$ad->id;?>">
                        <i class="fa fa-trash"></i>
                    </a>
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
        <?php } }else{ echo "<h2>No animal found</h2>"; } ?>
        
      </div>
    </div>
    <div class='p-3'></div>
    
    <script>
$(document).ready(function() {
    $('.delete-button').on('click', function(e) {
        e.preventDefault();
        var adId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var deleteUrl = 'delete?ad_id=' + adId +'&type=Animal'; // Replace with your delete URL
                window.location.href = deleteUrl; // Redirect to the delete URL
            }
        });
    });
});
</script>

 <?php require('private/footer.php');?>