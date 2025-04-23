<?php
header("Access-Control-Allow-Origin: https://krishisampark.in");
header("Access-Control-Allow-Methods: POST");
	include '../admin/private/database.php';
	$state_id=$_POST["state_id"];
	      
    $sql = 'SELECT * FROM cities where state_id=:state_id order by city_name';
    $statement = $con->prepare($sql);
    $statement->execute(['state_id'=>$state_id]);
    $cities = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<option disabled selected>Choose City</option>
<?php
if(count($cities)>0){
foreach($cities as $c):
?>
	<option value="<?=$c->id;?>"><?=$c->city_name;?></option>
<?php
endforeach;
}else{
    echo "<option value='0'>NA</option>";
}
?>