<?php
header("Access-Control-Allow-Origin: https://krishisampark.in");
header("Access-Control-Allow-Methods: POST");
	include '../admin/private/database.php';
	$parent_id=$_POST["parent_id"];
	      
    $sql = 'SELECT * FROM categories where parent_id=:parent_id order by cat_name';
    $statement = $con->prepare($sql);
    $statement->execute(['parent_id'=>$parent_id]);
    $categories = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<option disabled selected>Choose Sub Category</option>
<?php
if(count($categories)>0){
foreach($categories as $c):
?>
	<option value="<?=$c->id;?>"><?=$c->cat_name;?></option>
<?php
endforeach;
}else{
    echo "<option value='0'>NA</option>";
}
?>