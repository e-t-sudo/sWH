<header>
    <div class="menu-bar">
        <nav class="navbar navbar-expand-md navbar-dark sticky-top fixed">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
              <!--     <img class="logo" alt="Logo" src="img/etlogo.png">-->
                 <span style="color: black;">E_T >></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <!--<span class="navbar-toggler-icon"></span>-->
                    <i class="fa fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <?php 
                            include "includes/init.php";
                            $sql_query = "select * from categories where `parent` = 0";
                            $query_result = mysqli_query($conn, $sql_query);
                            if(mysqli_num_rows($query_result)>0){
                                while($row = mysqli_fetch_assoc($query_result)){
                                    $category = $row['category'];
                                    $cat_id = $row['cat_id'];
                                    print('<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="notAvailable.php" data-toggle="dropdown">'.$category.'<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">');
                                        $sql_query = "select * from categories where `parent` = $cat_id";
                                        $sub_query_result = mysqli_query($conn, $sql_query);
                                        if(mysqli_num_rows($sub_query_result)>0){
                                            while($row = mysqli_fetch_assoc($sub_query_result)){
                                                $sub_category = $row['category'];
                                                print('<li><a class="dropdown-item" href="notAvailable.php">'.$sub_category.'</a></li>');
                                            }
                                        }else{
                                            echo "No results for sub-categories";
                                        }
                                    print('</ul>
                                </li>');

                                }
                            }else{
                                echo "No results for categories";
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="notAvailable.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notAvailable.php">Contacts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>