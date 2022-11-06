
<?php include('partials/menu.php') ?>

  <!--Main Content Section Starts-->
  <div class="main-content">
    <div class="wrapper">
      <h1>Manage  Admin</h1>
    <br> 

<?php  
  if(isset($_SESSION['add']))
  {
      echo $_SESSION['add'];//Displaying Session Message
      unset($_SESSION['add']);//REmoving Session Message
  }
    if(isset($_SESSION['delete']))
    {
      echo $_SESSION['delete'];
      unset ($_SESSION['delete']);
    }
 
    if(isset($_SESSION['update'])){
      echo  $_SESSION['update'];
      unset($_SESSION['update']);
    }

    

    if(isset($_SESSION['user-not-found']))
    {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }

    if(isset($_SESSION['pwd-not-match']))
    {
      echo $_SESSION['pwd-not-match'];
      unset($_SESSION['pwd-not-match']);
    }

    if(isset($_SESSION['change-pwd'])){
      echo $_SESSION['change-pwd'];
      unset($_SESSION['change-pwd']);
    }
    

?>
  <br><br><br>

      <!--- Button to Add Admin--->
      <a href="add-admin.php" class="btn-primary">Add Admin</a>
         
      <br> <br> <br>

      <table class="tbl-full">
        <tr>
      <th>S.N.</th>
      <th>Full Name</th>
      <th>Username</th>
      <th>Action</th>
</tr>

<?php
//Query to Get all Admin
$sql= "SELECT * FROM tbl_admin";
// EXECUTE the QUERY
  $res= mysqli_query($conn,$sql);

  //Check whether the query is Executed or not
  if($res==TRUE){
    //Count Rows to Check whether we have data in the database or not
    $count = mysqli_num_rows($res);//  Function to get all the rows in database.
  

$sn=1; //CREATE a Variable and Assign the value


    //Check the num of rows
    if($count>0){
      //WE HAVE data in the database
      while($row=mysqli_fetch_assoc($res))
      {
        //Using While loop to get all data from the database.
        //And while loop will run as long as we have data in the database

         //Get individual DATA
         $id=$row['id'];
         $full_name=$row['full_name'];
         $username=$row['username'];

         //Display the value in our Table\\
         ?>
    
       <tr>
       <td><?php echo $sn++; ?></td>
       <td><?php echo $full_name; ?></td>
       <td><?php echo $username; ?></td>
       <td>
        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php  echo $id;?>" class="btn-primary">Change Password</a>
        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php  echo $id;?>" class="btn-secondary">Update Admin</a>
          <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>

</td>
</tr>

         <?php  
         
      }
    }
     else{
      // WE DO not have DATA in the DATABASE.
     }
  
  }
?>








    
</table>

    
        <div class="clearfix"></div>


    </div>
  </div>
  <!--Main Contect Section Ends-->

  <?php include('partials/footer.php'); ?>        