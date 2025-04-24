<?php include 'private/header.php';
$categories = get_category($con);
$ads = showFeaturedAds($con, 'Property');
$featuredBusiness = showFeaturedAds($con, 'Business');
$recentAds = showRecentAds($con);

$trustedAds = showTrustedAds($con,'Property');
$cities = getCities($con);
$blogs = getBlogs($con,$limit=6);
$categoriesData = getCategoriesAndSubcategories($con);
$baseurl="https://krishisampark.in/";
?>



<div class="container  mt-5 mb-5">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
     <div class="carousel-item active">
      <img src="https://i.pinimg.com/1200x/41/7f/b3/417fb3dc5a6454419abaf53657a7fd8b.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://arad.co.il/app/uploads/Banner-05-min.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://www.stridelysolutions.com/wp-content/uploads/2022/01/Machine-learning-for-Precision-Agriculture_Website.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

<?php if (!empty($categoriesData)) : ?>
<?php foreach ($categoriesData as $category) : ?>

<div class="p-4  mt-5">
    
        
            <div class="d-flex align-items-center justify-content-between mb-3 pe-3">
                <div class="d-flex align-items-center gap-2">
                    <div>
                        <h3 class="fw-bold mb-0">
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
                <div>
                    <a href="<?=$baseurl;?>app/categories?id=<?=$category['cat_id'];?>" class="text-decoration-none text-danger text-end"><?=getLanguageString($con,$lang,'see_all');?></a>
                </div>
            </div>
            <div class="row align-items-end g-4">
                <?php if (!empty($category['subcategories'])) : ?>
                    <?php foreach ($category['subcategories'] as $subcategory) : ?>
                        <div class="col-lg-2 col-6">
                            <a href="category?slug=<?=$subcategory['subcat_slug'];?>" class="text-decoration-none link-dark">
                                <div class="card border-0 bg-light p-2">
                                    <div class="m-auto ">
                                        <img src="<?= $baseurl.$subcategory['subcat_icon'] ?>" style='width:100px;height:100px' class="img-fluid p-2 rounded-circle bg-white shadow-sm border" alt="#">
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
    
    


<div class="featured-properties content-area-9 comon-slick mt-5">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Recent <span>Posts</span></h1>
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


                                <div class="property-overflow">
                                    <img style='width:100%;height:250px' src="<?= $baseurl . $picture; ?>" alt="">
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
       
    </div>
</div>



<div class="row" style='background:linear-gradient(to right, rgb(134 171 65), rgb(255 147 10));padding:80px;'>
<div class="col-lg-9">
    <span style='font-size:40px;font-weight:700;margin-right:100px;' class='text-white'>Call Krishisampark Expert Now </span>
    </div>
    <div class="col-lg-3">
        
    <a href="tel:+919481725226" class="btn btn-white rounded" >Call Now</a>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6 col-12 p-2 ">
            <img src="<?=$baseurl;?>app/img/sliders/4.jpg" style='width:100%'>
        </div>
        
        <div class="col-lg-6 col-12 p-2 ">
            <img src="<?=$baseurl;?>app/img/sliders/5.jpg" style='width:100%'>
        </div>
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
                    <p>+91 9481725226</p>
                </div>
                <div class="col-md-4 col-sm-6 mrg-btn-50">
                    <i class="flaticon-envelope"></i>
                    <p class="strong">Email Address</p>
                    <p>connect@krishisampark.in</p>
                </div>
                <div class="col-md-4 col-sm-6 mrg-btn-50">
                    <i class="flaticon-globe"></i>
                    <p class="strong">Web</p>
                    <p>www.krishisampark.in</p>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="" style='background:#198754;padding-left:80px;padding-top:30px'>

    <span style='font-size:40px;font-weight:700;margin-right:100px;' class='text-white'>Download Krishisampark App Now </span>
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

                    </div>
                </div>
            </div>
            
            <?php } ?>
        </div>
    </div>
</div>



<?php include 'private/footer.php'; ?>