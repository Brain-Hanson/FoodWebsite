<?php 

//Include Constants.php file here
include('../config/constants.php');

//1.get the ID of Admin to be deleted
   $id = $_GET['id'];

// 2. Create SQL Query to Delete Admin
$sql= "DELETE FROM tbl_admin WHERE id=$id";

//EXECUTE the Query
$res = mysqli_query($conn,$sql);

//Check whether whether the Query has been Executed Sucessfully or not
  if($res==true){

  //Query  Executed Sucessfully and Admin Deleted
   //echo "Admin Deleted";
//create SEssion variable to Display Message
   $_SESSION['delete'] = "<div class='success'>Admin Deleted Sucessfully.</div>";
   //Redirect to Manage Admin Page
   header('location:'.SITEURL.'admin/manage-admin.php');
   

}

  else{
    //Failed to Delete Admin 
    //echo "Failed to Delete Admin";

    $_SESSION['deleted'] = "<div class='error'>Failed To Delete Admin, Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php'); 
}

// 3. Redirect to Admin page with message(sucess/error)



?>