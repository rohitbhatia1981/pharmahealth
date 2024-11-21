<?php include "../../../private/settings.php";
$str="<option value=''>Select </option>";	
if ($_POST['mid']!="" && $_POST['sid']!="")
{
	
	$sqlQuery="select mp_pack_size,mp_formulation,mp_pack_unit from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."' and mp_strength='".$database->filter($_POST['sid'])."'";
	$resQuery=$database->get_results($sqlQuery);
	if (count($resQuery)>0)
	{
		$str="<option value=''>Select </option>";	
		for ($k=0;$k<count($resQuery);$k++)
		{
				$rowQuery=$resQuery[$k];
				
				$packSize=$rowQuery['mp_pack_size'];
				$packUnit=$rowQuery['mp_pack_unit'];
	
				$str.="<option value='".$packSize.' '.$packUnit."'>".$packSize.' '.$packUnit."</option>";
		}
	}

echo $str;

	
}


 ?>
 