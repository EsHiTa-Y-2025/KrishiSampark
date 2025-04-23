<?php 
$mainPage ='active';
require('private/header.php');
$blog = getBlogBySlug($con,$_GET['slug']);
$categories = get_category($con);

if(!is_object($blog) && $blog==2){
    echo "<script>window.history.back();</script>";
    exit;
}

$timestamp = strtotime($blog->date);

$day = date("d", $timestamp);
$month = date("F", $timestamp);
$year = date("Y", $timestamp);
$time = date("h:i A", $timestamp);

$posted_on = $day.' '.$month.', '.$year.' at '.$time;
?>
<body>
    <div class="bg-white shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="gap-3 d-flex align-items-center">
          <a onclick="window.history.back()"
            ><i class="bi bi-arrow-left d-flex landsbazzar-text h2 m-0 back-page"></i
          ></a>
          <h3 class="fw-bold m-0">
            <?=getLanguageString($con,$lang,'blog_detail');?>
              
              
              </h3>
        </div>
        

      </div>
    </div>
    <div class="shadow-sm">
        <img src="<?=$baseurl.'media/blogs/'.$blog->image;?>" style='width:100%;height:200px'>
    </div>

    <div class="px-3 pt-3">
      <div class="row align-items-start justify-content-between">
        <div class="col-12">
          <h1 class="fw-bold mb-1">
               <?php
                            if ($lang == 'en') {
                                echo $blog->title;
                            } elseif ($lang == 'kannad' && !empty($blog->title_kannad)) {
                                echo $blog->title_kannad;
                            } elseif ($lang == 'marathi' && !empty($blog->title_marathi)) {
                                echo $blog->title_marathi;
                            } else {
                                echo $blog->title;
                            }
                            ?>
          </h1>
         <h6 class='text-muted'> <?=$posted_on;?></h6>
          
          <!--<span class=" text-dark mb-3">-->
          <!--  Posted By : Krishisampark-->
          <!--</span>-->
<hr>
        </div>
        
      </div>
    </div>

    

    <div class="px-3 pb-5">
      <div class="row">
        <div class="col-12">
           <p>
                <?php
                            if ($lang == 'en') {
                                echo $blog->description;
                            } elseif ($lang == 'kannad' && !empty($blog->description_kannad)) {
                                echo $blog->description_kannad;
                            } elseif ($lang == 'marathi' && !empty($blog->description_marathi)) {
                                echo $blog->description_marathi;
                            } else {
                                echo $blog->description;
                            }
                            ?>
           </p>
              </div>
           
        </div>
      </div>
      



<?php require('private/footer.php');?>