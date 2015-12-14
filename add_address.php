<?php require_once("includes/session.php");
 	require_once("includes/db_connection.php");
 	require_once("includes/functions.php");

if (isset($_POST['submit_address'])) {
	// Process the address form
	//Retrieve POST data and store in variables
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];
	$address = $_POST["address"];
	$address2 = $_POST["address2"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	//Update query to store user address in the database
	$query  = "UPDATE tbl_users ";
	$query .= "SET address1='{$address}', ";
	$query .= "address2='{$address2}', ";
	$query .= "city='{$city}', ";
	$query .= "state='{$state}', ";
	$query .= "zip='{$zip}' ";
	$query .= "WHERE user_id=".$_SESSION['user_id'];
	$result = mysqli_query($connection, $query);
	confirm_query($result);
	
	if ($result) {
		// Success
		$_SESSION["message"] = "User created.";
		redirect_to("checkout.php");
	} else {
		// Failure
		$_SESSION["message"] = "User address addition failed.";
		$_SESSION["result"] = $result;
	}
}
?>