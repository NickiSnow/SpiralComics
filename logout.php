<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	//logout
	$_SESSION = array();
	session_destroy(); 
	redirect_to("index.php");
?>