<!DOCTYPE html>

<?php
    require_once  "config.php";
?>

<?php

	session_start();
?>





<?php

  $sql_statement = "SELECT *
                              FROM product
                              WHERE product.IsVisible = 1";
  $search_result = mysqli_query($db, $sql_statement);

  $product = array();

  while($rows = mysqli_fetch_array($search_result)) {
    array_push($product, $rows);
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
		                    <a class="nav-item nav-link">Product Admin</a>
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
 <!--#endregion -->

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
		<!-- Bottom Bar End -->


        <div class="wishlist-page">
            <div class="container-fluid">
                <div class="wishlist-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                        	<th>ProductID</th>
                                            <th>Product</th>
                                            <th>Artist</th>
                                            <th>Genre</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Remove</th>
                                            <th>Update Product</th>
                                        </tr>
                                    </thead>
                                     <?php

			                              $row_number=count($product);

			                              for($i=0;$i<$row_number;$i++)
			                              {
			                               $id = $product[$i]['prid'];
			                               $name = $product[$i]['pname'];
			                               $artist= $product[$i]['artist'];
			                               $genre = $product[$i]['genre'];
			                               $price = $product[$i]['price'];
			                               $stock= $product[$i]['stock'];
			                               $productImgUrl = $product[$i]['productImgUrl'];
			                              ?>



                                    <tbody class="align-middle">
                                        <tr>
                                        	<form action="product-admin-post.php" method = 'POST'>
                                            <td>
                                            	<?php echo $id?>
                                            </td>
                                            <td>
                                            	<div class="img">
                                                    <a href="#"><img src="<?php echo $productImgUrl ?>" alt="Image"></a>
	                                                    <input type="text" name = 'pname' value="<?php echo $name?>">	
                                                </div>
                                            </td>
                                            <td>
                                            	<input type="text" name= 'partist' value="<?php echo $artist?>">
                                            </td>
                                            <td>
                                            	<input type="text" name= 'pgenre' value="<?php echo $genre?>">
                                            <td>
                                            	  <div class="qty">
                                                    <input type="text" name = 'pprice' value="<?php echo $price?>">
                                                </div>
                                                 <span>₺</span>
                                            </td>
                                            <td>
                                            	 <div class="qty">
                                                    <input type="text" name='pstock' value="<?php echo $stock?>">
                                                </div>
                                            </td>
	                                            <td>
	                                            	<input type='hidden' name='id' value='<?php echo $id?>'/>
	                                            	<button cls='btn' name= 'product-delete'>
	                                            		<i class="fa fa-trash"></i>
	                                            	</button>
	                                        </td>
                                            <td>
		                                           <input type='hidden' name='pid' value='<?php echo $id?>'/>
	                                               <button cls='btn' name= 'product-update'>
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