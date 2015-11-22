<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	//Remove item from shopping cart
    $id = $_GET['id'];
    unset($_SESSION['cart']['cart'.$id]);
    redirect_to('cart.php');
?>