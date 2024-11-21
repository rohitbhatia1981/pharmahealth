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
				<h4 class="page-title">Prescription Report</h4>
                <br />
                <a href="javascript:history.back()">Reports</a> > Prescription Report
			</div>
			<div class="page-rightheader ml-md-auto">
				<button type="button" class="btn btn-secondary mr-3" onclick="window.location='export/ph-prescription-report-export.php?<?php echo $queryString?>'" >
					<i class="las la-file-excel"></i>  Download Excel Report
				</button>
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
        <div class="row">




							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
                                   
                                    
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left" style="cursor:pointer" onclick="window.location='?c=pha-prescriptions&cmbCategory=1'">
														<span class="fs-14 font-weight-semibold">To Process</span>
														<h3 class="mb-0 mt-1 text-primary  fs-25">
                                                        
                                                        <?php
													 $statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions,tbl_payments where payment_pres_id=pres_id and pres_pharmacy_stage=1 and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $statsCount=$stats[0]['ctr'];
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-primary-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left" style="cursor:pointer" onclick="window.location='?c=pha-prescriptions&cmbCategory=2'">
														<span class="fs-14 font-weight-semibold">Query</span>
														<h3 class="mb-0 mt-1 text-orange  fs-25"> <?php
													$statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions,tbl_payments where payment_pres_id=pres_id and pres_pharmacy_stage=2 and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $statsCount=$stats[0]['ctr'];
									
													?></h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-primary-transparent my-auto  float-right"> <i class="feather feather-clipboard"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left" style="cursor:pointer" onclick="window.location='?c=pha-prescriptions&cmbCategory=4'">
														<span class="fs-14 font-weight-semibold">Cancelled</span>
														<h3 class="mb-0 mt-1 text-warning  fs-25">
                                                        
                                                         <?php
													$statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions,tbl_payments where payment_pres_id=pres_id and pres_pharmacy_stage=4 and pres_stage<>5 and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $statsCount=$stats[0]['ctr'];
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-secondary-transparent my-auto  float-right"> <i class="feather feather-info"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left" style="cursor:pointer" onclick="window.location='?c=pha-prescriptions&cmbCategory=3'">
														<span class="fs-14 font-weight-semibold">Ready for Collection</span>
														<h3 class="mb-0 mt-1 text-pink fs-25">
                                                        
                                                         <?php
													$statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions,tbl_payments where payment_pres_id=pres_id and pres_pharmacy_stage=3 and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $statsCount=$stats[0]['ctr'];
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-pink-transparent my-auto  float-right"> <i class="feather feather-check"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
                            
                            
                            
                            
						</div>
			<div class="row flex-lg-nowrap">
		<div class="col-12">
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
                        
                        
							<div class="e-table">
                            
                            
                          <?php if ($_GET['ty']!="s") { ?>  
                           
                           <form name="adminForm" action="" method="get"> 
                           
                           	<input type="hidden" name="c" value="<?php echo $_GET['c']?>" />
                            <input type="hidden" name="task" value="<?php echo $_GET['task']?>" />
                            
                            
							<div class="row">
                            
                            
           
                           
                           					<div class="col-md-12 col-lg-12 col-xl-3">
                                            
                                            
														<div class="form-group">
															<label class="form-label">Search</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>" placeholder="Search by Order No., Full Name, Date of Birth">
															</div>
														</div>
													</div>
                                                 
                                                 
                                            <div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">Period:</label>
                                                    
                                                  
                                                    
													<select name="cmbPeriod" id="cmbPeriod"  class="form-control " data-placeholder="All" onchange="getCustomDate()">
														<option value="" >All Orders</option>
                                                        <option value="1" <?php if ($_GET['cmbPeriod']==1) echo "selected"; ?>>Last 14 days</option>
                                                        <option value="2" <?php if ($_GET['cmbPeriod']==2) echo "selected"; ?>>Last 30 days</option>
                                                        <option value="3" <?php if ($_GET['cmbPeriod']==3) echo "selected"; ?>>Last 90 days</option>
                                                        <option value="4" <?php if ($_GET['cmbPeriod']==4) echo "selected"; ?>>Last 180 days</option>
                                                        <option value="6" <?php if ($_GET['cmbPeriod']==6) echo "selected"; ?>>Last 365 days</option>
                                                        <option value="7" <?php if ($_GET['cmbPeriod']==7) echo "selected"; ?>>Custom Date</option>
                                                        
                                                       
                                                        
														
													</select>
												</div>
											</div>  
                                            
                                             <div class="col-md-12 col-lg-12 col-xl-2" id="custom_start_date" <?php if ($_GET['cmbPeriod']!=7) { ?> style="display:none" <?php } ?>>
														<div class="form-group">
															<label class="form-label">Start Date:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSDate" type="date" value="<?php echo $_GET['txtSDate']?>">
															</div>
														</div>
													</div> 
                                                    
                                                     <div class="col-md-12 col-lg-12 col-xl-2" id="custom_end_date" <?php if ($_GET['cmbPeriod']!=7) { ?> style="display:none" <?php } ?>>
														<div class="form-group">
															<label class="form-label">End Date:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtEDate" type="date" value="<?php echo $_GET['txtEDate']?>">
															</div>
														</div>
													</div>      
                           
                           
											
											
											<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">Filter by Status:</label>
                                                    
                                                  
                                                    
													<select name="cmbCategory"  class="form-control custom-select select2" data-placeholder="All">
														 <option value="11" <?php if ($_GET['cmbCategory']==11) echo "selected"; ?>>All</option>
                                                        <option value="1" <?php if ($_GET['cmbCategory']==1 ) echo "selected"; ?>>To Process</option>
                                                        <option value="2" <?php if ($_GET['cmbCategory']==2) echo "selected"; ?>>Query</option>
                                                        <option value="4" <?php if ($_GET['cmbCategory']==4) echo "selected"; ?>>Cancelled</option>
                                                        <option value="3" <?php if ($_GET['cmbCategory']==3) echo "selected"; ?>>Ready for Collection</option>
                                                        <option value="5" <?php if ($_GET['cmbCategory']==5) echo "selected"; ?>>Collected</option>
                                                       
                                                        
                                                        
														
													</select>
												</div>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-1">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
													   
												    ?>
                                                    <a href="?c=<?php echo $_GET['c']?>&task=<?php echo $_GET['task']?>" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php }
												   
												    ?>
												</div>
											</div>
										</div>
                                     </form>
                                        
                                 <?php } ?>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top" id="example1" width="100%">
										<thead>
											<tr>
												
												<th width="14%" class="border-bottom-0">Prescription ID</th>
                                                <th width="14%" class="border-bottom-0">Order ID</th>                                                
                                                <th width="10%" class="border-bottom-0">Date</th>
                                               
                                                <th width="10%" class="border-bottom-0">Patient Name</th>
                                                <th width="10%" class="border-bottom-0">DOB</th>
                                               
                                                
                                                 
                                                <th width="9%" class="border-bottom-0">Medical <br /> Condition</th>                                                
                                                <th width="30%" class="border-bottom-0">Medication</th>
                                                <th width="17%" class="border-bottom-0 w-20">Status</th>
                                               
                                               
                                                
											</tr>
										</thead>
							<?php

							
					
						
	$sql = "SELECT 
    payment_date,
	pres_id,
	payment_id, 
	patient_first_name,
	patient_middle_name,
	patient_last_name,
	patient_dob,
	pres_condition,
	pres_stage,
	pres_pharmacy_stage,
    payment_amount,
    payment_consultation_cost,
    payment_pharmacy_profit,
    payment_medication_cost,
    payment_condition,
    payment_medicine_id,
	payment_pharma_profit
FROM 
    tbl_payments, 
    tbl_prescriptions,
	tbl_patients
	
WHERE 
    pres_id=payment_pres_id
	and payment_status=1 
	and pres_patient_id=patient_id 
	
	and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and pres_id like '%".$database->filter(str_replace("PH-","",$_GET['txtSearchByTitle']))."%'";

		}
		
		if($_GET['cmbCategory'] != "" && $_GET['cmbCategory'] != 11)

		{

			$sql .= " and pres_pharmacy_stage='".$database->filter($_GET['cmbCategory'])."'";

		}
		else
		$sql .= " and pres_pharmacy_stage>0";
		
		
		
		if ($_GET['cmbPeriod']==1)
		$daysDe="14";
		else if ($_GET['cmbPeriod']==2)
		$daysDe="30";
		else if ($_GET['cmbPeriod']==3)
		$daysDe="90";
		else if ($_GET['cmbPeriod']==4)
		$daysDe="180";
		else if ($_GET['cmbPeriod']==6)
		$daysDe="365";
		
		
		if ($_GET['cmbPeriod']!="" && $daysDe!="")
		{
		$strDays='P'.$daysDe.'D';
		$today = new DateTime();
		$interval = new DateInterval($strDays);
		$oldDate = $today->sub($interval)->format('Y-m-d');

		
		$sql.=" and pres_date > '".$oldDate."'";
		} 
		
		if ($_GET['cmbPeriod']=="7")
		{
			
			
		
												if ($_GET['txtSDate']!="")
													{
														 $startDate = $_GET['txtSDate']." 00:00:00";
														$sql.=" and pres_date>='".$database->filter($startDate)."'";
													}
													if ($_GET['txtEDate']!="")
													{
														$endDate = $database->filter($_GET['txtEDate']) . ' 23:59:59';
														$sql.=" and pres_date<='".$database->filter($endDate)."'";
													}	
			
		}
		
		

		 $sql .= " order by pres_date asc";
					
		$resPres=$database->get_results($sql);
		
		
		$totalRecords=count($resPres);
		
						
						if($totalRecords > 0) 

							{

						
						for ($k=0;$k<$totalRecords;$k++)
						{
							
							$rowPres=$resPres[$k];
							
						
						?>



									
							<tbody>
								<tr>
									
									
                                    <td class="align-middle">
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    <a href="?c=pha-prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a>
										
												
											
									</td>
                                     <td class="align-middle">
										
										<?php echo $rowPres['payment_id']; ?>
											
									</td>
                                    
                                    <td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['payment_date'])); ?>
											
									</td>
                                    
                                    <td><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></td>
                                     <td><?php 
									
									//$from = new DateTime($rowPres['patient_dob']);
									//$to   = new DateTime('today');
									//echo $from->diff($to)->y;
									
									$dateFromMySQL=$rowPres['patient_dob'];
									echo $formattedDate = date('d/m/y', strtotime($dateFromMySQL));

									 ?></td>
                                     
                                   
                                    
                                  <td class="align-middle">
										
												<?php echo getConditionName($rowPres['pres_condition']); ?>
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle" >
										
												 <?php 
												 
												 $medicinesStr=str_replace("<br>"," ",getMedicationStringWithInfo($rowPres['pres_id']));
												 echo $medicinesStr;
																
														   
														   ?>
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php 
															if ($rowPres['pres_stage']==5) echo "<span class='tag tag-red'>Cancelled</span>" ;
															else
															echo getPrescriptionStatus_pharmacy($rowPres['pres_pharmacy_stage']); ?>
                                                            
                                                            
                                                           
                                                            
                                                           
											</div>
										</div>
									</td>
                                    
                                   
                                   
                                    
									

									
								</tr>
                                
                                

								<?php 

}

}

else

{

	?>

	<tr>

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="12"> - No Record found - </th>
	</tr>

	<?php

}



?>				
							
							</tbody>
											</table>

												<?php
												if($totalRecords > 0) 
												{
												//$pagingObject->displayLinks_Front(); 
												}

												?>

										</div>
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
			
			<!-- End Excel Modal  -->
          
           <script language="javascript">
			function getCustomDate()
			{
				
				val=$("#cmbPeriod").val();
				if (val==7)
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