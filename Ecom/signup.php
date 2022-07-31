<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
$msg = '';

if(isset($_POST['add_user'])){
    $user_name = $_POST['user_name'];
    $user_email = $_POST['email'];
    $user_password = $_POST['Password'];
    $user_contact = $_POST['Contact'];
    $user_adress = $_POST['Adress'];
   
   if(empty ($user_name) || empty($user_email) || empty($user_password) || empty($user_contact) || empty($user_contact) 
   )
   {
    $message[] = 'please fill out all';
 }
 
 
 else{
    
  $sql= "INSERT INTO admin_user(Name,Email,Password,Contact,Adress) 
  VALUES('$user_name', '$user_email','$user_password','$user_contact','$user_adress' )";
  if (mysqli_query($conn, $sql)) {
    header("Location: login.php");
    exit();
 }
    else{
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
      }
 }
}

   

  

 

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="Ecom/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                         <?php echo $msg ?>
                        <form action="<?php $_SERVER['PHP_SELF']?>" method="post"   enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="user_name" id="name" placeholder="Your Name required"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="Password" id="pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="number" name="Contact"   placeholder="Your Contact Number" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="Adress" id="Adress" placeholder="Your Adress" required/>
                            </div>
                             
                            
                            <div class="form-group form-button">
                                <input type="submit" name="add_user" id="signup" class="form-submit" value="Register" required/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

       
       
    </div>

 
     
     
</body> 
</html>