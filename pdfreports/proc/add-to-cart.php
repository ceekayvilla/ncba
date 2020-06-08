<?php
	define("ROOT","../");
	require_once(ROOT."config/constants.php");
	$genObj = new General();

	$resource = $_POST['resource'];
	if(!is_array($_SESSION['cart'][$resource])){
		$_SESSION['cart'][$resource]=array();
	}

	$_SESSION['cart'][$resource] = array_unique(array_merge($_SESSION['cart'][$resource],$_POST['payIds']), SORT_REGULAR);

	echo "<pre>";
	print_r($_SESSION['cart']);

	header("Location:".$_SERVER['HTTP_REFERER']);
	exit;

?>