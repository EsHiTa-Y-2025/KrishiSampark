<?php
include 'private/autoload.php';

$id = $_GET['ad_id'];
$userId = $_SESSION['userId'];
$type = $_GET['type'];

if($type=='Product'){
    $delete = "DELETE FROM `products` WHERE id = :id";
    $stm = $con->prepare($delete);
            $stm->execute(['id'=>$id]);
             echo "<script>window.history.back();</script>";
            
}else{
 
       $delete = "UPDATE `listings` set is_deleted=:is_deleted WHERE  id=:id AND posted_by=:posted_by";
            $stm = $con->prepare($delete);
            $stm->execute(['id'=>$id,'is_deleted'=>1,'posted_by'=>$userId]);
            $_SESSION['successMsg']= $type.' deleted successfully.';
            if($type=='Animal'){
                echo "<script>window.location='my-animals';</script>";
            }else{
               echo "<script>window.location='my-services';</script>";
            }
                

}
?>