<?php include 'private/header.php'; 
$categoriesData = getCategoriesAndSubcategories($con);
$lang = 'en';
?>



        <!-- Start Home Banner Two Area -->
        <div class="home-banner-two">
            <div class="home-slides owl-carousel owl-theme">
                <div class="home-item item-bg1">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="container">
                                <div class="main-banner-content">
                                    <ul class="banner-list">
                                        <li>
                                            <i class="flaticon-onion"></i>
                                            <span>Agriculture Products</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-harvest"></i>
                                        
                                            <span>Agriculture Services</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-cow-1"></i>
                                           
                                            <span>Animal Trade</span>
                                        </li>
                                    </ul>

                                    <h1>Agriculture Products</h1>
                                    <p>Crops are plants cultivated for food, feed, fiber, or industrial purposes. They form the foundation of agricultural production and include staple food crops like rice, wheat, corn, and soybeans. Other crops include fruits, vegetables, oilseeds (such as sunflower and canola), sugarcane, cotton, and tobacco.
                                    </p>

                                    <div class="banner-btn">
                                        <a href="#" class="default-btn">
                                             Get Now
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="home-item item-bg2">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="container">
                                <div class="main-banner-content">
                                    <ul class="banner-list">
                                        <li>
                                            <i class="flaticon-onion"></i>
                                            <span>Agriculture Products</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-harvest"></i>
                                        
                                            <span>Agriculture Services</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-cow-1"></i>
                                           
                                            <span>Animal Trade</span>
                                        </li>
                                    </ul>

                                    <h1>Agriculture Services</h1>
                                    <p>Agriculture services encompass a range of professional and support services that contribute to the success and efficiency of agricultural operations.</p>

                                    <div class="banner-btn">
                                        <a href="#" class="default-btn">
                                            View Services

                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  

                <div class="home-item item-bg3">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="container">
                                <div class="main-banner-content">
                                    <ul class="banner-list">
                                        <li>
                                            <i class="flaticon-onion"></i>
                                            <span>Agriculture Products</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-harvest"></i>
                                        
                                            <span>Agriculture Services</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-cow-1"></i>
                                           
                                            <span>Animal Trade</span>
                                        </li>
                                    </ul>

                                    <h1>Agriculture Implementation</h1>
                                    <p>Agriculture implementation involves the practical application of various techniques, technologies, and practices to carry out farming activities efficiently. </p>

                                    <div class="banner-btn">
                                        <a href="#" class="default-btn">
                                            Enquire Now
                                           
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

          
            <div class="creative-shape">
                <img src="assets/img/home-two/shape.png" alt="image">
            </div>

            <div class="shape-img1">
                <img src="assets/img/home-two/shape-1.png" alt="image">
            </div>

            <div class="shape-img2">
                <img src="assets/img/home-two/shape-2.png" alt="image">
            </div>
        </div>
        <!-- End Home Banner Two Area -->

<?php if (!empty($categoriesData)) : ?>
<?php foreach ($categoriesData as $category) : ?>
<div class="mb-5 mt-5 container ">
        
            <div class="mb-5 pb-4">
                <div class="text-center ">
                    <div>
                        <h3 class="fw-bold mb-0 ">
                            <?php
                            if ($lang == 'en') {
                                echo $category['category_name'];
                            } elseif ($lang == 'kannad' && !empty($category['cat_name_kannad'])) {
                                echo $category['cat_name_kannad'];
                            } elseif ($lang == 'marathi' && !empty($category['cat_name_marathi'])) {
                                echo $category['cat_name_marathi'];
                            } else {
                                echo $category['category_name'];
                            }
                            ?>

                        </h3>
                    </div>
                </div>
               
            </div>
            <div class="row align-items-end g-4">
                <?php if (!empty($category['subcategories'])) : ?>
                    <?php foreach ($category['subcategories'] as $subcategory) : ?>
                        <div class="col-3 col-lg-3">
                            <a href="#" class="text-decoration-none link-dark">
                                <div class="card pt-3 pb-3">
                                    <div class="m-auto back">
                                        <img src="<?= $baseurl.$subcategory['subcat_icon'] ?>" class="img-fluid rounded-circle" style='width:90px;height:90px' alt="#">
                                    </div>
                                    <div class="card-body text-center px-0 pb-0">
                                        <h6 class="card-title mb-1">
                                          
                                         <?php
                                            if ($lang == 'en') {
                                                echo $subcategory['subcat_name'];
                                            } elseif ($lang == 'kannad' && !empty($subcategory['subcat_name_kannad'])) {
                                                echo $subcategory['subcat_name_kannad'];
                                            } elseif ($lang == 'marathi' && !empty($subcategory['subcat_name_marathi'])) {
                                                echo $subcategory['subcat_name_marathi'];
                                            } else {
                                                echo $subcategory['subcat_name'];
                                            }
                                            ?>
                            
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col">
                        <p>No record found</p>
                    </div>
                <?php endif; ?>
            </div>
       

</div>
 <?php endforeach; ?>
    <?php else : ?>
        <p>No categories or subcategories found.</p>
    <?php endif; ?>

        <!-- Start About Section -->
        <section class="about-section section-bottom bg-f4faf4 ptb-100">
            <div class="container">
                <div class="about-title-area">
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="about-title">
                                <span>KNOW ABOUT US</span>
                                <h2>Who we are </h2>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-12">
                            <div class="about-text">
                                <p>Krishisampark provides farm management services aimed at optimizing agricultural operations. 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-image">
                            <img src="assets/img/about/about-2.jpg" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="about-slider owl-carousel owl-theme">
                            <div class="about-item">
                                <div class="about-slide-image">
                                    <img src="assets/img/about/1.png" alt="image">
                                </div>
                                <div class="about-text">
                                    <span>Healthy journey</span>
                                    <h3>100% Clean & fresh agro services with low cost</h3>
                                </div>
                            </div>

                            <div class="about-item">
                                <div class="about-slide-image">
                                    <img src="assets/img/about/2.png" alt="image">
                                </div>
                                <div class="about-text">
                                    <span>Pure agro services</span>
                                    <h3>Rich in nutrients but no formal or defect</h3>
                                </div>
                            </div>

                            <div class="about-item">
                                <div class="about-slide-image">
                                    <img src="assets/img/about/3.png" alt="image">
                                </div>
                                <div class="about-text">
                                    <span>Healthy journey</span>
                                    <h3>Clean & fresh agro services with low cost</h3>
                                </div>
                            </div>
                        </div>

                        <div class="about-content-area">
                            <div class="about-content">
                                <h3>Our Products</h3>
                                <p>Krishisampark leverages technology to provide agri-tech solutions that enhance farming efficiency. They offer digital tools, mobile applications, and data-driven platforms to assist farmers in monitoring crop growth, analyzing weather patterns, managing irrigation schedules, and accessing real-time market information. These technological solutions empower farmers to make informed decisions and adopt precision farming practices.
                                </p>
                            </div>

                            <ul class="about-list">
                                <li>
                                    <i class="flaticon-check"></i>
                                    Grains
                                </li>

                                <li>
                                    <i class="flaticon-check"></i>
                                    Millets
                                </li>

                                <li>
                                    <i class="flaticon-check"></i>
                                    Seedings
                                </li>

                                <li>
                                    <i class="flaticon-check"></i>
                                    Organic fertilizers
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="default-shape">
                <div class="default-shape-one">
                    <img src="assets/img/default-shape/shape.png" alt="image">
                </div>

                <div class="default-shape-two">
                    <img src="assets/img/default-shape/shape-2.png" alt="image">
                </div>
            </div>
        </section>
        <!-- End About Section -->

        <!-- Start Fun Facts Section -->
        <section class="fun-facts-area pb-100">
            <div class="container">
                <div class="fun-facts-content-area fun-facts-top">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-fun-fact">
                                <h3>
                                    <span class="odometer" data-count="10">00</span>
                                    <span class="sign-icon">+</span>
                                </h3>
                                <p>Products</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-fun-fact">
                                <h3>
                                    <span class="odometer" data-count="39">00</span>
                                    <span class="sign-icon">+</span>
                                </h3>
                                <p>Animals</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-fun-fact">
                                <h3>
                                    <span class="odometer" data-count="12">00</span>
                                    <span class="sign-icon">+</span>
                                </h3>
                                <p>Services</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-fun-fact">
                                <h3>
                                    <span class="odometer" data-count="20">00</span>
                                    <span class="sign-icon">+</span>
                                </h3>
                                <p>Vehicles</p>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </section>
        <!-- End Fun Facts Section -->

       
        <!-- <section class="shop-section pb-100">
            <div class="container">
                <div class="section-title">
                    <span>VISIT OUR SHOP</span>
                    <h3>Buy our product</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laboreonsectetur adipiscinet dolore.</p>
                </div>

                <div class="tab shop-list-tab">
                    <ul class="tabs">
                        <li>
                            <a href="#">
                                <span>Fresh Milk</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="#">
                                <span>Fresh Vegetable</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="#">
                                <span>Fresh Fish</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab_content">
                        <div class="tabs_item">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/cauliflower.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Fresh Cauliflower</h3>
                                            <span>$50</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/fish.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Bunch Fresh Fish</h3>
                                            <span>$90</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/eggplant.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Fresh Eggplant</h3>
                                            <span>$40</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/milk.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Organic Milk</h3>
                                            <span>$60</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="product-btn">
                                <a href="" class="product-btn-one">
                                    All Products
                                    <i class="flaticon-plus"></i>
                                </a>
                            </div>
                        </div>

                        <div class="tabs_item">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/cauliflower.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Fresh Cauliflower</h3>
                                            <span>$50</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/fish.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Bunch Fresh Fish</h3>
                                            <span>$90</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/eggplant.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Fresh Eggplant</h3>
                                            <span>$40</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/milk.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Organic Milk</h3>
                                            <span>$60</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="product-btn">
                                <a href="" class="product-btn-one">
                                    All Products
                                    <i class="flaticon-plus"></i>
                                </a>
                            </div>
                        </div>

                        <div class="tabs_item">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/cauliflower.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Fresh Cauliflower</h3>
                                            <span>$50</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/fish.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Bunch Fresh Fish</h3>
                                            <span>$90</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/eggplant.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Fresh Eggplant</h3>
                                            <span>$40</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="shop-item-two">
                                        <div class="shop-image">
                                            <img src="assets/img/shop/milk.png" alt="image">
                                        </div>

                                        <div class="shop-content">
                                            <h3>Organic Milk</h3>
                                            <span>$60</span>
                                        </div>

                                        <ul class="shop-list">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>

                                        <ul class="shop-icon">
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="big-icon">
                                                <a href="#">
                                                    <i class="flaticon-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="product-btn">
                                <a href="" class="product-btn-one">
                                    All Products
                                    <i class="flaticon-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        -->

        

        <!-- Start Cow Section-->
        <section class="cow-section pt-100">
            <div class="container">
                <div class="section-title">
                    <span>Krishisampark</span>
                    <h3>Download Our App Now</h3>
                    <p>
                        Krishisampark facilitates animal trade by connecting buyers and sellers through their platform. Farmers looking to sell or purchase livestock can register on Krishisampark and utilize the platform to connect with potential buyers or sellers. This streamlines the process of animal trade and enables farmers to find suitable markets for their livestock.
                    </p>

                </div>

                <div class="cow-image">
                    <img src="https://play-lh.googleusercontent.com/_vzseJdOAsq5q5y6inri3bTgLx-X7BpqLUjgF2MQsgpxDy9owLPblODqf4t9hqyT8ZY" style='width:200px'>
                    <img src="https://www.freepnglogos.com/uploads/play-store-logo-png/google-play-store-logo-png-transparent-png-logos-10.png" style="width:200px" alt="image">
                </div>
            </div>
        </section>
        <!-- End Cow Section-->

        

        <!-- Start Summary Section -->
        <section class="summary-section ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="summary-content default-summary">
                            <span>Soil Testing and Crop solution for rice</span>
                            <h3>A brief what we use how use the impression help you</h3>
                            <p>Through Krishisampark, farmers can avail themselves of soil testing and analysis services. Experts collect soil samples from farms and conduct comprehensive testing to assess nutrient content, pH levels, and overall soil health. Based on the results, farmers receive personalized recommendations on fertilizer application, soil amendments, and crop selection to maximize yields and minimize input costs.
                            </p>
                            <p>Rice is a semi-aquatic crop and requires adequate water management throughout its growth cycle. Farmers should employ appropriate irrigation techniques to ensure sufficient water supply without waterlogging or drought stress. Common methods include flood irrigation, controlled irrigation, or alternate wetting and drying (AWD) techniques.

                            </p>

                            
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="summary-image">
                            <img src="assets/img/summary/1.png" alt="image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="summary-shape-image-two">
                <img src="assets/img/summary/shape2.png" alt="image">
            </div>
        </section>
        <!-- End Summary Section -->

        <!-- Start Services Section -->
        <section class="services-section pb-100">
            <div class="container">
                <div class="services-content-area">
                    <div class="services-slider owl-carousel owl-theme">
                        <div class="services-item">
                            <div class="icon">
                                <i class="flaticon-mission-accomplished"></i>
                                <h3>
                                    <a href="">
                                        Agriculture Products
                                    </a> 
                                </h3>
                            </div>
                        </div>

                        <div class="services-item">
                            <div class="icon">
                                <i class="flaticon-sushi"></i>
                                <h3>
                                    <a href="">
                                        Agriculture Services
                                    </a>
                                </h3>
                            </div>
                        </div>

                        <div class="services-item">
                            <div class="icon">
                                <i class="flaticon-shipping-and-delivery"></i>
                                <h3>
                                    <a href="">
                                        Agriculture Implementation
                                    </a>
                                </h3>
                            </div>
                        </div>

                        <div class="services-item">
                            <div class="icon">
                                <i class="flaticon-vendor"></i>
                                <h3>
                                    <a href="">
                                        Animal Trade
                                    </a>
                                </h3>
                            </div>
                        </div>

                        <div class="services-item">
                            <div class="icon">
                                <i class="flaticon-harvest"></i>
                                <h3>
                                    <a href="">
                                        Organic n inorganic fertilizers & Pesticides & seeds. 
                                    </a>
                                </h3>
                            </div>
                        </div>

                        <div class="services-item">
                            <div class="icon">
                                <i class="flaticon-shipping-and-delivery"></i>
                                <h3>
                                    <a href="">
                                        Agricultural second hand Products Sales.
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </section>
        <!-- End Services Section -->

        

      <?php include 'private/footer.php'; ?>
