
<?php
//Authorization  -Acess Control
//Check whether the user is logged in or not
 if(!isset($_SESSION['user']))// If user session is not checked
   {

     // user is not logged in
     //REdirect to login page with message
     
     $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to access Admin Panel</div>";
 
     //REdirect to Login Page
     header('location:'.SITEURL.'admin/login.php');
 
    }


?>
