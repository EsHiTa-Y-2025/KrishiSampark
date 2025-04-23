<?php
header("Access-Control-Allow-Origin: https://krishisampark.in");
header("Access-Control-Allow-Methods: POST");
	include '../admin/private/database.php';
	$cat_id=$_POST["cat_id"];
	      
    $sql = 'SELECT * FROM more_varieties where cat_id=:cat_id order by name';
    $statement = $con->prepare($sql);
    $statement->execute(['cat_id'=>$cat_id]);
    $categories = $statement->fetchAll(PDO::FETCH_OBJ);
    if(count($categories)>0){
?>
<option disabled>Choose Variety</option>
<?php

foreach($categories as $c):
?>
	<option value="<?=$c->id;?>"><?=$c->name;?></option>
<?php
endforeach;
}else{
    echo "NA";
}
?>