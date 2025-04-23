<?php
require '../admin/private/database.php';
require '../admin/private/functions.php';

if(isset($_POST['name']) AND isset($_POST['user_type']) AND isset($_POST['phone'])){
    date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
    $date = date('d M, Y');
    $userId = generateRandomString(10);

    $existingUser = true;

    while ($existingUser) {
        $checkQuery = "SELECT * FROM users WHERE userId = :userId LIMIT 1";
        $checkStmt = $con->prepare($checkQuery);
        $checkUserId = $checkStmt->execute(['userId' => $userId]);

        if ($checkUserId) {
            $data = $checkStmt->fetchAll(PDO::FETCH_OBJ);

            if (is_array($data) && count($data) < 1) {
                $existingUser = false;
            } else {
                $userId = generateRandomString(10);
            }
        }
    }
    
                $createUser = "insert into users (name,user_type,status,created_at,phone,userId,profile_pic,language,crops) values(:name,:user_type,:status,:created_at,:phone,:userId,:profile_pic,:language,:crops)";
                $stm = $con->prepare($createUser);
                $stm->execute(['user_type'=>$_POST['user_type'],'status'=>1,'name'=>$_POST['name'],'created_at'=>$date,'phone'=>$_POST['phone'],'userId'=>$userId,'profile_pic'=>'','crops'=>$_POST['crops'],'language'=>$_POST['language']]);
                
                echo json_encode(array('success'=>true,'message'=>1,'user_id'=>$userId));
            
        
    
        
}else{
    echo json_encode(array('success'=>false,'message'=>'Error'));
}
        
?>