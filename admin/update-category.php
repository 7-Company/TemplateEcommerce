<?php include('partials/menu.php'); ?>

<div class="mainContent">
    <div class="borda">
        <h1>Update Category</h1>

        <br><br>


        <?php 
        
            //Check if ID was defined or not
            if(isset($_GET['id']))
            {
                //get ID and other details
                //echo "get data";
                $id = $_GET['id'];
                //SQL query to get details
                $sql = "SELECT * FROM tb_category WHERE id=$id";

                //Execute query
                $res = mysqli_query($conn, $sql);

                //Count lines to check id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Fetch all data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Redirect to MGMT Category page with msg
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

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tb30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //Mostra a imagem
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Mostra mensagem
                                echo "<div class='error'>Imagem não adicionada.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="nova_imagem">
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
                        <input type="submit" name="submit" value="Atualizar Categoria" class="btnSecondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Click";
                //1. Get all values from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Update new image if selected
                //Check if image is selected
                if(isset($_FILES['nova_imagem']['name']))
                {
                   //Get details from image
                    $image_name = $_FILES['nova_imagem']['name'];

                    //Check if image is available
                    if($image_name != "")
                    {

                        //A. Load new image

                        //Auto rename image
                        //Get extension from image (jpg, png, gif, etc)

                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        //$ext = end(explode('.', $image_name));

                        //Rename image
                        $image_name = "Category_".rand(000, 999).'.'.$ext; // e.g. Category_834.jpg
                        

                        $source_path = $_FILES['nova_imagem']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Load image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check if image was uploaded
                        //If not, breaks and error message
                        if($upload==false)
                        {
                            //Definir mensagem
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirecionar para adicionar página de categoria
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //parar o processo
                            die();
                        }

                        //B. Remova a imagem atual, se disponível
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //Verifica se a imagem foi removida ou não
                            //Se falhou ao remover, exibe a mensagem e interrompe os processos
                            if($remove==false)
                            {
                                //Falha ao remover a imagem
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                                // Interrompe o processo
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

                //3. Atualizar o banco de dados
                $sql2 = "UPDATE tb_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //4. Redirecionar para gerenciar categoria com mensagem
                //Verifica se foi executado ou não
                if($res2==true)
                {
                    //Categoria atualizada
                    $_SESSION['update'] = "<div class='success'>Categoria atualizada com sucesso.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Falha ao atualizar a categoria
                    $_SESSION['update'] = "<div class='error'>Falha ao atualizar a categoria.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>