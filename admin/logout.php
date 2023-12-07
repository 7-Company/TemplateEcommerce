<?php 

    //Constants.php for URL
    include('../config/constants.php');

    //1.Kill session
    session_destroy(); //Unsets $_SESSION['user'] 

    //2.Redirect to Login
    header('location:'.SITEURL.'admin/login.php');


?>