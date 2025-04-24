<?php require('private/header.php');
$checkLogin = check_user_login($con);

$userAds = userAds($con,$userData->userId);
?>

<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1>My Account</h1>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="breadcrumb-area">
                    <ul>
                        <li><a href="<?=$baseurl;?>">Home</a></li>
                        <li><span>/</span>My Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- My profile start -->
<div class="my-profile content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
               
               
               <?php $myAds='active'; require('private/accountSidebar.php');?>
               
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <?php
// Display success message
if (isset($_SESSION['successMsg'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['successMsg'] . '</div>';
    unset($_SESSION['successMsg']);
}

// Display error message
if (isset($_SESSION['errorMsg'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMsg'] . '</div>';
    unset($_SESSION['errorMsg']);
}
?>
                 <div class="my-address">
                     <div class="my-properties">
                         
                         <?php
                         if(count($userAds)>0){
                        ?>
                         <table class="manage-table">
                             <thead>
                             <tr>
                                 <th>My Properties</th>
                                 <th></th>
                                 <th>Date</th>
                                 <th>Actions</th>
                             </tr>
                             </thead>
                             <tbody class="responsive-table">
                                 <?php
                                  foreach($userAds as $ad){ 
                         $pictures = explode(',',$ad->pictures);
                         
                         $picture=$pictures[0];
                         ?>
                             <tr>
                                 <td class="listing-photoo h-pt-0">
                                     <a href="<?=$baseurl;?>property/<?=$ad->slug;?>"><img alt="" src="<?=$picture;?>" class="img-fluid"></a>
                                 </td>
                                 <td class="title-container">
                                     <h5><a href="<?=$baseurl;?>property/<?=$ad->slug;?>"><?=$ad->title;?></a>
                                      <?php if($ad->is_verified){ ?>
                                    <img src="img/verified.png" style="width:17px;margin-bottom:5px"></a>
                                    <?php } ?>
                                     </h5>
                                     <h6></h6>
                                     <p><i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i> <?=$ad->address.'<br>'.$ad->city_name.', '.$ad->state_name;?> </p>
                                 </td>
                                 <td class="date">
                                     <?=$ad->date;?>
                                 </td>
                                 <td class="action">
                                     <ul>
                                         <li>
                                             <a href="#"><i class="fa fa-pencil"></i> Edit</a>
                                         </li>
                                         
                                         <li>
                                             <a onclick="deleteListing(<?=$ad->id;?>)" class="delete"><i class="fa fa-remove"></i> Delete</a>
                                         </li>
                                     </ul>
                                 </td>
                             </tr>
                             <?php } ?>
                             </tbody>
                         </table>
<?php }else{ echo "No ads"; }?>
                        
                     </div>
                 </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    function deleteListing(id){
        
         $.ajax({
          url: 'ajax/deleteListing.php', 
          type: 'POST',
          data: { ad_id: id }, 
          success: function (response) {
            location.reload()
          },
          error: function (xhr, status, error) {
            console.log(error)
          }
        });
    }
</script>

<?php require('private/footer.php');?>