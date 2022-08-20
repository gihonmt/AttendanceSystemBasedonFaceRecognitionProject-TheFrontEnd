<?php
session_start();
unset($_SESSION['usernameop']); 
unset($_SESSION['imageop']); 

session_destroy();
header('location:../index.php');
?>