<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if (isset($_POST['submit_register'])) {
	// Process the signup form
	
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];

	$hashed_password = password_encrypt($password);
	
	$query  = "INSERT INTO tbl_users (";
	$query .= "  username, password, email, first_name, last_name";
	$query .= ") VALUES (";
	$query .= "  '{$username}', '{$hashed_password}', '{$email}', '{$fName}', '{$lName}'";
	$query .= ")";
	$result = mysqli_query($connection, $query);
	confirm_query($result);

	if ($result) {
		// Success
		$_SESSION["message"] = "User created.";
		redirect_to("index.php");
	} else {
		// Failure
		$_SESSION["message"] = "User creation failed.";
		$_SESSION["result"] = $result;
		redirect_to("index.php");
	}
}
?>