<!DOCTYPE html>


<?php
    require_once "config.php";
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
// Check if the user is logged in, if not then redirect him to login page
   $cart_err = "";
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
  {
         $userid = $_SESSION["pid"];
          $sql_statement = "SELECT product.prid, product.productImgUrl,product.pname, cartdetails.price, cartdetails.quantity
                                    FROM `cart`, `cartdetails`, `product`
                                    WHERE '$userid' = cart.pid && cart.cid = cartdetails.cid && product.prid = cartdetails.prid
                                    GROUP BY cartdetails.prid";
          $search_result = mysqli_query($db, $sql_statement);

          $usercart= array();
          while($rows = mysqli_fetch_array($search_result)) {
            array_push($usercart, $rows);
          }

            if(count($usercart) == 0)
            {
                $cart_err = "Your cart is empty";
            }
  }
  else if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) != 0)
  {

  }
  else
  {
     $cart_err = "Your cart is empty";
  }
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>E Store - eCommerce HTML Template</title>
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
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Cart Start -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                    <?php
                                    $sub_price = 0;
                                    if($cart_err == '')
                                    {


                                        ?>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>

                                    <tbody class="align-middle">
                                        <?php
                                                $rowcount = count($usercart);
                                                for($a=0;$a< $rowcount;$a++)
                                                {
                                                  $productname = $usercart[$a]['pname'];
                                                  $price = $usercart[$a]['price'];
                                                  $productimg = $usercart[$a]['productImgUrl'];
                                                  $quantity = $usercart[$a]['quantity'];
                                                  $prid = $usercart[$a]['prid'];
                                                  ?>
                                                    <tr>
                                                        <td>
                                                            <div class="img">
                                                                <a href='product-detail.php?id=<?php echo $prid?>'><img src="<?php echo $productimg?>" alt="Image"></a>
                                                                <a href='product-detail.php?id=<?php echo $prid?>' ><?php echo $productname?></a>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $price?><span>₺</span></td>
                                                        <td>
                                                            <div class="qty">
                                                                <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                                <input type="text" value= <?php echo $quantity?>>
                                                                <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </td>
                                                        <td><?php $sub_price+=($quantity * $price);echo  number_format((float)($quantity * $price), 2, '.', '') ?><span>₺</span></td>
                                                        <td><button><i class="fa fa-trash"></i></button></td>
                                                    </tr>
                                                  <?php
                                                }
                                            }
                                            else
                                            {
                                                 ?>  <span class = "help-block">  Your cart is empty </span> <?php
                                            }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <div class="cart-content">

                                            <h1>Cart Summary</h1>
                                            <p>Sub Total<span><?php echo ($sub_price > 0 ? number_format((float)$sub_price, 2, '.', '') : 0)?><span>₺</span></span></p>
                                            <p>Shipping Cost<span> <?php echo ($sub_price > 0 ? number_format((float)1, 2, '.', '') : 0 )?> <span>₺</span></span> </p>
                                            <?php $grand_total = $sub_price + 1 ?>
                                            <h2>Grand Total<span> <?php echo ($sub_price > 0 ?  number_format((float)$grand_total, 2, '.', '') : 0)?> <span>₺</span> </span></h2>
                                        </div>
                                        <div class="cart-btn">
                                            <button>Update Cart</button>
                                            <button>Checkout</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->

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
