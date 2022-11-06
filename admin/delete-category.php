    <?php 
        //  Include Conatants File
            include('../config/constants.php');


    //echo "Delete Page";
    //Check whether the id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        //echo "Get Value and Delete";
        //Getting the Values 
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //Remove the physical image file if available
        if($image_name !="")
        {
            //Image is Available. So remove
            $path = "../images/category/".$image_name;
            //REmove the Image
            $remove = unlink($path);

            //If it fails to remove Image then add an error message and stop the process
            
            if($remove==false)
            {
                //Set the SEssion Message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //REdirect to Manage Category Page
                header('location'.SITEURL.'admin/manage-category.php');
                
                //Stop the Process
                die();
            }
        }

        //Delete Data from Database
        
        //SQL QUERY to DELTE DATA FROM Database
        $sql="DELETE FROM tbl_category WHERE id=$id"; 

        //EXECUTE the QUERY
        $res = mysqli_query($conn,$sql);

        //Check Whether the data is Deleted from the DATABASE or NOT
        if($res==true)
        {
            //SET SUCCESS MESSAGE and REdirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            //REdirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        else{
            //SET FAILED MEASSGE and Redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //REdirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        
    }
    else
    {
        //Redirect to Manage Category PaGE
    
        header('location:'.SITEURL.'admin/manage-category.php');

    }



    ?> 