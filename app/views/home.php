<?php require_once "../partials/template.php" ?>
<?php function get_page_content() { 
    global $conn;?>

<section class="full-width-img img-fluid">
    <div class="container">
      <div class="row">
            <div class="box img-fluid">
        
            </div>
        
        </div>
    </div>
</section>



<section class="mb-5">
    <div class="container">
      <div class="row">
          <div class="col-lg-5 col-md-6">
            <div class="main_logo"></div>
          </div>

          <div id="about"></div>
          <div class="col-lg-5 col-md-6">   
             <h2 class="main_prod animated slideInLeft">Our Story</a></h2>
             <p>Glass Haven is a family business that creates household and event decors. We are now the official supplier of souvenir shops, event organizer and caterers.  Our biggest clients that we have catered were Lay Bare Philippines and The Lost Bread Restaurant.</p>

            <p>Our company’s vision is to become one of the leading distributors of premium glass in the Philippines.  We are committed to deliver high quality products to our customers. 
            </p>
          </div>
      </div>
    </div>
  </section>



<section class="full-width-img2">
    <div class="container">
      <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-7">
         <h2 class="main_prod">Hi Customer!</h2>
        <p>Welcome to our webshop! We are creating high quality glassware as decoration for your home or events.</p>
        
          </div>
      </div>
    </div>
</section>


<div class="container">
    <h2 class="main_heading1" id="main_gallery">Our Gallery</h2>
        <div class="gallery">
          <div class="gallery-item">
              <img class="gallery-image" src="../assets/images/gallery/sample1.jpg">
          </div>
          <div class="gallery-item">
               <img class="gallery-image" src="../assets/images/gallery/sample2.jpg">
          </div>
          <div class="gallery-item">
               <img class="gallery-image" src="../assets/images/gallery/sample3.jpg">
          </div>
        </div>
  </div>
    <div class="d-block text-center py-4">
        <a href="gallery.php"><button type="button" class="btn btn-primary">See more</button></a>
    </div>
</div>


<div class="container">
      <h2 class="main_heading2">Featured Products</h2>

                <?php
                    $sql_query2 = "SELECT * FROM items LIMIT 3";
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
                        <div class="container">
                          <div class="row" >
                          <img id="catalog_product" data-toggle="modal" data-target="<?php echo '#modalCenter' . $item['id'] ?>" src="<?php echo $item['image_path'];?>">
                          </div>
                        </div>
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
    
  
    </div>

      <div class="d-block text-center py-4">
        <a href="catalog.php"><button type="button" class="btn btn-primary">View All</button></a>
    </div>
    
</div>  
<?php } ?>  