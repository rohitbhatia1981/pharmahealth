<?php include "../../private/settings.php";

if ($_POST['mid']!="")
{
	
	
	
	
		$subCat='<div class="strength_box">
                        <h6>Pack Size:</h6>
                        <ul>';
		
		$sqlCategory="select mp_pack_size,mp_formulation,mp_pack_unit from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."' and mp_strength='".$database->filter($_POST['sid'])."'";
		$resCategory=$database->get_results($sqlCategory);
								
		for ($k=0;$k<count($resCategory);$k++)
		{
			$rowCategory=$resCategory[$k];
			
			/*if ($_POST['selectedValue']==$rowCategory['bc_id'])
			$selected="selected"; 
			else
			$selected="";*/
			
			//$subCat.="<option value='".$rowCategory['mp_pack_size']."'>".$rowCategory['mp_pack_size'].' '.$rowCategory['mp_formulation']."</option>";
			$packSize=$rowCategory['mp_pack_size'];
			$packUnit=$rowCategory['mp_pack_unit'];
			
			if ($_SESSION['sessCart'][$_POST['indexId']]['med_pack']!="")
						{
							$packSizeSess=explode(" ",$_SESSION['sessCart'][$_POST['indexId']]['med_pack']);
							$packSessVal=$packSizeSess[0];
						}
			
			if ($packSessVal=="")
			{
				if ($k==0)
				$checked="checked";
				else
				$checked="";
			}else
			{
				if ($packSize==$packSessVal)
				$checked="checked";
				else
				$checked="";
				
			}
			
			$subCat.='
                            <li>
                                <label>
                                    <input  type="radio" onchange="getQuantity()" '.$checked.' name="rdPack" value="'.$packSize.'">
                                    <span>'.$packSize.' '.$packUnit.'</small></span>
                                </label>
                            </li>
                            
                       ';
			
		}
		$subCat.='</ul></div>';
		
		echo $subCat;
}


 ?>
 