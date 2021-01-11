<!DOCTYPE html>


<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php

    $pid = $_SESSION['pid'];


    $sql1_statement = "SELECT *
                    FROM order_table o, orderdetails od, makes m, person p
                    WHERE o.oid = od.oid && o.isActive = 1 && m.oid = o.oid && m.pid = p.pid && p.pid = '$pid'
                    GROUP BY o.oid";
        $order_qu = mysqli_query($db, $sql1_statement);
        $order = array();

         while($productrows = mysqli_fetch_array($order_qu)) {
         array_push($order, $productrows);
    }
?>




<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="img/icon.png">
        <title>The Sound Machine - My Account</title>
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
                    <li class="breadcrumb-item active">My Account</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- My Account Start -->
        <div class="my-account">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab"><i class="fa fa-tachometer-alt"></i>Dashboard</a>
                            <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i class="fa fa-shopping-bag"></i>Orders</a>
                            <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i class="fa fa-user"></i>Account Details</a>
                            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
                                <h4>Dashboard</h4>
                                <p>
                                    Dear User, you can see your order and order details from Orders tab, you can see and update your account information from Account Details tab. Thank you for choosing our CS306 project.
                                </p>
                            </div>

                            <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Products Ordered</th>
                                                <th>Order Price</th>
                                                <th>Order Date</th>
                                                <th>Order Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              $row_number=count($order);
                                              for($i=0;$i<$row_number;$i++)
                                              {
                                                $oid = $order[$i]['oid'];

                                                $pid = $order[$i]['pid'];
                                                $name = $order[$i]['name'];
                                                $surname = $order[$i]['surname'];
                                                $email = $order[$i]['email'];
                                                $pass = $order[$i]['pass'];


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
                                            <tr>
                                                 <td>
                                                <?php echo $oid?>
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
                                                        <?php echo $orderdate?>
                                                    </td>
                                                    <td>
                                                            <?php echo $orderPrice?>
                                                            <span>₺</span>
                                                    </td>
                                                <td><?php echo $orderStatus?></td>
                                            </tr>
                                         <?php
                                         }
                                         ?>

                                          </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                                <h4>Account Details</h4>
                                  <form action="my-account-post.php" method = 'POST'>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name= 'name' value="<?php echo $name?>">
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name= 'surname' value="<?php echo $surname?>">
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name= 'email' value="<?php echo $email?>">
                                            </div>
                                            <div class="col-md-12">
                                                <input type='hidden' name='pid' value='<?php echo $pid?>'/>
                                                    <button class="btn" name= 'user-update'>Update Information</button>
                                                    <br><br>
                                            </div>
                                        </div>
                                    </form>
                                <h4>Password change</h4>
                                <form action="my-account-post.php" method = 'POST'>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" name= 'newpassword' value="<?php echo $pass?>">
                                        </div>
                                        <div class="col-md-12">
                                            <input type='hidden' name='pid' value='<?php echo $pid?>'/>
                                            <button class="btn" name= 'password-update'>Update Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Account End -->

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
