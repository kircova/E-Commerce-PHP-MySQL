<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION['user_type'] == 1)
  {
    if(isset($_POST['product-delete']) && isset($_POST['id']))
    {
         $product_id = $_POST['id'];
         $sql_statement = "UPDATE product SET product.IsVisible = 0
                          WHERE product.prid = '$product_id'";

        $result = mysqli_query($db, $sql_statement);
        if (mysqli_num_rows($result)==0)
        {
          header("location: product-admin.php");
          exit;
        }
    }
    if(isset($_POST['product-update']) && isset($_POST['pid']))
    {
       $product_id = $_POST['pid'];
       $pname = mysql_escape_string($_POST['pname']);
       $artist = mysql_escape_string($_POST['partist']);
       $genre = mysql_escape_string($_POST['pgenre']);
       $description = mysql_escape_string($_POST['pdescription']);
       $price = $_POST['pprice'];
       $stock = $_POST['pstock'];
       $productimg = $_POST['productimg'];

       $sql_statement = "UPDATE product
              SET product.pname = '$pname', product.artist = '$artist', product.genre = '$genre', product.description = '$description', product.price = '$price', product.stock = '$stock',product.productImgUrl = '$productimg'
              WHERE product.prid = '$product_id';";

        $result = mysqli_query($db, $sql_statement);
    }
    if(isset($_POST['product-add']) && isset($_POST['ppname']) && isset($_POST['ppartist']))
    {
       $spname = $_POST['ppname'];
       $sartist = $_POST['ppartist'];
       $sgenre = $_POST['ppgenre'];
       $sdescription = $_POST['ppdescription'];
       $sprice = $_POST['ppprice'];
       $sstock = $_POST['ppstock'];
       $sproductimg = $_POST['pproductimg'];

       $sql_statement1 = "INSERT INTO product
                  (product.pname, product.artist, product.genre, product.description, product.price, product.categoryId, product.productImgUrl, product.stock, product.IsVisible)
                         VALUES
                  ('$spname', '$sartist', '$sgenre','$sdescription', '$sprice', 0, '$sproductimg', '$sstock', 1);";

        $result1 = mysqli_query($db, $sql_statement1);
    }

  }
  header("location: product-admin.php");
  exit;
}
?>
