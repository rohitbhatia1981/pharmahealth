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
				<h4 class="page-title">Clinician Hours Report</h4>
                <br />
                <a href="javascript:history.back()">Reports</a> > Clinician Hours Report
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
        <div class="row">


<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Hours Worked: Today</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getTimeSpent('today'); ?></h1> 
									 
								  </div>
								</div>
							</div>
							<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body">
                                   
                                     <span>Hours Worked: This Week</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getTimeSpent('this_week'); ?></h1>
									  
									</div>
								</div>
							</div>
							<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Hours Worked: This Month (<?php echo date('M');?> )</span>
                                      <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getTimeSpent('this_month'); ?></h1>
									  
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
												<th width="19%" height="29" class="border-bottom-0">Clincian Name</th>
												<th width="14%" class="border-bottom-0">Registration Number</th>
                                               
                                                <th width="14%" class="border-bottom-0">Total Hours </th>  
                                               
                                              <th width="14%" class="border-bottom-0">Download Report</th>                                             
                                                
                                                
                                               
											</tr>
										</thead>
							


									
							<tbody>
                            
                        <?php 
						$sqlClinician = "SELECT * FROM tbl_prescribers where pres_status=1 order by pres_forename ";
						$resClinician=$database->get_results($sqlClinician);
						
						if (count($resClinician)>0)
						{
							for ($k=0;$k<count($resClinician);$k++)
							{
								
								$rowClinician=$resClinician[$k];
						 ?>
								
                 		<tr>
                        	<td style="color:#039;font-weight:bold"><?php echo $rowClinician['pres_forename']." ".$rowClinician['pres_surname'] ?></td>
                            <td><?php 
							
							echo getGhpCRegNo($rowClinician['pres_id']);
							 ?></td>
                            
                           
                            <td><?php echo getUserActivityDuration($monthSel, $yearSel, $rowClinician['pres_id']); ?></td>
                            
                            <td><a href="export/clinician-hours-export.php?pUserId=<?php echo $rowClinician['pres_id'] ?>&m=<?php echo $monthSel?>&y=<?php echo $yearSel?>"><i class="feather feather-download"></i> Download Report</a></td>
                           
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