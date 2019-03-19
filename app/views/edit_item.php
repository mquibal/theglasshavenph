<?php require_once "../partials/template.php"; ?>
<?php function get_page_content(){ ?>
<!-- place checking here -->
<?php if(isset($_SESSION['user']) && $_SESSION['user']['role_id']==1){ ?>
	<!-- end check here -->
<?php global $conn;
	$item_id = $_GET['id'];
	$edit_item_query = "SELECT * FROM items WHERE id = $item_id;";
	$result = mysqli_query($conn, $edit_item_query);
	$item = mysqli_fetch_assoc($result);
	if (!$result) {
		$_SESSION['message'] = "Item cannot be edited. Transaction history is found.";
	} else {
		$_SESSION['message'] = "Item was successfully edited!";
	}
 ?>
 <h4 id="edit-item">Edit Item</h4>
 <div class="container mb-5">
 	<div class="row">
 		<div class="col-lg-8 offset-lg-2">
 			<form action="../controllers/process_edit_item.php" method="POST" enctype="multipart/form-data">
 			<input type="number" name="id" value="<?php echo $item_id; ?>" hidden>
 				<div class="form-group">
 					<label for="name">Name:</label>
 					<input type="text" class="form-control" name="name" id="name" value="<?php echo $item['name']; ?>">
 				</div>
 				<div class="form-group">
 					<label for="price">Price:</label>
 					<input type="number" min="1" class="form-control" name="price" id="price" value="<?php echo $item['price']; ?>">
 				</div>
 				<div class="form-group">
 					<label for="description">Description:</label>
 					<textarea class="form-control col-8" rows=5 id="description" name="description"><?php echo $item['description']; ?></textarea>
 				</div>
 				<div class="form-group">
 					<label for="categories">Category:</label>
 					<select class="form-control" required id="categories" name="category_id">
 						<?php 
 						$sql = "SELECT * FROM categories";
 						$categories = mysqli_query($conn, $sql);
 						foreach ($categories as $category) {
 							extract($category);
 							$selected = $item['category_id'] == $id ? 'selected' : '';
 							echo "<option value=$id $selected>$name</option>";
 							}
 						 ?>
 					</select>
 				</div>
 				<div class="form-group">
 					<label for="image">Image:</label>
 					<input type="file" class="form-control" name="image" id="image" required>
 				</div>
 				<button type="submit" class="btn btn-primary">Edit Item</button>
 			</form>
 		</div>
 	</div>
 </div>
 <!-- place else here -->
	<?php } else {
	header("Location: ../views/dashboard.php");
		}
 	?>
 <!-- end else here -->
<?php } ?>