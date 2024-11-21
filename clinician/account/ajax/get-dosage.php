<?php include "../../../private/settings.php";
$str="<option value=''>Select Dosage</option>";	

if ($_POST['mid']!="" && $_POST['sid']!="")
{
	
	$strength=$_POST['sid'];
	$arrStr=explode(" ",$strength);	
	
	print $sqlDosage="select mp_dosage1, mp_dosage2 from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."' and mp_strength='".$database->filter($arrStr[0])."'";

	$resDosage=$database->get_results($sqlDosage);
	if (count($resDosage)>0)
	{
		
		
				$rowDosage=$resDosage[0];
	
				if ($rowDosage['mp_dosage1']!="")
				$str.="<option value='".$rowDosage['mp_dosage1']."'>".$rowDosage['mp_dosage1']."</option>";
				
				if ($rowDosage['mp_dosage2']!="")
				$str.="<option value='".$rowDosage['mp_dosage2']."'>".$rowDosage['mp_dosage2']."</option>";
		
	}

$str.="<option value='1'>Other (Free Type)</option>";	
echo $str;
}



 ?>
 