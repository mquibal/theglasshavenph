<?php require_once "../partials/template.php";
function get_page_content(){ ?>
<!-- checking here -->
<?php if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['role_id'] ==2)) { ?>
<!-- end checking here -->
<?php global $conn; ?>
	<?php
		if (!isset($_SESSION['user'])){
			header("Location: login.php");
		}
	?>



	<form method="POST" action="../controllers/placeorder.php">
		<div class="container" id="checkout">
			<div class="row mt-4">
				<div class="col-sm-6">
					<h4>Shipping Information</h4>
					<div class="form-group">
						<input type="text-capitalize" class="form-control mb-2" name="firstname" placeholder="First Name" value="<?php echo $_SESSION['user']['firstname'] ?>">

						<input type="text-capitalize" class="form-control mb-2" name="lastname" placeholder="First Name" value="<?php echo $_SESSION['user']['lastname'] ?>">

						<input type="text" class="form-control" name="addressLine1" placeholder="Address Line 1" value="<?php echo $_SESSION['user']['address'] ?>">
					</div>
				</div>
				<div class="col-sm-4">
					<h4>Payment Method</h4>
					<select class="form-control" id="payment_mode" name="payment_mode">
						<?php 
						$payment_mode_query = "SELECT * FROM payment_modes;";
						$payment_modes = mysqli_query($conn, $payment_mode_query);
						foreach($payment_modes as $payment_mode){
							extract($payment_mode);
							echo "<option value='$id'>$name</option>";
						}
						?>
					</select>
				</div>
			</div>

			<hr>
			<div class="row cart-items mt-4">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="cart-items">
						<thead>
							<tr class="text-center" id="table-head">
								<th colspan="2">Item Name</th>
								<th>Item Price</th>
								<th>Item Quantity</th>
								<th>Item Subtotal</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($_SESSION['cart'] as $id => $qty){
								$sql_query = "SELECT * FROM items WHERE id = $id;";
								$itemInfo = mysqli_query($conn, $sql_query);
								$item = mysqli_fetch_assoc($itemInfo);
							?>
							<tr><td class="item_name text-center align-middle" colspan="2"><?php echo $item['name']; ?></td>
							<td class="item_price text-center align-middle"> &#8369; <?php echo $item['price']; ?></td>
							<td class="item_quantity text-center align-middle"><?php echo $qty; ?></td>
							<td class="item_subtotal text-center">
								&#8369; <?php echo $qty * $item['price']; ?>
							</td></tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-8">
					<h4>Order Summary</h4>
				</div>
			</div>

			<div class="row mb-5">
				<div class="col-sm-6"><h5>Total</h5></div>
				<div class="col-sm-6" id="total_price">
					&#8369; <?php
					$cart_total=0;
					foreach($_SESSION['cart'] as $id => $qty){
						$sql_query = "SELECT * FROM items WHERE id = $id;";
						$itemInfo = mysqli_query($conn, $sql_query);
						$item = mysqli_fetch_assoc($itemInfo);

						$subTotal = $_SESSION['cart'][$id] * $item['price'];
						$cart_total += $subTotal;
					}
					echo $cart_total;
					?>
				</div>
			</div>

			<button type="submit" class="btn btn-success d-block">Place Order Now</button>



		</div>
	</form>
	<!-- else for checking -->
	<?php } else { 
 	header("Location: ./error.php");
 		}
	?>
	<!-- end of else here -->
<?php }?>