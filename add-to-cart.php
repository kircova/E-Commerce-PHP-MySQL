<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();
?>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST["buy-now"]))
  {
    $redirect_url = "checkout.php";
  }
  else
  {
    $redirect_url = "cart.php";
  }
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{

  if(isset($_POST["quantity"]) && isset($_POST["prid"]) && isset($_POST["price"]))
  {
    $quantity = $_POST["quantity"];
    $prid = $_POST["prid"];
    $price = $_POST["price"];

    $userid = $_SESSION["pid"];


    $sql_statement = "SELECT product.prid
                              FROM `cart`, `cartdetails`, `product`
                              WHERE '$userid' = cart.pid && cart.cid = cartdetails.cid && product.prid = cartdetails.prid && product.prid = '$prid'
                              GROUP BY cartdetails.prid";
    $result1 = mysqli_query($db, $sql_statement);
    // If the product is not in the cart
    if (mysqli_num_rows($result1)==0)
    {
      $sql_statement  = "INSERT INTO cartdetails
                                     (cid,
                                      prid,
                                      price,
                                      quantity
                                     )
                                     SELECT cart.cid, '$prid', '$price', '$quantity'
                                     FROM cart
                                     WHERE cart.pid = '$userid';";
      $result = mysqli_query($db, $sql_statement);
      if (mysqli_num_rows($result)==0)
      {
        header("location: $redirect_url");
        exit;
      }
    }

    // If the product is in the cart
    else
    {
      $sql_statement = "UPDATE cartdetails
                        SET quantity = quantity + '$quantity'
                        WHERE cartdetails.cid IN (SELECT cartdetails.cid
															                              FROM cart
                                                            WHERE cart.pid = '$userid' && cartdetails.prid = '$prid' && cart.cid = cartdetails.cid)";
      $result = mysqli_query($db, $sql_statement);
      if (mysqli_num_rows($result)==0)
      {
        header("location: $redirect_url");
        exit;
      }
    }
  }
  else
  {
    echo "At least one field is empty!";
  }
}
else
{
  if(!isset($_SESSION["cart"]))
  {
    $_SESSION["cart"] = array();
  }

  if(isset($_POST["quantity"]) && isset($_POST["prid"]) && isset($_POST["price"]))
  {
    $quantity = $_POST["quantity"];
    $prid = $_POST["prid"];
    $price = $_POST["price"];
    $guestcart = $_SESSION["cart"];
    $ind = -1;
    for($i=0; $i<count($guestcart); $i++)
    {
      if($guestcart[$i][0] == $prid)
      {
        $ind = $i;
      }
    }

    if($ind != -1)
    {
      $guestcart[$ind][2] = $guestcart[$ind][2] + $quantity;
    }
    else
    {
      $temp_arr = [$prid, $price, $quantity];
      array_push($guestcart, $temp_arr);
    }

    $_SESSION["cart"] = $guestcart;
    header("location: $redirect_url");
    exit;
  }

}
}
?>
