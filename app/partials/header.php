<header>
    <div>
		<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar-top">

				<a class="navbar-brand ml-5" href="../index.php"> Glass Haven</a>
				<button class="navbar-toggler navbar-toggle-right" type="button" data-toggle="collapse" data-target="#navbar">
					<span class="navbar-toggler-icon"></span>
				</button>


				<div class="collapse navbar-collapse text-right" id="navbar">
					<ul class="navbar-nav mx-auto">
					<?php if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 2)){ ?>

						<li class="nav-item">
							<a class="nav-link ml-4" href="../views/home.php">Home</a>
						</li>	

						<li class="nav-item">
							<a class="nav-link ml-4" href="../views/catalog.php">Shop</a>
						</li>

						<li class="nav-item">
							<a class="nav-link ml-4" href="../views/home.php#about">About</a>
						</li>	

						<li class="nav-item">
							<a class="nav-link ml-4" href="../views/gallery.php">Gallery</a>
						</li>	

						<li class="nav-item">
							<a class="nav-link ml-4" href="../views/contact.php">Contact</a>
						</li>	



						<?php } elseif(isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) { ?> 


						<?php } ?>

						
					</ul>

					<ul class="nav navbar-nav navbar-right text-capitalize">


					<?php if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 2)){ ?>

						<li class="nav-item">
							<a class="nav-link ml-4" href="../views/cart.php"><i class="fas fa-shopping-cart" title="Cart"></i>
								<span class="badge bg-light text-dark" id="cart-count">
									<?php if(isset($_SESSION['cart'])){
										echo array_sum($_SESSION['cart']);
										} else {
											echo 0;
										} ?>
								</span>
							</a>
						</li>


					 <?php } ?>

						<?php  if(!isset($_SESSION['user'])) {?>
								
						<li class="nav-item">
							<a class="nav-link" href="../views/login.php"><i class="fas fa-sign-in-alt" title="Login"></i><span title="hover text"></span></a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="../views/register.php"><i class="fas fa-user-plus" title="Register"></i><span title="hover text"></span></a>
						</li>
						<?php } else { ?>

						
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fas fa-user-alt"></i>


								<?php echo $_SESSION['user']['firstname']  ?> 
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">

								<?php if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1)){ ?>


						          <a class="dropdown-item" href="../views/dashboard.php">Dashboard</a>

						          <?php } ?>

						          <a class="dropdown-item" href="../views/profile.php">Edit Profile</a>

						          <?php if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 2)){ ?>


						          <a class="dropdown-item" href="../views/order_history.php">Order History</a>

						          <?php } ?>



						          <a class="dropdown-item" href="../controllers/logout.php">Log Out</a>
						        </div>

						  </li>      
							
						<?php } ?>



					</ul>

				</div>			
		</nav>
</header>
