<?php 
session_start();
ini_set("display_errors", 1);
require 'admin/private/database.php';
require 'admin/private/functions.php';


function getUserIp(){
    switch (true){
        case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
        case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
        case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) :return $_SERVER['HTTP_X_FORWARDED_FOR'];
        default : return $_SERVER['REMOTE_ADDR'];
    }
}
$ip_add=getUserIp();

date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)

?>