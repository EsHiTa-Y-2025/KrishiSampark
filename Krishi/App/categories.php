<?php require('private/header.php');

$categories = get_sub_category_by_cat($con,$_GET['id']);
$blogs = getBlogsByCat($con,$limit=6,$_GET['id']);

?>
  <body class="bg-light">
 
    <div class="bg-white shadow-sm p-3">
        <div class="d-flex align-items-center">
            <div class="gap-3 d-flex align-items-center">
                <a href="main"><i class="bi bi-arrow-left d-flex landsbazzar-text  h2 m-0 back-page"></i></a>
                <h3 class="fw-bold m-0">
                    <?php if(!empty($categories[0]->category_name)) {
                    
                        // echo $categories[0]->category_name;
                        
                           if ($lang == 'en') {
                                echo  $categories[0]->category_name;
                            } elseif ($lang == 'kannad' && !empty($categories[0]->cat_name_kannad)) {
                                echo $categories[0]->cat_name_kannad;
                            } elseif ($lang == 'marathi' && !empty($categories[0]->cat_name_marathi)) {
                                echo $categories[0]->cat_name_marathi;
                            } else {
                                echo $categories[0]->category_name ;
                            }
                            
                    } else  { 
                            
                            echo 'NA';
                    }
                    ?>
                    
                </h3>
            </div>
            
        </div>
    </div>
 
<?php if (!empty($categories)) : ?>
<div class="p-3 brands-list">
    
        
           
            <div class="row  g-4 mt-0">
            
                    <?php foreach ($categories as $subcategory) : ?>
                        <div class="col-4">
                            <a href="category?slug=<?=$subcategory->subcategory_slug;?>" class="text-decoration-none link-dark">
                                <div class="card border-0 bg-light">
                                    <div class="m-auto back">
                                        <img src="<?= $baseurl.$subcategory->subcategory_icon; ?>" class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#">
                                    </div>
                                    <div class="card-body text-center px-0 pb-0">
                                        <p class="card-title mb-1" style="white-space:normal">
                                            
                                            <?php
                                            
                                             if ($lang == 'en') {
                                echo  $subcategory->subcategory_name ;
                            } elseif ($lang == 'kannad' && !empty($subcategory->subcat_name_kannad)) {
                                echo $subcategory->subcat_name_kannad;
                            } elseif ($lang == 'marathi' && !empty($subcategory->subcat_name_marathi)) {
                                echo $subcategory->subcat_name_marathi;
                            } else {
                                echo $subcategory->subcategory_name ;
                            }
                            
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                
            </div>
       

</div>
    <?php else : ?>
        <p class='p-3'>No categories or subcategories found.</p>
    <?php endif; ?>
    
<!--    <div class="p-3 brands-list">-->
<!--    <div class="d-flex align-items-center justify-content-between mb-3 pe-3">-->
<!--        <div class="d-flex align-items-center gap-2">-->
         
<!--          <div>-->
<!--            <h3 class="fw-bold mb-0">Animal Trade</h3>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div>-->
<!--          <a-->
<!--            href="#"-->
<!--            class="text-decoration-none text-danger fw-bold"-->
<!--            >See all</a-->
<!--          >-->
<!--        </div>-->
<!--      </div>-->
    
<!--    <div class="row align-items-end g-4">-->
<!--        <div class="col-3">-->
<!--            <a href="search-list.html" class="text-decoration-none link-dark">-->
<!--                <div class="card border-0 bg-light">-->
<!--                    <div class="m-auto back"><img src="https://pngfre.com/wp-content/uploads/cow-33-977x1024.png"-->
<!--                            class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#"></div>-->
<!--                    <div class="card-body text-center px-0 pb-0">-->
<!--                        <h6 class="card-title mb-1">Cows</h6>-->
                       
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--       <div class="col-3">-->
<!--            <a href="search-list.html" class="text-decoration-none link-dark">-->
<!--                <div class="card border-0 bg-light">-->
<!--                    <div class="m-auto back"><img src="https://i.pinimg.com/originals/17/65/30/17653037d80a2ba7a47a8accdc3df3c3.png"-->
<!--                            class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#"></div>-->
<!--                    <div class="card-body text-center px-0 pb-0">-->
<!--                        <h6 class="card-title mb-1">Buffaloes</h6>-->
                       
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-3">-->
<!--            <a href="search-list.html" class="text-decoration-none link-dark">-->
<!--                <div class="card border-0 bg-light">-->
<!--                    <div class="m-auto back"><img src="https://png.pngtree.com/png-vector/20230321/ourmid/pngtree-goat-cartoon-white-transparent-png-image_6655709.png"-->
<!--                            class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#"></div>-->
<!--                    <div class="card-body text-center px-0 pb-0">-->
<!--                        <h6 class="card-title mb-1">Goats</h6>-->
                       
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-3">-->
<!--            <a href="search-list.html" class="text-decoration-none link-dark">-->
<!--                <div class="card border-0 bg-light">-->
<!--                    <div class="m-auto back"><img src="https://freepngimg.com/save/10455-buffalo-png-picture/1024x746"-->
<!--                            class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#"></div>-->
<!--                    <div class="card-body text-center px-0 pb-0">-->
<!--                        <h6 class="card-title mb-1">Bulls</h6>-->
                       
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->

        
<!--    </div>-->
<!--</div>-->

<!-- <div class="p-3 brands-list">-->
<!--    <div class="d-flex align-items-center justify-content-between mb-3 pe-3">-->
<!--        <div class="d-flex align-items-center gap-2">-->
         
<!--          <div>-->
<!--            <h3 class="fw-bold mb-0">Agriculture Services</h3>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div>-->
<!--          <a-->
<!--            href="#"-->
<!--            class="text-decoration-none text-danger fw-bold"-->
<!--            >See all</a-->
<!--          >-->
<!--        </div>-->
<!--      </div>-->
    
<!--    <div class="row align-items-end g-4">-->
<!--        <div class="col-3">-->
<!--            <a href="search-list.html" class="text-decoration-none link-dark">-->
<!--                <div class="card border-0 bg-light">-->
<!--                    <div class="m-auto back"><img src="https://static.vecteezy.com/system/resources/previews/012/104/320/original/drone-transparent-sign-free-png.png"-->
<!--                            class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#"></div>-->
<!--                    <div class="card-body text-center px-0 pb-0">-->
<!--                        <h6 class="card-title mb-1">Drone</h6>-->
                       
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--       <div class="col-3">-->
<!--            <a href="search-list.html" class="text-decoration-none link-dark">-->
<!--                <div class="card border-0 bg-light">-->
<!--                    <div class="m-auto back"><img src="https://i.pinimg.com/originals/58/29/90/582990ee9e1641fbd01d7435f8662f80.png"-->
<!--                            class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#"></div>-->
<!--                    <div class="card-body text-center px-0 pb-0">-->
<!--                        <h6 class="card-title mb-1">Borewell Services</h6>-->
                       
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-3">-->
<!--            <a href="search-list.html" class="text-decoration-none link-dark">-->
<!--                <div class="card border-0 bg-light">-->
<!--                    <div class="m-auto back"><img src="https://cdn.rossgardenstore.com/files/images/news/soil-testing-1510566095-1510566133_n.jpg"-->
<!--                            class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#"></div>-->
<!--                    <div class="card-body text-center px-0 pb-0">-->
<!--                        <h6 class="card-title mb-1">Soil Testing</h6>-->
                       
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-3">-->
<!--            <a href="search-list.html" class="text-decoration-none link-dark">-->
<!--                <div class="card border-0 bg-light">-->
<!--                    <div class="m-auto back"><img src="https://e7.pngegg.com/pngimages/247/869/png-clipart-agriculture-organic-farming-farmer-agribusiness-industry-indonesian-pin-grass.png"-->
<!--                            class="img-fluid cw-70 ch-70 rounded-circle bg-white shadow-sm border" alt="#"></div>-->
<!--                    <div class="card-body text-center px-0 pb-0">-->
<!--                        <h6 class="card-title mb-1">Cultivation</h6>-->
                       
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->

        
<!--    </div>-->
<!--</div>-->
    <!--<?php if (!empty($blogs)) : ?>-->

    
    <!--    <div class="ps-3 py-3 bg-light">-->
    <!--  <div class="d-flex align-items-center justify-content-between mb-3 pe-3">-->
    <!--    <div class="d-flex align-items-center gap-2">-->
    <!--      <div>-->
    <!--        <img src="<?=$baseurl;?>app/img/krishi.png" alt class="img-fluid ch-30 cw-30" />-->
    <!--      </div>-->
    <!--      <div>-->
    <!--        <h5 class="fw-bold mb-0">Related Blogs</h5>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <div>-->
    <!--      <a-->
    <!--        href="blogs"-->
    <!--        class="text-decoration-none text-danger fw-bold"-->
    <!--        ><?=getLanguageString($con,$lang,'see_all');?></a-->
    <!--      >-->
    <!--    </div>-->
    <!--  </div>-->
      
    <!--  <div class="px-0">-->
    <!--    <div class="multipleitems">-->
            
    <!--        <?php foreach($blogs as $blog) { ?>-->
    <!--      <div class="item pe-3">-->
    <!--        <a href="blog?slug=<?=$blog->slug;?>" class="text-decoration-none link-dark">-->
    <!--          <div class="card bg-light border-0">-->
    <!--            <div class="product-offer-back">-->
                    
    <!--              <img src="<?=$baseurl;?>media/blogs/<?=$blog->image;?>" style='height:120px;width:100%'  class="img-fluid rounded-md" />-->
                  
    <!--            </div>-->


    <!--            <div class="card-body px-0 pb-0 pt-2">-->
    <!--              <h5 class="fw-bold mb-0"><?=$blog->title;?></h5>-->
    <!--              <p class="text-muted m-0 mt-1 small">Posted On : <?=$blog->date;?></p>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </a>-->
    <!--      </div>-->

    <!--      <?php } ?>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
    

    <!--<?php endif; ?>-->
    

   
 
 
<?php require('private/footer.php');?>
