<?php  

require('functions.inc.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
$msg = ''; 

session_start();  
  
if(isset($_SESSION['ADMIN_LOGIN']) && !empty($_SESSION['ADMIN_LOGIN']))  
{  
     
    //redirect to the login page to secure the welcome page without login access.  
}  else{
    header("Location: login.php");
    die();
}
if(isset($_POST['add_category'])){
  $ID = mysqli_real_escape_string($conn, $_POST['category_id']);
  $Name = mysqli_real_escape_string($conn, $_POST['category_name']);
  $Category_image = $_FILES['Category_image']['name'];
  $category_image_tmp_name = $_FILES['Category_image']['tmp_name'];
  $category_image_folder = 'uploaded_img/'.$Category_image;

 $res = mysqli_query($conn,"INSERT INTO categories(Category_ID, Category_Name, Category_image) VALUES('$ID', '$Name','$Category_image')");
  if($res){
    move_uploaded_file($category_image_tmp_name, $category_image_folder);
    $message[] = 'new product added successfully';
}else{
  $message[] = 'could not add the product';
}
}
  else{
     $msg = "User is not valid";
  }

  if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM categories WHERE Category_ID = $id");
    header('location:categories.php');
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
          <a class="navbar-brand" href="#">Admin Pannel</a>
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

        <nav class="navbar navbar-expand-lg navbar-light bg-light" class = "font-weight : bold">
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

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
          <h3>add a new Category</h3>
          <span class = "text-center text-danger danger-text"><?php $msg ?></span>
          <input type="text" placeholder="Enter category name" name="category_name" class="box">
          <input type="number" placeholder="Enter category id" name="category_id" class="box">
          <input type="file" accept="image/png, image/jpeg, image/jpg" name="Category_image" class="box">
           
          <input type="submit" class="btn1" name="add_category" value="add category">
        </form>
      </div>  
  
      </div>      
        
		</div>
    
<?php

$select = mysqli_query($conn, "SELECT * FROM categories");
$i = 0;


?>

<div class="product-display">
<table class="product-display-table">
   <thead>
   <tr>
    <?php
   session_start(); 
   echo $_SESSION['ADMIN_LOGIN']; 
   ?>
 
      <th>Serial No.</th>
      <th>Image</th>
      <th>Category ID</th>
      <th>Category Name</th>
      <th>Action</th>
   </tr>
   </thead>
   <?php while($row = mysqli_fetch_assoc($select)){ ?>
   <tr>
       <td><?php echo ++$i ?></td>
       <td>
         <img src="uploaded_img/<?php echo $row['Category_image']; ?>" height="100" alt="">
       </td>
      
       <td><?php echo $row['Category_ID']; ?></td>
       <td><?php echo $row['Category_Name']; ?>/-</td>
        
        
       <td>
       <a href="update_category.php?edit=<?php echo $row['Category_ID']; ?>"  class="btn1"> <i class="fa fa-edit"></i> edit </a>
         <a href="categories.php?delete=<?php echo $row['Category_ID']; ?>"  class="btn1 bg-dark"> <i class="fa fa-trash"></i> delete </a>
      </td>
   </tr>
<?php } ?>
</table>
</div>

    
        <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>