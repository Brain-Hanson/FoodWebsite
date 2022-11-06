<?php include('partials-front/menu.php');   ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

        <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }



?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Our Category of Foods</h2>

                <?php

            //  CREATE SQL QUERY TO DISPLAY CAtegories fROM DATABASE
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='YES' LIMIT 3";

                    //EXECUTE the QUERY

                    $res = mysqli_query($conn, $sql);

                    //Count Rows to Check Whether the Category Is Available or Not
                    $count= mysqli_num_rows($res);

                    if($count>0)
                    {
                        //Categories Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get the Values like title,imagename,id
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name =$row['image_name'];
                            ?>
                            
                            <a href = "<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                    //Check Whether Image is available or NOT
                                    if($image_name=="")
                                    {
                                        //Dispaly Message
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>
                                    
                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                        </a>                                    
                            <?php
                        }
                    }
                    else
                    {
                        //Categories not Available
                        echo "<div class='error'>Category not Added.</div>";
                    }

                ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center heading">Menu</h2>
            
            <?php

                //Getting Foods from DAtabase that are active and featured
                //SQL QUERY
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //EXECUTE the QUERY
                $res2 = mysqli_query($conn,$sql2);

                //COUNT ROWS
                $count2 = mysqli_num_rows($res2); 
                
                //Check whether food available or not 
                    if($count2>0)
                    {
                        //Food is Available
                        while($row=mysqli_fetch_assoc($res2))
                        {
                            //GET all the values
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $description = $row['description'];
                            $image_name = $row['image_name'];
                            ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                    
                                        //Cjheck whetehr image is Available or not
                                        if($image_name=="")
                                        {
                                            //Image is Not Available
                                            echo "<div class='error'>Image is not Available.</div>";

                                        }
                                        else
                                        {
                                            //Image is Available
                                            ?>
                                                <img src="<?php echo SITEURL;  ?>images/food/<?php echo $image_name; ?>" alt="chicken Hawian Momo" class="img-responsive img-curve">
                                            <?php
                                            
                                        }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price;  ?></p>
                                    <p class="food-detail">
                                        <?php echo $description;  ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id;  ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    else
                    {
                        //Food is Not AVailable
                        echo "<div class='error'>Food not available</div>";
                    }


            ?>

  

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php  SITEURL;  ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Nyonator Brain-Hanson</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>