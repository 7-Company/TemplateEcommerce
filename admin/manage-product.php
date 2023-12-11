<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="borda">
        <h1>Manage Product 🛍️</h1>

        <br /><br />

        <!-- Btn to Add Product -->
        <a href="<?php echo SITEURL; ?>admin/add-product.php" class="btnPrimary">Add Product</a>
        <br /><br /><br />
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        
        
        
        ?>
            
            <table class="tbFull">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php 
                     ////Get all admins
                    $sql = "SELECT * FROM tb_product";
                            
                    //Execute QUERY
                    $res = mysqli_query($conn, $sql);
                            
                    //Count rows and lines
                    $count = mysqli_num_rows($res);
                            
                    //Create a var and Assign the value in 1
                    $sn = 1;
                            
                    //Check if Query was executed or not
                    if ($count > 0) {
                        //Have data in DB
                        //Check num of Rows
                        while ($row = mysqli_fetch_assoc($res)) {

                            //WHILE LOOP to get all data from DB
                            //Will run as long as we have data from database
                            //Get individual data
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $title; ?></td>
                                <td>$<?php echo $price; ?></td>
                                <td>
                                    <?php  
                                        //Check if have img or not
                                        if($image_name == "") {
                                            // Não Temos Imagem, Mostrar Mensagem de ERROR
                                            echo "<div class='error'>Imagem não adicionada</div>";
                                        }
                                        else {
                                            // Temos Imagem, Mostrar Imagem
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" width = "100px">
                                            <?php
                                        }
                                    ?>
                                </td>   
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>" class="btnSecondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btnDanger">Delete Admin</a>
                                </td>
                            </tr>

                            <?php 
                        }
                    }    
                    else {

                        //Product not Added in DB
                        echo "<tr> <td colspan='7' class='error'> Refeição não adicionada </td> </tr>";
                    }

                ?>
    

            </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>