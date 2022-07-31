<?php  
 require 'add_to_cart.php';
 

       
    $query =  $_GET['search_name'];
     $select = mysqli_query($conn, "SELECT * FROM product");
     $select2 = mysqli_query($conn, "SELECT * FROM product where product_name LIKE '%$query%'");
     
     
    if(mysqli_num_rows($select2) > 0){
        
         
       
    } 
    else{
        echo $query."  not record found";
    }

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
   

        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
            <form action= "search_results.php" method = "GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products" name = "search_name">
                        <div class="input-group-append">
                            <button type = "submit" style = "border:0px;">
                            <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search" ></i>       
                            </span></button>
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

            $select = mysqli_query($conn, "SELECT * FROM categories ");
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
                            <a href="index.php" class="nav-item nav-link ">Home</a>
                            <a href="shop.php" class="nav-item nav-link active">Shop</a>
                            <!-- <a href="detail.php" class="nav-item nav-link disabled">About</a> -->
                             
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
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
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
                 
                
                  
            </div>  
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-8">
                 
                     
                     
                <div class="row pb-3">
                    
                    <?php  
                   
                     while($row = mysqli_fetch_assoc($select2)){ ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 pb-1" role="button">
                        <div onclick="location.href='detail.php?id=<?php echo $row['Product_ID']; ?>'" class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden"><a href = "index.php">
                                <img class="img-fluid w-100" src="Ecom/uploaded_img/<?php echo $row['product_image']; ?>" alt=""></a>
                                
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""><?php echo $row['product_name']; ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5><?php echo $row['product_price']; ?></h5><h6 class="text-muted ml-2"><del><?php echo $row['product_price']  * 1.5; ?></del></h6>
                                </div>
                                <form method = "post">
                                <input type = "hidden" name = "product_id" 
                                value ="<?php echo $row['Product_ID'] 
                                ?>"> 
                                <input type = "hidden" name = "product_name" 
                                value ="<?php echo $row['product_name'] 
                                ?>"> 
                                <input type = "hidden" name = "product_image" 
                                value ="<?php echo $row['product_image'] 
                                ?>"> 
                                <input type = "hidden" name = "product_price" 
                                value ="<?php echo $row['product_price'] 
                                ?>"> 
                                 <button  type = "submit" class="btn btn-primary center-text" name = "add_to_cart"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

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
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
 
</body>

</html>