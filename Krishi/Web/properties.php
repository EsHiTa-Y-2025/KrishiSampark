<?php require('private/header.php');
$categories=get_sub_category($con,'DESC');

$ads = showAllAds($con,'Property');
?>


<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1>All Properties</h1>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="breadcrumb-area">
                    <ul>
                        <li><a href="<?=$baseurl;?>">Home</a></li>
                        <li><span>/</span>Properties</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- Properties section body start -->
<div class="properties-section content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <!-- Option bar start -->
                <!--<div class="option-bar">-->
                <!--    <div class="row">-->
                <!--        <div class="col-lg-6 col-md-5 col-sm-5">-->
                <!--            <div class="sorting-options">-->
                <!--                <span class="title">View as:</span>-->
                <!--                <a href="list-view.html" class="change-view-btn active-view-btn"><i class="fa fa-th-list"></i></a>-->
                <!--                <a href="grid-view.html" class="change-view-btn"><i class="fa fa-th-large"></i></a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="col-lg-6 col-md-7 col-sm-7">-->
                <!--            <div class="sorting-options2 d-flex">-->
                <!--                <span class="title">Order by:</span>-->
                <!--                <div class="sorting">-->
                <!--                    <select class="selectpicker search-fields" name="all-status">-->
                <!--                        <option>Price High to Low</option>-->
                <!--                        <option>Price: Low to High</option>-->
                <!--                        <option>Newest Properties</option>-->
                <!--                        <option>Oldest Properties</option>-->
                <!--                    </select>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!-- Option bar end -->

                <?php foreach($ads as $ad){ 
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
                
                <div class="property-box-2">
                    <div class="row g-0">
                        <div class="col-lg-4 col-md-4">
                            <div class="property-thumbnail">
                                <a href="<?=$baseurl;?>property/<?=$ad->slug;?>" class="property-img">
                                    <div class="property-overflow">
                                        <img src="<?=$picture;?>" alt="" class="img-fluid">
                                    </div>
                                     <?php if($ad->is_featured){ ?>
                                    <div class="listing-badges">
                                        <span class="featured">Featured</span>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="listing-badges">
                                        <span class="featured"><?=$ad->status_type;?></span>
                                    </div>
                                    <?php } ?>
                            
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="detail">
                                <h3 class="title">
                                    <a href="<?=$baseurl;?>property/<?=$ad->slug;?>"><?=$ad->title;?> 
                                    <?php if($ad->is_verified){ ?>
                                    <img src="img/verified.png" style="width:17px;margin-bottom:5px"></a>
                                    <?php } ?>
                                </h3>
                                <p class="location">
                                    <a href="">
                                        <i class="flaticon-location"></i><?=$ad->address.' '.$ad->city_name.' '.$ad->state_name;?>
                                    </a>
                                </p>
                                <ul class="facilities-list clearfix">
                                    <li>
                                        <i class="flaticon-furniture"></i>  <?=$ad->rooms;?>
                                    </li>
                                    <li>
                                        <i class="flaticon-holidays"></i>  <?=$ad->bathrooms;?>
                                    </li>
                                    <li>
                                        <i class="flaticon-square"></i> <?=$ad->area;?>  Sq Ft
                                    </li>
                                     <li>
                                        <i class="fa fa-rupee"></i> <?=$ad->price;?>
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="footer clearfix">
                                <div class="float-start agent">
                                    <div class="agent">
                                        <div class="user">
                                            <a href="#">
                                                <img src="img/user.png" alt="avatar">
                                            </a>
                                        </div>
                                        <div class="user-name">
                                            <p><a href="#"><?=$ad->name;?></a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-end days">
                                    <p><i class="flaticon-time"></i> <?=$time;?> ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
              

                
                <!--<div class="pagination-box hidden-mb-45 text-center">-->
                <!--    <nav aria-label="Page navigation example">-->
                <!--        <ul class="pagination">-->
                <!--            <li class="page-item">-->
                <!--                <a class="page-link" href="#"><i class="fa fa-angle-left"></i></a>-->
                <!--            </li>-->
                <!--            <li class="page-item"><a class="page-link active" href="#">1</a></li>-->
                <!--            <li class="page-item"><a class="page-link" href="#">2</a></li>-->
                <!--            <li class="page-item"><a class="page-link" href="#">3</a></li>-->
                <!--            <li class="page-item">-->
                <!--                <a class="page-link" href="#"><i class="fa fa-angle-right"></i></a>-->
                <!--            </li>-->
                <!--        </ul>-->
                <!--    </nav>-->
                <!--</div>-->
               
            </div>
                        <?php require('private/listingSidebar.php');?>

        </div>
    </div>
</div>
<!-- Properties section body end -->
<?php require('private/footer.php');?>
