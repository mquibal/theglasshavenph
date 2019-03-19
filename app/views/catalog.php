<?php require_once "../partials/template.php" ?>
<?php function get_page_content() { ?>
<!-- checking here -->
<?php if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['role_id'] ==2 )) { ?>
<!-- end checking here -->
<?php global $conn; //refers to $conn outside of my function
    //require_once "../controllers/connect.php";?>

<div class="top">
  <div class="top_image">   
       <h1 class="top_content">Product</h1>
    </div>  
</div>


    <div class="container">
        <div class="row">

            <div class="col-lg-3 my-4">
                <h1>Categories</h1>
                    <a class="list-group-item" id="all_link" href="catalog.php">All</a>
                                            
                    <?php 

                        $sql_query = "SELECT * FROM categories";
                        $categories = mysqli_query($conn, $sql_query);
                        foreach ($categories as $category) {?>
                        <a class="list-group-item" href="catalog.php?category_id=<?php echo $category['id']; ?>" class="category" data-id="<?php echo $category['id']?>">
                            <?php echo $category['name'];?> 

                        </a>
                    <?php } ?>


                <h2 class="my-4">Sort By</h2>       
        
                        <a class="list-group-item" href="../controllers/sort.php?sort=asc">Price(Lowest-Highest)</a>
                        <a class="list-group-item mb-4" href="../controllers/sort.php?sort=desc">Price(Highest-Lowest)</a>
                
             
                <div class="input-group">
                  <input type="text" id="search" class="form-control" placeholder="search products">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="searchButton"><i class="fas fa-search"></i></button>
                  </span>
                </div><!-- /input-group -->
            
                
            </div>

            <div class="col-lg-9 my-4">

                <div class="row" id="products">

            
                <?php
                    $sql_query2 = "SELECT * FROM items";
                    if(isset($_GET['category_id'])){
                        $sql_query2 .= " WHERE category_id =" . $_GET['category_id'];
                    }
                    if(isset($_SESSION['sort'])){
                        $sql_query2 .= $_SESSION['sort'];
                    }
                    $items = mysqli_query($conn, $sql_query2);
                    echo "<div class='row'>";
                    foreach($items as $item){ ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 py-2">
                        <img id="catalog_product" data-toggle="modal" data-target="<?php echo '#modalCenter' . $item['id'] ?>" src="<?php echo $item['image_path'];?>">
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo 'modalCenter' . $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLongTitle"><?php echo $item['name']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <br>
                                    <?php echo 'Description: <br>'.$item['description']; ?>
                                    <br>
                                    <br>
                                    Price: <?php echo '&#8369;' . $item['price']; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="number" class="form-control" value=1>
                                    <button type="submit" class="btn btn-outline-primary add-to-cart" data-id="<?php echo $item['id'];?>">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                <?php echo "</div>"; ?>
            </div>
        </div>
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
<!-- scroll up -->
<a href="#" id="scroll"><span></span></a>