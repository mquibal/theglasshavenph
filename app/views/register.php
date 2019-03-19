<?php require_once "../partials/template.php" ?>
<?php function get_page_content(){
 	global $conn; ?>

<?php if(isset($_SESSION['user'])) {
	header("Location: home.php");
	die;
} ?>


<div class="background">

	<div class="container">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
			<div class="header">
		  		<h2>Register</h2>
			</div>
				
			<form action="../controllers/create_user.php" method="POST" class="mb-5">



				<div class="form-group">
					<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
					<span class="validation" id="validation_register"></span>
				</div>

				<div class="form-group">
					<input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address">
					<span class="validation"></span>
				</div>


				<div class="form-group">
					<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name">
					<span class="validation"></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name">
					<span class="validation"></span>
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" id="address" name="address" placeholder="Enter Home Address">
					<span class="validation"></span>
				</div>

				
				<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
					<span class="validation"></span>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
					<span class="validation"></span>
				</div>
			
			<div class="form-group">
				<button type="button" class="btn_validation" id="add_user">Register</button>
			</div>
			<p>Already a member?<a href="login.php"> Sign in</a></p>
	




</form>


		</div>
	</div>
</div>
</div>

	
<?php } ?>