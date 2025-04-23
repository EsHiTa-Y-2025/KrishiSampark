<?php
session_start();
if(isset($_SESSION['admin_url'])){
	unset($_SESSION['admin_url']);
}
header('location:login');
die;
?>