<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php"; ?>
    <title>sWH</title>
    <style>
        .card-img-top{
            height: 100px;
            width: 100px;
        /*    border-top-left-radius: 30px;
            border-bottom-right-radius: 30px;*/
            border-radius: 5%;
            padding: 0px;
            margin: 0px;
             box-shadow: 1px 1px 3px 1px grey;
        }
        .prod-title{
            padding: 5px;
            text-shadow: 1px 1px 3px 1px grey;
            font-size: 20px;
            color: #666666;
        }
        table{
            height: 130px; 
            width: 80%;
            padding-left: 0px;
        }
        .details-btn{
            width: 100%;
        }
        .prod-det{
            padding-left: 20px;
        }
        .fa-star{
            color: #FF9529;
        }
        .tile{
            color: black;
        }
        .tile:hover{
            text-decoration: none;
            color: black;          
        }
        .tag-boxes{
            padding: 10px;
        }
        .filter-btn{
            margin: 20px;
        }
        @media only screen and (max-width: 768px) {
    #product-menu {
        display: none;
         }
        }
        
        @media only screen and (min-width: 768px){
            #smaller-product-menu{
                display: none;
            }
        }
    </style>
</head>
<body>
        <?php include "includes/header.php"; ?>

        <br><br><br>
        <?php
            function isPresent($ar, $val){
                for($i=0; $i<sizeof($ar); $i++){
                    if($ar[$i]==$val) return true;
                }
            return false;
            }
        ?>
        <div>
            <form class="form padding" method = "post" action="index.php">
                <?php 
                    $conn = mysqli_connect("localhost", "root", "", "newbase");
                    $tag_query = "select * from tags";
                    $result = mysqli_query($conn, $tag_query);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            $tag_name = $row['tag'];
                            $tag_id = $row['tag_id'];?>
                    <div class="form-check form-check-inline tag-boxes">
                        <input <?php if(!isset($_POST['tags'])||isPresent($_POST['tags'], $tag_id)) echo "checked"; ?> type = "checkbox" class="form-check-input" name="tags[]" value=<?= $tag_id?>><?= $tag_name?></input>
                    </div>
                <?php }
                    }

                ?>
                <br>
                <input type = "submit" class="btn btn-secondary btn-sm filter-btn" name="filter" value="Filter"></input>
            </form>
        </div>
        
<br><br><hr><h1 style="text-align: center;">Featured Products</h1><hr>
        <div class="container-fluid text-center">
            <div class="row">
        <?php 
            $conn = mysqli_connect("localhost", "root", "", "newbase");
            $prod_query = "select * from products where `featured` = 1";
            $prod_result = mysqli_query($conn, $prod_query);
            if(mysqli_num_rows($prod_result)){
                while($row = mysqli_fetch_assoc($prod_result)){
                    $prod_id = $row['prod_id'];
                    $prod_title = $row['prod_title'];
                    $list_price = $row['list_price'];
                    $discount = $row['discount'];
                    $price = $list_price - ($list_price*$discount/100);
                    $prod_category = $row['prod_category'];
                    $description = $row['description'];
                    $rating = $row['rating']; ?>
            <div class="col-md-4 col-sm-6 col-xs-6 col-lg-4 prod-tile">
                <a href="#" class="tile">
                    <table class="">
                        <tr>
                            <td>
                                <img class="card-img-top" src="./admin/uploads/product_images/<?= $prod_id?>.png" alt="Product">   
                                <br>                            
                                <h6 class="prod-title"><?= $prod_title?></h6>
                            </td>
                            <td class="prod-det">
                                        <span class="list-price text-danger">List Price: <s>$<?= $list_price ?></s></span><br>
                                        Our Price: $<?= $price ?><br>
                                        Save $<?= $list_price-$price ?> (<?=$discount ?>%)<br>
                                       <!-- <button type="button" class="btn btn-secondary">Details</button>-->
                                       <?php for($i=0; $i<$rating; $i++) echo '<i class="fa fa-star"></i>'; ?>

                            </td>
                        </tr>
                    </table>
                </a>
                    <br><br>
            </div>
                    
            <?php }
            }
        ?>
        </div>
        </div>
        <hr>
        <br><br><br><br><br>
        <?php include "includes/footer.php" ?>
        <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
</html>















