<?php include('partials/menu.php'); ?>

<div class="mainContent">
    <div class="borda">
        <h1>Manage Category</h1>

        <br /><br />

        <?php

            if (isset($_SESSION['add'])) 
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['remove'])) 
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if (isset($_SESSION['delete'])) 
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['no-category-found'])) 
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if (isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if (isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if (isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

        ?>

        <br><br>

                <!-- Btn to Add Category -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btnPrimary">Add category</a>

                <br /><br /><br />

                <table class="tbFull">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
    ////Get all admins
    $sql = "SELECT * FROM tb_category";

    //Execute QUERY
    $res = mysqli_query($conn, $sql);

    //Count rows and lines
    $count = mysqli_num_rows($res);

    //Create a var and Assign the value in 1
    $sn = 1;

    //Check if Query was executed or not
    if ($count > 0) 
    {
        //Have data in DB
        //Check num of Rows
        while ($row = mysqli_fetch_assoc($res)) 
        {
            //WHILE LOOP to get all data from DB
            //Will run as long as we have data from database
            //Get individual data
            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];

            ?>

            <tr>
                <td><?php echo $sn++; ?>. </td>
                <td><?php echo $title; ?></td>

                <td>

                    <?php 
    
                        if($image_name!="")
                        {
                            //Show image
                            ?>

                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >

                            <?php
                        }                    
                        else
                        {
                            //Show image
                            echo "<div class='error'>Image not selected. </div>";
                        }                 
                    ?>

                </td>

                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btnSecondary">Update Category</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btnDanger">Delete Category</a>
                </td>
            </tr>

            <?php

        }
    } 
    else 
    {
        //We dont have in DB
        ?>

        <tr>
            <td colspan="6">
                <div class="error">No Category Added.</div>
            </td>
        </tr>

        <?php
    }
?>



                </table>
            </div>

        </div>

        <?php include('partials/footer.php'); ?>