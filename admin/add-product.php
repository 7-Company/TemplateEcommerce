<?php include('partials/menu.php'); ?>


<div class="mainContent">
    <div class="borda">
        <h1>Add Product</h1>

        <br><br>


        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }    
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tb30">

                <tr>
                    <td>Product Name: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the product">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of product. "></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="double" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>


                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >


                            <?php 
                            
                                //Create PHP to display categories in DB
                                //1.SQL to get all active data from DB
                                $sql = "SELECT * FROM tb_category WHERE active='Yes'";

                                //Execute sql
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);


                                if($count > 0) {

                                    //Have categories
                                    while($row=mysqli_fetch_assoc($res)) {

                                        //Get details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];


                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }

                                }
                                else {

                                    //Do not have categories
                                    ?>
                                    <option value="0">No category found. </option>
                                    <?php
                                }
                            
                                //2. Display in dropdown
                            
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product" class="btnSecondary">
                    </td>
                </tr>

            </table>

        </form>


        <?php 
        
            if(isset($_POST['submit'])) {

            
                //Check if button is clicked or not
                //echo "Click";
                
                //1.Get data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];


                //Check id radio button ir active
                if(isset($_POST['featured'])) {

                    $featured = $_POST['featured'];
                }
                else {
                    $featured = "No"; //Set default value
                }

                if(isset($_POST['active'])) {

                    $active = $_POST['active'];
                }
                else {

                    $active = "No"; //Set default value
                }


                //2. Upload the image
                if(isset($_FILES['image']['name'])) {

                    $image_name = $_FILES['image']['name'];

                    if($image_name!="") {

                        //Get extension from img(jpg, png, gif)
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        //$ext = end(explode('.', $image_name));

                        //Rename image
                        $image_name = "Category_".rand(000, 999).'.'.$ext; // e.g. Category_834.jpg
                        
                        //Souce path is in location image
                        $source = $_FILES['image']['tmp_name'];

                        //Destination path to img downloanded
                        $destination = "../images/product/".$image_name;

                        //Upload product image
                        $upload = move_uploaded_file($source, $destination);

                        //Image uploaded or not
                        if($upload == false) {

                            //Define message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to add Product page
                            header('location:'.SITEURL.'admin/add-product.php');
                            
                            die(); //Stop process
                        }

                    }
                }

                else {
                    $image_name = ""; //Setting value as blank
                }

                //3. Insert into DB

                //Create SQL Query
                $sql2 = "INSERT INTO tb_product SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active' 
                ";

                //Execute query
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true) {

                    //Data insert successfull
                    $_SESSION['add'] = "<div class='success'>Product Added Succesfully. </div>";
                    //Redirect to add Category page
                    header('location:'.SITEURL.'admin/manage-product.php');
                }
                else {

                    //Data insert successfull
                    $_SESSION['add'] = "<div class='error'>Failed to Add Product. </div>";
                    //Redirect to add Category page
                    header('location:'.SITEURL.'admin/manage-product.php');
                }

                //4. Redirect to product page with msg

            }
                
        
        ?>

    </div>
</div>



<?php include('partials/footer.php'); ?>