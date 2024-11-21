<?php include "../../../private/settings.php";
$str="<option value=''>Select </option>";	
if ($_POST['mid']!="")
{
	
	$sqlStrength="select mp_strength,mp_unit from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."'";
	$resStrength=$database->get_results($sqlStrength);
	if (count($resStrength)>0)
	{
		$str="<option value=''>Select </option>";	
		for ($k=0;$k<count($resStrength);$k++)
		{
				$rowStrength=$resStrength[$k];
	
				$str.="<option value='".$rowStrength['mp_strength'].' '.$rowStrength['mp_unit']."'>".$rowStrength['mp_strength'].' '.$rowStrength['mp_unit']."</option>";
		}
	}

echo $str;
}


 ?>
 