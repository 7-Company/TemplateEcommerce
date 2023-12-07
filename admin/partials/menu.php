<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200&family=Open+Sans&display=swap" rel="stylesheet">

<?php 
    include('../config/constants.php'); 
    include('login-check.php');
    
?>


<html>
    <head>
        <title>EAUTY CO. Website - Home Page</title>

        <link rel="stylesheet" href="../css/admin.css">  
    </head>

    <body>
        <!-- Menu Section Starts -->
        <div class="menu textCenter">
            <div class="borda">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-product.php">Product</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>            
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends-->