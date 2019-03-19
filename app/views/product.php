   <?php require_once "../partials/template.php" ?>
<?php function get_page_content(){ ?>
<?php if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) { ?>
<?php global $conn; ?>


<div class="sidebar">
  <ul id="menu">
     <li id="menu-dashboard"><a href="dashboard.php"><i class="fa fa-dashboard fw"></i> Dashboard</a> </li>
    <li id="menu-dashboard"><a href="inventory.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Inventory</a> </li>
    <li id="menu-dashboard"><a href="orders.php"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fea../views/orders.phpther feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Orders</a></li> 
    <li id="menu-dashboard"><a href="product.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg> Products</a> </li>
    <li id="menu-dashboard"><a href="users.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> Customers</a></li>
  </ul>
</div>


		<div class="container">
        <div class="row">
          <div class="col-lg-1 col-md-2 col-sm-2"></div>   
          <div class="col-lg-9 col-md-6 col-sm-5 mx-auto">
          <h1 class="text-center">Active Products</h1>
              <div>
                  <a href="new_item.php" class="btn btn-primary my-4">Create Product</a>
               </div>
                    <?php 
                        if(isset($_SESSION['message'])){
                            echo "<h5 id='items-message'>" . $_SESSION['message'] . "</h5>";
                            unset($_SESSION['message']);
                        }
                    ?>
    
                    <?php 
                        $item_query = "SELECT * FROM items";
                        $items = mysqli_query($conn, $item_query);
                     ?>
                     <table class="table table-striped">
                        <thead>
                            <tr id="table-head">
                                <td>Product</td>
                                <td>Price</td>
                                <td>Description</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item) { ?>
                                <tr>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['price'] ?></td>
                                    <td><?php echo $item['description'] ?></td>
                                    <td><a href="../views/edit_item.php?id=<?php echo $item['id']?>" class="btn btn-primary">Edit Item</a>
                                    <a href="../controllers/delete_item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete Item</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                     </table>
                  </div>
              </div>
            </div>

       <?php }else { 
		header("Location: ./error.php");

}?>
<?php } ?>           