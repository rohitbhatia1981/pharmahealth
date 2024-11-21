<?php include "../../../private/settings.php";

if ($_POST['mid']!="")
{
	
	
	
	
		$subCat="<option value=''>Select Strength</option>";
		
		$sqlCategory="select mp_strength,mp_unit from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."'";
		$resCategory=$database->get_results($sqlCategory);
								
		for ($k=0;$k<count($resCategory);$k++)
		{
			$rowCategory=$resCategory[$k];
			
			/*if ($_POST['selectedValue']==$rowCategory['bc_id'])
			$selected="selected"; 
			else
			$selected="";*/
			
			$subCat.="<option value='".$rowCategory['mp_strength']."'>".$rowCategory['mp_strength'].' '.$rowCategory['mp_unit']."</option>";
		}
		
		echo $subCat;
}


 ?>
 