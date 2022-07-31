<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
$msg = '';
if(isset($_POST['submit'])){
     $Email = mysqli_real_escape_string($conn, $_POST['Email']);
     $Password = mysqli_real_escape_string($conn, $_POST['Password']);
     $sql = "select * from user where Email = '$Email' and Password = '$Password'";
     $res = mysqli_query($conn,$sql);
     $count = mysqli_num_rows($res);
     if($count>0){
        session_start();
        $_SESSION['ADMIN_LOGIN']= 'yes';
        $_SESSION['ADMIN_EMAIL']= $Email;
        header("Location: index.php");
        die();
     }
     else{
        $msg = "User is not valid";
     }
}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href=" Ecom/css/styles.css">

	</head>
	<body>
    <div class="main">

       
<!-- Sing in  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="Ecom/images/signin-image.jpg" alt="sing up image"></figure>
                <a href="./signup.php" class="signup-image-link">Don't have Account?</a>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Sign In</h2>
                <form method="post" class="register-form" id="login-form">
                    <div class="form-group">
                        <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="email" name = "Email" id="your_name" placeholder=" Enter Your Email"/>
                    </div>
                    <div class="form-group">
                        <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name = "Password" id="your_pass" placeholder="Password"/>
                    </div>
                     
                    <h5 style = "color:red; text-align:center; text-decoration:underline"><?php echo $msg ?></h5>
                    <div class="form-group form-button">
                        <input type="submit" name="submit" id="signin" class="form-submit" value="Log in"/>
                    </div>
                </form>
                 
            </div>
        </div>
    </div>
</section>

</div>

       

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="Ecom/js/main.js"></script>

	</body>
</html>

