<?php require('private/header.php');
$categories = get_category($con);
?>

    <!-- Home Section Start -->
    <section class="home-section pt-2">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xl-9 col-lg-8">
                    <div class="home-contain h-100">
                        <img src="media/banners/3.jpg" class="bg-img blur-up lazyload" alt="">
                        <div class="home-detail text-white p-center-left w-75 position-relative mend-auto">
                            <div>
                                <h6 class="text-white">Krishisampark</h6>
                                <h1 class="w-75 text-uppercase poster-1">Stay home & delivered your <span
                                        class="daily">Daily Needs</span></h1>
                                <p class="w-58 d-none text-white d-sm-block">Krishisampark is an agricultural platform that offers a comprehensive range of services to farmers, including those related to crop production, livestock management, and animal trade. Here is some content highlighting the services provided by Krishisampark:

                                </p>
                                <button onclick="location.href = '#';"
                                    class="btn  btn-animation mt-xxl-4 mt-2 home-button mend-auto">Sell Now<i
                                        class="fa-solid fa-right-long ms-2 icon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 d-lg-inline-block d-none ratio_156">
                    <div class="home-contain h-100">
                        <img src="media/banners/b.png" class="bg-img blur-up lazyload" alt="">
                        <div class="home-detail p-top-left home-p-sm w-75">
                            <div>
                                <h2 class="mt-0 text-white">45% <span class="discount text-title">OFF</span>
                                </h2>
                                <h3 class="text-white">Agriculture Products</h3>
                                <h5 class="text-white">Krishisampark leverages technology to provide agri-tech solutions that enhance farming efficiency. ..</h5>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Section End -->

    <!-- Category Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Browse by Categories</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="assets/svg/leaf.svg#leaf"></use>
                    </svg>
                </span>
                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-9">
                        <?php foreach($categories as $cat){ ?>
                        <div>
                            <a href="#" class="category-box wow fadeInUp">
                                <div>
                                    <img src="<?=$baseurl.$cat->cat_icon;?>" class="blur-up lazyload" alt="">
                                    <h5><?=$cat->cat_name;?></h5>
                                </div>
                            </a>
                        </div>

                       <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Section End -->

   
    <!-- <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="banner-contain">
                        <div class="banner-contain hover-effect">
                            <img src="assets/images/vegetable/banner/15.jpg" class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details p-center p-sm-4 p-3 text-white text-center">
                                <div>
                                    <h3 class="lh-base fw-bold text-light">Get $3 Cashback! Min Order of $30</h3>
                                    <h6 class="coupon-code">Use Code : GROCERY1920</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container-fluid-lg">
            <div class="title">
                <h2>FRUIT & VEGETABLES</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="assets/svg/leaf.svg#leaf"></use>
                    </svg>
                </span>
                <p>A virtual assistant collects the products from your list</p>
            </div>
           
        </div>
    </section> -->
    

    
    <!-- <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="offer-box hover-effect">
                        <img src="assets/images/veg-2/banner/3.jpg" class="bg-img blur-up lazyload" alt="">
                        <div class="offer-contain p-4">
                            <div class="offer-detail">
                                <h2 class="text-dark">Special Offers <span class="text-danger fw-bold">of the
                                        week!</span></h2>
                                <p class="text-content">Special offer on this discount, Hurry Up!</p>
                            </div>
                            <div class="offer-timing">
                                <div class="time" id="clockdiv-1" data-hours="1" data-minutes="2" data-seconds="3">
                                    <ul>
                                        <li>
                                            <div class="counter">
                                                <div class="days">
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter">
                                                <div class="hours">
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter">
                                                <div class="minutes">
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter">
                                                <div class="seconds">
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->



    <!-- <section>
        <div class="container-fluid-lg">
            <div class="title">
                <h2>BREAKFAST & DAIRY</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="assets/svg/leaf.svg#leaf"></use>
                    </svg>
                </span>
                <p>A virtual assistant collects the products from your list</p>
            </div>
            
        </div>
    </section> -->

    <!-- <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-4-1 ratio_65 no-arrow product-wrapper">
                        <div>
                            <div class="product-slider wow fadeInUp">
                                <a href="#" class="product-slider-image">
                                    <img src="assets/images/veg-2/pro/1.jpg" class="w-100 blur-up lazyload rounded-3"
                                        alt="">
                                </a>

                                <div class="product-slider-detail">
                                    <div>
                                        <a href="#" class="d-block">
                                            <h3 class="text-title">Hot Deals on New Items</h3>
                                        </a>
                                        <h5>Daily Essentials Eggs & Dairy</h5>
                                        <div class="product-rating">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(34)</span>
                                        </div>
                                        <h6>By <span class="theme-color">Nestfood</span></h6>
                                        <button onclick="location.href = '#';"
                                            class="btn btn-animation product-button btn-sm">Shop Now <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="product-slider wow fadeInUp" data-wow-delay="0.05s">
                                <a href="#" class="product-slider-image">
                                    <img src="assets/images/veg-2/pro/2.jpg" class="w-100 blur-up lazyload rounded-3"
                                        alt="">
                                </a>

                                <div class="product-slider-detail">
                                    <div>
                                        <a href="#" class="d-block">
                                            <h3 class="text-title">Organic Meat Prepared</h3>
                                        </a>
                                        <h5>Delivered to Your Home</h5>
                                        <div class="product-rating">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(34)</span>
                                        </div>
                                        <h6>By <span class="theme-color">Nestfood</span></h6>
                                        <button onclick="location.href = '#';"
                                            class="btn btn-animation product-button btn-sm">Shop Now <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="product-slider wow fadeInUp" data-wow-delay="0.1s">
                                <a href="#" class="product-slider-image">
                                    <img src="assets/images/veg-2/pro/3.jpg" class="w-100 blur-up lazyload rounded-3"
                                        alt="">
                                </a>

                                <div class="product-slider-detail">
                                    <div>
                                        <a href="#" class="d-block">
                                            <h3 class="text-title">Buy More & Save More</h3>
                                        </a>
                                        <h5>Fresh Vegetables & Fruits</h5>
                                        <div class="product-rating">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(34)</span>
                                        </div>
                                        <h6>By <span class="theme-color">Nestfood</span></h6>
                                        <button onclick="location.href = '#';"
                                            class="btn btn-animation product-button btn-sm">Shop Now <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="product-slider wow fadeInUp" data-wow-delay="0.15s">
                                <a href="#" class="product-slider-image">
                                    <img src="assets/images/veg-2/pro/4.jpg" class="w-100 blur-up lazyload rounded-3"
                                        alt="">
                                </a>

                                <div class="product-slider-detail">
                                    <div>
                                        <a href="#" class="d-block">
                                            <h3 class="text-title">Fresh Fruits on Go</h3>
                                        </a>
                                        <h5>Fresh Vegetables & Fruits</h5>
                                        <div class="product-rating">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(34)</span>
                                        </div>
                                        <h6>By <span class="theme-color">Nestfood</span></h6>
                                        <button onclick="location.href = '#';"
                                            class="btn btn-animation product-button btn-sm">Shop Now <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    

    <!-- Blog Section Start -->
    <!-- <section>
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Featured Blog</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="assets/svg/leaf.svg#leaf"></use>
                    </svg>
                </span>
                <p>A virtual assistant collects the products from your list</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-5 ratio_87">
                        <div>
                            <div class="blog-box">
                                <div class="blog-box-image">
                                    <a href="blog-detail.html" class="blog-image">
                                        <img src="assets/images/veg-2/blog/1.jpg" class="bg-img blur-up lazyload"
                                            alt="">
                                    </a>
                                </div>

                                <div class="blog-detail">
                                    <h6>Farmart</h6>
                                    <h5>Fresh Meat Saugage</h5>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="blog-box">
                                <div class="blog-box-image">
                                    <a href="blog-detail.html" class="blog-image">
                                        <img src="assets/images/veg-2/blog/2.jpg" class="bg-img blur-up lazyload"
                                            alt="">
                                    </a>
                                </div>

                                <a href="blog-detail.html" class="blog-detail">
                                    <h6>Soda Brand</h6>
                                    <h5>Soda 500ml - 20% OFF</h5>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="blog-box">
                                <div class="blog-box-image">
                                    <a href="blog-detail.html" class="blog-image">
                                        <img src="assets/images/veg-2/blog/3.jpg" class="bg-img blur-up lazyload"
                                            alt="">
                                    </a>
                                </div>

                                <a href="blog-detail.html" class="blog-detail">
                                    <h6>Beer Brand</h6>
                                    <h5>Soda 500ml - 20% OFF</h5>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="blog-box">
                                <div class="blog-box-image">
                                    <a href="blog-detail.html" class="blog-image">
                                        <img src="assets/images/veg-2/blog/4.jpg" class="bg-img blur-up lazyload"
                                            alt="">
                                    </a>
                                </div>

                                <a href="blog-detail.html" class="blog-detail">
                                    <h6>Beer Brand</h6>
                                    <h5>Fresh Beer -30% OFF</h5>
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="blog-box">
                                <div class="blog-box-image">
                                    <a href="blog-detail.html" class="blog-image">
                                        <img src="assets/images/veg-2/blog/5.jpg" class="bg-img blur-up lazyload"
                                            alt="">
                                    </a>
                                </div>

                                <a href="blog-detail.html" class="blog-detail">
                                    <h6>Milk Brand</h6>
                                    <h5>Fresh Milk</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Blog Section End -->

    <!-- Newsletter Section Start -->
    <section class="newsletter-section section-b-space">
        <div class="container-fluid-lg">
            <div class="newsletter-box newsletter-box-2">
                <div class="newsletter-contain py-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                                <div class="newsletter-detail">
                                    <h2>Join our newsletter and get...</h2>
                                    <h5>$20 discount for your first order</h5>
                                    <div class="input-box">
                                        <input type="email" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Enter Your Email">
                                        <i class="fa-solid fa-envelope arrow"></i>
                                        <button class="sub-btn btn">
                                            <span class="d-sm-block d-none">Subscribe</span>
                                            <i class="fa-solid fa-arrow-right icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter Section End -->

    <?php require('private/footer.php');?>