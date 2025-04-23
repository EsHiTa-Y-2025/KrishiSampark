<?php 
require('private/database.php');
if(isset($_GET['id']) && isset($_GET['is_verified'])){
	$id=$_GET['id'];
	
	$is_verified=$_GET['is_verified'];
	
	if($is_verified==1){
	    $is_verified=0;
	}else{
	    $is_verified=1;
	}
	
	   
	        $updstatus = "update listings set is_verified=:is_verified where id=:id";
            $stm = $con->prepare($updstatus);
            if($stm->execute(['is_verified'=>$is_verified,'id'=>$id])){
              echo "<script>window.history.back();</script>";
       		}
     
}
?>