<!-- <h2 class="mb-4">Categories</h2>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error?</p>
       -->
       <?php  
require('functions.inc.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
 
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Admin User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/styl.css">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
        
				<div class="p-4 pt-5">
          <a class="navbar-brand" style = "font-weight:bold" href="#">Admin Pannel</a>
		  		<ul class="list-unstyled components mb-5">
	           
	          <li>
	              <a href="categories.php" class = "active">Categories</a>
	          </li>
              
	          <li>
              <a href="./top.php">Products</a>
	          </li>
	          <li>
              <a href="./contact.php">Contact</a>
	          </li>
	          <li>
              <a href="./order.php">Order</a>
	          </li>
            <li>
              <a href="./users.php">Users</a>
	          </li>
	        </ul>

	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse ml-auto mr-sm-2" id="navbarSupportedContent">
              <a href = "logout.php" class = "ml-auto">Logout</a>
            </div>
          </div>
        </nav>
         
      
<?php

$select = mysqli_query($conn, "SELECT * FROM cart_order");
$user = mysqli_query($conn, "SELECT Email FROM admin_user");



?>
<h3 style = "width:100%; text-align:center; border-bottom: 2px solid #dee2e6; color:gray;    font-weight: bold;font-size:2.2rem;padding-bottom:28px; ">Orders</h3>
<div class="product-display">
<table class="product-display-table">
  
   
    
   <tr>
      
      <th>Order ID</th>
      <th>Name</th>
      
      <th>Date</th>
      <th>Address</th>
      <th>Contact</th>
      <th>Postal Code</th>
      <th>Card Number</th>
      <th>CVV</th>
       
   </tr>
   </thead>
   <?php while($row = mysqli_fetch_assoc($select)){ ?>
   <tr>
      <td><?php echo $row['Order_ID']; ?></td>
      <td><?php echo $row['Name']; ?></td>
      
       <td><?php echo $row['Date']; ?></td>
      <td>$<?php echo $row['Address']; ?></td>
      <td>$<?php echo $row['Contact']; ?></td>
      <td>$<?php echo $row['Postal']; ?></td>
      <td>$<?php echo $row['Card_Number']; ?></td>
      <td>$<?php echo $row['CVV']; ?></td>
       
   </tr>
<?php } ?>
</table>
</div>
   
    </div>        
   </div>


        </div>
        
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>