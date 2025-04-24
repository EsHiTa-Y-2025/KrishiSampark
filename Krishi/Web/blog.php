<?php require('private/header.php');
$blog = getBlogBySlug($con,$_GET['slug']);
$categories = get_category($con);

if(!is_object($blog) && $blog==2){
    echo "<script>window.history.back();</script>";
    exit;
}
?>

<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1><?=$blog->title;?></h1>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="breadcrumb-area">
                    <ul>
                        <li><a href="<?=$baseurl;?>">Home</a></li>
                        <li><span>/</span><?=$blog->title;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- Blog body start -->
<div class="blog-body content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <!-- Blog box start -->
                <div class="blog-1 blog-big mb-0">
                    <div class="blog-photo">
                        <img src="<?=$baseurl.'media/blogs/'.$blog->image;?>" alt="blog-img" class="img-fluid">
                    </div>
                    <div class="detail">
                        
                        <div class="post-meta clearfix">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i>Posted by Landsbazzar</a></li>
                                <li><a href="#"><i class="fa fa-calendar"></i></a><?=$blog->date;?></li>
                                <!--<li><a href="#"><i class="flaticon-time"></i></a>5</li>-->
                            </ul>
                        </div>
                        <p><?=$blog->description;?></p>
                    </div>
                    
                </div>
                <!-- Blog box end -->

                
             
            </div>
             <?php require('private/listingSidebar.php');?>
        </div>
    </div>
</div>
<!-- Blog body end -->
<?php require('private/footer.php');?>