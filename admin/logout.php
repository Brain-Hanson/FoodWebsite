
<?php
//Include constrants.php for SITEURL
include('../config/constants.php');
// Destroy the session
Session_destroy(); //Unsets $_SESSION['user'];

//REdirect to Login Page
header('location:'.SITEURL.'admin/login.php');

?> 