<?php 
    if(isset($_GET['product_id'])){
            $prod_id = $_GET['product_id'];
            $conn = mysqli_connect("localhost", "root", "", "newbase");
            $prod_query = "select * from products where `prod_id` = $prod_id";
            $result = mysqli_query($conn, $prod_query);
            if(mysqli_num_rows($result)>0){
                $result = mysqli_fetch_assoc($result);
                $prod_title = $result['prod_title'];
                $list_price = $result['list_price'];
                $discount = $result['discount'];
                $price = $list_price - ($list_price*$discount/100);
                $cat_id = $result['prod_category'];
                $rating = $result['rating']; 
                $description = $result['description']; ?>
<!-- Page to be rendered if the product information is requested -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $prod_title?></title>
    <?php include "./includes/head.php"; ?>
</head>
<body>
        <?php include "./includes/header.php"; ?>
        <br><br><br><br><br><br><br><br>
                <h3 class="text-center"><?= $prod_title?></h3>
        <div class="container-fluid prod_details">
            <div class="row">
                <div class="prod_images col-md-6">
                    <style>
                        #prod_image_lg{
                            width: 100%;
                        }
                        .prod_image_sm{
                            width: 100%;
                            padding: 5px;
                            margin: 20px;
                        }
                        .clicked{
                            border: solid green;
                            border-top-left-radius: 5px;
                            border-bottom-right-radius: 5px;
                        }
                        .short_description{
                            font-family:Helvetica, sans-serif;
                        }
                        .addtocart{
                            position: absolute;
                            right: 5px;
                        }
                    </style>
                    <div class="row">
                        <div class="col-12">
                            <img id="prod_image_lg" src="./img/carousel/2.png">
                        </div>
                        <div onClick="expandImage(1)" class="col-4">
                            <img class="prod_image_sm clicked" id = "prod_image_sm1" src="./img/carousel/2.png">
                        </div>
                        <div class="col-4">
                         <img onClick="expandImage(2)" class="prod_image_sm" id = "prod_image_sm2" src="./img/carousel/3.png">
                        </div>
                        <div class="col-4">
                            <img onClick="expandImage(3)" class="prod_image_sm" id="prod_image_sm3" src="./img/carousel/4.png">
                        </div>
                    </div>
                </div>
                <div class="prod_description col-md-6">
                        <h5><?= $prod_title ?></h5>
                        <p><?= $description ?></p>
                        <p>Rating: <?= $rating?></p>
                        <p>Price: $<?= $price?> </p>
                        <form action="addtocart.php" method="post">
                            <div class="form-group">
                                    <div class="col-xs-3">
                                        <input type="text" class="form-control" name="something">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <select name="format" class="form-control">
                                        <option value=1>Monthly Subscription</option>
                                        <option value=1>Annual Subscription</option>
                                        <option value=1>Lifetime Access</option>
                                    </select>
                            </div>
                            <input type="hidden" name="prod_id" value=<?= $prod_id?>>
                            <button type="submit" name="addtocart" class="btn btn-success addtocart"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
                        </form>
                 </div>
            </div>
        </div>

        <br><br><br><br><br><br>
        <?php include "./includes/footer.php"; ?>
<script>
    function expandImage(num){
            let clickedId = "prod_image_sm" + num;
            for(let i=1; i<=3; i++){
                document.getElementById("prod_image_sm"+i).classList.remove("clicked");
            }
           document.getElementById("prod_image_lg").src = document.getElementById(clickedId).src;
            document.getElementById(clickedId).classList.add("clicked");
    }
</script>
</body>
</html>
<!--Page ends -->           

<?php       }
            

    }else{
        //redirect to product list if no specific product details are requested
        header("Location: products.php");
    }
?>
