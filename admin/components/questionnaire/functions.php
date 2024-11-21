<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_medical_questions where 1 order by page_title asc";


		$sql = "SELECT * FROM tbl_medical_questions,tbl_questionnaire_categories,tbl_conditions where mq_conditions=condition_id and qc_id=mq_category";

		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and mq_questions like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}
		
		if($_GET['cmbCategory'] != "")
		{
			$sql .= " and find_in_set('".$database->filter($_GET['cmbCategory'])."',mq_conditions)";

		}
		
		if($_GET['cmbCat'] != "")
		{
			$sql .= " and find_in_set('".$database->filter($_GET['cmbCat'])."',mq_category)";

		}
		
		if($_GET['cmbAnsType'] != "")
		{
			$sql .= " and mq_answer_type ='".$database->filter($_GET['cmbAnsType'])."' ";

		}
		
		
		
		


		$sql .= " order by condition_title asc,mq_category,mq_order asc";


		//print_r($sql);

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );
		
		

		

	}

	

	

	function saveFormValues()

	{
		
		

	global $database, $component;

		
	
	
	//if (count($_POST['cmbConditions'])>0)			
	//$strConditions=implode(",",$_POST['cmbConditions']);
	
	if (count($_POST['txtOptions'])>0)	
	$arrOptions=serialize($_POST['txtOptions']);
	
	if (count($_POST['cmbRisk'])>0)	
	$arrRisk=serialize($_POST['cmbRisk']);
	
	if (is_array($_POST['ckMoreInfo']))
	{
	if (count($_POST['ckMoreInfo'])>0)
	$strAskOptions=@implode(",",$_POST['ckMoreInfo']);
	}
	
	
	
	
	$updateExistPos="update tbl_medical_questions set mq_order=mq_order+1 where mq_order>'".$database->filter($_POST['cmbPosition'])."' and mq_conditions='".$database->filter($_POST['cmbConditions'])."' and mq_category='".$database->filter($_POST['cmbCategory'])."'";
	$database->query($updateExistPos);
	
	

		$names = array(

			'mq_conditions' => $_POST['cmbConditions'], 
			'mq_questions' => $_POST['txtQuestion'], 
			'mq_category' => $_POST['cmbCategory'],
			'mq_answer_type' => $_POST['cmbAnsType'],			
			'mq_multiple_options' => $arrOptions,
			'mq_risk_level' =>$arrRisk,
			'mq_tooltip_status' => $_POST['ckTooltip'],
			'mq_medical_background_link' => $_POST['cmbBackground'],
			'mq_tooltip_text' => $_POST['txtInformation'],			
			'mq_ask_for_information' => $strAskOptions,
			'mq_status' => $_POST['rdoPublished'] //Random thing to insert

		);
		$add_query = $database->insert( 'tbl_medical_questions', $names );
		$lastInsertedId=$database->lastid();
		
		
		
		//--------Position update----
		
		
		
		$position=$_POST['cmbPosition']+1;
		
		$update = array(
			'mq_order' => $position		
			);
		$where_clause = array(
			'mq_id' => $lastInsertedId
		);
		$updated = $database->update( 'tbl_medical_questions', $update, $where_clause, 1 );
		
		
		
		
		//--------end position update---
		
		resetOrder($_POST['cmbConditions'],$_POST['cmbCategory']);
		
		
		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				 $sql = "SELECT * FROM tbl_medical_questions where mq_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{
		

			global $database,$component;	

			
	//if (count($_POST['cmbConditions'])>0)			
	//$strConditions=implode(",",$_POST['cmbConditions']);
	
	if (count($_POST['txtOptions'])>0)
	{	
		$arrOptions=array_filter($_POST['txtOptions']);
		$arrOptions=serialize($arrOptions);
	}
	
	if (count($_POST['cmbRisk'])>0)	
	{
		$arrRisk=array_filter($_POST['cmbRisk']);
		$arrRisk=serialize($arrRisk);
	}
	
	if (is_array($_POST['ckMoreInfo']))
	{
	if (count($_POST['ckMoreInfo'])>0)
	$strAskOptions=@implode(",",$_POST['ckMoreInfo']);
	}
	
	
	
	
						

			$update = array(

			'mq_conditions' => $_POST['cmbConditions'],  
			'mq_questions' => $_POST['txtQuestion'], 
			'mq_category' => $_POST['cmbCategory'],
			'mq_answer_type' => $_POST['cmbAnsType'],			
			'mq_multiple_options' => $arrOptions,
			'mq_risk_level' =>$arrRisk,
			'mq_tooltip_status' => $_POST['ckTooltip'],
			'mq_medical_background_link' => $_POST['cmbBackground'],
			'mq_tooltip_text' => $_POST['txtInformation'],	
			'mq_ask_for_information' => $strAskOptions,
			'mq_status' => $_POST['rdoPublished'] //Random thing to insert

			);

//Add the WHERE clauses

		$where_clause = array(

			'mq_id' => $_POST['pageId']

		);
		$updated = $database->update( 'tbl_medical_questions', $update, $where_clause, 1 );

		//------position update-----
		$positionUp=$_POST['cmbPosition']+0.5;
		
		$updateExistPos="update tbl_medical_questions set mq_order='".$database->filter($positionUp)."' where mq_id='".$database->filter($_POST['pageId'])."'";
		$database->query($updateExistPos);
		
		resetOrder($_POST['cmbConditions'],$_POST['cmbCategory']);
		
		//-------end position update---

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'mq_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'mq_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_medical_questions', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}

	

	function unpublishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'mq_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'mq_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_medical_questions', $update, $where_clause, 1 );

		}

		

		if( $updated )

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

			

			

			//Add the WHERE clauses

			$where_clause = array(

				'mq_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_medical_questions', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}


	function removeDeletedItems()

	{

		global $database,$component;	

		

			 $provinceIdToPublish = $_GET['id'];

			

			//Add the WHERE clauses

			$where_clause = array(

				'faq_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_medical_questions', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."'</script>";

		}

		
function resetOrder($condition,$category)
{
	global $database;
	
	$sqlOrder="select * from tbl_medical_questions where mq_conditions='".$database->filter($condition)."' and mq_category='".$database->filter($category)."' order by mq_order";
	
	$resOrder=$database->get_results($sqlOrder);
	
	if (count($resOrder)>0)
	{
		
		for ($j=0;$j<count($resOrder);$j++)
		{
			$rowOrder=$resOrder[$j];
			$order=$j+1;
			
			$update="update tbl_medical_questions set mq_order='".$order."' where mq_id='".$database->filter($rowOrder['mq_id'])."' ";
			$database->query($update);
		}
	}
	
}

function addImageToOption()
{
global $database;
// Check if the form is submitted

    // Check if file is uploaded
    if (isset($_FILES['txtImage'])) {
		
		$new_file_name = $_POST['hdQue']."-".$_POST['hdOptId'];
	    $file_extension = pathinfo($_FILES['txtImage']['name'], PATHINFO_EXTENSION);
		$new_file_name_with_extension = $new_file_name . "." . $file_extension;
		
        $file_name = $_FILES['txtImage']['name'];
        $file_tmp = $_FILES['txtImage']['tmp_name'];

        // Specify the directory where you want to store the uploaded files
        $uploadDirectory = PATH."uploads/questionnaire/";

        // Move the uploaded file to the desired directory
        $destination = $uploadDirectory . $new_file_name_with_extension;
        if (move_uploaded_file($file_tmp, $destination)) {
           //------insert into table--
		   
		   $names = array(
			'qi_question' => $_POST['hdQue'], 
			'qi_image' => $new_file_name_with_extension,
			'qi_option' => $_POST['hdOptId']
			

			);

		
		$add_query = $database->insert( 'tbl_question_images', $names );
		   
		   //-----end insertion on table---
        } else {
            echo "Error moving file.";
			exit;
        }
    } else {
        echo "No file was uploaded.";
		exit;
    }
	
	print "<script>window.location='?c=questionnaire&task=edit&id=".$_POST['hdQue']."'</script>";


}

function delImg()
{
		
		global $database;
		
		$where_clause = array(

				'qi_id' => $_GET['id']

			);

			$delete = $database->delete( 'tbl_question_images', $where_clause, 1 );
			
			@unlink(PATH."uploads/questionnaire/".$_GET['image']);
			
			
	print "<script>window.location='?c=questionnaire&task=edit&id=".$_GET['qid']."'</script>";
}


?>