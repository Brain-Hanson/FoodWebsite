
<?php include('partials/menu.php') ?>

  <!--Main Content Section Starts-->
  <div class="main-content">
  	<div class="wrapper">
  		<h1>Dashboard</h1>
		<br><br>
			<?php
		if(isset($_SESSION['login']))
		{
		echo $_SESSION['login'];
		unset ($_SESSION['login']);
		}

	?>
			<br><br>


		<!---Displaying The total number of Foods--->
  		<div class="col-4 text-center">

		<?php 
		
		//SQL QUERY 
		$sql = "SELECT * FROM tbl_category";
		//EXECUTE THE QUERY
		$res = mysqli_query($conn,$sql);
		//Count ROWS
		$count = mysqli_num_rows($res);
		?>
  			<h1><?php  echo $count; ?></h1>
  			<br>
  			Categories 
  		</div>

		<!--Displaying the Total Number of FOOds-->
  		<div class="col-4 text-center">
		  <?php  
		$sql2 = "SELECT * FROM tbl_food";

		//EXECUTE THE QUERY
		$res2 = mysqli_query($conn,$sql2);

		$count2 = mysqli_num_rows($res2);
		
		?>
  			<h1><?php  echo $count2;  ?></h1>
  			<br>
  			Foods
  		</div>



  		<div class="col-4 text-center">
			<?php	
			$sql3="SELECT * FROM tbl_order";
			//EXcute the QUERY
				$res3 = mysqli_query($conn,$sql3);
			//Count the rows
			$count3= mysqli_num_rows($res3);
		?>
  			<h1><?php  echo $count3;  ?></h1>
  			<br>
  			Total Orders
  		</div>

  		<div class="col-4 text-center">

		<?php
				//CREATE SQL QUERY To Get Total Revenue
				//Aggregate Function in SQL
				$sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
				
				//EXUTE THE QUERY
				$res4 = mysqli_query($conn,$sql4);

				//GET The Value
				$row4 = mysqli_fetch_assoc($res4);

				//GET THE TOTAL REVENUE 
				$total_revenue = $row4['Total'];

				?>

  			<h1>$<?php  echo $total_revenue; ?></h1>
  			<br>
  			Revenue Generated 
  		</div>
        
        <div class="clearfix"></div>


  	</div>
  </div>

  
  <!--Main Contect Section Ends-->

  <?php include('partials/footer.php') ?>



