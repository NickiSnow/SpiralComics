<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
if (isset($_POST)) {
	$comic_id = substr($_POST['inventory_id'], 0, -4);
	// Process the add inventory form
	$query  = "INSERT INTO tbl_inventory ";
	$query .= "(inventory_id, comic_id, quantity, cost, price, grade, grade_description, picture_500, type_id)";
	$query .= " VALUES ('".$_POST['inventory_id']."', '".$comic_id."', ".$_POST['qty'].", ".$_POST['cost'].", ".$_POST['price'].", '".$_POST['grade']."', '".$_POST['grade_description']."', '".$_POST['cover']."', ".$_POST['comic_type'].")";
	$result = mysqli_query($connection, $query);
	confirm_query($result);
	redirect_to('add_inventory_form.php');
}
?>