<?php include ('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
    <h1>Add Food</h1>

    <br><br>

    <?php
    if(isset($_SESSION['upload']))
    {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }




?>






<form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
    <tr>
        <td>Title: </td>
        <td>
            <input type="text" name="title" placeholder="Title of the Food">
        </td>
    </tr>

    <tr>
        <td>Description</td>
        <td>
            <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
        </td>
    </tr>

    <tr>
        <td>Price:</td>
        <td>
            <input type="number" name="price">
        </td>
    </tr>
    <tr>
        <td>Select Image:</td>
        <td>
            <input type="file" name="image">
        </td>
    </tr>
    <tr>
        <td>Category:</td>
        <td>
            <select name="category" >
                <?php

                    //Create PHP Code to Display Categories From Database
                    //1.Create SQL QUERY to get all active Categories from Database
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                    //EXECUTE the QUERY
                    $res = mysqli_query($conn,$sql);

                    //cOUNT Rows to check whether we have categories or not
                    $count = mysqli_num_rows($res);

                    //IF Count is greater than ZERO, we have categories else we do not have categories
                     if($count>0)
                     {
                        //WE have Categories
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get the details of Category
                            $id = $row['id'];
                            $title = $row['title'];

                            ?>

                            <option value="<?php echo $id;  ?>"><?php echo $title; ?></option>
                            <?php
                        }
                     }
                     else
                     {
                        //We do not have category
                        ?>
                            <option value="0">No Category Found</option>
                        <?php
                     }
                    //Display on Dropdown

                ?>

   
            </select>
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
            <input type="submit" name="submit" value="Add Food" class="btn-secondary ">
        </td>
    </tr>

        </table>


</form>

    <?php
            
            //Check wether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Food in the Database
               // echo "Clicked";
               
               //1. Get the DAta from Form
               $title =$_POST['title'];
               $description = $_POST['description'];
               $price = $_POST['price'];
               $category= $_POST['category'];

               //Check whether radio Button For Featured and Active are Checked or Not
               if(isset($_POST['featured']))
               {
                $featured = $_POST['featured'];
               }
               else
               {
                $featured = "No";//SEtting the DEfault Value
               }

               if(isset($_POST['active']))
               {
                $active = $_POST['active'];
               }
               else
               {
                $active = "No";//Default Value
               }

               //2.Upload the Image if Selected
               //Check whether the select Image is Selected or not and upload the image if the image is selected
               
              // print_r($_FILES['image']);

             //die();

             if(isset($_FILES['image']['name']))
             {
                //UPLOAD the image
                //To upload the image , we need image name and source and destination path
                $image_name = $_FILES['image']['name'];

            //Upload the Image only if Image is Selected
            if($image_name !="")
            {

                //Auto rename our image
                //Get the extension of our image(jpg,gif,png)eg.food1.jpg
                $ext = end(explode('.',$image_name));

                //Rename Image
                $image_name = "Food_Name_".rand(000,999).'.'.$ext;


                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/food/".$image_name;

                //Finally Upload the Image

                $upload = move_uploaded_file($source_path,$destination_path);

                //Check whether the image is uploaded or not
                //And if the image is not uploaded then we will stop the process and redirect with error message
                if($upload==false)
                {
                //Set message
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                //  Redirect to Add Food Page
                header('location:'.SITEURL.'admin/add-food.php');
                //Stop the Process
                die();
                } 

            }
             }
             else
             {
                //Dont UPload Image and Set the image name value as blank
             $image_name="";
            }

               //3.Insert Into Database
               
               //Create SQL QUERY to Save or Add Food
               
               $sql2 = "INSERT INTO tbl_food SET
               title = '$title',
               description = '$description',
               price = $price,
               image_name ='$image_name',
               category_id = $category,
               featured = '$featured',
               active = '$active'
               ";

               //EXECUTE the QUERY
               $res2 = mysqli_query($conn,$sql2);
               //4.REdirect with Message to Manage Food Page
               //Check wether data inserted or not

               if($res2 == true)
               {
                //Data inserted Successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
               }
               else{
                //Failed to Insert Data
                $_SESSION['add'] = "<div class='error'>Failed to Add Food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
               }

    
            }

    ?>


</div>
    </div>








<?php include('partials/footer.php'); ?>
