		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$totalRecords = count($rows);

		if ($page != 1)    

			$srno = (1 * $page) - 1;

		else

			$srno = 0;

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['sess_prescriber_groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	
        
        <style>
		.trrow:hover {
		  background-color:#F1F4FB;
		  cursor:pointer;
		}
		</style>
		
<form name="adminForm" action="?c=<?php echo $component?>" method="get">


<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title"><?php echo pageheading(); ?></h4>
			</div>
			<div class="page-rightheader ml-md-auto">
				
				
			</div>
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
                           
                           					<div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Search with Keyword:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control fc-datepicker" name="txtSearch" placeholder="" value="<?php echo $_GET['txtSearch']?>" type="text">
															</div>
														</div>
													</div>
                                                 
                                                 
                                                 
                           
                           
											
											
										
                                            
                                            
                                            
                                            
											<div class="col-md-12 col-lg-12 col-xl-1">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtDateFrom"))
												   {
												    ?>
                                                    <a href="?c=<?php echo $_GET['c']?>" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>
										</div>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												<th width="10%" class="border-bottom-0">Request ID</th>
                                                <th width="10%" class="border-bottom-0">Order ID</th>
                                                <th width="51%" class="border-bottom-0">Message</th>
                                                <th width="11%" class="border-bottom-0">Sent by</th>                                                
                                                <th width="11%" class="border-bottom-0">Sent Date</th>
                                                <th width="17%" class="border-bottom-0 w-20">Action</th>
											</tr>
										</thead>
                                        <tbody>
							<?php

							if($totalRecords > 0) 

							{

							for ($i = 0; $i < $totalRecords; $i++) 

							{

							$srno++;

							$row = &$rows[$i];
							
							



							?>				
							
								<tr   >
									
                                    <td><?php echo $row['pr_id']?></td>
                                    <td><?php echo $row['pr_pres_id']?></td>
									
                                    <td class="align-middle" >
                                    
                                   	<?php echo $row['pr_message']?>
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle">
										
										<?php echo getUserNameByType('pharmacy',$row['pr_pharmacy_id'])?>
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle">
										
												<?php echo fn_GiveMeDateInDisplayFormat($row['pr_date']); ?>
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
                                                		<?php if ($row['pr_status']==0) { ?>
                                                
																<span>
                                                                
                                                                <span class="tag tag-blue">Pending</span> <br />
                                                            
                                                            	<!--<a href="javascript:void()" onclick="fnTakeAction(1,<?php echo $row['pr_id']?>)" title="Accept the request"><span class="feather feather-check text-success icon-style-circle bg-success-transparent"></span></a>
                                                                &nbsp;&nbsp;
                                                                <a href="javascript:void()" onclick="fnTakeAction(2,<?php echo $row['pr_id']?>)" title="Cancel the request"><span class="feather feather-x text-danger icon-style-circle bg-danger-transparent"></span></a>-->
                                                                
                                                                </span>
                                                          
                                                          <?php } else if ($row['pr_status']==1) {?>
                                                          
                                                          <span class="tag tag-green">Approved</span>
                                                          
                                                          
                                                          
                                                          
                                                          
                                                          <?php } else if ($row['pr_status']==2) {?>
                                                          
                                                          <span class="tag tag-red">Rejected</span>
                                                         
                                                          
                                                          <?php } ?>
                                                            
                                                           <!-- <br /><br />
                                                            <a href="#" style="color:#06F">Response Required</a>-->
                                                 <div style="clear:both"> <a style="color:#06F; text-decoration:underline; font-size:12px" href="?c=pres-prescriptions&task=detail&id=<?php echo $row['pr_pres_id']?>&tab=cr" >View Detail</a>        </div>
                                                           
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

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="11"> - No Record found - </th>
	</tr>

	<?php

}



?>				
							
							</tbody>
											</table>

												<?php

												$pagingObject->displayLinks_Front(); 

												?>

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
				<input type="hidden" name="task" value="" />

				<input type="hidden" name="c" value="<?php echo $component?>" />
                
                <input type="hidden" name="Cid" value="<?php echo $_GET['Cid']?>" />

				<input type="hidden" name="hidCheckedBoxes" value="0" />

			</form>
            
<script language="javascript">
	function fnTakeAction(val,id)
	{
		if (val==1)
		{
		ans=confirm ("Are you sure you want to accept the request");
		
		if (ans==true)
		window.location='?c=<?php echo $_GET['c']?>&id='+id+'&task=cancelaction&action=1';
		else
		alert ("No action");
		
		}
		else if (val==2)
		{
			ans=confirm ("Are you sure you want to cancel the request");
			
			if (ans==true)
			window.location='?c=<?php echo $_GET['c']?>&id='+id+'&task=cancelaction&action=0';
			else
			alert ("No action");
			
		}
	}

</script>


             <?php } ?>

	<!-----------End Listing function------------------>

    

    
