<?php
class WebForm extends General{
	public $jpg_image;

	public function generatePDF()
	{
	
		//get lastID
		$lastId = $this->getLastId();

//		die("Last-".$lastId);
		//get new content after last id
		$list = "1,2";
		//$list = "1";
		echo "---";
		$datas = $this->getWebForms($lastId,$list);
		//loop through data and choose GD template
		foreach ($datas as $key => $data) {
			switch($data['nid'])
			{
				case '1':
				$this->generatePersonalLoanRestructure($data);
				$images = array(
					ROOT."user_subs/created_image/personal_loan_restructuring_".$data['sid'].".jpg",

				);
				$this->convertToPdf($images, $data['sid']);
				$subject="Personal Loan Restucturing";
				$content="Please find attached entry for Personal Loan Restucturing";
				break;

				case '2':
				$this->generateBusinessLoanRestructure($data);

				$images = array(
								ROOT."user_subs/created_image/business_loan_restructure_1_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/business_loan_restructure_2_".$data['sid'].".jpg",
								);
				//convert it to pdf
				$this->convertToPdf($images,$data['sid']);
				$subject = "Business Loan Restucturing";
				$content = "Please find attached entry for Business Loan Restucturing";
				//send an email to ncba
				break;
				

			}
			
			$attachment = ROOT."user_subs/created_pdf/pdf_".$data['sid'].".pdf";
			$this->sendPHPMail($attachment,$subject,$content);
			$myfile = fopen(ROOT."user_subs/position.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $data['sid']);
			fclose($myfile);
			
		}

	}


	public function generateBusinessLoanRestructure($data){
		/*echo "<pre>";
		parse_str($data['data']['restructure_info'][0],$output);
		foreach ($output as $key => $value) {
			print_r("key :".$key." - value: ".$value);
		}

		exit;*/

		$originalPath = ROOT."user_subs/original/business/business_loan_restructure_1.jpg";
		$storagePath = ROOT."user_subs/created_image/business_loan_restructure_1_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		/*business details: */
		$date = date('m/d/Y', $data['date']);
		$this->printText($date,18,1370,315);
		$this->printText(strtoupper($data['data']['registered_name'][0]),28,250,410);
		$this->printText(strtoupper($data['data']['trading_name'][0]),28,220,470);

		switch($data['data']['entity_type'][0]){
			case "llc":
				$this->addTick(193,508);
			break;
			case "sole":
				$this->addTick(493,508);
			break;
			case "partnership":
				$this->addTick(736,508);
			break;
			default:
				$this->addTick(903,508);
				$this->printText(strtoupper($data['data']['other'][0]),28,1010,525);
		}
		


		$this->printText(strtoupper($data['data']['nature_of_business'][0]),28,360,580);
		$this->printText(strtoupper($data['data']['certificate_of_reg_incorporation_number'][0]),24,445,635);
		$this->printText(strtoupper($data['data']['date_of_registration'][0]),28,1075,635);
		$this->printText(strtoupper($data['data']['years_of_operation'][0]),28,260,690);
		$this->printText(strtoupper($data['data']['pin_tax_number'][0]),28,570,690);
		$this->printText(strtoupper($data['data']['number_of_employees'][0]),28,1035,690);
		if($data['data']['business_premise'][0] == "owned"){
			$this->addTick(250,732);
		}else{
			$this->addTick(390,735);
		}
		/*business details*/

		/*business location*/
		$this->printText(strtoupper($data['data']['physical_address'][0]),24,395,875);
		$this->printText(strtoupper($data['data']['street_road'][0]),24,990,875);
		$this->printText(strtoupper($data['data']['building_lr_number'][0]),24,245,925);
		$this->printText(strtoupper($data['data']['floor_door_number'][0]),24,565,925);
		$this->printText(strtoupper($data['data']['nearby_landmark'][0]),24,840,925);
		$this->printText(strtoupper($data['data']['tel_office_number_1'][0]),26,240,980);
		$this->printText(strtoupper($data['data']['tel_office_number_2'][0]),26,940,980);
		$this->printText(strtoupper($data['data']['website'][0]),24,165,1030);
		$this->printText(strtoupper($data['data']['postal_address'][0]),24,940,1030);
		$this->printText(strtoupper($data['data']['postal_code'][0]),24,1280,1030);
		$this->printText(strtoupper($data['data']['town'][0]),26,140,1100);
		$this->printText(strtoupper($data['data']['country'][0]),26,880,1100);
		/*business location*/

		/*contact person*/
		$this->printText(strtoupper($data['data']['name'][0]),28,630,1170);
		$this->printText(strtoupper($data['data']['mobile_number'][0]),24,235,1220);
		$this->printText(strtoupper($data['data']['office_number'][0]),24,920,1220);
		$this->printText(strtoupper($data['data']['email_address'][0]),20,220,1275);
		$this->printText(strtoupper($data['data']['designation'][0]),24,985,1275);
		$this->printText(strtoupper($data['data']['date_joined'][0]),24,195,1330);
		$this->printText(strtoupper($data['data']['experience'][0]),24,965,1330);
		/*contact person*/

		/*sole propriertorship*/

		switch($data['data']['sl_title'][0]){
			case "mr":
				$this->addTick(350,1530);
			break;
			case "mrs":
				$this->addTick(432,1530);
			break;
			case "ms":
				$this->addTick(525,1530);
			break;
			case "dr":
				$this->addTick(608,1530);
			break;
			case "prof":
				$this->addTick(685,1530);
			break;
			default:
			$this->addTick(780,1530);
			$this->printText(strtoupper($data['data']['sl_other'][0]),24,885,1525);

		}
		$this->printText(strtoupper($data['data']['sl_name'][0]),28,140,1605);
		$this->printText(strtoupper($data['data']['sl_birthday'][0]),24,205,1663);
		$this->printText(strtoupper($data['data']['sl_gender'][0]),24,660,1663);
		$this->printText(strtoupper($data['data']['sl_nationality'][0]),24,935,1663);
		$this->printText(strtoupper($data['data']['sl_marital_status'][0]),24,1335,1663);
		$this->printText(strtoupper($data['data']['sl_id_passport'][0]),24,240,1720);
		$this->printText(strtoupper($data['data']['sl_passport_expiry_date'][0]),24,810,1720);
		$this->printText(strtoupper($data['data']['sl_pin_number'][0]),24,1435,1720);
		$this->printText(strtoupper($data['data']['sl_mobile_number'][0]),24,190,1775);
		$this->printText(strtoupper($data['data']['sl_home_phone_number'][0]),24,900,1775);
		$this->printText(strtoupper($data['data']['sl_postal_address'][0]),24,225,1830);
		$this->printText(strtoupper($data['data']['sl_postal_code'][0]),24,660,1830);
		$this->printText(strtoupper($data['data']['sl_town'][0]),24,870,1830);
		$this->printText(strtoupper($data['data']['sl_country'][0]),24,1225,1830);
		$this->printText(strtoupper($data['data']['sl_physical_address'][0]),24,310,1880);
		$this->printText(strtoupper($data['data']['sl_street_name'][0]),24,795,1880);
		$this->printText(strtoupper($data['data']['sl_estate'][0]),24,1165,1880);
		$this->printText(strtoupper($data['data']['sl_house_rl_number'][0]),24,190,1935);
		$this->printText(strtoupper($data['data']['sl_name_of_next_of_kin'][0]),24,585,1935);
		$this->printText(strtoupper($data['data']['sl_kin_relationship'][0]),24,205,1985);
		$this->printText(strtoupper($data['data']['sl_kin_phone_number'][0]),24,965,1985);
		/*sole propriertorship*/


		imagejpeg($this->jpg_image,$storagePath);
		imagedestroy($this->jpg_image);

		//second page
		$originalPath = ROOT."user_subs/original/business/business_loan_restructure_2.jpg";
		$storagePath = ROOT."user_subs/created_image/business_loan_restructure_2_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper($data['data']['account_name'][0]),24,255,215);
		$this->printText(strtoupper($data['data']['account_number'][0]),24,1285,215);

		$this->printText(strtoupper($data['data']['minimum_installment'][0]),24,765,780);

		foreach ($data['data']['moratorium_options'] as $key => $value) {
			if($value=="1"){
				$this->addTick(580,875);
			}else if($value=="2"){
				$this->addTick(880,875);
			}else{

			}
		}
		$this->printText(strtoupper($data['data']['grace_period'][0]),24,340,955);
		$this->printText(strtoupper($data['data']['effective_date'][0]),24,865,955);
		$this->printText(strtoupper($data['data']['expiry_date'][0]),24,1305,955);
		$this->printText(strtoupper($data['data']['resumption_full_repayment_date'][0]),24,420,995);

		$this->printText(strtoupper($data['data']['account_name'][0]),24,155,1445);
		$this->printText(strtoupper($data['data']['name_two'][0]),24,155,1505);
		$this->printText(strtoupper($data['data']['name_three'][0]),24,155,1565);

		$this->addImagefromFile($data['data']['signature_one'][0],790,1375,70,70);
		$this->addImagefromFile($data['data']['signature_two'][0],790,1435,70,70);
		$this->addImagefromFile($data['data']['signature_three'][0],790,1495,70,70);


		
		$this->printText($date,24,1195,1445);
		$this->printText($date,24,1195,1505);
		$this->printText($date,24,1195,1565);

		imagejpeg($this->jpg_image,$storagePath);
		imagedestroy($this->jpg_image);

	}




	
	public function generatePersonalLoanRestructure($data){
		echo "<pre>";
		print_r($data); 
		//exit;
		
		$originalPath = ROOT."user_subs/original/personal_loan_restructuring.jpg";
		$storagePath = ROOT."user_subs/created_image/personal_loan_restructuring_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		/*title*/
		switch($data['data']['title'][0]){
			case "Mr":
				$this->addTick(255,330);
			break;
			case "Mrs":
				$this->addTick(418,330);
			break;
			case "Ms":
				$this->addTick(580,330);
			break;
			case "Dr":
				$this->addTick(740,330);
			break;
			case "Prof":
				$this->addTick(900,330);
			break;
			case "Hon":
				$this->addTick(1063,330);
			break;
			default:
			$this->addTick(1270,330);
			$this->printText(strtoupper($data['data']['other_title']),28,1755,350);

		}
		/*title*/
		/*name*/
			$this->printText(strtoupper($data['data']['first_name'][0]),28,700,440);
			$this->printText(strtoupper($data['data']['middle_name'][0]),28,1341,440);
			$this->printText(strtoupper($data['data']['surname'][0]),28,1873,440);
		/*name*/

		/*dob, pin, nationality*/
			$this->printText($data['data']['date_of_birth'][0], 28,370,525);
			$this->printText(strtoupper($data['data']['pin'][0]), 28,1215,525);
			$this->printText($data['data']['nationality'][0], 28,1865,525);
		/*dob*/

		/*marital status*/
		if($data['data']['marital_status'][0]==="Single"){
			$this->addTick(515,590);
		}else if($data['data']['marital_status'][0]==="Married"){
			$this->addTick(812,590);
		}else{
			$this->addTick(1112,590);
			$this->printText(strtoupper($data['data']['other_status'][0]), 28,1555,610);
		}
		/*marital status*/

		/*gender*/
		if($data['data']['gender'][0]==="Male"){
			$this->addTick(515,675);
		}else{
			$this->addTick(815,675);
		}
		
		/*gender*/


		/*ID*/
			$this->printText(strtoupper(str_replace("_"," ", $data['data']['identification_document'][0])), 28,570,790);
			$this->printText(strtoupper($data['data']['document_number'][0]), 28,1750,790);
		/*ID*/

		/*residense, postal*/
			$this->printText(strtoupper($data['data']['postal_address'][0]), 28,400,875);
			$this->printText(strtoupper($data['data']['postal_code'][0]), 28,1190,875);
			$this->printText(strtoupper($data['data']['city'][0]), 28,1665,875);
			$this->printText(strtoupper($data['data']['physical_address_residential'][0]), 28,645,965);
			$this->printText(strtoupper($data['data']['plot_number'][0]), 28,1665,965);
			$this->printText(strtoupper($data['data']['length_of_stay_at_current_residence_years'][0]), 28,855,1055);
			$this->printText(strtoupper($data['data']['nearest_landmark'][0]), 28,1545,1055);
		/*residense, postal*/

		if($data['data']['property_company_house'][0]==="rental"){
			$this->addTick(812,1115);
		}else if($data['data']['property_company_house'][0]==="own"){
			$this->addTick(1262,1115);
		}else{
			$this->addTick(1705,1115);
		}

		/*cellphone & email*/
		$this->printText(strtoupper($data['data']['cell_phone_1'][0]), 28,440,1230);
		$this->printText(strtoupper($data['data']['cell_phone_2'][0]), 28,1520,1230);
		$this->printText(strtoupper($data['data']['email_preferred'][0]), 28,435,1310);
		$this->printText(strtoupper($data['data']['email_other'][0]), 28, 1435,1310);
		/*cellphone & email*/

		/*next of kin*/
		$this->printText(strtoupper($data['data']['next_of_kin_name'][0]),28,455,1405);
		$this->printText(strtoupper($data['data']['contacts'][0]),28,540,1580);
		$this->printText(strtoupper($data['data']['kin_postal_address'][0]),28,1460,1580);
		$this->printText(strtoupper($data['data']['kin_postal_code'][0]),28,345,1665);
		$this->printText(strtoupper($data['data']['kin_town_or_city'][0]),28,1075,1665);
		$this->printText(strtoupper($data['data']['country'][0]),28,1790,1665);

		 if($data['data']['relationship'][0]==="child"){
		 	$this->addTick(370,1465);
		 }else if($data['data']['relationship'][0]==="parent"){
		 	$this->addTick(670,1465);
		 }else if($data['data']['relationship'][0]==="spouse"){
		 	$this->addTick(970,1465);
		 }else{
		 	$this->printText(strtoupper($data['data']['other_relationship']), 28,1590,1490);
		 	$this->addTick(1275,1465);
		 }
		/*next of kin*/

		/*employment type*/
		foreach ($data['data']['employment_type'] as $key => $value) {
			if($value=="contract"){
				$this->addTick(1240,1820);
			}else if($value=="permanent"){
				$this->addTick(550,1820);
			}else if($value=="pensionable"){
				$this->addTick(875,1820);
			}else{

			}
		}
		/*employment type*/

		/*occupation, employer name, department ,position, self employed*/
		$this->printText(strtoupper($data['data']['occupation'][0]), 24,350,1925);
		$this->printText(strtoupper($data['data']['name_of_employer'][0]), 24,1510,1925);
		$this->printText(strtoupper($data['data']['employee_department'][0]), 24,520,2015);
		$this->printText(strtoupper($data['data']['employee_position'][0]), 24,1515,2015);
		$this->printText(strtoupper($data['data']['self_employed'][0]), 24,840,2100);
		//$this->printText(strtoupper($data['data']['']), 28,1590,2100);
		/*occupation, employer name, department ,position, self employed*/

		/*gross income band*/
		foreach ($data['data']['gross_income_band'] as $key => $value) {
			if($value=="<150k"){
				$this->addTick(665,2165);
			}else if($value=="<350k"){
				$this->addTick(965,2165);
			}
			else if($value=="<600k"){
				$this->addTick(1265,2165);
			}else if($value=="<3.5m"){
				$this->addTick(1560,2165);
			}else{
				$this->addTick(1865,2165);
			}
		}
		/*gross income band*/

		/*employers postal address, postal code, town/city, country, physical address,office tel,plot number, mobile tel,email address*/
		$this->printText(strtoupper($data['data']['employers_postal_address'][0]), 20,575,2275);
		$this->printText(strtoupper($data['data']['employers_postal_code'][0]), 20,1145,2275);
		$this->printText(strtoupper($data['data']['employers_town_city'][0]), 22,1575,2275);
		$this->printText(strtoupper($data['data']['employers_country'][0]), 22,1940,2275);
		$this->printText(strtoupper($data['data']['employers_physical_address'][0]), 22,770,2360);
		$this->printText(strtoupper($data['data']['telephone_office'][0]), 24,1625,2360);
		$this->printText(strtoupper($data['data']['employer_plot_number'][0]), 22,290,2450);
		$this->printText(strtoupper($data['data']['mobile_number_office'][0]), 22,1020,2450);
		$this->printText(strtoupper($data['data']['employer_email_address'][0]), 22,1800,2450);
		/*employers postal address, postal code, town/city, country, physical address,office tel,plot number, mobile tel,email address*/

		/*other bank accounts held*/
		$this->printText(strtoupper($data['data']['bank_name_one'][0]), 22,340,2625);
		$this->printText(strtoupper($data['data']['branch_name_one'][0]), 22,1100,2625);
		$this->printText(strtoupper($data['data']['account_number_one'][0]), 22,1705,2625);
		$this->printText(strtoupper($data['data']['bank_name_two'][0]), 22,340,2710);
		$this->printText(strtoupper($data['data']['branch_name_two'][0]), 22,1100,2710);
		$this->printText(strtoupper($data['data']['account_number_two'][0]), 22,1705,2710);
		/*other bank accounts held*/

		/*reason for restructuring & options*/
		$this->printText(strtoupper($data['data']['reason_for_seeking_restructure'][0]), 22,650,2885);
		/*reason for restructuring & options*/

		/*amalgamation*/
		foreach ($data['data']['amalgamation_options'] as $key => $value) {
			if($value=="credit_card"){
				$this->addTick(1120,3045);
			}else if($value=="mortgage"){
				$this->addTick(215,3045);
			}else if($value=="overdraft"){
				$this->addTick(820,3045);
			}else if($value=="unsecured"){
				$this->addTick(520,3045);
			}else{
				$this->addTick(1418,3045);
			}
		}

		$this->printText(strtoupper($data['data']['amalgamation_loan_one'][0]), 22,120,3260);
		$this->printText(strtoupper($data['data']['amalgamation_interest_rate_one'][0]), 22,620,3260);
		$this->printText(strtoupper($data['data']['remaining_tenor_one'][0]), 22,1060,3260);
		$this->printText(strtoupper($data['data']['amalgamation_total_outstanding_one'][0]), 22,1650,3260);

		$this->printText(strtoupper($data['data']['amalgamation_loan_two'][0]), 22,120,3335);
		$this->printText(strtoupper($data['data']['amalgamation_interest_rate_two'][0]), 22,620,3335);
		$this->printText(strtoupper($data['data']['remaining_tenor_two'][0]), 22,1060,3335);
		$this->printText(strtoupper($data['data']['amalgamation_total_outstanding_two'][0]), 22,1650,3335);

		$this->printText(strtoupper($data['data']['amalgamation_loan_three'][0]), 22,120,4210);
		$this->printText(strtoupper($data['data']['amalgamation_interest_rate_three'][0]), 22,620,4210);
		$this->printText(strtoupper($data['data']['remaining_tenor_three'][0]), 22,1060,4210);
		$this->printText(strtoupper($data['data']['amalgamation_total_outstanding_three'][0]), 22,1650,4210);

		$this->printText(strtoupper($data['data']['total_amalgmated_balance'][0]), 22,3400,345);
		$this->printText(strtoupper($data['data']['amalgamted_currency'][0]), 22,4045,345);
		$this->printText(strtoupper($data['data']['amalgamated_tenor'][0]), 22,4325,345);
		$this->printText(strtoupper($data['data']['amalgamated_interest_rate'][0]), 22,4770,345);
		/*amalgamation*/

		/** single/loan facility restructure */
		foreach ($data['data']['single_restructure_options'] as $key => $value) {
			if($value=="credit_card"){
				$this->addTick(3900,650);
			}else if($value=="mortgage"){
				$this->addTick(2995,650);
			}else if($value=="overdraft"){
				$this->addTick(3600,650);
			}else if($value=="unsecured"){
				$this->addTick(3300,650);
			}else{
				$this->addTick(4197,650);
				$this->printText(strtoupper($data['data']['other_loans_option_two'][0]), 22,4605,670);
			}
		}

		$this->printText(strtoupper($data['data']['balance_option_two'][0]), 22,3070,845);
		$this->printText(strtoupper($data['data']['arrears_option_two'][0]), 22,3725,845);
		$this->printText(strtoupper($data['data']['interest_accrued_option_two'][0]), 22,4590,845);

		$this->printText(strtoupper($data['data']['total_outstanding_option_two'][0]), 20,3710,930);
		$this->printText(strtoupper($data['data']['interest_pa_option_two'][0]), 20,4525,930);
		$this->printText(strtoupper($data['data']['remaining_tenor_option_two'][0]), 20,4960,930);

		$this->printText(strtoupper($data['data']['extend_tenor_by_option_two'][0]), 22,3195,1020);
		$this->printText(strtoupper($data['data']['new_tenor_option_two'][0]), 22,4635,1020);
		/** single/loan facility restructure */


		/** moratorium */
		foreach ($data['data']['kindly_allow_moratorium'] as $key => $value) {
			if($value=="principal"){
				$this->addTick(2945,1285);
			}else if($value=="existing_facility"){
				$this->addTick(3515,1285);
			}else if($value=="principal_plus_interest"){
				$this->addTick(3885,1285);
			}else if($value=="restructured_facility"){
				$this->addTick(4720,1285);
			}else{
			}
		}
		foreach ($data['data']['moratorium_on_my'] as $key => $value) {
			if($value=="credit_card"){
				$this->addTick(3885,1375);
			}else if($value=="mortgage"){
				$this->addTick(3382,1375);
			}else if($value=="overdraft"){
				$this->addTick(3640,1375);
			}else if($value=="unsecured"){
				$this->addTick(3382,1375);
			}else{
				$this->printText(strtoupper($data['data']['other_moratorium'][0]), 22,4610,1370);
			}
		}

		$this->printText(strtoupper($data['data']['grace_period'][0]), 22,3405,1490);
		$this->printText(strtoupper($data['data']['effective_date'][0]), 22,4090,1490);
		$this->printText(strtoupper($data['data']['expiry_date'][0]), 22,4745,1490);
		$this->printText(strtoupper($data['data']['resumption_full_repayment_date'][0]), 22,3500,1560);
		/** moratorium */

		/*declaration*/
		$this->printText("11", 22,4930,2015);
		$this->printText(strtoupper($data['data']['repayment_period'][0]), 22,3565,2130);

		foreach ($data['data']['salary_checkoff'] as $key => $value) {
			if($value=="salary_checkoff"){
				$this->addTick(3000,2850);
			}else if($value=="monthly_salary"){
				$this->addTick(3000,2940);
			}else{}

		}

		$this->addImagefromFile($data['data']['signature'][0],3310,3050,70,70);

		$date = date('m/d/Y', $data['date']);

		$this->printText($date, 26,4750,3150);
		$this->printText($date, 26,4750,3150);
		/*declaration*/

		imagejpeg($this->jpg_image,$storagePath);
		imagedestroy($this->jpg_image);
	}


	public function convertToPdf($images,$sid)
	{
		
		require_once(ROOT.'pdf/tcpdf.php');
		//ob_start();
		$pdf = new TCPDF();

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('NCBA auto form');
		$pdf->SetTitle('NCBA bank');
		$pdf->SetSubject('NCBA bank');

		$pdf->SetAutoPageBreak(false, 0);

		foreach ($images as $key => $image) {
			$pdf->AddPage();
			$pdf->Image($image, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
			$pdf->setPageMark();
			
		}
		ob_clean();
		echo dirname(__FILE__)."pdf_".$sid.".pdf";
		$pdf->Output(PDF_PATH."pdf_".$sid.".pdf", 'FI');
		
		

	}

	public function addTick($x,$y)
	{
		$icon = ROOT."user_subs/resources/tick_30_x_30.png";
		$src = imagecreatefrompng($icon);
		imagecopy($this->jpg_image, $src, $x, $y, 0, 0, 30, 30);
	}

	public function addSmallTick($x,$y)
	{
		$icon = ROOT."user_subs/resources/tick_10_x_10.png";
		$src = imagecreatefrompng($icon);
		imagecopy($this->jpg_image, $src, $x, $y, 0, 0, 10, 10);
	}

	public function getImgUrl($file_id)
	{
		$fileDetails = $this->read('file_managed'," AND fid='{$file_id}'");
		if(empty($fileDetails)){ return; }
		$file = str_replace("public://", "", $fileDetails[0]->uri);
		$file = str_replace(" ", "%20", $file);
		$fileUrl = IMG_FILE_PATH.$file;
		return $fileUrl;	
	}

	public function addImagefromFile($file_id,$x,$y,$oWidth,$oHeight)
	{
		$fileDetails = $this->read('file_managed'," AND fid='{$file_id}'");
		if(empty($fileDetails)){ return; }
		$file = str_replace("public://", "", $fileDetails[0]->uri);
		$file = str_replace(" ", "%20", $file);
		$fileUrl = IMG_FILE_PATH.$file;
		//die($fileUrl);
		//echo $fileUrl;
		
		$size = getimagesize($fileUrl);
		if($size<1){
			return;
		}
		$ratio = $size[0]/$size[1]; // width/height
		
		    $width = $oHeight*$ratio;
		    $height = $oHeight;
		
		$src = imagecreatefromstring(file_get_contents($fileUrl));
		$dst = imagecreatetruecolor($width,$height);
		imagealphablending( $dst, false );
		imagesavealpha( $dst, true );

		imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
		imagedestroy($src);



	
		imagecopy($this->jpg_image, $dst, $x, $y, 0, 0, $width, $height);
		return;
	}

	

	public function printText($text,$font_size,$x,$y,$spacing=0,$characters=50,$lineHeight=70)
	{
		//Text color
		$text_color = imagecolorallocate($this->jpg_image, 0, 0, 0);
		//Font
		$font_path = ROOT."user_subs/fonts/OpenSans-Semibold.ttf";
		// Print Text On Image
		$words = explode("\n", wordwrap ( $text, $characters));
		//print_r($words);
		$start = $y;
		foreach ($words as $key => $line) {
			if($spacing<1)
			{
				imagettftext($this->jpg_image, $font_size, 0, $x, $start, $text_color, $font_path, $line);	
			}else
			{
				for($i=0;$i<=strlen($line);$i++)
				{
					$print_text=substr($line,$i,1);
					$x+=$spacing;
					imagettftext($this->jpg_image, $font_size, 0, $x, $start, $text_color, $font_path, $print_text);
				}	
			}
			$start = $start + $lineHeight;
		}
			
		
		
	}

	public function getWebForms($lastId=0,$list=NULL,$limit = 1)
	{
		
		//$list = "3";
		if($list){
			$sql="SELECT A.sid,A.nid,A.completed,B.title FROM webform_submissions AS A LEFT JOIN node as B ON A.nid = B.nid ".
			" WHERE A.sid > '{$lastId}' AND A.nid IN ($list) LIMIT $limit";	
		}else{
			$sql="SELECT A.sid,A.nid,A.completed,B.title FROM webform_submissions AS A LEFT JOIN node as B ON A.nid = B.nid ".
			" WHERE A.sid > '{$lastId}'  LIMIT $limit";
		}
		
		$entries=$this->execute($sql);
		
		$datas = array();
		$worksheetPos = array();
		$pos = 0;
		foreach ($entries as $key => $entry) 
		{

			$sql="SELECT B.form_key,B.name,A.data,A.cid FROM webform_submitted_data AS A  ".
				"JOIN webform_component as B ON A.cid = B.cid AND A.nid = B.nid ".
				" WHERE A.sid = '{$entry->sid}'  ";
			
			$stracturedData = array();
			$formDatas = $this->execute($sql);

			foreach ($formDatas as $key => $formData) {
				$stracturedData[$formData->form_key][] = $formData->data;
			}
			$pos = array_search($entry->nid, $worksheetPos);
			
			if(is_numeric($pos)){
				echo "Did Nothing-";
			}else{
				$worksheetPos[] = $entry->nid;
			}
			$pos = array_search($entry->nid, $worksheetPos);
			
			$datas[] = array(
						'title'=>$entry->title,
						'pos' => $pos,
						'sid'=>$entry->sid,
						'nid'=>$entry->nid,
						'date'=>$entry->completed,
						'data' => $stracturedData
						);
		}
		//echo "<pre>";
		//print_r($datas);
		return $datas;
	}

	

	public function getLastId()
	{	
		$myfile = fopen(ROOT."user_subs/position.txt", "r") or die("Unable to open file!");
		$last =  fgets($myfile);
		fclose($myfile);
		//die($last);
		return $last;
	}
}

?>
