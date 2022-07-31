<?php  
include_once 'config.php'; 
error_reporting  (E_ALL & ~E_WARNING  & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";
$msg = '';
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
 

session_start();  
 

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['contact'];
    $postal = $_POST['postal'];
    $city = $_POST['city'];
    $card_name = $_POST['card_name'];
    $card_number = $_POST['credit_card'];
    $date = $_POST['date'];
    $cvvv = $_POST['cvv'];
    $prd = $_POST['products'];
    $amount = $_POST['amount'];
 
    //  https://paypal.me/SaadShabbirPR?country.x=US&locale.x=en_US
     
       $insert = "INSERT INTO Cart_Order(Name,Email,Address,Contact,Postal,City,Card_Name,Card_Number,Date,CVV,Products,Amount) VALUES('$name','$email','$address','$phone','$postal','$city','$card_name','$card_number','$date','$cvvv','$prd','$amount')";
       $upload = mysqli_query($conn,$insert);
       if($upload){
          
          $msg = 
            " Your Order has been succesfully sent <br><div>
            <p>$prd</p><br>
          </div>";
            unset($_SESSION["shopping_cart"]);
            header('location:shop.php');
           
       }else{
          $msg = 'please send again';
       
    }
  
  };
  

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
    </style>    
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
   <!-- Topbar Start -->
   <?php
         
        if(isset($_SESSION["shopping_cart"])){
        
        }
    ?>


    <h3><?php echo $msg ?></h3>
   <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+92 30045 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
        <?php

            $select = mysqli_query($conn, "SELECT * FROM categories");
            $i = 0;
        ?>
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                    <?php while($row = mysqli_fetch_assoc($select)){ ?>
                        
                        <a href="categories.php?id=<?php echo $row['Category_ID']; ?>" class="nav-item nav-link">
                            <?php echo $row['Category_Name']; ?></a>
                         
                    <?php } ?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                       
                
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            
                             
                            <a href="contact.php" class="nav-item nav-link active">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                             <!-- LOGIN/SIGNUP -->
                             <div class="btn-group">
                                <button type="button" class="btn btn-sm  text-white font-weight-bold dropdown-toggle" data-toggle="dropdown">My Account</button>
                                <div class="dropdown-menu dropdown-menu-left">
                                    <a href = "login.php"><button class="dropdown-item" type="button">Sign in</button></a>
                                    <a href = "signup.php"><button class="dropdown-item" type="button">Sign up</button></a>
                                </div>
                            </div> 
                            <?php 
                            
                                if(!empty($_SESSION["shopping_cart"])) {
                                $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                                } else {
                                    $cart_count = 0;
                                }
                            ?>
                            <a href="cart.php" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo $cart_count; ?></span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php 
         	
         foreach ($_SESSION["shopping_cart"] as $product){
             $productss .= $product['name'].'('.$product['quantity'].')'.' ,';
             $total +=$product['price']*$product['quantity'];
             $total_price = $total;
             $shipping = $total_price * 0.1;
             $grand_total =  $total_price + $shipping;

         }    
         
    ?>   
    <!-- Contact Start -->
    <div class="container-fluid">
      
        
         <div class="d-flex align-items-center justify-content-center">
            <div style = "width:80%" class="mb-5"> 
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Checkout</span></h2>
             
           
                
            <div style = "width :80%;" class="container" id = "credit_card">
            <div class="row">
             
            <div class="col-lg-8">  
              
                <form action=" "  method="POST" id = "contacts">    
                    <input type = "hidden" name = "products" 
                    value ="<?php echo $productss ?>"; />
                    <input type = "hidden" name = "amount" 
                    value ="<?php echo $grand_total ?>"; />
                    
                  
                   
                <div class="row">
                <div class="col-lg-6 col-12">
                    <!-- Input Starts -->
                     <input type="text" class="form-control"   placeholder="Enter your Name" name = "name"
                        required data-validation-required-message="Please Enter your Name" />
                        <p class="help-block text-danger"></p>
                    <input type="email" class="form-control"  placeholder="Enter your Email"
                        required name = "email" data-validation-required-message="Please enter your email" />
                        <p class="help-block text-danger"></p>
                    <input type="text" class="form-control"   placeholder="Enter your Address"
                        required name = "address" data-validation-required-message="Please enter your address" />
                        <p class="help-block text-danger"></p>
                    <input type="number" class="form-control" id="subject" placeholder="Enter your Contact Number"
                        required name = "contact" data-validation-required-message="Please enter your Contact Number" />
                        <p class="help-block text-danger"></p>
                    <input type="text" class="form-control"  placeholder="Enter Your City Name"
                        required name = "city" data-validation-required-message="Please enter Your City Name" />
                        <p class="help-block text-danger"></p>
                </div>
                <div class="col-lg-6 col-12">
                    <input type="number" class="form-control"   placeholder="Enter your Postal Code" name = "postal"
                        required data-validation-required-message="Please enter postal code" />
                        <p class="help-block text-danger"></p>
                    <input type="number" class="form-control"   placeholder="Enter Your Credit Card Number"
                        required name = "credit_card" data-validation-required-message="Please enter Credit card number" />
                        <p class="help-block text-danger"></p>
                    <input type="date" class="form-control" id="subject"  
                        required name = "date" data-validation-required-message="Please enter a subject" />
                        <p class="help-block text-danger"></p>
                    <input type="number" class="form-control"   placeholder="Enter CVV Number"
                        required name = "cvv" data-validation-required-message="Please enter cvv" />
                        <p class="help-block text-danger"></p>
                    <input type="text" class="form-control" id="subject" placeholder="Enter your Name on Card"
                        required name = "card_name" data-validation-required-message="Please enter name on card" />
                        <p class="help-block text-danger"></p>
                </div>
                </div>
            
                <div class="d-flex justify-content-center align-items-center mt-2 bg-primary p-3"> 
                    <input type="submit" 
                    style = "border:none" class="font-weight-bold bg-primary " name="submit" value="Submit Details">
                </div> 
                </form> 
                <div class = "d-flex justify-content-center align-items-center" style = "width:100%; border:none"><a href = "checkout_paypal.php"><button class = "bg-secondary paypal" style = "border:none; text-decoration:underline">Payment by Paypal</button></a></div> 
            </div>
            
            <div class="col-lg-4"> 
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                            <th>Product</th>  
                            <th>Quantity</th>
                            <th>Price</th>    
                    </thead>
                    
                    <tbody>   
                    <?php		
                            foreach ($_SESSION["shopping_cart"] as $product){
                                
                    ?>           
                        <tr>
                            <td class="align-middle" id = "name"><?php echo $products =  $product["name"];  ?> </td>
                            <td class="align-middle" id = "name"><?php echo $qty =  $product["quantity"];  ?> </td>
                            <td id = "name"><?php echo $product["quantity"] * $product["price"];  ?> </td>
                        <?php  $values .= $products." = ".$qty.", "; ?>
                      
                        </tr>
                       
                      
                    
                    </tbody> 
                                <?php }?>
                </table>
                
                <button style = "width:102.5%; border:none" class = "bg-primary p-2 font-weight-bold text-dark text-center">$:<?php echo $grand_total; ?> </button>
                
            </div>
            </div>  
            </div>
                                    <!-- First tab closed -->
       
        <div  style = "display:none">
        </div>    
                                </div>                  <!-- Second tab closed -->
    </div>
    </div>
                                    
    
  
             
        
        
         
        </div>
    </div> 



    <!-- Contact End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4 ">Get In Touch</h5>
                <p class="mb-4">They did a great job, as opposed to the other companies I worked with, They did not just care about getting the job done. They cared about getting the job done well.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>J1 Block Johar Town , Lahore, Pakistan</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>https://www.radixsols.com/</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>(+92) 300-4413475</p>
            </div>
            <div class="col-lg-4 col-md-12 d-flex align-items-center flex-column">
                <!-- <div class="row">
                    <div class="col-md-6 mb-5"> -->
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Contact</a>
                            <a class="text-secondary mb-2" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Cart</a>
                            <a class="text-secondary mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Login</a>
                            <a class="text-secondary mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Signup</a>
                            
                        </div> 
            </div>  
                    
                    <div class="col-lg-4 col-md-6 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>We are a young, dynamic web agency working on cutting edge technologies.We offer a “Multi-Discipline” services</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="https://twitter.com/radixsol"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="https://www.facebook.com/radixsols"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="https://www.linkedin.com/company/radix-sols/"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="https://www.instagram.com/radixsoltech/"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <!-- Footer End -->
    












    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
     

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

