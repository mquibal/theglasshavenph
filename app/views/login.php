<?php require_once "../partials/template.php" ?>
<?php function get_page_content() { ?>

<?php if(isset($_SESSION['user'])) {
	header("Location: home.php");
	die;
} ?>


<div class="background">

<div class="container">
	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4">
			<div class="header">
		  		<h2>Login</h2>
			</div>

		<form action="../controllers/authenticate.php" method="POST" class="form_login mb-5">
							
			<span id="validation_login" class="error_prompt"></span> <!-- for error message -->
			
			<div class="form-group mb-3">
			
			<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
			</div>

			
			<div class="form-group">
			<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">	
			</div>

			<div class="form-group" id="btn-login">
				<button type="button" class="btn_validation" id="login">Log In</button>
			</div>

			<p class="">
				Not yet a member? <a href="register.php">Sign up</a>
				</p>

		</form>
	  </div>
   </div>	
</div>		

</div>	
			
<?php } ?>