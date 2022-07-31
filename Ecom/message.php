<?php  

$name =  $_POST['name'];
$email =  $_POST['email'];
$subject=  $_POST['subject'];
$message =  $_POST['message'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
 

$insert = "INSERT into contact(Name,Email,Subject,Message) VALUES('$name','$email','$subject','$message')";
  $upload = mysqli_query($conn,$insert);
  if($upload){
    header('location:../contact.php');
     
  }
  else{
    echo "failed";
  }

  // collect value of input field
   
 
?>

<!doctype html>
<html>
  <head>
  <link rel="stylesheet" href="css/styl.css">
</head>
<body>
<?php

$select = mysqli_query($conn, "SELECT * FROM contact");
 



?>
<div class="product-display">
<table class="product-display-table">
   <thead>
   <tr>
      
     
        
      <th>Name</th>
      <th>Email</th>
      <th>Subject</th>
      <th>Message</th>
   </tr>
   </thead>
   <?php while($row = mysqli_fetch_assoc($select)){ ?>
   <tr>
       
      <td><?php echo $row['Name']; ?></td>
      <td><?php echo $row['Email']; ?></td>
       <td><?php echo $row['Subject']; ?></td>
      <td><?php echo $row['Message']; ?>/-</td>
      
   </tr>
<?php } ?>
</table>
</div>

 
</body>
</html>