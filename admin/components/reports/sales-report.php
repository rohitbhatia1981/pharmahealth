<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">Sales Report</h4>
                <br />
                <a href="javascript:history.back()">Reports</a> > Sales Report
			</div>
			<div class="page-rightheader ml-md-auto">
            
            <?php $queryString=$_SERVER['QUERY_STRING']; ?>
            
				<button type="button" class="btn btn-secondary mr-3" onclick="window.location='export/sales-report-export.php?<?php echo $queryString?>'" >
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
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo CURRENCY.getPaymentStats(1,'payment')?></h1>
									  <!--<div class="text-muted"><i class="si si-arrow-up-circle text-danger"></i> <span class="">15%</span></div>-->
								  </div>
								</div>
							</div>
							<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Last 7 days Sale</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo CURRENCY.getPaymentStats(2,'payment')?></h1>
									  <!--<div class="text-muted"><i class="si si-arrow-up-circle text-success"></i> <span class="">22%</span></div>-->
									</div>
								</div>
							</div>
							<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Last 30 days Sale</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo CURRENCY.getPaymentStats(3,'payment')?></h1>
									  <!--<div class="text-muted"><i class="si si-arrow-up-circle text-success"></i> <span class="">32%</span></div>-->
									</div>
								</div>
							</div>
							<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Lifetime Sale</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo CURRENCY.getTotalPayment()?></h1>
									  
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
                          
                           						
                                                 
                                             		 <div class="col-md-12 col-lg-12 col-xl-2">
														<div class="form-group">
															<label class="form-label">Start Date:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSDate" type="date" value="<?php echo $_GET['txtSDate']?>">
															</div>
														</div>
													</div> 
                                                    
                                                     <div class="col-md-12 col-lg-12 col-xl-2">
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
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Medication</label>
                                                    
                                                     <?php  $sqlM="select med_id,med_title from tbl_medication where med_status=1 order by med_title";
													$resM=$database->get_results($sqlM);
													
													
													 ?>
                                                  
													<select name="cmbMedication"  class="form-control " data-placeholder="All">
														<option value="">All Medications</option>
                                                        
															<?php if (count($resM)>0)
                                                            {
                                                            for ($j=0;$j<count($resM);$j++)
                                                            {
                                                                $rowM=$resM[$j];
                                                            ?>
                                                             <option value="<?php echo $rowM['med_id']?>" <?php if ($rowM['med_id']==$_GET['cmbMedication']) echo "selected"; ?>><?php echo $rowM['med_title']?></option>
                                                            <?php } 
															}?>
													</select>
												</div>
											</div>
                                            
											<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"cmbConditions"))
												   {
												    ?>
                                                    <a href="?c=reports&task=sale" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>
                                       
										</div></form>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top" id="example1" width="100%">
										<thead>
											<tr>
												<th width="19%" class="border-bottom-0">Date</th>
                                                <th width="14%" class="border-bottom-0">Payment ID</th>
												<th width="14%" class="border-bottom-0">Payment Received</th>
                                                <th width="14%" class="border-bottom-0"> Clinician Fees</th> 
                                                <th width="14%" class="border-bottom-0">Pharmacy Fees (Exc Medication cost)</th> 
                                                <th width="14%" class="border-bottom-0">Medication Cost (Paid to pharmacy)</th>  
                                                <th width="14%" class="border-bottom-0">Total Pharmacy Fees</th>  
                                                <th width="14%" class="border-bottom-0">Amount Refunded</th> 
                                                <th width="14%" class="border-bottom-0">PH Total Amount​</th>                                             
                                                <th width="27%" class="border-bottom-0">Medical Condition</th>                                                
                                                <th width="25%" class="border-bottom-0">Medication</th>
                                                
                                               
											</tr>
										</thead>
							


									
							<tbody>
					
                    <?php
						$sqlPayment = "SELECT * from tbl_payments, tbl_prescriptions,tbl_patients where pres_id=payment_pres_id and pres_patient_id=patient_id ";
						
						if ($_GET['cmbConditions']!="")
						{
							$sqlPayment.=" and payment_condition='".$database->filter($_GET['cmbConditions'])."'";
						}
						
						if ($_GET['cmbMedication']!="")
						{
							$sqlPayment.=" and payment_medicine_id='".$database->filter($_GET['cmbMedication'])."'";
						}
						
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
                            <td><?php echo $rowPayment['payment_id']?></td>
                            <td><?php echo CURRENCY.$rowPayment['payment_amount']?></td>
                            <td><?php echo CURRENCY.$rowPayment['payment_consultation_cost']?></td>
                            <td><?php echo CURRENCY.$rowPayment['payment_pharmacy_profit']?></td>
                            <td><?php echo CURRENCY.$rowPayment['payment_medication_cost']?></td>
                            <?php $totalPharmacyFees=$rowPayment['payment_pharmacy_profit']+$rowPayment['payment_medication_cost']; ?>
                            <td><?php echo CURRENCY.$totalPharmacyFees?></td>
                            
                            <td><?php if ($rowPayment['payment_amount']==2) echo CURRENCY.$rowPayment['payment_amount']; else echo "0"; ?></td>
                            <td><?php if ($rowPayment['payment_amount']!=2) echo CURRENCY.$rowPayment['payment_pharma_profit']; else echo "0";?></td>
                            <td><?php echo getConditionName($rowPayment['payment_condition'])?></td>
                            <td><?php echo getMedicineName($rowPayment['payment_medicine_id']); ?></td>
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