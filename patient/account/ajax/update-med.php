<?php include "../../../private/settings.php";

if ($_POST['prId']!="")
{

	
		 // Charge Patient Stripe payment
       	 $sqlPayments = "SELECT * FROM tbl_payments WHERE payment_pres_id='" . $database->filter($_POST['prId']) . "' and payment_patient_id='".$_SESSION['sess_patient_id']."'";
       	 $resPayments = $database->get_results($sqlPayments);
				if (count($resPayments) > 0) {
					$rowPayments = $resPayments[0];
					$customer_id = $rowPayments['payment_stripe_customer_id'];
					$amountCharge=$_SESSION['sessNewPrice'];
					$presId=$_POST['prId'];
					include PATH . "patient/questionnaire/autocharge.php";
					
					//print $charge_id = $rowPayments['payment_stripe_charge_id'];
					//include PATH . "patient/questionnaire/capture-payment.php";
					
					
					
					
	} else
	exit;
				
		//echo ">>>".$result;
			if($result == "success" ){
				
				
				//echo "Payment successful";
				
				//task to perform on payment success..
				
				//1. Put data into pre approval table of prescription medicaiton
				//2. Delete existing medication
				//3. Insert medication
				//4. update status of button
				//5. Calculate payment sharing & Update payment sharing table
				//6. Approval process of prescription
				//7. Creating log---
				
				//1. Put data into pre approval table of prescription medicaiton
			
		$sqlMed="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($_POST['prId'])."'";
		$resMed=$database->get_results($sqlMed);
		if (count($resMed)>0)
		{
		
			for ($k=0;$k<count($resMed);$k++)
			{
				$rowMed=$resMed[$k];
				
				$names = array(
				'pm_pres_id' => $rowMed['pm_pres_id'],
				'pm_med' => $rowMed['pm_med'],
				'pm_med_price' => $rowMed['pm_med_price'],
				'pm_med_qty' => $rowMed['pm_med_qty'],
				'pm_med_dosage' => $rowMed['pm_med_dosage'],
				'pm_med_strength' => $rowMed['pm_med_strength'],
				'pm_med_total' => $rowMed['pm_med_total']
				
				);
				//$add_query = $database->insert('tbl_prescription_medicine_change_requests_pre-approval', $names );
			}
		}
			
			//-----1. end pre approval table insertion----
			
		
		//2. Delete existing medication
		
		$delMed="delete from tbl_prescription_medicine where pm_pres_id='".$database->filter($_POST['prId'])."'";
		$database->query($delMed);
		
		
		//2.--- end delete existing medication	
		
			//3. Insert medication
		
		$sqlMed="select * from tbl_prescription_medicine_change_requests where pm_pres_id='".$database->filter($_POST['prId'])."'";
		$resMed=$database->get_results($sqlMed);
		if (count($resMed)>0)
		{
		
			for ($k=0;$k<count($resMed);$k++)
			{
				$rowMed=$resMed[$k];
				
				$names = array(
				'pm_pres_id' => $rowMed['pm_pres_id'],
				'pm_med' => $rowMed['pm_med'],
				'pm_med_price' => $rowMed['pm_med_price'],
				'pm_med_qty' => $rowMed['pm_med_qty'],
				'pm_med_dosage' => $rowMed['pm_med_dosage'],
				'pm_med_packsize' => $rowMed['pm_med_packsize'],
				'pm_med_strength' => $rowMed['pm_med_strength'],
				'pm_med_total' => $rowMed['pm_med_total'],
				
				);
				$add_query = $database->insert('tbl_prescription_medicine', $names );
			}
		}
		
		
		//----3. End inserting medication
		
		//-------4. update button stage-----
		
		$curDate=date("Y-m-d");
		
			$update = array(			 
			 'pres_medicine_change_status'  => 3			 
			 
			);			
			$where_clause = array(
			'pres_id' => $_POST['prId']
			);

			$updated = $database->update('tbl_prescriptions', $update, $where_clause, 1 );
		
		
		//-------4. end update button stage----
		
		//5. Calculate payment sharing and update payment table--
		
		$sqlMed="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($_POST['prId'])."'";
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
								$arrPackSize=explode(" ",$rowMed['pm_med_packsize']);
								
								
								
	
	 $sqlCategory="select * from tbl_medication_pricing where mp_medicine='".$database->filter($medicineId)."' and mp_strength='".$database->filter($arrStrenth[0])."' and mp_pack_size='".$database->filter($arrPackSize[0])."' ";
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
	$priceTocharge=calculatePrice_plus($quantity,$medicationCost, $tier, $costPrice);
	}
	else
	$priceTocharge=calculatePrice($baseprice, $quantity);
	
	$profitPharma=CONSULTATION_ACTUAL_PAY+($priceTocharge-$medicationCost-CONSULTATION_COST)*0.3;
	$pharmacyProfit=($priceTocharge-$medicationCost-CONSULTATION_COST)*0.7;
	$add_date = date('Y-m-d H:i:s');
	
		$update = array(			 
			 'payment_amount'  => $_SESSION['sessNewPrice'],
			 'payment_medication_cost' => $medicationCost,
			 'payment_pharma_profit' => $profitPharma,
			 'payment_pharmacy_profit' => $pharmacyProfit,
			 'payment_date' => $add_date,
			 'payment_status' => 1			 			 
			 
			);			
			$where_clause = array(
			'payment_pres_id' => $_POST['prId']
			);

			$updated = $database->update('tbl_payments', $update, $where_clause, 1 );
						}
						}
					}
				}
		
		//----5. End calculation payment sharing---
							
			
				//6. Approval process of prescription
		
		 $update = array(
                'pres_stage' => 6,
                'pres_pharmacy_stage' => 1
            );   
		
		$where_clause = array(
			'pres_id' => $_POST['prId']
			);

			$updated = $database->update('tbl_prescriptions', $update, $where_clause, 1 );         
          
            
           // getPresAction($_POST['prId'], $_SESSION['sess_prescriber_id'], 'clinician', 'Approved Prescription');
            
           
            
            // Send email to patient
            include PATH . "include/email-templates/email-template.php";
            include_once PATH . "mail/sendmail.php";
            
            $arrMedicineName = array();
            $sqlMedicine = "SELECT * FROM tbl_prescription_medicine WHERE pm_pres_id='" . $database->filter($_POST['prId']) . "'";
            $resMedicine = $database->get_results($sqlMedicine);
            for ($m = 0; $m < count($resMedicine); $m++) {
                $rowMedicine = $resMedicine[$m];
                array_push($arrMedicineName, $rowMedicine['pm_med']);
            }
            
            $strMedicine = count($arrMedicineName) > 0 ? implode(",", $arrMedicineName) : "";
            
						
			
			$getPatientId = "SELECT pres_patient_id,pres_condition FROM tbl_prescriptions WHERE pres_id='" . $database->filter($_POST['prId']) . "'";
            $resPatientId = $database->get_results($getPatientId);
			$rowPatientDet=$resPatientId[0];
            $patientId = $rowPatientDet['pres_patient_id'];
			
			
            $sqlCheck = "SELECT * FROM tbl_patients WHERE patient_id='" . $database->filter($patientId) . "'";
            $resCheck = $database->get_results($sqlCheck);
            $rowMemberid = $resCheck[0];
            
            $orderId = PRES_ID . $_POST['prId'];
            $medicineName = $strMedicine;
            $receiverName = $rowMemberid['patient_title'] . " " . $rowMemberid['patient_first_name'] . " " . $rowMemberid['patient_middle_name'] . " " . $rowMemberid['patient_last_name'];
            $email = $rowMemberid['patient_email'];
            
            $clName = $_SESSION['name'];
            $sqlEmail = "SELECT * FROM tbl_emails WHERE email_id=19 AND email_status=1";
            $resEmail = $database->get_results($sqlEmail);
            
            if (count($resEmail) > 0) {
                $rowEmail = $resEmail[0];
                $emailContent = fnUpdateHTML($rowEmail['email_description']);
                $emailContent = str_replace("<order_id>", $orderId, $emailContent);
                $emailContent = str_replace("<medicine_name>", $medicineName, $emailContent);
                $emailContent = str_replace("<name>", $receiverName, $emailContent);
                $emailContent = str_replace("<clinician_name>", $clName, $emailContent);
                $emailContent = str_replace("\n", "<br>", $emailContent);
                
                $headingContent = $emailContent;
                $mailBody = generateEmailBody($headingTemplate, $headingContent, $buttonTitle, $buttonLink, $bottomHeading, $bottomText);
                
                $ToEmail = $rowMemberid['patient_email'];
                $FromEmail = ADMIN_FORM_EMAIL;
                $FromName = FROM_NAME;
                $SubjectSend = "Order Approved";
                $BodySend = $mailBody;
                
                SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				
				//-----------6.2 Send email to Pharmacy on approval------
				
					
					
					$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($rowMemberid['patient_pharmacy'])."'";
					$loadPharmacy=$database->get_results($sqlPharmacy);
					$rowPharmacy=$loadPharmacy[0];
					$pharmacy_name=$rowPharmacy['pharmacy_name'];
					$pharmacy_email=$rowPharmacy['pharmacy_o_email'];
					$patient_condition=getConditionNameVar($rowPatientDet['pres_condition']);
					
					
			$sqlEmail = "SELECT * FROM tbl_emails WHERE email_id=61 AND email_status=1";
            $resEmail = $database->get_results($sqlEmail);
            
            if (count($resEmail) > 0) {
                $rowEmail = $resEmail[0];
                $emailContent = fnUpdateHTML($rowEmail['email_description']);
              
                $emailContent = str_replace("<pharmacy_name>", $pharmacy_name, $emailContent);
                $emailContent = str_replace("<condition>", "<strong>".$patient_condition."</strong>", $emailContent);
				$emailContent = str_replace("<patient_name>", "<strong>".$receiverName."</strong>", $emailContent);
				
                $emailContent = str_replace("\n", "<br>", $emailContent);
                
                $headingContent = $emailContent;
                $mailBody = generateEmailBody($headingTemplate, $headingContent, $buttonTitle, $buttonLink, $bottomHeading, $bottomText);
                
                $ToEmail = $pharmacy_email;
                $FromEmail = ADMIN_FORM_EMAIL;
                $FromName = FROM_NAME;
                $SubjectSend = "Patient order approval notification";
              	$BodySend = $mailBody;
				
                
                SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
			
				
               }
				
				//-----------end sending email to pharmacy on approval---
				
				
				
				
               }
		
		//6.--- End of approval process of prescription
		
		
		 
		
		//----------7. Creating log--------
				
				
				
				getPresAction($_POST['prId'],$_SESSION['sess_patient_id'],'patient','Accepted a medication request sent by clinician');
		
					$name=$_SESSION['name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." accepted a medication alteration request for prescription ID:".PRES_ID.$_POST['prId'];;
					
					createLogs($uid,$utype,$action);
		
				//----------7. end creating log
				
				
			}
			echo "1";
}

?>
