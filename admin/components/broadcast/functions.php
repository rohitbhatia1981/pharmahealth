<?php
function showList()
	{
	global $database, $page, $pagingObject;		
		$sql = "SELECT * FROM tbl_broadcasts where 1";
		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and (broadcast_subject like '%".$database->filter($_GET['txtSearchByTitle'])."%' || broadcast_email like '%".$database->filter($_GET['txtSearchByTitle'])."%') ";

		}
		$sql .= " order by broadcast_id desc";
		$pagingObject->setMaxRecords(PAGELIMIT); 
		$sql = $pagingObject->setQuery($sql);
		$results = $database->get_results( $sql );
		showRecordsListing( $results );	

	}
	
	function createFormForPages($id)

			{

				global $database;				

				$sql = "SELECT * FROM tbl_broadcasts where broadcast_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );		

				createFormForPagesHtml($results);

			}
	
	function saveFormValues()
	{
	global $database, $component;	
	if(isset($_POST['ckUsertype']) && !empty($_POST['ckUsertype'])) {
	$strType=implode(", ",$_POST['ckUsertype']);			
	}
	else if ($_POST['rdPatient']!="")
	{
	}
	else {
    echo "Please select at least one user type";
	exit;
	}
	
	$arrPatient=array();
	$arrPatient=$_POST['rdPatient'];
	
	
	
	if(isset($_POST['ckGender']) && !empty($_POST['ckGender'])) {
	$strGender=implode(", ",$_POST['ckGender']);			
	}
	
	
	$arrEmails=array();
	$arrEmails2=array();
	$arrEmails3=array();
	
	$filterArr=array();
	
	if (isset($arrPatient))
	if (count($arrPatient)>0)
	{
		
		$sqlPatients="select * from tbl_patients where patient_status=1 ";
		
		if (in_array(1,$arrPatient))
		{
			array_push($filterArr,"All Patients");
		}
	
	
		if (in_array(4,$arrPatient))
		{
			if (isset($_POST['cmbConditions']))
			{
			$conditionArr=$_POST['cmbConditions'];	
			$conditionStr=implode(",",$conditionArr);
			
			
					
			$sqlPatients="select DISTINCT(patient_id) as patient_id,patient_email,patient_first_name,patient_middle_name, patient_last_name from tbl_patients, tbl_prescriptions where patient_id=pres_patient_id and pres_condition IN (".$conditionStr.") ";
			}
			else
			{
			echo "Please select some condition";
			exit;
			}
			
			array_push($filterArr,"Patients with selected conditions");
		}
		
		if (in_array(3,$arrPatient))
		{
			$sqlPatients.=" and DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(patient_dob, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(patient_dob, '00-%m-%d')) < 18 ";
			
			 array_push($filterArr,"Patients below 18 years");
		}
		
		if (in_array(2,$arrPatient))
		{
			$sqlPatients.=" and DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(patient_dob, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(patient_dob, '00-%m-%d')) >= 18 ";
			
			array_push($filterArr,"Patients above 18 years");
		}
		
		if (in_array(5,$arrPatient))
		{
			array_push($filterArr,"Recent Patients (i.e. have purchased in the last 12 months)");
		}
		if (in_array(6,$arrPatient))
		{
			array_push($filterArr,"Repeat Order Patients");
		}
	
	
	
	
		if ($sqlPatients!="")
		{
			if (@in_array("Males",$_POST['ckGender']))
			{
				$sqlPatients.=" and patient_gender=1 ";
			}
			if (@in_array("Females",$_POST['ckGender']))
			{
				$sqlPatients.=" and patient_gender=2";
			}
			else
			$sqlPatients.=" and 1";
	
		
		
		$resPatients=$database->get_results($sqlPatients);	
	
		
		
			
		if (count($resPatients)>0)
		{
			$arrEmails=array();
			for ($p=0;$p<count($resPatients);$p++)
			{
				$rowPatients=$resPatients[$p];
				$arrEmails[$p]['name']=$rowPatients['patient_title']." ".$rowPatients['patient_first_name']." ".$rowPatients['patient_middle_name']." ".$rowPatients['patient_last_name'];
				$arrEmails[$p]['email']=$rowPatients['patient_email'];
				$arrEmails[$p]['type']="Patient";
			}
		}
		
	}
	}
	if(isset($_POST['ckUsertype']) && !empty($_POST['ckUsertype']))
	if (in_array("Clinicians",$_POST['ckUsertype']))
	{
		$sqlCl="select * from tbl_prescribers where pres_status=1";
		$resCl=$database->get_results($sqlCl);
		
		if (count($resCl)>0)
		{
			
			for ($p=0;$p<count($resCl);$p++)
			{
				$rowCl=$resCl[$p];
				$arrEmails2[$p]['name']=$rowCl['pres_forename']." ".$rowCl['pres_surname'];
				$arrEmails2[$p]['email']=$rowCl['pres_email'];
				$arrEmails2[$p]['type']="Clinician";
			}
		}
		
	}
	
	
	
	if(isset($_POST['ckUsertype']) && !empty($_POST['ckUsertype']))
	if (in_array("Pharmacies",$_POST['ckUsertype']))
	{
		$sqlCl="select * from tbl_pharmacies where pharmacy_status=1";
		$resCl=$database->get_results($sqlCl);
		
		if (count($resCl)>0)
		{
			
			for ($p=0;$p<count($resCl);$p++)
			{
				$rowCl=$resCl[$p];
				$arrEmails3[$p]['name']=$rowCl['pharmacy_name'];
				$arrEmails3[$p]['email']=$rowCl['pharmacy_email'];
				$arrEmails3[$p]['type']="Pharmacy";
			}
		}
		
	}
	
	$arrEmails=array_merge($arrEmails,$arrEmails2,$arrEmails3);
	
	
	
	echo "Sending emails to users, please wait..";
	
	
	include PATH."include/email-templates/email-template.php";
	include_once PATH."mail/sendmail.php";
	
	for ($k=0;$k<count($arrEmails);$k++)
	{			
	
		$rowRec=$arrEmails[$k];	
		$receiverEmail=$rowRec['email'];
		$receiverName=$rowRec['name'];
		
		
		//-----------Sending mass emails----
		
					$emailContent=fnUpdateHTML($_POST['page_description']);					
					
					$emailContent=str_replace("<name>",$receiverName,$emailContent);					
					$emailContent=str_replace("\n","<br>",$emailContent);					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$receiverEmail;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;				
				$SubjectSend=$_POST['txtSubject'];
				$BodySend=$mailBody;			

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);	
				
					
		
		//----------end sending mass emails-----	
		
	}
	
	$curDate=date("Y-m-d H:i:s");
	
	
	if (isset($filterArr))
	{
		if (count($filterArr)>0)
		{
			$broadcastFilter=implode(", ",$filterArr);
		}
	}
	
   if ($conditionStr!="")
   {
	   $conditionNameStr=getConditionName_multi($conditionStr);
   }
	
	
	//$conditionName=getConditionNameVar($_POST['cmbConditions']);

		$names = array(
			'broadcast_subject' => $_POST['txtSubject'], 			
			'broadcast_email' => $_POST['page_description'],
			'broadcast_patient_filters' => $broadcastFilter,
			'broadcast_filter_condition' => $conditionNameStr,						  
			'broadcast_sent_to' => $strType,
			'broadcast_sent_to_gender' => $strGender,
			'broadcast_sent_date' => $curDate,
			'broadcast_status' => 1			

		);			
		$add_query = $database->insert( 'tbl_broadcasts', $names );	

		
	
		
		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}


	}

	function removeSelectedItems()
	{
		global $database,$component;
		for($i = 0; $i < count($_GET['deletes']); $i++)
		{

			 $provinceIdToPublish = $_GET['deletes'][$i];
			 $where_clause = array(
				'broadcast_id' => $provinceIdToPublish
			);

			$delete = $database->delete( 'tbl_broadcasts', $where_clause, 1 );

		}	

		if( $delete )
		{
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}



		



?>