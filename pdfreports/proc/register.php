<?php
//this can be used to submit any kind of form
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

	//check if the userr already exists
	$email = $formdata['email'];
	$userDetails = $gen_obj-> read('clients', " AND `email`='{$email}' ", $start=0,$interval=1000000000000, $status=NULL,$order=NULL, $fields='*');

	if(!empty($userDetails)){
		//check if active if not delete
		if($userDetails[0]->user_active == 0){
			//delete and create a fresh one with email
			$deleteArray = array('status_id'=>9999);
			$deleteId = $userDetails[0]->id;
			$updated = $gen_obj-> update('clients', $deleteArray, " AND `id`='{$deleteId}' ", $exclude = array('table','action'));

		}else{
			//this user is active fuck off
			$error[]="A user has already registered using this email, please try again or contact the administrator using the email ".MAIL_FROM_EMAIL;	
		}

		
	}

	if($formdata['password']!=$formdata['cpassword']){
		$error[]="Password feilds do not match, please try again.";
	}





	$formdata['error']=$error;
	$s_data=$gen_obj->prepTransmit($formdata);
	
	echo "<pre>";
	//print_r($formdata);
	//echo "</pre>";
	//exit;
	//if error take it back
	if(!empty($error)){
		$formdata['msg']=$error;
		$formdata['msg_status']="error";
		$s_data=$gen_obj->prepTransmit($formdata);
		header("Location:".BASE_URL."register/$s_data");
		exit;
	}
	
	$formdata['cdate']=date('Y-m-d H:i:s');
	$formdata['code'] = $gen_obj->generateRandomString(20);
	$formdata['password'] = md5($formdata['password']);
	$formdata['user_active'] = 0;
	$formdata['status_id'] = 1;
	unset($formdata['cpassword']);
	$result=$db_obj->create('clients', $formdata, $exclude = array('table','action','returnUrl','requiredFields','error','_wysihtml5_mode'));
	
	if($result){
		//send email
		$to = $formdata['email'];
		$to_name = $formdata['full_name'];
		$from = "info@datadirect.co.ke";
		$from_name = 'Data Direct | Registration';
		$title = "Data Direct | Registration.";
		$resetUrl = BASE_URL."complete-registration/?email=".$formdata['email']."&code=".$formdata['code'];
		$message = "<p>Thank you for registering. </p><p>You confirmation code is - <b>".$formdata['code']."</b>. You can copy and paste this code to ".BASE_URL."complete-registration/?email=".$formdata['email']."&code=".$formdata['code']." <br>. Alternatively you can click on the link below to complete registration.<br></p>" ;
		$message.=' <tr>
                      <td align="center">
                        <table width="300" border="0" cellpadding="10" cellspacing="0" bgcolor="#ffd204" style="border-radius: 5px">
                        <tbody>
                          <tr>
                            <td align="center"> <a href="'.$resetUrl.'" target="_blank" style="color: #65747a; font-family:Arial, sans-serif; text-decoration: none; text-transform: uppercase;">Complete Registration</a> </td>
                          </tr>
                        </tbody>
                      </table>                        &nbsp;</td>
                    </tr>';

		$sendMail = $gen_obj->sendMail($to,$to_name,$from,$from_name,$title,$message);


		$returnData=array();
		$returnData['message']='SUCCESS :: Thank you for registering, we have sent you a confirmation code via email. Please enter the code to complete registration.';
		$s_data=$s_data=$gen_obj->prepTransmit($formdata);
		header("Location:".BASE_URL."complete-registration/?email=".$formdata['email']);
		exit;
	}else{
		$formdata['message']='ERROR: sorry we are not able to add record at this time, please try again later';
			$s_data=$gen_obj->prepTransmit($formdata);
			header("Location:".BASE_URL."register/$s_data");
		}	
	
?>
