<?php 
require('private/database.php');
if(isset($_GET['user'])){
	    $user=$_GET['user'];
	
	    $getSubs = "select * from subscriptions where userId=:userId && status=:status";
	    $stmForSubs = $con->prepare($getSubs);
	    $stmForSubs->execute(['userId' => $user,'status'=>'Success']);
        $subsData = $stmForSubs->fetchAll(PDO::FETCH_OBJ);
        
        $subsId = $subsData[0]->id;
        
        
	        $updstatus = "update users set is_subscribed=:is_subscribed,plan=:plan,is_trusted=:is_trusted,is_verified=:is_verified,is_plus	=:is_plus where userId=:userId";
            $stm = $con->prepare($updstatus);
            if($stm->execute(['is_subscribed'=>0,'userId'=>$user,'plan'=>NULL,'is_plus'=>0,'is_verified'=>0,'is_trusted'=>0])){
                $updSubs = "update subscriptions set status=:status where id=:id";
                $stmSubs = $con->prepare($updSubs);
                if($stmSubs->execute(['status'=>'Cancelled','id'=>$subsId])){
                   echo "<script>window.history.back();</script>";
           		}
       		}
}
?>