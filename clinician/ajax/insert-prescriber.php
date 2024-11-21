<?php include "../../private/settings.php";

//print_r ($_POST);





//Array ( [cmbDescribe] => Principal [txtFirstName] => ad [txtLastName] => dfd [txtEmail] => sdfd@ll.com [txtMobile] => 2343 434 343 [txtAgencyName] => adf [txtPName] => asdf [txtPEmail] => sdfd@ll.com [txtPPhone] => 2343434343 [txtPostcode1] => 3333 [txtPostcode2] => [txtPostcode3] => [txtPostcode4] => [txtPostcode5] =>

$recaptcha=$_POST['g-recaptcha-response'];

if ($_POST['txtForename']!="" && $_POST['txtEmail']!=""  && !empty($recaptcha))
{

	
	$sqlCheck="select * from tbl_prescribers where pres_email='".$database->filter($_POST['txtEmail'])."'";
	$resCheck=$database->get_results($sqlCheck);
	if (count($resCheck)==0)
	{
		
		 
		$curDate=date("Y-m-d");		
		$dateVal=$_POST['cmbYear']."-".$_POST['cmbMonth']."-".$_POST['cmbDate'];		
		
		
		
		//------uploading multiple certificates-----
		 $fileCount = count($_FILES['flCert']['name']);
		$arrFnamesSer=array();

		if ($fileCount>0)
		{
			
			$arrFileNames=array();
			
			for ($i = 0; $i < $fileCount; $i++) {
			$fileName = uniqid().$_FILES['flCert']['name'][$i];
			$fileType = $_FILES['flCert']['type'][$i];
			$fileTmpName = $_FILES['flCert']['tmp_name'][$i];
			$fileError = $_FILES['flCert']['error'][$i];
			$fileSize = $_FILES['flCert']['size'][$i];	
			
			
			 if ($fileError === UPLOAD_ERR_OK) {
				
				$destination = PATH.'clinician/documents/' . $fileName;
				move_uploaded_file($fileTmpName, $destination);
				//echo "File $fileName uploaded successfully.";
				array_push($arrFileNames,$fileName);
			}
			
			
		}
			
			$arrFnamesSer=serialize($arrFileNames);	
		}
		
		
		//----------CPD certificates uploading
		
		 $fileCount = count($_FILES['flCPD']['name']);
		$arrFnamesSer2=array();

		if ($fileCount>0)
		{
			
			$arrFileNames2=array();
			
			for ($i = 0; $i < $fileCount; $i++) {
			$fileName = uniqid().$_FILES['flCPD']['name'][$i];
			$fileType = $_FILES['flCPD']['type'][$i];
			$fileTmpName = $_FILES['flCPD']['tmp_name'][$i];
			$fileError = $_FILES['flCPD']['error'][$i];
			$fileSize = $_FILES['flCPD']['size'][$i];	
			
			
			 if ($fileError === UPLOAD_ERR_OK) {
				
				$destination = PATH.'clinician/documents/' . $fileName;
				move_uploaded_file($fileTmpName, $destination);
				//echo "File $fileName uploaded successfully.";
				array_push($arrFileNames2,$fileName);
			}
			
			
		}
			
			$arrFnamesSer2=serialize($arrFileNames2);	
		}
		
		$verificationCode=md5(uniqid());
		//----------end CPD cert uploading
		
		//--------end uploading multiple documents
		
		//------uploading signature--
		
		 $folderPath = PATH."signature/uploads/";  
  // break the encoded image string
  $image_parts = explode(";base64,", $_POST['signed']);

  // get image type
  $image_type_aux = explode("image/", $image_parts[0]);
  $image_type = $image_type_aux[1];

  // get image data
  $image_base64 = base64_decode($image_parts[1]);

  // create a unique image name
  $image_name = uniqid().time(). '.'.$image_type;

  // concatenate image with the uploads directory
  $file = $folderPath . $image_name;
  
   		if(!file_put_contents($file, $image_base64)){
   		 echo 'Signature did not updated, please contact admin';
  		}
		
		//------end uploading signature

		$names = array(

			'pres_emp_number' => $_POST['txtEmpNumber'], 
			'pres_password' => md5($_POST['txtPassword']),
			'pres_title' => $_POST['cmbTitle'], 
			'pres_forename' => $_POST['txtForename'],
			'pres_surname' => $_POST['txtSurname'],
			'pres_address1' => $_POST['txtAddress'],
			'pres_address2' => $_POST['txtAddress2'],
			'pres_city' => $_POST['txtCity'],
			'pres_postcode' => $_POST['txtPostcode'],
			'pres_profession' => $_POST['cmbProf'],
			'pres_country' => $_POST['cmbCountry'],
			'pres_dob' => $dateVal,
			'pres_insurance_number' => $_POST['txtNIN'],
			'pres_work_permit' => $_POST['rdoWorkUk'],				
			'pres_regulatory_body' => $_POST['rdoRegBody'],			
			'pres_gphc_reg_number' => $_POST['txtGPHCReg'],	
			'pres_gmc_reg_number' => $_POST['txtGMCReg'],	
			'pres_nmc_reg_number' => $_POST['txtNMCReg'],						
			'pres_qualification_check' => $_POST['rdoQC'],			
			'pres_rf1_name' => $_POST['rf1_name'],
			'pres_rf1_job_title' => $_POST['rf1_job_title'],
			'pres_rf1_org' => $_POST['rf1_org'],
			'pres_rf1_email' => $_POST['rf1_email'],			
			'pres_rf2_name' => $_POST['rf2_name'],
			'pres_rf2_job_title' => $_POST['rf2_job_title'],
			'pres_rf2_org' => $_POST['rf2_org'],
			'pres_rf2_email' => $_POST['rf2_email'],			
			'pres_indemnity' => $_POST['rdoInd'],
			'pres_expiry_date' => $_POST['txtExpDate'],			
			'pres_home_phone' => $_POST['txtHomeTelephone'],
			'pres_mobile' => $_POST['txtMobile'],
			'pres_email' => $_POST['txtEmail'],
			'pres_verification_code' => $verificationCode,
			'pres_employment_status' => $_POST['txtEmpStatus'],
			'pres_ir35' => $_POST['txtIR35'],
			'pres_ltd_company' => $_POST['txtCompanyName'],
			'pres_utr' => $_POST['txtUTR'],
			'pres_work_location' => $_POST['rdoWorkLocation'],
			'pres_work_in_uk' => $_POST['rdoRemote'],
			'pres_pension_opt_out' => $_POST['rdoPublished'],		
			'pres_e_name' => $_POST['txt_e_Forename'],
			'pres_e_surname' => $_POST['txt_e_Surname'],
			'pres_e_mobile' => $_POST['txt_e_Mobile'],
			'pres_e_phone' => $_POST['txt_e_Telephone'],
			'pres_e_address' => $_POST['txt_e_Address'],			
			'pres_e_address2' => $_POST['txt_e_address2'],
			'pres_e_city' => $_POST['txt_e_city'],
			'pres_e_postcode' => $_POST['txt_e_Postcode'],			
			'pres_e_country' => $_POST['cmb_e_Country'],			
			'pres_qualification_cert' => $arrFnamesSer,
			'pres_cpd_cert' => $arrFnamesSer2,
			'pres_pension_opt_out' => $_POST['rdoPension'],
			'pres_signature' => $image_name,
			'pres_status' => 0,			
			'pres_registered_on' => $curDate
			
		);
		
		
		
		/*print "<pre>";
		print_r ($names);
		print "</pre>";
		
		exit;*/

		$add_query = $database->insert( 'tbl_prescribers', $names );
		$lastInsertedId=$database->lastid();
		
		
		
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				//--------Settings all values--------
				
				$receiverName=$_POST['txtForename']." ".$_POST['txtSurname'];
				$veriLink='<a href="'.URL.'clinician/activate?auth='.$verificationCode.'&e='.base64_encode($lastInsertedId).'">Verify email address</a>';
				$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=51 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<verification_link>",$veriLink,$emailContent);
					$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				 $mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				
				


				$ToEmail=$_POST['txtEmail'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Account Email Verification";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
		
		//----------Creating log--------
		
		$name=$_POST['txtForename']." ".$_POST['txtSurname'];
		$uid=$lastInsertedId;
		$utype="Clinician";
		$action=$name." has registered as new clinician";
		
		createLogs($uid,$utype,$action);
		
		//----------end creating log
		
		
		if($_FILES['flPhotoId']['name'] != "")
			{					

				$target1 = PATH."clinician/documents/";
				$filename="photo-".md5(uniqid());				
				$file_ext=strtolower(end(explode('.',$_FILES['flPhotoId']['name'])));	
				$fileName=$filename.'-'.$lastInsertedId.'.'.$file_ext;
				move_uploaded_file($_FILES['flPhotoId']['tmp_name'],$target1.$fileName);

				$updateApp = array(
					'pres_photo_id' => $fileName, 					
				);
				
				$where_clause = array(
				'pres_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_prescribers', $updateApp, $where_clause, 1 );
			}
		
		if($_FILES['flProof1']['name'] != "")
			{					

				$target1 = PATH."clinician/documents/";
				$filename="prof-".md5(uniqid());				
				$file_ext=strtolower(end(explode('.',$_FILES['flProof1']['name'])));	
				$fileName=$filename.'-'.$lastInsertedId.'.'.$file_ext;
				move_uploaded_file($_FILES['flProof1']['tmp_name'],$target1.$fileName);

				$updateApp = array(
					'pres_proof_address1' => $fileName, 					
				);
				
				$where_clause = array(
				'pres_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_prescribers', $updateApp, $where_clause, 1 );
			}
			
			if($_FILES['flProof2']['name'] != "")
			{					

				$target1 = PATH."clinician/documents/";
				$filename="prof2-".md5(uniqid());				
				$file_ext=strtolower(end(explode('.',$_FILES['flProof2']['name'])));	
				$fileName=$filename.'-'.$lastInsertedId.'.'.$file_ext;
				move_uploaded_file($_FILES['flProof2']['tmp_name'],$target1.$fileName);

				$updateApp = array(
					'pres_proof_address2' => $fileName, 					
				);
				
				$where_clause = array(
				'pres_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_prescribers', $updateApp, $where_clause, 1 );
			}
			
			if($_FILES['flCV']['name'] != "")
			{					

				$target1 = PATH."clinician/documents/";
				$filename="cv-".md5(uniqid());				
				$file_ext=strtolower(end(explode('.',$_FILES['flCV']['name'])));	
				$fileName=$filename.'-'.$lastInsertedId.'.'.$file_ext;
				move_uploaded_file($_FILES['flCV']['tmp_name'],$target1.$fileName);

				$updateApp = array(
					'pres_cv' => $fileName, 					
				);
				
				$where_clause = array(
				'pres_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_prescribers', $updateApp, $where_clause, 1 );
			}
			
			if($_FILES['flRegBody']['name'] != "")
			{					

				$target1 = PATH."clinician/documents/";
				$filename="cert-regulatory-".md5(uniqid());				
				$file_ext=strtolower(end(explode('.',$_FILES['flRegBody']['name'])));	
				$fileName=$filename.'-'.$lastInsertedId.'.'.$file_ext;
				move_uploaded_file($_FILES['flRegBody']['tmp_name'],$target1.$fileName);

				$updateApp = array(
					'pres_regulatory_cert' => $fileName, 					
				);
				
				$where_clause = array(
				'pres_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_prescribers', $updateApp, $where_clause, 1 );
			}
			
			
			
			
			
			if($_FILES['flDBS']['name'] != "")
			{					

				$target1 = PATH."clinician/documents/";
				$filename="dbs-".md5(uniqid());				
				$file_ext=strtolower(end(explode('.',$_FILES['flDBS']['name'])));	
				$fileName=$filename.'-'.$lastInsertedId.'.'.$file_ext;
				move_uploaded_file($_FILES['flDBS']['tmp_name'],$target1.$fileName);

				$updateApp = array(
					'pres_dbs' => $fileName, 					
				);
				
				$where_clause = array(
				'pres_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_prescribers', $updateApp, $where_clause, 1 );
			}
			
			/*if($_FILES['flCert']['name'] != "")
			{					

				$target1 = PATH."clinician/documents/";
				$filename="qcert-".md5(uniqid());				
				$file_ext=strtolower(end(explode('.',$_FILES['flCert']['name'])));	
				$fileName=$filename.'-'.$lastInsertedId.'.'.$file_ext;
				move_uploaded_file($_FILES['flCert']['tmp_name'],$target1.$fileName);

				$updateApp = array(
					'pres_qualification_cert' => $fileName, 					
				);
				
				$where_clause = array(
				'pres_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_prescribers', $updateApp, $where_clause, 1 );
			}
			*/
			
			if($_FILES['flIndCert']['name'] != "")
			{					

				$target1 = PATH."clinician/documents/";
				$filename="indcert-".md5(uniqid());				
				$file_ext=strtolower(end(explode('.',$_FILES['flIndCert']['name'])));	
				$fileName=$filename.'-'.$lastInsertedId.'.'.$file_ext;
				move_uploaded_file($_FILES['flIndCert']['tmp_name'],$target1.$fileName);

				$updateApp = array(
					'pres_indemnity_doc' => $fileName, 					
				);
				
				$where_clause = array(
				'pres_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_prescribers', $updateApp, $where_clause, 1 );
			}

			
			
			
			
			//$_SESSION['uid']=$lastInsertedId;
			
			
			
				/*include PATH."include/email-templates/email-template.php";
	
				$headingTemplate="Activate your Pharma Health account";	
				$headingContent='<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%">
 				<tr><td height=30 colspan=2><p>We’re glad you\'re here. Click on link below to activate your account <br> <br><a href="'.URL.'patient/activate?auth='.$verificationCode.'&e='.base64_encode($lastInsertedId).'">Activate Account</a> </p></td></tr>
				</table>';

				include_once PATH."mail/sendmail.php";

				

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$_POST['txtEmail'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Activate your Pharma Health Account";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
	
				*/
	

		echo "1";
						
	}
	else
	echo "2";



	}







 ?>











      



    