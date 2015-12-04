<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	//Remove item from shopping cart
    unset($_SESSION['cart']);
    redirect_to('cart.php');
?>