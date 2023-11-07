<?php 
session_start();
include_once 'validateToken.php'; 

if (!validateToken()) {
    $_SESSION['msg'] = "Error: Incorrect email or password";

    header('Location: login.php');
    exit();
} 

echo "Welcome " . getName();
?>

<a href="logout.php">Exit</a>