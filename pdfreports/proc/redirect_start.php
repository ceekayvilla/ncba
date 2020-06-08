<?php 
	const ROOT = '../';
	include_once(ROOT.'config/constants.php');
	$genObj=new General();
	
	
	
	foreach($_POST as $key => $value){
			$formdata[$key]=$genObj->prepSubmit($value);
		}
		
		$data=array();
		$data['sites_id']=$formdata['sites_id'];
		$data['W']=$formdata['W'];
		$data['Y']=$formdata['Y'];
		
		$urlData=$genObj->prepTransmit($data);
		header("Location:".BASE_URL."spray-records/".$urlData);
		exit;


 ?>