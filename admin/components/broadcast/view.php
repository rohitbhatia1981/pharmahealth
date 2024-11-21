		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$totalRecords = count($rows);

		if ($page != 1)    

			$srno = (1 * $page) - 1;

		else

			$srno = 0;

		

		$sqlmenuid = "select * from tbl_components where component_option='".$_GET['c']."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	
		
<form name="adminForm" action="?c=<?php echo $component?>" method="get">

<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title"><?php echo pageheading(); ?></h4>
			</div>
			<div class="page-rightheader ml-md-auto">
				<div class=" btn-list">

								<?php if($permission['rights_add'] == 1) { ?>

<!--<a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>" title="Add" class="btn btn-light"><i class="feather feather-plus"></i></a>-->

<a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addawardmodal">Add New</a>

<?php } ?>							
								
					<a href="" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" role="button" title="Actions" aria-haspopup="true" aria-expanded="false">
									Action
								</a>
                                
                  
                  
                                
				<ul class="dropdown-menu dropdown-menu-right" role="menu">


				<?php if($permission['rights_delete'] == 1) { ?>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to delete'); } else if (confirm('Are you sure you want to delete selected items?')){ submitbutton('remove');}"><i class="feather feather-trash-2 mr-2"></i> Delete</a></li>

				<?php } ?>

				
					

				</ul>
	
	

	
	
									<!-- <button  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
									<button  class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
									<button  class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> -->
								</div>
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
							<div class="col col-auto mb-4">
												<div class="form-group w-200">
									

													<div class="ml-auto">
											<div class="input-group">
												<input type="text" class="form-control" name="txtSearchByTitle" placeholder="Search by keyword" value="<?php echo $_GET['txtSearchByTitle'];?>">
												<span class="input-group-btn">
													<button class="btn btn-light br-tl-0 br-bl-0" >
														<i class="fa fa-search"></i>
													</button>
												</span>
											</div>
										</div>			
												</div>
											</div>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top" id="example1" width="100%">
										<thead>
											<tr>
												<th width="8%" class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th width="16%" class="border-bottom-0" >Subject</th>
                                                <th width="24%" class="border-bottom-0" >Email Content</th>
                                                
                                                <th width="16%" class="border-bottom-0">Sent to Clinician or Pharmacy</th>
                                                <th width="18%" class="border-bottom-0 ">Patient Filters</th>
                                                <th width="10%" class="border-bottom-0">Sent Date</th>
												
												
												<th width="6%" class="border-bottom-0">Status</th>
											</tr>
										</thead>
							<?php

							if($totalRecords > 0) 

							{

							for ($i = 0; $i < $totalRecords; $i++) 

							{

							$srno++;

							$row = &$rows[$i];



							?>				
							<tbody>
								<tr>
									<td class="align-middle">
										<label class="custom-control custom-checkbox">
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['broadcast_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle"><?php echo $row['broadcast_subject']; ?> <br /><br />
                                    <a href="?c=<?php echo $component?>&task=edit&id=<?php echo $row['broadcast_id']; ?>" class="btn btn-sm btn-white" style="background-color:#06C; color:#FFF;width:90px">Copy Email</a>
                                    </td>
                                   
                                    <td class="align-middle"><?php echo substr($row['broadcast_email'],0,300); ?>...</td>
                                    <td class="align-middle"><?php if ($row['broadcast_sent_to']!="") echo $row['broadcast_sent_to']; else echo "-"; ?></td>
                                    <td class="align-middle">
										
                                        <br />
                                        <?php 
											if ($row['broadcast_patient_filters']!="")
											echo $row['broadcast_patient_filters'];
											
											if ($row['broadcast_filter_condition']!="")
											echo "<br>".$row['broadcast_filter_condition'];
											
											if ($row['broadcast_sent_to_gender']!="")
											echo "<br>".$row['broadcast_sent_to_gender'];
											
											
											
										
										?>
                                        
                                    </td>
                                    <td class="align-middle"><?php echo displayDateTimeFormat($row['broadcast_sent_date']); ?></td>
									

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['broadcast_status'] == 1){ ?>

										<span class="tag tag-green">Sent</span>

										<?php }else if($row['broadcast_status'] == 0){ ?>

										<span class="tag tag-red">Failed</span>

										<?php } ?>


											
										</div>
									</td>
								</tr>

								<?php

}

}

else

{

	?>

	<tr>

		<th colspan="4" class="border-bottom-0 w-10" style="text-align:center;"> - No Record found - </th>
	</tr>

	<?php

}



?>				
							
							</tbody>
											</table>

												<?php

												$pagingObject->displayLinks_Front(); 

												?>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Row -->

		</div>
	</div><!-- end app-content-->
</div>
				<input type="hidden" name="task" value="" />

				<input type="hidden" name="c" value="<?php echo $component?>" />

				<input type="hidden" name="hidCheckedBoxes" value="0" />

			</form>


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

    <?php function createFormForPagesHtml(&$rows) {

	$row=array();

	global $component, $database;

	$row = &$rows[0];

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>

	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Broadcast Message : <?php if (@count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>
		</div>
	</div>
</div>
<!--End Page header-->	 

				
<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="card">

				<?php

						/*if ($_GET['task']=="edit")

						$task="saveedit";

						else*/

						$task="save";

				?>
   <form name="frmApp" id="frmApp" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" />
   <div class="card-body pb-2">
						
						<div class="col-lg-8 col-md-8"> 
							<div class="form-group">
								<label class="form-label">Subject *</label>
								<input class="form-control mb-4" type="text" name="txtSubject" value="<?php echo $row['broadcast_subject']?>" required>
							</div>
                         </div>
                         
                         
                        
                           <div class="col-lg-5 col-md-5"> 
                            <div class="custom-controls-stacked">
                            
                            <?php
				
				$broadcastSentTo = $row['broadcast_sent_to'];				
				$selectedValues = explode(",", $broadcastSentTo);
				?>
                            
                             <label class="form-label">Send To Clinician or Pharmacies</label>
							<label class="custom-control custom-checkbox">
                           
								<input type="checkbox" class="custom-control-input" name="ckUsertype[]" id="ckUsertype" value="Clinicians" <?php if (in_array('Clinicians', $selectedValues)) echo 'checked'; ?>>
								<span class="custom-control-label">Clincians</span>
							</label>
                            <label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="ckUsertype[]" id="ckUsertype" value="Pharmacies"  <?php if (in_array('Pharmacies', $selectedValues)) echo 'checked'; ?>>
								<span class="custom-control-label">Pharmacy</span>
							</label>
                            
                            <br /><br />
                            <label class="form-label">Send Email to Selected Patients</label>
                            
                            
                            
                            <label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input"  name="rdPatient[]" id="rdPatient" value="1"  <?php if ($row['broadcast_patient_filters']=="All Patients") echo "checked"; ?>  >
								<span class="custom-control-label">All Patients</span>
                               
							</label>
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input"  name="rdPatient[]" id="rdPatient" value="2"   <?php if ($row['broadcast_patient_filters']=="Patients above 18 years") echo "checked"; ?>>
								<span class="custom-control-label">Patients above 18 years</span>
							</label>
                            <label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="rdPatient[]" id="rdPatient" value="3"   <?php if ($row['broadcast_patient_filters']=="Patients below 18 years") echo "checked"; ?>>
								<span class="custom-control-label">Patients below 18 years</span>
							</label>
                            
                            <label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="rdPatient[]" id="rdPatient" value="4" onchange="fn_rdChange()"  <?php if ($row['broadcast_patient_filters']=="Patients with specific condition") echo "checked"; ?>>
								<span class="custom-control-label">Patients with specific condition</span>
                                
                                
                                
                                
							</label>
                            <div class="col-lg-12 col-md-12" id="idConditions" style="display:none"> 
							<div class="form-group">
								<label class="form-label">Select Conditions *</label>
								<?php
								$sqlConditions="select * from tbl_conditions where condition_status=1 order by condition_title";
								$resConditions=$database->get_results($sqlConditions);
								
								?>
                                
                                
                                <select name="cmbConditions[]" id="cmbConditions" class="multi-select" multiple="multiple" >
                                	
                                
                                <?php for ($k=0;$k<count($resConditions);$k++)
								{
									$rowConditions=$resConditions[$k];
									?>    
                                    <option value="<?php echo $rowConditions['condition_id']; ?>"><?php echo $rowConditions['condition_title']; ?></option>
                                 <?php } ?>
                                </select>
							</div>
                         </div>
                            
                            <label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="rdPatient[]" id="rdPatient" value="5"   <?php if ($row['broadcast_patient_filters']=="Recent Patients (i.e. have purchased in the last 12 months)") echo "checked"; ?>>
								<span class="custom-control-label">Recent Patients (i.e. have purchased in the last 12 months)</span>
							</label>
                            
                            <label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="rdPatient[]" id="rdPatient" value="6"   <?php if ($row['broadcast_patient_filters']=="Repeat Order Patients") echo "checked"; ?>>
								<span class="custom-control-label">Repeat Order Patients </span>
							</label>
                            
                           
                            
					
						</div>
                        </div>
                        
                        
                       
                        
                         <div style="height:20px"></div>
                        
                        <div class="col-lg-2 col-md-2"> 
                        
                         <?php
				
						$gender = $row['broadcast_sent_to_gender'];				
						$genderValues = explode(", ", $gender);
						?>
                        
                            <div class="custom-controls-stacked">
                            <label class="form-label">Filter by Patient Gender</label>
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="ckGender[]" id="ckGender" value="Males" <?php if ($genderValues=="") { ?> checked="checked" <?php } else { if (in_array('Males', $genderValues)) echo 'checked'; } ?>>
								<span class="custom-control-label">All Males</span>
							</label>
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="ckGender[]" id="ckGender" value="Females" <?php if ($genderValues=="") { ?> checked="checked" <?php } else { if (in_array('Females', $genderValues)) echo 'checked'; } ?> >
								<span class="custom-control-label">All Females</span>
							</label>
                           
					
						</div>
                        </div>
                            
                            
                            <div style="height:20px"></div>
                           
 						<div class="col-lg-8 col-md-8"> 
							<div class="form-group">
								<label class="form-label">Email Content</label>
                                <?php 
								if ($row['broadcast_email']=="")
								$strEmail="Dear &lt;name&gt;,";
								else
								$strEmail=$row['broadcast_email'];
								
								 ?>
                                
								<textarea class="form-control" rows="10" cols="100"  name="page_description" required><?php echo $strEmail; ?></textarea>
                                
                                (Variables: <br /> &bull; If you put <strong>&lt;name&gt;</strong> within email content it will replace with the name of user automatically.)
                                
							</div>
                         </div>
                         
                         
                            
                         


							
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button id="submitBtn"  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="pageId" value="<?php echo $row['email_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>
                                
<?php if ($row['condition_home_icon']!="")
	  $pImageStr="'".$row['condition_home_icon']."'";	
	  
	  
	  if ($row['condition_listing_icon']!="")
	  $pImageStr2="'".$row['condition_listing_icon']."'";	
	  
	  if ($row['condition_detail_banner']!="")
	  $pImageStr3="'".$row['condition_detail_banner']."'";	
	  	 
			  ?>

 <script language="javascript">
 
 $(document).ready(function() {
        // When "All Patients" is selected
        $('#rdPatient[value="1"]').on('change', function() {
            if ($(this).is(':checked')) {
                // Uncheck all other checkboxes
                $('#rdPatient').not('input[value="1"]').prop('checked', false);
            }
        });

        // When any other option is selected
        $('#rdPatient').not('input[value="1"]').on('change', function() {
            if ($(this).is(':checked')) {
                // Uncheck "All Patients"
                $('#rdPatient[value="1"]').prop('checked', false);
            }
        });
    });
	
	

function fn_rdChange() 
 {
	
    
     
	
	 
	 if ($('#rdPatient[value="4"]').is(':checked'))
	 $("#idConditions").show();
	 else
	 $("#idConditions").hide();
	 
     
 }
 
 


</script>	
 		


             <?php } ?>

