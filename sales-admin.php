<!DOCTYPE html>

<?php
    require_once  "config.php";
?>

<?php

	session_start();
?>


<?php

  $sql_statement = "SELECT *
					FROM order_table o, orderdetails od, makes m, person p
					WHERE o.oid = od.oid && o.isActive = 1 && m.oid = o.oid && m.pid = p.pid
					GROUP BY o.oid";
  $order_sql = mysqli_query($db, $sql_statement);
  $order = array();

  while($rows = mysqli_fetch_array($order_sql)) {
    array_push($order, $rows);
  }
?>




<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="img/icon.png">
        <title>The Sound Machine - Welcome</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="eCommerce HTML Template Free Download" name="keywords">
        <meta content="eCommerce HTML Template Free Download" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>
  <!--#region main  -->
    <body>
        <?php include "top-bar.php";?>

		        <div class="nav">
		    <div class="container-fluid">
		        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
		            <a href="#" class="navbar-brand">MENU</a>
		            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		                <span class="navbar-toggler-icon"></span>
		            </button>

		            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
		                <div class="navbar-nav mr-auto">
		                    <a class="nav-item nav-link">Sales Admin</a>
		                    <a href="logout.php" class="nav-item nav-link">Log out</a>
		                    <div class="nav-item dropdown">
		                    </div>
		                </div>
		                <div class="navbar-nav ml-auto">
		                    <div class="nav-item dropdown">
		                        <?php
		                            // Check if the user is logged in, if not then redirect him to login page
		                              if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
		                              {
		                                ?>
		                                <a class="nav-item nav-link"> Welcome back, <?php echo $_SESSION["name"]?>!</a>
		                                <?php
		                              }
		                              else
		                              {
		                                ?>
		                                <a href="login.php" class="nav-item nav-link">Login & Register</a>
		                                <?php
		                              }
		                            ?>
		                    </div>
		                </div>
		            </div>
		        </nav>
		    </div>
		</div>

			<!-- Bottom Bar Start -->
		<div class="bottom-bar">
		    <div class="container-fluid">
		        <div class="row align-items-center">
		            <div class="col-md-3">
		                <div class="logo">
		                    <a>
		                        <img src="img/logo - Copy.png" alt="Logo">
		                    </a>
		                </div>
		            </div> 
		        </div>
		    </div>
		</div>



		        <div class="wishlist-page">
            <div class="container-fluid">
                <div class="wishlist-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                        	<th>Order ID</th>
                                        	<th>Customer Details </th>
                                            <th>Products Ordered</P>
                                            <th>Order Price</th>
                                            <th>Order Date</th>
                                            <th>Order Status</th>
                                            <th>Cancel Order</th>
                                        </tr>
                                    </thead>
                                     <?php
			                              $row_number=count($order);
			                              for($i=0;$i<$row_number;$i++)
			                              {
			                              	$oid = $order[$i]['oid'];

			                              	$pid = $order[$i]['pid'];
			                              	$name = $order[$i]['name'];
			                              	$surname = $order[$i]['surname'];
			                              	$email = $order[$i]['email'];

			                              	$orderdate = $order[$i]['orderdate'];
			                              	$orderPrice = $order[$i]['orderPrice'];
			                              	$orderStatus = $order[$i]['orderStatus'];
			                              	$price = $order[$i]['price'];

			                              	  $sql1_statement = "SELECT product.pname
															FROM order_table o, orderdetails od, product
															WHERE o.oid = od.oid && od.prid = product.prid && o.oid = '$oid'";
												  $product_order = mysqli_query($db, $sql1_statement);
												  $product = array();

												  while($productrows = mysqli_fetch_array($product_order)) {
												    array_push($product, $productrows);
												  }

			                              ?>

                                    <tbody class="align-middle">
                                        <tr>
                                        	<form action="sales-admin-post.php" method = 'POST'>
                                            <td>
                                            	<?php echo $oid?>
                                            </td>
                                            <td>
                                            	<?php echo $name?>
                                            	<?php echo $surname?>
                                            	<?php echo $email?>
                                            </td>
                                            <td>
                                            	<?php
					                              $productrownum=count($product);
					                              for($j=0;$j<$productrownum;$j++)
						                              {
						                              	echo $j + 1 ;
						                              	echo ' - ' ;
						                              	echo $product[$j]['pname'];
						                              	echo "<br>\n";
						                              }
					                              ?>
                                            </td>
                                            <td>
                                            	<?php echo $orderPrice?>
                                            	<span>₺</span>
                                            </td>
                                            <td>
                                            	<?php echo $orderdate?>
                                            </td>
                                            <td>
                                            	<input type="text" name= 'orderstatus' value="<?php echo $orderStatus?>">
                                            		 <input type='hidden' name='oid' value='<?php echo $oid?>'/>
                                            		 <button cls='btn' name= 'order-update'>
	                                            		<i class="fa fa-chevron-up"></i>
	                                            	</button>
	                                        <td>
	                                            	<input type='hidden' name='oid' value='<?php echo $oid?>'/>
	                                            	<button cls='btn' name= 'order-cancel'>
	                                            		<i class="fa fa-trash"></i>
	                                            	</button>
	                                        </td>
                                           </form>
                                       </tr>
                                   </tbody>
                             <?php
                             }
                             ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>













		<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>