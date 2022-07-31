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
     $sql = "select * from admin_user where Email = '$Email' and Password = '$Password'";
     $res = mysqli_query($conn,$sql);
     $count = mysqli_num_rows($res);
     if($count>0){
        session_start();
        $_SESSION['ADMIN_LOGIN']= 'yes';
        $_SESSION['ADMIN_EMAIL']= $Email;
        header("Location: categories.php");
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
	
	<link rel="stylesheet" href=" css/styles.css">

	</head>
	<body>
    <div class="main">

       
<!-- Sing in  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                <a href="./signup.php" class="signup-image-link">Dont't have Account?</a>
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
                    <div class="form-group">
                        <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                        <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
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

        <!-- Login Page -->
        <!-- <section class="ftco-section">
		<div class="container">
			 
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Have an account?</h3>
                  <div class="err text-center text-danger" ><?php echo $msg ?></div>
				    <form   method = "post" class="login-form">
		      		    <div class="form-group">
		      			    <input type="text" name = "Username" class="form-control rounded-left" placeholder="Username" required>
		      		    </div>
	                    <div class="form-group d-flex">
    	                    <input type="password" name = "Password" class="form-control rounded-left" placeholder="Password" required>
	                    </div>
	                    <div class="form-group d-md-flex">
	            	        <div class="w-50">
	            		        <label class="checkbox-wrap checkbox-primary">Remember Me
								    	  <input type="checkbox" checked>
									      <span class="checkmark"></span>
								</label>
							</div>
							<div class="w-50 text-md-right">
									<a href="#">Forgot Password</a>
							</div>
	                    </div>
	                    <div class="form-group">
	            	        <button type="submit" name = "submit" class="btn btn-primary rounded submit p-3 px-5">Get Started</button>
	                    </div>
	                </form>
                    
	        </div>
				</div>
			</div>
		</div>
        
	</section> -->

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

