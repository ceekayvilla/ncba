<?php
	const ROOT = '../';
	include_once(ROOT.'config/constants.php');
	//ini_set('display_errors', 2);
	$clientObj=new Clients();
	$genObj=new General();

	$formdata=array();
	$formdata=$genObj->formFilter();

	$result=$clientObj->login($formdata['email'],$formdata['password']);
	

	if(!empty($result)){
			//set session send to dashboard
			$_SESSION['uID']=$result[0]->id;
			$_SESSION['email']=$result[0]->email;
			$_SESSION['fullName']=$result[0]->full_name;
			
			//log attempt
			$log=array();
			$log['attempt_status']="SUCCESS";
			$log['description'] = "CLIENT logged in successfully";
			$log['users_id'] = $_SESSION['uID'];
			$log['mdate'] = date('Y-m-d H:i:s'); 
			$log['status_id'] = 1;
			$result= $clientObj->create('access_logs', $log, $exclude = array('table'));
			
			header("Location:../dashboard");
			exit;
		//redirect to dash
		}else{
			//wrong password send back to login
			unset($formdata['password']);
			unset($_SESSION);
			
			//log attempt
			$log=array();
			$log['attempt_status']="FAILED";
			$log['description'] = "CLIENT login error with user name `{$formdata['email']}` ";
			$log['users_id'] = 2;
			$log['mdate'] = date('Y-m-d H:i:s'); 
			$log['status_id'] = 1;
			$result= $clientObj->create('access_logs', $log, $exclude = array('table'));
			$formdata['msg_status']="error";
			$formdata['msg']="Invalid username or password. Please try again.";
			$returnData=base64_encode(serialize($formdata));
			header("Location:".BASE_URL."login?data={$returnData}");
			exit;	
		}
?>
