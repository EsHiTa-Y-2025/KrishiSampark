<?php 
$mainPage='active';
require('private/header.php');
if(isset($_GET['blog_keyword'])){
    $blogs = getSearchedBlogs($con,$_GET['blog_keyword']);
}else{
    $blogs = getBlogs($con);    
}

?>

  <body class="bg-light">

  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex landsbazzar-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'our_blogs');?> </h3>
      </div>
     
    </div>
  </div>
  


    <div class="p-3">
        
         <form method="GET" action="blogs">
        
      <div class="input-group bg-light rounded-md border border-dark p-1 mb-3 overflow-hidden">
       
        <input class="shadow-none form-control border-0 border-end" name="blog_keyword" value="<?php if(isset($_GET['blog_keyword'])) echo $_GET['blog_keyword']; ?>" placeholder="Search here...">
                 <button type='submit' class="input-group-text text-decoration-none border-0 bg-white"><i class="fa-solid fa-magnifying-glass krishisampark-text"></i></button>

        
      </div>
     </form>
      
      <div class="row gy-3">
          
        <?php 
        if(count($blogs)>0){
        foreach($blogs as $blog){ 

                ?>
        <div class="col-12 col-md-4">
          <a href="blog?slug=<?=$blog->slug;?>" class="text-decoration-none link-dark">
            <div class="card rounded-4 shadow border-0 overflow-hidden">
              <div class="position-relative">
                  
                <div class="product-back">
                   <img src="<?=$baseurl.'media/blogs/'.$blog->image;?>" style='width:100%;height:200px'>
                </div>
                
                
                
              
                
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <div class="h3 fw-bold"><?=$blog->title;?></div>
                  
                </div>
                <div
                  class="d-flex justify-content-between text-muted h6 m-0 fw-normal"
                >
                  <div>Posted By Krishisampark</div>
                  <div><?=$blog->date;?></div>
                </div>
                
               
              </div>
              
            </div>
          </a>
        </div>
        <?php } }else{ echo "<h2>No blogs found</h2>"; } ?>
        
      </div>
    </div>
    
<?php require('private/footer.php');?>