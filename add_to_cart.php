<?php  
error_reporting  (E_ALL & ~E_WARNING  & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
 session_start(); 
  
 //student_name form field name
     //city_id form field name
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
$msg = ''; 
$select = mysqli_query($conn, "SELECT * FROM categories");
$i = 0; 
 

if(isset($_POST['add_to_cart'])){
$code = $_POST['product_id'];
$prod = mysqli_query($conn, "SELECT * FROM product where Product_ID = $code");
$row = mysqli_fetch_assoc($prod);
$name = $row['product_name'];
$code = $row['Product_ID'];
$price = $row['product_price'];
$image = $row['product_image'];

 
$cartArray = 
    array($code =>array
	 (
    'key' =>$code,   
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);
   if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
    
}else{
    foreach($_SESSION["shopping_cart"] as $key => $value) {
       $keys =  $value['key'];
       $qty =  $value['quantity'];
    }
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(($code==$keys)) {
	$status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";    
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Products is added to your cart!</div>";
    }

	}    
}

?>
