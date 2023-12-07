<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts -->
        <div class="mainContent">
            <div class="borda">
                <h1>Dashboard</h1>

                <?php 
                    if(isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>  
                <br><br>
            
                <div class="coluna4 textCenter">
                    <h1>5</h1>
                    <br>
                    Categories
                </div>

                <div class="coluna4 textCenter">
                    <h1>5</h1>
                    <br>
                    Categories
                </div>

                <div class="coluna4 textCenter">
                    <h1>5</h1>
                    <br>
                    Categories
                </div>

                <div class="coluna4 textCenter">
                    <h1>5</h1>
                    <br>
                    Categories
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Ends-->

<?php include('partials/footer.php') ?>      