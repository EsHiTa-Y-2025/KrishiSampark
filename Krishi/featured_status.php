<?php 
require('private/database.php');
if(isset($_GET['id']) && isset($_GET['is_featured'])){
	$id=$_GET['id'];
	
	$is_featured=$_GET['is_featured'];
	
	
	   
	        $updstatus = "update listings set is_featured=:is_featured where id=:id";
            $stm = $con->prepare($updstatus);
            if($stm->execute(['is_featured'=>!$is_featured,'id'=>$id])){
              echo "<script>window.history.back();</script>";
       		}
     
}
?>