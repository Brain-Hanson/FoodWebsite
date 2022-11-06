<?php include('partials/menu.php');?>

<div class="main-content">
     <div class="wrapper">
<h1>Add Admin</h1>

<?php
   if(isset($_SESSION['add']))//checking whether the Session is set or not
   {
    echo $_SESSION['add']; //Display the Session ,essage if Set
    unset($_SESSION['add']);//Remove Session Message
   }

?>

<br> <br>

<form action="" method="POST">

 <table class="tbl-30">
     <tr>
        <td>Full Name:</td>
        <td>
            <input type="text" name="full_name" placeholder="Enter your name">
        </td>
     </tr>
     
     <tr>
      <td>Username</td>
      <td>
        <input type="text" name="username" placeholder="Your username">
    </td>
</tr>

<tr>
   <td>Password:</td>
    <td>
     <input type="password" name="password" placeholder="Your password">
</td>
</tr>

  <tr>

  </tr>
    <td colspan="2">
    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
    </td>
</table>

</form>


     </div>



</div>




<?php include('partials/footer.php'); ?>


<?php
//Process the value from form and save it in Database
// check whether the button is clicked or not

   if(isset($_POST['submit']))
   {
        //Button Clicked
       // echo "Button Clicked";

       //Get the data from form
     $full_name=$_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']); // Password Encryption woth MD5

     //SQL Query to Save the data into database
     $sql= "INSERT INTO tbl_admin SET
      full_name='$full_name',
      username='$username',
      password='$password'
      ";
      
    // Executing Query and Saving Data into Database
      $res= mysqli_query($conn,$sql) or die(mysqli_error());
   
      // Check whether the (Query is Executed) data is inserted or not into and display appropriate message
    if($res==TRUE)
    {
        //Data inserted
       // echo "Data Inserted";
       //create a Session variable to Display Message
       $_SESSION['add'] = "<div class='success'>Admin Added Sucessfully,</div>";
       //Redirect Page to Manage Admin
       header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{ 
        //FAiled to inser data
       // echo "Failed to insert Data";
       $_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";
       //Redirect Page to Add Admin
       header("location:".SITEURL.'admin/add-admin.php');
    }
    }
   
?>