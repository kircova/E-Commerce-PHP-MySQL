<?php


require_once  "config.php";


// LOGIN

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['email'])) {
		$email = $_POST['email'];
		$pass = $_POST['password'];

		echo $email . " " . $pass;
	}
	else {
		echo "Login form is not set.";

	}
}

?>
