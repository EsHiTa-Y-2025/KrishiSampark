<?php
session_start();
if(isset($_SESSION['userId'])){
	unset($_SESSION['userId']);
	unset($_SESSION['login']);
	
	setcookie('userLoggedIn', '', time() - 3600, '/'); 
    setcookie('userId', '', time() - 3600, '/');

}
header('location:login');
die;
?>