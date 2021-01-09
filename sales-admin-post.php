<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();
?>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION['user_type'] == 2)
  {
  	if(isset($_POST['order-cancel']) && isset($_POST['oid']))
    {
         $orderid = $_POST['oid'];
         $sql_statement = "UPDATE order_table SET order_table.IsActive = 0
                          WHERE order_table.oid = '$orderid'";

        $result = mysqli_query($db, $sql_statement);
        if (mysqli_num_rows($result)==0)
        {
          header("location: sales-admin.php");
          exit;
        }
     }
  }
   if(isset($_POST['order-update']) && isset($_POST['oid']))
    {
       $oid = $_POST['oid'];
       $orderstatus = $_POST['orderstatus'];

       $sql_statement1 = "UPDATE order_table 
              SET order_table.orderStatus = '$orderstatus'
              WHERE order_table.oid = '$oid';";
        $resultx = mysqli_query($db, $sql_statement1);
    }

  header("location: sales-admin.php");
  exit;
}
?>