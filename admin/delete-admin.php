<?php

    //Include "constants.php" here
    include('../config/constants.php');  

    //1. Get the id of Admin
    $id = $_GET['id'];

    //2. Create SQL Query (delete)
    $sql = "DELETE FROM tb_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check Query was executed
    if($res==TRUE) {
        //Query Sucessfully and DEL Admin
        //echo "Admin Deleted";
        //Create Session Var to display Msg
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        

        //Redirect to MGMT Admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else {
        //Failed to DEL Admin
        //echo "Failed to delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later. </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }


    //3. Redirect to MGMT Admin page with (sucess/error)
    
?>