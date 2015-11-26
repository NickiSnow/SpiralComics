<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
if (isset($_POST)) {
	// Process the update inventory form
	$query  = "UPDATE tbl_inventory ";
	$query .= "SET price=".$_POST['price'].", quantity=".$_POST['quantity'];
	$query .= " WHERE inventory_id=".$_POST['id'];
	$result = mysqli_query($connection, $query);
	confirm_query($result);
	redirect_to('inventoryReport.php');
}
?>