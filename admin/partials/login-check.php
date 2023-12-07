<?php 

    //Acess Control
    //Check user is logged or not
    if(!isset($_SESSION['user'])) { 

        //Redirect to login page (msg)
        $_SESSION['no-login-message'] = "<div class='error textCenter'>Please login to access. </div>";

        //Redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
?>