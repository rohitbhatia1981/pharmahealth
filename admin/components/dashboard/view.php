<?php function showRecordsListing()
{
global $database;

?>



			

						<!--Page header-->
						<div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<h4 class="page-title">Overview<span class="font-weight-normal text-muted ml-2"></span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="d-lg-flex d-block">
										<!--<div class="btn-list">
											<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newtaskmodal"><i class="feather feather-plus fs-15 my-auto mr-2"></i>Create New Task</a>
											<a href="#" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </a>
											<a href="#" class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </a>
											<a href="#" class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </a>
										</div>-->
									</div>
								</div>
							</div>
						</div>
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<a href="#">
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=patients'">
													<div class="mt-0 text-left">
                                                    
                                                    <?php
													$statsSql = "SELECT * FROM tbl_patients where 1";
													$stats = $database->get_results( $statsSql );
													$statsCount = count($stats);
									
													?>
                                                    
														<span class="fs-16 font-weight-semibold"> Patients</span>
													  <h3 class="mb-0 mt-1 text-danger  fs-25"><?php echo $statsCount; ?></h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger my-auto  float-right"> <i class="feather feather-users"></i> </div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<a href="#">
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=pharmacies'">
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Pharmacies</span>
														<h3 class="mb-0 mt-1 text-primary  fs-25">
                                                        
                                                        <?php
													$statsSql = "SELECT * FROM tbl_pharmacies where 1";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-primary my-auto  float-right"> <i class="feather feather-box"></i> </div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<a href="#">
										<div class="card-body">
											<div class="row">
												<div class="col-7" onclick="window.location='?c=prescribers'">
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Clincians</span>
														<h3 class="mb-0 mt-1 text-secondary fs-25">
                                                        
                                                         <?php
													$statsSql = "SELECT * FROM tbl_prescribers where 1";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-secondary my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<a href="#">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-7" onclick="window.location='?c=prescriptions'">
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Orders</span>
														<h3 class="mb-0 mt-1 text-success fs-25">
                                                        
                                                        
                                                        <?php
													$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage>0";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-success my-auto  float-right"> <i class="feather feather-file-text"></i> </div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						<!-- End Row -->

						

						<!--Row-->
						<div class="row">
                        
                        <div class="col-xl-6 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header border-0">
										<h4 class="card-title">Recent Activity</h4>
										<div class="card-options mr-3">
											<div> <a href="#" class="btn ripple btn-outline-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> See All  </a>
												
											</div>
										</div>
									</div>
									<div class="card-body pt-2">
										<ul class="timeline ">
                                        
                                        <?php 
											$sqlLogs="select * from tbl_logs order by log_id desc limit 0,7";
											$resLogs=$database->get_results($sqlLogs);
											
											if (count($resLogs)>0)
											{
										
										
											for ($j=0;$j<count($resLogs);$j++)
											{
												$rowLogs=$resLogs[$j];
										
										 ?>
										
											<li class="primary mt-6">
												<a target="_blank" href="#" class="font-weight-semibold fs-14 ml-3"><?php echo $rowLogs['log_activity']; ?></a>
												<a href="#" class="text-muted float-right fs-13"><?php echo fn_formatDateTime($rowLogs['log_date_time']) ?></a>
												<!--<p class="mb-0 pb-0 text-muted fs-14 ml-3 mt-1">Mr. Liam Botham has registered as new Patient</p>-->
											</li>
                                          
                                          <?php }
											}?>
											
										</ul>
									</div>
								</div>
							</div>
							
							<div class="col-xl-6 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header border-bottom-0">
										<h4 class="card-title">Recent Prescription Activities</h4>
										<div class="card-options mr-3">
											<div > <a href="index.php?c=prescriptions" class="btn ripple btn-outline-light dropdown-toggle" > See All  </a>
												
											</div>
										</div>
									</div>
									<div class="tab-menu-heading table_tabs mt-2 p-0 ">
										<div class="tabs-menu1">
											<!-- Tabs -->
											<ul class="nav panel-tabs">
												<li class="ml-4"><a href="#tab5" class="active"  data-toggle="tab">Pending</a></li>
												<li><a href="#tab6"  data-toggle="tab">Queries</a></li>
												<li><a href="#tab7" data-toggle="tab">Approved</a></li>
                                                <li><a href="#tab8" data-toggle="tab">Cancelled</a></li>
											</ul>
										</div>
									</div>
									<div class="panel-body tabs-menu-body table_tabs1 p-0 border-0">
										<div class="tab-content">
											<div class="tab-pane active" id="tab5">
												<div class="table-responsive recent_jobs p-0 card-body">
													<table class="table mg-b-0 text-nowrap">
														<tbody>
                                                        
                                                         <?php
														$sql = "select * from tbl_prescriptions,tbl_patients where pres_patient_id=patient_id and  pres_stage=1 order by pres_id desc limit 0,4";
														$res=$database->get_results($sql);
														if (count($res)>0)
														{
															for ($j=0;$j<count($res);$j++)
															{
																$rowPres=$res[$j];
														?>
															<tr class="border-bottom">
																<td>
																	<div class="d-flex">
																		<div class="mr-3">
																			&nbsp;
																		</div>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-0 fs-13 font-weight-semibold"><a href="?c=prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a></h6>
																			<div class="clearfix"></div>
																			<small class="text-muted"><?php echo getConditionName($rowPres['pres_condition']); ?> by <?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?> <br /> Pharmacy: <?php echo getPharmacyName($rowPres['patient_pharmacy']); ?></small>
																		</div>
																	</div>
																</td>
																<td class="text-left fs-13 text-muted"><i class="feather feather-calendar  mr-2"></i><?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?></td>
																<td class="text-left"><?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></td>
																<td class="text-left d-flex mt-1">
																	<a href="?c=prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye primary text-primary"></i></a>
																	<!--<a href="#" class="action-btns1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather feather-more-vertical text-primary"></i></a>
																	<ul class="dropdown-menu dropdown-menu-right" role="menu">
																		<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
																		<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
																		<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
																		<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
																	</ul>-->
																</td>
															</tr>
															
														<?php
															}
														} else {
														?>	
                                                        
                                                        <tr class="border-bottom">
																<td colspan="4">No record found</td>
                                                         </tr>
                                                        
                                                        <?php } ?>
															
															
														</tbody>
													</table>
												</div>
											</div>
											<div class="tab-pane" id="tab6">
												<div class="table-responsive recent_jobs p-0 card-body">
													<table class="table mg-b-0 text-nowrap">
														<tbody>
                                                        
                                                         <?php
														$sql = "select * from tbl_prescriptions where  pres_stage=2 order by pres_id desc limit 0,4";
														$res=$database->get_results($sql);
														if (count($res)>0)
														{
															for ($j=0;$j<count($res);$j++)
															{
																$rowPres=$res[$j];
														?>
															<tr class="border-bottom">
																<td>
																	<div class="d-flex">
																		<div class="mr-3">
																			&nbsp;
																		</div>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-0 fs-13 font-weight-semibold"><a href="?c=prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a></h6>
																			<div class="clearfix"></div>
																			<small class="text-muted"><?php echo getConditionName($rowPres['pres_condition']); ?> by <?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?> <br /> Pharmacy: <?php echo getPharmacyName($rowPres['patient_pharmacy']); ?></small>
																		</div>
																	</div>
																</td>
																<td class="text-left fs-13 text-muted"><i class="feather feather-calendar  mr-2"></i><?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?></td>
																<td class="text-left"><?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></td>
																<td class="text-left d-flex mt-1">
																	<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye primary text-primary"></i></a>
																	<!--<a href="#" class="action-btns1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather feather-more-vertical text-primary"></i></a>
																	<ul class="dropdown-menu dropdown-menu-right" role="menu">
																		<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
																		<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
																		<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
																		<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
																	</ul>-->
																</td>
															</tr>
															
														<?php
															}
														} else {
														?>	
                                                        
                                                        <tr class="border-bottom">
																<td colspan="4">No record found</td>
                                                         </tr>
                                                        
                                                        <?php } ?>
															
															
														</tbody>
													</table>
												</div>
											</div>
											<div class="tab-pane " id="tab7">
												<div class="table-responsive recent_jobs p-0 card-body">
													<table class="table mg-b-0 text-nowrap">
														<tbody>
                                                        
                                                         <?php
														$sql = "select * from tbl_prescriptions where  (pres_stage=4 || pres_stage=6) order by pres_id desc limit 0,4";
														$res=$database->get_results($sql);
														if (count($res)>0)
														{
															for ($j=0;$j<count($res);$j++)
															{
																$rowPres=$res[$j];
														?>
															<tr class="border-bottom">
																<td>
																	<div class="d-flex">
																		<div class="mr-3">
																			&nbsp;
																		</div>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-0 fs-13 font-weight-semibold"><a href="?c=prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a></h6>
																			<div class="clearfix"></div>
																			<small class="text-muted"><?php echo getConditionName($rowPres['pres_condition']); ?> by <?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?> <br /> Pharmacy: <?php echo getPharmacyName($rowPres['patient_pharmacy']); ?></small>
																		</div>
																	</div>
																</td>
																<td class="text-left fs-13 text-muted"><i class="feather feather-calendar  mr-2"></i><?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?></td>
																<td class="text-left"><?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></td>
																<td class="text-left d-flex mt-1">
																	<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye primary text-primary"></i></a>
																	<!--<a href="#" class="action-btns1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather feather-more-vertical text-primary"></i></a>
																	<ul class="dropdown-menu dropdown-menu-right" role="menu">
																		<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
																		<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
																		<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
																		<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
																	</ul>-->
																</td>
															</tr>
															
														<?php
															}
														} else {
														?>	
                                                        
                                                        <tr class="border-bottom">
																<td colspan="4">No record found</td>
                                                         </tr>
                                                        
                                                        <?php } ?>
															
															
														</tbody>
													</table>
												</div>
											</div>
                                            
                                            
                                            <div class="tab-pane " id="tab8">
												<div class="table-responsive recent_jobs p-0 card-body">
													<table class="table mg-b-0 text-nowrap">
														<tbody>
                                                        
                                                         <?php
														$sql = "select * from tbl_prescriptions where  pres_stage=5 order by pres_id desc limit 0,4";
														$res=$database->get_results($sql);
														if (count($res)>0)
														{
															for ($j=0;$j<count($res);$j++)
															{
																$rowPres=$res[$j];
														?>
															<tr class="border-bottom">
																<td>
																	<div class="d-flex">
																		<div class="mr-3">
																			&nbsp;
																		</div>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-0 fs-13 font-weight-semibold"><a href="?c=prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a></h6>
																			<div class="clearfix"></div>
																			<small class="text-muted"><?php echo getConditionName($rowPres['pres_condition']); ?> by <?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?> <br /> Pharmacy: <?php echo getPharmacyName($rowPres['patient_pharmacy']); ?></small>
																		</div>
																	</div>
																</td>
																<td class="text-left fs-13 text-muted"><i class="feather feather-calendar  mr-2"></i><?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?></td>
																<td class="text-left"><?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></td>
																<td class="text-left d-flex mt-1">
																	<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye primary text-primary"></i></a>
																	<!--<a href="#" class="action-btns1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather feather-more-vertical text-primary"></i></a>
																	<ul class="dropdown-menu dropdown-menu-right" role="menu">
																		<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
																		<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
																		<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
																		<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
																	</ul>-->
																</td>
															</tr>
															
														<?php
															}
														} else {
														?>	
                                                        
                                                        <tr class="border-bottom">
																<td colspan="4">No record found</td>
                                                         </tr>
                                                        
                                                        <?php } ?>
															
															
														</tbody>
													</table>
												</div>
											</div>
                                            
                                            
                                            
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->

						<!--Row-->
						<div class="row">
							<div class="col-xl-6 col-md-12">
								<div class="card">
									<div class="card-header border-0">
										<h4 class="card-title">Quick Stats </h4>
										<!--<div class="card-options mr-3">
											<a href="" class="btn btn-block btn-primary pr-3 pl-3">View full Report </a>
										</div>-->
									</div>
									<div class="table-responsive leave_table fs-13 mt-5">
										<table class="table mb-0 text-nowrap">
											<thead class="border-top">
												<tr>
													<th class="text-left">Categories</th>
													<th class="text-left">Today</th>
													<th class="text-center">Last 7 days</th>
													<th class="text-center">Last 30 days</th>
                                                    <th class="text-center">This month</th>
                                                    <th class="text-center">Last month</th>
                                                   
												</tr>
											</thead>
											<tbody>
                                            
                                                                                   <?php
									function fnCalPatients($days,$ctField,$tbl,$condField,$addCond='')
									{
									global $database;
									
									
									
									if ($days=="last month")
									{
										$sql="SELECT count(".$ctField.") AS dSum FROM ".$tbl."
										WHERE YEAR(".$condField.") = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
										AND MONTH(".$condField.") = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
										
										if ($addCond!="")
										$sql.=" ".$addCond;
										
										
									}
									
									else if ($days=="this month")
									{
										$startDate=date("Y")."-".date("m")."-"."01";
										$endDate=date("Y")."-".date("m")."-"."31";
										
										 $sql="SELECT COUNT(".$ctField.") AS dSum
												FROM ".$tbl."
												where ".$condField.">='".$startDate."' and ".$condField."<='".$endDate."'";
												
										if ($addCond!="")
										$sql.=" ".$addCond;		
												
									}
									else if ($days=="last month")
									{
										$startDate=date('Y-m-d', strtotime('first day of last month'));
										$endDate=date('m-t',strtotime('last month'));
										
										$sql="SELECT COUNT(".$ctField.") AS dSum
												FROM ".$tbl."
												where ".$condField.">='".$startDate."' and ".$condField."<='".$endDate."'";
												
										if ($addCond!="")
										$sql.=" ".$addCond;
												
									}
									
									else if ($days=="total")
									{									
										
									
										$sql="SELECT count(".$ctField.") AS dSum FROM ".$tbl." WHERE 1";
										
										if ($addCond!="")
										$sql.=" ".$addCond;
									}	
									
									
									else
									{									
										$type="DAY";
									
										$sql="SELECT count(".$ctField.") AS dSum FROM ".$tbl." WHERE DATE(".$condField.") > (NOW() - INTERVAL ".$days." ".$type.")";
										
										if ($addCond!="")
										$sql.=" ".$addCond;
									}	
									
									
										$load = $database->get_results( $sql );
										$total = count($load);	
										if ($total>0)
										{
											$row=$load[0];
											if ($row['dSum']=="")
											return "0";
											else
											return $row['dSum'];
										}
										return 0;
										
									}
									?>
                                                
												<tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-orange brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">New Patients</span></td>
													<td class="font-weight-semibold"><?php echo fnCalPatients(1,'patient_id','tbl_patients','patient_registered_date') ?></td>
													<td class="text-center text-muted"><?php echo fnCalPatients(7,'patient_id','tbl_patients','patient_registered_date') ?></td>
													<td class="text-center text-muted"><?php echo fnCalPatients(30,'patient_id','tbl_patients','patient_registered_date') ?></td>
                                                    <td class="text-center text-muted"><?php echo fnCalPatients("this month",'patient_id','tbl_patients','patient_registered_date') ?></td>
                                                    <td class="text-center text-muted"><?php echo fnCalPatients("last month",'patient_id','tbl_patients','patient_registered_date') ?></td>
                                                    
												</tr>
                                                <tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-info brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">New Pharmacies</span></td>
													<td class="font-weight-semibold"><?php echo fnCalPatients(1,'pharmacy_id','tbl_pharmacies','pharmacy_reg_date','and pharmacy_status=1') ?></td>
													<td class="text-center text-muted"><?php echo fnCalPatients(7,'pharmacy_id','tbl_pharmacies','pharmacy_reg_date','and pharmacy_status=1') ?></td>
													<td class="text-center text-muted"><?php echo fnCalPatients(30,'pharmacy_id','tbl_pharmacies','pharmacy_reg_date','and pharmacy_status=1') ?></td>
                                                    <td class="text-center text-muted"><?php echo fnCalPatients('this month','pharmacy_id','tbl_pharmacies','pharmacy_reg_date','and pharmacy_status=1') ?></td>
                                                    <td class="text-center text-muted"><?php echo fnCalPatients('last month','pharmacy_id','tbl_pharmacies','pharmacy_reg_date','and pharmacy_status=1') ?></td>
                                                    
												</tr>
                                                
                                                <tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-warning brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">Prescription Requests</span></td>
													<td class="font-weight-semibold"><?php echo fnCalPatients(1,'pres_id','tbl_prescriptions','pres_date','and pres_stage>0') ?></td>
													<td class="text-center text-muted"><?php echo fnCalPatients(7,'pres_id','tbl_prescriptions','pres_date','and pres_stage>0') ?></td>
													<td class="text-center text-muted"><?php echo fnCalPatients(30,'pres_id','tbl_prescriptions','pres_date','and pres_stage>0') ?></td>
                                                    <td class="text-center text-muted"><?php echo fnCalPatients('this month','pres_id','tbl_prescriptions','pres_date','and pres_stage>0') ?></td>
                                                    <td class="text-center text-muted"><?php echo fnCalPatients('last month','pres_id','tbl_prescriptions','pres_date','and pres_stage>0') ?></td>
                                                    
												</tr>
                                                
                                                <tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-warning brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">Prescription Approved </span></td>
													<td class="font-weight-semibold"><?php echo fnCalPatients(1,'pres_id','tbl_prescriptions','pres_date','and (pres_stage=3 || pres_stage=6)') ?></td>
													<td class="text-center text-muted"><?php echo fnCalPatients(7,'pres_id','tbl_prescriptions','pres_date','and (pres_stage=3 || pres_stage=6)') ?></td>
													<td class="text-center text-muted"><?php echo fnCalPatients(30,'pres_id','tbl_prescriptions','pres_date','and (pres_stage=3 || pres_stage=6)') ?></td>
                                                    <td class="text-center text-muted"><?php echo fnCalPatients('this month','pres_id','tbl_prescriptions','pres_date','and (pres_stage=3 || pres_stage=6)') ?></td>
                                                    <td class="text-center text-muted"><?php echo fnCalPatients('last month','pres_id','tbl_prescriptions','pres_date','and (pres_stage=3 || pres_stage=6)') ?></td>
                                                    
												</tr>
												<tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-primary brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">Payments Received</span></td>
													<td class="font-weight-semibold fs-15"><?php echo CURRENCY.getPaymentStats(1,'payment'); ?></td>
													<td class="text-center text-muted fs-15"><?php echo CURRENCY.getPaymentStats(2,'payment'); ?></td>
													<td class="text-center text-muted"><?php echo CURRENCY.getPaymentStats(3,'payment'); ?></td>
                                                    <td class="text-center text-muted"><?php echo CURRENCY.getPaymentStats(4,'payment'); ?></td>
                                                    <td class="text-center text-muted"><?php echo CURRENCY.getPaymentStats(5,'payment'); ?></td>
                                                    
                                                    
												</tr>
                                                
                                                <tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-primary brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">Fee Revenue</span></td>
													<td class="font-weight-semibold fs-15"><?php echo CURRENCY.getPaymentStats(1,'profit'); ?></td>
													<td class="text-center text-muted fs-15"><?php echo CURRENCY.getPaymentStats(2,'profit'); ?></td>
													<td class="text-center text-muted"><?php echo CURRENCY.getPaymentStats(3,'profit'); ?></td>
                                                    <td class="text-center text-muted"><?php echo CURRENCY.getPaymentStats(4,'profit'); ?></td>
                                                    <td class="text-center text-muted"><?php echo CURRENCY.getPaymentStats(5,'profit'); ?></td>
                                                    
                                                    
												</tr>
                                                
                                                
          
                                                
                                                
												
                                                
												
											</tbody>
										</table>
									</div>
                                    
									<div class="row mb-0 pb-0">
                                    
										<div class="col-2 text-center py-5 border-right">
											<h5>Payments </h5>
											<div class="justify-content-center text-center d-flex my-auto"><span class="text-primary fs-20 font-weight-semibold"><?php echo CURRENCY.getTotalPayment(); ?></span></div>
										</div>
                                        <div class="col-2 text-center py-5 border-right">
											<h5>Revenue </h5>
											<div class="justify-content-center text-center d-flex my-auto"><span class="fs-20 font-weight-semibold"><div class="justify-content-center text-center d-flex my-auto"><span class="text-secondary fs-20 font-weight-semibold"><?php echo CURRENCY.getTotalProfit(); ?></span></div></span></div>
										</div>
										<div class="col-2 text-center py-5 border-right">
											<h5>Patients </h5>
											<div class="justify-content-center text-center d-flex my-auto"><span class="text-danger fs-20 font-weight-semibold"><?php echo fnCalPatients('total','patient_id','tbl_patients','patient_registered_date') ?></span></div>
										</div>
										<div class="col-3 text-center py-5 border-right">
											<h5>Orders </h5>
											<div class="justify-content-center text-center d-flex my-auto"><span class="fs-20 font-weight-semibold"><?php echo fnCalPatients('total','pres_id','tbl_prescriptions','pres_date','and pres_stage>0') ?></span></div>
										</div>
                                        <div class="col-3 text-center py-5 border-right">
											<h5>Approved </h5>
											<div class="justify-content-center text-center d-flex my-auto"><span class="fs-20 font-weight-semibold"><?php echo fnCalPatients('total','pres_id','tbl_prescriptions','pres_date','and (pres_stage=3 || pres_stage=6)') ?></span></div>
										</div>
                                        
                                        
                                        
                                        
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-md-12">
								<div class="card overflow-hidden">
									<div class="card-header border-0">
										<h4 class="card-title">Recent Invoices</h4>
										<div class="card-options pr-3">
											<div class="dropdown">
												<a href="" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> View All </a>
												
											</div>
										</div>
									</div>
									<div class="card-body p-0 pt-4">
										<div class="table-responsive">
											<table class="table table-vcenter text-nowrap border-top mb-0 invoice-table">
												<thead>
													<tr>
														<th class="wd-10p border-bottom-0">Invoice ID</th>
														<th class="wd-15p border-bottom-0">Patient</th>
														<th class="wd-15p border-bottom-0">Amount</th>
														<th class="wd-20p border-bottom-0">Status</th>
														<!--<th class="wd-15p border-bottom-0">Actions</th>-->
													</tr>
												</thead>
												<tbody>
                                                
                                                <?php 
													$sqlPayments = "SELECT payment_id, payment_date, payment_amount,payment_patient_id,payment_status from tbl_payments WHERE 1 ";
													$resPayments=$database->get_results($sqlPayments);
													if (count($resPayments)>0)
													{		
													
													for ($k=0;$k<count($resPayments);$k++)
													{
													$rowPayments=$resPayments[$k];	
													$paymentStatus=$rowPayments['payment_status'];
																						
												?>
                                                
													<tr class="border-bottom">
														<td>
															<div class="d-flex">
                                                            
                                                            <?php 
																if ($paymentStatus==1)
																{
																	$iconStatus="success";
																	$iconVal="check";														
																} else if ($paymentStatus==2)
																{
																	$iconStatus="danger";
																	$iconVal="x";														
																} else if ($paymentStatus==0)
																{
																	$iconStatus="warning";
																	$iconVal="slash";														
																} 
																 ?>
																<span class="avatar avatar-md bradius fs-20 bg-<?php echo $iconStatus; ?>-transparent text-<?php echo $iconStatus; ?>">
																	<span class="feather feather-<?php echo $iconVal;?>"></span>
																</span>
                                                            
                                                             
                                                              
                                                                
                                                                
																<div class="ml-3 d-block mt-0 mt-sm-1">
																	<h6 class="mb-0 fs-14 font-weight-semibold">#<?php echo $rowPayments['payment_id']?></h6>
																	<div class="clearfix"></div>
																	<small class="text-muted fs-11"><?php echo  date("d M Y",strtotime($rowPayments['payment_date'])); ?></small>
																</div>
															</div>
														</td>
														<td class="text-left">
															<h6 class="mb-0 fs-14 font-weight-semibold"><?php echo getUserNameByType("patient",$rowPayments['payment_patient_id']); ?></h6>
														</td>
														<td class="text-left fs-13"><h6 class="mb-0 fs-14 font-weight-semibold"><?php echo CURRENCY.$rowPayments['payment_amount']?></h6></td>
														<td>
															
                                                            <?php 
															if ($paymentStatus==0) { ?>
															<span class="tag tag-orange">Authorized</span>
															<?php }
															
															if ($paymentStatus==1) { ?>
															<span class="tag tag-green">Paid</span>
															<?php }
															if ($paymentStatus==2) { ?>
															<span class="tag tag-red">Cancelled</span>
															<?php }
															 ?>		
                                                            
                                                            
														</td>
														<td class="text-left">
															<div class="d-flex">
                                                            <?php if ($paymentStatus==1) { ?>
																<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View Invoice"><i class="feather feather-file-text primary text-primary"></i></a>
															<?php } else echo "-";?>
															</div>
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
						<!-- End Row-->

						<!--Row-->
						
						<!-- End Row-->


                
  <?php } ?>              