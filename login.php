<?php require_once("includes/session.php");
  require_once("includes/db_connection.php");
  require_once("includes/functions.php");

$username = "";

//Handles Log In from modal window
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
      $_SESSION["user_id"] = $found_user["user_id"];
      $_SESSION["username"] = $found_user["username"];
      $_SESSION["email"] = $found_user["email"];
      $_SESSION["fName"] = $found_user["first_name"];
      $_SESSION["lName"] = $found_user["last_name"];
      $_SESSION["user_type_id"] = $found_user["user_type_id"];
      $_SESSION["address1"] = $found_user["address1"];
      $_SESSION["address2"] = $found_user["address2"];
      $_SESSION["city"] = $found_user["city"];
      $_SESSION["state"] = $found_user["state"];
      $_SESSION["zip"] = $found_user["zip"];
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  }
} // end: if (isset($_POST['submit']))

//Handles Log In from login_form.php
if (isset($_POST['submit_login_cart'])) {
  // Process the form
  
  if (empty($errors)) {
    // Attempt Login

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $found_user = attempt_login($username, $password);

    if ($found_user) {
      // Success
      // Mark user as logged in
      $_SESSION["user_id"] = $found_user["user_id"];
      $_SESSION["username"] = $found_user["username"];
      $_SESSION["email"] = $found_user["email"];
      $_SESSION["fName"] = $found_user["first_name"];
      $_SESSION["lName"] = $found_user["last_name"];
      $_SESSION["user_type_id"] = $found_user["user_type_id"];
      $_SESSION["address1"] = $found_user["address1"];
      $_SESSION["address2"] = $found_user["address2"];
      $_SESSION["city"] = $found_user["city"];
      $_SESSION["state"] = $found_user["state"];
      $_SESSION["zip"] = $found_user["zip"];
      redirect_to('cart.php');
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  }
} // end: if (isset($_POST['submit_login']))

//Handles Log In from admin/index.php login form 
if (isset($_POST['submit_login_admin'])) {
  // Process the form
  
  if (empty($errors)) {
    // Attempt Login

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $found_user = attempt_admin_login($username, $password);

    if ($found_user) {
      // Success
      // Mark user as logged in
      $_SESSION["username"] = $found_user["username"];
      $_SESSION["fName"] = $found_user["first_name"];
      $_SESSION["lName"] = $found_user["last_name"];
      $_SESSION["user_type_id"] = $found_user["user_type_id"];
      redirect_to('orders.php');
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  }
} // end: if (isset($_POST['submit']))
?>