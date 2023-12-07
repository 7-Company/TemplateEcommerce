<?php 
    //Start Session
    session_start();
    
    //Create constants to store Non Repeating Values
    define('SITEURL', 'http://localhost/product-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'product-order');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //Database Connection
    $db_select = mysqli_select_db($conn, 'product-order') or die(mysqli_error($conn)); //Selecting Database
    
?>