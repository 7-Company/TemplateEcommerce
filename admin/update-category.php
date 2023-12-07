<?php include('partials/menu.php'); ?>

<div class="mainContent">
    <div class="borda">
        <h1>Update Category</h1>

        <br><br>


        <?php 
        
            //Check if id is defined
            if(isset($_GET['id']))
            {
                //Get ID and details
                //echo "get data";
                $id = $_GET['id'];
                //SQL query to get details
                $sql = "SELECT * FROM tb_category WHERE id=$id";

                //Execute query
                $res = mysqli_query($conn, $sql);

                //Count lines and verify if id is available
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Redirect to Manage Category page with msg
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                //Redirect to Manage Category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        ?>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tb30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "") {

                                //Display
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else {

                                //Msg error
                                echo "<div class='error'>Image not Added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="new_image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btnSecondary">
                    </td>
                </tr>

            </table>

        </form>
        <?php 
            if (isset($_POST['submit']))
            {
                //echo "click";
                //1.Get values from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2.Update new Img
                if(isset($_FILES['image']['name']))
                {
                   //Get details from img
                    $image_name = $_FILES['image']['name'];

                    //Check img is available
                    if($image_name != "")
                    {
                        //Upload new img

                        //Rename img
                        //Get extension from img (jpg, png, gif, etc) 
                        
                        //$ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        $ext = end(explode('.', $image_name));

                        //Rename img
                        $image_name = "Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Load image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check if img was uploaded
                        //If not, breaks
                        if($upload==false)
                        {
                            //Definir mensagem
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to MGMT Category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            
                            die(); //Kills process
                        }

                        //B. Remove img if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //Check img was removed
                            //Se falhou ao remover, exibe a mensagem e interrompe os processos
                            if($remove==false)
                            {
                                //Falha ao remover a imagem
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');

                                die(); //Kills process
                            }
                        }
                        

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //3.Update DB
                $sql2 = "UPDATE tb_category SET 
                    title = '$title',
                    image_name = '$image_name';
                    featured = '$featured',
                    active = '$active',
                    WHERE id=$id
                ";

                //Execute query
                $res2 = mysqli_query($conn, $sql2);

                //4.Redirect to MGMT Category page
                //Check query executed 
                if($res2==true) {

                    //Category Update
                    $_SESSION['update'] = "<div class='success'>Category Updated with Success.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
                else {

                    //FAILED TO UPDATE
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        
        ?>

    </div>
</div>          



<?php include('partials/footer.php'); ?>