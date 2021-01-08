<!DOCTYPE html>


<?php
    require_once  "config.php";
?>

<?php
// Initialize the session
session_start();
?>

<?php

      function filterTable($query, $db)
      {
        $filter_result = mysqli_query($db,$query);
        return $filter_result;
      }

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

<?php

  $sql_statement = "SELECT *
                    FROM `product`
                    WHERE isVisible=1 AND (prid = 11 OR prid = 16 OR prid = 14 OR prid = 13 OR prid =15 OR prid = 12)";
  $search_result = mysqli_query($db, $sql_statement);

  $image_url_arr = array();

  while($rows = mysqli_fetch_array($search_result)) {
    array_push($image_url_arr, $rows);
  }
    $image_url_arr = array_unique($image_url_arr, SORT_REGULAR);
    $row_number_image=count($image_url_arr);
?>

<?php
  $sql_statement = "SELECT *
                        FROM product, order_table, orderdetails
                        WHERE product.prid = orderdetails.prid AND orderdetails.oid = order_table.oid
                        GROUP BY product.prid
                        HAVING COUNT(*)>1";

  $search_result = mysqli_query($db, $sql_statement);
  $featured_array = array();

  while($rows = mysqli_fetch_array($search_result)) {
    array_push($featured_array, $rows);
  }
    $featured_array = array_unique($featured_array, SORT_REGULAR);
    $featuredarray=count($featured_array);
?>


<?php
  $sql_statement = "SELECT * FROM person, customer WHERE person.pid = customer.pid AND (person.pid = 31 OR person.pid = 33 OR person.pid = 34 OR person.pid = 35 OR person.pid = 36)";

  $search_result = mysqli_query($db, $sql_statement);
  $customer_array = array();

  while($rows = mysqli_fetch_array($search_result)) {
    array_push($customer_array, $rows);
  }
    $customer_array = array_unique($customer_array, SORT_REGULAR);
    $customerarray= count($customer_array);
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

    <body>
        <?php include "top-bar.php";?>

        <?php include "nav-bar.php";?>

        <?php include "bottom-bar.php"?>

        <!-- Main Slider Start -->
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <nav class="navbar bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="product-list.php"><i class="fa fa-shopping-cart"></i>All Products</a>
                                </li>
                                <?php
                                    for($a=0;$a<$row_number_genre - 1;$a++)
                                    {
                                        $genres = $genrecategory[$a]['genre'];

                                    ?>
                                <li class="nav-item">
                                    <a class="nav-link" href='product-list.php?genres=<?php echo $genres?>'> <i class="fa fa-music"></i><?php echo ucwords(strtolower($genres)) ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-6">
                        <div class="header-slider normal-slider">

                            <?php
                                for($j=0;$j<$row_number_image;$j++)
                                {
                                    $productImgUrl = $image_url_arr[$j]['productImgUrl'];
                            ?>
                                <div class="header-slider-item">
                                    <div class = "header-image">
                                        <img src="<?php echo $productImgUrl ?>" alt="Product Image">
                                    </div>
                                    <div class="header-slider-caption">
                                        <p>Music from everyone for everyone</p>
                                        <a class="btn" href="product-list.php"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="header-img">
                            <div class="img-item">
                                <?php
                                    $productImgUrl = $image_url_arr[5]['productImgUrl'];
                                    $id = $image_url_arr[5]['prid'];
                                    $name = $image_url_arr[5]['pname'];
                                                    ?>
                                <img src="<?php echo $productImgUrl?>" alt="Product Image">
                                <a class="img-text" href='product-detail.php?id=<?php echo $id?>'>>
                                    <p><?php echo $name?></p>
                                </a>
                            </div>
                            <?php
                            $productImgUrl = $image_url_arr[4]['productImgUrl'];
                            $id= $image_url_arr[4]['prid'];
                            $name = $image_url_arr[4]['pname'];
                            ?>
                            <div class="img-item">
                                <img src="<?php echo $productImgUrl ?>" alt="Product Image">
                                <a class="img-text" href='product-detail.php?id=<?php echo $id?>'>>
                                    <p><?php echo $name?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Slider End -->

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

        <!-- Feature Start-->
        <div class="feature">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fab fa-cc-mastercard"></i>
                            <h2>Secure Payment</h2>
                            <p>
                                Prof. Albert Levi taught us everything we know
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-truck"></i>
                            <h2>Worldwide Delivery</h2>
                            <p>
                                Including Sabanci University
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-sync-alt"></i>
                            <h2>90 Days Return</h2>
                            <p>
                                Please don't return your products, it is expensive
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-comments"></i>
                            <h2>24/7 Support</h2>
                            <p>
                                Always available
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End-->

        <!-- Call to Action Start -->
        <div class="call-to-action">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1>call us for any queries</h1>
                    </div>
                    <div class="col-md-6">
                        <a href="tel:">+(216) 483 90 00</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->
        <!-- Featured Product Start -->
        <div class="featured-product product">
            <div class="container-fluid">
                <div class="section-header">
                    <h1>Featured Product</h1>
                </div>
                <div class="row align-items-center product-slider product-slider-4">
                        <?php
                            $row_number=count($featured_array);

                            for($i=0;$i<$row_number;$i++)
                              {
                               $id = $featured_array[$i]['prid'];
                               $name = $featured_array[$i]['pname'];
                               $artist= $featured_array[$i]['artist'];
                               $genre = $featured_array[$i]['genre'];
                               $price = $featured_array[$i]['price'];
                               $categoryId=$featured_array[$i]['categoryId'];
                               $productImgUrl = $featured_array[$i]['productImgUrl'];
                              ?>
                                                  <div class="col-lg-3">
                                <div class="product-item">
                                    <div class="product-title">
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
                                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Review Start -->
        <div class="review">
            <div class="container-fluid">
                <div class="row align-items-center review-slider normal-slider">
                    <?php
                        $row_number=count($customer_array);

                        for($i=0;$i<$row_number;$i++)
                              {
                               $name = $customer_array[$i]['name'];
                               $surname = $customer_array[$i]['surname'];
                               $personImgUrl= $customer_array[$i]['personImgUrl'];
                               $review = $customer_array[$i]['Review'];
                    ?>
                        <div class="col-md-6">
                            <div class="review-slider-item">
                                <div class="review-img">
                                    <img src="<?php echo $personImgUrl ?>" alt="Customer Image">
                                </div>
                                <div class="review-text">
                                    <h2><?php echo $name?> <?php echo $surname?> </h2>
                                    <h3>Student</h3>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p>
                                        <?php echo $review?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Review End -->

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
