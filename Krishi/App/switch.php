<?php
include 'private/autoload.php';

$userData = check_user_login($con);

$userId = $userData->userId;
 
       $delete = "UPDATE `users` set user_type=:user_type WHERE  userId=:userId";
            $stm = $con->prepare($delete);
            $stm->execute(['user_type'=>2,'userId'=>$userId]);
         
                echo "<script>window.location='main';</script>";

