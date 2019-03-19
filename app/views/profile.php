<?php require_once "../partials/template.php" ?>
<?php function get_page_content() { ?>
<?php $user = $_SESSION['user']; ?>
<?php global $conn; ?>

<div class="container mb-5">
	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-7">
					<h1 class="dashboard_header text-center mt-2">Update Profile</h1>

					 <?php 
                        if(isset($_SESSION['message'])){
                            echo "<h5 id='items-message'>" . $_SESSION['message'] . "</h5>";
                            unset($_SESSION['message']);
                        }
                    ?>
					
					<form action="../controllers/update_user.php" method="POST">
						<div class="container">
							<input type="text" name="user_id" class="form-control" value="<?php echo $user['id']; ?>" hidden>
							<label for="username">Username</label>
							<input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" id="username" disabled>
							<span class="validation"></span><br>
							<label for="old_password">Old Password</label>
							<input type="password" name="old_password" class="form-control" id="old_password">
							<span class="validation"></span><br>

							<label for="new_password">New Password</label>
							<input type="password" name="new_password" class="form-control" id="new_password">
							<span class="validation"></span><br>

							<label for="firstname">First Name</label>
							<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" disabled>
							<span class="validation"></span>

							<label for="lastname">Last Name</label>
							<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" disabled>
							<span class="validation"></span>

							<label for="email">E-mail Address</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" disabled>
							<span class="validation"></span>

							<label for="address">Home Address</label>
							<input type="address" class="form-control mb-3" id="address" name="address" value="<?php echo $user['address']; ?>" disabled>
							<span class="validation"></span>
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
<?php } ?>