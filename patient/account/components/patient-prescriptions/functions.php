<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."'   ";


		

			if($_GET['ty'] == "in")
			{
				
				 $sql.=" and pres_incomplete_active=1"; 
				
			}
			else
			$sql.=" and pres_stage>0";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and pres_id like '%".$database->filter(str_replace("PH-","",$_GET['txtSearchByTitle']))."%'";

		}
		
		if($_GET['cmbCategory'] != "")

		{

			$sql .= " and pres_stage='".$database->filter($_GET['cmbCategory'])."'";

		}

		$sql .= " order by pres_id desc";


		//print_r($sql);
		
		
		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	function incomplete_order($id)
	{
		global $database;
		
		
			   $_SESSION['sess_pres_id']=$id;
				
				print "<script>window.location='".URL."patient/questionnaire/select-medicine'</script>";
	}

	function saveFormValues()

	{

	global $database, $component;

	
		

		$curDate=date("Y-m-d");

		$names = array(

			'patient_title' => $_POST['txtTitle'], 
			'patient_first_name' => $_POST['txtFirstName'],
			'patient_middle_name' => $_POST['txtMiddleName'], 
			'patient_last_name' => $_POST['txtLastName'],
			'patient_email' => $_POST['txtEmail'],
			'patient_password' => $_POST['txtPassword'],
			'patient_phone' => $_POST['txtPhone'],
			'patient_gender' => $_POST['cmbGender'],
			'patient_dob' => $_POST[''],
			'patient_city' => $_POST['txtCity'],
			'patient_address1' => $_POST['txtAddress1'],
			'patient_address2' => $_POST['txtAddress2'],
			'patient_pharmacy' => $_POST[''],
			
			'patient_registered_date' => $curDate,
			'patient_ip' => $_SERVER['REMOTE_ADDR'],
			'patient_kyc' => $_POST['rdoKYC'],
			'patient_status' => $_POST['rdoPublished']


		);

		$add_query = $database->insert( 'tbl_pages', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_pages where page_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}
	
	
	function createFormForPages_detail($id)
			{
				global $database;
				$sql = "SELECT * FROM tbl_patients where patient_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);

			}
	
	function createFormForPages_cancel()
	{
		
				global $database;
				$sql = "SELECT * FROM tbl_patients where patient_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_cancel($results);
		
	}
	
	function createFormForPages_reorder()
	{
		
				global $database;
				$sql = "SELECT * FROM tbl_patients where patient_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_reorder($results);
		
	}


	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			

				$pagetitleEntered = $_POST['page_title'];

				$pagedescEntered = $_POST['page_description'];

				$pagePublishedEntered = $_POST['rdoPublished'];	

				$page_categories = $_POST['txtCategories'];

				$pageId=$_POST['pageId'];

			

			$update = array(

				'page_title' => $pagetitleEntered, 

				'page_description' => $pagedescEntered,

				'page_categories' => $page_categories, 			

				'page_status' => $pagePublishedEntered

			);

//Add the WHERE clauses

		$where_clause = array(

			'page_id' => $pageId

		);
		$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'page_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}

	

	function unpublishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'page_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}

	
function saveMessage()
	{
		
		

			global $database, $component;
			
			
		$fileCount = count($_FILES['flDoc']['name']);
		$arrFnamesSer=array();

		if ($fileCount>0)
		{
			
			$arrFileNames=array();
			
			for ($i = 0; $i < $fileCount; $i++) {
			$fileName = uniqid().$_FILES['flDoc']['name'][$i];
			$fileType = $_FILES['flDoc']['type'][$i];
			$fileTmpName = $_FILES['flDoc']['tmp_name'][$i];
			$fileError = $_FILES['flDoc']['error'][$i];
			$fileSize = $_FILES['flDoc']['size'][$i];	
			
			
			 if ($fileError === UPLOAD_ERR_OK) {
				
				$destination = PATH.'uploads/patients/' . $fileName;
				move_uploaded_file($fileTmpName, $destination);
				//echo "File $fileName uploaded successfully.";
				array_push($arrFileNames,$fileName);
			}
			
			
		}
			
			$arrFnamesSer=serialize($arrFileNames);
			//print_r ($arrFnamesSer);
			
		 
		
		
		}
		
		
			
				
			
			
		$curDate=date("Y-m-d H:i:s");
		
		if ($_POST['pid']!="")
		$pid=$_POST['pid'];
		else
		$pid=0;
		
		$sendTo=$_POST['rdUser'];

		$names = array(
			'message_sender_id' => $_SESSION['sess_patient_id'],
			'message_sender_type' => 'Patient', 
			'message_sent_to' => $sendTo, 
			'message_pres_id' => $_POST['hid'], 
			'message_parent_reply' => $pid,			
			'message_date' => $curDate,
			'message_sender_status' => 0,
			'message_replier_status' => 0,
			'message_subject' => $_POST['txtSubject'],
			'message_attachment' => $arrFnamesSer,			
			'message_text' => $_POST['txtMessage']
			


		);

		$add_query = $database->insert( 'tbl_messages', $names );
			
		getPresAction($_POST['hid'],$_SESSION['sess_patient_id'],'patient','Replied by Patient');
		
		
				//----------Creating log--------
		
					$name=$_SESSION['name'];
					$uid=$_SESSION['sess_patient_id'];
					$utype="patient";
					$action=$name." has sent message for prescription id PH-".$_POST['hid'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
		
		
			
			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$_POST['hid']."&tab=message&msg=1'</script>";
	
	}
	
	function cancel_my_order()
	{

			global $database, $component;
			
			
			$curDate=date("Y-m-d H:i:s");	
			
			if ($_POST['cmdReason']=="Other")
			$cancelReason="Other: ".$_POST['txtReason'];
			else
			$cancelReason=$_POST['cmdReason'];
			
				$update = array(

				'pres_stage' => 5, 
				'pres_cancel_reason' => $cancelReason,
				'pres_cancelled_user_type' => 'patient',
				'pres_cancelled_user_id' => $_SESSION['sess_patient_id'],				
				'pres_cancelled_date' => $curDate
							

			);
			
			

//Add the WHERE clauses

		$where_clause = array(

			'pres_id' => $_POST['hid']

		);
		$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );


			//------------sending email to patient----
				
		include PATH."include/email-templates/email-template.php";
		include_once PATH."mail/sendmail.php";
				
		//--------Settings all values--------
		
		$receiverName=$_SESSION['name'];
		$orderId=PRES_ID."-".$_POST['hid'];
		$patient_link="<a href='".URL.PATIENT_ADMIN."'>patient account</a>";
		
		$sqlEmail="select * from tbl_emails where email_id=21 and email_status=1";
		$resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$emailContent=str_replace("<order_id>",$orderId,$emailContent);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<patient_account>",$patient_link,$emailContent);										
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail= $_SESSION['sess_patient_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Order Cancellation";
				$BodySend=$mailBody;	
				
				
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);

				}

		
		//----------Creating log--------
		
					$name=$_SESSION['name'];
					$uid=$_SESSION['sess_patient_id'];
					$utype="patient";
					$action=$name." has cancelled the prescription id ".PRES_ID."-".$_POST['hid'];
					
					createLogs($uid,$utype,$action);
					
					getPresAction($_POST['hid'],$_SESSION['sess_patient_id'],'patient','Patient Cancelled Order');
		
		//----------end creating log
		
		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}
			
	}
	
	
	
	function reorder_my_order()
	{

			global $database, $component;
			
			
			$curDate=date("Y-m-d H:i:s");	
			
			if ($_POST['cmbReorder']=="No")
			{
				//--------Copy existing prescription and take patient to payment page--
				
				
				
				$sqlPres="select * from tbl_prescriptions where pres_id='".$database->filter($_POST['hid'])."'";
				$resPres=$database->get_results($sqlPres);
				$rowPres=$resPres[0];
				
				$add_date = date('Y-m-d H:i:s');
				
				
				$_SESSION['sessCart']=array();	
				
				$sqlMed="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($_POST['hid'])."'";
				$resMed=$database->get_results($sqlMed);
				
				if (count($resMed)>0)
				{
					for ($j=0;$j<count($resMed);$j++)
					{
						$rowMed=$resMed[$j];
						
						if ($rowMed['pm_med_common']==0)
						{
							$medicineId=getMedicineId($rowMed['pm_med']);
							
							if ($medicineId!="" && $medicineId!="-")
							{
								$medStrength=$rowMed['pm_med_strength'];
								$arrStrenth=explode(" ",$medStrength);
								
								
	//--------Calculation pricing of medication and share and saving into the session-------							
	
	$sqlCategory="select * from tbl_medication_pricing where mp_medicine='".$database->filter($medicineId)."' and mp_strength='".$database->filter($arrStrenth[0])."' and mp_pack_size='".$database->filter($rowMed['pm_med_packsize'])."' ";
	$resCategory=$database->get_results($sqlCategory);
	
	$rowCategory=$resCategory[0];	
	$tier=$_SESSION['sess_tier'];	
	$tierField="mp_tier".$tier."_price";
	
	$baseprice=$rowCategory[$tierField];
	$quantity=$rowMed['pm_med_qty'];
	$medicationCost=$rowCategory['mp_medication_cost'];
	$tier=$_SESSION['sess_tier'];
	$costPrice=$rowCategory['mp_cost_price'];
	$totalCostPrice=$costPrice*$quantity;
	
	
	if ($totalCostPrice>=6.5)
	{
	$medicationCost=$totalCostPrice;
	$priceTocharge=calculatePrice_plus($quantity,$medicationCost, $tier,$costPrice);
	}
	else
	$priceTocharge=calculatePrice($baseprice, $quantity);
	
	
	
	
	
						$profitPharma=CONSULTATION_ACTUAL_PAY+($priceTocharge-$medicationCost-CONSULTATION_COST)*0.3;
						$pharmacyProfit=($priceTocharge-$medicationCost-CONSULTATION_COST)*0.7;
								
								
							$_SESSION['sessCart'][$j]['med_id']=$medicineId;
							$_SESSION['sessCart'][$j]['med_qty']=$rowMed['pm_med_qty'];							
							$_SESSION['sessCart'][$j]['med_strength']=$rowMed['pm_med_strength'];
							$_SESSION['sessCart'][$j]['med_pack']=$rowMed['pm_med_packsize'];							
							$_SESSION['sessCart'][$j]['med_price']=round($priceTocharge,2);							
							$_SESSION['sessCart'][$j]['pharma_profit']=round($profitPharma,2);;
							$_SESSION['sessCart'][$j]['pharmacyNetProfit']=round($pharmacyProfit,2);
							$_SESSION['sessCart'][$j]['medicationCost']=round($totalCostPrice,2);							
							$_SESSION['sessCart'][$j]['medication_actual_cost']=$medicationCost;						
							$_SESSION['sessCart'][$j]['medicineId']=$medicineId;
							
							
							}
						}
						
					}
				}
				
							
				
				
				$names = array(
				'pres_patient_id' => $_SESSION['sess_patient_id'],
				'pres_condition' => $rowPres['pres_condition'],
				'pres_stage' => 0,
				'pres_about_you' => fnUpdateHTML($rowPres['pres_about_you']),
				'pres_disclaimer_file' => $rowPres['pres_disclaimer_file'],
				'pres_overall_risk' => $rowPres['pres_overall_risk'],
				'pres_symptoms' => fnUpdateHTML($rowPres['pres_symptoms']),
				'pres_medical_history' => fnUpdateHTML($rowPres['pres_medical_history']),
				'pres_medication' => fnUpdateHTML($rowPres['pres_medication']),
				'pres_disclaimer_file' => $rowPres['pres_disclaimer_file'],
				'pres_agreement_file' => $rowPres['pres_agreement_file'],
				'pres_gp_option' => $rowPres['pres_gp_option'],
				'pres_reorder_of' => $_POST['hid'],	
				'pres_incomplete_active' => 1,				
				'pres_date' => $add_date
				
				);
				
				$add_query = $database->insert( 'tbl_prescriptions', $names );
				
				
				$_SESSION['sess_pres_id']=$database->lastid();
				
				print "<script>window.location='".URL."patient/questionnaire/checkout'</script>";
				
				
				//------end copy existing
			}
			else
			{
				//--------take patient to questionnaire agreement page---
				
				$sqlPres="select * from tbl_prescriptions where pres_id='".$database->filter($_POST['hid'])."'";
				$resPres=$database->get_results($sqlPres);
				$rowPres=$resPres[0];
				
				$_SESSION['sessCondition']=$rowPres['pres_condition'];
				
				$_SESSION['sessCart']=array();	
				
				$sqlMed="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($_POST['hid'])."'";
				$resMed=$database->get_results($sqlMed);
				
				if (count($resMed)>0)
				{
					for ($j=0;$j<count($resMed);$j++)
					{
						$rowMed=$resMed[$j];
						//$_SESSION['sessCart'][$j]['med_id']=getMedicineId($rowMed['pm_med']);
						//$_SESSION['sessCart'][$j]['med_qty']=$rowMed['pm_med_qty'];
						$medId=getMedicineId($rowMed['pm_med']);
						
						print "<script>window.location='".URL."treatments/medicine?m=".$medId."&cid=".$rowPres['pres_condition']."'</script>";
						
						
					}
				}
				
				
				print "<script>window.location='".URL."patient/questionnaire/step1'</script>";
				//--------end take patient to questionnaire----
			}
			
			
			
			/*	$update = array(

				'pres_stage' => 5, 
				'pres_cancel_reason' => $cancelReason,
				'pres_cancelled_date' => $curDate
							

			);
			
			



		$where_clause = array(

			'pres_id' => $_POST['hid']

		);
		$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );

*/
		

		
		//----------Creating log--------
		
					$name=$_SESSION['name'];
					$uid=$_SESSION['sess_patient_id'];
					$utype="patient";
					$action=$name." has cancelled the prescription id ".PRES_ID."-".$_POST['hid'];
					
					createLogs($uid,$utype,$action);
		
		//----------end creating log
		
		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}
			
	}
	

	function removeSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_pages', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}


	function removeDeletedItems()

	{

		global $database,$component;	

		

			$provinceIdToPublish = $_GET['id'];

			

			//Add the WHERE clauses

			$where_clause = array(

				'pres_id' => $provinceIdToPublish,
				'pres_incomplete_active'=>1,
				'pres_patient_id' => $_SESSION['sess_patient_id']
				

			);

			$del = $database->delete( 'tbl_prescriptions', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=6&ty=in'</script>";

		}

		



?>