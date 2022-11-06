<?php include('partials/menu.php'); ?>

<?php

//Check whether the id is set or not
 if(isset($_GET['id']))
 {
    $id = $_GET['id'];

        //SQL QUERY to Get the Selected Food 
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        //EXECUTE the QUERY
        $res2 = mysqli_query($conn,$sql2);

        //GET the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //GET the Individual Values of Food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category= $row2['category_id'];
        $featured=$row2['featured'];
        $active=$row2['active'];
 }
 else
 {
    //REDirect to Manage  Food
    header('location:'.SITEURL.'admin/manage-food.php');
    
 }

?>




<div class="main-content">

<div class="wrapper">
    <h1>Update Food </h1>
    <br><br>

    <form action=""method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value ="<?php echo $title; ?>" >
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                <textarea name="description"  cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>  
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image </td>
                <td>
                    <?php

                    if($current_image == "")
                    {
                        //Image not Available
                        echo "<div class='error'>Image not Available.</div>";
                    }
                    else{
                        //Image Available
                        ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" alt="<?php echo $title;  ?>" width="150px">
                        <?php
                    }

                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">

                    <?php
                    //QUERY to Get Active Categories
                        $sql = "SELECT * FROM tbl_category WHERE active ='Yes' ";
                    //EXECUTE the QUERY
                    $res = mysqli_query($conn, $sql);

                    //Count ROWS
                    $count = mysqli_num_rows($res);

                    //Check Whether Category is Available or Not
                    if($count>0)
                    {
                        //CAtegory is Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $category_title = $row['title'];
                            $category_id =$row['id'];

                           // echo "<option value='$category_id'>$category_title</option>";
                        ?>
                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                        <?php
                        }
                    }
                    else
                    {
                        //Category is Not Available
                        echo "<option value='0'>Category Not Available</option>";

                    }

                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No") { echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
            </tr> 

            <tr>
                <td>
                     <input type="hidden" name="id" value="<?php echo $id; ?>">   
                     <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>

        </table>

    </form>

    <?php
    
    //Check whether the button is Clicked or Not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";

        //1.Get all the details from the form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description= $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category= $_POST['category'];

        $featured = $_POST['featured'];
        $active = $_POST['active'];
                                
        

        //2.Updating the new Image If Selected
        //1.Check whether the new image is Selected
        if(isset($_FILES['image']['name']))
        {
            //GET The image details
            $image_name = $_FILES['image']['name'];

            //Check whether the image is available or not
            if($image_name!="")
            {
                //Image Available

                //A. Upload the new IMage

                  //Auto Rename Our image
            //Get the Extention of our image(jpg,png,gif,etc)e.g. "specialfoods.jpg"
            $ext = end(explode('.',$image_name));
             
            //Rename the image
            $image_name = "Food_Name_".rand(000, 999).'.'.$ext;//e.g. Food_Category_834.jpg
            
            $source_path = $_FILES['image']['tmp_name'];
            
            $destination_path = "../images/food/".$image_name;
        
            //  Upload Image and set the image_name value as blank
            $upload = move_uploaded_file($source_path,$destination_path);
        
            //Check whether the image is uploaded or not
            //And if the image is not uploaded then we will stop the persons and redirect with error message
            if($upload==false)
            {
                //SEt Message
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                //Redirect to Add Category
                header('location:'.SITEURL.'admin/manage-food.php');
               
                //Stop the Process
                die();
            }

                //B.Remove CUrrent Image if available
                if($current_image!="")
                {
                    $remove_path = "../images/food/".$current_image;

                $remove = unlink($remove_path);

                //Check whether the Image is Removed or Not
                //If failed to remove then display message and stop the process
                if($remove==false)
                {
                    //FAILED TO remove the image
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove Current Image.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();//Stop the Process
                }

                }
                
                 
            } 
            else
            {
                $image_name = $current_image;
            }
        }
        else
        {
            $image_name = $current_image;
        }


        
        
        //4.Update the food in Database

        $sql3 = "UPDATE tbl_food SET
        title= '$title',
        description= '$description',
        price = $price,
        image_name = '$image_name',
        category_id = '$category',
        featured = '$featured',
        active = '$active'
        WHERE id=$id
        ";

        //Execute the SQL QUERY
        $res3 = mysqli_query($conn,$sql3);

        //Check  whether the query is executd or not
        if($res3==true)
        {
            //QUERY EXecuted and Food Updated  
            $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            //Failed to Update Food
            $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        
    }
    
    
    ?>
</div>

</div>



<?php include('partials/footer.php'); ?>