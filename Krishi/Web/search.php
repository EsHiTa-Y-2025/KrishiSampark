<?php require('private/header.php');
if(isset($_GET['keyword']) || isset($_GET['city'])){
$categories = get_category($con);

$ads = getSearch($con,$_GET['keyword'],$_GET['city'],$_GET['type']);
?>




<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1>Search results <?=count($ads);?></h1>
            </div>
            
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- Properties section body start -->
<div class="properties-section content-area">
    <div class="container">
        <div class="row"> 
            <?php if(count($ads)>0){ ?>
            <div class="col-lg-8 col-md-12">
                

                <?php 
                
                foreach($ads as $ad){ 
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
                            <?php if($ad->ad_type=='Property'){ ?>
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
                            <?php } else{ ?>
                            
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
              

               
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar-right">
                    
                    <!-- Posts by category start -->
                    <div class="posts-by-category widget">
                        <h3 class="sidebar-title">Business Category</h3>
                        <ul class="list-unstyled list-cat">
                            <?php foreach($categories as $cat){ ?>
                                <li><a href="<?=$baseurl;?>category/<?=$cat->slug;?>"><?=$cat->cat_name;?> </a></li>
                            <?php } ?>
                           
                        </ul>
                    </div>
                    <!-- Helping Center start -->
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
            
            <?php }else { ?>
            <h3>No result found</h3>
            <?php } ?>
        </div>
    </div>
</div>
<?php require('private/footer.php') ; }?>
