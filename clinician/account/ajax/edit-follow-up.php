<?php include "../../../private/settings.php";

$sql = "SELECT * FROM tbl_follow_ups,tbl_patients,tbl_prescriptions WHERE patient_id=follow_up_patient_id and pres_id=follow_up_pres_id and follow_up_id='".$database->filter($_GET['id'])."'";
$res=$database->get_results($sql);
$row=$res[0];

	

 ?>
 
 <style>
 .scrollable-div {
    max-height: 200px; /* Set the max height */
    overflow-y: auto;  /* Enable vertical scrolling if content exceeds max height */
    padding: 10px;     /* Optional: Add some padding */
    border: 1px solid #ddd; /* Optional: Add a border */
    border-radius: 5px; /* Optional: Add rounded corners */
    background-color: #f9f9f9; /* Optional: Add background color */
}

</style>

						<form action="?c=pres-followups&task=updatefollowup&pid=<?php echo $row['follow_up_id'] ?>" method="POST" id="frmAction">
					
                    <div style="background-color:#F1F4FB; border:1px solid #039">
                    
                    	<div class="modal-header">
							<h5 class="modal-title" style="color:#06C;font-size:20px">Follow Up Review</h5>
                            
                           
                            
                            
							<button type="button"  class="close" onclick="closeModal()" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							
							 <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											Patient Name
									</div>
									<div class="col-md-6" style="font-weight:500">
										<?php echo $name=$row['patient_first_name']." ".$row['patient_last_name']; ?>
									</div>
								</div>
                                
                                <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											DOB
									</div>
									<div class="col-md-6" style="font-weight:500">
										<?php echo  date("d M Y",strtotime($row['patient_dob'])); ?>
                                        (<?php 
									
									$from = new DateTime($row['patient_dob']);
									$to   = new DateTime('today');
									echo $from->diff($to)->y;
									
									$row['patient_dob'] ?> years)
									</div>
								</div>
                                
                                <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											Address
									</div>
									<div class="col-md-6" style="font-weight:500">
										<?php
														$address=$row['patient_address1'];
														if ($row['patient_address2']!="")
														$address.=" ".$row['patient_address2'];
														$address.=", ".$row['patient_city'];
														$address.=", ".$row['patient_postcode'];
														echo $address;
														
														?>
									</div>
								</div>
                                
                                <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											Patient Phone Number
									</div>
									<div class="col-md-6" style="font-weight:500">
										<?php echo  $row['patient_phone']; ?>
									</div>
								</div>
                             
                             <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											Order ID
									</div>
									<div class="col-md-6" style="font-weight:500">
										 <a href="?c=prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline" target="_blank">PH-<?php echo $row['pres_id'] ?></a>
									</div>
								</div>
                              
                               <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											Condition
									</div>
									<div class="col-md-6" style="font-weight:500">
										<?php echo getConditionName($row['pres_condition']); ?>
									</div>
								</div>
                                
                                <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											Medication
									</div>
									<div class="col-md-6" style="font-weight:500">
										<?php echo getMedicationStringWithInfo($row['pres_id']); ?>
									</div>
								</div>
                                
                                <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											Order Date
									</div>
									<div class="col-md-6" style="font-weight:500">
										<?php echo  date("d M Y",strtotime($row['pres_date'])); ?>
									</div>
								</div>
                                
                                <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											Requested By (Clinician Name)
									</div>
									<div class="col-md-6" style="font-weight:500">
										<?php echo getUserNameByType('clinician',$row['follow_up_added_by']); ?>
									</div>
								</div>
                                
                                 <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-4">
											Review Due date 
									</div>
									<div class="col-md-6" style="font-weight:500">
										<?php echo  date("d M Y",strtotime($row['follow_up_date'])); ?>
									</div>
								</div>
                                
                                
							
                             <?php $currentStatus=$row['follow_up_active']; ?>
                            
                               <div class="row" style="padding-top:15px;padding-left:5px">
									<div class="col-md-4">
											<label class="form-label mb-0 mt-2">Change Status</label>
									</div>
									<div class="col-md-6">
											<select name="cmbChgStatus" id="cmbChgStatus" class="form-control" >
												<option value="1" <?php if ($currentStatus==1) echo "Selected"; ?>>Open</option>
                                                <option value="2" <?php if ($currentStatus==2) echo "Selected"; ?>>Closed</option>
                                             </select>
									</div>
									</div>
                                
                                <div class="row" style="padding-top:15px;padding-left:5px">
									<div class="col-md-4">
											<label class="form-label mb-0 mt-2">Action Taken</label>
									</div>
									<div class="col-md-6">
											<select name="cmbAction" id="cmbAction" class="form-control" onchange="fnTakeAction(this.value)" required>
												<option value="" style="display:none">Select Action</option>
                                                <option value="Reschedule Follow Up Review">Reschedule Follow Up Review</option>
                                                <option value="Cancelled (Patient Declined)">Cancelled (Patient Declined)</option>
                                                <option value="Cancelled (Other Reason)">Cancelled (Other Reason)</option>
                                               
                                             </select>
									</div>
									</div>
                                    
                                    <div class="row" style="padding-top:15px;padding-left:5px;display:none" id="id_follow_up_date" >
									<div class="col-md-4">
											<label class="form-label mb-0 mt-2">New Follow Up Date</label>
									</div>
									<div class="col-md-6">
											<input class="form-control fc-datepicker" name="txtFollowupDate" required="required" placeholder="" type="date">
									</div>
									</div>
                                
                                    
                                    <div class="row" style="padding-top:15px;padding-left:5px">
									<div class="col-md-4">
											<label class="form-label mb-0 mt-2">Notes</label>
									</div>
									<div class="col-md-6">
											<textarea class="form-control" rows="4" cols="200" name="txtNotes"></textarea>									</div>
									</div>
                                    <?php 
								 	$sqlLogs="select * from tbl_follow_up_notes where fnotes_fid='".$database->filter($row['follow_up_id'])."' order by fnotes_id desc";
									$resLogs=$database->get_results($sqlLogs);
									
									if (count($resLogs)>0)
									{
								 
								  ?> 
                                    <div class="row" style="padding-top:15px;padding-left:5px">
									<div class="col-md-12">
											<strong>Logs:</strong>
                                            
                                        
									</div>
                                    </div>
                                    
                                 
                                
                                    
                                 <div class="scrollable-div">   
                                  
                                   <?php for ($j=0;$j<count($resLogs);$j++)
								   {
									   $rowLogs=$resLogs[$j];
									   ?>  
                                    
                                    <div class="row" style="padding-top:15px;padding-left:5px">
									<div class="col-md-4">
											<?php echo displayDateTimeFormat($rowLogs['fnotes_date']); ?>
									</div>
									<div class="col-md-8">
                                    <?php if ($rowLogs['fnotes_actions']!="") { ?>
											<strong><?php echo $rowLogs['fnotes_actions']; ?></strong>
                                     <?php } ?>
                                            <?php if ($rowLogs['fnotes_notes']!="") { ?>
											<p><?php echo $rowLogs['fnotes_notes']; ?></p>
                                     <?php } ?>
                                     </div>
									</div>  
                                 <?php } ?>                         
							
						</div>
                        <?php } ?>
                        <input type="hidden" name="fId" value="<?php echo base64_encode($row['follow_up_id'])?>" />
						<div class="modal-footer">
							<button type="button"  class="btn btn-outline-primary" onclick="closeModal()" >Close</button>
							<button  class="btn btn-success">Submit</button>
						</div>
					</div>
                    </form>
                    
              
                    
                    
          <script>


	$(document).ready(function(){

	

		

		// City form validation

	

		$("#frmAction").validate({

		

		});

	

	

	});

	

	</script>  	               
                   
 
   
    <script language="javascript">
					function openDosage_modal(val)
					{
						if (val==1)
						$("#txtDosage_freetext_modal").show();
						else
						$("#txtDosage_freetext_modal").hide();
					}
					function closeModal()
				{
					 $('#newModel').modal('hide');
				
				}
				
				function fnTakeAction(val)
				{
					
					if (val=="Reschedule Follow Up Review")
					$("#id_follow_up_date").show();
					else 
					$("#id_follow_up_date").hide();
					
					
				}
				
					</script>