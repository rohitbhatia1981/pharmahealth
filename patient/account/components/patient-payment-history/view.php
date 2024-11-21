		

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
        <div class="tab-menu-heading hremp-tabs p-0 ">
        <div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
                                        <li><a href="?c=<?php echo $_GET['c']?>"  <?php if ($_GET['ty']=="") { ?> class="active" <?php } ?> >Payments</a></li>
											<!--<li ><a href="?c=<?php echo $_GET['c']?>&ty=s" <?php if ($_GET['ty']=="s") { ?> class="active" <?php } ?>>Subscriptions</a></li>-->
											
											
											
										</ul>
									</div>
             </div>
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
                        
                         <?php if ($_GET['ty']=="") { ?>    
							<div class="e-table">
                            
                            
                        
                            
							<div class="row">
                           
                           					<div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Search by Invoice Id or Order Id.:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>">
															</div>
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
												
												
                                                <th width="19%" class="border-bottom-0">Invoice ID</th>
                                                <th width="27%" class="border-bottom-0">Amount Paid</th>                                                
                                                <th width="25%" class="border-bottom-0">Payment Date</th>
                                                <th width="25%" class="border-bottom-0">Order ID</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
                                                <th width="14%" class="border-bottom-0">Invoice</th>
                                              
											</tr>
										</thead>
					
									
							<tbody>
                            
                            <?php
							if($totalRecords > 0) 
							{

						
									for ($k=0;$k<$totalRecords;$k++)
									{
										
										$rowPres=&$rows[$k];
							?>
								<tr>
									
									<td class="align-middle">
                                    
                                   
                                    <a href="#" style="color:#06F; text-decoration:underline">#<?php echo $rowPres['payment_id']?></a>
										
												
											
									</td>
                                    <td class="align-middle">
                                    
                                   <?php echo CURRENCY.$rowPres['payment_amount']?>
										
												
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle">
										
												<?php echo  date("d/m/Y",strtotime($rowPres['payment_date'])); ?>
											
									</td>
                                    
                                     <td class="align-middle">
										
										<a href="?c=patient-prescriptions&task=detail&id=<?php echo $rowPres['payment_pres_id']?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['payment_pres_id']?></a>		
											
									</td>
                                    
                                    <td class="align-middle">
										<?php 
										if ($rowPres['payment_status']==0) { ?>
                                        <span class="tag tag-orange">Authorized</span>
                                        <?php }
										
										if ($rowPres['payment_status']==1) { ?>
										<span class="tag tag-green">Paid</span>
                                        <?php }
										if ($rowPres['payment_status']==2) { ?>
										<span class="tag tag-red">Cancelled</span>
                                        <?php }
										 ?>		 
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
														<?php if ($rowPres['payment_status']==1) { ?>
															
															<a href="<?php echo URL?>pdf/create-invoice-pdf.php?aid=<?php echo encryptId($rowPres['payment_id']);?>" class="action-btns" data-toggle="tooltip" data-placement="top" title="Download Invoice">
																<i class="feather feather-download  text-secondary"></i>
															</a>
                                                         <?php } else echo "-"; ?>
															
															
															
                                                            
                                                           
											</div>
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
                                    
                                    <?php } else {
										
									include "components/".$_GET['c']."/"."subscription-tab.php";
										 ?>
                                    
                                    
                                    <?php } ?>
                                    
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

	$row = &$rows[0];

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Order details</h4>
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
        
        <div class="main-content">
					<div class="container">
                    
                    
                    <?php
					
						$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' and pres_id='".$database->filter($_GET['id'])."'  order by pres_id desc ";
						$resPres=$database->get_results($sqlPres);
						$rowPres=$resPres[0];
							
					?>

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-4 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Prescription Status: <?php echo getPrescriptionStatus($rowPres['pres_stage']); ?></div>
									</div>
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
													
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
															<span class="w-50">Order Date</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
                                                            
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
															<?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           } ?>
														</td>
													</tr>
                                                    
                                                    
                                                    
													
													
													
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Current Status</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<button class="btn btn-success">Active</button>
															
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Valid Till</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	15-Aug, 2023
															
														</td>
													</tr>
                                                    
                                                    <tr><td colspan="3" align="center"><a href="javascript:void(0);" class="btn btn-pink">Re-Order Medicine</a></td>
                                                    
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
								
							</div>
							<div class="col-xl-8 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
                                        <li><a href="#tab6" data-toggle="tab"  class="active" >Completed Medical Assessment</a></li>
											<li ><a href="#tab5" data-toggle="tab">Order Details</a></li>
											
											<li><a href="#tab7"  data-toggle="tab">Messages</a></li>
											
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane" id="tab5">
											<div class="card-body">
												<div class="table-responsive">
										<table class="table card-table table-vcenter text-nowrap mb-0">
											<thead >
												<tr>
													
													<th>Medicine Name</th>
													<th>Quantity</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
                                            
                                            
                                            <?php
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
											?>
                                            
												<tr>
													<td><?php echo $rowMedicine['pm_med']; ?></td>
													<td><?php echo $rowMedicine['pm_med_qty']; ?></td>
													<td><?php echo CURRENCY?><?php echo $rowMedicine['pm_med_price']; ?></td>
												</tr>
                                             
                                             <?php } ?>
												
												
											</tbody>
										</table>
									</div>
											</div>
										</div>
										<div class="tab-pane active" id="tab6">
											<div class="card-body">
												<div class="table-responsive">
                                                
                                               <div class="table-responsive">
                                              
                                              <p style="font-size:18px; font-weight:bold">Following information you have filled for medical questionnaire
                                              </p> 
                                              
                                              <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">About You</h4>  
                                             
                                             <?php 
											 $aboutYou=unserialize(fnUpdateHTML($rowPres['pres_about_you']));
											 
											
											  ?>
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php foreach($aboutYou as $que => $val) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($que) ?> :
														</td>
														
														<td width="40%" style="color:#03C">
                                                        
                                                        <?php echo base64_decode($val) ?>
															
														</td>
													</tr>
                                                    
                                            <?php } ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                             <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">Your Symptoms</h4>  
                                             
                                             <?php 
											 
											 $symptoms=unserialize(fnUpdateHTML($rowPres['pres_symptoms']));
											 
											
											  ?>
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php 
												if (is_array($symptoms))
												foreach($symptoms as $que => $val) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($que) ?> :
														</td>
														
														<td width="40%" style="color:#03C">
                                                        
                                                        <?php echo base64_decode($val) ?>
															
														</td>
													</tr>
                                                    
                                            <?php } ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                             <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">Your Medical History</h4>  
                                             
                                             <?php 
											
											 $medicalHistory=unserialize(fnUpdateHTML($rowPres['pres_medical_history']));
											 
											
											  ?>
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php 
												if (is_array($medicalHistory))
												foreach($medicalHistory as $que => $val) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($que) ?> :
														</td>
														
														<td width="40%" style="color:#03C">
                                                        
                                                        <?php echo base64_decode($val) ?>
															
														</td>
													</tr>
                                                    
                                            <?php } ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                             <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">Your Medication History</h4>  
                                             
                                             <?php 
											 $medication=unserialize(fnUpdateHTML($rowPres['pres_medication']));
											
											
											  ?>
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php 
												if (is_array($medication))
												foreach($medication as $que => $val) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($que) ?> :
														</td>
														
														<td width="40%" style="color:#03C">
                                                        
                                                        <?php echo base64_decode($val) ?>
															
														</td>
													</tr>
                                                    
                                            <?php } ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                              <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">GP Details</h4>  
                                            
                                            	<table class="table">
												<tbody>
                                                <?php  
													 $sqlGP="select * from tbl_patient_gps where pg_patient_id='".$_SESSION['sess_patient_id']."'";
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
													
													<!--<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="task-list">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center">No</th>
																<th class="border-bottom-0">Task</th>
																<th class="border-bottom-0">Client</th>
																<th class="border-bottom-0">Assign To</th>
																<th class="border-bottom-0">Priority</th>
																<th class="border-bottom-0">Start Date</th>
																<th class="border-bottom-0">Deadline</th>
																<th class="border-bottom-0">Project Status</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Design Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Julia Walker</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/4.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Melanie Coleman</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-danger-light">High</span></td>
																<td>12-02-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">62%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-60"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">2</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Code Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Diane Short</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/15.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Justin Parr</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>01-01-2021</td>
																<td>22-04-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">45%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-45"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">3</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Issues fixed </span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Pippa Welch</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/5.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Amelia Russell</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-warning-light">Medium</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">53%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-50"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">4</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Testing</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Lisa Vance</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/14.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Ryan Young</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">67%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-65"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>-->
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab7">
											<div class="card-body">
                                            
                                            No messages yet!
                                            
												<!--<div class="table-responsive">
													<a href="#" class="btn btn-primary btn-tableview">Upload Files</a>
													<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="files-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">File Name</th>
																<th class="border-bottom-0">Upload By</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td>
																	<a href="#" class="font-weight-semibold fs-14 mt-5">document.pdf<span class="text-muted ml-2">(23 KB)</span></a>
																	<div class="clearfix"></div>
																	<small class="text-muted">2 hours ago</small>
																</td>
																<td>Client</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">2</td>
																<td>
																	<a href="#" class="font-weight-semibold fs-14 mt-5">image.jpg<span class="text-muted ml-2">(2.67 KB)</span></a>
																	<div class="clearfix"></div>
																	<small class="text-muted">1 day ago</small>
																</td>
																<td>Admin</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">3</td>
																<td>
																	<a href="#" class="font-weight-semibold fs-14 mt-5">Project<span class="text-muted ml-2">(578.6MB)</span></a>
																	<div class="clearfix"></div>
																	<small class="text-muted">1 day ago</small>
																</td>
																<td>Team Lead</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>-->
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
</div>

             <?php } ?>
  