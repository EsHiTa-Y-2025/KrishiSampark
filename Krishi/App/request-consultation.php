<?php 
$consultationPage='active';
require('private/header.php');


?>
  <body>
    <div class="bg-white shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="gap-3 d-flex align-items-center">
          <a href="consultation"
            ><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i
          ></a>
          <h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'book_consultation');?></h3>
        </div>
       
      </div>
    </div>
    
      <?php 
$error='';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']){

    extract($_POST);
 
   
        if($error == ''){
            $arr['message']=$message;
            $arr['user_id']=$userData->userId;
            $arr['consultation_id'] = isset($_GET['id']) ? $_GET['id'] : 'NA';
            $arr['date']=date('d/m/Y');
           
           
                  $add = "INSERT INTO `consultation_requests`( `consultation_id`, `user_id`, `date`, `message`) VALUES (:consultation_id,:user_id,:date,:message)";
                  $stm = $con->prepare($add);
                  if($stm->execute($arr)){
                       $_SESSION['successMsg']= 'Request submitted successfully. We will contact you soon. Thank you!';
                       echo "<script>window.location='consultation'</script>";
                  }
        }

      


}
    $_SESSION['token'] = get_random_string(60);
    ?>

    <div class="p-3">
        <form method="POST" action="">
            <input type="hidden" name="token" value="<?=$_SESSION['token'];?>" >
            
            <!--<div class="input-group mb-3">-->
            <!--    <select class="form-control" name="mode">-->
            <!--        <option selected disabled>Choose consultation mode</option>-->
            <!--        <option>Online</option>-->
            <!--        <option>Offline</option>-->
            <!--    </select>-->
            <!--</div>-->
            
            <div class="input-group mb-3">
                <textarea
                  type="text"
                  class="shadow-none form-control rounded-3"
                  placeholder="<?=getLanguageString($con,$lang,'enter_your_message');?>"
                  rows="6"
                  value=""
                  required
                  name="message"
                ></textarea>
          </div>
          
          <div class="d-grid">
            <button type="submit" class="btn krishisampark-btn text-white btn-lg" id="register-btn"><?=getLanguageString($con,$lang,'book_now');?></button>
          </div>
        </form>

    </div>
    <div class="pb-5 pt-3"></div>

   

   <?php require('private/footer.php');?>