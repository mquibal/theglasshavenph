<?php require_once "../partials/template.php"; ?>
<?php function get_page_content(){
	if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
		global $conn; ?>

<div class="sidebar">
  <ul id="menu">
     <li id="menu-dashboard"><a href="dashboard.php"><i class="fa fa-dashboard fw"></i> Dashboard</a> </li>
    <li id="menu-dashboard"><a href="inventory.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Inventory</a> </li>
    <li id="menu-dashboard"><a href="orders.php"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fea../views/orders.phpther feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Orders</a></li> 
    <li id="menu-dashboard"><a href="product.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg> Products</a> </li>
    <li id="menu-dashboard"><a href="users.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> Customers</a></li>
  </ul>
</div>

		<div class="container-fluid">
			<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 mx-auto">
					<h1 class="text-center">Orders</h1>
	
					<table class="table table-striped">
						<thead>
							<tr id="table-head">
								<td>Transaction Code</td>
								<td>Status</td>
								<td>Actions</td>
							</tr>
						</thead>
						<tbody>
							<?php 
							$orders_query = "SELECT o.id, o.transaction_code, s.name AS status FROM orders o JOIN statuses s ON (o.status_id = s.id);";
							$orders = mysqli_query($conn, $orders_query);
							foreach($orders as $indiv_order){ ?>
							<tr>
								<td><?php echo $indiv_order['transaction_code']; ?></td>
								<td><?php echo $indiv_order['status']; ?></td>
								<td>
									<?php 
										if($indiv_order['status'] == "pending"){ ?>
										<a href="../controllers/complete_order.php?id=<?php echo $indiv_order['id'] ?>" class="btn btn-success">Complete Order</a>
										<a href="../controllers/cancel_order.php?id=<?php echo $indiv_order['id'] ?>" class="btn btn-danger">Cancel Order</a>
								<?php } ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					</div>	
				</div>
			</div>

	<?php } else {
		header("Location: ./error.php");
		} ?>	
<?php } ?>
<a href="#" id="scroll"><span></span></a>
