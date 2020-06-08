<?php 
class General extends Db{
	
	public function formFilter($required=array()){
		foreach($_POST as $key => $value){
			if(in_array($key,$required)){
				if($value==''){ $formdata['error'][$key]='This field is mandatory';}
			}
			$formdata[$key]=$this->prepSubmit($value);
		}
		return $formdata;
		}//end function
		
	public function formFilterStrict($required=array()){
		foreach($_POST as $key => $value){
			if(in_array($key,$required)){
				if($value==''){ $formdata['error'][$key]='This field is mandatory';}
			}
			$formdata[$key]=$db_obj->preg_replace("/[^a-zA-Z0-9]+/", " ", $value);
		}
		return $formdata;
		}//end function
	
	

	

		

		
	/*function to upload any kind of file*/
	function uploadFile($ran_name,$path='',$img_val,$maxsize=20000,$allowedExts = array("jpg", "jpeg", "gif", "png","JPG", "JPEG", "GIF", "PNG",'','pdf','PDF','docx','DOCX')){
	
		$maxsize=2000000000000000000000;
		$extension = end(explode(".", $_FILES[$img_val]["name"]));
		//die($extension);
		if($ran_name==''){
		$ran_name= time().'_'.rand(0,9999999999);
		}
		if (( in_array($extension, $allowedExts))
			&& ($_FILES[$img_val]["size"] < $maxsize)
			)
			  {
			  if ($_FILES[$img_val]["error"] > 0)
				{
				return "Error: " . $_FILES[$img_val]["error"] . "<br />";
				}
			  else
				{
				//echo "Upload: " . $_FILES[$img_val]["name"] . "<br />";
				//echo "Type: " . $_FILES[$img_val]["type"] . "<br />";
				//echo "Size: " . ($_FILES[$img_val]["size"] / 1024) . " Kb<br />";
				//echo "Stored in: " . $_FILES[$img_val]["tmp_name"];
					
					 if (file_exists($path . $_FILES[$img_val]["name"]) && 1==2)
						  {
						 return " File already exists. ";
						 
						  }
						else
						  {
						  move_uploaded_file($_FILES[$img_val]["tmp_name"],
						  $path  .'/'. $ran_name.'.'.$extension);
						  //echo $path  . $_FILES[$img_val]["name"];
						return $path  .'/'. $ran_name.'.'.$extension;
						  }
				}
			  }
			else
			  {
			  return "Invalid file. Please confirm that it is less than 2MB in size";
			  }
  		}//end of upload file
  
  		function makeShortURL($URLToConvert) {  
    		$shortURL= file_get_contents("http://tinyurl.com/api-create.php?url=" . $URLToConvert);  
     		return $shortURL;  
		}
	
		function randomPassword() {
			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 18; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			return implode($pass); //turn the array into a string
		} 


		function sendPHPMail($attachment,$subject="Form entry",$content="Please find attached user entry")
		{
			require_once ROOT.'lib/mailer/PHPMailerAutoload.php';
			error_reporting(E_ALL);
			ini_set('display_errors', 2);
			$mail = new PHPMailer;
	        $mail->setFrom('Diasporaonline2@co-opbank.co.ke', 'Coop Diaspora');

	        if(TEST_MODE > 0){
	        	$mail->addCC('charles.njuguna@zilojo.com', 'Charles');
	        	$mail->addAddress('web@zilojo.com', 'Web Zilojo');
	        }else{
                $mail->addAddress('zilojoweb@gmail.com', 'Zilojo Web');
                $mail->addAddress('diasporacampaigns@co-opbank.co.ke');
	        }
	        
	        $mail->Subject = $subject;
			$mail->Body    = $content;
			$mail->AltBody = 'Please find attached user entry';

	        // Attach the uploaded file
	        $mail->addAttachment($attachment); 
	        if (!$mail->send()) {
	            echo "Mailer Error: " . $mail->ErrorInfo;
	            return false;
	        } else {
	            echo "Message sent!";
	            return 1;
	        }
		}
		

		function sendErrorMail($content)
		{
			require_once ROOT.'lib/mailer/PHPMailerAutoload.php';
			error_reporting(E_ALL);
			ini_set('display_errors', 2);
			$mail = new PHPMailer;
	        $mail->setFrom('diasporacampaigns@co-opbank.co.ke', 'Coop Diaspora');
	        $mail->addAddress('charles.njuguna@zilojo.com', 'Diaspora');




	        $mail->Subject = "Error on Co-op diaspora forms";
			$mail->Body    = $content;
			$mail->AltBody = 'Please find attached user entry';

	        if (!$mail->send()) {
	            $msg .= "Mailer Error: " . $mail->ErrorInfo;
	            return false;
	        } else {
	            $msg .= "Message sent!";
	            return 1;
	        }
		}
		
		
		public function generateRandomString($length = 10) 
		{
			 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			 $randomString = '';
			 for ($i = 0; $i < $length; $i++) {
				  $randomString .= $characters[rand(0, strlen($characters) - 1)];
			 }
			 return $randomString;
		}

		public function prepTransmit($data){
			$returndata=base64_encode(serialize($data));
			$returndata=str_replace('=','',$returndata);
			return $returndata;
			}
		
		public function readFolder($folder_path){
			if (is_dir($folder_path)){
				$handle = opendir($folder_path);
				$directoryfiles = array();
				while (($file = readdir($handle)) !== false) {
					if ($file == '.' || $file == '..' || $file == '') continue;
					$directoryfiles[] = $file;
				}
			}
			return $directoryfiles;
		}

		public function readTxtFile($path)
		{	
			$myfile = fopen($path, "r") or die("Unable to open file!");
			$last =  fgets($myfile);
			fclose($myfile);
			//die($last);
			return $last;
		}

		public function clearFolder($path)
		{
			$files = glob($path.'*'); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file))
			    unlink($file); // delete file
				}
			return;
		}
		
		
		
			
		
}//end class

?>
