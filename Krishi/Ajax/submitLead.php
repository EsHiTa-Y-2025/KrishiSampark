<?php
	include '../admin/private/database.php';
	$leadName=$_POST["leadName"];
	$leadPhone=$_POST["leadPhone"];
	$ad_id=$_POST["ad_id"];
	$created_at=date('d-m-Y H:i:s');
	
    $arr['name']=$leadName;
    $arr['contact']=$leadPhone;
    $arr['ad_id']=$ad_id;
    $arr['date']=$created_at;
            
            $add = "INSERT INTO `leads` (`ad_id`, `name`, `contact`, `date`) VALUES (:ad_id,:name,:contact,:date)";
            $stm = $con->prepare($add);
            if($stm->execute($arr)){
                      echo "success";
            }else{
                echo "failed";
            }
?>