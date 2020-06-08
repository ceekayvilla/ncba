<?php
	const ROOT = '../';
	include_once(ROOT.'config/constants.php');
	//ini_set('display_errors', 2);
	$clientObj=new Clients();
	$genObj=new General();

	$formdata=array();
	$formdata=$genObj->formFilter();
	

	//get user balance
	//get resource information
	$table = $formdata['resource'];
	$payIds = explode(',', $formdata['payIds']);

	$resourceInfo=$genObj->read('resources', " AND table_name='{$table}' ", $start=0,$interval=1000000000000, $status=NULL,$order=NULL, $fields='*');

	//client purchases
	$clientBalance = $clientObj-> getClientBalance();

	$totalAmount = count($payIds)*$resourceInfo[0]->unit_cost;

	$balance = $clientBalance - $totalAmount;
	

	//check that the user has funds else redirect to pay page
	if($balance<0){
		//redirect to pay page
		$returnData['msg'] = "You have insuficient funds, please top up to continue.";
		$clientObj->goToPage('confirm-payment',$returnData);
	}

	
	//add purchased records to user's
	foreach($payIds as $payId){
		$insertArray=array(
					'client_id'=>$_SESSION['uID'],
					'resource'=>$table,
					'resource_id'=>$payId,
					'cdate'=>date("Y-m-d H:i:s"),
					'mdate'=>date("Y-m-d H:i:s"),
					'status_id'=>1
					);

		$insertResult = $clientObj->create('client_resources', $insertArray, $exclude = array('table','action','returnUrl','requiredFields','error','_wysihtml5_mode'));

	}
	 $formData = array( 'transaction_status' => "COMPLETED" );
	 $pesapal_merchant_reference = $_SESSION['pesapal_merchant_reference'];

	 $result = $genObj->update('client_purchases',$formData, " AND id='{$pesapal_merchant_reference}' " ,$exclude = array());

	header("Location:".$_SESSION['original_redirect']);
	exit;


?>
