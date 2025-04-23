<?php 
$leadsPage='active';
require('private/header.php');

?>

  <body class="bg-light">

  <div class="bg-white shadow-sm p-3">
    <div class="d-flex align-items-center">
      <div class="gap-3 d-flex align-items-center">
        <a href="main"><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i></a>
        <h3 class="fw-bold m-0"> <?=getLanguageString($con,$lang,'leads');?></h3>
      </div>
     
    </div>
  </div>
  
<!--  <div class='p-3'>-->
<!--      <div>-->
       
<!--        <div class="row g-2">-->
<!--          <div class="col-4">-->
<!--            <div class="text-decoration-none text-white">-->
<!--              <div class="krishisampark-bg px-4 text-center py-2 rounded-md">-->
<!--                  <i class='fa fa-envelope' style='font-size:15px'></i><br>-->
<!--                  <h3 class="fw-bold mb-1">Total Leads</h3>-->
<!--                 <span style='font-size:15px'>12</span>-->
                
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
          
<!--          <div class="col-4">-->
<!--            <div class="text-decoration-none text-white">-->
<!--              <div class="krishisampark-bg1 px-4 text-center py-2 rounded-md">-->
<!--                  <i class='fa fa-envelope' style='font-size:15px'></i><br>-->
<!--                  <h3 class="fw-bold mb-1">Business Leads</h3>-->
<!--                 <span style='font-size:15px'>12</span>-->
                
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
          
<!--          <div class="col-4">-->
<!--            <div class="text-decoration-none text-white">-->
<!--              <div class="krishisampark-btn  px-4 text-center py-2 rounded-md">-->
<!--                  <i class='fa fa-envelope' style='font-size:15px'></i><br>-->
<!--                  <h3 class="fw-bold mb-1">Property Leads</h3>-->
<!--                 <span style='font-size:15px'>12</span>-->
                
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
          
<!--        </div>-->
<!--      </div>-->
<!--</div>-->



    <div class="p-3">
      
      <div class="row gy-3">
          
       
               <?php 
                $queryLead = "SELECT DISTINCT u.id, u.userId,l.name,l.contact,l.date,lead_listing.title,cat.cat_name,cat.cat_name_kannad,cat.cat_name_marathi,cities.city_name
                            FROM leads l
                            JOIN listings lead_listing ON l.ad_id = lead_listing.id
                            JOIN listings other_listings ON lead_listing.category = other_listings.category
                            JOIN categories cat ON lead_listing.category = cat.id
                            JOIN cities ON cities.id = lead_listing.city
                            JOIN users u ON other_listings.posted_by = u.userId
                            WHERE  u.userId=:userId order by l.id desc";
                $stmLead = $con->prepare($queryLead);
                $stmLead->execute(['userId'=>$userData->userId]);
                $leads = $stmLead->fetchAll(PDO::FETCH_OBJ);
                if(count($leads)>0){
                    foreach($leads as $lead){ 

               ?>
               
        <div class="col-12 col-md-4">
          <a class="text-decoration-none link-dark">
            <div class="card rounded-4 shadow border-0 overflow-hidden">
             
              <div class="card-body">
                  <div><span class="badge bg-primary mb-2">Read</span></div>
                  <span class="h4"> 
                  
                  <?php 

                           if ($lang == 'en') {
                                echo  $lead->cat_name;
                            } elseif ($lang == 'kannad' && !empty($lead->cat_name_kannad)) {
                                echo $lead->cat_name_kannad;
                            } elseif ($lang == 'marathi' && !empty($lead->cat_name_marathi)) {
                                echo $lead->cat_name_marathi;
                            } else {
                                echo $lead->cat_name ;
                            }
                            
                   
                    ?>
                    </span><br>
                  <span class=' fw-bold'><?=$lead->city_name.', Karnataka . '.$lead->date;?></span>

                <div class="d-flex mt-2">
                  <div class="fw-bold">
                      <span class="h3"><?=$lead->name;?></span> <?=getLanguageString($con,$lang,'searched_for');?> <?php 

                           if ($lang == 'en') {
                                echo  $lead->cat_name;
                            } elseif ($lang == 'kannad' && !empty($lead->cat_name_kannad)) {
                                echo $lead->cat_name_kannad;
                            } elseif ($lang == 'marathi' && !empty($lead->cat_name_marathi)) {
                                echo $lead->cat_name_marathi;
                            } else {
                                echo $lead->cat_name ;
                            }
                            
                   
                    ?>. <?=getLanguageString($con,$lang,'connect_with');?> <?=$lead->name;?> <?=getLanguageString($con,$lang,'to_know_more_about_enquiry');?>
                  </div>
                  
                </div>
                <div
                  class="d-flex justify-content-between text-muted h6 m-0 fw-normal"
                >
                  <a href="tel:<?=$lead->contact;?>" style='border-radius:10px;border:1px solid #000' class=' btn btn-sm'><i class="fa fa-phone krishisampark-text"></i></a>
                  
                </div>
              </div>
              
            </div>
          </a>
        </div>
        <?php } } else{ echo "<h2>No Leads found</h2>"; } ?>
        
      </div>
    </div>
 <?php require('private/footer.php');?>