<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
if (isset($_POST)) {
	// Process the update order form
	foreach ($_POST as $id => $value) {
		if($value='on'){
			$query  = "UPDATE tbl_orders ";
			$query .= "SET shipped=1 ";
			$query .= "WHERE order_id=".$id;
			$result = mysqli_query($connection, $query);
			confirm_query($result);
		}
	}
}
redirect_to('orders.php');
?>