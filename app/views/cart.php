<?php require_once "../partials/template.php"; ?>
<?php function get_page_content(){ ?>
<!-- checking here -->
<?php if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['role_id'] ==2)) { ?>
<!-- end checking here -->
<?php global $conn; ?>

<div class="top">
  <div class="top_image">   
       <h1 class="top_content">Cart</h1>
    </div>  
</div>

<div class= "container my-4">
	<div class="table-responsive">
		<table class="table table-striped table-bordered" id="cart-items">
			<thead>
				<tr class="text-center" id="table-head">
					<th>Product</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th>Actions</th>
				</tr>
			</thead>
						<tbody>
				<?php
				if (isset($_SESSION['cart'])) { 
					if(count($_SESSION['cart'])!=0){
						$cart_total = 0;
						foreach($_SESSION['cart'] as $id => $qty){
							$sql_query = "SELECT * FROM items WHERE id = '$id';";
							$itemInfo = mysqli_query($conn, $sql_query);
							$item = mysqli_fetch_assoc($itemInfo);
							$subTotal = $_SESSION['cart'][$id] * $item['price'];
							$cart_total += $subTotal;
						?>
						<tr>
							<td class="item_name align-middle"><?php echo $item['name']; ?></td>
							<td class="item_price text-right align-middle"><?php echo $item['price']; ?></td>
							<td class="item_quantity align-middle"><input type="number" value="<?php echo $qty; ?>" class="form-control text-right align-middle mx-auto" min="1" style="width:150px" data-id="<?php echo $id; ?>" oninput="this.value = Math.abs(this.value)"></td>
							<td class="item_subtotal text-right align-middle"><?php echo $subTotal; ?></td>
							<td class="item_action text-center align-middle"><button class="btn btn-danger item-remove" data-id="<?php echo $id; ?>">Remove from Cart</button></td></tr>
				<?php } ?>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td class="text-right font-weight-bold align-middle" colspan="4">Total</td>
					<td class="text-right font-weight-bold align-middle" id="total_price">
						&#8369;<?php 
						echo $cart_total;
						?>
					</td>
				</tr>
				<tr>
					<td>
						<a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
					</td>
					<td>
						<a href="../controllers/clear_cart.php" class="btn btn-info">Clear Cart</a>
					</td>
				</tr>
			</tfoot>
			<?php
			} else { 
				echo "<tr><td class='text-center' colspan='6'> No Items in Cart </tr></td>";
			} ?>
		</table>
	  	</div>
   </div>
</div>
<!-- else for checking -->
<?php } else { 
header("Location: ./error.php");
 	}
?>
<!-- end of else here -->
<?php  } ?>