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

$name = $surname  = $email = $address = "";
$name_err = $surname_err  = $email_err = $address_err =  "";


   $cart_err = "";
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
  {
         $userid = $_SESSION["pid"];
          $sql_statement = "SELECT  cartdetails.price, cartdetails.quantity, cartdetails.prid
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
    $guestcart = $_SESSION["cart"];
    $usercart = array();
    for($i=0; $i<count($guestcart); $i++)
    {
      $temp_prid = $guestcart[$i][0];
      $sql_statement = "SELECT product.prid, product.productImgUrl,product.pname
                        FROM `product`
                        WHERE '$temp_prid' = product.prid";
      $search_result = mysqli_query($db, $sql_statement);
      $row = mysqli_fetch_array($search_result);
      $row["price"] = $guestcart[$i][1];
      $row["quantity"] = $guestcart[$i][2];
      array_push($usercart, $row);
    }
  }
  else
  {
     $cart_err = "Your cart is empty";
  }


  $sub_price = 0;

  if($cart_err == '')
  {
    $rowcount = count($usercart);
    $sub_price = 0;
    for($a=0;$a< $rowcount;$a++)
    {
      $sub_price += ($usercart[$a]['price'] * $usercart[$a]['quantity']);
    }
  }

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    if(isset($_POST["place-order-button"]))
    {
      // Name validation

      if(empty($_POST['namee'])) {
        $name_err = "Please enter a name.";
      }
      else {
        $name = test_input($_POST['namee']);
      }

      // Surname validation

      if(empty($_POST['surnamee'])) {
        $surname_err = "Please enter a surname.";
      }
      else {
        $surname = test_input($_POST['surnamee']);
      }

      // Mail validation

      if(empty($_POST['emaile'])) {
        $email_err = "Please enter an email.";
      }
      else {
        $email = test_input($_POST['emaile']);
      }

      // Address validation

      if(empty($_POST['addresse'])) {
        $address_err = "Please enter the address.";
      }
      else {
        $address = test_input($_POST['addresse']);
      }

      if(empty($name_err) && empty($surname_err) && empty($email_err) && empty($address_err))
      {
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
        {
          $pid = $_SESSION["pid"];

          // makes mysql_tablename
          $todays_date = date('Y-m-d');
          $pprice = $sub_price +1;
          $sql_statement = "INSERT INTO order_table( orderdate, shipAddress, orderPrice, name, surname, email) VALUES ( '$todays_date', '$address', '$pprice', '$name', '$surname', '$email')";
          mysqli_query($db, $sql_statement);
          $oid = mysqli_insert_id($db);


          $sql_statement = "INSERT INTO makes VALUES ('$oid','$pid')";
          mysqli_query($db, $sql_statement);

          $rowcount = count($usercart);
          for($a=0;$a< $rowcount;$a++)
          {
            $product_price = $usercart[$a]['price'];
            $product_prid = $usercart[$a]['prid'];
            $product_quantity = $usercart[$a]['quantity'];
            $pid = $_SESSION["pid"];
            $sql_statement = "INSERT INTO orderdetails VALUES ('$oid','$product_prid', '$product_price', '$product_quantity')";
            mysqli_query($db, $sql_statement);

            $sql_statement = "DELETE FROM cartdetails
      			                              WHERE prid = '$product_prid' && cid IN 	(SELECT cart.cid
                                                                           FROM cart
                                                                           WHERE pid = '$pid');";
            mysqli_query($db, $sql_statement);
          }

          header("location: index.php");
          exit;
        }
        else
        {

          $todays_date = date('Y-m-d');
          $pprice = $sub_price +1;
          $sql_statement = "INSERT INTO order_table( orderdate, shipAddress, orderPrice, name, surname, email) VALUES ( '$todays_date', '$address', '$pprice', '$name', '$surname', '$email')";
          mysqli_query($db, $sql_statement);
          $oid = mysqli_insert_id($db);
          $rowcount = count($usercart);
          for($a=0;$a< $rowcount;$a++)
          {
            $product_price = $usercart[$a]['price'];
            $product_prid = $usercart[$a]['prid'];
            $product_quantity = $usercart[$a]['quantity'];
            $sql_statement = "INSERT INTO orderdetails VALUES ('$oid','$product_prid', '$product_price', '$product_quantity')";
            mysqli_query($db, $sql_statement);
          }

          $_SESSION["cart"] = [];
          header("location: index.php");
          exit;
        }
      }
    }
  }

?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="img/icon.png">
        <title>The Sound Machine - Checkout</title>
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
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Checkout Start -->
        <div class="checkout">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-inner">
                            <div class="billing-address">
                                <h2>Billing Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>" type="text" name="name" placeholder="First Name" value="<?php echo $name;?>">
                                        <span class="help-block"><?php echo $name_err; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name</label>
                                        <input class="form-control <?php echo (!empty($surname_err)) ? 'has-error' : ''; ?>" type="text" name="surname" placeholder="Last Name" value="<?php echo $surname;?>">
                                        <span class="help-block"><?php echo $surname_err; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>" type="text" name="email" placeholder="E-mail" value="<?php echo $email;?>">
                                        <span class="help-block"><?php echo $email_err; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input class="form-control <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>" type="text" name="address" placeholder="Address" value="<?php echo $address;?>">
                                        <span class="help-block"><?php echo $address_err; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout-inner">
                            <div class="checkout-summary">
                                <h1>Cart Total</h1>
                                <p class="sub-total">Sub Total<span><?php echo ($sub_price > 0 ? number_format((float)$sub_price, 2, '.', '') : 0)?><span>₺</span></span></p>
                                <p class="ship-cost">Shipping Cost<span><?php echo ($sub_price > 0 ? number_format((float)1, 2, '.', '') : 0 )?> <span>₺</span></span></p>
                                <?php $grand_total = $sub_price + 1 ?>
                                <h2>Grand Total<span><?php echo ($sub_price > 0 ?  number_format((float)$grand_total, 2, '.', '') : 0)?> <span>₺</span></span></h2>
                            </div>

                            <div class="checkout-payment">
                                <div class="payment-methods">
                                    <h1>Payment Methods</h1>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-1" name="payment">
                                            <label class="custom-control-label" for="payment-1">Paypal</label>
                                        </div>
                                        <div class="payment-content" id="payment-1-show">
                                            <p>
                                                Pay via Paypal
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-2" name="payment">
                                            <label class="custom-control-label" for="payment-2">Direct Bank Transfer</label>
                                        </div>
                                        <div class="payment-content" id="payment-2-show">
                                            <p>
                                                Pay via Direct Bank Transfer
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-3" name="payment" checked>
                                            <label class="custom-control-label" for="payment-3">Cash on Delivery</label>
                                        </div>
                                        <div class="payment-content" id="payment-3-show">
                                            <p>
                                                Pay when it is delivered.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout-btn">
                                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <script>
                                    function buldum() {
                                        document.getElementById('namelala').setAttribute('value', document.getElementsByName('name')[0].value);
                                        document.getElementById('surnamelala').setAttribute('value', document.getElementsByName('surname')[0].value);
                                        document.getElementById('emaillala').setAttribute('value', document.getElementsByName('email')[0].value);
                                        document.getElementById('addresslala').setAttribute('value', document.getElementsByName('address')[0].value);
                                      }
                                    </script>
                                    <input type='hidden' id="namelala" name='namee'  />
                                    <input type='hidden' id="surnamelala" name='surnamee' />
                                    <input type='hidden' id="emaillala" name='emaile' />
                                    <input type='hidden' id="addresslala" name='addresse' />

                                    <button class="btn" name="place-order-button" onclick="buldum()" <?php if($sub_price <= 0) {echo "disabled";}?>> <?php if($sub_price <= 0) {echo "Cart is empty";} else {echo "Place Order";} ?></button>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout End -->

      <?php include "footer.php";?>

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
