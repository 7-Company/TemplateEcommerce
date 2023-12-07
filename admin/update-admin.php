<?php include('partials/menu.php'); ?>

<div class="mainContent">
    <div class="borda">
        <h1>Update Admin</h1>

        <br><br>

        <?php
            //1. Get the ID of Admin
            $id=$_GET['id'];

            //2. Create SQL Query to get details
            $sql="SELECT * FROM tb_admin WHERE id=$id";

            //Execute query
            $res=mysqli_query($conn, $sql);

            //Check if query is executed
            if($res==true) {
                
                //Check whether data is available
                $count = mysqli_num_rows($res);
                //Check we have admin data 
                if($count==1) {
                    
                    //Get details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else {

                    //Redirect to MGMT Admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="post">

            <table class="tb30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
    
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btnSecondary">

                    </td>

                </tr>


            </table>

        </form>
    </div>
</div>


<?php 

    //Check whether Submit Btn is clicked 
    if(isset($_POST['submit'])) {
        
        //echo "Button clicked";
        //Get * values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //SQL Query to Update Admin
        $sql = "UPDATE tb_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        //Execute query
        $res = mysqli_query($conn, $sql);

        //Check whether query sucessfully
        if($res==true) {

            //Query executed
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to MGMT Admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else {
          
            //Failed update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            //Redirect to MGMT Admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>




<?php include('partials/footer.php'); ?>