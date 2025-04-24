<?php require('private/header.php');
$categoriesData = getCategoriesAndSubcategories($con);
$categories=get_sub_category($con,'DESC');
$ads = showAllAds($con,'Business');
?>



<div class="services-2 content-area-11 mt-5">
    <div class="container">
        <!-- Main title -->
        <div class="main-title-4">
            <h1>Our <span>Business Categories</span></h1>
        </div>
            
     
<?php if (!empty($categoriesData)) : ?>
<?php foreach ($categoriesData as $category) : ?>
        <div class="row">
            
            <div class="mb-3 mt-2">
                        <h3 class="fw-bold mb-0"><?= $category['category_name'] ?></h3>
                    </div>
                    <hr>
             <?php if (!empty($category['subcategories'])) : ?>
                    <?php foreach ($category['subcategories'] as $subcategory) : ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="team-2 df-box">
                    <div class="team-photo">
                        <a href="<?=$baseurl;?>category/<?=$subcategory['subcat_slug'];?>">
                            <img src="<?= $subcategory['subcat_icon'] ?>" style='width:100px;height:100px' class="img-fluid">
                        </a>
                    </div>
                    <div class="team-details">

                        <p><?= $subcategory['subcat_name'] ?></p>
                    </div>
                </div>
            </div>
             <?php endforeach; ?>
                <?php else : ?>
                <div>
                 <p>No record found</p>
                    </div>
                <?php endif; ?>
                
                </div>
 <?php endforeach; ?>
    <?php else : ?>
        <p>No categories or subcategories found.</p>
    <?php endif; ?>
    </div>
</div>




<!-- Properties section body start -->
<div class="properties-section content-area" style='margin-top:-120px'>
    
    
 <div class="main-title-4">
            <h1>Business Listings</h1>
        </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                
                <?php foreach($ads as $ad){ 
                 $pictures = explode(',',$ad->pictures);
                         
                         $picture=$pictures[0];
                         
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

                ?>
                
                <div class="property-box-2">
                    <div class="row g-0">
                        <div class="col-lg-4 col-md-4">
                            <div class="property-thumbnail">
                                <a href="<?=$baseurl;?>business/<?=$ad->slug;?>" class="property-img">
                                    <div class="property-overflow">
                                        <img src="<?=$picture;?>" alt="" class="img-fluid">
                                    </div>
                                    <?php if($ad->is_featured){ ?>
                                    <div class="listing-badges">
                                        <span class="featured">Featured</span>
                                    </div>
                                    <?php } ?>
                            
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                             <div class="detail">
                                <h3 class="title">
                                    <a href="<?=$baseurl;?>business/<?=$ad->slug;?>"><?=$ad->title;?></a>
                                    <?php if($ad->is_verified){ ?>
                                    <img src="<?=$baseurl;?>img/verified.png" style="width:17px;margin-bottom:5px"></a>
                                    <?php } ?>
                                </h3>
                                <p class="location">
                                    <a href="">
                                        <i class="flaticon-location"></i><?=$ad->address.' '.$ad->city_name.' '.$ad->state_name;?>
                                    </a>
                                    <br>
                                    <?=substr($ad->information,0,100).'....';?></p>
                                <p>Established on <?=$ad->est_year;?></p>
                               
                            </div>
                            <div class="footer clearfix">
                                <div class="float-start agent">
                                    <div class="agent">
                                        <div class="user">
                                            <a href="#">
                                                <img src="<?=$baseurl;?>img/user.png" alt="avatar">
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
              

                <!-- Page navigation start -->
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
                <!-- Page navigation end-->
            </div>
            <?php require('private/listingSidebar.php');?>
        </div>
    </div>
</div>
<!-- Properties section body end -->
<?php require('private/footer.php');?>
