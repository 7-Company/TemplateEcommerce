<?php
    //Include constants file
    include('../config/constants.php');

    //echo "Delete Page";
    //Check id and img name value is setted or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])) {

        //Get value and delete
        // echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical img file is available
        if($image_name != "") {

            //Image is Available. Remove
            $path = "../images/category/".$image_name;

            //Remove img 
            $remove = unlink($path);

            if($remove==false) {

                //Set msg
                $_SESSION['remove'] = "<div class='error'>Failed to remove category Image.</div>";
                //Redirect to Manage Category
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop
                die();
            }



        }

        //Delete data from DB
        //SQL Query delete data from DB
        $sql = "DELETE FROM tb_category WHERE id=$id";
        
        //Execute query
        $res = mysqli_query($conn, $sql);

        //Redirect to Manage Category with msg
        if($res==true) {

            //Set msg and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else {

            //Set msg and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');

        }


    }
    else {

        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>