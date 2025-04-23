<?php 
require('private/database.php');
if(isset($_GET['id']) && isset($_GET['status'])){
	$id=$_GET['id'];
	$status=!$_GET['status'];
	
	   
	        $updstatus = "update users set status=:status where id=:id";
            $stm = $con->prepare($updstatus);
            if($stm->execute(['status'=>$status,'id'=>$id])){
               echo "<script>window.history.back();</script>";
       		}
}
?>