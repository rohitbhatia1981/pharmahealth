		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$row=$rows[0];

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	
		
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

 <style>

.ui-menu .ui-menu-item {
	font-size:15px;
	color:#666;
}





</style>


<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title"><?php echo pageheading(); ?></h4>
			</div>
			<div class="page-rightheader ml-md-auto">
        <?php if ($_GET['mode']=="edit") { ?>
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
		</a>
        
		</div>
        <?php } ?>
	</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
          
          <?php if ($_GET['mode']=="edit") {
			  
			  
						$sqlData="select * from tbl_medical_background where mb_patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
						$resData=$database->get_results($sqlData);
						if (count($resData)>0)
						{
							$rowData=$resData[0];
							$alergyToggle=$rowData['mb_allergies_toggle'];
							$alergy=$rowData['mb_allergies'];
							$conditionToggle=$rowData['mb_condition_toggle'];
							$condition=$rowData['mb_conditions'];
							$medicationToggle=$rowData['mb_medication_toggle'];
							$medication=$rowData['mb_medications'];
							$mb_other_info=$rowData['mb_other_info'];
						}
			  
			  
			   ?>
            
           <div class="row">
                        
                        <div class="col-xl-8 col-md-12">
								<div class="card">
									<div class="card-body">
                                    
								<form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=saveedit" method="post" class="form-horizontal">		
									
										<div class="mb-5 d-md-flex">
											<a class="text-dark d-flex" href="#">
											<h3 class="mb-2">Your Medical History</h3></a>
											
										</div>
										
									<div class="col-md-12">
                                    	<div class="form-group mb-6">
                                        	<h5 class="mb-4">Known Allergies</h5>
                                            
                                            <div class="custom-controls-stacked d-md-flex">
										
											<label class="custom-control custom-radio success mr-4">
												<input type="radio" class="custom-control-input" name="rdAllergy" id="rdAllergy" onclick="dispRow('Allergy')" value="1" <?php if ($alergyToggle==1) echo "checked"; ?>>
												<span class="custom-control-label">Yes</span>
											</label>
											<label class="custom-control custom-radio success mr-4">
												<input type="radio" class="custom-control-input" name="rdAllergy" id="rdAllergy" onclick="dispRow('Allergy')" value="0" <?php if ($alergyToggle==0 && $alergyToggle!="") echo "checked"; ?>>
												<span class="custom-control-label">No</span>
											</label>
										</div>
                                        
                                            <input <?php if ($alergyToggle==0 && $alergyToggle!="") { ?> style="display:none" <?php } ?> id="rowAllergy" class="form-control" placeholder="Please give allergy details" name="txtAllergy" value="<?php echo $alergy; ?>">                                     
                                       </div>
                                        <div class="form-group mb-6">
                                        	<h5 class="mb-4">Medical Conditions <span style="color:#999; font-size:14px">- Have you been diagnosed with any medical conditions?</span></h5>
                                            
                                            <div class="custom-controls-stacked d-md-flex">
										
											<label class="custom-control custom-radio success mr-4">
												<input type="radio" class="custom-control-input" name="rdCondition" id="rdCondition" onclick="dispRow('Condition')" value="1" <?php if ($conditionToggle==1) echo "checked"; ?>>
												<span class="custom-control-label">Yes</span>
											</label>
											<label class="custom-control custom-radio success mr-4">
												<input type="radio" class="custom-control-input" name="rdCondition" id="rdCondition" onclick="dispRow('Condition')" value="0" <?php if ($conditionToggle==0 && $conditionToggle!="") echo "checked"; ?>>
												<span class="custom-control-label">No</span>
											</label>
										</div>
                                        
                                            <textarea id="rowCondition" name="txtCondition" <?php if ($conditionToggle==0 && $conditionToggle!="") { ?> style="display:none" <?php } ?> class="form-control" placeholder="Please provide further details"><?php echo $condition; ?></textarea>                                     
                                       </div>
                                       <div class="form-group mb-6">
                                        	<h5 class="mb-4">Current Medications <span style="color:#999; font-size:13px">- Are you currently taking any medicines?</span></h5>
                                            
                                            <div class="custom-controls-stacked d-md-flex">
										
											<label class="custom-control custom-radio success mr-4">
												<input type="radio" class="custom-control-input" id="rdMedication" onclick="dispRow('Medication')" name="rdMedication" value="1" <?php if ($medicationToggle==1) echo "checked"; ?>>
												<span class="custom-control-label">Yes</span>
											</label>
											<label class="custom-control custom-radio success mr-4">
												<input type="radio" class="custom-control-input" name="rdMedication" onclick="dispRow('Medication')" id="rdMedication" value="0" <?php if ($medicationToggle==0 && $medicationToggle!="") echo "checked"; ?>>
												<span class="custom-control-label">No</span>
											</label>
										</div>
                                        
                                            <textarea id="rowMedication" name="txtMedication" <?php if ($medicationToggle==0 && $medicationToggle!="") { ?> style="display:none" <?php } ?> class="form-control" placeholder="Please give us details of medications"><?php echo $medication; ?></textarea>                                     
                                       </div>
                                       <div class="form-group mb-6">
                                        	<h5 class="mb-4">Other Relevant Information</h5>
                                            
                                            
                                        
                                            <textarea class="form-control" name="txtOtherInfo" placeholder="Please provide further details"><?php echo $rowData['mb_other_info']; ?></textarea>                                     
                                       </div>
                                       
                                       
                                     
										
										 <button class="btn btn-primary btn-lg" type="submit" >Submit</button>
									 
                                    </div>
                                    
									</form>	
									</div>
									
								</div>
							</div>
                            
							<div class="col-xl-4 col-md-12">
								<div class="card">
									<div class="card-header  border-0">
										<h4 class="card-title">Why it is important?</h4>
									</div>
									<div class="card-body pt-3">
										<p>The importance of medical background for a prescriber is paramount in ensuring patient safety and the provision of quality healthcare. Medical background encompases understanding the pharmacology of medications, their indications, contraindications, potential drug-drug interactions &amp; adverse effects.</p>
                                        <p>This knowledge enables informed decision making regarding which drugs to prescribe to optimize therapeutic outcomes while minimizing harm. Additionally a comprehensive medical background allows for appropriate medication dosage selection as well as monitoring of patient responses to treatment.</p>
										
									</div>
                                    
                                    
									
								</div>
							</div>
							
						</div>
                        
                        <?php } else { 
						
						
						$sqlData="select * from tbl_medical_background where mb_patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
						$resData=$database->get_results($sqlData);
						if (count($resData)>0)
						{
							$rowData=$resData[0];
							$alergyToggle=$rowData['mb_allergies_toggle'];
							$alergy=$rowData['mb_allergies'];
							$conditionToggle=$rowData['mb_condition_toggle'];
							$condition=$rowData['mb_conditions'];
							$medicationToggle=$rowData['mb_medication_toggle'];
							$medication=$rowData['mb_medications'];
							$mb_other_info=$rowData['mb_other_info'];
						}
						
						?>
                        
                        <div class="row">
		<div class="col-lg-12 col-md-12">
        
        
					<div class="container">
                    
                    
                  

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
                        
                        
                        <!--<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
                                    
                                    
                                    <a href="?c=edit-profile&mode=edit" class="btn btn-primary">Edit Profile</a>
										
										
									</div>
								</div>
							</div>-->
							
							<div class="col-xl-12 col-md-12 col-lg-12">
								
                                
                                
                                
								<div class="row">
                        
                        <div class="col-xl-8 col-md-12">
								<div class="card">
									<div class="card-body">
                                    
										
									
										<div class="mb-5 d-md-flex">
											<a class="text-dark d-flex" href="#">
											<h3 class="mb-2">Your Medical History</h3></a>
											<div class="btn-list ml-auto" style="float:right">
											
											
										</div>
										</div>
										
									
										<div>
											<table width="100%" class="table card-table table-vcenter  mb-0">
												<tbody class="col-lg-12 col-xl-12 pb-2 mb-4" style="border-bottom:1px solid #d7d7d7">
												<tr>
													<td colspan="2"><h5 class="font-weight-semibold mb-0">Known Allergies</h5></td>
												</tr>
                                                
                                                <?php 
												$sqlMed1="select * from tbl_patient_medical_background where mb_patient_id='".$_SESSION['sess_patient_id']."' and mb_type=1 order by mb_id desc";
																$resMed1=$database->get_results($sqlMed1);
																if (count($resMed1)>0)
																{
												?>
                                               
                                                <tr>
                                                    <td colspan="2" > 
                                                    		<table width="100%"  class="table card-table table-vcenter  mb-0" >
                                                            
                                                            	<tr><th width="5%">#</th><th width="85%" align="left" >Details<th width="10%">Added on</th></tr>
                                                                
                                                                <?php
																	for ($j=0;$j<count($resMed1);$j++)
																	{
																		$rowMed1=$resMed1[$j];
																
																?>
                                                                
                                                                <tr ><td style="vertical-align:top !important"><?php echo $j+1; ?></td><td style="vertical-align:top !important"> <?php echo $replaced_string = str_replace("|", "<br>", $rowMed1['mb_details']); ?> <br /></td><td style="vertical-align:top !important"><?php echo fn_GiveMeDateInDisplayFormat($rowMed1['mb_added_date'])?> <br />(<em><?php  echo ucfirst($rowMed1['mb_added_type']); ?></em>)</td></tr>
                                                                
                                                                <?php }
																?>
                                                            
                                                            </table>
                                                            
                                                            
                                                     </td>
                                                 </tr>
                                                  <?php } else {  ?>
                                                 <tr><td> Please input details 
                                                 
                                                </td></tr>
                                                <?php } ?>
                                                <tr><td>
                                                <a href="javascript:;" onclick="addAllergy(1)" class="btn btn-primary">Add Allergy Details</a>
                                                </td></tr>
                                            </tbody>
                                            
                                            </table>
                                            <table width="100%" class="table card-table table-vcenter  mb-0">
                                            
                                            
                                                    
                                                    <tbody class="col-lg-12 col-xl-12 pb-2 mb-4" style="border-bottom:1px solid #d7d7d7">
												<tr>
													<td colspan="2"><h5 class="font-weight-semibold mb-0">Medical Conditions</h5></td>
												</tr>
                                                
                                                <?php
																$sqlMed1="select * from tbl_patient_medical_background where mb_patient_id='".$_SESSION['sess_patient_id']."' and mb_type=2 order by mb_id desc";
																$resMed1=$database->get_results($sqlMed1);
																if (count($resMed1)>0)
																{
																	?>
                                                
                                                <tr>
                                                    <td colspan="2"> 
                                                    
                                                    <table width="100%"  class="table card-table table-vcenter  mb-0" >
                                                            
                                                            	<tr><th width="5%">#</th><th width="85%" align="left" >Details<th width="10%">Added on</th></tr>
                                                                
                                                                <?php
																	for ($j=0;$j<count($resMed1);$j++)
																	{
																		$rowMed1=$resMed1[$j];
																
																?>
                                                                
                                                                <tr ><td style="vertical-align:top !important"><?php echo $j+1; ?></td><td style="vertical-align:top !important"> <?php echo $replaced_string = str_replace("|", "<br>", $rowMed1['mb_details']); ?> <br /></td><td style="vertical-align:top !important"><?php echo fn_GiveMeDateInDisplayFormat($rowMed1['mb_added_date'])?> <br />(<em><?php  echo ucfirst($rowMed1['mb_added_type']); ?></em>)</td></tr>
                                                                
                                                                <?php }
																?>
                                                            
                                                            </table>
                                                            
                                                            
                                                    
                                                     </td>
                                                 </tr>
                                                 <?php } else { ?>
                                                 <tr><td> Please input details <br />
                                                 
                                                </td></tr>
                                                  <?php } ?>
                                                <tr><td>
                                                <a href="javascript:;" onclick="addAllergy(2)" class="btn btn-primary">Add Medical Conditions Details</a>
                                                </td></tr>
                                              
                                            </tbody>
                                            
                                            </table>
                                            
                                            <table width="100%" class="table card-table table-vcenter  mb-0">
                                                
                                                <tbody class="col-lg-12 col-xl-12 pb-2 mb-4" style="border-bottom:1px solid #d7d7d7">
												<tr>
													<td colspan="2"><h5 class="font-weight-semibold mb-0">Current Medications</h5></td>
												</tr>
                                               <?php
																$sqlMed1="select * from tbl_patient_medical_background where mb_patient_id='".$_SESSION['sess_patient_id']."' and mb_type=3 order by mb_id desc";
																$resMed1=$database->get_results($sqlMed1);
																if (count($resMed1)>0)
																{
																	?>
                                                
                                                <tr>
                                                    <td colspan="2"> 
                                                    
                                                    <table width="100%"  class="table card-table table-vcenter  mb-0" >
                                                            
                                                            	<tr><th width="5%">#</th><th width="85%" align="left" >Details<th width="10%">Added on</th></tr>
                                                                
                                                                <?php
																	for ($j=0;$j<count($resMed1);$j++)
																	{
																		$rowMed1=$resMed1[$j];
																
																?>
                                                                
                                                                <tr ><td style="vertical-align:top !important"><?php echo $j+1; ?></td><td style="vertical-align:top !important"> <?php echo $replaced_string = str_replace("|", "<br>", $rowMed1['mb_details']); ?> <br /></td><td style="vertical-align:top !important"><?php echo fn_GiveMeDateInDisplayFormat($rowMed1['mb_added_date'])?> <br />(<em><?php  echo ucfirst($rowMed1['mb_added_type']); ?></em>)</td></tr>
                                                                
                                                                <?php }
																?>
                                                            
                                                            </table>
                                                            
                                                            
                                                    
                                                     </td>
                                                 </tr>
                                                
                                                  <?php } else { ?>
                                                 <tr><td> Please input details <br />
                                                 
                                                </td></tr>
                                                  <?php } ?>
                                                <tr><td>
                                                <a href="javascript:;" onclick="addAllergy(3)" class="btn btn-primary">Add Current Medication Details</a>
                                                </td></tr>
                                                
                                            </tbody>
                                                
                                               
												
											</table>
										</div>
									</div>
									
								</div>
							</div>
                            
							<div class="col-xl-4 col-md-12">
								<div class="card">
									<div class="card-header  border-0">
										<h4 class="card-title">Why it is important?</h4>
									</div>
									<div class="card-body pt-3">
										<p>The importance of medical background for a prescriber is paramount in ensuring patient safety and the provision of quality healthcare. Medical background encompases understanding the pharmacology of medications, their indications, contraindications, potential drug-drug interactions &amp; adverse effects.</p>
                                        <p>This knowledge enables informed decision making regarding which drugs to prescribe to optimize therapeutic outcomes while minimizing harm. Additionally a comprehensive medical background allows for appropriate medication dosage selection as well as monitoring of patient responses to treatment.</p>
										
									</div>
                                    
                                    
									
								</div>
							</div>
							
						</div>
							</div>
						</div>
						<!-- End Row-->

					</div><!-- end app-content-->
				
		</div>
</div>

<div class="modal fade"  id="newAllergy">
                 
                 <form action="?c=<?php echo $_GET['c']?>&task=savemedical" method="POST">
                 
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add <span id="med_type"></span> Details</h5>
							<button  class="close" data-dismiss="modal" type="button" onclick="closeAllergy()" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							
							
							
							
							<div class="form-group">
								
								<textarea row="4" cols="100%" required class="form-control" placeholder="Please provide details" name="txtAllergy"></textarea>
                                <input type="hidden" name="idType" id="IdType" value="" />
							</div>
							
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-primary" onclick="closeAllergy()" data-dismiss="modal">Close</button>
							<button  class="btn btn-success">Submit</button>
						</div>
					</div>
				</div>
                
                </form>
			</div>
                        
                        <?php } ?>
	
			<!-- End Row -->
            
            <script language="javascript">

$("#adminForm").validate({
			rules: {
				txtPostcode: "required",
				txtAddress1: "required",
				txtCity: "required"
			},
			messages: {
				txtPostcode: "Postcode cannot be blank",
				txtAddress1: "Address cannot be blank",
				txtCity: "City cannot be blank"
				
				}			
		});

</script>

		</div>
	</div><!-- end app-content-->
</div>

<script language="javascript">
function addAllergy(id)
{
	
	$('#newAllergy').modal('show');
	$("#IdType").val(id);
	if (id==1)
	{
		$("#med_type").html("Allergy");
		
	} else if (id==2)
	{
		$("#med_type").html("Medical Condition");
		
	}
	 else if (id==3)
	{
		$("#med_type").html("Current Medication");
		
	}


}
function closeAllergy()
{
	$('#newAllergy').modal('hide');
}
function dispRow(str)
{
	radioName="rd"+str;
	rowName="row"+str;
	
	var selectedValue = $('input[name="'+radioName+'"]:checked').val();
	
	if (selectedValue==1)	
	$("#"+rowName).show();
	else
	$("#"+rowName).hide();
	
}
</script>
				


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

   

     <?php function createFormForPagesHtml_details(&$rows) {

	$row=array();

	global $component, $database;

	$row = &$rows[0];

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->

<!--End Page header-->	 

				



             <?php } ?>
             
           

  