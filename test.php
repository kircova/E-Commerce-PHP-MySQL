<?php
    require_once "config.php";
?>
<?php
echo "pi";
$id_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "req";
    if(isset($_GET['id'])) {
      echo $id;
    }
  }
?>
