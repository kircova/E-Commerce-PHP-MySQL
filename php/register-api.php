<?php

require_once "config.php";

// REGISTER

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $surname  = $email = $password = $confirm_password = "";
  $name_err = $surname_err  = $email_err = $password_err = $confirm_password_err = "";

  // Name validation

  if(empty($_POST['name'])) {
    $name_err = "Please enter a name.";
  }
  else {
    $name = test_input($_POST['name'])
  }

  // Surname validation

  if(empty($_POST['surname'])) {
    $surname_err = "Please enter a surname.";
  }
  else {
    $surname = test_input($_POST['surname']);
  }

  // Password Validation

  if(empty($_POST["password"])){
      $password_err = "Please enter a password.";
  } elseif(strlen(test_input($_POST["password"])) < 6){
      $password_err = "Password must have atleast 6 characters.";
  } else{
      $password = test_input($_POST["password"]);
  }

  if(empty($_POST["password2"])){
      $confirm_password_err = "Please confirm password.";
  } else{
      $confirm_password = test_input($_POST["password2"]);
      if(empty($password_err) && ($password != $confirm_password)){
          $confirm_password_err = "Password did not match.";
      }
  }

  // E-mail Validation

  if(empty($_POST["email"])) {
    $email_err = "Please enter an e-mail.";
  }
  else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "Invalid email format";
    }
  }

  if(empty($name_err) && empty($surname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){

    $sql_statement = "INSERT INTO person(name, surname, email, pass) VALUES (?, ?, ?, ?)";

    if($stmt = mysqli_prepare($db, $sql_statement)){
      // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_surname, $param_email, $param_password);

            // I did this so if we need to edit the data we can interfere these variables.
            $param_name = $name;
            $param_surname = $surname;
            $param_email = $email;
            $param_password = $password; // raw form

            if(mysqli_stmt_execute($stmt)){
               // Redirect to login page
               header("location: index.php");
            } else{
               echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);

    }

    mysqli_close($db);
  }


  /*if(isset($_POST['email'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
  	$email = $_POST['email'];
    $number = $_POST['phone_number'];
  	$pass = $_POST['password'];
    $pass2 = $_POST['password2'];




    $result = mysqli_query($db, $sql_statement);
    header("Location: index.php");
    die();
    //if ( false===$result ) {
    //  printf("error: %s\n", mysqli_error($db));
  //  }
    //echo "Result: " . $result;

  	//echo $name . " " . $surname . " " . $email . " " . $number . " " . $pass;
  }
  else {
  	echo "Login form is not set.";
  }
  */
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
