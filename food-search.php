<?php include('partials-front/menu.php') ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php  
            
            //GET The SEARCH KEY WORD
            $search = mysqli_real_escape_string($conn,$_POST['search']);
            
            
            ?>
            <h2><span class="fds">Results<a href="#" class="text-white"><?php  echo $search; ?></span></a></h2>

        </div>
    </section>
    <br><br>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center heading"> Menu</h2>

            <?php     

            //SQL QUERY TO GET FOOD BASED ON SEARCH KEY WORD

            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //EXECUTE THE QUERY 
            $res = mysqli_query($conn,$sql);

            //Count Rows 
            $count = mysqli_num_rows($res);

            //Check Whether the food is available
            if($count>0)
            {
                //Food Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //GET THE DETAILS
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                         <div class="food-menu-img">
                            <?php  
                            
                            //CHECK WHETHER IMAGE NAMe is available or
                            if($image_name=="")
                            {
                                //Image is not Available
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else{
                                //Image Available
                                ?>

                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;  ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                <?php

                            }
                            

                            
                            ?>
                            
                                </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;   ?></h4>
                              <p class="food-price"><?php echo $price;  ?></p>
                                 <p class="food-detail">
                                    <?php  echo $description; ?>
                             </p>
                                <br>

                                        <a href="#" class="btn btn-primary">Order Now</a>
                                    </div>
            </div>
                <?php

                }
            }
            else
            {
                //Food not Available
                echo "<div class='error'>Food Not Found</div>";
            }
            ?>




            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>