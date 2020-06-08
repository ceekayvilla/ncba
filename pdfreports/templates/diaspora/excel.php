<?php
	/*
		This file will run via cron job, it checks the database for entries after greater than last fetch, it then puts this in an excel sheet and send via mail to - Co-op team
		- It then updates excel.txt 
		- It works with cleanup.php which runs on a separate cron job
		- 
	*/

	

 	define('ROOT','../../');
 	require_once(ROOT.'config/constants.php');
 	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	require_once ROOT.'lib/php_excel/Classes/PHPExcel.php';

 	$genObj = new General();
 	$webFormObj = new WebForm();
 	$objPHPExcel = new PHPExcel();
 	$limit = 30;
 	$excelTracker = ROOT."user_subs/excel.txt";
 	$excelFilePath = ROOT."user_subs/created_excel/excel.xls";
 	$lastId = $genObj->readTxtFile($excelTracker);
 	$list = "5,6,4,2,1,20,3,24,7";

	$forms  = $webFormObj->getWebForms($lastId,$list,$limit);
	if(empty($forms)){ die("No data to process"); }

	echo date('d_m_Y') , " Create new PHPExcel object" , EOL;
 	$objPHPExcel->getProperties()->setCreator("Co-op Bank Auto Form")
							 ->setLastModifiedBy("Co-op Bank Auto Form")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Automated Dumps from system")
							 ->setKeywords("diaspora")
							 ->setCategory("Test result file");

	$style['red_text'] = array(
						    'font' => array(
						        'name' => 'Arial',
						        'color' => array(
						            'rgb' => 'FFFFFF'
						        )
						    ),
						    'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
								'color'		=> array('argb' => 'FF008000')
							)
						);

	

	$worksheetExists = array();
	$rowTracker = array();
	foreach ($forms as $key => $form) {
		print_r($form);
		if(in_array($form['pos'], $worksheetExists)){
			$objPHPExcel->setActiveSheetIndex($form['pos']);
		}else{
			$objWorkSheet = $objPHPExcel->createSheet($form['pos']);
			$objPHPExcel->setActiveSheetIndex($form['pos']);

			$title = $res = preg_replace("/[^a-zA-Z]/", "", $form['title']);
			$objPHPExcel->getActiveSheet()->setTitle(addslashes($title));
			$worksheetExists[] = $form['pos'];

		}
		$column = 'A';
		$rowTracker[$form['pos']]++;
		foreach ($form['data'] as $key => $cells) {
			$column++;
			$row = $rowTracker[$form['pos']]+1;
			echo $column.$row."-<br>";
			$formatedKey = ucwords(str_replace('_', ' ', $key));
			//TITLE
			$objPHPExcel->getActiveSheet()->setCellValue($column . '1', $formatedKey);
			$objPHPExcel->getActiveSheet()->setCellValue($column . $row, $cells[0]);
			$objPHPExcel->getActiveSheet()
					    ->getStyle('A1:BB1')
					    ->applyFromArray($style['red_text'])
					    ->getFont()->setBold(true);
		}
		
	}


	// Save Excel 95 file
	echo date('H:i:s') , " Write to Excel5 format" , EOL;
	$callStartTime = microtime(true);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$save = $objWriter->save($excelFilePath);
	
	
	
	

	//update excel id

	//Check if file exists
	$exist = file_exists($excelFilePath);
	if($exist){
		//send mail with attachment
		$subject = "Diaspora website data summary";
		$content = "Please find attached summary data generated on ".date('jS M Y');

		$attachment = $excelFilePath;
		$mail = $genObj->sendPHPMail($attachment,$subject,$content);
		if($mail){
			//Update excel tracker
			$myfile = fopen($excelTracker, "w") or die("Unable to open file!");
			fwrite($myfile, $form['sid']);
			fclose($myfile);

			//Delete excel file
			$genObj->clearFolder(ROOT."user_subs/created_excel/");
		}else{
			$content = "Couldn't send email<br>".date('d-m-Y');
			$genObj->sendErrorMail($content);
			die("Couldn't send email");
		}
	}else{
		//something is wrong and the file was not created
		//TO DO - SEND AN EMAIL TO DEVELOPER
		$content = "Couldn't create excel file<br>".date('d-m-Y');
		$genObj->sendErrorMail($content);
		die("Couldn't create excel file");
	}


	








	$callEndTime = microtime(true);
	$callTime = $callEndTime - $callStartTime;
	echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
	echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
	// Echo memory usage
	echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;
	// Echo memory peak usage
	echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;
	// Echo done
	echo date('H:i:s') , " Done writing files" , EOL;
	echo 'Files have been created in ' , getcwd() , EOL;








?>
I work by the way