<?php
/*
5/11/2013
Derrick Wesonga
stripped down constants file. It will contain the bear minimum with additional files such as facebook constants,
twitter constants and included
*/
//ERROR REPORTING COME'S FIRST default is 2-show all errors
	ini_set( 'session.cookie_httponly', 1 );
	ini_set('max_execution_time', 300);
	
	session_start();
	ob_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	//expire session in 1in0 minuites
	ini_set('session.gc_maxlifetime', 30*60);

	//careful with this one
	//ini_set('memory_limit', '-1');

	
	define('DB_HOST','localhost');
	define('DB_NAME','ncba');
	define('DB_USER','root');
	define('DB_PASS','root');
	define('DB_PORT', '3306');
	define('DB_SOCKET', '');
	define('TEST_MODE','0');
//actual database connection is done at the class

//set time zone
	date_default_timezone_set('Africa/Nairobi');
	
	$next_str=strtotime('Next Sunday', time());
	$last_day_of_week = date('Y-m-d', $next_str);
	$first_day_of_week = date('Y-m-d', strtotime('-1 week', $next_str));
	
	
	$first_day_of_month=date('Y-m-01');
	$last_day_of_month=date('Y-m-t"');

//BASE URL especially important for use with htaccess
	define("BASE_URL","http://localhost/ncba");
	
	define("IMG_FILE_PATH","http://localhost/ncba/sites/default/files/");
	define("PDF_PATH","/Applications/MAMP/htdocs/ncba/pdfreports/user_subs/created_pdf/");
	
	//mail options
	define('MAIL_FROM_NAME','Zilojo Web');
	define('MAIL_FROM_EMAIL','charles.njuguna@zilojo');
	
	define('SMPT_SERVER_HOST','mail.google.com');
	define('SMPT_SERVER_PORT','25');
	define('SMPT_EMAIL_ACCOUNT','charles.njuguna@zilojo.com');
	define('EMAIL_SENDING_NAME', 'Co-op forms');
	define('EMAIL_SENDING_ADDRESS','charles.njuguna@zilojo.com');
	define('ADMIN_EMAIL','charles.njuguna@zilojo.com');
	
	if(isset($_GET['data'])){
		$data_results=unserialize(base64_decode($_GET['data']));
		
		foreach($data_results as $key=>$data_result){
			if(is_array($data_result)){
				$cleanData[$key]=$data_result;
			}else{
				$cleanData[$key]=strip_tags($data_result);
				$cleanData[$key]=addslashes(htmlentities($cleanData[$key]));
			}
			
			}
		}
		
	//CALL THE AUTOLOADER
	function my_autoloader($class) {
		$fileClassName = ROOT.'lib/' . $class . '.class.php';
		if (file_exists($fileClassName)) {
	    	include $fileClassName;
		}
	}
	spl_autoload_register('my_autoloader');

	
?>

