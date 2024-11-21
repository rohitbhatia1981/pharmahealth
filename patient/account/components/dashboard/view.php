<?php function showRecordsListing()

{

global $database;



?>







			



						<!--Page header-->

						<div class="page-header d-xl-flex d-block">

							<div class="page-leftheader">
                           

								<h4 class="page-title">Dashboard<span class="font-weight-normal text-muted ml-2"></span></h4>

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
															<span class="font-weight-semibold"><a href="?c=patient-prescriptions&task=detail&id=<?php echo $rowPres['pres_id'] ?>" style="color: rgb(0, 102, 255); text-decoration: underline; cursor: pointer;">PH-<?php echo $rowPres['pres_id'] ?></a></span> &nbsp;
                                                            
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
																	echo "<br>";
                                                            
                                                            
                                                           } ?>
                                                             </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td style="padding:3px 10px !important">
															<span class="w-50">Total Price</span>
														</td>
														<td style="padding:3px 10px!important">:</td>
														<td style="padding:3px 10px!important">
															<span class="font-weight-semibold"><?php echo CURRENCY.getOrderPrice($rowPres['pres_id']) ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td style="padding:3px 10px !important">
															<span class="w-50">Status</span>
														</td>
														<td style="padding:3px 10px!important">:</td>
														<td style="padding:3px 10px!important">
															<span class="font-weight-semibold"> <?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></span>
														</td>
													</tr>
													
												</tbody>
											</table>
										</div>
											</div>
                                             <?php if ($rowPres['pres_stage']==3) { ?>
											<div class="col-md-12 col-lg-2 text-center py-5 ">
												<div class="form-group mt-5">
													<a href="#" class="btn btn-danger tag-red btn-block">Re-Order</a>
												</div>
											</div>
                                            <?php } ?>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>	

						<!-- End Row -->



						



						<!--Row-->

						<div class="row">

                        

                        <div class="col-xl-12 col-md-12">

								<div class="card overflow-hidden">

									<div class="card-header border-0">

										<h4 class="card-title">Recent Orders</h4>

										<div class="card-options pr-3">

											<div class="dropdown">

												<a href="?c=patient-prescriptions" class="btn btn-primary dropdown-toggle"  role="button" aria-haspopup="true" aria-expanded="false"> View All </a>

												

											</div>

										</div>

									</div>

									<div class="card-body p-0 pt-4">
                                    
                                    <?php
									$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' and pres_stage>0 order by pres_id desc limit 0,5";
									$resPres=$database->get_results($sqlPres);
									$totalRecords=count($resPres);
									?>
                                    

										<div class="table-responsive">

											<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												<th width="14%" class="border-bottom-0">Date</th>
                                                <th width="19%" class="border-bottom-0">Order No.</th>
                                                <th width="27%" class="border-bottom-0">Medical Condition</th>                                                
                                                <th width="25%" class="border-bottom-0">Medication</th>
                                                <th width="25%" class="border-bottom-0">Price</th>
                                                <th width="15%" class="border-bottom-0 w-20">Order Status</th>
                                                <th width="15%" class="border-bottom-0 w-20"><?php if ($_GET['ty']!="in") { ?> Re-order Status <?php } ?></th>
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
							
							$rowPres=$resPres[$k];
						
						?>



									
							<tbody>
								<tr>
									
									<td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
                                        
                                        <?php 
									if ($rowPres['pres_same_day']==1) { ?>
                                    <br />	
                                    <span class="badge badge-danger mt-2">Same-day</span>
                                    <?php } ?>	
											
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
												echo getMedicationStringWithInfo($rowPres['pres_id']);
																/*$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
																	echo "<br>";
                                                            
                                                            
                                                           } */?>
                                                           
                                                           <?php if ($rowPres['pres_medicine_change_status']==2)
														   {
														   echo "<br><a href='?c=patient-prescriptions&task=detail&tab=order&id=".$rowPres['pres_id']."' style='font-size:13px; color:#F00; font-weight:500;'><i class='feather-alert-circle'></i> &nbsp;Clinician suggested medication change</a>";
														   ?>
                                                           <a href="?c=patient-prescriptions&task=detail&tab=order&id=<?php echo $rowPres['pres_id']; ?>" style="font-size:12px; text-decoration:underline; color:#06F">Review Change</a>
                                                           <?php } ?>
											
									</td>
                                    
                                    <td class="align-middle">
										
										<?php $totalPriceCharged=getOrderPrice($rowPres['pres_id']);
										if ($totalPriceCharged!="") echo CURRENCY.$totalPriceCharged; ?>		 
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php 
															
															print getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']);
															
															if ($rowPres['pres_stage']==1)
															{ ?>
                                                            <br />
                                                            	<a href="?c=patient-prescriptions&task=cancel&id=<?php echo $rowPres['pres_id']; ?>" style="font-size:12px; color:#06F">Cancel your order</a>
                                                            <?php } ?>
															
															
															
															
                                                            <?php echo $val; ?>
                                                            
                                                           
											</div>
										</div>
									</td>
                                    <?php if ($_GET['ty']!="in") { ?>
									<td>
                                    
                                    		<?php if ($rowPres['pres_stage']==3 || $rowPres['pres_stage']==7 || $rowPres['pres_stage']!="") { 
											
											$dateFromDatabase = $rowPres['pres_expiry_date']; 
											$reorder_activate = date('Y-m-d', strtotime($dateFromDatabase . ' -28 days'));
																					
											$currentDate = date('Y-m-d');
											
											$reorder_expiry = date('Y-m-d', strtotime($dateFromDatabase . ' +12 months'));
											
											// Compare the two dates
																				
											
											if ($reorder_expiry>$currentDate)
											{
												
												if ($reorder_activate<=$currentDate)
												{
											?>
                                            
                                            
                                            
                                                    <a href="?c=patient-prescriptions&task=reorder&id=<?php echo $rowPres['pres_id']?>" class="btn btn-red">Re-Order Medicine</a>
                                                    <?php
													
													 $reorder_expiry = date('Y-m-d', strtotime($dateFromDatabase . ' +12 months'));
												}
												else
												{ ?>
													Not Due Yet <img title="Re-0rder option will be available 28 days prior to your current supply ending." src="<?php echo URL?>images/i-icon.png" style="max-width:24px" />
												<?php }
												
													 
													
											} else echo "Expired";  ?>
                                            <?php } else { 
											
											echo "<font style='color:#ff0000'>-</font>"; 
											 } 
											?>
                                    
                                    </td>
                                    <?php } else { ?>
                                    <td><a href="?c=patient-prescriptions&task=incomplete&id=<?php echo $rowPres['pres_id']?>" class="btn btn-green">Click to complete</a> <br />
                                    
                                    <a href="javascript:void(0)" style="font-size:13px; color:#06F" onclick="deleteInOrder(<?php echo $rowPres['pres_id']?>)">Delete order</a>
                                    </td>
                                    <?php } ?>
                                    

									
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

										</div>

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