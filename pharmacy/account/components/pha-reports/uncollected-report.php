<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">Uncollected Medication Report</h4>
                <br />
                <a href="javascript:history.back()">Reports</a> > Uncollected Medication
			</div>
			<div class="page-rightheader ml-md-auto">
				<button type="button" class="btn btn-secondary mr-3" onclick="window.location='export/ph-uncollected.php?<?php echo $queryString?>'" >
					<i class="las la-file-excel"></i>  Download Excel Report
				</button>
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
        <div class="row">


<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Total  Approved</span>
Orders									  
  <h1 class=" mb-1 mt-1 font-weight-bold">
  												<?php
													$statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions,tbl_payments where payment_pres_id=pres_id   and (pres_pharmacy_stage=3 || pres_pharmacy_stage=5) and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $approvedOrders=$stats[0]['ctr'];
									
													?>
  </h1>
									  
								  </div>
								</div>
							</div>
							<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Total Collected Orders</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php
													$statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions,tbl_payments where payment_pres_id=pres_id   and pres_pharmacy_stage=5 and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $collectedOrders=$stats[0]['ctr'];
									
													?></h1>
									  
								  </div>
								</div>
							</div>
							<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Total Uncollected</span>
Orders									  
  <h1 class=" mb-1 mt-1 font-weight-bold" style="color:#F00"><?php echo $uncollectedOrders=$approvedOrders-$collectedOrders; ?></h1>
									  
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
												<th width="19%" class="border-bottom-0">Patient Name</th>
                                                <th width="19%" class="border-bottom-0">DOB</th>
												<th width="14%" class="border-bottom-0">Phone No.</th>
                                                <th width="14%" class="border-bottom-0">Email</th> 
                                                
                                                <th width="27%" class="border-bottom-0">Medical Condition</th>
                                                <th width="27%" class="border-bottom-0">Medication</th>
                                                
                                                 
                                                                                               
                                                <th width="14%" class="border-bottom-0">Prescription ID</th> 
                                                <th width="14%" class="border-bottom-0">Order Approval Date</th>  
                                                <th width="14%" class="border-bottom-0">Pending to collect</th> 
                                                                                            
                                                                                               
                                                
                                                
                                               
											</tr>
										</thead>
							


									
							<tbody>
                        
                         <?php
					 	$currentDate = date('Y-m-d');
					 
						$sqlPayment = "SELECT patient_first_name, patient_middle_name,patient_last_name, patient_phone, patient_email, payment_condition, pres_condition, pres_id,	pres_pharmacy_action_date from tbl_payments, tbl_prescriptions,tbl_patients,tbl_pharmacies where pres_id=payment_pres_id and payment_status=1 and pres_patient_id=patient_id and pharmacy_id=payment_pharmacy_id and pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."' and pres_pharmacy_stage=3 ";
						
						
						if ($_GET['cmbPeriod']==1)	
						{		
						
							  $startDate = date('Y-m-01'); // First day of the current month
       						 $endDate = date('Y-m-t'); // Last day of the current month	
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$endDate'";
						} else if ($_GET['cmbPeriod']==2)	
						{		
						
							 $startDate = date('Y-m-01', strtotime('first day of last month')); // First day of the last month
       						 $endDate = date('Y-m-t', strtotime('last day of last month')); // Last day of the last month
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$endDate'";
						}
						
						else if ($_GET['cmbPeriod']==3)	
						{		
						
							 $startDate = date('Y-m-d', strtotime('-3 months'));
       						
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$currentDate'";
						}
						
						else if ($_GET['cmbPeriod']==4)	
						{		
						
							 $startDate = date('Y-m-d', strtotime('-6 months'));
       						
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$currentDate'";
						}
						
						else if ($_GET['cmbPeriod']==5)	
						{		
						
							 $startDate = date('Y-m-d', strtotime('-12 months'));
       						
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$currentDate'";
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
								$sqlPayment.=" and pres_pharmacy_action_date>='".$database->filter($startDate)."'";
							}
							if ($_GET['txtEDate']!="")
							{
								$endDate = $database->filter($_GET['txtEDate']) . ' 23:59:59';
								$sqlPayment.=" and pres_pharmacy_action_date<='".$database->filter($endDate)."'";
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
                        	<td><?php echo $rowPayment['patient_first_name']." ".$rowPayment['patient_middle_name']." ".$rowPayment['patient_last_name']; ?></td>
                            <td><?php $date=date_create($rowPayment['patient_dob']); echo date_format($date,"d/m/Y");?></td>
                            <td><?php echo $rowPayment['patient_phone']; ?></td>
                            <td><?php echo $rowPayment['patient_email']; ?></td>                          
                             
                            <td><?php echo getConditionName($rowPayment['pres_condition']); ?></td>
                            <td><?php echo getMedicationStringWithInfo($database->filter($rowPayment['pres_id'])); ?></td>
                           
                            <td><a href="?c=pha-prescriptions&task=detail&id=<?php echo $rowPayment['pres_id'] ?>" style="color:#009; font-weight:bold;">PH-<?php echo $rowPayment['pres_id'] ?></a></td>
                            <td><?php $date=date_create($rowPayment['pres_pharmacy_action_date']); echo date_format($date,"d/m/Y");?></td>
                            <td><strong><?php echo fntimeDifference($rowPayment['pres_pharmacy_action_date']) ?></strong></td>
                            
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
			<div class="modal fade"  id="excelmodal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Select Month & Year</h5>
							<button  class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="form-label">Month:</label>
								<select name="attendance"  class="form-control custom-select select2" data-placeholder="Select Month">
									<option label="Select Month"></option>
									<option value="1">January</option>
									<option value="2">February</option>
									<option value="3">March</option>
									<option value="4">April</option>
									<option value="5">May</option>
									<option value="6">June</option>
									<option value="7">July</option>
									<option value="8">August</option>
									<option value="9">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
								</select>
							</div>
							<div class="form-group">
								<label class="form-label">Year:</label>
								<select name="attendance"  class="form-control custom-select select2" data-placeholder="Select Year">
									<option label="Select Year"></option>
									<option value="1">2024</option>
									<option value="2">2023</option>
									<option value="3">2022</option>
									<option value="4">2021</option>
									<option value="5">2020</option>
									<option value="6">2019</option>
									<option value="7">2018</option>
									<option value="8">2017</option>
									<option value="9">2016</option>
									<option value="10">2015</option>
									<option value="11">2014</option>
									<option value="12">2013</option>
									<option value="13">2012</option>
									<option value="14">2011</option>
									<option value="15">2019</option>
									<option value="16">2010</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<a href="#" class="btn btn-outline-danger" data-dismiss="modal">Close</a>
							<a href="#" class="btn btn-primary">Download</a>
						</div>
					</div>
				</div>
			</div>
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