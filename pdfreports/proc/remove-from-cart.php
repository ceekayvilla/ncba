<?php
	define("ROOT","../");
	require_once(ROOT."config/constants.php");
	$genObj = new General();

	$resource = $_GET['resource'];
	

	$_SESSION['cart'][$resource] = array();

	unset($_SESSION['cart'][$resource]);

	
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit;

?>