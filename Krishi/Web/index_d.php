<?php include 'private/header.php';
$categories = get_category($con);
$ads = showFeaturedAds($con, 'Property');
$featuredBusiness = showFeaturedAds($con, 'Business');
$recentAds = showRecentAds($con, 'Property');
$trustedAds = showTrustedAds($con,'Property');
$cities = getCities($con);
$blogs = getBlogs($con,$limit=6);
?>

<!-- Banner start -->
<div class="banner" id="banner3">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item item-bg active">
                <img class="d-block w-100 h-100" src="https://clv.h-cdn.co/assets/17/16/4000x2250/hd-aspect-1492708131-austin-home-slide-opener.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex h-100 text-start">
                    <div class="carousel-content container align-self-center">
                        <div class="banner-info2">
                            <div class="text-center infos">
                                <h2 class="text-uppercase">All Your Property Need</h2>
                                <p>India's Trusted Property Selling Platform</p>
                                <div class="banner-btn">
                                    <a href="#" class="btn-4">Get Started Now</a>
                                </div>
                                <div class="tabbing tab-btn banner-tab-btn">
                                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" onclick="setType('For Sale')" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Buy</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" onclick="setType('For Rent')" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Rent</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" onclick="setType('Commercial')" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Commercial</button>
                                        </li>


                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" onclick="setType('Plot')" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Plot</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active">
                                            <div class="accordion accordion-flush" id="accordionFlushExample7">
                                                <div class="inline-search-area">
                                                    <form method="GET" action="search">
                                                        <input type="hidden" value="For Sale" name="type" id="type">
                                                        <div class="row">

                                                            <div class="col-lg-8 col-md-12 col-sm-12 search-col">
                                                                <div class="form-group">
                                                                    <input type="text" name="keyword" class="form-control" placeholder="Enter Keyword">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2 col-md-6 col-sm-6 search-col">
                                                                <div class="form-group">
                                                                    <select class="selectpicker search-fields" name="city">
                                                                        <option disabled>Choose city</option>
                                                                        <?php foreach ($cities as $city) { ?>
                                                                            <option value="<?= $city->id; ?>"><?= $city->city_name; ?></option>
                                                                        <?php } ?>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2 col-md-6 col-sm-6 search-col sc2">
                                                                <div class="form-group">
                                                                    <button type="submit" class="search-button">Search</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="search-section ss2 search-area-3 d-lg-none d-xl-none" id="search-area-4">
    <div class="container">
        <div class="search-section-area ssa">
            <form method="GET" action="search">
                <div class="row">
                    <input type="hidden" value="For Sale" name="type" id="type">
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Enter Keyword">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="form-group">
                            <select class="selectpicker search-fields" name="city">
                                <option disabled>Choose city</option>
                                <?php foreach ($cities as $city) { ?>
                                    <option value="<?= $city->id; ?>"><?= $city->city_name; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="form-group">
                            <button class="search-button-black">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="featured-properties content-area-9 comon-slick mt-5">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Featured <span>Properties</span></h1>
        </div>
        <div class="slick row comon-slick-inner csi2 wow fadeInUp delay-04s" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>

            <?php


            foreach ($ads as $ad) {

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




            ?>
                <div class="item slide-box">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a class="property-img">
                                <div class="listing-time opening"><?= $ad->status_type; ?></div>

                                <div class="property-overflow">
                                    <img class="" style='width:100%;height:250px' src="<?= $picture; ?>" alt="properties">
                                </div>
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="<?= $baseurl; ?>property/<?= $ad->slug; ?>"><?= $ad->title; ?></a>
                            </h1>
                            <div class="location">
                                <a>
                                    <i class="fa fa-map-marker"></i> <?= $ad->city_name . ' ' . $ad->state_name; ?>
                                </a>
                            </div>
                            <ul class="facilities-list clearfix">
                                <li>
                                    <i class="flaticon-furniture"></i> <?= $ad->rooms; ?> Bedrooms
                                </li>
                                <li>
                                    <i class="flaticon-holidays"></i> <?= $ad->bathrooms; ?> Bathrooms
                                </li>
                                <li>
                                    <i class="flaticon-square"></i> Sq Ft:<?= $ad->area; ?>
                                </li>
                                <li>
                                    <i class="fa fa-rupee"></i> <?= $ad->price; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="footer clearfix">
                            <div class="pull-left agent">
                                <div class="agent">
                                    <div class="user">
                                        <a href="#">
                                            <img src="img/user.png" alt="avatar">
                                        </a>
                                    </div>
                                    <div class="user-name">
                                        <p><a href="#"><?= $ad->name; ?></a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right days">
                                <p><i class="flaticon-time"></i> <?= $time; ?> ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <!--<div class="text-center">-->
        <!--    <a href="<?= $baseurl; ?>properties" class="button btn-3">-->
        <!--        Browse More Properties-->
        <!--    </a>-->
        <!--</div>-->
    </div>
</div>




<div class="featured-properties content-area-9 comon-slick mt-2">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Featured <span>Businessess</span></h1>
        </div>
        <div class="slick row comon-slick-inner csi2 wow fadeInUp delay-04s" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>

            <?php


            foreach ($featuredBusiness as $ad) {

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




            ?>
                <div class="item slide-box">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a class="property-img">
                                <?php if ($ad->is_featured) { ?>
                                    <div class="listing-time opening">
                                        Featured
                                    </div>
                                <?php } ?>

                                <div class="property-overflow">
                                    <img class="" style='width:100%;height:250px' src="<?= $picture; ?>" alt="properties">
                                </div>
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="<?= $baseurl; ?>business/<?= $ad->slug; ?>"><?= $ad->title; ?></a>
                            </h1>
                            <p class="location">
                                <a href="">
                                    <i class="flaticon-location"></i> <?= $ad->city_name . ' ' . $ad->state_name; ?>
                                </a>
                            </p>
                            <b><?= substr($ad->information, 0, 100) . '....'; ?></b>

                        </div>
                        <div class="footer clearfix">
                            <div class="pull-left agent">
                                <div class="agent">
                                    <div class="user">
                                        <a href="#">
                                            <img src="img/user.png" alt="avatar">
                                        </a>
                                    </div>
                                    <div class="user-name">
                                        <p><a href="#"><?= $ad->name; ?></a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right days">
                                <p><i class="flaticon-time"></i> <?= $time; ?> ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <!--<div class="text-center">-->
        <!--    <a href="<?= $baseurl; ?>properties" class="button btn-3">-->
        <!--        Browse More Properties-->
        <!--    </a>-->
        <!--</div>-->
    </div>
</div>

<div class="featured-properties content-area-9 comon-slick mt-5">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Trusted <span>Properties</span></h1>
        </div>
        <div class="slick row comon-slick-inner csi2 wow fadeInUp delay-04s" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>

            <?php


            foreach ($trustedAds as $ad) {

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




            ?>
                <div class="item slide-box">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a class="property-img">
                                <div class="listing-time opening"><?= $ad->status_type; ?></div>

                                <div class="property-overflow">
                                    <img class="" style='width:100%;height:250px' src="<?= $picture; ?>" alt="properties">
                                </div>
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="<?= $baseurl; ?>property/<?= $ad->slug; ?>"><?= $ad->title; ?></a>
                            </h1>
                            <div class="location">
                                <a>
                                    <i class="fa fa-map-marker"></i> <?= $ad->city_name . ' ' . $ad->state_name; ?>
                                </a>
                            </div>
                            <ul class="facilities-list clearfix">
                                <li>
                                    <i class="flaticon-furniture"></i> <?= $ad->rooms; ?> Bedrooms
                                </li>
                                <li>
                                    <i class="flaticon-holidays"></i> <?= $ad->bathrooms; ?> Bathrooms
                                </li>
                                <li>
                                    <i class="flaticon-square"></i> Sq Ft:<?= $ad->area; ?>
                                </li>
                                <li>
                                    <i class="fa fa-rupee"></i> <?= $ad->price; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="footer clearfix">
                            <div class="pull-left agent">
                                <div class="agent">
                                    <div class="user">
                                        <a href="#">
                                            <img src="img/user.png" alt="avatar">
                                        </a>
                                    </div>
                                    <div class="user-name">
                                        <p><a href="#"><?= $ad->name; ?></a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right days">
                                <p><i class="flaticon-time"></i> <?= $time; ?> ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <!--<div class="text-center">-->
        <!--    <a href="<?= $baseurl; ?>properties" class="button btn-3">-->
        <!--        Browse More Properties-->
        <!--    </a>-->
        <!--</div>-->
    </div>
</div>

<div class="counters">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInLeft delay-04s">
                <div class="counter-box d-flex">
                    <div class="icon">
                        <i class="flaticon-tag"></i>
                    </div>
                    <div class="detail">
                        <h1 class="counter">967</h1>
                        <p>Listings For Sale</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInLeft delay-04s">
                <div class="counter-box d-flex">
                    <div class="icon">
                        <i class="flaticon-business"></i>
                    </div>
                    <div class="detail">
                        <h1 class="counter">1276</h1>
                        <p>Listings For Rent</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInRight delay-04s">
                <div class="counter-box d-flex">
                    <div class="icon">
                        <i class="flaticon-people"></i>
                    </div>
                    <div class="detail">
                        <h1 class="counter">396</h1>
                        <p>Agents</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInRight delay-04s">
                <div class="counter-box d-flex">
                    <div class="icon">
                        <i class="flaticon-people-1"></i>
                    </div>
                    <div class="detail">
                        <h1 class="counter">177</h1>
                        <p>Brokers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="featured-properties content-area-9 comon-slick mt-5">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Recent <span>Properties</span></h1>
        </div>
        <div class="slick row comon-slick-inner csi2 wow fadeInUp delay-04s" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>

            <?php


            foreach ($recentAds as $ad) {

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




            ?>
                <div class="item slide-box">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a class="property-img">
                                <div class="listing-time opening"><?= $ad->status_type; ?></div>

                                <div class="property-overflow">
                                    <img class="" style='width:100%;height:250px' src="<?= $picture; ?>" alt="properties">
                                </div>
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="<?= $baseurl; ?>property/<?= $ad->slug; ?>"><?= $ad->title; ?></a>
                            </h1>
                            <div class="location">
                                <a>
                                    <i class="fa fa-map-marker"></i> <?= $ad->city_name . ' ' . $ad->state_name; ?>
                                </a>
                            </div>
                            <ul class="facilities-list clearfix">
                                <li>
                                    <i class="flaticon-furniture"></i> <?= $ad->rooms; ?> Bedrooms
                                </li>
                                <li>
                                    <i class="flaticon-holidays"></i> <?= $ad->bathrooms; ?> Bathrooms
                                </li>
                                <li>
                                    <i class="flaticon-square"></i> Sq Ft:<?= $ad->area; ?>
                                </li>
                                <li>
                                    <i class="fa fa-rupee"></i> <?= $ad->price; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="footer clearfix">
                            <div class="pull-left agent">
                                <div class="agent">
                                    <div class="user">
                                        <a href="#">
                                            <img src="img/user.png" alt="avatar">
                                        </a>
                                    </div>
                                    <div class="user-name">
                                        <p><a href="#"><?= $ad->name; ?></a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right days">
                                <p><i class="flaticon-time"></i> <?= $time; ?> ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="text-center">
            <a href="<?= $baseurl; ?>properties" class="button btn-3">
                Browse More Properties
            </a>
        </div>
    </div>
</div>



<div class="row" style='background:linear-gradient(to right, rgb(97 2 97), rgb(255, 105, 180));padding:80px;'>
<div class="col-lg-9">
    <span style='font-size:40px;font-weight:700;margin-right:100px;' class='text-white'>Call Landz Bazaar Expert Now </span>
    </div>
    <div class="col-lg-3">
        
    <a href="tel:+919738207273" class="btn btn-white rounded" >Call Now</a>
    </div>
</div>





<div class="contact-2 content-area-5">

    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <p>Get in touch.</p>
            <h1>Contact us</h1>
        </div>
        <div class="contact-info">
            <div class="row">

                <div class="col-md-4 col-sm-6 mrg-btn-50">
                    <i class="flaticon-technology-1"></i>
                    <p class="strong">Phone Number</p>
                    <p>+91 9738207273</p>
                </div>
                <div class="col-md-4 col-sm-6 mrg-btn-50">
                    <i class="flaticon-envelope"></i>
                    <p class="strong">Email Address</p>
                    <p>connect@Landz Bazaar.com</p>
                </div>
                <div class="col-md-4 col-sm-6 mrg-btn-50">
                    <i class="flaticon-globe"></i>
                    <p class="strong">Web</p>
                    <p>www.Landz Bazaar.com</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="" style='background:#070a5e;padding-left:80px;padding-top:30px'>

    <span style='font-size:40px;font-weight:700;margin-right:100px;' class='text-white'>Download Landz Bazaar App Now </span>
    <a href=""><img src="img/play.png" style='width:200px'></a>
    <a href=""><img src="img/app-store.png" style='width:200px'></a>
</div>

<div class="blog content-area comon-slick">
    <div class="container">
        <!-- Main title -->
        <div class="main-title-4">
            <h1>Our <span>Blog</span></h1>
        </div>
        <div class="slick row comon-slick-inner wow fadeInUp delay-04s" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
            
            <?php foreach($blogs as $blog) { ?>
            <div class="item slide-box">
                <div class="blog-1">
                    <div class="blog-image">
                        <img src="<?=$baseurl;?>media/blogs/<?=$blog->image;?>" alt="blog" class="img-fluid w-100" style='height:300px'>
                        
                    </div>
                    <div class="detail">
                        <div class="post-meta clearfix">
                            <ul>
                                
                                <li class="date"><span><?=$blog->date;?></span></li>
                                <!--<li><a href="#"><i class="flaticon-interface"></i></a>15</li>-->
                                <!--<li><a href="#"><i class="flaticon-time"></i></a>5</li>-->
                            </ul>
                        </div>
                        <h3>
                            <a href="<?=$baseurl;?>blog/<?=$blog->slug;?>"><?=$blog->title;?></a>
                        </h3>
                        <p><?=substr($blog->description,0,200).'....';?></p>
                    </div>
                </div>
            </div>
            
            <?php } ?>
        </div>
    </div>
</div>


<script>
    function setType(type) {
        document.getElementById('type').value = type;
    }
</script>

<?php include 'private/footer.php'; ?>