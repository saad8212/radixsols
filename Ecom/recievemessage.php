<?php  

if(empty($_POST['names'])){
  http_response_code(500);
  exit();
}
require('functions.inc.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

if(isset($_POST['submit'])){
$name = $_POST['name'];
$email = $_POST['email'];
$m_subject = $_POST['subject'];
$message = $_POST['message'];
$res =  "INSERT into contact(Name,Email, Subject,Message) VALUES('$name','$email', '$subject','$message')";
$upload = mysqli_query($conn,$res);

$to = "saad.shabbir1435@gmail.com"; // Change this email to your //
$subject = "$m_subject:  $name";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";
$header = "From: $email";
$header .= "Reply-To: $email";	

if(!mail($to, $subject, $body, $header))
  http_response_code(500);
  echo "Email is: ";
};
?>

<!doctype html>
<html>
  <head>
</head>
<body>
  <?php
$ress = mysqli_query($conn,"SELECT * from contact");?>
<?php while($row = mysqli_fetch_assoc($ress)){ ?>
  <a href="" class="nav-item nav-link">
      <?php echo $row['Email']; ?></a>
   
<?php } ?>
</body>
</html>