<?php

@include 'config.php';
$id = $_GET['edit'];
 
session_start();  
  
if(isset($_SESSION['ADMIN_LOGIN']) && !empty($_SESSION['ADMIN_LOGIN']))  
{  
     
    //redirect to the login page to secure the welcome page without login access.  
}  else{
    header("Location: login.php");
    die();
}

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE product SET product_name='$product_name', product_price='$product_price', product_image='$product_image'  WHERE Product_ID = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:top.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
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


<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
        
				<div class="p-4 pt-5">
          <a class="navbar-brand" style = "font-weight:bold" href="#">Admin Pannel</a>
		  		<ul class="list-unstyled components mb-5">
	           
	          <li>
	              <a href="#" class = "active">Categories</a>
	          </li>
              
	          <li>
              <a href="./admin_page.php">Products</a>
	          </li>
	          <li>
              <a href="#">Contact</a>
	          </li>
	          <li>
              <a href="#">Order</a>
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
               
               $select = mysqli_query($conn, "SELECT * FROM product WHERE Product_ID = '$id'");
               while($row = mysqli_fetch_assoc($select)){

            ?>
         <form action="" method="post" enctype="multipart/form-data">
            <h3 class="title">update the product</h3>
            <input type="text" class="box" name="product_name" value="<?php echo $row['product_name']; ?>" placeholder="enter the product name">
            <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['product_price']; ?>" placeholder="enter the product price">
            <input type="file" class="box" name="product_image"  accept="image/png, image/jpeg, image/jpg">
            <input type="submit" value="update product" name="update_product" class="btn1">
            <a href="top.php" class="btn1">go back!</a>
         </form>
         <?php }; ?>
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