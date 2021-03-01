
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My E-Commerce Project</title>
 <?php include 'includes/head.php'; ?>
</head>
<body>
<?php include "./logincheck.php"; ?>
<?php include 'includes/header.php'; ?>

<!--MODAL -->

		<div class="modal checkout-modal" id="checkout-modal" tabindex="-1" role="dialog" aria-labelledby="checkout-modal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header-1" style = "display:block">
				<div class="text-center">
				<h5 class="modal-title">Delivery Address</h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-header-2" style="display:none">
				<div class="text-center">
				<h5 class="modal-title">Payment Details</h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class='modal-body'>
				<!-- HERE IT COMES -->
				<form action="checkout.php" method="post">
				<div id="step1" style="display:block">
					<h3 class="text-center">Delivery Adress</h3>
					<div class="container-fluid">
					<div class="row">
					<div class="form-group col-md-6">
						<input class="form-control" type="text" name="address" placeholder="Full Address">
					</div>
					<div class="form-group col-md-6">
						<input class="form-control" type="number" name="zip" placeholder="Zip Code">
					</div>
					</div>
					</div>
				</div>
				<div id="step2" style="display:none">
					<h3 class="text-center">Payment Details</3>
					<div class="container-fluid">
					<div class="row">
					<div class="form-group col-md-6">
						<input class="form-control" type="number" name="card_number" placeholder="Card Number">
					</div>
					<div class="form-group col-md-6">
						<input class="form-control" type="text" name="card_name" placeholder="Name on the Card">
					</div>
					<div class="form-group col-md-6">
						<select class = "form-control" name = "card_exp_month">
						<?php
						for($i = 1; $i <= 12; $i++){
						print('<option value = "'.$i.'">'.$i.'</option>');
						}
						?>
						</select>
					</div>
					<div class="form-group col-md-6">
						<select class="form-control" name = "card_exp_year">
						<?php
						$yr = date('Y');
						for($i = $yr; $i <= $yr+5; $i++){
						print('<option value = "'.$i.'">'.$i.'</option>');
						}
						?>
						</select>
					</div>
					<div class="form-group col-md-6">
						<input class="form-control" type="number" name="cvv" placeholder="CVV">
					</div>
					</div>
					</div>
					<div class="form-group text-right">
						<button type="submit" name="checkout" class="form-control btn btn-success checkout_btn">Checkout >></button>
					</div>
				</div>
				</form>
				<div class="text-right">
			    	<button class="btn btn-primary next-step" style="display:block-inline;">Next >></button>
				</div>
				<div class="text-left">
				    <button class="btn btn-warning back-step" style="display:none">Back</button>
				</div>
			</div>
		</div>
	</div>
</div>


<!------------>








<?php
$conn = mysqli_connect('localhost', 'root', '', 'testbase');
if(isset($_POST['addtocart'])){
        $cart_id = $_SESSION['customer_id'];
        $prod_id = $_POST['prod_id'];
        $activation_period = $_POST['activation_period'];
        $update_query = "insert into carts (cart_id, cart_prod, quantity) values ('$cart_id', '$prod_id', '$quantity')";
        mysqli_query($conn, $update_query);
        mysqli_close($conn);
}
?>

<div class="container-fluid padding">
	<div class="padding">
	<br><br><br><br><br><br>
	<h2 class="text-center"><?php $conn = mysqli_connect('localhost', 'root', '', 'newbase'); $result = mysqli_query($conn, "select * from customers where customer_id = ".$_SESSION['customer_id']); $row = mysqli_fetch_array($result); echo $row['full_name']; ?></h2>
	<h1 class="text-center"><i class="fa fa-shopping-cart"></i></h1>
	<br><br><br><br><br><br>
	</div>
	</div>
	<hr>



<table class="table table-bordered table-striped text-center">
<thead><th></th><th>Product</th><th>Activation Period</th><th>LifeTime Access Price</th><th>Total</th></thead>
<tbody>
<?php
$conn = mysqli_connect("localhost", "root", "", "newbase");
if(! $conn ) {
	die('Could not connect: ' . mysqli_error());
}
$cart_total = 0;
$customer_id = $_SESSION['customer_id'];
$query = "select * from carts where cart_id = ".$customer_id;
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_array($result)){
$prod_id = $row['prod_id'];
$prod_name = '';
$prod_price = '';
$activation_period = $row['activation_period'];
$prod_total = '';

	$prod_detail_query = "select * from products where prod_id = ".$prod_id;
	$detail_result = mysqli_query($conn, $prod_detail_query);
	if(mysqli_num_rows($detail_result) > 0){
	while($prod = mysqli_fetch_array($detail_result)){
	$prod_name = $prod['prod_title'];
	$prod_price = ($prod['list_price'] - $prod['list_price']/100);
	$total_price = $prod_price/$activation_period;
    $cart_total = $cart_total + $total_price;
	print('<tr><td></td><td>'.$prod_name.'</td><td>'.$activation_period.'</td><td>'.$prod_price.'</td><td>'.$total_price.'</td></tr>');
	}
	}
}
}
print('<tr><td colspan = "4">Cart Total</td><td>'.$cart_total.'</td></tr>');
mysqli_close($conn);
?>
</tbody>
</table>
<div class="text-right">
<button class="btn btn-primary modal-btn" >Check Out</button>
</div>
	<?php include 'includes/footer.php'; ?>
	
	<!--MODAL Handler -->
	
	<script type='text/javascript'>
	$(document).ready(function(){	
		$('.modal-btn').click(function(){
			$('#checkout-modal').modal('show');
		});
		$('.next-step').click(function(){
				$('#step1').css('display', 'none');
				$('.next-step').css('display', 'none');
				$('#step2').css('display', 'block');
				$('.back-step').css('display', 'block');
				$('.modal-header-1').css('display', 'none');
				$('.modal-header-2').css('display', 'block');
				
			//	$('.checkout_btn').css('display', 'block-inline');
		});
			$('.back-step').click(function(){
				$('#step1').css('display', 'block');
				$('.next-step').css('display', 'block');
				$('#step2').css('display', 'none');
				$('.back-step').css('display', 'none');
				$('.modal-header-1').css('display', 'block');
				$('.modal-header-2').css('display', 'none');
		//		$('.checkout_btn').css('display', 'none');
		});
	});
	</script>
	
	<!-------->
</body>
</html>