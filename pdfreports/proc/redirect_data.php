<?php 
	const ROOT = '../';
	include_once(ROOT.'config/constants.php');
	$genObj=new General();
	
	
	
	foreach($_POST as $key => $value){
			$formdata[$key]=$genObj->prepSubmit($value);
		}
		
		$page=$formdata['page'];
		unset($formdata['page']);
		$urlData=$genObj->prepTransmit($formdata);
		header("Location:".BASE_URL.$page.$urlData);
		exit;


 ?>