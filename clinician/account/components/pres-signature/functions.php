<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


	 $sql="select * from tbl_prescribers where pres_id='".$_SESSION['sess_prescriber_id']."'";
	
	
		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	


	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

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
		
		
		$arrExisting=array();
			if ($_POST['hdExistingCert']!="" && $_POST['hdExistingCert']!="N;")
			{
			
			$arrExisting=unserialize($_POST['hdExistingCert']);
			$arrFileNames=array_merge($arrFileNames,$arrExisting);
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
		
			$arrExisting2=array();
			if ($_POST['hdExistingCPD']!="" && $_POST['hdExistingCPD']!="N;")
			{
			
			$arrExisting2=unserialize($_POST['hdExistingCert']);
			$arrFileNames2=array_merge($arrFileNames2,$arrExisting2);
			}
			
			
			$arrFnamesSer2=serialize($arrFileNames2);	
		}
		
		
		
			
			
				
			
		
		
		//----------end CPD cert uploading
		
		
		//--------end uploading multiple documents

			$update = array(

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
			'pres_e_address2' => $_POST['txt_e_Address2'],
			'pres_e_city' => $_POST['txt_e_city'],
			'pres_e_postcode' => $_POST['txt_e_Postcode'],			
			'pres_e_country' => $_POST['cmb_e_Country'],			
			'pres_qualification_cert' => $arrFnamesSer,
			'pres_cpd_cert' => $arrFnamesSer2,
			'pres_pension_opt_out' => $_POST['rdoPension'],
			

			);

//Add the WHERE clauses

		$where_clause = array(

			'pres_id' => $_SESSION['sess_prescriber_id']

		);
		$updated = $database->update( 'tbl_prescribers', $update, $where_clause, 1 );
		
		

		$lastInsertedId=$_SESSION['sess_prescriber_id'];
		
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

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&done=1'</script>";

		}

			 

	}

	

	


	

	

		



?>