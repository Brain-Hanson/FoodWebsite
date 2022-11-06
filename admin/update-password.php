
<?php  include('partials/menu.php');  ?>

<div class="main-content">
<div class="wrapper">
   <h1>Change Password</h1>
   <br><br>

 <?php

if(isset($_GET['id']))

{
    $id=$_GET['id'];
}
?>



   <form action="" method="POST">

  <table class="tbl-30">
    <tr>
        <td>Old Password:</td>
        <td>
            <input type="password" name="current_password" placeholder="Current Password">
        </td>
</tr>

        <tr>
            <td>New Password:</td>
            <td>
            <input type="password" name="new_password" placeholder="New Password">
</td>
</tr>

    <tr>
     <td>Confirm Password</td>
    <td>
     <input type="password" name="confirm_password" placeholder="confirm Password">
</td>
    </tr>

    <tr>
        <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="change password" class="btn-secondary">
        </td>
</tr>

</table>
</form>

</div>

</div>



<?php

        //  Check whether the Sunmit Button Is clicked or Not
        if(isset($_POST['submit']))
        {
           // echo "clicked";
        

        // Get the Data from Form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
     
     
         //2.Check whether the user with Current ID and Current Password EXists or Not..
         $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
     
         
         //3. Check Whether the New Password and COnfirm Password Patch OR nOT
     
     $res = mysqli_query($conn,$sql);
     
     if($res==true)
     {
         //Check Whether data is Available Or Not
         $count=mysqli_num_rows($res);
     
         if($count==1)
         {
             //User Exists and Password Can be Changed
              //echo "User Found";
              //Check whether the new password and Confirm password match
               if($new_password==$confirm_password)
               {
                //Update the password
                 $sql2 = "UPDATE tbl_admin SET
                 password='$new_password'
                 WHERE id=$id
                 ";

                 //Execute the Query
                 $res2 = mysqli_query($conn,$sql2);

                 //Check Whether the Query is executed or not
                  if($res2==true)
                  {
                    //Display Success Messages
                    //Redirect to Manage Admin Page with Sucess Message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Sucessfully.</div>";
                        //REdirect the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                  }
                  else{
                    // Display Error Message
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                        //REdirect the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                  }
               
                }
               else{
                //Redirect to Manage Admin Page with Error Message
                $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Match.</div>";
                //REdirect the User
                header('location:'.SITEURL.'admin/manage-admin.php');

               }
         }
         else{
            
            //User Does not Exist Set , Set Message and REdirect 
            $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";
         //REdirect the User
         header('location:'.SITEURL.'admin/manage-admin.php');
        
        }
    }
     }
    


?>


<?php include('partials/footer.php'); ?>