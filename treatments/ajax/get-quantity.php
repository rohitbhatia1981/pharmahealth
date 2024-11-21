<?php include "../../private/settings.php";

if ($_POST['mid']!="")
{
	
	
	
	
		$subCat='<div class="strength_box" style="padding-bottom:10px; margin-bottom:0px">
					<h6>Pack Quantity:</h6>
					<ul>
						
						
					';
		
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
			
			if ($_SESSION['sessCart'][$_POST['indexId']]['med_qty']!="")
			$pQty=$_SESSION['sessCart'][$_POST['indexId']]['med_qty'];
			
			
			for ($k=1;$k<=$loopSize;$k++)
			{
				
				if ($pQty=="")
				{
					if ($k==1)
					$checked="checked";
					else
					$checked="";
				}
				else
				{
					if ($k==$pQty)
					$checked="checked";
					else
					$checked="";
				}
				
				
				
				$subCat.='<li >
							<label>
								<input value="'.$k.'" '.$checked.'  type="radio" name="rdQuantity" onchange="getPrice()">
								<span style="min-width:50px !important">'.$k.'</small></span>
							</label>
						</li>
						';
			}
		}
		$subCat.='</ul>
				</div>';
		
		echo $subCat;
		
}


 ?>
 