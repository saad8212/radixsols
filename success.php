<?php 
session_start();
include_once 'config.php'; 
include_once 'dbConnect.php';

$pid = $_SESSION['product_id']; 
    echo "<h1>Your Payment has been Succesful</h1>";
session_destroy();
?>
<a href="index.php">Back to Home</a>