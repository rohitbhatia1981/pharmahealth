<!--Page header-->
<?php
if ($_GET['m']=="")
$monthSel = date('m');
else
$monthSel = $_GET['m'];

if ($_GET['y']=="")
$yearSel = date("Y");
else
$yearSel = $_GET['y'];

?>
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">Activity Log</h4>
                <br />
                <a href="index.php?c=pres-reports">Reports</a> > Activity Log Report
			</div>
            
             <?php $queryString=$_SERVER['QUERY_STRING']; ?>
                <button type="button" class="btn btn-secondary mr-3" onclick="window.location='export/clinician-activitiy-report.php?<?php echo $queryString?>'">
					<i class="las la-file-excel"></i>  Download Excel
				</button>
            
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
        <div class="row">


<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body">Hours Worked: Today
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getTimeSpent('today',$_SESSION['sess_prescriber_id']); ?></h1> 
									 
								  </div>
								</div>
							</div>
							<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body">Hours Worked: This Week
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getTimeSpent('this_week',$_SESSION['sess_prescriber_id']); ?></h1>
									  
									</div>
								</div>
							</div>
							<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span> Hours Worked: This Month 
										<?php if ($_GET['m']!="") 
										{
											
											$monthNumeric = date($_GET['m']); // Example numeric month
											echo $monthName = strftime('%B', mktime(0, 0, 0, $monthNumeric, 1));
											
										}
										 else echo date('F');?></span>
                                      <h1 class=" mb-1 mt-1 font-weight-bold"><?php 
									  if ($_GET['m']!="" & $_GET['y']!="")
									  echo getTimeSpent('specific_month_year',$_SESSION['sess_prescriber_id'],$_GET['m'],$_GET['y']);
									  else
									  echo getTimeSpent('this_month',$_SESSION['sess_prescriber_id']); ?></h1>
									  
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
							<div class="row">
                           	
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Select Month</label>
                                     
                                                
									<select name="m"  class="form-control custom-select select2" data-placeholder="Select Month">
                                        <option label="Select Month"></option>
                                        <option value="01" <?php if ($monthSel=="01") echo "selected"; ?>>January</option>
                                        <option value="02" <?php if ($monthSel=="02") echo "selected"; ?>>February</option>
                                        <option value="03" <?php if ($monthSel=="03") echo "selected"; ?>>March</option>
                                        <option value="04" <?php if ($monthSel=="04") echo "selected"; ?>>April</option>
                                        <option value="05" <?php if ($monthSel=="05") echo "selected"; ?>>May</option>
                                        <option value="06" <?php if ($monthSel=="06") echo "selected"; ?>>June</option>
                                        <option value="07" <?php if ($monthSel=="07") echo "selected"; ?>>July</option>
                                        <option value="08" <?php if ($monthSel=="08") echo "selected"; ?>>August</option>
                                        <option value="09" <?php if ($monthSel=="09") echo "selected"; ?>>September</option>
                                        <option value="10" <?php if ($monthSel=="10") echo "selected"; ?>>October</option>
                                        <option value="11" <?php if ($monthSel=="11") echo "selected"; ?>>November</option>
                                        <option value="12" <?php if ($monthSel=="12") echo "selected"; ?>>December</option>
									</select>
												</div>
											</div>
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Select Year</label>
                                                  
													<select name="y" class="form-control custom-select select2" data-placeholder="Select Year">
												<?php for ($y = $yearSel; $y >= 2024; $y--) { ?>
                                                    <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                                <?php } ?>
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
                                        
                                      <input type="hidden" value="<?php echo $_GET['c']?>" name="c" />
                                      <input type="hidden" value="<?php echo $_GET['task']?>" name="task" />
                                        
                                </form>
                                        
                                        
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												<th width="19%" height="29" class="border-bottom-0">Login Time</th>
												<th width="14%" class="border-bottom-0">Logout Time</th>
                                               
                                                <th width="14%" class="border-bottom-0">Time spent in Session</th>  
                                               
                                                                                    
                                                
                                                
                                               
											</tr>
										</thead>
							


									
							<tbody>
                            
                        <?php 
						
						if ($_GET['y']!="")
						$year=$_GET['y'];
						else
						$year=date("Y");
						
						if ($_GET['m']!="")
						$month=$_GET['m'];
						else
						$month=date("m");
	
	 					$startDate = "$year-$month-01 00:00:00";
    					$endDate = date("Y-m-t 23:59:59", strtotime($startDate));
						
						
						$sqlClinician = "SELECT cs_login, cs_last_activity FROM tbl_prescribers, tbl_clinician_sessions 
						WHERE 
   						cs_user_id = pres_id 
    					AND pres_id = '" . $database->filter($_SESSION['sess_prescriber_id']) . "'
						AND cs_login BETWEEN '" . $database->filter($startDate) . "' AND '" . $database->filter($endDate) . "' order by cs_login desc";
						
						
						$resClinician=$database->get_results($sqlClinician);
						
						if (count($resClinician)>0)
						{
							for ($k=0;$k<count($resClinician);$k++)
							{
								
								$rowClinician=$resClinician[$k];
						 ?>
								
                 		<tr>
                        	<td style="color:#039;font-weight:bold"><?php 
							
							$dateTime = new DateTime( $rowClinician['cs_login']);
							$ukFormattedDate = $dateTime->format('d/m/Y H:i A');
							echo $ukFormattedDate;
							
							 ?></td>
                            <td><?php 
							
							$dateTime = new DateTime($rowClinician['cs_last_activity']);
							$ukFormattedDate = $dateTime->format('d/m/Y H:i A');
							echo $ukFormattedDate;
							
							  ?></td>
                            <td><?php echo CalTimeSpent($rowClinician['cs_login'],$rowClinician['cs_last_activity']) ?></td>
                           
                           
                            
                           
                           
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