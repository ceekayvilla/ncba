<?php
class WebForm extends General{
	public $jpg_image;

	public function generatePDF()
	{
	
		//get lastID
		$lastId = $this->getLastId();

//		die("Last-".$lastId);
		//get new content after last id
		$datas = $this->getWebForms($lastId);
		//loop through data and choose GD template
		foreach ($datas as $key => $data) {
			switch($data['nid'])
			{
				case '1':
				//personal / joint account
				$this->generatePersonalJoint($data);
				//generate acount activation image
				$images = array(ROOT."user_subs/created_image/personal_joint_1_".$data['sid'].".jpg",ROOT."user_subs/created_image/personal_joint_2_".$data['sid'].".jpg");
				$this->convertToPdf($images,$data['sid']);
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
								ROOT."user_subs/created_image/joint_mortgage_5_".$data['sid'].".jpg"
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
								ROOT."user_subs/created_image/business_account_4_".$data['sid'].".jpg",);
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
				$images = array(ROOT."user_subs/created_image/change_contact_".$data['sid'].".jpg");
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
				$images = array( ROOT."user_subs/created_image/account_activation_".$data['sid'].".jpg");
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
				$images = array( ROOT."user_subs/created_image/user_image_".$data['sid'].".jpg");
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
				$images = array(ROOT."user_subs/created_image/internet_banking_1_".$data['sid'].".jpg");
				$this->convertToPdf($images,$data['sid']);
				$subject = "Internet banking form";
				$content = "Please find attached entry for internet banking form";
				//generate acount activation image
				//convert it to pdf
				//send and email to co-op
				break;

				
			}
			
			
			$attachment = ROOT."user_subs/created_pdf/pdf_".$data['sid'].".pdf";
			$this->pulsePhpMailer($attachment,$subject,$content);


			$myfile = fopen(ROOT."user_subs/position.txt", "w") or die("Unable to open file!");
			
			fwrite($myfile, $data['sid']);
			fclose($myfile);
			
		}

	}

	public function generateBusinessAccount($data)
	{
		echo "<pre>";
		print_r($data);
		$originalPath = ROOT."user_subs/original/business_account/1.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_1_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->printText(strtoupper(date("dmY",strtotime($data['date']))),20,1297,303,42);

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
		$this->printText(strtoupper($data['data']['business_email'][0]),20,950,110);

		$this->printText(strtoupper($data['data']['nature_of_business'][0]),20,278,1065);

		$this->printText(strtoupper(str_replace("/", "", $data['data']['date_of_incorporation___registration'][0])),20,414,1124,42);
		$this->printText(strtoupper($data['data']['certificate_of_incorporation_number'][0]),10,1182,1124);
		$this->printText(strtoupper($data['data']['business_kra_pin'][0]),20,1404,1124);

		$this->printText(strtoupper($data['data']['associated_companies'][0]),20,333,1185);
		$this->printText(strtoupper($data['data']['country_of_incorporation___registration'][0]),20,1208,1185);		

		$this->printText(strtoupper($data['data']['source_of_funds'][0]),20,250,1245);
		if($data['data']['business_income_range'][0]=="0-50,000"){ 
			$start=926; 
		}elseif($data['data']['business_income_range'][0]=="50,000 - 200,000"){ 
			$start=1235; 
		}elseif($data['data']['business_income_range'][0]=="200,000 and above"){ 
			$start=1520; 
		}else{ $start= 999999; }
		$this->addTick($start,1202);

		$this->printText(strtoupper($data['data']['other_bank_name_1'][0]),20,204,1355);
		$this->printText(strtoupper($data['data']['other_bank_branch_1'][0]),20,657,1355);
		$this->printText(strtoupper($data['data']['other_bank_account_number_1'][0]),20,1265,1355);

		$this->printText(strtoupper($data['data']['other_bank_name_2'][0]),20,204,1415);
		$this->printText(strtoupper($data['data']['other_bank_branch_2'][0]),20,657,1415);
		$this->printText(strtoupper($data['data']['other_bank_account_number_2'][0]),20,1265,1415);








		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);



		/* PAGE 2 */
		$originalPath = ROOT."user_subs/original/business_account/2.jpg";
		$storePath = ROOT."user_subs/created_image/business_account_2_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		$this->addImagefromFile($data['data']['1st_sig_applicant_signature'][0],125,290,500,130);
		$this->addImagefromFile($data['data']['1st_sig_authentication_signature'][0],700,290,500,130);
		$this->addImagefromFile($data['data']['1st_sig_passport_picture'][0],1210,220,400,200);

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


		// $this->addImagefromFile($data['data']['2nd_sig_applicant_signature'][0],125,290,500,130);
		// $this->addImagefromFile($data['data']['2nd_sig_authentication_signature'][0],700,290,500,130);
		// $this->addImagefromFile($data['data']['2nd_sig_passport_picture'][0],1210,220,400,200);





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

		$this->addImagefromFile($data['data']['1st_signatory_picture'][0],352,1432,628,64);
		$this->addImagefromFile($data['data']['2nd_signatory_picture'][0],1136,1432,628,64);
		$this->addImagefromFile($data['data']['3rd_signatory_picture'][0],352,1512,628,64);
		$this->addImagefromFile($data['data']['4th_signatory_picture'][0],1136,1512,628,64);






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

		$this->printText(strtoupper($data['data']['branch'][0]),20,172,296);
		$date = str_replace("/", "", $data['data']['date'][0]);
		$this->printText(strtoupper($date),20,1303,295,40);

		$this->printText(strtoupper($data['data']['account_name'][0]),20,280,446);
		if($data['data']['account_type'][0]=="Personal"){ $start=1110; }
		if($data['data']['account_type'][0]=="Joint"){ $start=1410; }
		$this->addTick($start,415);

		$this->printText(strtoupper($data['data']['first_applicant'][0]),20,300,726,40);
		if($data['data']['debit_card_ordered'][0]=="Yes"){ $start=1474; }
		if($data['data']['debit_card_ordered'][0]=="No"){ $start=1532; }
		$this->addTick($start,690);

		$this->printText(strtoupper($data['data']['title'][0]),20,150,830);
		$this->printText(strtoupper($data['data']['first_name'][0]),20,510,830);
		$this->printText(strtoupper($data['data']['middle_name'][0]),20,880,830);
		$this->printText(strtoupper($data['data']['last_name'][0]),20,1285,830);


		$this->printText(strtoupper($data['data']['kenya_id'][0]),20,185,900);
		$this->printText(strtoupper($data['data']['kra_pin'][0]),20,465,900);
		$this->printText(strtoupper($data['data']['passport_number'][0]),20,865,900);
		$date = str_replace("/", "", $data['data']['date_of_birth'][0]);
		$this->printText(strtoupper(date("dmY",strtotime($data['data']['date_of_birth'][0]))),20,1300,900,40);

		$this->printText(strtoupper($data['data']['country_of_birth'][0]),20,260,960);
		$this->printText(strtoupper($data['data']['nationality'][0]),20,690,960);
		$this->printText(strtoupper($data['data']['residence_country'][0]),20,1912,960);


		//$this->printText(strtoupper($data['data']['residence_country'][0]),20,1912,960); HOSE STREET MISSING
		//$this->printText(strtoupper($data['data']['residence_country'][0]),20,1912,960); ZIP MISSING
		//$this->printText(strtoupper($data['data']['residence_country'][0]),20,1912,960); STATE MISSING

		$this->printText(strtoupper($data['data']['mobile_number'][0]),20,240,1146);
		$this->printText(strtoupper($data['data']['other_number'][0]),20,729,1146);

		$this->printText(strtoupper($data['data']['email'][0]),20,146,1205);


		if($data['data']['income_range'][0]=="0-50,000"){ $start=630; }
		if($data['data']['income_range'][0]=="50,001 - 200,000"){ $start=1007; }
		if($data['data']['income_range'][0]=="200,000+"){ $start=1230; }
		$this->addTick($start,1230);

		//$this->printText(strtoupper($data['data']['email'][0]),20,260,1325); MISSING Source of funds
		//$this->printText(strtoupper($data['data']['email'][0]),20,260,1325); MISSING Purpose of account

		$this->printText(strtoupper($data['data']['employer_name___occupation'][0]),20,670,1445);

		$this->printText(strtoupper($data['data']['zip_postal_address'][0]),20,261,1568);
		$this->printText(strtoupper($data['data']['city_town'][0]),20,700,1568);
		$this->printText(strtoupper($data['data']['telephone'][0]),20,1226,1568);

		$this->printText(strtoupper($data['data']['account_name'][1]),15,234,1688);
		$this->printText(strtoupper($data['data']['branch'][1]),20,660,1688);
		$this->printText(strtoupper($data['data']['account_number'][0]),20,1263,1688);

		$this->addImagefromFile($data['data']['applicant_signature'][0],86,1840,200,200);
		$this->addImagefromFile($data['data']['authentication_signature'][0],604,1840,200,200);
		$this->addImagefromFile($data['data']['passport_picture'][0],1135,1800,200,200);


		$this->printText(strtoupper($data['data']['alternative_contact_first_name'][0]),20,208,2140);
		$this->printText(strtoupper($data['data']['alternative_contact_middle_name'][0]),20,730,2140);
		$this->printText(strtoupper($data['data']['alternative_contact_last_name'][0]),20,1200,2140);

		$this->printText(strtoupper($data['data']['alternative_contact_house_street'][0]),20,280,2190);

		$this->printText(strtoupper($data['data']['alternative_contact_zip_postal_code'][0]),20,256,2260);
		$this->printText(strtoupper($data['data']['alternative_contact_city'][0]),20,690,2260);
		$this->printText(strtoupper($data['data']['alternative_contact_country'][0]),20,1170,2260);

		$this->printText(strtoupper($data['data']['alternative_contact_email'][0]),20,148,2316);
		$this->printText(strtoupper($data['data']['alternative_contact_phone'][0]),20,1123,2316);

		
		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);



		$originalPath = ROOT."user_subs/original/personal_joint/2.jpg";
		$storePath = ROOT."user_subs/created_image/personal_joint_2_".$data['sid'].".jpg";	
		$this->jpg_image = imagecreatefromjpeg($originalPath);

		if($data['data']['jumbo_account_gender'][0]=="Female"){ $start=1500; 
		}elseif($data['data']['jumbo_account_gender'][0]=="Male"){ $start=1563; 
		}else{
			$start = 9999999999;
		}
		$this->addTick($start,205);

		$this->printText(strtoupper($data['data']['jumbo_account_first_name'][0]),20,262,300);
		$this->printText(strtoupper($data['data']['jumbo_account_middle_name'][0]),20,720,300);
		$this->printText(strtoupper($data['data']['jumbo_account_last_name'][0]),20,1187,300);

		if($data['data']['date_of_birth'][1])
		{
			$this->printText(strtoupper(date("dmY",strtotime($data['data']['date_of_birth'][1]))),20,180,360,42);	
		}
		$this->printText(strtoupper($data['data']['child_birth_certificate___notification_number'][0]),20,1048,360);

		$this->printText(strtoupper($data['data']['jumbo_account_country_birth'][0]),20,255,420);
		$this->printText(strtoupper($data['data']['jumbo_account_nationality'][0]),20,700,420);
		$this->printText(strtoupper($data['data']['jumbo_account_country_residence'][0]),20,1310,420);

		if($data['data']['relationship_with_child'][0]){ $start=485; 
		}elseif($data['data']['guardian'][0]){ $start=780; 
		}else{ $start= 99999999; }
		$this->addTick($start,440);

		$this->printText(strtoupper($data['data']['jumbo_other_relationship'][0]),20,1137,480);

		$this->printText(strtoupper($data['data']['internet_banking_services_account_name'][0]),20,430,635);
		$this->printText(strtoupper($data['data']['internet_banking_services_account'][0]),20,200,700);

		if($data['data']['internet_email_as_provided'][0]=="Yes"){ $start=800; }else{ $start = 999999999; }
		$this->addTick($start,830);

		if($data['data']['internet_banking_send_on_behalf'][0]=="Yes"){ $start=1110; }else{ $start = 99999999999999999; }
		$this->addTick($start,830);


		if($data['data']['signing_instructions_options'][0]=="Sole"){ $start=112; }
		if($data['data']['signing_instructions_options'][0]=="Either"){ $start=408; }
		if($data['data']['signing_instructions_options'][0]=="Any Two"){ $start=710; }
		if($data['data']['signing_instructions_options'][0]=="Any Three"){ $start=1020; }
		if($data['data']['signing_instructions_options'][0]=="All To Sign"){ $start=1400; }
		$this->addTick($start,1015);


		$this->addImagefromFile($data['data']['applicant_signature'][0],308,1320,400,110);



		$this->printText(date("d",strtotime($data['data']['disclaimer_date'][0])),20,240,1304);
		$this->printText(date("m",strtotime($data['data']['disclaimer_date'][0])),20,456,1304);
		$this->printText(date("Y",strtotime($data['data']['disclaimer_date'][0])),20,630,1304);


		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


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

		$dateObj   = DateTime::createFromFormat('!m', $setDate[1]);
		$monthName = $dateObj->format('F');
		$this->printText(strtoupper($monthName),20,914,1204);

		$this->printText(strtoupper($setDate[2]),20,1336,1204);

		$fullname = $data['data']['first_name'][0]." ".$data['data']['surname'][0];
		$this->printText(strtoupper($fullname),20,160,1336);

		$this->addImagefromFile($data['data']['signature'][0],1000,1214,120,120);


		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


	}

	public function generateDiasporaMortgage($data)
	{
		echo "<pre>";
		print_r($data);
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

		$this->printText(strtoupper($data['data']['first_applicant_salary_basic_salary'][0]),20,292,295,42);
		$this->printText(strtoupper($data['data']['first_applicant_salary_commissions_earned'][0]),20,1080,295,42);

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

		$this->printText(strtoupper($data['data']['second_applicant_telephone_number'][0]),20,150,2104,42);
		$this->printText(strtoupper($data['data']['second_applicant_email'][0]),20,690,2104);
		$this->printText(strtoupper($data['data']['second_applicant_fax'][0]),20,1130,2104,42);




		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);

		//PAGE 3
		$originalPath3 = ROOT."user_subs/original/joint_mortgage/3.jpg";
		$storePath = ROOT."user_subs/created_image/joint_mortgage_3_".$data['sid'].".jpg";
		$this->jpg_image = imagecreatefromjpeg($originalPath3);

		$this->printText(strtoupper($data['data']['second_applicant_salary_basic_salary'][0]),20,276,504,42);
		$this->printText(strtoupper($data['data']['second_applicant_salary_commissions_earned'][0]),20,1020,504,42);
		
		$this->printText(strtoupper($data['data']['second_applicant_salary_house_allowance'][0]),20,276,570,42);
		$this->printText(strtoupper($data['data']['second_applicant_income_owner_occupier_allowance'][0]),20,1020,570,42);

		$this->printText(strtoupper($data['data']['second_applicant_salary_other_income'][0]),20,276,630,42);
		$this->printText(strtoupper($data['data']['second_applicant_income_details_of_other_pay'][0]),20,1020,630);
		
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

		$this->printText(strtoupper($data['data']['disclosure_account'][0]),20,58,475);
		$this->printText(strtoupper($data['data']['disclosure_company_account'][0]),20,802,475);

		$this->printText(strtoupper($data['data']['disclosure_joint_acccount_names'][0]),20,100,590);
		$this->printText(strtoupper($data['data']['disclosure_guarantor_name'][0]),20,850,590);

		$this->printText(strtoupper($data['data']['joint_account_number'][0]),20,58,730);
		$this->printText(strtoupper($data['data']['disclosure_guarantor'][0]),20,802,730);

		$this->addImagefromFile($data['data']['first_applicant_pic_signed'][0],120,1720,180,180);
		$this->addImagefromFile($data['data']['second_applicant_pic_signed'][0],870,1720,180,180);

		$this->printText(strtoupper($data['data']['first_applicant_date'][0]),20,170,1870);
		$this->printText(strtoupper($data['data']['second_applicant_date'][0]),20,58,935);


		imagejpeg($this->jpg_image,$storePath);
		imagedestroy($this->jpg_image);


		
	}

	public function generateChangeContact($data)
	{
		echo "<pre>";
		print_r($data);
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

		$this->printText(strtoupper($data['data']['email_address'][0]),20,350,1188);

		if($data['data']['receive_your_statement_through_email'][0]=="Yes"){ $start=863; }else{ $start=989; }
		$this->addTick($start,1190);



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
		$this->addImagefromFile($data['data']['third_signatory_signature'][0],1090,1480,300,40);

		
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

	public function addImagefromFile($file_id,$x,$y,$oWidth,$oHeight)
	{
		$fileDetails = $this->read('file_managed'," AND fid='{$file_id}'");
		if(empty($fileDetails)){ return; }
		$file = str_replace("public://", "", $fileDetails[0]->uri);
		$file = str_replace(" ", "%20", $file);
		$fileUrl = IMG_FILE_PATH.$file;
		
		$size = getimagesize($fileUrl);
		$ratio = $size[0]/$size[1]; // width/height
		
		    $width = $oHeight*$ratio;
		    $height = $oHeight;
		
		$src = imagecreatefromstring(file_get_contents($fileUrl));
		$dst = imagecreatetruecolor($width,$height);
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

	public function getWebForms($lastId=0)
	{
		$list = "5,6,4,3,2,20,1,7";
		$list = "5,6,4,2,1,20,3";
		
		$sql="SELECT A.sid,A.nid,A.completed,B.title FROM webform_submissions AS A LEFT JOIN node as B ON A.nid = B.nid ".
		" WHERE A.sid > '{$lastId}' AND A.nid IN ($list) LIMIT 2";
		$entries=$this->execute($sql);
		
		$datas = array();
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
			$datas[] = array(
						'title'=>$entry->title,
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