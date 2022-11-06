<?php
include('../config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -Food Order System</title>
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
<div class="login">
    <h1 class="text-center">Login</h1>
      
    <br><br>
<?php
    if(isset($_SESSION['login']))
    {
    echo $_SESSION['login'];
    unset ($_SESSION['login']);
    }

  if (isset($_SESSION['no-login-message']))
  {
    echo $_SESSION['no-login-message'];
    unset($_SESSION['no-login-message']);
  }


?>
    
    <br><br>
<!---Login form Starts Here--->

    <form action="" method="POST" class="text-center" class="form">
      
      <p class="form-heading">Username:</p><br>
      <input type="text" name="username" placeholder="Enter Username" class="log"><br><br>

     <p class="form-heading"> Password:</p><br>
      <input type="password" name="password" placeholder="Enter Password" class="log"><br><br>
      

      <input type="submit" name="submit" value="Login" class="btn-primary">
<br><br>  
     </form>


<!---Login form Starts Here--->


<br>


   <p class="text-center">Created By - <a href="#">Brain-Hanson</a></p> 
</div>
</body>
</html>

<?php

//Check Whether the Submit Button is Clicked or Not
if(isset($_POST['submit']))
{
    //Process the Login 

    //Get the Data form Login In Form
     $username= mysqli_real_escape_string($conn,$_POST['username']);
     $password=mysqli_real_escape_string($conn,md5($_POST['password']));

     // SQL to Check whether the username and password exist or NOT
     $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

     //EXECUTE the QUERY
     $res = mysqli_query($conn,$sql);

     //Count the Rows to Check Whethe rUser EXIST or NOT
     $count= mysqli_num_rows($res);

     if($count==1)
     {
        // User Available and Login 
        $_SESSION['login']= "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;// To check whether user is logged in or not and logout will unset it




        //REDirect to Homepage/Dashboard
        header('location:'.SITEURL.'admin/index.php');
     }
     else
     {
        //User not Available
        $_SESSION['login']= "<div class='error text-center'>Username Or Password did not match.</div>";
        //REDirect to Homepage/Dashboard
        header('location:'.SITEURL.'admin/login.php');
     }


}



?>
