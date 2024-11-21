<?php include "../../../private/settings.php";

$str="<option value=''>Select </option>";	
if ($_POST['mid']!="" && $_POST['sid']!="" && $_POST['pid']!="")
{
	
	
	$sqlQuery="select mp_condition1_max_qty,mp_pack_size from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."' and mp_strength='".$database->filter($_POST['sid'])."' and mp_pack_size='".$database->filter($_POST['pid'])."'";
	$resQuery=$database->get_results($sqlQuery);
	if (count($resQuery)>0)
	{
		$rowQuery=$resQuery[0];
		$loopSize=ceil($rowQuery['mp_condition1_max_qty']/$rowQuery['mp_pack_size']);
				
			for ($k=1;$k<=$loopSize;$k++)
			{	
	
				$str.="<option value='".$k."'>".$k."</option>";
			}
		
	}

echo $str;
}


 ?>
 