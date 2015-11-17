<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	//logout
	if ($_SESSION['user_type_id']==2){
		//admin logout
		$_SESSION = array();
		session_destroy(); 
		redirect_to("admin/index.php");
	} else {
		//general user logout
		$_SESSION = array();
		session_destroy(); 
		redirect_to("index.php");
	}
?>