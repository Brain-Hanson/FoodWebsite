<?php
//Start Session
session_start();



//create constant to store non Repeating Values
define('SITEURL','http://localhost/Fd/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');



//Execute Query and save Data into Database
$conn= mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());// Database Connection
$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());// Selecting Database

?>