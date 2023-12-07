<?php include('../config/constants.php'); ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200&family=Open+Sans&display=swap" rel="stylesheet">

<html>

<head>
    <title>Login - EAUTY CO. System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<!--<section class="navBar">
    <div class="container">
      <div class="logo">
        <a href="<?php echo SITEURL; ?>" title="Logo">
          <img src="../images/logo.png" alt="Logo Restaurante" class="img-responsive" />
        </a>
      </div>-->
<body>
    <div class="login">
        <h1 class="textCenter">Login</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        
            if(isset($_SESSION['no-login-mes)ge'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        
        ?>
        <br><br>

        <!--Login Form-->
        <form action="" method="post" class="textCenter">
            Username: <br>
            <input type="text" name="username" placeholder="Enter your Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter your Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btnPrimary">
        </form>
        <!--Login Form Ends-->


        <br><br>

        <p class="textCenter">Created By - <a href="https://github.com/leonardoboav">LB</a></p>
    </div>

</body>

</html>


<?php 
        //Check Submit Btn is clicked
        if(isset($_POST['submit'])) {

            //1.Get data from 
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            //2. SQL Check if Username/Password exists already
            $sql = "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'";

            //3.Execute query
            $res = mysqli_query($conn, $sql);


            //4. Count rows
            $count = mysqli_num_rows($res);


            if($count == 1){

                //User available
                $_SESSION['login'] = "<div class='success'>Login Successfull.</div>";
                $_SESSION['user'] = $username; //Check user is logged

                //Redirect to Home Page
                header('location:'.SITEURL.'admin/');
            }
            else {

                //User not Available (Login Failed)
                $_SESSION['login'] = "<div class='error textCenter'>Username or Password did not match.</div>";

                //Redirect to Home Page
                header('location:'.SITEURL.'admin/login.php');
            }
        }
?>



