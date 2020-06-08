<?php
//this for the contact form
	define('ROOT','../');
	define('ADMIN_ROOT','../');
	require_once(ROOT.'config/constants.php');
	ini_set('display_errors', 2);

	
	$db_obj=new Db();
	$gen_obj=new General();
	$formdata=array();
	$error=array();
	$required = array();
	
	//print_r($not_required); exit;
	if($_SERVER['REQUEST_METHOD']=='POST'){
	foreach($_POST as $key => $value){
			if(in_array($key,$required)){
				if($value==''){ $error[$key]='This field is mandatory';}
			}
			$formdata[$key]=$db_obj->prepSubmit($value);
		}
		$required=explode(',',$_POST['requiredFields']);
		//$returnURL=ADMIN_URL.urldecode($_POST['returnUrl']);
	}else{
		header("Location:".BASE_URL);
		exit;
	}


	




	$formdata['error']=$error;
	$s_data=$gen_obj->prepTransmit($formdata);
	
	
	//if error take it back
	if(!empty($error)){
		print_r($formdata);
		//exit;
		//header("Location:".BASE_URL."register/$s_data");
		//exit;
	}
	
	$formdata['cdate']=date('Y-m-d H:i:s');
	$formdata['mdate']=date('Y-m-d H:i:s');

	$result=$db_obj->create('request_data', $formdata, $exclude = array('table','action','returnUrl','requiredFields','error','_wysihtml5_mode'));
	
	if($result){
		//send email
		$to = EMAIL_SENDING_ADDRESS;
		//$to = "wesongaderrick@gmail.com";
		$to_name = EMAIL_SENDING_NAME;
		$from = EMAIL_SENDING_ADDRESS;
		$from_name = EMAIL_SENDING_NAME;
		$title = "Data Direct | Request for data";
		$message = "There is a new request for data, please check the system for more details. " ;


		$sendMail = $gen_obj->sendMail($to,$to_name,$from,$from_name,$title,$message);

		$returnData=array();
		$returnData['msg_status']="success";
		$returnData['msg']='SUCCESS :: Thank you for getting in touch, we will get back to you soon.';
		$s_data=$s_data=$gen_obj->prepTransmit($returnData);
		header("Location:".BASE_URL."request-data/$s_data");
		exit;
	}else{
		$formdata['msg']='ERROR: Something went wrong and we are working on it, please try again later.';
			$formdata['msg_status']="error";
			$s_data=$gen_obj->prepTransmit($formdata);
			header("Location:".BASE_URL."request-data/$s_data");
		}	
	
?>
