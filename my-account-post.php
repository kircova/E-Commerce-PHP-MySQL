<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();
?>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION['user_type'] == 0)
  {
  	if(isset($_POST['user-update']) && isset($_POST['pid']))
    {

    	$pid = $_POST['pid'];
    	$name = $_POST['name'];
       	$surname = $_POST['surname'];
       	$email = $_POST['email'];


		$sql_statement = "UPDATE person 
              SET person.name = '$name', person.surname = '$surname', person.email = '$email'
              WHERE person.pid = '$pid';";

        $result = mysqli_query($db, $sql_statement);
     }
     if(isset($_POST['password-update']) && isset($_POST['pid']))
     {
    	$pid = $_POST['pid'];
    	$pass = $_POST['newpassword'];


		$sql_statementx = "UPDATE person 
              SET person.pass = '$pass'
              WHERE person.pid = '$pid';";

        $resultx = mysqli_query($db, $sql_statementx);
     }
  }
  header("location: my-account.php");
  exit;
}
?>