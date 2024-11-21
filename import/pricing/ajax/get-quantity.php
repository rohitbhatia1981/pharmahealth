<?php include "../../../private/settings.php";

if ($_POST['mid']!="")
{
	
	
	
	
		$subCat="<option value=''>Select-Quantity</option>";
		
		$sqlCategory="select mp_condition1_max_qty,mp_pack_size from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."' and mp_strength='".$database->filter($_POST['sid'])."' and mp_pack_size='".$database->filter($_POST['pid'])."'";
		
		$resCategory=$database->get_results($sqlCategory);
								
		for ($k=0;$k<count($resCategory);$k++)
		{
			$rowCategory=$resCategory[$k];
			
			/*if ($_POST['selectedValue']==$rowCategory['bc_id'])
			$selected="selected"; 
			else
			$selected="";*/
			$loopSize=ceil($rowCategory['mp_condition1_max_qty']/$rowCategory['mp_pack_size']);
			
			for ($k=1;$k<=$loopSize;$k++)
			{
				$subCat.="<option value='".$k."'>".$k."</option>";
			}
		}
		
		echo $subCat;
}


 ?>
 