<?php
	const ROOT = '../';
	include_once(ROOT.'config/constants.php');
	ini_set('display_errors', 2);
	$clientObj=new Clients();
	$genObj=new General();

	$formdata=array();
	$formdata=$genObj->formFilter();
	

	//get user balance
	//get resource information

	$count = 1;
	$totalCost = 0;
	$totalCount = 0;
	$insertArrays = array();

	

	foreach ($_SESSION['cart'] as $key => $carts) { 

		$cartResourceInfo=$genObj->read('resources', " AND table_name='{$key}' ", $start=0,$interval=1000000000000, $status=NULL,$order=NULL, $fields='*');
		$cartCount = count($cart);
		$cartCost = count($cart)*$cartResourceInfo[0]->unit_cost;

		$totalCost += $cartCost;
		$toBuyStr .= $cartCount." ".$cartResourceInfo[0]->resource_name.",";
		$totalCount += $cartCount; 
		$count++; 

		foreach ($carts as  $cart) {
			$insertArrays[]=array(
					'clients_id'=>$_SESSION['uID'],
					'resource'=>$key,
					'resources_id'=>$cart,
					'cdate'=>date("Y-m-d H:i:s"),
					'mdate'=>date("Y-m-d H:i:s"),
					'status_id'=>1
					);
		}
		
	}

	//echo "<pre>";
	//print_r($insertArrays);
	//exit;

	$clientBalance=$clientObj-> getClientBalance();
	$balance = $clientBalance - $totalCost;

	//check that the user has funds else redirect to pay page
	if($balance<1){
		//redirect to pay page
		$returnData['msg'] = "You have insuficient funds, please top up to continue.";
		$clientObj->goToPage('confirm-payment',$returnData);
	}

	
	//add purchased records to user's
	foreach($insertArrays as $insertArray){
		

		$insertResult = $clientObj->create('client_resources', $insertArray, $exclude = array('table','action','returnUrl','requiredFields','error','_wysihtml5_mode'));

	}
	 $formData = array( 'transaction_status' => "COMPLETED" );
	 $pesapal_merchant_reference = $_SESSION['pesapal_merchant_reference'];

	 $result = $genObj->update('client_purchases',$formData, " AND id='{$pesapal_merchant_reference}' " ,$exclude = array());
	 unset($_SESSION['cart']);
	header("Location:".$_SESSION['original_redirect']);
	exit;


?>
