<?php include "../../../private/settings.php";

if ($_POST['mid']!="")
{
	
	
	
	
		$subCat="<option value=''>Select Pack</option>";
		
		$sqlCategory="select mp_pack_size,mp_formulation from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."' and mp_strength='".$database->filter($_POST['sid'])."'";
		$resCategory=$database->get_results($sqlCategory);
								
		for ($k=0;$k<count($resCategory);$k++)
		{
			$rowCategory=$resCategory[$k];
			
			/*if ($_POST['selectedValue']==$rowCategory['bc_id'])
			$selected="selected"; 
			else
			$selected="";*/
			
			$subCat.="<option value='".$rowCategory['mp_pack_size']."'>".$rowCategory['mp_pack_size'].' '.$rowCategory['mp_formulation']."</option>";
		}
		
		echo $subCat;
}


 ?>
 