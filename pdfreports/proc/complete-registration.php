<?php
//this can be used to submit any kind of form
	define('ROOT','../');
	define('ADMIN_ROOT','../');
	require_once(ROOT.'config/constants.php');

	
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







	//check that the code entered is valid
	$email = $formdata['email'];
	$code = $formdata['code'];
	$userDetails = $gen_obj-> read('clients', " AND `email`='{$email}' AND `code`='{$code}' ", $start=0,$interval=1000000000000, $status=NULL,$order=NULL, $fields='*');

	if(empty($userDetails)){
		$error[]="Invalid user or code.";
	}



	$formdata['error']=$error;
	$s_data=$gen_obj->prepTransmit($formdata);
	
	
	//if error take it back
	if(!empty($error)){
		print_r($formdata);
		//exit;
		header("Location:".BASE_URL."register/$s_data");
		exit;
	}
	$updateData = array();
	$updateData['mdate']=date('Y-m-d H:i:s');
	$updateData['code'] = $gen_obj->generateRandomString(20);
	$updateData['user_active'] = 1;
	$updateData['status_id'] = 1;
	$updateID = $userDetails[0]->id;

	$result=$db_obj->update('clients',$updateData," and id='{$updateID}' ",$exclude = array());
	
	if($result){
		//send email
		$to = $formdata['email'];
		$to_name = $formdata['full_name'];
		$from = "info@cartacreative.net";
		$from_name = 'Data Direct | Registration';
		$title = "New user registration.";
		$message = "Welcome to DataDirect,<br>You can now login using your email and password." ;

		$sendMail = $gen_obj->sendMail($to,$to_name,$from,$from_name,$title,$message);


		$returnData=array();
		$returnData['message']='SUCCESS :: Registration complete, you can now login with your  email and password.';
		$s_data=$s_data=$gen_obj->prepTransmit($formdata);
		header("Location:".BASE_URL."login/?email=".$formdata['email']);
		exit;
	}else{
		$formdata['message']='ERROR: sorry we are not able to activate your account at this time, please try again later';
			$s_data=$gen_obj->prepTransmit($formdata);
			header("Location:".BASE_URL."complete-registration/$s_data");
		}	
	
?>
