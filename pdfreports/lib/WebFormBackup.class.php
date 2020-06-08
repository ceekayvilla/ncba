<?php
class WebForm extends General{
	public $jpg_image;

	public function generatePDF()
	{
	
		//get lastID
		$lastId = $this->getLastId();

//		die("Last-".$lastId);
		//get new content after last id
		$list = "5,6,4,2,1,20,3,24,37";
		//$list = "1";
		echo "---";
		$datas = $this->getWebForms($lastId,$list);
		//loop through data and choose GD template
		foreach ($datas as $key => $data) {
			switch($data['nid'])
			{
				case '1':
				//personal / joint account
				$this->generatePersonalJoint($data);
				//generate acount activation image
				$images = array(
							ROOT."user_subs/created_image/personal_joint_1_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/personal_joint_2_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/personal_joint_3_".$data['sid'].".jpg",
							// ROOT."user_subs/created_image/personal_joint_4_".$data['sid'].".jpg",
							// ROOT."user_subs/created_image/personal_joint_5_".$data['sid'].".jpg",
							// ROOT."user_subs/created_image/personal_joint_6_".$data['sid'].".jpg",
							// ROOT."user_subs/created_image/personal_joint_7_".$data['sid'].".jpg",
							// ROOT."user_subs/created_image/personal_joint_8_".$data['sid'].".jpg"
							);
				$this->convertToPdf($images,$data['sid']);
				//exit;
				$subject = "Personal/Joint Account";
				$content = "Please find attached entry for personal/join account";
				//convert it to pdf
				//send and email to co-op
				break;

				case '2':
				//diaspora individual/joint mortgage
				$this->generateDiasporaMortgage($data);

				//$this->printText(strtoupper($data['data']['second_mortgage_area_of_land_2'][0]),20,855,690);

				//generate acount activation image
				$images = array(
								ROOT."user_subs/created_image/joint_mortgage_1_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/joint_mortgage_2_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/joint_mortgage_3_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/joint_mortgage_4_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/joint_mortgage_5_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/joint_mortgage_6_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/joint_mortgage_7_".$data['sid'].".jpg"
								);
				//convert it to pdf
				$this->convertToPdf($images,$data['sid']);
				$subject = "Diaspora Individual/Joint mortgage form";
				$content = "Please find attached entry for individual/joint mortgage form";
				//send and email to co-op
				break;
        
				case '3':
				$this->generateBusinessAccount($data);
				

				$images = array(ROOT."user_subs/created_image/business_account_1_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/business_account_2_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/business_account_3_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/business_account_4_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/business_account_5_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/business_account_6_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/business_account_7_".$data['sid'].".jpg",
								ROOT."user_subs/created_image/business_account_8_".$data['sid'].".jpg"
								);
				$this->convertToPdf($images,$data['sid']);
				
				$subject = "Business Account";
				$content = "Please find attached entry for business account";

				echo "<pre>";
				print_r($data);
				//business / enterprise account
				//generate acount activation image
				//convert it to pdf
				//send and email to co-op
				break;

				case '4':
				//change of contact details
				//generate acount activation image
				$this->generateChangeContact($data);
				$images = array(
							ROOT."user_subs/created_image/change_contact_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/change_contact_2_".$data['sid'].".jpg",
							);
				$this->convertToPdf($images,$data['sid']);
				$subject = "Change of contact details";
				$content = "Please find attached entry for change of contact details form";
				//convert it to pdf
				//send and email to co-op
				break;

				case '5':
				//acount activation
				//generate acount activation image
                $this->generateAccountActivation($data);
				//convert it to pdf
				$images = array( ROOT."user_subs/created_image/account_activation_".$data['sid'].".jpg",
									ROOT."user_subs/created_image/account_activation_2_".$data['sid'].".jpg");
				$this->convertToPdf($images,$data['sid']);
				$subject = "General activation form";
				$content = "Please find attached entry for general activation form";
				//send and email to co-op
				break;

				case '6':
				//fixed and call deposit
				//generate acount activation image
				$this->generateFixedCallImage($data);
				//convert it to pdf
				$images = array( 
							ROOT."user_subs/created_image/user_image_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/user_image_2_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/user_image_3_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/user_image_4_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/user_image_5_".$data['sid'].".jpg"
							);
				$this->convertToPdf($images,$data['sid']);
				$subject = "Fixed and Call Deposit form";
				$content = "Please find attached entry for fixed and call deposit form";

				//send and email to co-op
				break;

				case '7':
				echo "<pre>";
				print_r($data);
				//general details - no template and not needed
				break;

				case '20':
				//internet banking application
				$this->generateInternetBanking($data);
				$images = array(
							ROOT."user_subs/created_image/internet_banking_1_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/internet_banking_2_".$data['sid'].".jpg"
							);
				$this->convertToPdf($images,$data['sid']);
				$subject = "Internet banking form";
				$content = "Please find attached entry for internet banking form";
				//generate acount activation image
				//convert it to pdf
				//send and email to co-op
				break;

				case '24':
				$this->generateIndemnity($data);
				$images = array(
							ROOT."user_subs/created_image/indemnity_form_1_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/indemnity_form_2_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/indemnity_form_3_".$data['sid'].".jpg"
							);
				$this->convertToPdf($images,$data['sid']);
				$subject = "Indemnity form";
				$content = "Please find attached entry for indemnity form";
				break;

				case '37':
				$this->generateTaxpayerPIN($data);
				$images = array(
							ROOT."user_subs/created_image/taxpayer_pin_1_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/taxpayer_pin_2_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/taxpayer_pin_3_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/taxpayer_pin_4_".$data['sid'].".jpg",
							ROOT."user_subs/created_image/taxpayer_pin_5_".$data['sid'].".jpg"
							);
				$this->convertToPdf($images,$data['sid']);
				$subject = "Request for Taxpayer Identification Number and Certification";
				$content = "Please find attached entry ";
				

			}
			
			
			$attachment = ROOT."user_subs/created_pdf/pdf_".$data['sid'].".pdf";
			$this->sendPHPMail($attachment,$subject,$content);


			$myfile = fopen(ROOT."user_subs/position.txt", "w") or die("Unable to open file!");
			
			fwrite($myfile, $data['sid']);
			fclose($myfile);
			
		}

	}

	public function generateTaxpayerPIN($data)
	{
		// echo "<pre>";
		// print_r($data);
		// exit;

		$originalPath = ROOT."user_subs/original/taxpayer_pin/1.jpg";
		$storePath = ROOT."user_subs/created_image/taxpayer_pin_1_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper($data['data']['full_name'][0]),20,200,288);
		$this->printText(strtoupper($data['data']['business_name'][0]),20,200,362);

		if($data['data']['federal_tax_classification'][0]=="1"){ 
			$start=396; 
		}elseif($data['data']['federal_tax_classification'][0]=="2"){ 
			$start=454; 
		}elseif($data['data']['federal_tax_classification'][0]=="3"){ 
			$start=510; 
		}else{ $start= 999999; }
		$this->addTick(184,$start);

		if($data['data']['individual_classification'][0]=="1"){ 
			$start=478; 
		}elseif($data['data']['individual_classification'][0]=="2"){ 
			$start=678; 
		}elseif($data['data']['individual_classification'][0]=="3"){ 
			$start=874; 
		}elseif($data['data']['individual_classification'][0]=="4"){ 
			$start=1060; 
		}else{ $start= 999999; }
		$this->addTick($start,364);


		$this->printText(strtoupper($data['data']['limited_company_classification'][0]),20,1148,494);
		$this->printText(strtoupper($data['data']['other'][0]),20,448,558);

		$this->printText(strtoupper($data['data']['exempt_payee_code'][0]),20,1510,464);
		$this->printText(strtoupper($data['data']['exemption_from_fatca_reporting_code'][0]),20,1392,528);

		$this->printText(strtoupper($data['data']['requesters_name_and_address_optional'][0]),20,1094,676);

		$this->printText(strtoupper($data['data']['address_number_street_and_apt_or_suite_no'][0]),20,172,624);
		$this->printText(strtoupper($data['data']['city_state_and_zip_code'][0]),20,172,694);
		$this->printText(strtoupper($data['data']['list_account_numbers_here_optional'][0]),20,172,762);

		$tin_1 = substr($data['data']['social_security_number'][0], 0,3);
		$tin_2 = substr($data['data']['social_security_number'][0], 3,2);
		$tin_3 = substr($data['data']['social_security_number'][0], 5,4);

		$this->printText(strtoupper($tin_1),20,1120,886,43);
		$this->printText(strtoupper($tin_2),20,1280,886,43);
		$this->printText(strtoupper($tin_3),20,1402,886,43);

		$emp_tin_1 = substr($data['data']['employer_identification_number'][0], 0,2);
		$emp_tin_2 = substr($data['data']['employer_identification_number'][0], 2,7);
		$this->printText(strtoupper($emp_tin_1),20,1118,1020,43);
		$this->printText(strtoupper($emp_tin_2),20,1242,1020,42);



		$this->addImagefromFile($data['data']['signature_of_us_person'][0],352,1436,688,60);
		$this->printText(strtoupper($data['data']['date'][0]),20,1134,1484);



		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/taxpayer_pin/2.jpg";
		$storePath = ROOT."user_subs/created_image/taxpayer_pin_2_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/taxpayer_pin/3.jpg";
		$storePath = ROOT."user_subs/created_image/taxpayer_pin_3_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/taxpayer_pin/4.jpg";
		$storePath = ROOT."user_subs/created_image/taxpayer_pin_4_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/taxpayer_pin_5_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("Signature"),40,100,100);
			$this->addImagefromFile($data['data']['signature_of_us_person'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);
	}

	public function generateIndemnity($data){
		echo "<pre>";
		print_r($data);
		//exit;
		$originalPath = ROOT."user_subs/original/indemnity_form/1.jpg";
		$storePath = ROOT."user_subs/created_image/indemnity_form_1_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);


		$formatedDate = str_replace('/', '-', $data['data']['date'][0]);
		$this->printText(strtolower(date("j S",strtotime($formatedDate))),20,400,290);
		$this->printText(strtoupper(date("F",strtotime($formatedDate))),20,612,290);
		$this->printText(strtoupper(date("y",strtotime($formatedDate))),20,872,290);
		$this->printText(strtoupper($data['data']['application_by'][0]),20,1070,290);

		$this->printText(strtoupper($data['data']['i_we'][0]),20,88,704);
		$this->printText(strtoupper($data['data']['of_account_number'][0]),20,860,702);

		$this->printText(strtoupper($data['data']['titled'][0]),20,34,744);

		$this->printText(strtoupper($data['data']['email_address'][0]),20,270,1412);
		$this->printText(strtoupper($data['data']['bank'][0]),20,270,1450);
		$this->printText(strtoupper($data['data']['branch'][0]),20,270,1490);
		$this->printText(strtoupper($data['data']['account_number'][0]),20,270,1528);
		$this->printText(strtoupper($data['data']['account_name'][0]),20,270,1564);


		$this->printText(strtoupper($data['data']['dated_name'][0]),20,200,1836);
		$this->printText(strtoupper($data['data']['dated_account_number'][0]),20,240,1894);
		$this->printText(strtoupper($data['data']['dated_id_number'][0]),20,774,1894);

		$this->addImagefromFile($data['data']['dated_signed'][0],132,1904,484,80);
		$formatedDate = str_replace('/', '', $data['data']['date'][1]);
		$this->printText(strtoupper($formatedDate),20,652,1964,42);

		$this->printText(strtoupper($data['data']['witnessed_by_name'][0]),20,240,2014);

		$this->printText(strtoupper($data['data']['address_of_witness_p_o_box'][0]),20,354,2076);
		$this->printText(strtoupper($data['data']['witness_postal_code'][0]),20,768,2076);
		$this->printText(strtoupper($data['data']['witness_town'][0]),20,1002,2076);

		$this->printText(strtoupper($data['data']['witness_registration_number'][0]),20,274,2134);
		$this->addImagefromFile($data['data']['witness_official_stamp'][0],1038,2088,588,264);

		$this->addImagefromFile($data['data']['witness_signature'][0],150,2146,480,188);
		$formatedDate = str_replace('/', '', $data['data']['witness_date_'][0]);
		$this->printText(strtoupper($formatedDate),20,652,2210,42);


		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/indemnity_form_2_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("Official Stamp"),40,100,100);
			$this->addImagefromFile($data['data']['witness_official_stamp'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/indemnity_form_3_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("Witness Signature"),40,100,100);
			$this->addImagefromFile($data['data']['witness_signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		


	}

	public function generateBusinessAccount($data)
	{
		echo "<pre>";
		// print_r($data);
		// exit;
		$originalPath = ROOT."user_subs/original/business_account/1.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_1_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper(date("dmY",$data['date'])),20,1297,303,42);

		$this->printText(strtoupper($data['data']['account_name'][0]),20,237,440);

		if($data['data']['type_of_account'][0]=="Sole Proprietorship"){ 
			$start=61; 
		}elseif($data['data']['type_of_account'][0]=="Partnership"){ 
			$start=387; 
		}elseif($data['data']['type_of_account'][0]=="Company"){ 
			$start=590; 
		}elseif($data['data']['type_of_account'][0]=="Society"){ 
			$start=762; 
		}elseif($data['data']['type_of_account'][0]=="Government"){ 
			$start=930; 
		}elseif($data['data']['type_of_account'][0]=="Groups"){ 
			$start=1195; 
		}elseif($data['data']['type_of_account'][0]=="NGO"){ 
			$start=1403; 
		}else{ $start= 999999; }
		$this->addTick($start,512);


		if($data['data']['account_currency'][0]=="KES"){ 
			$start=1324; 
		}elseif($data['data']['account_currency'][0]=="USD"){ 
			$start=1557; 
		}else{ $start= 999999; }
		$this->addTick($start,629);

		if($data['data']['account_currency'][0]=="GBP"){ 
			$start=1324; 
		}elseif($data['data']['account_currency'][0]=="EURO"){ 
			$start=1557; 
		}else{ $start= 999999; }
		$this->addTick($start,686);

		$this->printText(strtoupper($data['data']['business_address'][0]),20,270,834);

		$this->printText(strtoupper($data['data']['zip__postal_code'][0]),20,250,894);
		$this->printText(strtoupper($data['data']['city_town'][0]),20,1000,894);

		$this->printText(strtoupper($data['data']['country'][0]),20,162,952);
		$this->printText(strtoupper($data['data']['c_o_where_available'][0]),20,1122,952);

		$this->printText(strtoupper($data['data']['business_telephone'][0]),20,274,1010);
		$this->printText(strtoupper($data['data']['business_email'][0]),20,950,1010);

		$this->printText(strtoupper($data['data']['nature_of_business'][0]),20,278,1065);

		$this->printText(strtoupper(str_replace("/", "", $data['data']['date_of_incorporation___registration'][0])),20,414,1124,42);
		$this->printText(strtoupper($data['data']['certificate_of_incorporation_number'][0]),10,1182,1124);
		$this->printText(strtoupper($data['data']['business_kra_pin'][0]),20,1404,1124);

		$this->printText(strtoupper($data['data']['associated_companies'][0]),20,333,1185);
		$this->printText(strtoupper($data['data']['country_of_incorporation___registration'][0]),20,1208,1185);		

		$this->printText(strtoupper($data['data']['source_of_funds'][0]),15,250,1240);
		if($data['data']['business_income_range'][0]=="0-50,000"){ 
			$start=926; 
		}elseif($data['data']['business_income_range'][0]=="50,000 - 200,000"){ 
			$start=1235; 
		}elseif($data['data']['business_income_range'][0]=="200,000 and above"){ 
			$start=1520; 
		}else{ $start= 999999; }
		$this->addTick($start,1202);

		$this->printText(strtoupper($data['data']['other_bank_name_1'][0]),20,208,1360);
		$this->printText(strtoupper($data['data']['other_bank_branch_1'][0]),20,660,1360);
		$this->printText(strtoupper($data['data']['other_bank_account_number_1'][0]),20,1265,1360);

		
		$this->printText(strtoupper($data['data']['1st_sig_title'][0]),20,300,1550);
		$this->printText(strtoupper($data['data']['1st_sig_first_name'][0]),20,670,1550);
		$this->printText(strtoupper($data['data']['1st_sig_middle_name'][0]),20,970,1550);
		$this->printText(strtoupper($data['data']['1st_sig_last_name'][0]),20,1270,1550);

		$this->printText(strtoupper($data['data']['1st_sig_kenyan_id'][0]),20,130,1623);
		$this->printText(strtoupper($data['data']['1st_sig_passport_number'][0]),20,695,1623);
		$this->printText( str_replace("/", "", strtoupper($data['data']['1st_sig_date_of_birth'][0])),20,1180,1602,42);

		$this->printText(strtoupper($data['data']['1st_sig_country_of_birth'][0]),20,230,1695);
		$this->printText(strtoupper($data['data']['1st_sig_nationality'][0]),20,730,1695);
		$this->printText(strtoupper($data['data']['1st_sig_country_of_residence'][0]),20,1130,1695);

		$this->printText(strtoupper($data['data']['1st_sig_house_number__street'][0]),20,280,1752);

		$this->printText(strtoupper($data['data']['1st_sig_zip_postal_code'][0]),20,250,1809);
		$this->printText(strtoupper($data['data']['1st_sig_city_town'][0]),20,790,1809);

		$this->printText(strtoupper($data['data']['1st_sig_mobile_number'][0]),20,250,1866);
		$this->printText(strtoupper($data['data']['1st_sig_other_number'][0]),20,790,1866);

		$this->printText(strtoupper($data['data']['1st_sig_email'][0]),20,150,1925);

		$this->printText(strtoupper($data['data']['1st_sig_employer_name'][0]),20,665,1983);

		$this->printText(strtoupper($data['data']['1st_sig_employer_address'][0]),20,300,2037);

		// $this->printText(strtoupper($data['data']['2nd_sig_employer_zip'][0]),20,245,1541);
		// $this->printText(strtoupper($data['data']['2nd_sig_employer_city_town'][0]),20,682,1541);
		// $this->printText(strtoupper($data['data']['2nd_sig_employer_tel'][0]),20,1222,1541);

		$this->printText(strtoupper($data['data']['1st_sig_other_account_name'][0]),20,233,2210);
		$this->printText(strtoupper($data['data']['1st_sig_other_branch'][0]),20,750,2210);
		$this->printText(strtoupper($data['data']['1st_sig_other_account_number'][0]),20,1360,2210);

		$this->printText(strtoupper($data['data']['other_bank_name_2'][0]),20,228,2262);
		$this->printText(strtoupper($data['data']['other_bank_branch_2'][0]),20,790,2262);
		$this->printText(strtoupper($data['data']['other_bank_account_number_2'][0]),20,1355,2262);

		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);



		/* PAGE 2 */
		$originalPath = ROOT."user_subs/original/business_account/2.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_2_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->addImagefromFile($data['data']['1st_sig_applicant_signature'][0],135,290,500,130);
		//Sabato asked to remove this $this->addImagefromFile($data['data']['1st_sig_authentication_signature'][0],700,290,500,130);
		$this->addImagefromFile($data['data']['1st_sig_passport_picture'][0],1210,220,400,200);


		if($data['data']['1st_signature_statement'][0]=="1"){ 
			//add signature and date
			$start=795; 
		}else{ $start= 1254; }
		$this->addTick($start,438);

		if($data['data']['1st_sig_register_for_internet_banking'][0]=="1"){ 
			//add signature and date
			$this->addImagefromFile($data['data']['1st_sig_applicant_signature'][0],327,621,500,90);
			$this->printText(strtoupper(date("dmY",$data['date'])),20,940,669,41);

			if($data['data']['1st_signature_statement'][0]=="1"){ 
			//add signature and date
				$start=774; 
			}else{ $start= 1128; }
			$this->addTick($start,825);
		}
		
		


		$this->printText(strtoupper($data['data']['2nd_sig_title'][0]),20,300,995);
		$this->printText(strtoupper($data['data']['2nd_sig_first_name'][0]),20,670,995);
		$this->printText(strtoupper($data['data']['2nd_sig_middle_name'][0]),20,970,995);
		$this->printText(strtoupper($data['data']['2nd_sig_last_name'][0]),20,1270,995);

		$this->printText(strtoupper($data['data']['2nd_sig_kenyan_id'][0]),20,130,1070);
		$this->printText(strtoupper($data['data']['2nd_sig_passport_number'][0]),20,695,1070);
		$this->printText( str_replace("/", "", strtoupper($data['data']['2nd_sig_date_of_birth'][0])),20,1180,1046,42);

		$this->printText(strtoupper($data['data']['2nd_sig_country_of_birth'][0]),20,230,1140);
		$this->printText(strtoupper($data['data']['2nd_sig_nationality'][0]),20,730,1140);
		$this->printText(strtoupper($data['data']['2nd_sig_country_of_residence'][0]),20,1130,1140);

		$this->printText(strtoupper($data['data']['2nd_sig_house_number__street'][0]),20,280,1195);

		$this->printText(strtoupper($data['data']['2nd_sig_zip_postal_code'][0]),20,250,1250);
		$this->printText(strtoupper($data['data']['2nd_sig_city_town'][0]),20,790,1250);

		$this->printText(strtoupper($data['data']['2nd_sig_mobile_number'][0]),20,250,1306);
		$this->printText(strtoupper($data['data']['2nd_sig_other_number'][0]),20,790,1306);

		$this->printText(strtoupper($data['data']['2nd_sig_email'][0]),20,150,1363);

		$this->printText(strtoupper($data['data']['2nd_sig_employer_name'][0]),20,665,1420);

		$this->printText(strtoupper($data['data']['2nd_sig_employer_address'][0]),20,300,1475);

		// $this->printText(strtoupper($data['data']['2nd_sig_employer_zip'][0]),20,245,1541);
		// $this->printText(strtoupper($data['data']['2nd_sig_employer_city_town'][0]),20,682,1541);
		// $this->printText(strtoupper($data['data']['2nd_sig_employer_tel'][0]),20,1222,1541);

		$this->printText(strtoupper($data['data']['2nd_sig_other_account_name'][0]),20,233,1652);
		$this->printText(strtoupper($data['data']['2nd_sig_other_branch'][0]),20,750,1652);
		$this->printText(strtoupper($data['data']['2nd_sig_other_account_number'][0]),20,1360,1652);


		$this->addImagefromFile($data['data']['2nd_sig_applicant_signature'][0],70,1790,500,130);
		$this->addImagefromFile($data['data']['2nd_sig_passport_picture'][0],1176,1737,400,200);


		if($data['data']['2nd_signature_statement'][0]=="1"){ 
			//add signature and date
			$start=795; 
		}else{ $start= 1254; }
		$this->addTick($start,1950);

		if($data['data']['2nd_sig_register_for_internet_banking'][0]=="1"){ 
			//add signature and date
			$this->addImagefromFile($data['data']['2nd_sig_applicant_signature'][0],327,2118,500,90);
			$this->printText(strtoupper(date("dmY",$data['date'])),20,940,2160,41);

			if($data['data']['2nd_signature_statement'][0]=="1"){ 
			//add signature and date
				$start=774; 
			}else{ $start= 1128; }
			$this->addTick($start,2313);
		}





		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		/* PAGE 3 */
		$originalPath = ROOT."user_subs/original/business_account/3.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_3_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper($data['data']['3rd_sig_title'][0]),20,92,344);
		$this->printText(strtoupper($data['data']['3rd_sig_first_name'][0]),20,676,1652);
		$this->printText(strtoupper($data['data']['3rd_sig_middle_name'][0]),20,972,1652);
		$this->printText(strtoupper($data['data']['3rd_sig_last_name'][0]),20,1280,1652);

		$this->printText(strtoupper($data['data']['3rd_sig_kenyan_id'][0]),20,172,412);
		$this->printText(strtoupper($data['data']['3rd_sig_passport_number'][0]),20,676,412);
		$this->printText(strtoupper($data['data']['3rd_sig_date_of_birth'][0]),20,1174,388,42);

		$this->printText(strtoupper($data['data']['3rd_sig_country_of_birth'][0]),20,244,480);
		$this->printText(strtoupper($data['data']['3rd_sig_nationality'][0]),20,730,480);
		$this->printText(strtoupper($data['data']['3rd_sig_country_of_residence'][0]),20,1176,480);

		$this->printText(strtoupper($data['data']['3rd_sig_house_number__street'][0]),20,276,532);

		$this->printText(strtoupper($data['data']['3rd_sig_zip_postal_code'][0]),20,248,580);
		$this->printText(strtoupper($data['data']['3rd_sig_city_town'][0]),20,788,580);

		$this->printText(strtoupper($data['data']['3rd_sig_mobile_number'][0]),20,236,624);
		$this->printText(strtoupper($data['data']['3rd_sig_other_number'][0]),20,820,624);

		$this->printText(strtoupper($data['data']['3rd_sig_email'][0]),20,153,676);

		$this->printText(strtoupper($data['data']['3rd_sig_employer_name'][0]),20,656,720);

		$this->printText(strtoupper($data['data']['3rd_sig_employer_address'][0]),20,300,768);

		// $this->printText(strtoupper($data['data']['3rd_sig_employer_zip'][0]),20,245,1541);
		// $this->printText(strtoupper($data['data']['3rd_sig_employer_city_town'][0]),20,682,1541);
		// $this->printText(strtoupper($data['data']['3rd_sig_employer_tel'][0]),20,1222,1541);


		$this->printText(strtoupper($data['data']['3rd_sig_other_account_name'][0]),20,240,908);
		$this->printText(strtoupper($data['data']['3rd_sig_other_branch'][0]),20,300,908);
		$this->printText(strtoupper($data['data']['3rd_sig_other_account_number'][0]),20,300,908);

		// $this->addImagefromFile($data['data']['3rd_sig_applicant_signature'][0],220,1036,500,130);
		// $this->addImagefromFile($data['data']['3rd_sig_authentication_signature'][0],770,1036,500,130);
		// $this->addImagefromFile($data['data']['3rd_sig_passport_picture'][0],1260,972,400,200);


		$this->printText(strtoupper($data['data']['4th_sig_title'][0]),20,192,1715);
		$this->printText(strtoupper($data['data']['4th_sig_first_name'][0]),20,664,1715);
		$this->printText(strtoupper($data['data']['4th_sig_middle_name'][0]),20,960,1715);
		$this->printText(strtoupper($data['data']['4th_sig_last_name'][0]),20,1265,1715);

		$this->printText(strtoupper($data['data']['4th_sig_kenyan_id'][0]),20,164,1791);
		$this->printText(strtoupper($data['data']['4th_sig_passport_number'][0]),20,676,1791);
		$this->printText(strtoupper($data['data']['4th_sig_date_of_birth'][0]),20,1180,1763,42);

		$this->printText(strtoupper($data['data']['4th_sig_country_of_birth'][0]),20,244,1863);
		$this->printText(strtoupper($data['data']['4th_sig_nationality'][0]),20,730,1863);
		$this->printText(strtoupper($data['data']['4th_sig_country_of_residence'][0]),20,1176,1863);

		$this->printText(strtoupper($data['data']['4th_sig_house_number__street'][0]),20,276,1919);

		$this->printText(strtoupper($data['data']['4th_sig_zip_postal_code'][0]),20,248,1970);
		$this->printText(strtoupper($data['data']['4th_sig_city_town'][0]),20,788,1970);

		$this->printText(strtoupper($data['data']['4th_sig_mobile_number'][0]),20,236,2030);
		$this->printText(strtoupper($data['data']['4th_sig_other_number'][0]),20,820,2030);

		$this->printText(strtoupper($data['data']['4th_sig_email'][0]),20,153,2087);

		$this->printText(strtoupper($data['data']['4th_sig_employer_name'][0]),20,656,2155);

		$this->printText(strtoupper($data['data']['4th_sig_employer_address'][0]),20,300,2199);

		// $this->printText(strtoupper($data['data']['4th_sig_employer_zip'][0]),20,245,1541);
		// $this->printText(strtoupper($data['data']['4th_sig_employer_city_town'][0]),20,682,1541);
		// $this->printText(strtoupper($data['data']['4th_sig_employer_tel'][0]),20,1222,1541);


		









		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


		/* PAGE 4*/
		$originalPath = ROOT."user_subs/original/business_account/4.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_4_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper($data['data']['4th_sig_other_account_name'][0]),20,240,264);
		$this->printText(strtoupper($data['data']['4th_sig_other_branch'][0]),20,300,264);
		$this->printText(strtoupper($data['data']['4th_sig_other_account_number'][0]),20,300,264);

		// $this->addImagefromFile($data['data']['3rd_sig_applicant_signature'][0],220,1036,500,130);
		// $this->addImagefromFile($data['data']['3rd_sig_authentication_signature'][0],770,1036,500,130);
		// $this->addImagefromFile($data['data']['3rd_sig_passport_picture'][0],1260,972,400,200);

		if($data['data']['signature_options'][0]=="Anyone"){ 
			$start=204; 
		}elseif($data['data']['signature_options'][0]=="Any Two"){ 
			$start=565; 
		}elseif($data['data']['signature_options'][0]=="Any Three"){ 
			$start=892; 
		}elseif($data['data']['signature_options'][0]=="Any Four"){ 
			$start=1176; 
		}elseif($data['data']['signature_options'][0]=="All to sign"){ 
			$start=1488; 
		}else{ $start= 999999; }
		$this->addTick($start,1024);

		$disclaimer_date = explode("/",$data['data']['disclaimer_date'][0]);


		$this->printText(strtoupper($disclaimer_date[0]),20,244,1416);
		$this->printText(strtoupper($disclaimer_date[1]),20,452,1416);
		$this->printText(strtoupper($disclaimer_date[2]),20,630,1416);

		// $this->addImagefromFile($data['data']['1st_signatory_picture'][0],352,1432,628,64);
		// $this->addImagefromFile($data['data']['2nd_signatory_picture'][0],1136,1432,628,64);
		// $this->addImagefromFile($data['data']['3rd_signatory_picture'][0],352,1512,628,64);
		// $this->addImagefromFile($data['data']['4th_signatory_picture'][0],1136,1512,628,64);

		$this->addImagefromFile($data['data']['1st_sig_applicant_signature'][0],340,1416,500,90);
		$this->addImagefromFile($data['data']['2nd_sig_applicant_signature'][0],1136,1416,500,90);
		$this->addImagefromFile($data['data']['3rd_sig_applicant_signature'][0],340,1504,500,90);
		$this->addImagefromFile($data['data']['4th_sig_applicant_signature'][0],1136,1504,500,90);



		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_5_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("1st Applicant Signature"),40,100,100);
			$this->addImagefromFile($data['data']['1st_sig_applicant_signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_6_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("1st Applicant Picture"),40,100,100);
			$this->addImagefromFile($data['data']['1st_sig_passport_picture'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_7_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("2nd Applicant Signature"),40,100,100);
			$this->addImagefromFile($data['data']['2nd_sig_applicant_signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_8_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("2nd Applicant Picture"),40,100,100);
			$this->addImagefromFile($data['data']['2nd_sig_passport_picture'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		

	}

	public function generatePersonalJoint($data)
	{
		echo "<pre>";
		print_r($data);
		
		$originalPath = ROOT."user_subs/original/personal_joint/1.jpg";
		$storePath = ROOT."user_subs/created_image/personal_joint_1_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper($data['data']['branch'][0]),11,114,193);
		$date = str_replace("/", "", $data['data']['date'][0]);
		$this->printText(strtoupper($date),11,689,193,20);
		$start=999999999;
		$this->printText(strtoupper($data['data']['account_name'][0]),11,144,319);
		if($data['data']['account_type'][0]=="Personal"){ $start=588; }
		if($data['data']['account_type'][0]=="Joint"){ $start=745; }
		$this->addTick($start,281);

		$start=999999999;
		if($data['data']['product_name'][0]=="1"){ $start=364; }
		if($data['data']['product_name'][0]=="2"){ $start=399; }
		if($data['data']['product_name'][0]=="3"){ $start=433; }
		$this->addTick(11,$start);

		$start=999999999;
		foreach($data['data']['currency'] as $currency){
			switch ($currency) {
				case 'KSHS':
						$start=632;
						$height = 363 ;			
					break;

				case 'USD':
						$start=749;
						$height = 363;			
					break;

				case 'GBP':
						$start= 639;
						$height = 435;			
					break;

				case 'EURO':
						$start=441;
						$height = 752;			
					break;
				
				default:
					$start=99999999999;
					$height = 99999999999;
					break;
			}
			$this->addTick($start,$height);
		}
		if($data['data']['purpose_of_account'][0]=="1"){ $start=169; }
		if($data['data']['purpose_of_account'][0]=="2"){ $start=296; }
		if($data['data']['purpose_of_account'][0]=="3"){ $start=401; }
		if($data['data']['purpose_of_account'][0]=="4"){ $start=495; }
		if($data['data']['purpose_of_account'][0]=="5"){ $start=604; }
		if($data['data']['purpose_of_account'][0]=="6"){ $start=173; }
		$this->addTick($start,468);

        if($data['data']['debit_card_ordered'][0]=="Yes"){ $start=719; }
		if($data['data']['debit_card_ordered'][0]=="No"){ $start=785; }
		$this->addTick($start,550);

		// $this->printText(strtoupper($data['data']['first_applicant'][0]),20,300,726,40);


		$this->printText(strtoupper($data['data']['title'][0]),11,292,618);
		$this->printText(strtoupper($data['data']['applicant_first_name'][0]),11,99,680);
		$this->printText(strtoupper($data['data']['middle_name'][0]),11,295,680);
		$this->printText(strtoupper($data['data']['last_name'][0]),11,620,680);


		$this->printText(strtoupper($data['data']['kenya_id'][0]),11,20,757);
		$this->printText(strtoupper($data['data']['kra_pin'][0]),11,529,757);
		$this->printText(strtoupper($data['data']['passport_number'][0]),11,170,757);
		$date = str_replace("/", "", $data['data']['date_of_birth'][0]);
		$this->printText(strtoupper(date("dmY",strtotime($data['data']['date_of_birth'][0]))),11,650,754,25);

	    if($data['data']['marital_status'][0]=="1"){ $start=262; }
		if($data['data']['marital_status'][0]=="2"){ $start=390; }
		if($data['data']['marital_status'][0]=="3"){ $start=519; }
		if($data['data']['marital_status'][0]=="4"){ $start=661; }
		$this->addTick($start,766);
		$this->printText(strtoupper($data['data']['nationality'][0]),11,23,891);
		$this->printText(strtoupper($data['data']['other_nationality'][0]),11,298,891);
		$this->printText(strtoupper($data['data']['residence_country'][0]),11,605,891);
        $this->printText(strtoupper($data['data']['tax_identification___ni__ssn_no'][0]),11,229,928);
		$this->printText(strtoupper($data['data']['house_street'][0]),11,569,928);
		$this->printText(strtoupper($data['data']['zip_postal_address'][0]),11,119,963); 
		$this->printText(strtoupper($data['data']['first_applicant_city_town'][0]),11,393,963); 
		$this->printText(strtoupper($data['data']['first_applicant_mobile_number'][0]),11,129,997);
		$this->printText(strtoupper($data['data']['first_applicant_other_number'][0]),11,537,997);

		$this->printText(strtoupper($data['data']['first_applicant_email'][0]),11,98,1034);	

	    if($data['data']['source_of_income'][0]=="1"){ $start=41; }
		if($data['data']['source_of_income'][0]=="2"){ $start=214; }
		if($data['data']['source_of_income'][0]=="3"){ $start=380; }
		if($data['data']['source_of_income'][0]=="4"){ $start=497; }
		$this->addTick($start,1080);


		// employee

        $this->printText(strtoupper($data['data']['employer_name'][0]),11,103,1197);
        $this->printText(strtoupper($data['data']['employer_address'][0]),11,389,1197);
        $this->printText(strtoupper($data['data']['employee_office_tel_no'][0]),11,614,1197);
        $this->printText(strtoupper($data['data']['employee_job_title_role_position'][0]),11,391,1269);
        if($data['data']['terms_of_employment'][0]=="1"){ $start=195; }
		if($data['data']['terms_of_employment'][0]=="2"){ $start=279; }
		$this->addTick($start,1254);

         $this->printText(strtoupper($data['data']['employee_department_unit_section_division'][0]),11,609,1269);


      if($data['data']['source_of_income'][0]=="1")
       {
		if($data['data']['employee_average_monthly_income'][0]=="1"){ $start=335; }
		if($data['data']['employee_average_monthly_income'][0]=="2"){ $start=455; }
		if($data['data']['employee_average_monthly_income'][0]=="3"){ $start=581; }
		if($data['data']['employee_average_monthly_income'][0]=="4"){ $start=707; }
		if($data['data']['employee_average_monthly_income'][0]=="5"){ $start=807; }
		$this->addTick($start,1285);
	     }

         //business
        $this->printText(strtoupper($data['data']['self_employed_business_name'][0]),11,112,1364);
        $this->printText(strtoupper($data['data']['self_employed_nature_of_business'][0]),11,393,1364);
        $this->printText(strtoupper($data['data']['self_employed_business_reg__company_inc_number'][0]),11,614,1364);
        $this->printText(strtoupper($data['data']['self_employed_physical_address_of_business__location'][0]),11,112,1433);
        $this->printText(strtoupper($data['data']['self_employed_business_contact_name'][0]),11,393,1433);
        $this->printText(strtoupper($data['data']['self_employed_business_contact_name'][0]),11,614,1433);

         
       if($data['data']['source_of_income'][0]=="2")
       {
		if($data['data']['self_employed_estimated_monthly_sales_turnovers_kes_equivalent'][0]=="1"){ $start=374; }
		if($data['data']['self_employed_estimated_monthly_sales_turnovers_kes_equivalent'][0]=="2"){ $start=505; }
		if($data['data']['self_employed_estimated_monthly_sales_turnovers_kes_equivalent'][0]=="3"){ $start=642; }
		if($data['data']['self_employed_estimated_monthly_sales_turnovers_kes_equivalent'][0]=="4"){ $start=740; }
		if($data['data']['self_employed_estimated_monthly_sales_turnovers_kes_equivalent'][0]=="5"){ $start=812; }
		$this->addTick($start,1459);
	    }
		//student
        $this->printText(strtoupper($data['data']['student_name_of_university_college'][0]),11,103,1535);
        $this->printText(strtoupper($data['data']['student_admission_number'][0]),11,389,1535);
        $this->printText(strtoupper($data['data']['student_expected_completion_date'][0]),11,614,1535);
        
       if($data['data']['source_of_income'][0]=="3"){

			if($data['data']['student_estimated_monthly_deposits_kes_equivalent'][0]=="1"){ $start=335; }
			if($data['data']['student_estimated_monthly_deposits_kes_equivalent'][0]=="2"){ $start=455; }
			if($data['data']['student_estimated_monthly_deposits_kes_equivalent'][0]=="3"){ $start=581; }
			if($data['data']['student_estimated_monthly_deposits_kes_equivalent'][0]=="4"){ $start=707; }
			if($data['data']['student_estimated_monthly_deposits_kes_equivalent'][0]=="5"){ $start=807; }
			$this->addTick($start,1285);
	    }
		//other
		if($data['data']['source_of_income'][0]=="4")
		 {
			if($data['data']['other_income_est_monthly_deposits_kes_equivalent'][0]=="1"){ $start=335; }
			if($data['data']['other_income_est_monthly_deposits_kes_equivalent'][0]=="2"){ $start=455; }
			if($data['data']['other_income_est_monthly_deposits_kes_equivalent'][0]=="3"){ $start=581; }
			if($data['data']['other_income_est_monthly_deposits_kes_equivalent'][0]=="4"){ $start=707; }
			if($data['data']['other_income_est_monthly_deposits_kes_equivalent'][0]=="5"){ $start=807; }
			$this->addTick($start,1603);
	      }

		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


        //page 2
		$originalPath = ROOT."user_subs/original/personal_joint/2.jpg";
		$storePath = ROOT."user_subs/created_image/personal_joint_2_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper($data['data']['alternative_contact1_first_name'][0]),11,110,187);
		$this->printText(strtoupper($data['data']['alternative_contact1_middle_name'][0]),11,386,187);
		$this->printText(strtoupper($data['data']['alternative_contact1_last_name'][0]),11,636,187);
		$this->printText(strtoupper($data['data']['alternative_contact1_email'][0]),11,103,226);
		// $this->printText(strtoupper($data['data']['alternative_contact1_phone'][0]),16,636,226);
		$this->addImagefromFile($data['data']['alternative_contact1_signature'][0],117,295,50,50);

		if($data['data']['alternative_contact1_i_hereby_authorize_the_bank_to_contact_the_above_mention_if_we__we_unavailable'][0]=="1"){ $start=75; }
		$this->addTick($start,243);
		$this->printText(strtoupper(date("dmY",strtotime($data['data']['date_of_birth'][0]))),11,531,312,15);
		//next Of kin
		$this->printText(strtoupper($data['data']['next_of_kin_first_name'][0]),11,109,413);
		$this->printText(strtoupper($data['data']['next_of_kin_middle_name'][0]),11,441,413);
		$this->printText(strtoupper($data['data']['next_of_kin_last_name'][0]),11,699,413);
		$this->printText(strtoupper($data['data']['next_of_kin_house_no__street'][0]),11,109,470);
		$this->printText(strtoupper($data['data']['next_of_kin_zip___postal_code'][0]),11,441,470);
		$this->printText(strtoupper($data['data']['next_of_kin_city_town_state'][0]),11,699,470);
		$this->printText(strtoupper($data['data']['next_of_kin_id_no'][0]),11,109,536);
		$this->printText(strtoupper($data['data']['next_of_kin_passport_no'][0]),11,441,536);
		$this->printText(strtoupper($data['data']['	next_of_kin_relationship'][0]),11,699,536);

		$this->printText(strtoupper($data['data']['next_of_kin_email'][0]),11,117,617);

		//other accounts
		$this->printText(strtoupper($data['data']['other_accounts_coop_account_name'][0]),11,109,730);
		$this->printText(strtoupper($data['data']['other_accounts_coop_branch'][0]),11,441,730);
		$this->printText(strtoupper($data['data']['	other_account_account_number'][0]),11,699,730);

		$this->printText(strtoupper($data['data']['other_accounts_coop_account_name_other'][0]),11,109,801);
		$this->printText(strtoupper($data['data']['other_accounts_coop_branch_other'][0]),11,441,801);
		$this->printText(strtoupper($data['data']['other_accounts_coop_account_number_other'][0]),11,699,801);
        //Other accounts held with other banks
        $this->printText(strtoupper($data['data']['other_banks_account_name'][0]),11,58,901);
		$this->printText(strtoupper($data['data']['other_bank_accounts_bank'][0]),11,343,901);
		$this->printText(strtoupper($data['data']['	other_bank_accounts_branch'][0]),11,343,975);
		$this->printText(strtoupper($data['data']['other_bank_accounts_account_number'][0]),11,623,901);

		$this->printText(strtoupper($data['data']['other_banks_account_name2'][0]),11,58,1049);
		$this->printText(strtoupper($data['data']['other_bank_accounts_bank2'][0]),11,343,1049);
		$this->printText(strtoupper($data['data']['	other_bank_accounts_branch2'][0]),11,343,1121);
		$this->printText(strtoupper($data['data']['other_bank_accounts_account_number2'][0]),11,117,1049);

		//jumbo

		if($data['data']['jumbo_account_gender'][0]=="Female"){ $start=774; 
		}elseif($data['data']['jumbo_account_gender'][0]=="Male"){ $start=648; 
		}else{
			$start = 9999999999;
		}
		$this->addTick($start,1145);

		$this->printText(strtoupper($data['data']['jumbo_account_first_name'][0]),11,135,1197);
		$this->printText(strtoupper($data['data']['jumbo_account_middle_name'][0]),11,402,1197);
		$this->printText(strtoupper($data['data']['jumbo_account_last_name'][0]),11,687,1189);

		if($data['data']['jumbo_date_of_birth'][1])
		{
			$this->printText(strtoupper(date("dmY",strtotime($data['data']['jumbo_date_of_birth'][1]))),11,63,1226,15);	
		}
		$this->printText(strtoupper($data['data']['child_birth_certificate___notification_number'][0]),11,582,1230);


		if($data['data']['relationship_with_child'][0]){ $start=314; 
		}elseif($data['data']['guardian'][0]){ $start=421; 
		}else{ $start= 99999999; }
		$this->addTick($start,1253);

		$this->printText(strtoupper($data['data']['jumbo_other_relationship'][0]),11,138,1297);
		$this->addImagefromFile($data['data']['jumbo_junior_applicants_signature'][0],86,1487,100,100);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);
		//page 3
		$originalPath = ROOT."user_subs/original/personal_joint/3.jpg";
		$storePath = ROOT."user_subs/created_image/personal_joint_3_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);
		$this->printText(strtoupper($data['data']['internet_banking_services_account'][0]),11,214,225);
		$this->printText(strtoupper($data['data']['internet_banking_services_account_2'][0]),11,214,287);
		$this->printText(strtoupper($data['data']['internet_banking_services_account_3'][0]),11,214,347);
		$this->printText(strtoupper($data['data']['internet_banking_services_account_4'][0]),11,214,412);

        $this->addImagefromFile($data['data']['internet_banking_signatory_1'][0],116,528,50,50);
		$this->addImagefromFile($data['data']['internet_banking_signatory_2'][0],511,528,50,50);
		$this->addImagefromFile($data['data']['internet_banking_signatory_3'][0],116,600,50,50);
		$this->addImagefromFile($data['data']['internet_banking_signatory_4'][0],511,600,50,50);




		if($data['data']['internet_email_as_provided'][0]=="Yes"){ $start=452; }else{ $start = 999999999; }
		$this->addTick($start,698);

		if($data['data']['internet_banking_send_on_behalf'][0]=="Yes"){ $start=600; }else{ $start = 99999999999999999; }
		$this->addTick($start,698);


		if($data['data']['signing_instructions_options'][0]=="Sole"){ $start=42; }
		if($data['data']['signing_instructions_options'][0]=="Either"){ $start=178; }
		if($data['data']['signing_instructions_options'][0]=="Any Two"){ $start=335; }
		if($data['data']['signing_instructions_options'][0]=="Any Three"){ $start=484; }
		if($data['data']['signing_instructions_options'][0]=="All To Sign"){ $start=657; }
		$this->addTick($start,867);
		$this->addImagefromFile($data['data']['signing_instructions_options'][0],124,752,50,50);

		if($data['data']['frequency_statement'][0]=="1"){ $start=158; }
		if($data['data']['frequency_statement'][0]=="2"){ $start=283; }
		if($data['data']['frequency_statement'][0]=="3"){ $start=472; }
		if($data['data']['frequency_statement'][0]=="4"){ $start=662; }
		$this->addTick($start,772);

		$this->addImagefromFile($data['data']['accepted_terms_multiple_signature_one'][0],207,1470,70,70);
		// $this->addImagefromFile($data['data']['accepted_terms_multiple_signature_two'][0],100,400,500,500);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		//contact person signature

		// $originalPath = ROOT."user_subs/original/blank.jpg";
		// $storePath = ROOT."user_subs/created_image/personal_joint_4_".$data['sid'].".jpg";	
		// $this->jpg_image = imagecreatefromjpeg($originalPath);
		// $this->printText(strtoupper("Contact Person Signature"),40,100,100);
		// $this->addImagefromFile($data['data']['alternative_contact1_signature'][0],100,200,1000,1000);
		// imagejpeg($this->jpg_image,$storePath);
		// imagedestroy($this->jpg_image);


		//internet banking signatures

		// $originalPath = ROOT."user_subs/original/blank.jpg";
		// $storePath = ROOT."user_subs/created_image/personal_joint_5_".$data['sid'].".jpg";	
		// $this->jpg_image = imagecreatefromjpeg($originalPath);
		// $this->printText(strtoupper("Internet Banking Signatory 1"),40,100,100);
		// $this->addImagefromFile($data['data']['internet_banking_signatory_1'][0],100,200,200,200);
		// $this->printText(strtoupper("Internet Banking Signatory 2"),40,100,100);
		// $this->addImagefromFile($data['data']['internet_banking_signatory_2'][0],100,400,200,200);
		// $this->printText(strtoupper("Internet Banking Signatory 3"),40,100,100);
		// $this->addImagefromFile($data['data']['internet_banking_signatory_3'][0],100,600,200,200);
		// $this->printText(strtoupper("Internet Banking Signatory 4"),40,100,100);
		// $this->addImagefromFile($data['data']['internet_banking_signatory_4'][0],100,800,200,200);

		// imagejpeg($this->jpg_image,$storePath);
		// imagedestroy($this->jpg_image);
		//Jumbo Junior Signatories

		// $originalPath = ROOT."user_subs/original/blank.jpg";
		// $storePath = ROOT."user_subs/created_image/personal_joint_6_".$data['sid'].".jpg";	
		// $this->jpg_image = imagecreatefromjpeg($originalPath);
		// $this->printText(strtoupper("Jumbo Junior Signatories"),40,100,100);
		// $this->addImagefromFile($data['data']['jumbo_junior_applicants_signature'][0],100,200,200,200);
		// imagejpeg($this->jpg_image,$storePath);
		// imagedestroy($this->jpg_image);

		//statement signature

		// $originalPath = ROOT."user_subs/original/blank.jpg";
		// $storePath = ROOT."user_subs/created_image/personal_joint_7_".$data['sid'].".jpg";	
		// $this->jpg_image = imagecreatefromjpeg($originalPath);
		// $this->printText(strtoupper("Statement Request Signature"),40,100,100);
		// $this->addImagefromFile($data['data']['signing_instructions_options'][0],100,200,1000,1000);
		// imagejpeg($this->jpg_image,$storePath);
		// imagedestroy($this->jpg_image);
         
		//SIGNING INSTRUCTIONS signature

		// $originalPath = ROOT."user_subs/original/blank.jpg";
		// $storePath = ROOT."user_subs/created_image/personal_joint_7_".$data['sid'].".jpg";	
		// $this->jpg_image = imagecreatefromjpeg($originalPath);
		// $this->printText(strtoupper("SIGNING INSTRUCTIONS"),40,100,100);
		// $this->addImagefromFile($data['data']['signing_instructions_options'][0],100,200,1000,1000);
		// imagejpeg($this->jpg_image,$storePath);
		// imagedestroy($this->jpg_image);
         //statement signature

		// $originalPath = ROOT."user_subs/original/blank.jpg";
		// $storePath = ROOT."user_subs/created_image/personal_joint_8_".$data['sid'].".jpg";	
		// $this->jpg_image = imagecreatefromjpeg($originalPath);
		// $this->printText(strtoupper("Terms and conditions Signature "),40,100,100);
		// $this->addImagefromFile($data['data']['accepted_terms_multiple_signature_one'][0],100,200,500,500);
		// $this->addImagefromFile($data['data']['accepted_terms_multiple_signature_two'][0],100,400,500,500);
     
		// imagejpeg($this->jpg_image,$storePath);    
		// imagedestroy($this->jpg_image);

	
	}

	public function generateInternetBanking($data)
	{
		echo "<pre>";
		print_r($data);
		$originalPath = ROOT."user_subs/original/internet_banking/1.jpg";
		$storePath = ROOT."user_subs/created_image/internet_banking_1_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		if($data['data']['account_options'][0]=="Create"){ $start=895; }
		if($data['data']['account_options'][0]=="Amend"){ $start=1133; }
		if($data['data']['account_options'][0]=="Delete"){ $start=1382; }
		$this->addTick($start,190);

		$this->printText(strtoupper(date('dmY',$data['date'])),20,850,280,40);
		$this->printText(strtoupper($data['data']['branch'][0]),20,170,290);

		if($data['data']['title'][0]=="Prof"){ $start=275; }
		if($data['data']['title'][0]=="Hon"){ $start=430; }
		if($data['data']['title'][0]=="Dr"){ $start=560; }
		if($data['data']['title'][0]=="Mr"){ $start=681; }
		if($data['data']['title'][0]=="Mrs"){ $start=825; }
		if($data['data']['title'][0]=="Ms"){ $start=955; }
		if($data['data']['title'][0]=="Miss"){ $start=1107; }
		$this->addTick($start,360);

		$this->printText(strtoupper($data['data']['first_name'][0]),20,210,444);
		$this->printText(strtoupper($data['data']['middle_name'][0]),20,1000,444);

		$this->printText(strtoupper($data['data']['surname'][0]),20,195,500);

		$this->printText(strtoupper($data['data']['id___passport_number'][0]),20,342,545);
		$this->printText(strtoupper($data['data']['date_of_birth'][0]),20,992,545);

		$this->printText(strtoupper($data['data']['mobile_number'][0]),20,291,595);

		$this->printText(strtoupper($data['data']['email_address'][0]),20,555,645);

		$this->printText(strtoupper($data['data']['postal_address'][0]),20,264,700);
		$this->printText(strtoupper($data['data']['postal_code'][0]),20,822,700);
		$this->printText(strtoupper($data['data']['town'][0]),20,1187,700);

		$this->printText(strtoupper($data['data']['bank_account'][0]),20,85,800,50);
		$this->printText(strtoupper($data['data']['bank_account_three'][0]),20,867,800,50);
		$this->printText(strtoupper($data['data']['bank_account_two'][0]),20,85,846,50);
		$this->printText(strtoupper($data['data']['bank_account_four'][0]),20,867,846,50);


		$setDate = explode("/",$data['data']['date_signed'][0]);
		$this->printText(strtoupper($setDate[0]),20,690,1204);

		if($setDate[1]){
			$dateObj   = DateTime::createFromFormat('m', $setDate[1]);
			$monthName = $dateObj->format('F');
			$this->printText(strtoupper($monthName),20,914,1204);	
		}
		

		$this->printText(strtoupper($setDate[2]),20,1336,1204);

		$fullname = $data['data']['first_name'][0]." ".$data['data']['surname'][0];
		$this->printText(strtoupper($fullname),20,160,1336);

		$this->addImagefromFile($data['data']['signature'][0],1000,1214,120,120);


		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/internet_banking_2_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("Signature"),40,100,100);
			$this->addImagefromFile($data['data']['signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


	}

	public function generateDiasporaMortgage($data)
	{
		echo "<pre>";
		print_r($data);
		//exit;
		$originalPath = ROOT."user_subs/original/joint_mortgage/1.jpg";
		$storePath = ROOT."user_subs/created_image/joint_mortgage_1_".$data['sid'].".jpg";

		$this->jpg_image = imagecreatefromjpeg($originalPath);
		$this->printText(strtoupper(date('dmY',$data['date'])),20,138,385,42);
		$this->printText(strtoupper($data['data']['branch'][0]),20,885,385);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_first_name'][0]),20,225,654);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_middle_name'][0]),20,768,654);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_last_name'][0]),20,1244,654);

		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_id_passport'][0]),20,249,702,42);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_PIN'][0]),20,776,702,42);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_nationality'][0]),20,1364,702);

		$start = 99999999999999999999;
		if($data['data']['first_applicant_joint_acc_marital_status'][0]=="Married"){ $start=580; }
		elseif($data['data']['first_applicant_joint_acc_marital_status'][0]=="Divorced"){ $start=840; }
		else{ $start=340; }
		$this->addTick($start,710);

		$this->printText(strtoupper($data['data']['first_applicant_postal_address'][0]),20,200,795);
		$this->printText(strtoupper($data['data']['first_applicant_postal_code'][0]),20,715,795);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_town'][0]),20,1136,795);

		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_street'][0]),20,170,840);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_zip_postal_code'][0]),20,681,840);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_phone'][0]),20,1128,840,42);

		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_telephone_2'][0]),20,220,890);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_fax'][0]),20,590,890,42);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_email'][0]),20,1127,890);

		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_present_residence'][0]),20,100,980);
		$this->printText(strtoupper($data['data']['first_applicant_joint_acc_duration_of_occupation'][0]),20,555,980);

		$start = 99999999999999999999;
		if($data['data']['first_applicant_joint_acc_residence_ownership'][0]=="100% Owned"){ $start=941; }
		elseif($data['data']['first_applicant_joint_acc_residence_ownership'][0]=="Under Mortgage"){ $start=1217; }
		elseif($data['data']['first_applicant_joint_acc_residence_ownership'][0]=="Rented"){ $start=1430; }
		$this->addTick($start,940);

		$this->printText(strtoupper($data['data']['first_applicant_dependants_name'][0]),20,108,1128);
		$age = date('Y')-date('Y',strtotime($data['data']['first_applicant_dependants_name'][0]));
		$this->printText(strtoupper($age),20,711,1128);

		if($data['data']['power_of_attorney_first_applicant'][0]=="Yes"){ $start=636; }
		else{ $start=780; }
		$this->addTick($start,1225);

		if($data['data']['power_of_attorney_first_applicant_title'][0]=="Mr"){ $start=452; }
		elseif($data['data']['power_of_attorney_first_applicant_title'][0]=="MS"){ $start=847; }
		elseif($data['data']['power_of_attorney_first_applicant_title'][0]=="MRS"){ $start=664; }
		elseif($data['data']['power_of_attorney_first_applicant_title'][0]=="DR"){ $start=1040; }
		elseif($data['data']['power_of_attorney_first_applicant_title'][0]=="Prof"){ $start=1251; }
		elseif($data['data']['power_of_attorney_first_applicant_title'][0]=="Hon"){ $start=1475; }else{
			$start = 9999999999;
		}
		$this->addTick($start,1315);

		$this->printText(strtoupper($data['data']['first_name_first_applicant'][0]),20,225,1410);
		$this->printText(strtoupper($data['data']['middle_name_first_applicant'][0]),20,723,1410);
		$this->printText(strtoupper($data['data']['last_name_first_applicant'][0]),20,1187,1410);

		$this->printText(strtoupper($data['data']['first_applicant_attorney_postal_address'][0]),20,260,1506);
		$this->printText(strtoupper($data['data']['first_applicant_attorney_postal_code'][0]),20,860,1506);
		$this->printText(strtoupper($data['data']['first_applicant_attorney_town'][0]),20,1170,1506);

		$this->printText(strtoupper($data['data']['first_applicant_bank'][0]),20,160,1695);
		$this->printText(strtoupper($data['data']['first_applicant_branch'][0]),20,645,1695);
		$this->printText(strtoupper($data['data']['first_applicant_account_number'][0]),20,1125,1695);

		$this->printText(strtoupper($data['data']['first_applicant_employment_details_current_employer'][0]),20,310,1845);
		$this->printText(strtoupper($data['data']['first_applicant_position'][0]),20,204,1890);
		$start = 99999999999999999999;
		if($data['data']['first_applicant_nature_of_employment'][0]=="Permanent"){ $start=1515; }
		elseif($data['data']['first_applicant_joint_acc_residence_ownership'][0]=="Contract"){ $start=1310; }
		$this->addTick($start,1846);

		$this->printText(strtoupper($data['data']['first_applicant_duration_of_employment'][0]),20,455,1940);

		$this->printText(strtoupper($data['data']['first_applicant_postal_address'][0]),20,265,1990);
		$this->printText(strtoupper($data['data']['first_applicant_postal_code'][0]),20,788,1990);
		$this->printText(strtoupper($data['data']['second_applicant_town'][0]),20,1183,1990);

		$this->printText(strtoupper($data['data']['first_applicant_street'][0]),20,172,2040);
		$this->printText(strtoupper($data['data']['first_applicant_zip'][0]),20,670,2040);
		$this->printText(strtoupper($data['data']['first_applicant_employer_website'][0]),20,1145,2040);

		$this->printText(strtoupper($data['data']['first_applicant_telephone_number'][0]),20,154,2084,42);
		$this->printText(strtoupper($data['data']['first_applicant_email'][0]),20,690,2084);
		$this->printText(strtoupper($data['data']['first_applicant_fax'][0]),20,1129,2084,42);



		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);



		//PAGE 2
		$originalPath2 = ROOT."user_subs/original/joint_mortgage/2.jpg";
		$storePath = ROOT."user_subs/created_image/joint_mortgage_2_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath2);

		$this->printText(strtoupper($data['data']['first_applicant_salary_basic_salary'][0]),15,292,295,32);
		$this->printText(strtoupper($data['data']['first_applicant_salary_commissions_earned'][0]),15,1080,295,32);

		$this->printText(strtoupper($data['data']['first_applicant_salary_basic_salary'][0]),20,292,345,42);
		$this->printText(strtoupper($data['data']['first_applicant_income_owner_occupier_allowance'][0]),20,1080,345,42);

		$this->printText(strtoupper($data['data']['first_applicant_salary_other_income'][0]),20,292,396,42);
		$this->printText(strtoupper($data['data']['first_applicant_income_details_of_other_pay'][0]),20,1030,396,42);

		$this->printText(strtoupper($data['data']['other_commitments_sacco_first_applicant'][0]),20,292,500,42);
		$this->printText(strtoupper($data['data']['other_commitment_bank_loan_first_applicant'][0]),20,1080,500,42);

		$this->printText(strtoupper($data['data']['other_commitment_bank_overdraft_first_applicant'][0]),20,292,550,42);
		$this->printText(strtoupper($data['data']['other_commitment_mortgage_repayments_first_applicant'][0]),20,1080,550,42);


		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_first_name'][0]),20,225,753);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_middle_name'][0]),20,768,753);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_last_name'][0]),20,1240,753);

		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_id_passport'][0]),20,252,800,42);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_PIN'][0]),20,774,800,42);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_nationality'][0]),20,1365,800);

		if($data['data']['second_applicant_joint_acc_marital_status'][0]=="Married"){ $start=591; }
		elseif($data['data']['second_applicant_joint_acc_marital_status'][0]=="Divorced"){ $start=842; }
		else{ $start=340; }
		$this->addTick($start,800);

		$this->printText(strtoupper($data['data']['second_applicant_dependants_name'][0]),20,100,997);
		$age = date('Y')-date('Y',strtotime($data['data']['second_applicant_dependants_date_of_birth'][0]));
		$this->printText(strtoupper($age),20,697,997);

		if($data['data']['power_of_attorney_second_applicant'][0]=="Yes"){ $start=636; }
		else{ $start=780; }
		$this->addTick($start,1040);

		if($data['data']['power_of_attorney_second_applicant_title'][0]=="Mr"){ $start=452; }
		elseif($data['data']['power_of_attorney_second_applicant_title'][0]=="MS"){ $start=847; }
		elseif($data['data']['power_of_attorney_second_applicant_title'][0]=="MRS"){ $start=664; }
		elseif($data['data']['power_of_attorney_second_applicant_title'][0]=="DR"){ $start=1040; }
		elseif($data['data']['power_of_attorney_second_applicant_title'][0]=="Prof"){ $start=1251; }
		elseif($data['data']['power_of_attorney_second_applicant_title'][0]=="Hon"){ $start=1475; }else{
			$start = 9999999999;
		}
		$this->addTick($start,1137);

		$this->printText(strtoupper($data['data']['first_name_second_applicant'][0]),20,225,1224);
		$this->printText(strtoupper($data['data']['middle_name_second_applicant'][0]),20,723,1224);
		$this->printText(strtoupper($data['data']['last_name_second_applicant'][0]),20,1187,1224);

		$this->printText(strtoupper($data['data']['second_applicant_attorney_postal_address'][0]),20,260,1314);	
		$this->printText(strtoupper($data['data']['second_applicant_attorney_postal_code'][0]),20,860,1314);
		$this->printText(strtoupper($data['data']['second_applicant_attorney_town'][0]),20,1169,1314);

		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_address'][0]),20,190,1407);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_postal_code'][0]),20,715,1407);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_town'][0]),20,1130,1407);

		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_street'][0]),20,168,1450);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_zip_postal_code'][0]),20,680,1450);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_telephone_2'][0]),20,1124,1450,42);

		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_mobile_number'][0]),20,213,1497);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_fax'][0]),20,585,1497,42);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_email'][0]),20,1120,1497);

		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_present_residence'][0]),20,96,1590);
		$this->printText(strtoupper($data['data']['second_applicant_joint_acc_duration_of_occupation'][0]),20,560,1590);

		if($data['data']['second_applicant_joint_acc_residence_ownership'][0]=="100% Owned"){ $start=941; }
		elseif($data['data']['second_applicant_joint_acc_residence_ownership'][0]=="Under Mortgage"){ $start=1217; }
		elseif($data['data']['second_applicant_joint_acc_residence_ownership'][0]=="Rented"){ $start=1430; }
		$this->addTick($start,1533);

		$this->printText(strtoupper($data['data']['second_applicant_bank'][0]),20,150,1735);
		$this->printText(strtoupper($data['data']['second_applicant_branch'][0]),20,648,1735);
		$this->printText(strtoupper($data['data']['second_applicant_account_number'][0]),20,1115,1735);

		$this->printText(strtoupper($data['data']['second_applicant_employment_details_current_employer'][0]),20,300,1872);
		$this->printText(strtoupper($data['data']['second_applicant_position'][0]),20,200,1920);
		if($data['data']['second_applicant_nature_of_employment'][0]=="Permanent"){ $start=1515; }
		elseif($data['data']['second_applicant_nature_of_employment'][0]=="Contract"){ $start=1310; }
		$this->addTick($start,1872);

		$this->printText(strtoupper($data['data']['second_applicant_duration_of_employment'][0]),20,444,1964);
		$this->printText(strtoupper($data['data']['second_applicant_postal_address'][0]),20,270,2015);
		$this->printText(strtoupper($data['data']['second_applicant_postal_code'][0]),20,784,2015);
		$this->printText(strtoupper($data['data']['second_applicant_town'][0]),20,1175,2015);

		$this->printText(strtoupper($data['data']['second_applicant_street'][0]),20,170,2063);
		$this->printText(strtoupper($data['data']['second_applicant_zip'][0]),20,670,2063);
		$this->printText(strtoupper($data['data']['second_applicant_employer_website'][0]),20,1135,2063);

		$this->printText(strtoupper($data['data']['second_applicant_telephone_number'][0]),17,150,2104,32);
		$this->printText(strtoupper($data['data']['second_applicant_email'][0]),20,690,2104);
		$this->printText(strtoupper($data['data']['second_applicant_fax'][0]),20,1130,2104,42);




		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		//PAGE 3
		$originalPath3 = ROOT."user_subs/original/joint_mortgage/3.jpg";
		$storePath = ROOT."user_subs/created_image/joint_mortgage_3_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath3);

		$this->printText(strtoupper($data['data']['second_applicant_salary_basic_salary'][0]),15,276,504,30);
		$this->printText(strtoupper($data['data']['second_applicant_salary_commissions_earned'][0]),15,1020,504,30);
		
		$this->printText(strtoupper($data['data']['second_applicant_salary_house_allowance'][0]),20,276,570,42);
		$this->printText(strtoupper($data['data']['second_applicant_income_owner_occupier_allowance'][0]),20,1020,570,42);

		$this->printText(strtoupper($data['data']['second_applicant_salary_other_income'][0]),20,276,630,42);
		$this->printText(strtoupper($data['data']['second_applicant_income_details_of_other_pay'][0]),20,1020,700);
		
		$this->printText(strtoupper($data['data']['other_commitments_sacco'][0]),20,276,750,42);
		$this->printText(strtoupper($data['data']['other_commitment_bank_loan'][0]),20,1062,750,42);

		$this->printText(strtoupper($data['data']['other_commitment_bank_overdraft'][0]),20,276,800,42);
		$this->printText(strtoupper($data['data']['other_commitment_mortgage_repayments'][0]),20,1062,800,42);

		//$this->printText(strtoupper($data['data']['second_applicant_details_of_other_missing'][0]),20,276,630,42);
		
		$this->printText(strtoupper($data['data']['declare_other_property_any_existing_mortgages'][0]),20,100,1115);

		$this->printText(strtoupper($data['data']['declare_other_property_address_of_the_property'][0]),20,100,1215);
		$this->printText(strtoupper($data['data']['declare_other_property_name_of_mortgage'][0]),20,845,1215);

		$this->printText(strtoupper($data['data']['declare_other_property_approximate_outstanding_balance'][0]),20,100,1330);
		$this->printText(strtoupper($data['data']['declare_other_property_monthly_rental_income'][0]),20,610,1330);
		$this->printText(strtoupper($data['data']['declare_other_property_monthly_loan_repayment'][0]),20,1110,1330);

		$this->printText(strtoupper($data['data']['declare_other_property_name_and_address_of_your_adovates'][0]),20,510,1386,0,1000);

		$this->printText(strtoupper($data['data']['declare_other_property_declared_bankrupt'][0]),20,520,1570);
		$this->printText(strtoupper($data['data']['declare_other_property_if_declared_bankrupt'][0]),20,580,1570);

		$this->printText(strtoupper($data['data']['loan_particulars_amount_required'][0]),20,20,1725,80);	
		$this->printText(strtoupper($data['data']['loan_particulars_repayment_period'][0]),20,1320,1725);	

		$this->printText(strtoupper($data['data']['loan_particulars_amount_in_words'][0]),20,400,1800);	

		if($data['data']['loan_particulars_purpose_of_loan'][0]=="Purchase House"){ $start=356; }
		elseif($data['data']['loan_particulars_purpose_of_loan'][0]=="Construction"){ $start=870; }
		elseif($data['data']['loan_particulars_purpose_of_loan'][0]=="Equity Release"){ $start=1375; }
		$this->addTick($start,1860);
		

		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		//PAGE 4
		$originalPath4 = ROOT."user_subs/original/joint_mortgage/4.jpg";
		$storePath = ROOT."user_subs/created_image/joint_mortgage_4_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath4);

		
		$this->printText(strtoupper($data['data']['property_particulars_plot_number'][0]),20,100,435);
		$this->printText(strtoupper($data['data']['property_particulars_vendor_phone'][0]),20,855,435);

		$this->printText(strtoupper($data['data']['property_particulars_occupier_phone'][0]),20,100,550);
		$this->printText(strtoupper($data['data']['property_particulars_where_will_keys_be_obtained'][0]),20,855,550);

		$this->printText(strtoupper($data['data']['property_details_bank_valuer_to_visit_the_premises'][0]),20,100,690);
		$this->printText(strtoupper($data['data']['property_particulars_purchase_price'][0]),20,855,690);

		$start = 99999999999999999999;
		if($data['data']['loan_particulars_purpose_of_loan'][0]=="Personal savings"){ $start=804; }
		$this->addTick(680,$start);
		if($data['data']['loan_particulars_purpose_of_loan'][0]=="Disposal of investment"){ $start=867; }
		$this->addTick(680,$start);
		if($data['data']['loan_particulars_purpose_of_loan'][0]=="Amount already spent"){ $start=936; }
		$this->addTick(680,$start);
		if($data['data']['loan_particulars_purpose_of_loan'][0]=="Amount already spent"){ $start=993; }
		$this->addTick(680,$start);

		
		$this->printText(strtoupper($data['data']['second_mortgage_freehold_leasehold'][0]),20,100,1275);
		$this->printText(strtoupper($data['data']['second_mortgage_rent'][0]),20,850,1275);

		$this->printText(strtoupper($data['data']['second_mortgage_outstanding_charges'][0]),20,100,1400);
		$this->printText(strtoupper($data['data']['ratable_value'][0]),20,850,1400);

		$this->printText(strtoupper($data['data']['second_mortgage_occupational_rental'][0]),20,100,1510);
		$this->printText(strtoupper($data['data']['second_mortgage_mortgaged_elsewhere'][0]),20,855,1510);

		$this->printText(strtoupper($data['data']['second_mortgage_guest_house'][0]),20,100,1610);
		$this->printText(strtoupper($data['data']['second_mortgage_title_deed'][0]),20,855,1610);

		$this->printText(strtoupper($data['data']['second_mortgage_nearest_municipality'][0]),20,100,1725);
		$this->printText(strtoupper($data['data']['second_mortgage_area_of_land_2'][0]),20,855,1725);


		$this->printText(strtoupper($data['data']['cash_flow_projections_for_the_next_10_year'][0]),20,100,1940);
		$this->printText(strtoupper($data['data']['walls'][0]),20,855,1940);

		$this->printText(strtoupper($data['data']['current_profesional_valuation_report'][0]),20,100,2050);
		$this->printText(strtoupper($data['data']['roof'][0]),20,855,2050);

		//$this->printText(strtoupper($data['data']['second_mortgage_freehold_leasehold'][0]),20,100,1275);


		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


		//PAGE 5
		$originalPath5 = ROOT."user_subs/original/joint_mortgage/5.jpg";
		$storePath = ROOT."user_subs/created_image/joint_mortgage_5_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath5);
		
		$this->printText(strtoupper($data['data']['disclosure_name'][0]),20,100,360);
		$this->printText(strtoupper($data['data']['disclosure_company'][0]),20,850,360);

		$this->printText(strtoupper($data['data']['disclosure_account'][0]),20,58,475,42);
		$this->printText(strtoupper($data['data']['disclosure_company_account'][0]),20,802,475);

		$this->printText(strtoupper($data['data']['disclosure_joint_acccount_names'][0]),20,100,590);
		$this->printText(strtoupper($data['data']['disclosure_guarantor_name'][0]),20,850,590);

		$this->printText(strtoupper($data['data']['joint_account_number'][0]),20,58,730,40);
		$this->printText(strtoupper($data['data']['disclosure_guarantor'][0]),20,802,730);

		$this->addImagefromFile($data['data']['first_applicant_pic_signed'][0],120,1720,180,180);
		$this->addImagefromFile($data['data']['second_applicant_pic_signed'][0],870,1720,180,180);


		$date1 = str_replace("/", " ", $data['data']['first_applicant_date'][0]);
		$date2 = str_replace("/", " ", $data['data']['second_applicant_date'][0]);
		$this->printText(strtoupper($date1),23,175,1870,55);
		$this->printText(strtoupper($date2),23,949,1870,55);


		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/joint_mortgage_6_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("1st applicant"),40,100,100);
			$this->addImagefromFile($data['data']['first_applicant_pic_signed'][0],100,100,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/joint_mortgage_7_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("2nd Applicant"),40,100,100);
			$this->addImagefromFile($data['data']['second_applicant_pic_signed'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		
	}

	public function generateChangeContact($data)
	{
		echo "<pre>";
		print_r($data);
		//exit;

		$originalPath = ROOT."user_subs/original/change_contact/1.jpg";
		$storePath = ROOT."user_subs/created_image/change_contact_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper(date('dmY',$data['date'])),20,135,275,39);
		$this->printText(strtoupper($data['data']['postal_address'][0]),20,400,430);
		$this->printText(strtoupper($data['data']['zip_postal_code'][0]),20,380,515);
		$this->printText(strtoupper($data['data']['state___city___town'][0]),20,330,565);
		$this->printText(strtoupper($data['data']['country'][0]),20,216,610);
		$this->printText(strtoupper($data['data']['new_postal_address'][0]),20,400,655);
		$this->printText(strtoupper($data['data']['new_house_number_street'][0]),20,350,700);
		$this->printText(strtoupper($data['data']['new_zip_postal_code'][0]),20,380,742);
		$this->printText(strtoupper($data['data']['new_state___city___town'][0]),20,330,785);
		$this->printText(strtoupper($data['data']['new_country'][0]),20,230,830);
		$this->printText(strtoupper($data['data']['account_number'][0]),20,100,963,39);
		$this->printText(strtoupper($data['data']['mobile_number'][0]),20,100,1055,39);
		$this->printText(strtoupper($data['data']['alternative_phone_number'][0]),20,100,1146,39);

		//$this->printText(strtoupper($data['data']['alternative_phone_number'][0]),20,100,1146,39);

		$this->printText(strtoupper($data['data']['email_address'][0]),20,350,1188);

		if($data['data']['receive_your_statement_through_email'][0]=="Yes"){ $start=863; }else{ $start=989; }
		$this->addTick($start,1190);

		$this->printText(strtoupper($data['data']['full_name'][0]),20,150,1326);
		$this->addImagefromFile($data['data']['signature'][0],834,1293,20,40);

		
		$formatedDate = str_replace("/", "", $data['data']['date'][0]);
		$this->printText(strtoupper($formatedDate),20,128,1380,40);
		$this->printText(strtoupper($data['data']['id_number'][0]),20,760,1374);


		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/change_contact_2_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("Signature"),40,100,100);
			$this->addImagefromFile($data['data']['signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);
	}


	public function generateAccountActivation($data)
	{
		echo "<pre>";
		print_r($data);
		$originalPath = ROOT."user_subs/original/account_activation/1.jpg";
		$storePath = ROOT."user_subs/created_image/account_activation_".$data['sid'].".jpg";

		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper($data['data']['account_number'][0]),20,790,265);
		$this->printText(strtoupper($data['data']['reason_for_account_dormancy'][0]),20,100,410,0,70,60);
		$this->printText(strtoupper($data['data']['mode_of_maintaining_activated_account'][0]),20,100,815,0,70,60);
		$this->printText(strtoupper($data['data']['full_name'][0]),20,265,1160);
		$this->printText(strtoupper($data['data']['id_passport_number'][0]),20,330,1230);
		$this->addImagefromFile($data['data']['signature'][0],430,1270,180,180);
		$this->printText(strtoupper(date('dmY',$data['date'])),20,150,1500,39);

		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/account_activation_2_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("Signature"),40,100,100);
			$this->addImagefromFile($data['data']['signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

	}

	


	public function generateFixedCallImage($data)
	{
		echo "<pre>";
		print_r($data);
		$originalPath = ROOT."user_subs/original/fixed_call/1.jpg";
		$storePath = ROOT."user_subs/created_image/user_image_".$data['sid'].".jpg";

		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper($data['data']['branch'][0]),20,180,270);
		$this->printText(strtoupper(date('dmY',$data['date'])),20,715,270,39);
		//if fixed set to 180 else to 1000
		if($data['data']['choose_account_type'][0]=="Fixed Deposit"){ $start=230; }else{ $start=1000; }
		$this->addTick($start,340);
		$this->printText(strtoupper($data['data']['choose_a_currency'][0]),20,240,440);
		$this->printText(number_format($data['data']['amount_in_figures'][0]),20,990,440);
		$this->printText(strtoupper($data['data']['amount_in_words'][0]),20,270,495,0,70,60);
		$this->printText(strtoupper($data['data']['tenor'][0]),20,150,610);
		$this->printText(strtoupper($data['data']['months'][0]),20,680,610);
		if($data['data']['cash_deposit'][0]=="Cash Deposit"){ $start=230; }else{ $start=980; }
		$this->addTick($start,680);
		$this->printText(strtoupper($data['data']['account_name'][0]),20,240,780,0,70,60);
		$this->printText(strtoupper($data['data']['account_number'][0]),20,235,895,57);
		if($data['data']['roll_over'][0]=="No"){ $start=230; }else{ $start=980; }
		$this->addTick($start,1023);
		$this->printText(strtoupper($data['data']['disposal_instructions'][0]),20,320,1122,0,70,60);
		$this->printText(strtoupper($data['data']['first_signatory_name'][0]),20,110,1345);
		$this->printText(strtoupper($data['data']['first_signatory_id_number'][0]),20,575,1345);
		//to be replaced by an image
		//$this->printText(strtoupper($data['data']['signature'][0]),20,1090,1345);
		$this->addImagefromFile($data['data']['signature'][0],1090,1305,300,40);
		

		$this->printText(strtoupper($data['data']['second_signatory_name'][0]),20,110,1407);
		$this->printText(strtoupper($data['data']['second_signatory_id_number'][0]),20,575,1407);
		//to be replaced by an image
		//$this->printText(strtoupper($data['data']['second_signatory_signature'][0]),20,1090,1407);
		$this->addImagefromFile($data['data']['second_signatory_signature'][0],1090,1380,300,40);

		$this->printText(strtoupper($data['data']['third_signatory_name'][0]),20,110,1467);
		$this->printText(strtoupper($data['data']['third_signatory_id_number'][0]),20,575,1467);
		//to be replaced by an image
		//$this->printText(strtoupper($data['data']['third_signatory_signature'][0]),20,1090,1467);
		$this->addImagefromFile($data['data']['third_signatory_signature'][0],1090,1427,300,40);

		$this->printText(strtoupper($data['data']['fourth_signatory_name'][0]),20,110,1520);
		$this->printText(strtoupper($data['data']['fourth_signatory_id_number'][0]),20,575,1520);
		//to be replaced by an image
		//$this->printText(strtoupper($data['data']['fourth_signatory_signature'][0]),20,1090,1520);
		$this->addImagefromFile($data['data']['fourth_signatory_signature'][0],1090,1480,300,40);

		
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/user_image_2_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("1st Signature"),40,100,100);
			$this->addImagefromFile($data['data']['signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/user_image_3_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("2nd Signatory Signature"),40,100,100);
			$this->addImagefromFile($data['data']['second_signatory_signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/user_image_4_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("3rd Signatory Signature"),40,100,100);
			$this->addImagefromFile($data['data']['third_signatory_signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		$originalPath = ROOT."user_subs/original/blank.jpg";
		$storePath = ROOT."user_subs/created_image/user_image_5_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath);
			$this->printText(strtoupper("4th Signatory Signature"),40,100,100);
			$this->addImagefromFile($data['data']['fourth_signatory_signature'][0],100,200,1000,1000);
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);
	}

	public function convertToPdf($images,$sid)
	{
		
		require_once(ROOT.'pdf/tcpdf.php');
		//ob_start();
		$pdf = new TCPDF();

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Co-op Banks auto form');
		$pdf->SetTitle('Co-op bank');
		$pdf->SetSubject('Co-op bank');

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
		$icon = ROOT."user_subs/resources/tick.png";
		$src = imagecreatefrompng($icon);
		imagecopy($this->jpg_image, $src, $x, $y, 0, 0, 50, 50);
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
