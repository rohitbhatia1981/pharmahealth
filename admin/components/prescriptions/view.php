		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$totalRecords = count($rows);

		if ($page != 1)    

			$srno = (1 * $page) - 1;

		else

			$srno = 0;

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	

<style>
.circle-red {
  width: 40px;
  height: 40px;
  background: red;
  border-radius: 50%
}
</style>		
<form name="adminForm" action="?c=<?php echo $component?>" method="get">


<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title"><?php echo pageheading(); ?></h4>
			</div>
			<div class="page-rightheader ml-md-auto">
				
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
        <div class="row">




							<div class="col-xl-2 col-lg-6 col-md-12">
								<div class="card">
									
                                   
                                    
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=prescriptions&cmbCategory=1&txtSearchByTitle='">
													<div class="mt-0 text-left">
														<span class="fs-15 font-weight-semibold">Pending</span>
														<h3 class="mb-0 mt-1 text-danger  fs-25">
                                                        
                                                        <?php
													$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage=1 ";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-2 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=prescriptions&cmbCategory=2&txtSearchByTitle='">
													<div class="mt-0 text-left">
														<span class="fs-15 font-weight-semibold">Query</span>
														<h3 class="mb-0 mt-1 text-primary  fs-25"><?php
													$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage=2";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?></h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-primary-transparent my-auto  float-right"> <i class="feather feather-clipboard"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-2 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=prescriptions&cmbCategory=4&txtSearchByTitle='">
													<div class="mt-0 text-left">
														<span class="fs-15 font-weight-semibold">Rejected</span>
														<h3 class="mb-0 mt-1 text-warning  fs-25">
                                                        
                                                        <?php
													$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage=4";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-secondary-transparent my-auto  float-right"> <i class="feather feather-info"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-2 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=prescriptions&cmbCategory=6&txtSearchByTitle='">
													<div class="mt-0 text-left">
														<span class="fs-15 font-weight-semibold">Approved</span>
														<h3 class="mb-0 mt-1 text-success fs-25">
                                                        
                                                         <?php
													$statsSql = "SELECT * FROM tbl_prescriptions where (pres_stage=6 || pres_stage=3)";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-success-transparent my-auto  float-right"> <i class="feather feather-check"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
                            
                            <div class="col-xl-2 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=prescriptions&cmbCategory=5&txtSearchByTitle='">
													<div class="mt-0 text-left">
														<span class="fs-15 font-weight-semibold">Cancelled</span>
														<h3 class="mb-0 mt-1 text-danger fs-25">
                                                        
                                                         <?php
													$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage=5";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger-transparent my-auto  float-right"> <i class="feather feather-x"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
                            
                            <div class="col-xl-2 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=prescriptions&cmbCategory=8&txtSearchByTitle='">
													<div class="mt-0 text-left">
														<span class="fs-15 font-weight-semibold">Overdue</span>
														<h3 class="mb-0 mt-1 text-danger fs-25">
                                                        
                                                         <?php
													echo getOverDueTotal();
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger-transparent my-auto  float-right"> <i class="feather feather-alert-triangle"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
                            
                            
						</div>
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
                            
                            
                            
                            
							<div class="row">
                           
                           						<div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Search by Keyword:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>">
															</div>
														</div>
													</div>
                                                 
                                             		 <div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Start Date:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSDate" type="date" value="<?php echo $_GET['txtSDate']?>">
															</div>
														</div>
													</div> 
                                                    
                                                     <div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">End Date:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtEDate" type="date" value="<?php echo $_GET['txtEDate']?>">
															</div>
														</div>
													</div>   
                                                 
                           
                           
											
											
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by Status:</label>
                                                    
                                                  
                                                    
													<select name="cmbCategory"  class="form-control custom-select select2" data-placeholder="All">
														<option label="All"></option>
                                                        <option value="1" <?php if ($_GET['cmbCategory']==1) echo "selected"; ?>>Pending</option>
                                                        <option value="2" <?php if ($_GET['cmbCategory']==2) echo "selected"; ?>>Response Awaited</option>
                                                        <option value="3" <?php if ($_GET['cmbCategory']==3) echo "selected"; ?>>Ready for collection</option>
                                                        <option value="4" <?php if ($_GET['cmbCategory']==4) echo "selected"; ?>>Rejected</option>
                                                        <option value="5" <?php if ($_GET['cmbCategory']==5) echo "selected"; ?>>Cancelled</option>
                                                        <option value="6" <?php if ($_GET['cmbCategory']==6) echo "selected"; ?>>Approved by Prescriber</option>
														
													</select>
												</div>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-1">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
												    ?>
                                                    <a href="?c=<?php echo $_GET['c']?>" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>
										</div>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												<th width="19%" class="border-bottom-0">Order No.</th>
												<th width="14%" class="border-bottom-0">Order Date</th>
                                                <th width="14%" class="border-bottom-0">Nominated Pharmacy</th> 
                                                <th width="14%" class="border-bottom-0">Patient Name</th>  
                                                <th width="14%" class="border-bottom-0">DOB</th> 
                                                <th width="14%" class="border-bottom-0">Gender</th>                                             
                                                <th width="27%" class="border-bottom-0">Medical Condition</th>                                                
                                                <th width="25%" class="border-bottom-0">Medication</th>
                                                <th width="25%" class="border-bottom-0">Prescription Type</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
                                                <th width="15%" class="border-bottom-0 w-20">Risk Level</th>
											</tr>
										</thead>
							<?php

							
					
						
						/*$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' order by pres_id desc";
						$resPres=$database->get_results($sqlPres);
						$totalRecords=count($resPres);*/
						
						if($totalRecords > 0) 

							{

						
						for ($k=0;$k<$totalRecords;$k++)
						{
							
							$rowPres=&$rows[$k];
						
						?>



									
							<tbody>
								<tr>
									
									
                                    <td class="align-middle">
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    <a href="?c=<?php echo $component?>&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a>
									<?php 
									if ($rowPres['pres_same_day']==1) { ?>
                                    <br />	
                                    <span class="badge badge-danger mt-2">Same day service</span>
                                    <?php } ?>	
												
											
									</td>
                                    
                                    
                                    <td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
											
									</td>
                                    
                                    <td><?php echo getPharmacyName($rowPres['patient_pharmacy']); ?></td>
                                    
                                    
                                    <td><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></td>
                                    <td><?php 
									
									/*$from = new DateTime($rowPres['patient_dob']);
									$to   = new DateTime('today');
									echo $from->diff($to)->y;*/
									$date=date_create($rowPres['patient_dob']);
									echo date_format($date,"d/m/Y");
									//echo date_format($rowPres['patient_dob'],'d/m/Y') ?></td>
                                    <td><?php echo getGenderName($rowPres['patient_gender']) ?></td>
                                   
                                    <td class="align-middle">
										
												<?php echo getConditionName($rowPres['pres_condition']); ?>
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle">
										
												 <?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           } ?>
											
									</td>
                                    
                                    <td>
                                    -
                                <!--  Acute - (one off prescription) <br />
Repeat - active (repeat prescription that is still live, can make further order from it without doing a questionnaire) <br />
Repeat - inactive (has expired, new questionnaire needs to be done to re-activate)-->
                                    
                                    </td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?>
                                                            
                                                            <?php if ($rowPres['pres_stage']==1)
															{ ?>
                                                            <br />
                                                            	<a href="?c=<?php echo $_GET['c']?>&task=cancel&id=<?php echo $rowPres['pres_id']; ?>" style="font-size:12px; color:#06F">Cancel your order</a>
                                                            <?php } ?>
                                                            
                                                            
                                                            <?php echo $val; ?>
                                                            
                                                           
											</div>
										</div>
									</td>
                                     <?php
									$overallRisk=$rowPres['pres_overall_risk'];
									if ($overallRisk==1) { $btnClr="green"; }
									else if ($overallRisk==2) { $btnClr="orange";  }
									else if ($overallRisk==3) { $btnClr="red";  }
									?>
                                   
                                    <td><div style="width:40px; height:40px" class="circle-<?php echo $btnClr; ?>"></div></td>
									

									
								</tr>
                                
                                

								<?php

}

}

else

{

	?>

	<tr>

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="11"> - No Record found - </th>
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
                
                <input type="hidden" name="Cid" value="<?php echo $_GET['Cid']?>" />

				<input type="hidden" name="hidCheckedBoxes" value="0" />

			</form>


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

  

     <?php function createFormForPagesHtml_details(&$rows) {

	$row=array();

	global $component, $database;

	

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Order Details</h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="javascript:history.back()" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>
		</div>
	</div>
</div>
<!--End Page header-->	 

				
<div class="row">
		<div class="col-lg-12 col-md-12">
        
        <div class="main-content">
					<div class="container">
                    
                    
                    <?php
					
						
						
						$rowPres = &$rows[0];
							
					?>

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-4 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Prescription Status: <?php 
										
										echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></div>
									</div>
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
                                                <?php if ($rowPres['pres_stage']==6) { ?>
                                                <tr>
														<td>
															<span class="w-50">Pharmacy Status</span>
														</td>
														<td>:</td>
														<td>
															<?php echo getPrescriptionStatus_pharmacy($rowPres['pres_pharmacy_stage']); ?>
														</td>
													</tr>
                                                <?php } ?>
                                                
                                                	<tr>
														<td>
															<span class="w-50">Order Number</span>
														</td>
														<td>:</td>
														<td>
															PH-<?php echo $rowPres['pres_id'] ?>
														</td>
													</tr>
                                                
                                               		 <tr>
														<td>
															<span class="w-50">Patient Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50"> DOB</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php 
									
									/*$from = new DateTime($rowPres['patient_dob']);
									$to   = new DateTime('today');
									echo $from->diff($to)->y;*/
									$date=date_create($rowPres['patient_dob']);
									echo date_format($date,"d/m/Y");
									//echo date_format($rowPres['patient_dob'],'d/m/Y') ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Biological Sex</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getGenderName($rowPres['patient_gender']) ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Phone</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_phone'] ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_email'] ?></span>
														</td>
													</tr>
													
													
													
													
													<tr>
														<td>
															<span class="w-50">Condition</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getConditionName($rowPres['pres_condition']) ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Medication</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           } ?></span>
														</td>
													</tr>
                                                    
                                                    
                                                    
													
													
													<tr>
														<td>
															<span class="w-50">Submitted Date</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
                                                            
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Prescription Expires</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	-
															
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Change Status</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<a class="tag tag-blue" href="javascript:;" style="cursor: pointer;" onclick="showChangeStatus()">Click to Change Status</a>
															
														</td>
													</tr>
                                                   </tbody>
												</table> 
                                                
                                                 <div style="display:none" id="pres_status"> 
                                               
                                               <form action="?c=<?php echo $component?>&task=presstatus" method="POST">
                                                <table class="table">
													<tbody>
                                                   <tr><td colspan="3"><strong>Select the new status</strong></td></tr> 
                                                    <tr>
														<td>
															<span class="w-50">Prescription Status</span>
														</td>
														
														<td class="w-50">
                                                        
                                                        	<select name="pesStatus" id="pesStatus" class="form-control" onchange="showPharmacyStatus()">
                                                            	<option value="1" <?php if ($rowPres['pres_stage']==1) echo "selected"; ?>>Pending</option>
                                                                <option value="2" <?php if ($rowPres['pres_stage']==2) echo "selected"; ?>>Query</option>
                                                                <option value="4" <?php if ($rowPres['pres_stage']==4) echo "selected"; ?>>Rejected</option>
                                                                <option value="5" <?php if ($rowPres['pres_stage']==5) echo "selected"; ?>>Cancelled</option>
                                                                <option value="6" <?php if ($rowPres['pres_stage']==6) echo "selected"; ?>>Approved by Clinician</option>
                                                                <option value="7" <?php if ($rowPres['pres_stage']==7) echo "selected"; ?>>Collected</option>
                                                               
                                                            </select>
															
														</td>
													</tr>
                                                    
                                                     <tr style="display:none" id="rowPharmacy">
														<td>
															<span class="w-50">Pharmacy Status</span>
														</td>
														
														<td>
                                                        
                                                        	<select name="cmbPharmacyStage" class="form-control">
                                                            	<option value="1" <?php if ($rowPres['pres_pharmacy_stage']==1) echo "selected"; ?>>To Process</option>
                                                                <option value="2" <?php if ($rowPres['pres_pharmacy_stage']==2) echo "selected"; ?>>Query</option>
                                                                <option value="3" <?php if ($rowPres['pres_pharmacy_stage']==3) echo "selected"; ?>>Ready for Collection</option>
                                                                <option value="4" <?php if ($rowPres['pres_pharmacy_stage']==4) echo "selected"; ?>>Cancellation Requested</option>
                                                                <option value="5" <?php if ($rowPres['pres_pharmacy_stage']==5) echo "selected"; ?>>Collected</option>
                                                            </select>
															
														</td>
													</tr>
                                                    
                                                    <tr>
                                                    	<td><button type="submit" class="btn btn-primary btn-block">Submit</button></td>
                                                    	<td><button type="button" class="btn btn-secondary btn-block" onclick="showChangeStatus()">Cancel</button></td>
                                                     </tr>
                                                 </tbody>
                                               </table>
                                               <input type="hidden" name="hdPId" value="<?php echo $rowPres['pres_id']?>" />
                                              </form>
                                               
                                                </div>    
                                                    
                                                    
												
										</div>
										
									</div>
								</div>
								
							</div>
							<div class="col-xl-8 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
                                        <li><a href="#tab6" data-toggle="tab"  <?php if ($_GET['message']!=1) { ?> class="active" <?php } ?> >Completed Medical Assessment</a></li>
											
											
											<li><a href="#tab7"  data-toggle="tab" <?php if ($_GET['message']==1) { ?> class="active" <?php } ?>>Messages</a></li>
                                            <li ><a href="#tab10" data-toggle="tab">Logs</a></li>
											
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										
										<div class="tab-pane <?php if ($_GET['message']!=1) echo "active";  ?>" id="tab6">
											<div class="card-body">
                                            
                                            <div class="row" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f5f5f5; color:#444; border:1px solid #d8d8d8">
														<table class="table row table-borderless w-100 m-0 text-nowrap">
															<tbody class="col-lg-12 col-xl-6 p-0">
																<tr>
														<td><span class="font-weight-semibold">Date :</span> <?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?></td>
<td><span class="font-weight-semibold">Overall Risk Stratification :</span> 
<?php $overallRisk=$rowPres['pres_overall_risk'];
if ($overallRisk==1) { $btnClr="green"; $btnText="Low"; }
else if ($overallRisk==2) { $btnClr="orange"; $btnText="Moderate"; }
else if ($overallRisk==3) { $btnClr="red"; $btnText="High"; }

 ?>
<span style="background-color:<?php echo $btnClr; ?>; color:#FFF; padding:10px; font-weight:bold"><?php echo $btnText; ?></span>


</td>
<td><span class="font-weight-semibold">Condition :</span> <span class="btn btn-primary" style="cursor:text"><?php echo  getConditionName($rowPres['pres_condition']) ?></span></td>																																														                                                   </tr>
                                                                    </tbody>
                                                               </table>     
														</div>
													</div>
                                </div>
                                <h4 style="background:#648bff; color:#fff; padding:15px">Medication</h4>
                               			 <?php echo getMedicationStringWithInfo_table($rowPres['pres_id']); ?>
                                
                                
                                
                                
                               				 <div class="row"  style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">About You</h4>
                                                     
                                                 <?php 
											 $aboutYou=unserialize(fnUpdateHTML($rowPres['pres_about_you']));									 
											
											  ?>
								<div class="panel-body p-0">
									<div class="tab-content">
										<div class="tab-pane active" id="tab5">
											<div class="card-body" style="padding-top:0px">
												
												<div class="form-group">
                                                
                                                
                                                  <?php foreach($aboutYou as $que => $val) { ?>
													<div class="row alternate-item">
														<div class="col-md-5">
															<label class="form-label mb-0 mt-2" style="color:#777"><?php echo base64_decode($que) ?></label>
														</div>
														<div class="col-md-7 mt-2">
															<h5 style="vertical-align:middle"> <?php echo base64_decode($val) ?></h5>
														</div>
													</div>
                                                   <?php } ?>
                                                    
                                                    
                                                        
                                                       
                                                    
                                                     
												</div>
												
												
												
												
											
										</div>
                                        </div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
                                            
												 <div class="row"  style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">Symptoms</h4>
												<div class="panel-body p-0">
                                     
                                     <?php  $symptoms=unserialize(fnUpdateHTML($rowPres['pres_symptoms'])); ?>           
                                                
                                                
									<div class="tab-content">
										<div class="card" style="background-color:transparent">
									
									<div class="card-body pb-0 pt-3">
                                    
                                     <?php 
												if (is_array($symptoms))
												for($a=0;$a<count($symptoms);$a++) { ?>
										<div class="alternate-item">
											<label class="form-label mb-0"><?php echo base64_decode($symptoms[$a]['question']);  ?> :</label>
											<p style="margin-top:10px">
											
                                            <table width="100%">
                                            <tr><td width="3%" >
											
											<?php
											$answer=base64_decode($symptoms[$a]['answer']);
											
											$riskVal="";
											$riskVal=base64_decode($symptoms[$a]['risk']);
											
											$imageType=base64_decode($symptoms[$a]['image']);
											
											$position=strpos($answer, "~~~");
											if ($position=="")
											{
												if ($imageType==0)
												{
													if ($riskVal==1)
													echo '<div class="circle-green"></div>';
													else if ($riskVal==2)
													echo '<div class="circle-orange"></div>';
													else if ($riskVal==3)
													echo '<div class="circle-red"></div>';
												}
											 
											?>
                                            </td><td style="font-size:14px">
											
											 <?php if ($imageType==1)
												{
														
															if ($answer!="")
															{
																$arrImage=array();
																$arrImage=explode(",",$answer);
																$strImages="<div class='row'>";
																for ($j=0;$j<count($arrImage);$j++)
																{
																$imageRep=$arrImage[$j];																
																$strImages.="<div class='col-md-6'><img src='".URL."patient/questionnaire/images/replies/".$imageRep."' style='max-height:200px'>";
																$strImages.="</div>";
																}
																$strImages.="</div>";
																print $strImages;
															}
														}
												else
												echo $answer; ?>
                                             
                                              
                                             
                                           </td>
                                           <?php }
										   else
											{
												echo '<table width="100%" border="0px" style="border-color:#CCC">
                                                            	<tr>';
															$arrAnswer=explode("|",$answer);
															
															for ($k=0;$k<count($arrAnswer);$k++)
															{
																$arrAnsB=explode("~~~",$arrAnswer[$k]);
																
																$riskVal=$arrAnsB[1];
																
																	if ($riskVal==1)
																	echo '<td width="3%"><div class="circle-green"></div></td>';
																	else if ($riskVal==2)
																	echo '<td width="3%"><div class="circle-orange"></div></td>';
																	else if ($riskVal==3)
																	echo '<td width="3%"><div class="circle-red"></div></td>';
																
																echo "<td style='font-size:14px'>".$arrAnsB[0]."</td>";
																echo "</tr>";
																
															}
															
															echo "</tr></table>";
											}
											
											
										   
										    ?>
                                            
                                           
                                                        
                                                        
                                           
                                           </tr>
                                           </table>
                                           
                                           <?php
														if ($symptoms[$a]['more']!="")
														 echo " <br /><br /><font style='color:#000; font-size:15px'>Additional information:</font> ".base64_decode($symptoms[$a]['more']) ?>
                                            
                                            
                                            </p>
										</div>
                                        
                                       
									
                                    <?php } ?>	
										
										
										
									</div>
									
								</div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
												
                                                
                                                 <div class="row"  style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">Your Medical History</h4>
												<div class="panel-body p-0">
                                     
                                     <?php   $medicalHistory=unserialize(fnUpdateHTML($rowPres['pres_medical_history'])); ?>           
                                                
                                                
									<div class="tab-content">
										<div class="card" style="background-color:transparent">
									
									<div class="card-body pb-0 pt-3">
                                    
                                     <?php 
												if (is_array($medicalHistory))
												for($a=0;$a<count($medicalHistory);$a++) {
													
													
													 ?>
										<div class="alternate-item">
											<label class="form-label mb-0"><?php echo base64_decode($medicalHistory[$a]['question']);  ?> :</label>
											<p style="margin-top:10px">
											
                                            <table width="100%">
                                            <tr><td width="3%" >
											
											<?php
											$answer=base64_decode($medicalHistory[$a]['answer']);
											
											$riskVal="";
											$riskVal=base64_decode($medicalHistory[$a]['risk']);
											
											$imageType=base64_decode($medicalHistory[$a]['image']);
											
											$position=strpos($answer, "~~~");
											if ($position=="")
											{
												if ($imageType==0)
												{
													if ($riskVal==1)
													echo '<div class="circle-green"></div>';
													else if ($riskVal==2)
													echo '<div class="circle-orange"></div>';
													else if ($riskVal==3)
													echo '<div class="circle-red"></div>';
												}
											 
											?>
                                            </td><td style="font-size:14px">
											
											 <?php if ($imageType==1)
												{
														
															if ($answer!="")
															{
																$arrImage=array();
																$arrImage=explode(",",$answer);
																$strImages="<div class='row'>";
																for ($j=0;$j<count($arrImage);$j++)
																{
																$imageRep=$arrImage[$j];																
																$strImages.="<div class='col-md-6'><img src='".URL."patient/questionnaire/images/replies/".$imageRep."' style='max-height:200px'>";
																$strImages.="</div>";
																}
																$strImages.="</div>";
																print $strImages;
															}
														}
												else
												echo $answer; ?>
                                           </td>
                                           <?php }
										   else
											{
												echo '<table width="100%" border="0px" style="border-color:#CCC">
                                                            	<tr>';
															$arrAnswer=explode("|",$answer);
															
															for ($k=0;$k<count($arrAnswer);$k++)
															{
																$arrAnsB=explode("~~~",$arrAnswer[$k]);
																
																$riskVal=$arrAnsB[1];
																
																	if ($riskVal==1)
																	echo '<td width="3%"><div class="circle-green"></div></td>';
																	else if ($riskVal==2)
																	echo '<td width="3%"><div class="circle-orange"></div></td>';
																	else if ($riskVal==3)
																	echo '<td width="3%"><div class="circle-red"></div></td>';
																
																echo "<td style='font-size:14px'>".$arrAnsB[0]."</td>";
																echo "</tr>";
																
															}
															
															echo "</tr></table>";
											}
										   
										    ?>
                                            
                                            
                                           
                                           </tr>
                                           </table>
                                             <?php
														if ($medicalHistory[$a]['more']!="")
														 echo "<br><br><font style='color:#000; font-size:15px'>Additional information: ".base64_decode($medicalHistory[$a]['more']) ?></font>
                                            
                                            </p>
										</div>
									
                                    <?php } ?>	
										
										
										
									</div>
									
								</div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
                                            
                                             <div class="row"  style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">Your Medication History</h4>
												<div class="panel-body p-0">
                                     
                                     <?php   $medication=unserialize(fnUpdateHTML($rowPres['pres_medication'])); ?>           
                                                
                                                
									<div class="tab-content">
										<div class="card" style="background-color:transparent">
									
									<div class="card-body pb-0 pt-3">
                                    
                                     <?php 
												if (is_array($medication))
												for($a=0;$a<count($medication);$a++) { ?>
										<div class="alternate-item">
											<label class="form-label mb-0"><?php echo base64_decode($medication[$a]['question']);  ?> :</label>
											<p style="margin-top:10px">
											
                                            <table width="100%">
                                            <tr><td width="3%" >
											
											<?php
											$answer=base64_decode($medication[$a]['answer']);
											
											$riskVal="";
											$riskVal=base64_decode($medication[$a]['risk']);
											
											$imageType=base64_decode($medication[$a]['image']);
											
											$position=strpos($answer, "~~~");
											if ($position=="")
											{
												if ($imageType==0)
												{
													if ($riskVal==1 || $riskVal=="")
													echo '<div class="circle-green"></div>';
													else if ($riskVal==2)
													echo '<div class="circle-orange"></div>';
													else if ($riskVal==3)
													echo '<div class="circle-red"></div>';
												}
											 
											?>
                                            </td><td style="font-size:14px">
											
											 <?php if ($imageType==1)
												{
														
															if ($answer!="")
															{
																$arrImage=array();
																$arrImage=explode(",",$answer);
																$strImages="<div class='row'>";
																for ($j=0;$j<count($arrImage);$j++)
																{
																$imageRep=$arrImage[$j];																
																$strImages.="<div class='col-md-6'><img src='".URL."patient/questionnaire/images/replies/".$imageRep."' style='max-height:200px'>";
																$strImages.="</div>";
																}
																$strImages.="</div>";
																print $strImages;
															}
														}
												else
												echo $answer; ?>
                                           </td>
                                           <?php }
										   else
											{
												echo '<table width="100%" border="0px" style="border-color:#CCC">
                                                            	<tr>';
															$arrAnswer=explode("|",$answer);
															
															for ($k=0;$k<count($arrAnswer);$k++)
															{
																$arrAnsB=explode("~~~",$arrAnswer[$k]);
																
																$riskVal=$arrAnsB[1];
																
																	if ($riskVal==1)
																	echo '<td width="3%"><div class="circle-green"></div></td>';
																	else if ($riskVal==2)
																	echo '<td width="3%"><div class="circle-orange"></div></td>';
																	else if ($riskVal==3)
																	echo '<td width="3%"><div class="circle-red"></div></td>';
																
																echo "<td style='font-size:14px'>".$arrAnsB[0]."</td>";
																echo "</tr>";
																
															}
															
															echo "</tr></table>";
											}
										   
										    ?>
                                            
                                             
                                           
                                           </tr>
                                           </table>
                                           
                                           <?php
														if ($medication[$a]['more']!="")
														 echo "<br><br><font style='color:#000; font-size:15px'>Additional information: ".base64_decode($medication[$a]['more']) ?></font>
                                            
                                            
                                            </p>
										</div>
									
                                    <?php } ?>	
										
										
										
									</div>
									
								</div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
                                            
                                            <div class="row"  style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">Disclaimer, Consent &amp; Agreement</h4>
												<div class="panel-body p-0">
									<div class="tab-content">
										<div class="card" style="background-color:transparent">
									
                                    <div class="card-body pb-0 pt-3">
                                    	<table class="table">
                                                <?php if ($rowPres['pres_disclaimer_file']!="") { ?>
													<tr><td>Disclaimer</td><td><a href="<?php echo URL?>uploads/patients/agreement/<?php echo $rowPres['pres_disclaimer_file']?>" target="_blank">View</a></td></tr>
                                                    <?php } ?>
                                                    <?php if ($rowPres['pres_agreement_file']!="") { ?>
                                                    <tr><td>Agreement</td><td><a href="<?php echo URL?>uploads/patients/agreement/<?php echo $rowPres['pres_agreement_file']?>" target="_blank">View</a></td></tr>
                                                     <?php } ?>
                                                </table>
                                    	
												<table class="table">
												<tbody>
                                                <?php  
													 $sqlGP="select * from tbl_patient_gps where pg_patient_id='".$rowPres['pres_patient_id']."'";
													$resGP=$database->get_results($sqlGP);
													$rowGP=$resGP[0];
													
													if ($rowGP['pg_option']==1)
													{									
												 ?>
                                                	<tr><td>GP Name</td><td><?php echo $rowGP['pg_gp'] ?></td></tr>
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==2)
													{									
												 ?>
                                                	<tr><td>GP Practise</td><td><?php echo $rowGP['pg_gp_name'] ?></td></tr>
                                                    <tr><td>Address</td><td><?php echo $rowGP['pg_gp_address'] ?></td></tr>
                                                    <tr><td>Email</td><td><?php echo $rowGP['pg_gp_email'] ?></td></tr>
                                                    <tr><td>Telephone</td><td><?php echo $rowGP['pg_gp_phone'] ?></td></tr>
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==3)
													{									
												 ?>
                                                	<tr><td colspan=2>I don’t know my GP Practice details</td></tr>
                                                    
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==4)
													{									
												 ?>
                                                	<tr><td colspan=2> I do not have a registered GP in the UK</td></tr>
                                                    
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==5)
													{									
												 ?>
                                                	<tr><td colspan=2> I will take responsibility to inform my GP</td></tr>
                                                    
                                                    
                                                    <?php }
													
													
													 ?>
                                                    
                                                    
                                                </tbody>
                                                </table>
												
									</div>
									
								</div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
                                            
                                            
                                             <div class="row" style="margin-bottom:30px" id="notes">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Consultation Notes by Clinician or Pharmacy</h4>
                                                        <div class="card-body pt-1">
                                                        
                                                       
                                                       
                                                        <!--<a class="btn btn-light" href="#">Contact by email</a>-->
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <table style="margin-top:10px" width="100%" class="table  table-vcenter table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th width="2%" class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0" width="57%">Notes</th>
																<th width="17%" class="border-bottom-0">Date</th>
                                                                <th width="24%" class="border-bottom-0">Added by</th>
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlNotes="select * from tbl_prescriptions_notes where pn_pres_id='".$database->filter($_GET['id'])."' order by pn_id desc";
														$resNotes=$database->get_results($sqlNotes);
														if (count($resNotes)>0)
														{
															for ($j=0;$j<count($resNotes);$j++)
															{
																$rowNotes=$resNotes[$j];
														 ?>
															<tr>
																<td class="text-center"><?php echo $j+1; ?></td>
																<td>
																	<?php echo $rowNotes['pn_action_details']?>
																</td>
																<td><?php echo displayDateTimeFormat($rowNotes['pn_date_time'])?></td>
																<td>
                                                                
                                                                	<?php
																		
																		echo getUserNameByType($rowNotes['pn_user_type'],$rowNotes['pn_user_id']);
																		echo "<br>(".ucfirst($rowNotes['pn_user_type']).")";
																	
																	?>
                                                                
                                                                </td>
																
															</tr>
														<?php }
														} else {?>
                                                        <tr><td colspan="4">No notes added!</td></tr>
                                                        <?php } ?>	
															
														</tbody>
													</table>
                                                        
                                                   </div>
														
                                            
										</div>   
														</div>
													</div>
                                                    
                                                <div class="row" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Completed Past Medical Assessment</h4>
                                                   
														<div class="table-responsive">
											<table class="table border-top" style="background:#fff; width:95%; margin:auto; border:1px solid #d9d9d9; margin-bottom:15px">
												<thead style="padding-left:20px">
                                                
													<tr>
														<th>Date </th>
														<th>Medical Condition</th>
														<th>Medication Supplied</th>
													
                                                        <th></th>
                                                        
													</tr>
												</thead>
												<tbody style="padding-left:20px">
                                                
                                                <?php 
													$sqlAss="select * from tbl_prescriptions,tbl_patients where patient_id=pres_patient_id and (pres_stage=3 || pres_stage=6) and pres_condition='".$rowPres['pres_condition']."' ";
													
													$resAss=$database->get_results($sqlAss);
													if (count($resAss)>0)
													{
													
													for ($j=0;$j<count($resAss);$j++)
													{
												
														$rowAss=$resAss[$j];
												?>
                                                
													<tr>
														<th scope="row"><?php echo  date("d/m/Y",strtotime($rowAss['pres_date'])); ?></th>
														<td><?php echo getConditionName($rowAss['pres_condition']); ?></td>
														<td><?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowAss['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           }
														   
														   ?></td>
									
                                                        <td><a class="btn btn-primary" href="#">View Detail</a></td>
													</tr>
                                                    
                                                    <?php }
													} else {?>
                                                    <tr><td colspan="4">No previous record found</td></tr>
                                                    <?php } ?>
                                                    
												</tbody>
											</table>
                                            
                                         
										</div>   
														</div>
													</div>
                               				 </div>
                                                 
                                                    
                                                  <div class="row" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Message for pharmacy</h4>
                                                   
														<div class="card-body pt-3">
														<?php if ($rowPres['pres_pharmacy_note']!="") { ?>
                                                        <p><?php echo $rowPres['pres_pharmacy_note']; ?> <br /><br />
                                                        Date: <?php echo displayDateTimeFormat($rowPres['pres_pharmacy_note_date']); ?>
                                                        
                                                        </p>
                                            			<?php } else echo "-"; ?>
                                                       
                                            
                                            			
                                         
										</div>   
														</div>
													</div>
                               				 </div>
                                             
                                              <div class="row" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Actions / Logs</h4>
                                                        <div class="card-body">
												<div class="table-responsive">
													
													<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">Log Details</th>
																<th class="border-bottom-0">Date</th>
                                                                <th class="border-bottom-0">Action Taken by</th>
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlLogs="select * from tbl_prescriptions_actions where pa_pres_id='".$database->filter($_GET['id'])."' order by pa_id desc";
														$resLogs=$database->get_results($sqlLogs);
														if (count($resLogs)>0)
														{
															for ($j=0;$j<count($resLogs);$j++)
															{
																$rowLogs=$resLogs[$j];
														 ?>
															<tr>
																<td class="text-center"><?php echo $j+1; ?></td>
																<td>
																	<?php echo $rowLogs['pa_action_details']?>
																</td>
																<td><?php echo displayDateTimeFormat($rowLogs['pa_date_time'])?></td>
																<td>
                                                                
                                                                	<?php
																		
																		echo getUserNameByType($rowLogs['pa_user_type'],$rowLogs['pa_user_id'])
																	
																	?>
                                                                
                                                                </td>
																
															</tr>
														<?php }
														}?>	
															
														</tbody>
													</table>
                                                    
                                                    
												</div>
											</div>
														
                                            
										</div>   
														</div>
													</div>
                                                 
                                                 
                                              		<input type="hidden" name="hdOutcomes" id="hdOutcomes" value="" />
                                                    
                                                  
                                                    
                               				 </div>
										</div>
										<div class="tab-pane <?php if ($_GET['message']==1) echo "active";  ?>" id="tab7">
											<div class="card-body">
												
                                              <div class="pt-4 pb-4 text-end" align="right">
													<a  href="javascript:void(0);" onclick="showMessagebox()" class="btn btn-primary">Compose New Message</a>
												</div>
                                                
                                                
                                                <div class="card" id="contSendMessage" style="display:none" >
								<div class="card-header border-0">
									<h4 class="card-title" id="id_headingMsg"></h4>
								</div>
								<div class="card-body" >
                                <!----------form of new message-------->
                                <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=sendmessage" method="post" class="form-horizontal" enctype="multipart/form-data">
                                
                                    
                                    <select class="form-control" name="rdUser" id="rdUser" >
                                    	<option value="">Choose the recipient for your message</option>
                                        <option value="Patient">Send to Patient</option>
                                        <option value="Clinician">Send to Clinician</option>
                                        <option value="Pharmacy">Send to Pharmacy</option>
                                        
                                    </select>
                                    
									
                                    <div style="height:20px"></div>
                                    <div>
                                    
                                    <input type="text" class="form-control" name="txtSubject" id="txtSubject" placeholder="Please enter subject of your message *" maxlength="200"></div>
                                     <div style="height:20px"></div>
									<div>
                                   
                                    <textarea rows="5" class="form-control" cols="50" name="txtMessage" placeholder="Please enter the message *"></textarea></div>
                                    <div style="height:20px"></div>
									<div class="form-group">
										<label class="form-label">Upload Document (If any) <span style="color:#999">(file type allowed: pdf,jpg, png)</span></label>
										<div class="form-group">
										
										<input class="form-control" name="flDoc[]" type="file" accept=".pdf,.jpg,.png">
                                        
                                       	<div id="cont_addmore_1"></div>
                                        <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(1)">+ Add More Attachment</a></div>
                                        
                                        
										</div>
									</div>
                                    
                                  <div class="card-footer">
									<button type="submit" class="btn btn-primary">Send</button>
									<a  href="javascript:void(0);" onclick="showMessagebox_close()" class="btn btn-danger">Cancel</a>
								</div>  
                                <input type="hidden" name="hid" value="<?php echo $_GET['id']?>" />
								</form>	
                                
                                <!----------End form of new message-------->
								</div>
								
							</div>
                                                
                                                
                                                
                                                
                                                
												
                                                
                                                 <?php 
														$sqlMessage="select * from tbl_messages where  message_pres_id='".$database->filter($_GET['id'])."' order by message_id desc";
														$resMessage=$database->get_results($sqlMessage);
														if (count($resMessage)>0)
														{
															
															for ($i=0;$i<count($resMessage);$i++)
															{
																
																$rowMessage=$resMessage[$i];																
																$mysqlDate = $rowMessage['message_date'];
																$timestamp = strtotime($mysqlDate);
																$formattedDate = date("d M Y", $timestamp);
																
																$formattedTime = date("H:i", $timestamp);
																
																if ($rowMessage['message_sent_to']=="Admin")
																changeReadStatus($rowMessage['message_id']);
																
																			if ($rowMessage['message_sender_type']=="Patient")
																				{
																				$sqlSender="select * from tbl_patients where patient_id='".$rowMessage['message_sender_id']."'";
																				//else if ($rowMessage['message_sender_type']=="Clinician")
																				//$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['patient_first_name']." ".$rowSender['patient_middle_name']." ".$rowSender['patient_last_name']." (".$rowMessage['message_sender_type'].")";
																				$colorCss="danger";
																				}
																				else if ($rowMessage['message_sender_type']=="Clinician")
																				{
																					
																				$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['pres_forename']." ".$rowSender['pres_surname']." (".$rowMessage['message_sender_type'].")";
																					
																					
																				
																					$colorCss="primary";
																				}
																				
																				else if ($rowMessage['message_sender_type']=="Pharmacy")
																				{
																					
																				$sqlSender="select * from tbl_pharmacies where pharmacy_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['pharmacy_name']." (".$rowMessage['message_sender_type'].")";
																					
																					
																				
																					$colorCss="secondary";
																				}



														
													?>
                                                    <div class="card shadow-none border">
													<div class="d-sm-flex p-5">
													
                                                    
                                                    
                                                    
                                                    	
														<div class="media-body">
															<h5 class="mt-1 mb-1 font-weight-semibold"><?php echo $rowMessage['message_subject']?> <span class="badge badge-<?php echo $colorCss; ?>-light badge-md ms-2"><?php echo $replierName; ?></span></h5>
															<small class="text-muted"><i class="fa fa-calendar"></i> <?php echo $formattedDate; ?> <i class=" ms-3 fa fa-clock-o"></i> <?php echo $formattedTime; ?></small>
                                                            | <span style="color:#00F;font-size:13px"><strong>
                                                            	<?php if ($rowMessage['message_sent_to']=="Admin") echo 'Sent to Admin';
																if ($rowMessage['message_sent_to']=="Clinician") echo 'Sent to Clinician';
																if ($rowMessage['message_sent_to']=="Pharmacy") echo 'Sent to Pharmacy';
																if ($rowMessage['message_sent_to']=="Patient") echo 'Sent to Patient';
																 ?>
                                                              </strong></span>
															<p class="fs-13 mb-2 mt-1">
															   <?php echo $rowMessage['message_text']?>
															</p>
															 <!---------Attachment of new message------------>
                                                            
                                                             <?php if ($rowMessage['message_attachment']!="") {
																 
																 $arrUnSerMes=unserialize(fnUpdateHTML($rowMessage['message_attachment']));
																
																  ?>
                                                                    
                                                                    <div class="row">
                                                                    
                                                                    <?php for ($j=0;$j<count($arrUnSerMes);$j++) {
																		
																		
															$fileExtension = pathinfo($arrUnSerMes[$j], PATHINFO_EXTENSION);
															
															// Check if the file extension is PDF
															if (strtolower($fileExtension) === 'pdf') {
																// The file is a PDF
																$type="pdf";
															} elseif (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
																// The file is an image
																$type="image";
															} 
																		
																		 ?>
                                                                        <div class="col-lg-2 col-md-3">
                                                                            <a  href="<?php echo URL?>uploads/patients/<?php echo $arrUnSerMes[$j]; ?>" download class="attach-supportfiles">
                                                                                
                                                                                <?php if ($type=="image") { ?>
                                                                                <img src="<?php echo URL?>uploads/patients/<?php echo $arrUnSerMes[$j]; ?>" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                                                                                <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                                                                                <?php } else { ?>
                                                                                <img src="<?php echo URL?>images/pdf.png" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                                                                                <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                                                                                <?php } ?>
                                                                                
                                                                            </a>
                                                                        </div>
                                                                      <?php } ?>
												
											</div>
                                            <?php } ?> 
                                            <!-----------end attachment------->
                                                            
                                                          <?php if ($rowMessage['message_sent_to']=="Admin") 
																{
																	if ($rowMessage['message_sender_type']=="Clinician")
																	$r=1;
																	if ($rowMessage['message_sender_type']=="Patient")
																	$r=2;
																	if ($rowMessage['message_sender_type']=="Pharmacy")
																	$r=3;
																	
																	?>
                                            
                                            						<br />
                                            
																	<a  href="javascript:void(0);" onclick="showMessagebox(<?php echo $r?>,'<?php echo $rowMessage['message_subject']?>')" class="me-2 mt-1"><span class="badge badge-orange"><i class="fa fa-reply"></i> Reply</span></a>
															   <?php } ?>
                                                                
                                                               
                                                            
														</div>
                                                        
                                                        
                                                        
                                                        
													</div>
                                                    </div>
                                                    
                                                    <?php }
														}
														else
														
														echo "<p style='font-size:18px; padding:30px'>No communication yet for this order</p>";
														?>
												
												
											</div>
										
										
										
										
										
									</div>
                                    
                                    <div class="tab-pane" id="tab10">
                                    
                                    <div class="card-body">
												<div class="table-responsive">
													
													<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">Log Details</th>
																<th class="border-bottom-0">Date</th>
                                                                <th class="border-bottom-0">Action Taken by</th>
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlLogs="select * from tbl_prescriptions_actions where pa_pres_id='".$database->filter($_GET['id'])."' order by pa_id desc";
														$resLogs=$database->get_results($sqlLogs);
														if (count($resLogs)>0)
														{
															for ($j=0;$j<count($resLogs);$j++)
															{
																$rowLogs=$resLogs[$j];
														 ?>
															<tr>
																<td class="text-center"><?php echo $j+1; ?></td>
																<td>
																	<?php echo $rowLogs['pa_action_details']?>
																</td>
																<td><?php echo displayDateTimeFormat($rowLogs['pa_date_time'])?></td>
																<td>
                                                                
                                                                	<?php
																		
																		echo getUserNameByType($rowLogs['pa_user_type'],$rowLogs['pa_user_id'])
																	
																	?>
                                                                
                                                                </td>
																
															</tr>
														<?php }
														}?>	
															
														</tbody>
													</table>
                                                    
                                                    
												</div>
											</div>
                                            
                                            
                                    
                                    </div>
										
										
										<div class="tab-pane" id="tab10">
											<div class="card-body">
                                            
                                            No Payments found!
												<!--<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="invoice-tables">
														<thead>
															<tr>
																<th class="border-bottom-0">InvoiceID</th>
																<th class="border-bottom-0">Amount</th>
																<th class="border-bottom-0">Invoice Date</th>
																<th class="border-bottom-0">Due Date</th>
																<th class="border-bottom-0">Payment</th>
																<th class="border-bottom-0">Status</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<a href="#">INV-0478</a>
																</td>
																<td>$345.00</td>
																<td>12-01-2021</td>
																<td>14-02-2021</td>
																<td>
																	<span class="text-primary">$345.000</span>
																</td>
																<td><span class="badge badge-success-light">Paid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-1245</a>
																</td>
																<td>$834.00</td>
																<td>12-01-2021</td>
																<td>14-02-2021</td>
																<td>
																	<span class="text-primary">$834.000</span>
																</td>
																<td><span class="badge badge-danger-light">UnPaid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-5280</a>
																</td>
																<td>$16,753.00</td>
																<td>21-01-2021</td>
																<td>15-01-2021</td>
																<td>
																	<span class="text-primary">$16,753.000</span>
																</td>
																<td><span class="badge badge-success-light">Paid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-2876</a>
																</td>
																<td>$297.00</td>
																<td>05-02-2021</td>
																<td>21-02-2021</td>
																<td>
																	<span class="text-primary">$297.000</span>
																</td>
																<td><span class="badge badge-success-light">Paid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-1986</a>
																</td>
																<td>$12,897.00</td>
																<td>01-01-2021</td>
																<td>24-02-2021</td>
																<td>
																	<span class="text-primary">$12,897.00</span>
																</td>
																<td><span class="badge badge-danger-light">UnPaid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>-->
											</div>
										</div>
										<div class="tab-pane" id="tab11">
											<div class="card-body">
												No log history yet!
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
</div><script language="javascript">
function showChangeStatus()
{
	$("#pres_status").toggle();
}
function showMessagebox(r=0,subj='')
{
	
	if (r==0)
	{
	$("#contSendMessage").show(500);
	$("#rdUser option:eq(0)").show();
	$("#rdUser option:eq(1)").show();
	$("#rdUser option:eq(2)").show();
	$("#rdUser option:eq(3)").show();
	
	$("#rdUser option:eq(0)").prop('selected', true);
	//$("#rdUser").prop('disabled', false); // Disable the dropdown
	
	$("#id_headingMsg").html("Send a new message");
	$("#txtSubject").val("");
	}
	
	else if (r==1)
	{
		$("#rdUser option:eq(2)").prop('selected', true);
		
		$("#rdUser option:eq(0)").hide();
		$("#rdUser option:eq(1)").hide();
		$("#rdUser option:eq(3)").hide();
		
		//$("#rdUser").hide(); // Disable the dropdown
		$("#contSendMessage").show(500);
		$("#id_headingMsg").html("Send message to clinician");
		$("#txtSubject").val("Re: "+subj);
	}
	
	else if (r==2)
	{
		$("#rdUser option:eq(1)").prop('selected', true);
		
		$("#rdUser option:eq(0)").hide();
		$("#rdUser option:eq(2)").hide();
		$("#rdUser option:eq(3)").hide();
		
		//$("#rdUser").hide(); // Disable the dropdown
		$("#contSendMessage").show(500);
		$("#id_headingMsg").html("Send message to patient");
		$("#txtSubject").val("Re: "+subj);
	}
	else if (r==3)
	{
		$("#rdUser option:eq(3)").prop('selected', true);
		$("#rdUser option:eq(0)").hide();
		$("#rdUser option:eq(1)").hide();
		$("#rdUser option:eq(2)").hide();
		
		//$("#rdUser").hide(); // Disable the dropdown
		$("#contSendMessage").show(500);
		$("#id_headingMsg").html("Send message to pharmacy");
		$("#txtSubject").val("Re: "+subj);
	}
	
	
	$('html, body').animate({ scrollTop: 0 }, 'slow');
}



function showMessagebox_close()
{
	$("#contSendMessage").hide(500);
}

function addMoreFile(val)
{
	
	str='<div><input style="margin-top:15px" class="form-control" name="flDoc[]" type="file" accept=".pdf,.jpg,.png"></div>';
	$("#cont_addmore_"+val).append(str);
}

function showPharmacyStatus()
{
	
	var statusVal;
	statusVal=$("#pesStatus").val();
	if (statusVal==6)
	$("#rowPharmacy").show();
	else
	$("#rowPharmacy").hide();
	
}

<?php if ($rowPres['pres_stage']==6) { ?>
showPharmacyStatus();
<?php } ?>

</script>

             <?php } ?>
  