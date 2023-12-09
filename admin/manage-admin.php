<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts -->
        <div class="mainContent">
            <div class="borda">
                <h1>Manage Admin 👨‍💼</h1>

                <br />

                <?php 
                    if(isset($_SESSION['add'])) 
                    {
                        echo $_SESSION['add']; //Display Session Msg
                        unset($_SESSION['add']); //Remove Session Msg
                    }
                    
                    if(isset($_SESSION['delete'])) 
                    {
                        echo $_SESSION['delete']; 
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update'])) 
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found'])) 
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match'])) 
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd'])) 
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>

                <br><br><br>

                <!-- Btn to Add Admin -->
                <a href="add-admin.php" class="btnPrimary">Add Admin</a>

                <br /><br /><br />

                <table class="tbFull">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //Get all admins
                        $sql = "SELECT * FROM tb_admin";
                        //Execute query
                        $res = mysqli_query($conn, $sql);

                        //Check if Query was executed or not
                        if($res == TRUE) {
                            
                            //Count Rows to check wheather we have data in DB or not
                            $count = mysqli_num_rows($res); //Get all rows in DB

                            $sn = 1; //Create a var and Assign the value

                            //Check num of Rows
                            if($count > 0) {
                                //We have in DB
                                while($rows=mysqli_fetch_assoc($res)) {
                                    //WHILE LOOP to get all data from DB
                                    //Will run as long as we have data from database

                                    //Get individual data
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];
                                    
                                    //Display values in table
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btnPrimary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btnSecondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"  class="btnDanger">Delete Admin</a>  
                                        </td>
                                    </tr>
                                    
                                    <?php
                                }
                            }
                            else {
                                 //We dont have in DB  
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
        <!-- Main Content Ends-->
        
<?php include('partials/footer.php'); ?>              