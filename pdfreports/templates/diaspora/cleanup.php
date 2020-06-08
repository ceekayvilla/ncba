<?php
 	define('ROOT','../../');
 	require_once(ROOT.'config/constants.php');
	$genObj = new General();
 	$cleanUpObj = new CleanUp();

 	$list = "5,6,4,2,1,20,3,24,7";
	//STEP 1: get value of where it's safe to delete to (excel.txt)
	$excelTracker = ROOT."user_subs/excel.txt";
	$lastId = $genObj->readTxtFile($excelTracker);

	//STEP 2: delete files from folders
	$genObj->clearFolder(ROOT."user_subs/created_image/");
	$genObj->clearFolder(ROOT."user_subs/created_pdf/");

	
	//STEP 3: delete all files older than two weeks and lower than the safe delete value
	$list = "5,6,4,2,1,20,3,24";
	$cleanUpObj->getAndUpdate($lastId,$list,$limit = 1);

?>
	TEST