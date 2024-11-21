<?php function showRecordsListing()

{

global $database;



?>







			



						<!--Page header-->

						<div class="page-header d-xl-flex d-block">

							<div class="page-leftheader">

								<h4 class="page-title">Dashboard <span class="font-weight-normal text-muted ml-2"></span></h4>

							</div>

							<div class="page-rightheader ml-md-auto">

								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">

									<div class="d-lg-flex d-block">

										<div class="btn-list">

											<!--<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newtaskmodal"><i class="feather feather-plus fs-15 my-auto mr-2"></i>Create New Task</a>-->

											<!--<a href="#" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </a>

											<a href="#" class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </a>

											<a href="#" class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </a>-->

										</div>

									</div>

								</div>

							</div>

						</div>

						<!--End Page header-->

						<?php
						
						$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' and pres_stage>0 order by pres_id desc ";
						$resPres=$database->get_results($sqlPres);
						
						if (count($resPres)>0)
						{
						$rowPres=$resPres[0];
						
						?>

						<!-- Row -->
						<div class="row">
							<div class="col-md-12">
								<div class="card" style="background:#e2e8f6; border:1px solid #0066CC">
									<div class="card-header" style="border-bottom:1px solid #c0c0c1">
										<h4 class="card-title" style="padding-bottom:7px">Most Recent Order</h4>
									</div>
									<div class="card-body pt-0 pb-3">
										<div class="row mb-0 pb-0">
											<div class="col-md-12 col-lg-10 text-center" style="padding:10px 0px">
												<div class="table-responsive">
                                                
											<table class="table" style="text-align:left;">
												<tbody>
													<tr>
														<td style="padding:3px 10px!important">
															<span class="w-50">Order No</span>
														</td>
														<td style="padding:3px 10px!important">:</td>
														<td style="padding:3px 10px!important">
															<span class="font-weight-semibold">PH-<?php echo $rowPres['pres_id'] ?></span> &nbsp;
                                                            <?php echo getPrescriptionStatus($rowPres['pres_stage']); ?>
														</td>
													</tr>
													<tr>
														<td style="padding:3px 10px !important">
															<span class="w-50">Date</span>
														</td>
														<td style="padding:3px 10px!important">:</td>
														<td style="padding:3px 10px!important">
															<span class="font-weight-semibold"><?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?></span>
														</td>
													</tr>
													<tr>
														<td style="padding:3px 10px !important">
															<span class="w-50">Condition</span>
														</td>
														<td style="padding:3px 10px!important">:</td>
														<td style="padding:3px 10px!important">
															<span class="font-weight-semibold"><?php echo getConditionName($rowPres['pres_condition']) ?></span>
														</td>
													</tr>
													<tr>
														<td style="padding:3px 10px !important; vertical-align:top">
															<span class="w-50">Medication</span>
														</td>
														<td style="padding:3px 10px!important; vertical-align:top">:</td>
														<td style=" padding:3px 10px!important; vertical-align:top">
															<span class="font-weight-semibold">
                                                            
                                                            <?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           } ?>
                                                             </span>
														</td>
													</tr>
													
												</tbody>
											</table>
										</div>
											</div>
											<div class="col-md-12 col-lg-2 text-center py-5 ">
												<div class="form-group mt-5">
													<a href="#" class="btn btn-danger tag-red btn-block">Re-Order</a>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>	

						<!-- End Row -->



						



						<!--Row-->

						<div class="row">

                        

                        <div class="col-xl-9 col-md-12">

								<div class="card overflow-hidden">

									<div class="card-header border-0">

										<h4 class="card-title">Recent Orders</h4>

										<div class="card-options pr-3">

											<div class="dropdown">

												<a href="" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> View All </a>

												

											</div>

										</div>

									</div>

									<div class="card-body p-0 pt-4">

										<div class="table-responsive">

											<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												<th width="7%" class="border-bottom-0">Date</th>
                                                <th width="11%" class="border-bottom-0">Order No.</th>
                                                <th width="29%" class="border-bottom-0">Medical Condition</th>                                                
                                                <th width="38%" class="border-bottom-0">Medication</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
											</tr>
										</thead>
							<?php

							/*if($totalRecords > 0) 

							{

							for ($i = 0; $i < $totalRecords; $i++) 

							{

							$srno++;

							$row = &$rows[$i];

*/

							?>				
							<tbody>
                            
                            
                            <?php
						
						$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' order by pres_id desc limit 0,5";
						$resPres=$database->get_results($sqlPres);
						
						
						for ($k=0;$k<count($resPres);$k++)
						{
							
							$rowPres=$resPres[$k];
						
						?>

								<tr>
									
									<td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
											
									</td>
                                    <td class="align-middle">
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    <a href="?c=patient-prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a>
										
												
											
									</td>
                                    
                                    
                                    
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
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php echo getPrescriptionStatus($rowPres['pres_stage']); ?>
                                                            
                                                            <?php echo $val; ?>
                                                            
                                                           
											</div>
										</div>
									</td>
									

									
								</tr>
                         
                         <?php } ?>       
                                
                                
                                
                                
                                
                                
                                
                                
                                

								<?php

//}

//}

//else

//{

	?>

	<!--<tr>

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="11"> - No Record found - </th>
	</tr>-->

	<?php

//}



?>				
							
							</tbody>
											</table>

										</div>

									</div>

								</div>

							</div>

                        

                        <div class="col-xl-3 col-md-12 col-lg-12">

								<div class="card">

									<div class="card-header border-0">

										<h4 class="card-title">Recent Activity</h4>

										<div class="card-options mr-3">

											<!--<div> <a href="#" class="btn ripple btn-outline-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> See All  </a>

												

											</div>-->

										</div>

									</div>

									<div class="card-body pt-2">

                                    No activity yet!

										<ul class="timeline ">
											<li class="primary mt-6">

												<a  href="#" >New messages from Well Pharmacy</a>

												<a href="#" class="text-muted float-right fs-13">10 min ago</a>

												

											</li>
										

											<!--<li class="primary mt-6">

												<a  href="#" >New messages from Well Pharmacy</a>

												<a href="#" class="text-muted float-right fs-13">10 min ago</a>

												

											</li>-->

                                            

                                            <!--<li class="primary mt-6">

												<a  href="#" >Pharmacy Id: #4223 approved</a>

												<a href="#" class="text-muted float-right fs-13">10 min ago</a>

												

											</li>-->

											

										</ul>

									</div>

								</div>

							</div>

							

							

						</div>

						<!-- End Row -->



						<!--Row-->

						

						<!-- End Row-->



						<!--Row-->

						

						<!-- End Row-->





                

  <?php } ?>              