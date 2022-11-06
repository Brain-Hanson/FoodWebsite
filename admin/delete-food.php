    <?php
    //Include  Constant Page
    include('../config/constants.php');

    //echo"Delete";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to Delete
          //echo "Process to Delete";

        //GET ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];


        //Remove the image if Available
        //Check Whether the image is available or not and Delete only if available
        if($image_name !="")
        {
            //IT has image and need to remove from folder
            //Get the image Path
            $path = "../images/food/".$image_name;
        
            //REmove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove == false)
            {
                //Failed to remove page
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File. </div>";
                //REdirect to Manage Food
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the process of Deleting the Food
                die();
            }
        
        }


        //Delete Food  from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        //EXECUTE the QUERY
        $res = mysqli_query($conn,$sql);

        //CHECK whether the query is executed or not and set the session message respectively
        //Redirect to Manage Food with Session Message
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'> Food Deleted Sucessfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');


        }
        else{
            //Failed to Delete Food 
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }


        
    }
    else
    {
        //REdirect to Manage Food Page 
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

    ?>