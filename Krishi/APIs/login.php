<?php
require '../admin/private/database.php';

if(isset($_POST['email']) AND isset($_POST['password'])){
    
        $Checkquery = "select * from users where email = :email limit 1";
        $checkstm = $con->prepare($Checkquery);
        $check = $checkstm->execute(['email'=>$_POST['email']]);
        if(($check)){
            $data = $checkstm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($data) && count($data)>0){
                $data = $data[0];
                if($data->status==1){
                    $password = $data->password;
                    $userPassword = md5($_POST['password']);
                    if($password==$userPassword){
                        echo json_encode(array('success'=>true,'message'=>1,'userId'=>$data->userId));
                    }else{
                        echo json_encode(array('success'=>true,'message'=>2));
                    }
                }else{
                    echo json_encode(array('success'=>true,'message'=>3));
                }
            }else{
                echo json_encode(array('success'=>true,'message'=>0));
            }
        }
        
        
        
}
        
?>