<?php include('partials/menu.php');?>

<div class="main-content">

   <div class="wrapper">
    <h1>Update Category</h1>


       <br><br>

<?php

    //Check whether the id is set or not
    if(isset($_GET['id']))
    {
        //GET the id and all other details
        //echo "Getting the data";
        //Getting ID
        $id= $_GET['id'];
        
        //CREATE SQL to GET all other Details
        $sql =  "SELECT * FROM tbl_category WHERE id=$id";
    
        //EXECUTE the QUERY
        $res= mysqli_query($conn,$sql);

        //Count the Rows to Check whether the ID is valid or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //Get all the data  
            $row = mysqli_fetch_assoc($res);
            $title= $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];

        }
        else
        {
            //REdirect to Manage Category with Session Message
       
             $_SESSION['no-category-found'] = "<div class='error'>Category not Found</div>";
             header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        //REdirect to Manage Directory
        header('location:'.SITEURL.'admin/manage-category.php');
    }


?>


    <form action="" method="POST" enctype="multipart/form-data" >

       <table class="tbl-30">

       <tr>
        <td>Title :</td>
        <td>
            <input type="text" name="title" value="<?php echo $title;  ?>">
        </td>
       </tr>

    <tr>
        <td>Current Image:</td>
        <td>
            <?php   
            
            if($current_image !="")
            {
                //Display the Image
                ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                <?php
            }
            else
            {
                //Display Message
                echo "<div class='error'>Image Not Added</div>";
            }
            
            
            ?>
        </td>
    </tr>

    <tr>
        <td>New Image: </td>
        <td>
            <input type="file" name="image">
        </td>
    </tr>

    <tr>
        <td>Featured:</td>
        <td>
            <input <?php if($featured=="Yes"){echo "checked";}  ?> type="radio" name="featured" value="Yes">Yes
            
            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
        </td>
    </tr>

    <tr>
        <td>Active:</td>
        <td>
        <input <?php if($active=="Yes"){echo "checked";}  ?> type="radio" name="active" value="Yes">Yes
            
            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
        </td>
    </tr>
        
    <tr>
        <td>
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
        </td>
      
    </tr>

       </table>

  </form>


  <?php


    //Check if submit Button is clicked or Not
    if(isset($_POST['submit']))
    {
        //echo "ClicKed";
        //1.Get all the values from our form

        $id = $_POST['id'];
        $title=$_POST['title'];
        $current_image=$_POST['current_image'];
        $featured=$_POST['featured'];
        $active = $_POST['active'];
        
        //2Updating New Image if Selected
        //Check Whether the image is Selected or not
        if(isset($_FILES['image']['name']))
        {
            //Get the Image Detais
            $image_name = $_FILES['image']['name'];

            //Check whether the image is available or not
            if($image_name !="")
            {
                //Image Available
                //A.Upload the new image
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
                header('location:'.SITEURL.'admin/manage-category.php');
               
                //Stop the Process
                die();
            }
            
                //B.REmove the current Image if it is available
                if($current_image!="")
                {

                    $remove_path = "../images/category/".$current_image;
               
                $remove = unlink($remove_path);

                //Check whether the image is removed or not
                //If failed to remove then display message and stop the process
                if($remove==false)
                {
                    // Failed to remove image
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();// To stop the process
                }

                }
                
            }
            else{
                $image_name = $current_image;
            }
        }
        else{
            $image_name = $current_image;
        }


        //3Update the Databse
        $sql2 = "UPDATE tbl_category SET
            title= '$title',
            image_name= '$image_name',
            featured='$featured',
            active = '$active'
            WHERE id=$id
        
        ";


        //EXECUTE the Query
        $res2= mysqli_query($conn,$sql2);

        //4REdirect to Manage Category with MEssage
        //Check whether qUERY is executed or NOt
        if($res2==true)
        {
            //Category Updated
            $_SESSION['update'] = "<div class='success'>Category Updated Sucessfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else{
            //Failed to Update Category 
            $_SESSION['update'] = "<div> class='error'>Failed to Update Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }


?>

   </div>
</div>


<?php include('partials/footer.php');?>