<?php require_once "../partials/template.php" ?>
<?php function get_page_content(){ ?>
<?php if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) { ?>
<?php global $conn; ?>




<!-- The sidebar -->
<div class="sidebar">
  <ul id="menu">
     <li id="menu-dashboard"><a href="dashboard.php"><i class="fa fa-dashboard fw"></i> Dashboard</a> </li>
    <li id="menu-dashboard"><a href="inventory.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Inventory</a> </li>
    <li id="menu-dashboard"><a href="orders.php"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fea../views/orders.phpther feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Orders</a></li> 
    <li id="menu-dashboard"><a href="product.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg> Products</a> </li>
    <li id="menu-dashboard"><a href="users.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> Customers</a></li>
  </ul>
</div>

<!-- Page content -->
<div class="content mb-5">
   <div id="content">
         <div class="page-header">
            <div class="container-fluid">
              <h1>Dashboard</h1>
            </div>
        </div>

        <div class="container-fluid">
          <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                      <div class="tile tile-primary">
                                        <div class="tile-heading">Total Orders <span class="pull-right">0%</span></div>
                                         <div class="tile-body"><i class="fa fa-shopping-cart"></i>
                                          <h2 class="pull-right">3.3K</h2>
                                        </div>
                                        <div class="tile-footer"><a href="">View more...</a></div>
                                      </div>
                                    </div>


                                      <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="tile tile-success">
                                          <div class="tile-heading">Total Sales <span class="pull-right">0%</span></div>
                                          <div class="tile-body"><i class="fa fa-credit-card"></i>
                                            <h2 class="pull-right">7.2K</h2>
                                          </div>
                                          <div class="tile-footer"><a href="">View more...</a></div>
                                        </div>
                                      </div>

                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                          <div class="tile tile-warning">
                                            <div class="tile-heading">Total Customers <span class="pull-right"><i class="fa fa-caret-down"></i>-50%</span></div>
                                            <div class="tile-body"><i class="fa fa-user"></i>
                                              <h2 class="pull-right">26.7K</h2>
                                            </div>
                                            <div class="tile-footer"><a href="">View more...</a></div>
                                          </div>
                                        </div>


                                         <div class="col-lg-3 col-md-3 col-sm-6">
                                          <div class="tile tile-danger">
                                            <div class="tile-heading">People Online</div>
                                            <div class="tile-body"><i class="fa fa-users"></i>
                                              <h2 class="pull-right">0</h2>
                                            </div>
                                            <div class="tile-footer"><a href="">View more...</a></div>
                                          </div>
                                        </div>


                                          <div class="row">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                              <div class="panel panel-default">
                                             </div> 
                                           </div>
                                          </div>

            </div>
        </div>
    </div>
</div>

<!---------------------------------------- end  ------------------------------------------>


<?php }else { 
    header("Location: ./error.php");

}?>
<?php } ?>