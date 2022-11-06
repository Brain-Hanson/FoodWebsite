<?php
 include('partials/menu.php');?>

<div class="main-content">
	<div class="wrapper">
		<h1>Manage Order</h1>

		<br><br>
		<!--- Button to Add Admin--->
		
		<br> <br> <br>

      <?php

      if(isset($_SESSION['update']))
      {
         echo $_SESSION['update'];
         unset($_SESSION['update']);
      }
      
         ?>
<br><br>
      <table class="tbl-full">
        <tr>
      <th>S.N.</th>
      <th>Food</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Total</th>
      <th>Order Date</th>
      <th>Status</th>
      <th>Customer Name</th>
      <th>Contact</th>
      <th>Email</th>
      <th>Address</th>
      <th>Action</th>
      </tr>

      <?php
         //GET all the orders from Database

         $sql = "SELECT * FROM tbl_order ORDER BY id DESC";// DISPLAY ORDER of new Arrivals

         //EXECUTE the QUERY
         $res = mysqli_query($conn,$sql);
         //Count the rows
         $count = mysqli_num_rows($res);

         $sn = 1;// Create Serial Number and set its default value to one


         if($count>0)
         {
            //Order Available
            while($row=mysqli_fetch_assoc($res))
            {
               //Get all the orders details
               $id = $row['id'];
               $food = $row['food'];
               $price = $row['price'];
               $qty =$row['qty'];
               $total = $row['total'];
               $order_date = $row['order_date'];
               $status = $row['status'];
               $customer_name = $row['customer_name'];
               $customer_contact = $row['customer_contact'];
               $customer_email = $row['customer_email'];
               $customer_address = $row['customer_address'];

               ?>
                     <tr>
                           <td class="res"><?php echo $sn++; ?></td>
                           <td class="res"><?php echo $food;?></td>
                           <td class="res"><?php echo $price;?></td>
                           <td class="res"><?php echo $qty; ?></td>
                           <td class="res"><?php echo $total; ?></td>
                           <td class="res"><?php echo $order_date; ?></td>

                           <td class="res">
                              <?php
                              //Ordered, On Delivery, Delivered,Cancelled
                                 if($status=="Ordered")
                                 {
                                    echo "<label>$status</label>";
                                 }
                                 elseif($status=="On Delivery")
                                 {
                                    echo "<label style='color: orange;'>$status</label>";
                                 }
                                 elseif($status=="Delivered")
                                 {
                                    echo "<label style='color: green;'>$status</label>";
                                 }
                                 elseif($status=="Cancelled")
                                 {
                                    echo "<label style='color: red;'>$status</label>";
                                 }
                              ?>
                           </td>

                           <td class="res"><?php echo $customer_name; ?></td>
                           <td class="res"><?php echo $customer_contact; ?></td>
                           <td class="res"><?php echo $customer_email; ?></td>
                           <td class="res"><?php echo $customer_address; ?></td>
                           <td class="res">
                              <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
                              </td>
                     </tr>

               <?php
            }
         }
         else{
            //Order not Available
            echo "<tr><td colspan='12' class='error'>Orders not Available<td></tr>";
         }



         ?>
</table>
	</div>
</div>


 <?php include('partials/footer.php'); ?>