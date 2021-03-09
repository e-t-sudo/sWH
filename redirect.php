
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payment Successful</title>
 <?php include 'includes/head.php'; ?>
</head>
<body>
<?php include 'logincheck.php'; ?>
<?php include 'includes/header.php'; ?>

	<div class="container-fluid padding">
	<div class="padding">
	<br><br><br><br><br><br>
    <?php if(isset($_SESSION['customer_id'])){ ?>
	<h2 class="text-center"><?php $conn = mysqli_connect('localhost', 'root', '', 'testbase'); $result = mysqli_query($conn, "select * from customers where customer_id = ".$_SESSION['customer_id']); $row = mysqli_fetch_array($result); echo $row['full_name']; ?></h2>
    <?php } ?>
	<a href = "index.php"><h1 class="text-center"><i class="fa fa-home"></i></h1></a>
	<a href = "index.php"><p class="text-center">Back to Homepage</p></a>
	<br><br>
	</div>
	</div>
	<hr>

<?php if(isset($_GET['payment_id'])){
    $payment_id = $_GET['payment_id']; ?>
<div class="bg-success text-center"><p>Your Payment <?php if(isset($_SESSION['cart_total'])){ echo "of ".$_SESSION['cart_total'];}?> was successfully processed with Payment ID:<?php echo $payment_id;?></p></div>
<?php } ?>

        <div class="text-center">
            
        </div>
            <?php
            if(isset($_SESSION['cart_id'])){//purchase succesful
                $cart_id = $_SESSION['cart_id'];
                //add cart_rows into 'purchased' table
                $buy_date = time();
                $conn = mysqli_connect('localhost', 'root', '', 'newbase');
                $cart_query = "select * from carts where cart_id = ".$_SESSION['cart_id'];
                $result_cart = mysqli_query($conn, $cart_query);
                if(mysqli_num_rows($result_cart) > 0){
                    while($row = mysqli_fetch_array($result_cart)){
                        $prod_id = $row['prod_id'];
                        $prod_details = mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "", "newbase"), "select * from products where prod_id = ".$prod_id));
                        var_dump($prod_details);
                        echo $buy_date, "<br>";
                        echo "<br>";
                        $insert_query = "insert into purchases (cart_id, prod_id, buy_date) values ('$cart_id', '$prod_id','$buy_date')";
                        $delete_query = "delete from carts where cart_id = ".$cart_id." AND prod_id = ".$prod_id;

                    }
                    }
                    unset($_SESSION['cart_id']);
            }
            ?>
</body>
</html>