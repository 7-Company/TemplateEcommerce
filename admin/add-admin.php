<?php include('partials/menu.php'); ?>

<div class="mainContent">
    <div class="borda">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) { //Check if Session is ON/OFF
                 
                echo $_SESSION['add']; //Display Session Msg
                unset($_SESSION['add']); //Remove Session Msg
                }
        ?>

        <form action="" method="POST">

            <table class="tb30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your Userame"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btnSecondary">
                    </td>
                </tr>
   
            </table>
        </form>

    </div>
</div>


<?php include('partials/footer.php'); ?>

<?php
    //Process the value from Form and Save in DATABASE!

    //Check if the submit btn is clicker or not

    if(isset($_POST['submit']))
    {
        //Btn Clicked
        //echo "Button Clicked";

        //Get data from Form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //md5 make the Encryption of PW **

        //2. SQL Query to save data in database
        $sql = "INSERT INTO tb_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //3.Execute Wuery and Save Data indo DB
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4.Check whether the data is inserted and not display appropriate msg
        if($res==TRUE) {
            //Data inserted
            //echo "Data inserted";
            //Create a Session Variable to display MSG
            $_SESSION['add'] = "Admin Added Sucessfully";

            //Redirect page Mgmt Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else {
            //Failed to insert data
            //echo "Failed to insert data";
            $_SESSION['add'] = "Failed to Add Admin";
            //Redirect page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }

?>