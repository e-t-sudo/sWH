<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php"; ?>
    <title>sWH</title>
    <style>
        .card-img-top{
            height: 100px;
            width: 100px;
            border-top-left-radius: 30px;
            border-bottom-right-radius: 30px;
            padding: 0px;
            margin: 0px;
        }
        table{
            height: 130px; 
            width: 80%;
        }
        .details-btn{
            width: 100%;
        }
        .prod-det{
            padding-left: 20px;
        }
    </style>
</head>
<body>
        <?php include "includes/header.php"; ?>
        <br><br><br><br><br><h1 style="text-align: center;">Featured Products</h1>
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
                    <table class="padding">
                        <tr>
                            <td>
                                <img class="card-img-top" src="./admin/uploads/product_images/<?= $prod_id?>.png" alt="Product">   
                                <br>                            
                                <h6><?= $prod_title?></h6>
                            </td>
                            <td class="prod-det">
                                        <span class="list-price text-danger">List Price: <s>$<?= $list_price ?></s></span><br>
                                        Our Price: $<?= $price ?><br>
                                        Save $<?= $list_price-$price ?> (<?=$discount ?>%)<br>
                                        <button type="button" class="btn btn-secondary">Details</button>

                            </td>
                        </tr>
                    </table>
                    <br><br>
                    </div>
                    
            <?php }
            }
        ?>
        </div>
        </div>
        <br><br><br><br><br>
        <?php include "includes/footer.php" ?>
</body>
</html>















