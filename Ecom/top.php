 
       <?php  
require('functions.inc.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
 
if(isset($_POST['add_product'])){

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_warranty = $_POST['product_warranty'];
  $product_desc = $_POST['product_desc'];
  $Category_ID = $_POST['Category_ID'];
  $product_image = $_FILES['product_image']['name'];
  $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
  $product_image_folder = 'uploaded_img/'.$product_image;

  if(empty($product_name) || empty($product_price) || empty($product_image)){
     $message[] = 'please fill out all';
  }else{
     $insert = "INSERT INTO product(product_name,Category_ID,Description, product_price,Warranty,product_image) VALUES('$product_name','$Category_ID','$product_desc', '$product_price','$product_warranty','$product_image')";
     $upload = mysqli_query($conn,$insert);
     if($upload){
        move_uploaded_file($product_image_tmp_name, $product_image_folder);
        $message[] = 'new product added successfully';
     }else{
        $message[] = 'could not add the product';
     }
  }

};

session_start();  
  
if(isset($_SESSION['ADMIN_LOGIN']) && !empty($_SESSION['ADMIN_LOGIN']))  
{  
     
    //redirect to the login page to secure the welcome page without login access.  
}  else{
    header("Location: login.php");
    die();
}

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM product WHERE Product_ID = $id");
  header('location:top.php');
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
              <a href="contact.php">Contact</a>
	          </li>
	          <li>
              <a href="order.php">Order</a>
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

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         
         
         <select class = "box" name = "Category_ID" style = "color: #6c757d !important;
              opacity: 1;">
            <option style = "color: #6c757d !important;
              opacity: 1;">Select Category
            </option>
            <?php
            $ress = mysqli_query($conn,"SELECT Category_ID,Category_Name from categories");
            while($row=mysqli_fetch_assoc($ress)){
              echo "<option value = ".$row['Category_ID'].">"
              .$row['Category_Name']."</option>";
            }
            ?>
            
          </select>  
         
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price $" name="product_price" class="box">
          
         <input type="int" placeholder="enter product warranty in months" name="product_warranty" class="box">
         <input type="text" placeholder="add description" name="product_desc" class="box">
         
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn1" name="add_product" value="add product">
      </form>
   </div>
   
    </div>        
   </div>

<?php

$select = mysqli_query($conn, "SELECT * FROM product order by Category_ID asc");
$user = mysqli_query($conn, "SELECT Email FROM admin_user");



?>

<div class="product-display">
<table class="product-display-table">
   <thead>
   <tr>
      
      <th>product image</th>
      <th>product name</th>
      <th>category id</th>
        
      <th>product warranty</th>
      <th>product price</th>
      <th>action</th>
   </tr>
   </thead>
   <?php while($row = mysqli_fetch_assoc($select)){ ?>
   <tr>
      <td><img src="uploaded_img/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
      <td><?php echo $row['product_name']; ?></td>
      <td><?php echo $row['Category_ID']; ?></td>
       <td><?php echo $row['Warranty']; ?></td>
      <td>$<?php echo $row['product_price']; ?>/-</td>
      <td>
         <a href="update.php?edit=<?php echo $row['Product_ID']; ?>"  class="btn1"> <i class="fa fa-edit"></i> edit </a>
         <a href="top.php?delete=<?php echo $row['Product_ID']; ?>"  class="btn1 bg-dark"> <i class="fa fa-trash"></i> delete </a>
      </td>
   </tr>
<?php } ?>
</table>
</div>

        </div>
        
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>