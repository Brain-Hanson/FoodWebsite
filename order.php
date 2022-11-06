<?php include('partials-front/menu.php') ?>

        <?php

        //Check k whether food id is SET or not
        if(isset($_GET['food_id']))
        {
            //GET The FOOD ID and details of the selected food
            
            $food_id = $_GET['food_id'];

            //GET the details of the Selected Food
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            //EXECUTE THE QUERY
            $res=mysqli_query($conn,$sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if($count==1)
            {
                //we HAVE Data
                //Get the details from database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];


            }
            else{
                //Food not AVAILABLE
                //RREDIRECT TO hOMEPage
                header('location:.SITEURL');
            }
        }
        else{
            //REDIRECT to homepage
            header('location:'.SITEURL);
        }


        ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="orderform">
        <div class="container">
            
            <h2 class="text-center text-white">Fill the form to process your Order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                    
                    <div class="food-menu-img">

                    <?php 
                    
                    //Check Whether the image is available
                    if($image_name=="")
                    {
                        //Image is not Available
                        echo "<div class='error'>Image is Available.</div>";
                    }
                    else{
                        //Image is Available
                        ?>
                        <img src="<?php echo SITEURL;  ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;   ?></h3>
                    <input type="hidden" name="food" value="<?php  echo $title; ?>">

                        <p class="food-price">$<?php echo $price;  ?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Brain-Hanson" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="+233 5273" class="input-responsive" required>

                    <div class="order-label">Email Address</div>
                    <input type="email" name="email" placeholder="emmanuel@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
        //  Check whether Submit Button ids Clocked or nOT
        if(isset($_POST['submit']))
        {
            //Get all the details from the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;// total = price * qty

            $order_date = date("Y-m-d H:i:s");// Order Date

            $status = "Ordered"; // Ordered ,On Delivered, Delivered,Cancelled
            
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            //Save the order to Databse
            //Create SQL to Save the data
            $sql2 = "INSERT INTO tbl_order SET
            food = '$food',
            price =$price,
            qty   = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
            ";

            //echo $sql2; die();
            

            //EXECUTE THE QUERY
            $res2 = mysqli_query($conn,$sql2);

            
                //$conn = mysqli_connect("localhost", "root", "", "food-order");
                //if (mysqli_connect_errno()) {
                //printf("Connect failed: %s\n", mysqli_connect_error());
               // exit();
                //}

                //$sql2 = "INSERT INTO tbl_order SET
                //food = '$food',
               // price =$price,
                //qty   = $qty,
             //total = $total,
              // order_date = '$order_date',
              //  status = '$status',
               // customer_name = '$customer_name',
               // customer_contact = '$customer_contact',
               // customer_email = '$customer_email',
              //  customer_address = '$customer_address'
               // ";
               // echo "<pre>Debug: $sql2</pre>\m";
                //$result = mysqli_query($conn, $sql2);
                //if ( false===$result ) {
                //printf("error: %s\n", mysqli_error($conn));
                //}
               // else {
                //echo 'done.';
                //}
        
           
            //Check whether The QUERY IS SUCESSFUL OR NOT
            if($res2==true)
            {

                //QUERY has been EXUCUTED SUCESSFULLY
                $_SESSION['order'] ="<div class='success text-center'>Food Ordered Sucessfully</div>";
                header('location:'.SITEURL);

                
            }
            else
            {
                //FAILED TO SAVE ORDER
                $_SESSION['order'] ="<div class='error text-center'>Failed to Order Food</div>";
                header('location:'.SITEURL);
            }

        }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php') ?>