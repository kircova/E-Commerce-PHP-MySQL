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
    if(isset($_POST["delete-button"]) && isset($_POST["prid"]))
    {
      $prid = $_POST["prid"];
      $pid =   $_SESSION["pid"];
      $sql_statement = "DELETE FROM cartdetails
			                              WHERE prid = '$prid' && cid IN 	(SELECT cart.cid
                                                                     FROM cart
                                                                     WHERE pid = '$pid');";
      $result = mysqli_query($db, $sql_statement);
      if (mysqli_num_rows($result)==0)
      {
        header("location: cart.php");
        exit;
      }
    }
  }

  // If guest
  else
  {

  }
}

?>
