<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
$username = "";

if (isset($_POST['submit_login'])) {
  // Process the form
  
  if (empty($errors)) {
    // Attempt Login

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $found_user = attempt_login($username, $password);

    if ($found_user) {
      // Success
      // Mark user as logged in
      $_SESSION["username"] = $found_user["username"];
      redirect_to("index.php");
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  }
} // end: if (isset($_POST['submit']))

?>