       <?php  
require('functions.inc.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";
$msg = '';
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
 
session_start();  
  
if(isset($_SESSION['ADMIN_LOGIN']) && !empty($_SESSION['ADMIN_LOGIN']))  
{  
     
    //redirect to the login page to secure the welcome page without login access.  
}  else{
    header("Location: login.php");
    die();
}


if(isset($_GET['del'])){
  $id = $_GET['del'];
  mysqli_query($conn, "DELETE FROM contact WHERE id = $id");
  header('location:contact.php');
};


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
        <div class="admin-product-form-container">
                
<?php

$select = mysqli_query($conn, "SELECT * FROM  contact");
$i = 0;


?>
<h1>Users</h1>
<div class="product-display">
<table class="product-display-table">
   <thead>
   <tr> 
       
      <th>Serial No.</th>
      <th>Name</th>
      <th>Email</th>
      <th>Subject</th>
      <th>Message</th>
      <th>Action</th>
   </tr>
   </thead>
   <?php while($row = mysqli_fetch_assoc($select)){ ?>
   <tr>
       <td><?php echo ++$i ?></td>
       <td><?php echo $row['Name']; ?></td>
       <td><?php echo $row['Email']; ?>/-</td>
       <td><?php echo $row['Subject']; ?>/-</td>
       <td><?php echo $row['Message']; ?>/-</td>
        
        
       <td>
        
         <a href="contact.php?del=<?php echo $row['id']; ?>"  class="btn1"> <i class="fa fa-trash"></i> delete </a>
      </td>
   </tr>
<?php } ?>
  
      </div>      
        
		</div>
   
</table>
</div>

      
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