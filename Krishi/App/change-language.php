<?php
include 'private/autoload.php';

$userId = $_SESSION['userId'];
$language = $_GET['language'];

       $update = "UPDATE `users` set language=:language WHERE userId=:userId";
            $stm = $con->prepare($update);
            $stm->execute(['language'=>$language,'userId'=>$userId]);
           
               echo "<script>window.location='main';</script>";
            
                

    
