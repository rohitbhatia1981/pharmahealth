<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">Monthly Payment Report</h4>
                <br />
                <a href="javascript:history.back()">Reports</a> > Monthly Payouts
			</div>
			<!--<div class="page-rightheader ml-md-auto">
				<button type="button" class="btn btn-secondary mr-3" data-toggle="modal" data-target="#excelmodal">
					<i class="las la-file-excel"></i>  Download Monthly Excel Report
				</button>
				
			</div>-->
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
                            
                            
                            
                            
							<div class="row">
                           
                           						
                                                 
                                             		  
                                                    
                                                        
                                                 
                           
                           
											
											
											<!--<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Year</label>
                                                  
													<select name="cmbYear"  class="form-control custom-select select2" data-placeholder="All">
                                                    <option value="2024">2024</option>
														
													</select>
												</div>
											</div>-->
                                            
                                            
                                            
											<!--<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
												    ?>
                                                    <a href="" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>-->
										</div>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												<th width="19%" class="border-bottom-0">Month</th>
												<th width="14%" class="border-bottom-0">Total Sales</th>                                               
                                                <th width="14%" class="border-bottom-0">Report</th>
                                                <th width="14%" class="border-bottom-0">Payment Status</th>                                              
                                                
                                                
                                               
											</tr>
										</thead>
							


									
							<tbody>
                            
                       <?php
					   $sqlPayment="SELECT 
						DATE_FORMAT(payment_date, '%M') AS month,
						DATE_FORMAT(payment_date, '%Y') AS year, 
						DATE_FORMAT(payment_date, '%m') AS month_number,
						SUM(payment_amount) AS total_amount
					FROM 
						tbl_payments
					where
					 payment_pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."'
					 and payment_status=1
					GROUP BY 
						YEAR(payment_date), 
						MONTH(payment_date)
					ORDER BY 
						payment_date desc;
					";
					
					
					$resPayment=$database->get_results($sqlPayment);
					
					if (count($resPayment)>0)
						{
							
							for ($k=0;$k<count($resPayment);$k++)
							{
								$rowPayment=$resPayment[$k];
					   ?>
								
                 		<tr>
                        	<td style="color:#039;font-weight:bold"><?php echo $rowPayment['month']." ".$rowPayment['year']?></td>
                            <td><?php echo CURRENCY?><?php echo $rowPayment['total_amount']?></td>
                            <td><a href="export/ph-monthly-payment.php?m=<?php echo $rowPayment['month_number'];?>&y=<?php echo $rowPayment['year'];?>" ><i class="feather feather-download"></i> Download Report</a></td>
                            <td><span class="badge badge-warning">Pending</span></td>
                           
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
			
			<!-- End Excel Modal  -->