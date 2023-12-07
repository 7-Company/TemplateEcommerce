<?php include('partials/menu.php'); ?>

<div class="mainContent">
    <div class="borda">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Add Category init form -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tb30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title name">
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image_name">
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
                    <td>Ativo: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Adicionar Categoria" class="btnSecondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- End form -->

        <?php 
        
            //Check submit btn is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Click";

                //1. Get value from Category
                $title = $_POST['title'];

                //To radio, check if button is selected 
                if(isset($_POST['featured']))
                {
                    //Get forma value
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Define a default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //Check img was selected and define the value for image_name
                //print_r($_FILES['image']);

                //die();//break code here

                if(isset($_FILES['image_name']['name']))
                {
                    //Send img
                    //To load img, need image_name, origin and destination folder (../)
                    $image_name = $_FILES['image_name']['name'];
                    
                    //Upload img if was selected
                    if($image_name != "") //Auto rename img
                    {
                        //Get extension from img(jpg, png, gif)
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        //$ext = end(explode('.', $image_name));

                        //Rename image
                        $image_name = "Category_".rand(000, 999).'.'.$ext; // e.g. Category_834.jpg

                        $source_path = $_FILES['image_name']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check if img was uploaded
                        //If not, breaks and error message
                        if($upload==false) {

                            //Define message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to add Category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            
                            die(); //Stop process
                        }

                    }
                }
                else {
                   //Dont upload and define the value blank
                    $image_name="";
                }

                //2. SQL Query to insert CAtegory in DB
                $sql = "INSERT INTO tb_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //3. Execute Query and save in DB
                $res = mysqli_query($conn, $sql);

                //4. Check query was executed, and the date was added or not
                if($res==true)
                {
                    //Query executed and cetegory added
                    $_SESSION['add'] = "<div class='success'>Category added with Success.</div>";
                    //Redirect to Manage Category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed
                    $_SESSION['add'] = "<div class='error'>Failed to add Category.</div>";
                    //Redirect to Add Category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>