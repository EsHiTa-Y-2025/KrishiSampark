<?php
session_start();
	include '../admin/private/database.php';
	
	$userId=$_SESSION['userId'];

   $location = $_POST["location"];


$sql = "SELECT * FROM cities ORDER BY city_name ASC";
$stm = $con->prepare($sql);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_OBJ);

// Check if the provided location matches any city name
$locationExists = false;
$locationId = '';
foreach ($result as $row) {
    if (strcasecmp($location, $row->city_name) == 0) {
        $locationExists = true;
        $locationId = $row->id;
        break;
    }
}

if ($locationExists) {
    
    
    $arr['userId'] = $userId;
$arr['city'] = $locationId;

     $add = "UPDATE `users` set city = :city where userId = :userId ";
            $stm = $con->prepare($add);
            if($stm->execute($arr)){
                      echo "success";
            }else{
                echo "failed";
            }
            
   
} else {
    
    echo "Location doesn't exist in the database.";
}

            
           
?>