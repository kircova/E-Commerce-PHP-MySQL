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
       $pname = $_POST['pname'];
       $artist = $_POST['partist'];
       $genre = $_POST['pgenre'];
       $price = $_POST['pprice'];
       $stock = $_POST['pstock'];

       $sql_statement = "UPDATE product 
              SET product.pname = '$pname', product.artist = '$artist', product.genre = '$genre', product.price = '$price', product.stock = '$stock'
              WHERE product.prid = '$product_id';";

        $result = mysqli_query($db, $sql_statement);

        
    }
  }
  header("location: product-admin.php");
  exit;
}
?>
