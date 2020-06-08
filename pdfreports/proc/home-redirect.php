<?php
	const ROOT='../';
	include_once(ROOT.'config/constants.php');
	$genObj = new General();
	$formdata=array();
	
	foreach($_POST as $key => $value){
			$formdata[$key]=$genObj->prepSubmit($value);
		}
	$urlData=$genObj->prepTransmit($formdata);
	
	switch($formdata['data_type']){
		case '1':
			header("Location:".BASE_URL.'stock-index/'.$urlData);
			exit;
		break;
		
		case '2':
			header("Location:".BASE_URL.'stock-price/'.$urlData);
			exit;
		break;
		
		case '3':
			header("Location:".BASE_URL.'forex-rate/'.$urlData);
			exit;
		break;
		
		case '4':
			header("Location:".BASE_URL.'consumer-price-index/'.$urlData);
			exit;
		break;
		
		case '5':
			header("Location:".BASE_URL.'interest-rates/'.$urlData);
			exit;
		break;
		
		case '6':
			header("Location:".BASE_URL.'company-profile/'.$urlData);
			exit;
		break;
		
		}//end switch case
print_r($formdata);
?>