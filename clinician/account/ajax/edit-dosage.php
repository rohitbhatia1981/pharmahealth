<?php include "../../../private/settings.php";



if ($_GET['commonId']==0)
{
$sqlpm="select * from tbl_prescription_medicine where pm_id='".$database->filter($_GET['id'])."'";
$respm=$database->get_results($sqlpm);
$rowpm=$respm[0];
$medId=getMedicineId($rowpm['pm_med']);

if ($medId>0)
{

$strength=$rowpm['pm_med_strength'];
$arrStr=explode(" ",$strength);	

$sqlDosage="select mp_dosage1, mp_dosage2,mp_medicine,mp_id from tbl_medication_pricing where mp_medicine='".$database->filter($medId)."' and mp_strength='".$arrStr[0]."'";
$resDosage=$database->get_results($sqlDosage);


if (count($resDosage)>0)
	{
			$rowDosage=$resDosage[0];
			$str="<option value=''>Select Dosage</option>";
				if ($rowDosage['mp_dosage1']!="")
				$str.="<option value='".$rowDosage['mp_dosage1']."'>".$rowDosage['mp_dosage1']."</option>";
				
				if ($rowDosage['mp_dosage2']!="")
				$str.="<option value='".$rowDosage['mp_dosage2']."'>".$rowDosage['mp_dosage2']."</option>";
		
	}
	

 ?>

						<form action="?c=pres-prescriptions&task=editdosage&pid=<?php echo $rowpm['pm_pres_id'] ?>" method="POST">
					
                    <div style="background-color:#F1F4FB; border:1px solid #039">
                    
                    	<div class="modal-header">
							<h5 class="modal-title" style="color:#06C">Edit Dosage for <?php echo getMedicineName($rowDosage['mp_medicine']) ?></h5>
							<button  class="close" onclick="closeDosage()" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							
							
							
							
							<div class="form-group">
								<label class="form-label">Dosage:</label>
								<select name="txtDosage" id="txtDosage" class="form-control" onchange="openDosage_modal(this.value)" required>
                                	<?php echo $str; ?>
                                    <option value="1">Other (Free Type)</option>
                                </select>
                                
                                <textarea name="txtDosage_freetext_modal" id="txtDosage_freetext_modal" style="display:none;margin-top:20px"  class="form-control" placeholder="Please enter dosage instructions"></textarea>
                                <input type="hidden" name="hdmp" value="<?php echo $_GET['id']; ?>">
							</div>
							
							
						</div>
						<div class="modal-footer">
							<button type="button"  class="btn btn-outline-primary" onclick="closeDosage()" >Close</button>
							<button  class="btn btn-success">Submit</button>
						</div>
					</div>
                    </form>
                    
              
                    
                    
                    
                   
             <?php }  
			 } else {
				 
		//------implement with common medication dosage-----
		$sqlpm="select * from tbl_prescription_medicine where pm_id='".$database->filter($_GET['id'])."'";
		$respm=$database->get_results($sqlpm);
		$rowpm=$respm[0];
		
		
		if ($rowpm['pm_med']!="")
			{
			
						
			$sqlDosage="select med_c_dosage1, med_c_dosage2,med_c_title,med_c_id from tbl_commonly_bought where med_c_title='".$database->filter($rowpm['pm_med'])."'";
			
			$resDosage=$database->get_results($sqlDosage);
			
			
			if (count($resDosage)>0)
				{
						$rowDosage=$resDosage[0];
						$str="<option value=''>Select Dosage</option>";
							if ($rowDosage['med_c_dosage1']!="")
							$str.="<option value='".$rowDosage['med_c_dosage1']."'>".$rowDosage['med_c_dosage1']."</option>";
							
							if ($rowDosage['med_c_dosage2']!="")
							$str.="<option value='".$rowDosage['med_c_dosage2']."'>".$rowDosage['med_c_dosage2']."</option>";
					
				} ?>
                
                <form action="?c=pres-prescriptions&task=editdosage&pid=<?php echo $rowpm['pm_pres_id'] ?>" method="POST">
					
                    <div style="background-color:#F1F4FB; border:1px solid #039">
                    
                    	<div class="modal-header">
							<h5 class="modal-title" style="color:#06C">Edit Dosage for <?php echo $rowpm['pm_med'] ?></h5>
							<button  class="close" onclick="closeDosage()" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							
							
							
							
							<div class="form-group">
								<label class="form-label">Dosage:</label>
								<select name="txtDosage" id="txtDosage" class="form-control" onchange="openDosage_modal(this.value)" required>
                                	<?php echo $str; ?>
                                    <option value="1">Other (Free Type)</option>
                                </select>
                                
                                <textarea name="txtDosage_freetext_modal" id="txtDosage_freetext_modal" style="display:none;margin-top:20px"  class="form-control" placeholder="Please enter dosage instructions"></textarea>
                                <input type="hidden" name="hdmp" value="<?php echo $_GET['id']; ?>">
							</div>
							
							
						</div>
						<div class="modal-footer">
							<button type="button"  class="btn btn-outline-primary" onclick="closeDosage()" >Close</button>
							<button  class="btn btn-success">Submit</button>
						</div>
					</div>
                    </form>
                
                
				
			<?php }
		
		
		
		//------end implement with common medication dosage---		 
				 
				 ?>
  
  	
  
  
  
   <?php } ?>   
   
    <script language="javascript">
					function openDosage_modal(val)
					{
						if (val==1)
						$("#txtDosage_freetext_modal").show();
						else
						$("#txtDosage_freetext_modal").hide();
					}
					
					</script>