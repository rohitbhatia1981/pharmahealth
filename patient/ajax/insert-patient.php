<?php include "../../private/settings.php";

//Array ( [cmbDescribe] => Principal [txtFirstName] => ad [txtLastName] => dfd [txtEmail] => sdfd@ll.com [txtMobile] => 2343 434 343 [txtAgencyName] => adf [txtPName] => asdf [txtPEmail] => sdfd@ll.com [txtPPhone] => 2343434343 [txtPostcode1] => 3333 [txtPostcode2] => [txtPostcode3] => [txtPostcode4] => [txtPostcode5] =>

$recaptcha=$_POST['g-recaptcha-response'];

if ($_POST['txtFirstName']!="" && $_POST['txtEmail']!="" && $_POST['txtLastName']!="" && !empty($recaptcha))
{

	
	$sqlCheck="select * from tbl_patients where patient_email='".$database->filter($_POST['txtEmail'])."'";
	$resCheck=$database->get_results($sqlCheck);
	if (count($resCheck)==0)
	{
		
		 
		 $curDate = date('Y-m-d H:i:s');
		 $dob=$_POST['cmbYear']."-".$_POST['cmbMonth']."-".$_POST['cmbDate'];
		
		$verificationCode=md5(uniqid());
		 
		 $values = array(

			'patient_title' => $_POST['txtTitle'], 
			'patient_first_name' => $_POST['txtFirstName'],
			'patient_middle_name' => $_POST['txtMiddleName'], 
			'patient_last_name' => $_POST['txtLastName'],
			'patient_email' => $_POST['txtEmail'],
			'patient_password' => md5($_POST['txtPassword']),
			'patient_phone' => $_POST['txtPhone'],
			'patient_gender' => $_POST['cmbGender'],
			'patient_dob' => $dob,
			'patient_city' => $_POST['txtCity'],
			'patient_address1' => $_POST['txtAddress1'],
			'patient_address2' => $_POST['txtAddress2'],
			'patient_postcode' => $_POST['txtPostCode'],
			'patient_pharmacy' => $_POST['hdPharmacyId'],
			'patient_marketing_emails' => $_POST['CkMarketing'],
			'patient_verification_code' => $verificationCode,
			'patient_registered_date' => $curDate,
			'patient_ip' => $_SERVER['REMOTE_ADDR'],
			

			);			

			$add_query = $database->insert( 'tbl_patients', $values );
			$lastInsertedId=$database->lastid();
			
			
			
			
			//$_SESSION['uid']=$lastInsertedId;
			
			
			
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				//--------Settings all values--------
				
				$receiverName=$_POST['txtTitle']." ".$_POST['txtFirstName']." ".$_POST['txtMiddleName']." ".$_POST['txtLastName'];
				$veriLink='<a href="'.URL.'patient/activate?auth='.$verificationCode.'&e='.base64_encode($lastInsertedId).'">Verify email address</a>';
				$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=15 and email_status=1";
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
				
				$SubjectSend="Patient Account Email Verification";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
	
		//----------Creating log--------
		
		$name=$_POST['txtTitle']." ".$_POST['txtFirstName']." ".$_POST['txtMiddleName']." ".$_POST['txtLastName'];
		$uid=$lastInsertedId;
		$utype="patient";
		$action=$name." has registered as new patient";
		
		createLogs($uid,$utype,$action);
		
		//----------end creating log
	

		echo "1";
						
	}
	else
	echo "2";



	}







 ?>











      



    