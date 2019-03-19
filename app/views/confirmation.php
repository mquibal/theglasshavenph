<?php require_once "../partials/template.php"; ?>
<?php function get_page_content(){ ?>
<?php if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['role_id'] ==2)) { ?>
	
	<div class="container my-4" id="confirmation">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h3>Your Reference Number for the order is: <?php echo $_SESSION['trans_code']; ?></h3>
				<?php unset($_SESSION['trans_code']); ?>
				<a href="./catalog.php" class="btn btn-primary">Continue Shopping</a>
			</div>
		</div>
	</div>
	<!-- else for checking -->
	<?php } else { 
 	header("Location: ./error.php");
 		}
	?>
	<!-- end of else here -->
<?php } ?>