<?php
include('partials/menu.php');
?>
<div class="main-content">


<div class="wrapper">
<h1>Add Category</h1>

<br><br>

<?php


    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }



    if(isset($_SESSION['upload']))
    {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }







?>
<br><br>




<!---Add Category Form Starts-->
<form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">
<tr>
    <td>Title:</td>
    <td>
        <input type="text" name="title" placeholder="Category Title">
    </td>
</tr>

<tr>
    <td>Select Image:</td>
    <td>
        <input type="file" name="image">
    </td>
</tr>





<tr>
 <td>Featured:</td>
 <td>
    <input type="radio" name="featured" value="Yes">Yes
    <input type="radio" name="featured" value="No">No
 </td>
</tr>

<tr>
    <td>Active:</td>
    <td>
        <input type="radio" name="active" value="Yes">Yes
        <input type="radio" name="active" value="No">No
    </td>
</tr>

<tr>
    <td colspan="2">
        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
    </td>

</tr>

</table>

</form>

<!---Add Category Form Ends-->

<?php
     //Check Whether the Submit Button Is Clicked or Not
     if(isset($_POST['submit']))
     {
        //echo "clicked";

        //GET the value from Category Form
        $title = $_POST['title'];

        //For Radio Input Type, we need to check the button is selected or not.
        if(isset($_POST['featured']))
        {
            //Get the value from form 
            $featured = $_POST['featured'];       
        }
        else{
            //SET the DEFault Value
            $featured = "No";
        }
        if(isset($_POST['active']))
        {
            $active = $_POST['active'];

        }
        else{
            $active = "No";
        }


        //  Check whether the image is selected or not and set the value for image name acccordingly
        //print_r($_FILES['image']);

        //die();//Break the code Here

        if(isset($_FILES['image']['name']))
        {
            //Upload the image
            //To upload image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];
            
            //Upload the image only if Image is Selected
            if($image_name !="")
            {

            



            //Auto Rename Our image
            //Get the Extention of our image(jpg,png,gif,etc)e.g. "specialfoods.jpg"
            $ext = end(explode('.',$image_name));

            //Rename the image
            $image_name = "Food_Category_".rand(000, 999).'.'.$ext;//e.g. Food_Category_834.jpg
            
            $source_path = $_FILES['image']['tmp_name'];
            
            $destination_path = "../images/category/".$image_name;
        
            //  Upload Image and set the image_name value as blank
            $upload = move_uploaded_file($source_path,$destination_path);
        
            //Check whether the image is uploaded or not
            //And if the image is not uploaded then we will stop the persons and redirect with error message
            if($upload==false)
            {
                //SEt Message
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                //Redirect to Add Category
                header('location:'.SITEURL.'admin/add-category.php');
               
                //Stop the Process
                die();
            }
            
           }
           
        }       
        else
        {
            //Don't Upload and set the image_name value as Blank
            $image_name="";
        }




        // 2. CREATE SQL QUERY TO Insert Category Into DataBase
        $sql = "INSERT INTO  tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";

        // EXECUTE the QUERY and Save into the Database
        $res = mysqli_query($conn,$sql);

      
        //Check Whether the QUERY has been EXECUTED OR NOT and Data Added or not
        if($res == true)
        {
            //QUERY EXECUTED and Category
            $_SESSION['add']="<div class='success'>Category Added Sucessfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else
        {
                //Failed to Add Category
                $_SESSION['add']="<div class='error'>Failed to Add Category.</div>";
            header('location:'.SITEURL.'admin/add-category.php');
        }

        

}

?>



</div>

</div>


<?php
include('partials/footer.php');
?>