<?php include "../../../private/settings.php";

include PATH."patient/checksession.php";
//print_r ($_POST['txtAbtQue']);

$_SESSION['sessOverallRisk']=1;

$valueRisk=1;



$arraySy=array();
$_SESSION['arrAllergy']=array();
$_SESSION['arrCondition']=array();
$_SESSION['arrMedication']=array();

//print_r ($_SESSION['questions3']);

for ($k=0;$k<count($_SESSION['questions3']);$k++)
{
	$question=$_SESSION['questions3'][$k]['question'];
	$id=$_SESSION['questions3'][$k]['id'];
	$type=$_SESSION['questions3'][$k]['type'];
	$imageType=0;
	
	
	if ($type==1)
	{
		$arrSing=explode("~~~",$_POST['rd_'.$id]);
		//$value=$_POST['rd_'.$id];
		$value=$arrSing[0];
		$valueRisk=$arrSing[1];
		
		if ($valueRisk>$_SESSION['sessOverallRisk'])
		$_SESSION['sessOverallRisk']=$valueRisk;
		
	}
	if ($type==2)
	{
		$value=@implode("|",$_POST['ck_'.$id]);
		
		
		
		//---------picking risk values from string and getting highest value risk--
		
		preg_match_all('/[0-3]+/', $value, $matches);
		
		
		
		if (count($matches[0])>0)
		{
			foreach ($matches[0] as $valueRisk)
			{
				
				
				if ($valueRisk>$_SESSION['sessOverallRisk'])
				$_SESSION['sessOverallRisk']=$valueRisk;
				
			}
		}
		
		//--------end matching------
		
		/*$arrSing=explode("~~~",$valuePass);
		$value=$arrSing[0];
		$valueRisk=$arrSing[1];
		*/
		
	}
	if ($type==3)
	$value=$_POST['txt_'.$id];
	
	if ($type==4)
	{
		if (isset($_POST['images4ex']))	
		if (count($_POST['images4ex'])>0)
		{
			$value=implode(",",$_POST['images4ex']);
		}
		
	
	$imageType=1;
	}
	
	//-----------Updating medical background of patient---
	
	if ($type==2)
	{
		
		$sqlMb="select * from tbl_medical_questions where mq_id='".$database->filter($id)."'";
		$resMb=$database->get_results($sqlMb);
		$rowMb=$resMb[0];
		if ($rowMb['mq_medical_background_link']!=0)
		{
			
			//----removing characters ~~~<any number> from the string---instead of that adding pipe
			$new_string = preg_replace('/~~~\d+(?:\||$)/', '|', $value);
			
			if ($rowMb['mq_medical_background_link']==1)
			array_push($_SESSION['arrAllergy'],$new_string);
			else if ($rowMb['mq_medical_background_link']==2)
			array_push($_SESSION['arrCondition'],$new_string);
			else if ($rowMb['mq_medical_background_link']==3)
			array_push($_SESSION['arrMedication'],$new_string);
			
		}
		
		

		
		
		
		
			/*$curDate=date("Y-m-d");
			$names = array(	
				'mb_details' => $new_string, 
				'mb_patient_id' => $_SESSION['sess_patient_id'],
				'mb_type' => 1,
				'mb_added_date' => $curDate,
				'mb_added_type' => 'through assessment'		
			);
	
			$add_query = $database->insert( 'tbl_patient_medical_background', $names );		
			*/
	} 
	
	//-----------upgrading patient background
	
	$arraySy[$k]['question']=base64_encode($question);
	$arraySy[$k]['answer']=base64_encode($value);
	$arraySy[$k]['risk']=base64_encode($valueRisk);
	$arraySy[$k]['image']=base64_encode($imageType);
	
	if ($_POST['txtMore_'.$id]!="")
	$arraySy[$k]['more']=base64_encode($_POST['txtMore_'.$id]);
	
	
	
}


/*
$filteredPostData = array();

foreach ($_POST as $key => $value) {
    if (strpos($key, 'txtMore_') === 0) {
        $filteredPostData[$key] = $value;
    }
}



$j=0;
foreach ($filteredPostData as $key => $value) {
   // echo "Key: " . $key . ", Value: " . $value . "<br>";
	
	
	$arrKeyVal=explode("_",$key);
	$option=$arrKeyVal[1];
	$question=$arrKeyVal[2];
	
	$arrMoreFinal[$j]['question']=$question;
	$arrMoreFinal[$j]['option']=$option;
	$arrMoreFinal[$j]['text']=base64_encode($value);
	
	$j++;
}

*/


$add_date = date('Y-m-d H:i:s');

	
	$update = array(
	'pres_symptoms' => serialize($arraySy),
	//'pres_symptoms_more' => serialize($arrMoreFinal),
	'pres_date' => $add_date
	);
	
	$where_clause = array(
	'pres_id' => $_SESSION['sess_pres_id']

	 );
	
	$database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
	
	




echo "1";

 ?>











      



    