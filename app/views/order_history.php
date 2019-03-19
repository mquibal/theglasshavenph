<?php require_once "../partials/template.php" ?>
<?php function get_page_content() { ?>
<?php $user = $_SESSION['user']; ?>
<?php global $conn; ?>

<div class="container mt-5 mb-5">
	<div class="row"  id="user-info">
		<div class="col-lg-1"></div>
		<div class="col-lg-11">

	<div class="tab-pane" id="history" role="tabpanel">
					<div class="row">
						<div class="col-md-6">
							<h3 id="profile-info">Order History</h3>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-canter" id="table-head">
									<th>Transaction Number</th>
									<th>Purchase Date</th>
									<th>Status</th>
									<th>Payment Mode</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$order_hist_query = "SELECT o.transaction_code, o.purchase_date, s.name AS status, p.name AS payment_mode FROM orders o JOIN statuses s JOIN payment_modes p ON (o.status_id = s.id AND o.payment_mode_id = p.id) WHERE o.user_id =". $_SESSION['user']['id'];
									$transactions = mysqli_query($conn, $order_hist_query);
									foreach ($transactions as $transaction) { ?>
										<tr>
											<td><?php echo $transaction['transaction_code']; ?></td>
											<td><?php echo $transaction['purchase_date']; ?></td>
											<td><?php echo $transaction['status']; ?></td>
											<td><?php echo $transaction['payment_mode']; ?></td>
										</tr>
									<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>















<?php } ?>