<?php require_once "../partials/template.php"; ?>
<?php function get_page_content(){ ?>
<!-- place checking here -->
<?php if(isset($_SESSION['user']) && $_SESSION['user']['role_id']==1){ ?>
	<!-- end check here -->
<?php global $conn; ?>
	<div class="container mb-5">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
			<h4 id="add-new-item">Create Product</h4>
				<form action="../controllers/process_new_item.php" method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Product Name:</label>
						<input type="text" class="form-control" name="name" id="name" required>
					</div>
					<div class="form-group">
						<label for="price">Price:</label>
						<input type="number" class="form-control" name="price" id="price" required>
					</div>
					<div class="form-group">
						<label for="description">Description:</label>
						<textarea class="form-control col-12" rows="5" id="description" name="description" required></textarea>
					</div>
					<div class="form-group">
						<label for="categories">Category:</label>
						<select class="form-control col-8" id="categories" name="category_id">
							<?php 
								$category_query = "SELECT * FROM categories";
								$categories = mysqli_query($conn, $category_query);
								foreach ($categories as $category) {
									//category['id'], $category['name']
									extract($category);
									//extract is another way of transforming data for a row to variables. It transforms each column into a variable with name = column name.
									echo "<option value='$id'>$name</option>";	
								}
							 ?>
						</select>
					</div>
					<div class="form-group">
							<label for="image_path"></label>
							<input type="file" class="form-control" name="image_path" id="image_path" required>
					</div>
					<button type="submit" class="btn btn-primary">Create</button>
				</form>
			</div>
		</div>
	</div>
	<!-- place else here -->
	<?php } else {
		header("Location: ./error.php");
		}
 	?>
 	<!-- end else here -->
<?php } ?>