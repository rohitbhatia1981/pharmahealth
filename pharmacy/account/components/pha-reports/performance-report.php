<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">Condition / Medication Performance Report</h4>
                <br />
                <a href="javascript:history.back()">Reports</a> > Performance Report
			</div>
			<div class="page-rightheader ml-md-auto">
				<button type="button" class="btn btn-secondary mr-3" onclick="window.location='export/ph-performance-report-export.php?<?php echo $queryString?>'" >
					<i class="las la-file-excel"></i>  Download Excel Report
				</button>
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
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
 
	<div class="row flex-lg-nowrap">
    
   
		<div class="col-12">
        
        <div class="row">
        
        					<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header border-0">
										<h3 class="card-title">Sales by Conditions</h3>
                                        
                                        <div class="card-options">
											<div> <a  href="javascript:void(0);" class="btn btn-outline-light dropdown-toggle" > See All  </a>
												
											</div>
										</div>
										
									</div>
									<div class="table-responsive attendance_table mt-4">
										<table class="table mb-0 text-nowrap">
											<thead>
												<tr>
													<th class="text-center">Rank</th>
													<th class="text-start">Conditions</th>
													<th class="text-center">No. of Orders</th>
													
												</tr>
											</thead>
											<tbody>
                                            
                                            
                                            <?php 
											$sqlPayment = "SELECT condition_title, COUNT(*) as ctrOrders from tbl_payments, tbl_conditions where payment_condition=condition_id and payment_status=1 and payment_pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."' ";
											
											$currentDate = date('Y-m-d');
											
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
											
											$sqlPayment.=" GROUP BY condition_title order by ctrOrders desc";
											
											$resPayment=$database->get_results($sqlPayment);
											if (count($resPayment)>0)
											{										
											$rank=1;
											
												for ($j=0;$j<count($resPayment);$j++)
												{
													$rowPayment=$resPayment[$j];
													
											?>
                                            
												<tr class="border-bottom">
													<td class="text-center"><span class="avatar avatar-sm brround"><?php echo $rank; ?></span></td>
													<td class="font-weight-semibold fs-14"><?php echo $rowPayment['condition_title']?></td>
													<td class="text-center"><?php echo $rowPayment['ctrOrders']?></td>
													
												</tr>
                                          <?php  $rank=$rank+1;
												}
										  } else { ?>
                                          		<tr class="border-bottom"><td colspan="3">No Record Found!</td></tr>
                                          
                                          <?php }
										   ?>      
                                               
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
        
							<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Sales by Medications</h3>
										<div class="card-options">
										  <div> <a  href="javascript:void(0);" class="btn btn-outline-light dropdown-toggle" > See All  </a>
												
										  </div>
										</div>
									</div>
									
									<div class="panel-body p-0 border-0">
										<div class="tab-content">
											<div>
												<div class="table-responsive attendance_table mt-4">
										<table class="table mb-0 text-nowrap">
											<thead>
												<tr>
													<th class="text-center">Rank</th>
													<th class="text-start">Medication</th>
													<th class="text-center">No. of Orders</th>
													
												</tr>
											</thead>
											<tbody>
                                             <?php 
											$sqlPayment = "SELECT med_title, COUNT(*) as ctrOrders from tbl_payments, tbl_medication where payment_medicine_id=med_id and payment_status=1 and payment_pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."' ";
											
											
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
												
												$sqlPayment.=" GROUP BY med_title order by ctrOrders desc";
												
											$resPayment=$database->get_results($sqlPayment);
											
											
											
											
											if (count($resPayment)>0)
											{										
											$rank=1;
											
												for ($j=0;$j<count($resPayment);$j++)
												{
													$rowPayment=$resPayment[$j];
													
											?>
                                            
												<tr class="border-bottom">
													<td class="text-center"><span class="avatar avatar-sm brround"><?php echo $rank; ?></span></td>
													<td class="font-weight-semibold fs-14"><?php echo $rowPayment['med_title']?></td>
													<td class="text-center"><?php echo $rowPayment['ctrOrders']?></td>
													
													
												</tr>
                                                
                                        	 <?php  $rank=$rank+1;
												}
										  } else { ?>
                                          		<tr class="border-bottom"><td colspan="3">No Record Found!</td></tr>
                                          
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