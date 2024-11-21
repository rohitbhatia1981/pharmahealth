<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">Sales Report</h4>
                <br />
                <a href="javascript:history.back()">Reports</a> > Sales Report
			</div>
			<div class="page-rightheader ml-md-auto">
				 <?php $queryString=$_SERVER['QUERY_STRING']; ?>
            
				<button type="button" class="btn btn-secondary mr-3" onclick="window.location='export/ph-sales-report-export.php?<?php echo $queryString?>'" >
					<i class="las la-file-excel"></i>  Download Excel Report
				</button>
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
        <div class="row">


<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Today's Sale</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo CURRENCY?><?php echo pharmacySale($_SESSION['sess_pharmacy_id'],1); ?></h1>
									  <!--<div class="text-muted"><i class="si si-arrow-up-circle text-danger"></i> <span class="">15%</span></div>-->
								  </div>
								</div>
							</div>
							<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>This Month Sale</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo CURRENCY?><?php echo pharmacySale($_SESSION['sess_pharmacy_id'],2); ?></h1>
									  <!--<div class="text-muted"><i class="si si-arrow-up-circle text-success"></i> <span class="">22%</span></div>-->
									</div>
								</div>
							</div>
							<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Last Month Sale</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo CURRENCY?><?php echo pharmacySale($_SESSION['sess_pharmacy_id'],3); ?></h1>
									  <!--<div class="text-muted"><i class="si si-arrow-up-circle text-success"></i> <span class="">32%</span></div>-->
									</div>
								</div>
							</div>
							<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span><?php echo date("Y") ?> Sale</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo CURRENCY?><?php echo pharmacySale($_SESSION['sess_pharmacy_id'],4); ?></h1>
									  <!--<div class="text-muted">&nbsp;<i class="si si-arrow-up-circle text-warning"></i> <span class=""></span> Increase from 20 to 12</div>-->
									</div>
								</div>
							</div>

							
							
							
							
                            
                            
                            
                            
                            
                            
						</div>
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
                            
                            
                      <form action="" method="GET">
                             	<input type="hidden" name="c" value="<?php echo $_GET['c']?>" />
                                <input type="hidden" name="task" value="<?php echo $_GET['task']?>" />      
                            
							<div class="row">
                           
                           						<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Select Period</label>
                                                  
													<select name="cmbPeriod" id="cmbPeriod"  class="form-control" data-placeholder="All" onchange="getCustomDate()">
														<option value="">All</option>
                                                        <option value="1" <?php if ($_GET['cmbPeriod']==1) echo "selected"; ?>>Current Month</option>
                                                        <option value="2" <?php if ($_GET['cmbPeriod']==2) echo "selected"; ?>>Last Month</option>
                                                        <option value="3" <?php if ($_GET['cmbPeriod']==3) echo "selected"; ?>>Last 3 Months</option>
                                                        <option value="4" <?php if ($_GET['cmbPeriod']==4) echo "selected"; ?>>Last 6 Months</option>
                                                        <option value="5" <?php if ($_GET['cmbPeriod']==5) echo "selected"; ?>>Last 12 Months</option>
                                                        <option value="6" <?php if ($_GET['cmbPeriod']==6) echo "selected"; ?>>Custom Date</option>
                                                        
													</select>
												</div>
											</div>
                                                 
                                                
                                             		 <div class="col-md-12 col-lg-12 col-xl-2" id="custom_start_date" <?php if ($_GET['cmbPeriod']!=6) { ?> style="display:none" <?php } ?>>
														<div class="form-group">
															<label class="form-label">Start Date:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSDate" type="date" value="<?php echo $_GET['txtSDate']?>">
															</div>
														</div>
													</div> 
                                                    
                                                     <div class="col-md-12 col-lg-12 col-xl-2" id="custom_end_date" <?php if ($_GET['cmbPeriod']!=6) { ?> style="display:none" <?php } ?>>
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
													<label class="form-label">Conditions</label>
                                                  
													 <?php  $sqlConditions="select condition_id,condition_title from tbl_conditions where condition_status=1 order by condition_title";
													$resConditions=$database->get_results($sqlConditions);
													
													 ?>
                                                  
													<select name="cmbConditions"  class="form-control" data-placeholder="All">
													<option value="">All Conditions</option>
                                                    <?php if (count($resConditions)>0)
													{
														for ($j=0;$j<count($resConditions);$j++)
														{
															$rowConditions=$resConditions[$j];
														?>
                                                   			 <option value="<?php echo $rowConditions['condition_id']?>" <?php if ($rowConditions['condition_id']==$_GET['cmbConditions']) echo "selected"; ?>><?php echo $rowConditions['condition_title']; ?></option>
                                                   <?php }
													}	?>
													</select>
												</div>
											</div>
                                            
                                            
                                            
											<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
												    ?>
                                                    <a href="" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>
										</div>
                                 
                                </form>
                                 
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												<th width="19%" class="border-bottom-0">Order Date</th>
                                                <th width="19%" class="border-bottom-0">Order ID</th>
                                                <th width="27%" class="border-bottom-0">Patient Name</th>
                                                <th width="27%" class="border-bottom-0">DOB</th> 
                                                <th width="27%" class="border-bottom-0">Medical Condition</th>
												
                                                <th width="14%" class="border-bottom-0">Medication</th> 
                                                <th width="14%" class="border-bottom-0">Medication Fee</th>  
                                                <th width="14%" class="border-bottom-0">Profit</th> 
                                                <th width="14%" class="border-bottom-0">Total Revenue</th>  
                                               
                                                
                                               
											</tr>
										</thead>
							


									
					<tbody>
                    
                     <?php
					 	$currentDate = date('Y-m-d');
					 
						$sqlPayment = "SELECT * from tbl_payments, tbl_prescriptions,tbl_patients,tbl_pharmacies where pres_id=payment_pres_id and payment_status=1 and pres_patient_id=patient_id and pharmacy_id=payment_pharmacy_id and pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."' ";
						
						
						if ($_GET['cmbPeriod']==1)	
						{		
						
							  $startDate = date('Y-m-01'); // First day of the current month
       						 $endDate = date('Y-m-t'); // Last day of the current month	
							 		
							$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$endDate'";
						} else if ($_GET['cmbPeriod']==2)	
						{		
						
							 $startDate = date('Y-m-01', strtotime('first day of last month')); // First day of the last month
       						 $endDate = date('Y-m-t', strtotime('last day of last month')); // Last day of the last month
							 		
							$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$endDate'";
						}
						
						else if ($_GET['cmbPeriod']==3)	
						{		
						
							 $startDate = date('Y-m-d', strtotime('-3 months'));
       						
							 		
							$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
						}
						
						else if ($_GET['cmbPeriod']==4)	
						{		
						
							 $startDate = date('Y-m-d', strtotime('-6 months'));
       						
							 		
							$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
						}
						
						else if ($_GET['cmbPeriod']==5)	
						{		
						
							 $startDate = date('Y-m-d', strtotime('-12 months'));
       						
							 		
							$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
						}
						
						
						if ($_GET['cmbConditions']!="")
						{
							$sqlPayment.=" and payment_condition='".$database->filter($_GET['cmbConditions'])."'";
						}
						
						
						if ($_GET['cmbPeriod']==6)
						{
							if ($_GET['txtSDate']!="")
							{
								 $startDate = $_GET['txtSDate']." 00:00:00";
								$sqlPayment.=" and payment_date>='".$database->filter($startDate)."'";
							}
							if ($_GET['txtEDate']!="")
							{
								$endDate = $database->filter($_GET['txtEDate']) . ' 23:59:59';
								$sqlPayment.=" and payment_date<='".$database->filter($endDate)."'";
							}
						}
						
						 $sqlPayment.=" order by payment_id desc";
						$resPayment=$database->get_results($sqlPayment);
						if (count($resPayment)>0)
						{
							
							for ($k=0;$k<count($resPayment);$k++)
							{
								$rowPayment=$resPayment[$k];
					?>	
								
                 		<tr>
                        	<td style="color:#039;font-weight:bold"><?php echo  date("d/m/Y",strtotime($rowPayment['payment_date'])); ?></td>
                           <td>PH-<?php echo $rowPayment['pres_id']?></td>
                           <td><?php echo $rowPayment['patient_first_name']." ".$rowPayment['patient_middle_name']." ".$rowPayment['patient_last_name']; ?></td>
                           <td><?php $date=date_create($rowPayment['patient_dob']); echo date_format($date,"d/m/Y");?></td>
                            <td><?php echo getConditionName($rowPayment['payment_condition'])?></td>
                            <td><?php echo getMedicationStringWithInfo($database->filter($rowPayment['pres_id'])); ?></td>
                            <td><?php echo $rowPayment['payment_medication_cost'];?></td>
                            <td><?php echo $rowPayment['payment_pharmacy_profit'];?></td>
                            <td><?php echo $totalRevenue=$rowPayment['payment_medication_cost']+$rowPayment['payment_pharmacy_profit'];?></td>
                        </tr> 
                  
                  <?php
							}
						}
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
			</div>
			<!-- End Row -->

		</div>
	</div><!-- end app-content-->
</div>
				
            
            <!--Excel Modal -->
			
			<!-- End Excel Modal  -->
            
            <script language="javascript">
			function getCustomDate()
			{
				val=$("#cmbPeriod").val();
				if (val==6)
				{
					$("#custom_start_date").show();
					$("#custom_end_date").show();
					
				}
				else
				{
					$("#custom_start_date").hide();
					$("#custom_end_date").hide();
					
				}
			}
			</script>