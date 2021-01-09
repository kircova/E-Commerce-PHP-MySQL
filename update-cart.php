<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();
?>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  // If user
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
  {
    if(isset($_POST["prid"]))
    {
      $prid =   $_POST["prid"];
      $userid = $_SESSION["pid"];
      if(isset($_POST["increment-button"]))
      {
        $quantity = 1;
        $sql_statement = "UPDATE cartdetails
                          SET quantity = quantity + '$quantity'
                          WHERE cartdetails.cid IN (SELECT cartdetails.cid
  															                              FROM cart
                                                              WHERE cart.pid = '$userid' && cartdetails.prid = '$prid' && cart.cid = cartdetails.cid)";
        $result = mysqli_query($db, $sql_statement);
        if (mysqli_num_rows($result)==0)
        {
          header("location: cart.php");
          exit;
        }
      }

      elseif(isset($_POST["decrement-button"]))
      {
        $quantity = -1;
        $sql_statement = "UPDATE cartdetails
                          SET quantity = quantity + '$quantity'
                          WHERE cartdetails.cid IN (SELECT cartdetails.cid
  															                              FROM cart
                                                              WHERE cart.pid = '$userid' && cartdetails.prid = '$prid' && cart.cid = cartdetails.cid)";
        $result = mysqli_query($db, $sql_statement);
        if (mysqli_num_rows($result)==0)
        {
          header("location: cart.php");
          exit;
        }
      }

      else
      {
        echo "no button";
      }

    }
    else
    {
      echo "no prid";
    }
  }

  // If guest
  else
  {
    echo "Guest";
  }

}
