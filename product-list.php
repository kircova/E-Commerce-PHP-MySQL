<!DOCTYPE html>



<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();
?>

<?php
  $search_err = '';

  if(isset($_GET['genres']))
  {
      $genres = $_GET['genres'];
      $query = "SELECT *FROM `product`WHERE genre = '$genres'";
      $search_result = filterTable($query, $db);
  }
  else if(isset($_GET["product_search"]))
  {
    $query = $_GET["product_search"];
    $sql_statement = "SELECT *
                            FROM product, songs
                            WHERE isVisible=1 AND
                          (product.pname LIKE '%$query%') OR (product.artist LIKE '%$query%')  OR (product.description LIKE '%$query%')  OR ( songs.songname LIKE '%$query%') AND product.prid = songs.prid
                          GROUP BY product.prid";
    $search_result = filterTable($sql_statement, $db);
  }
  else if(isset($_GET["lowtohigh"]))
  {
    $query = $_GET["lowtohigh"];
    $sql_statement = "SELECT * FROM `product`
                                    WHERE 1
                                    ORDER BY price";
    $search_result = filterTable($sql_statement, $db);
  }
  else if(isset($_GET["hightolow"]))
  {
    $query = $_GET["hightolow"];
    $sql_statement = "SELECT * FROM `product`
                                    WHERE 1
                                    ORDER BY price DESC";
    $search_result = filterTable($sql_statement, $db);
  }
  else if(isset($_GET["alphabetical"]))
  {
    $query = $_GET["alphabetical"];
    $sql_statement = "SELECT * FROM `product`
                                    WHERE 1
                                    ORDER BY pname";
    $search_result = filterTable($sql_statement, $db);
  }
  else if(isset($_GET["mostsale"]))
  {
    $query = $_GET["mostsale"];
    $sql_statement = "SELECT *
                          FROM product, order_table, orderdetails
                            WHERE product.prid = orderdetails.prid AND order_table.oid = orderdetails.oid
                              GROUP BY product.prid
                                  ORDER BY orderdetails.quantity DESC";
    $search_result = filterTable($sql_statement, $db);
  }
  else if(isset($_GET["0to100"]))
  {
    $query = $_GET["0to100"];
    $sql_statement = "SELECT *
                        FROM product
                        WHERE product.price >= 0 AND 100>= product.price";
    $search_result = filterTable($sql_statement, $db);
  }
  else if(isset($_GET["101to200"]))
  {
    $query = $_GET["101to200"];
    $sql_statement = "SELECT *
                        FROM product
                        WHERE product.price >= 101 AND 200>= product.price";
    $search_result = filterTable($sql_statement, $db);
  }
  else if(isset($_GET["201to300"]))
  {
    $query = $_GET["201to300"];
    $sql_statement = "SELECT *
                        FROM product
                        WHERE product.price >= 201 AND 300>= product.price";
    $search_result = filterTable($sql_statement, $db);
  }
  else if(isset($_GET["301to"]))
  {
    $query = $_GET["301to"];
    $sql_statement = "SELECT *
                        FROM product
                        WHERE product.price >= 301";
    $search_result = filterTable($sql_statement, $db);
  }
  else
  {
      $query = "SELECT *FROM `product` WHERE isVisible=1";
      $search_result = filterTable($query, $db);
  }


  function filterTable($query, $db)
  {
    $filter_result = mysqli_query($db,$query);
    return $filter_result;
  }

  $myarr=array();
  while($row = mysqli_fetch_array($search_result)) {
    array_push($myarr, $row);
  }
  $myarr = array_unique($myarr, SORT_REGULAR);

?>

<?php
  $sql_statement = "SELECT genre
                              FROM `product`
                              WHERE isVisible=1 ";
  $search_result = mysqli_query($db, $sql_statement);

  $genrecategory= array();

  while($rows = mysqli_fetch_array($search_result)) {
    array_push($genrecategory, $rows);
  }
    $genrecategory = array_unique($genrecategory, SORT_REGULAR);
    $row_number_genre=count($genrecategory);
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="img/icon.png">
        <title>The Sound Machine - Product List</title>
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

    <body>
        <?php include "top-bar.php";?>

        <?php include "nav-bar.php";?>

        <?php include "bottom-bar.php"?>

        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product-list.php">Products</a></li>
                    <li class="breadcrumb-item active">Product List</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Product List Start -->
        <div class="product-view">
            <div class="container-fluid">
                <div class="row">
                  <!-- Side Bar Start -->
                      <div class="col-lg-4 sidebar">
                          <div class="sidebar-widget category">
                              <h2 class="title">Genre</h2>
                              <nav class="navbar bg-light">
                                  <ul class="navbar-nav">
                                      <li class="nav-item">
                                        <?php
                                        for($a=0;$a<$row_number_genre - 1;$a++)
                                        {
                                          $genres = $genrecategory[$a]['genre'];

                                        ?>
                                        <a class="nav-link" href='product-list.php?genres=<?php echo $genres?>'> <i class="fa fa-music"></i><?php echo ucwords(strtolower($genres))?> </a>
                                        <?php
                                        }
                                        ?>
                                      </li>

                                  </ul>
                              </nav>
                          </div>



                      <div class="sidebar-widget brands">
                          <h2 class="title">Our Brands</h2>
                          <ul>
                              <li><a href="#">Nulla </a><span>(45)</span></li>
                              <li><a href="#">Curabitur </a><span>(34)</span></li>
                              <li><a href="#">Nunc </a><span>(67)</span></li>
                              <li><a href="#">Ullamcorper</a><span>(74)</span></li>
                              <li><a href="#">Fusce </a><span>(89)</span></li>
                              <li><a href="#">Sagittis</a><span>(28)</span></li>
                          </ul>
                      </div>
                  </div>
                  <!-- Side Bar End -->
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="product-view-top">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <form class="product-search" action="product-list.php" method="GET">
                                                <input type="text" placeholder="Search in Products" name="product_search">
                                                <button><i class="fa fa-search"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="product-short">
                                                <div class="dropdown">
                                                    <div class="dropdown-toggle" data-toggle="dropdown">Product sort by</div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href='product-list.php?lowtohigh' class="dropdown-item">Lowest Price</a>
                                                        <a href='product-list.php?hightolow' class="dropdown-item">Highest Price</a>
                                                        <a href='product-list.php?alphabetical' class="dropdown-item">Alphabetical</a>
                                                        <a href='product-list.php?mostsale' class="dropdown-item">Most sale</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="product-price-range">
                                                <div class="dropdown">
                                                    <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href='product-list.php?0to100'class="dropdown-item">0₺ to 100₺</a>
                                                        <a href='product-list.php?101to200' class="dropdown-item">101₺ to 200₺</a>
                                                        <a href='product-list.php?201to300' class="dropdown-item">201₺ to 300₺</a>
                                                        <a href='product-list.php?301to' class="dropdown-item">301₺ or higher</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php

                               if(count($myarr)==0)
                                  {
                                    ?>
                                        <div class="col-md-4">
                                          <span class="text"> No Products are found!</span>
                                        </div>
                                    <?php
                                  }
                              ?>

                              <?php

                              $row_number=count($myarr);

                              for($i=0;$i<$row_number;$i++)
                              {
                               $id = $myarr[$i]['prid'];
                               $name = $myarr[$i]['pname'];
                               $artist= $myarr[$i]['artist'];
                               $genre = $myarr[$i]['genre'];
                               $price = $myarr[$i]['price'];
                               $categoryId=$myarr[$i]['categoryId'];
                               $productImgUrl = $myarr[$i]['productImgUrl'];

                              ?>

                              <div class="col-md-4">

                                  <div class="product-item">
                                      <div class="product-title"  >
                                          <a href='product-detail.php?id=<?php echo $id?>'><?php echo $name?></a>
                                      </div>
                                      <div class="product-image">
                                          <a href="product-detail.php">
                                              <img src="<?php echo $productImgUrl ?>" alt="Product Image">
                                          </a>
                                          <div class="product-action">
                                              <a href="#"><i class="fa fa-cart-plus"></i></a>
                                          </div>
                                      </div>
                                      <div class="product-price">
                                          <h3><?php echo $price ?><span>₺</span></h3>
                                          <a class="btn" href="#"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                      </div>
                                  </div>
                              </div>
                            <?php
                             }
                             ?>


                        <!-- Pagination Start -->
                        <div class="col-md-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Pagination End -->
                    </div>
                  </div>


                </div>
            </div>
        </div>
        <!-- Product List End -->

        <!-- Brand Start -->
        <div class="brand">
            <div class="container-fluid">
                <div class="brand-slider">
                    <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
                </div>
            </div>
        </div>
        <!-- Brand End -->

        <!-- Footer Start -->
<div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Get in Touch</h2>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i>34 SU Store, Los Angeles, USA</p>
                                <p><i class="fa fa-envelope"></i>vinly@sabanciuniv.edu</p>
                                <p><i class="fa fa-phone"></i>+90-456-7890</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Follow Us</h2>
                            <div class="contact-info">
                            <div class="social">
                                <a href="https://twitter.com/sabanciu?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/sabanciuniv.edu/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.linkedin.com/school/sabanci-university/"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.instagram.com/sabanci_university/?hl=en"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.youtube.com/channel/UCr_JmMmZntUFfyCEGWVIorQ"><i class="fab fa-youtube"></i></a>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Company Info</h2>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Condition</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Purchase Info</h2>
                            <ul>
                                <li><a href="#">Pyament Policy</a></li>
                                <li><a href="#">Shipping Policy</a></li>
                                <li><a href="#">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row payment align-items-center">
                    <div class="col-md-6">
                        <div class="payment-method">
                            <h2>We Accept:</h2>
                            <img src="img/payment-method.png" alt="Payment Method" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-security">
                            <h2>Secured By:</h2>
                            <img src="img/godaddy.svg" alt="Payment Security" />
                            <img src="img/norton.svg" alt="Payment Security" />
                            <img src="img/ssl.svg" alt="Payment Security" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 copyright">
                        <p>Copyright &copy; <a href="https://htmlcodex.com">HTML Codex</a>. All Rights Reserved</p>
                    </div>

                    <div class="col-md-6 template-by">
                        <p>Template By <a href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->

        <!-- Back to Top -->
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
