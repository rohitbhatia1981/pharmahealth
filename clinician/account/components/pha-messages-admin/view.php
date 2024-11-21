		

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
                            
                              <div class="col-md-12 col-lg-12 col-xl-12" style="text-align:right">
                                        <a  href="?c=<?php echo $_GET['c']?>&task=add&message=send"  class="btn btn-green" >+ Create Ticket</a>
                                        </div>
                           </div>
                           
                           <div style="height:20px"></div>
                            
							<div class="row">
                            
                            
                           
                           					<div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Search with Keyword:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control fc-datepicker" name="txtSearch" value="<?php echo $_GET['txtSearch']?>" placeholder="" type="text">
															</div>
														</div>
													</div>
                                                 
                                                 
                                                 
                           
                           
											
											
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">From:</label>
                                                    
                                                  
                                                    
													<input class="form-control fc-datepicker" name="dtFrom" value="<?php echo $_GET['dtFrom']?>" placeholder="" type="date">
												</div>
											</div>
                                            
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">To:</label>
                                                    
                                                  
                                                    
													<input class="form-control fc-datepicker" name="dtTo" placeholder="" value="<?php echo $_GET['dtTo']?>" type="date">
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
                                        
                                      
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												<th width="4%" class="border-bottom-0">Ticket ID</th>
                                                <th width="42%" class="border-bottom-0">Subject</th>
                                                <th width="14%" class="border-bottom-0">Sent by</th>                                              
                                                <th width="16%" class="border-bottom-0">Last updated</th>
                                                <th width="10%" class="border-bottom-0 w-20">Action</th>
                                                <th width="14%" class="border-bottom-0 w-20">Status</th>
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
							
							if ($row['message_read_status']==0)
							$readStatus="bold";
							else
							$readStatus="normal";
							



							?>			
								<tr  style="font-weight:<?php echo $readStatus; ?>; cursor:pointer" class="trrow"  onclick="window.location='<?php echo URL.PRESCRIBER_ADMIN?>?c=<?php echo $component?>&task=detail&id=<?php echo $row['message_id']?>'">
									
									<td>
                                    <a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['message_id']; ?>"><?php echo $row['message_id'] ?></a>
                                    
                                    </td>
                                    <td class="align-middle" >
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    
									<div class="card-body pb-0 pt-3">
										<div>
											<label><?php echo $row['message_subject']; ?></label>
											
										</div>
									</div>	
												
											
									</td>
                                    
                                    
                                    
                                    
                                    <td><?php echo getUserNameByType('clinician',$row['message_sender_id']); ?></td>
                                    
                                    
                                    <td class="align-middle">
										
												<?php 
												
												
												
												$timestamp = strtotime($row['message_date']);
												echo $formattedDate = date("d M Y", $timestamp);
												echo "<br>";
												echo $formattedTime = date("H:i A", $timestamp);
												
												 ?>
                                                
                                                
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
                                                <?php 
												
												if ($row['message_close']==0)
												{
												
												$waiting=1;
												
												$sqlChild="select * from tbl_tickets where message_parent='".$database->filter($row['message_id'])."' order by message_id desc";
												$resChild=$database->get_results($sqlChild);
												if (count($resChild))
												{
													$rowChild=$resChild[0];
													if ($rowChild['message_sender_type']=="Admin")
													$waiting=0;
												}
												else
												{
													$waiting=1;
												}
												
												?>
                                                
                                                			<?php if ($waiting==1) { ?>
                                                
															<span class="tag tag-grey">Awaiting Response</span>
                                                            <?php } else { ?>
                                                            <span class="tag tag-red">Read Admin Response</span>
                                                            <?php } ?>
                                                          
                                             <?php } else echo "-"; ?>             
                                                           
											</div>
										</div>
									</td>
                                    
                                     <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
                                                			<?php if ($row['message_close']==1) { ?>
															<span class="tag tag-orange">Closed</span>
                                                            <?php } else { ?>
                                                            <span class="tag tag-green">Open</span>
                                                            <?php } ?>
																
															
                                                            
                                                          
                                                          
                                                           
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


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

    <?php function createFormForPagesHtml(&$rows) {

	$row=array();

	global $component, $database;

	$row = &$rows[0];

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Support Ticket</h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>
		</div>
	</div>
</div>
<!--End Page header-->	 

				
<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="card">

				<?php

						if ($_GET['task']=="edit")

						$task="saveedit";

						else

						$task="save";

				?>
   <form name="pages" id="pages" action="?c=<?php echo $component?>&task=save" method="post" class="form-horizontal" enctype="multipart/form-data" />
   
   
   <div class="card" id="contSendMessage_2">
								<div class="card-header border-0">
									<h4 class="card-title">Create Ticket</h4>
								</div>
								<div class="card-body" >
                                
                               
                                   
									
                                  <div>
                                  
									<div>
                                    <div style="height:20px"></div>
                                    <div>
                                    <label class="form-label">Subject *</label>
                                    <input type="text" class="form-control" name="txtSubject" required="required"></div>
                                     <div style="height:20px"></div>
									<div>
                                    <label class="form-label">Message *</label>
                                    <textarea rows="5" class="form-control" cols="50" name="txtMessage" required="required"></textarea></div>
                                    <div style="height:20px"></div>
									<div class="form-group">
										
										<input class="form-control" name="flDoc[]" type="file" accept=".pdf,.jpg,.png">
                                        
                                       	<div id="cont_addmore_1"></div>
                                        <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(1)">+ Add More Attachment</a></div>
                                        
                                        
										</div>
                                    
                                 <button type="submit" class="btn btn-primary">Submit</button>
									
								</div>
                                
								
							</div>
                                 
                                
								
								
								
							
                            </div>
                            
                            
                            </div>
                            
                            <script language="javascript">
							function addMoreFile(val)
							{
								
								str='<div><input style="margin-top:15px" class="form-control" name="flDoc[]" type="file" accept=".pdf,.jpg,.png"></div>';
								$("#cont_addmore_"+val).append(str);
							}
							</script>


             <?php } ?>

     <?php function createFormForPagesHtml_details(&$rows) {

	$row=array();

	global $component, $database;

	$row = &$rows[0];

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Ticket Details</h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>
		</div>
	</div>
</div>
<!--End Page header-->	 

				
<div class="row">
		<div class="col-lg-12 col-md-12">
        
        <div class="main-content">
					<div class="container">

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							
							<div class="col-xl-12 col-md-12 col-lg-12">
                            
                             <?php
										$sqlMessage="select * from tbl_tickets where message_id='".$database->filter($_GET['id'])."' ";
										$resMessage=$database->get_results($sqlMessage);
										$rowMessage=$resMessage[0];	
										?>        
                                                
										<h2>Ticket #<?php echo $rowMessage['message_id']?> - <?php echo $rowMessage['message_subject']?></h2>		
								
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									
											<div class="card-body">
                                            
                                             <?php  if ($rowMessage['message_close']==0) { ?>
												<div class="pt-4 pb-4 text-end" align="right">
													<a  href="javascript:void(0);" onclick="showMessagebox()" class="btn btn-primary">Send Reply</a>
												</div>
                                              <?php } ?>  
                                                
                                                
                                                <div class="card" id="contSendMessage" style="display:none" >
								<div class="card-header border-0">
									<h4 class="card-title">Your Reply</h4>
								</div>
                                
								<div class="card-body " >
                                <!----------form of new message-------->
                                
                                <div class="col-xl-8 col-md-12 col-lg-12">
                                <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=save" method="post" class="form-horizontal" enctype="multipart/form-data">
                                
                                    
                               
                                  
                                   
                                    <textarea rows="5" class="form-control" cols="50" name="txtMessage" placeholder="Please enter the message *"></textarea></div>
                                    <div style="height:20px"></div>
									<div class="form-group">
										<label class="form-label">Upload Document (If any) <span style="color:#999">(file type allowed: pdf,jpg, png)</span></label>
										<div class="form-group">
										
										<input class="form-control" name="flDoc[]" type="file" accept=".pdf,.jpg,.png">
                                        
                                       	<div id="cont_addmore_1"></div>
                                        <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(1)">+ Add More Attachment</a></div>
                                        
                                        
										</div>
									</div>
                                    
                                  <div class="card-footer">
									<button type="submit" class="btn btn-primary">Send</button>
									<a  href="javascript:void(0);" onclick="showMessagebox()" class="btn btn-danger">Cancel</a>
								</div>  
                                <input type="hidden" name="hid" value="<?php echo $_GET['id']?>" />
								</form>	
                                
                                </div>
                                
                                <!----------End form of new message-------->
								</div>
								
							</div>
                          
                                       
                                                
                                                 <?php 
														$sqlMessage="select * from tbl_tickets where (message_parent='".$database->filter($_GET['id'])."' || message_id='".$database->filter($_GET['id'])."') order by message_id desc ";
														$resMessage=$database->get_results($sqlMessage);
														if (count($resMessage)>0)
														{
															
															for ($i=0;$i<count($resMessage);$i++)
															{
																
																$rowMessage=$resMessage[$i];																
																$mysqlDate = $rowMessage['message_date'];
																$timestamp = strtotime($mysqlDate);
																$formattedDate = date("d M Y", $timestamp);
																
																$formattedTime = date("H:i", $timestamp);
																
																//------------update message read---------
																
																changeReadStatus2($rowMessage['message_id']);
																
																//-----------end update read---------
																
																			 if ($rowMessage['message_sender_type']=="Pharmacy")
																				{
																					$replierName="Pharmacy";
																					$colorCss="success";
																				} else if ($rowMessage['message_sender_type']=="Admin")
																				{
																					$replierName="Admin";
																					$colorCss="danger";
																				}
																				else if ($rowMessage['message_sender_type']=="Clinician")
																				{
																					$replierName="You";
																					$colorCss="success";
																				}


														
													?>
                                                    <div class="card shadow-none border">
													<div class="d-sm-flex p-5">
													
                                                    
                                                    
                                                    
                                                    	
														<div class="media-body">
															<h5 class="mt-1 mb-1 font-weight-semibold"><?php //echo $rowMessage['message_subject']?> <span class="badge badge-<?php echo $colorCss;?>-light badge-md ms-2"><?php echo $replierName; ?></span></h5>
															<small class="text-muted"><i class="fa fa-calendar"></i> <?php echo $formattedDate; ?> <i class=" ms-3 fa fa-clock-o"></i> <?php echo $formattedTime; ?></small>
															<p class="fs-15 mb-2 mt-1">
															   <?php echo str_replace("\n","<br>",$rowMessage['message_text']); ?>
															</p>
                                                            
                                                             <!---------Attachment of main message------------>
                                                            
                                                             <?php if ($rowMessage['message_attachment']!="") {
																 
																 $arrUnSerMes=unserialize(fnUpdateHTML($rowMessage['message_attachment']));
																
																  ?>
                                                                    
                                                                    <div class="row">
                                                                    
                                                                    <?php for ($j=0;$j<count($arrUnSerMes);$j++) {
																		
																		
															$fileExtension = pathinfo($arrUnSerMes[$j], PATHINFO_EXTENSION);
															
															// Check if the file extension is PDF
															if (strtolower($fileExtension) === 'pdf') {
																// The file is a PDF
																$type="pdf";
															} elseif (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
																// The file is an image
																$type="image";
															} 
																		
																		 ?>
                                                                        <div class="col-lg-2 col-md-3">
                                                                            <a  href="<?php echo URL?>uploads/support/<?php echo $arrUnSerMes[$j]; ?>" download class="attach-supportfiles">
                                                                                
                                                                                <?php if ($type=="image") { ?>
                                                                                <img src="<?php echo URL?>uploads/support/<?php echo $arrUnSerMes[$j]; ?>" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                                                                                <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                                                                                <?php } else { ?>
                                                                                <img src="<?php echo URL?>images/pdf.png" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                                                                                <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                                                                                <?php } ?>
                                                                                
                                                                            </a>
                                                                        </div>
                                                                      <?php } ?>
												
											</div>
                                            <?php } ?> 
                                            <!-----------end attachment------->
															
                                                            
                                                            <?php
																$sqlSub="select * from tbl_messages where message_parent_reply='".$rowMessage['message_id']."' order by message_id desc";
																$resSub=$database->get_results($sqlSub);
																if (count($resSub)>0)
																{
																	
																	for ($j=0;$j<count($resSub);$j++)
																	{
																		$rowSub=$resSub[$j];
																		
																		//--------Get sender details----
																		
																		//------------update message read---------
																
																		changeReadStatus($rowSub['message_id']);
																	
																		//-----------end update read---------
																		
																		$mysqlDate = $rowSub['message_date'];
																		$timestamp = strtotime($mysqlDate);
																		$formattedDate = date("d M Y", $timestamp);
																
																		$formattedTime = date("H:i", $timestamp);
																		
																		
																			if ($rowSub['message_sender_type']=="Patient")
																				{
																				$sqlSender="select * from tbl_patients where patient_id='".$rowSub['message_sender_id']."'";
																				//else if ($rowMessage['message_sender_type']=="Clinician")
																				//$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['patient_first_name']." ".$rowSender['patient_middle_name']." ".$rowSender['patient_last_name']." (".$rowSub['message_sender_type'].")";
																				$colorCss="primary";
																				}
																				else if ($rowSub['message_sender_type']=="Clinician")
																				{
																					$replierName="Clinicians";
																					$colorCss="danger";
																				}
																		
																		//--- end getting sender details---
															?>
                                                            
															
                                                            
                                                            <?php }
																}?>
                                                                
                                                               
														</div>
                                                        
                                                        
                                                        
                                                        
													</div>
                                                    </div>
                                                    
                                                    
                                                    <?php }
														} else
														
														echo "<p style='font-size:18px; padding:30px'>No reply yet!</p>";
														?>
												
												
											</div>
										
								</div>
							</div>
						</div>
						<!-- End Row-->

					</div><!-- end app-content-->
				</div>
		</div>
</div>
<script language="javascript">

function showMessagebox()
{
	$("#contSendMessage").toggle(500);
}
</script>

             <?php } ?>
  