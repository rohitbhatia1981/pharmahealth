<?php include "../../private/settings.php";

//Array ( [cmbDescribe] => Principal [txtFirstName] => ad [txtLastName] => dfd [txtEmail] => sdfd@ll.com [txtMobile] => 2343 434 343 [txtAgencyName] => adf [txtPName] => asdf [txtPEmail] => sdfd@ll.com [txtPPhone] => 2343434343 [txtPostcode1] => 3333 [txtPostcode2] => [txtPostcode3] => [txtPostcode4] => [txtPostcode5] =>

$recaptcha=$_POST['g-recaptcha-response'];

if ($_POST['txtFirstName']!="" && $_POST['txtEmail']!="" && $_POST['txtLastName']!="" && !empty($recaptcha))
{

	
	$sqlCheck="select * from tbl_prescribers where pres_email='".$database->filter($_POST['txtEmail'])."'";
	$resCheck=$database->get_results($sqlCheck);
	if (count($resCheck)==0)
	{
		
		 
		$curDate=date("Y-m-d");		
		$dateVal=$_POST['cmbYear']."-".$_POST['cmbMonth']."-".$_POST['cmbDate'];		
		$password=rand(10000,99999);
			

		$names = array(

			'pres_emp_number' => $_POST['txtEmpNumber'], 
			'pres_password' => $password,
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
			'pres_dbs_number' => $_POST['txtDBS'],
			'pres_regulatory_body' => $_POST['rdoRegBody'],			
			'pres_qualification_check' => $_POST['rdoQC'],
			'pres_ref_check' => $_POST['txtProRefChk1'],
			'pres_ref_check2' => $_POST['txtProRefChk2'],
			'pres_indemnity' => $_POST['rdoInd'],
			'pres_expiry_date' => $_POST['txtExpDate'],			
			'pres_home_phone' => $_POST['txtHomeTelephone'],
			'pres_mobile' => $_POST['txtMobile'],
			'pres_email' => $_POST['txtEmail'],
			'pres_employment_status' => $_POST['txtEmpStatus'],
			'pres_ir35' => $_POST['txtIR35'],
			'pres_utr' => $_POST['txtUTR'],
			'pres_work_location' => $_POST['rdoWorkLocation'],
			'pres_work_in_uk' => $_POST['rdoRemote'],
			'pres_pension_opt_out' => $_POST['rdoPublished'],		
			'pres_e_name' => $_POST['txt_e_Forename'],
			'pres_e_surname' => $_POST['txt_e_Surname'],
			'pres_e_mobile' => $_POST['txt_e_Mobile'],
			'pres_e_phone' => $_POST['txt_e_Telephone'],
			'pres_e_address' => $_POST['txt_e_Address'],
			'pres_status' => 0,			
			'pres_registered_on' => $curDate
			
		);
		
		/*print "<pre>";
		print_r ($names);
		print "</pre>";
		
		exit;*/

		$add_query = $database->insert( 'tbl_prescribers', $names );
		$lastInsertedId=$database->lastid();
		
		
		if($_FILES['flPhotoId']['name'] != "")
			{					

				$target1 = PATH."prescriber/documents/";
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

				$target1 = PATH."prescriber/documents/";
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

				$target1 = PATH."prescriber/documents/";
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
			
			if($_FILES['flCert']['name'] != "")
			{					

				$target1 = PATH."prescriber/documents/";
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
			
			if($_FILES['flIndCert']['name'] != "")
			{					

				$target1 = PATH."prescriber/documents/";
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











      



    