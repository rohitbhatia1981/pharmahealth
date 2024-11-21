 <?php include "../../../../private/settings.php";
 
 $postcode=$database->filter($_GET['code']);
  
 
if ($postcode!="")
{

	$coordinates = getCoordinates($postcode);
	
	if ($coordinates) {
		$latitude=$coordinates['latitude'];
		$longitude=$coordinates['longitude'];
	}
	
	$radius = $_GET['miles']; // Radius in miles
	
	
	$nearbyPostcodes = findNearbyPostcodes($latitude,$longitude, $radius);
	
	if (count($nearbyPostcodes)>0)
	$strPostcodes=implode(", ",$nearbyPostcodes);

if ($strPostcodes=="")
$strPostcodes=$postcode;
}

// Output nearby postcodes


 
if  ($postcode!="" || $_GET['pharmacy']!="")
{
 $sqlData="select * from tbl_pharmacies where pharmacy_status=1 ";
 
 if ($_GET['pharmacy']!="")
 $sqlData.=" and pharmacy_name like '%".$database->filter($_GET['pharmacy'])."%'";
 
 
 
 if ($strPostcodes!="")
 $sqlData.=" and FIND_IN_SET(REPLACE(pharmacy_postcode, ' ', ''), REPLACE('$strPostcodes', ' ', ''))";
 

 //print $sqlData;
 
 $resData=$database->get_results($sqlData);
 
 
  ?>
 <?php if (count($resData)>0) { ?>
 <form method="POST" action="?c=patient-nominated-pharmacy&task=saveedit">
 
 <h4>Select Pharmacy</h4>  
                                    <div class="p-15 mb-6" style="border:1px solid #d7d7d7; padding:40px" >   
										
                                      <?php for ($i=0;$i<count($resData);$i++)
									  {
									  
									  $rowData=$resData[$i];
									  ?>
                                       
                                        <div class="custom-controls-stacked d-md-flex p-2" <?php if ($i+1<count($resData)) { ?> style="border-bottom:1px solid #d7d7d7" <?php } ?>>
										<label class="custom-control custom-radio success mr-4">
											<input type="radio" class="custom-control-input" name="rdPharmacy"  value="<?php echo $rowData['pharmacy_id']; ?>" <?php if ($i==0) echo "checked"; ?>>
											<span class="custom-control-label"><b><?php echo $rowData['pharmacy_name']?></b> <br> <?php echo $rowData['pharmacy_address']?> <?php echo $rowData['pharmacy_postcode']?> <br />
                                            <?php
											
											
											$sqlLat2="select * from tbl_postcodes where postcode='".$database->filter($rowData['pharmacy_postcode'])."'";
											$resLat2=$database->get_results($sqlLat2);
											if (count($resLat2)>0)
											{
												$rowLat2=$resLat2[0];
												
												$latitudeFrom=$coordinates['latitude'];
												$longitudeFrom=$coordinates['longitude'];
												
												$latitudeTo=$rowLat2['latitude'];
												$longitudeTo=$rowLat2['longitude'];
												
												
												if ($latitudeFrom!="" && $longitudeFrom!="" && $latitudeTo!="" && $longitudeTo)
												{ 
												$distance = getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);
												echo "Distance: " . $distance . " miles.";
												}
												
											}
											
											?>
		
                                            
                                            </span>
										</label>
										
									    </div>
                                   <?php } ?>     
                                       
                                        
                                        
                                        
                                        
                                        
                                        

                                    </div>  
                                    <h4>Please give us a reason for change</h4> 
                                     <textarea class="form-control" name="txtReason" placeholder="Please give a reason for requesting a change of pharmacy"></textarea>  
                                    <br>
                                     <button type="submit" class="btn btn-success btn-lg">Submit</button>
            <?php } else { ?>
			
            <div >No Pharmacy Found</div>
            
            <?php } ?>
</form>
<?php } else echo "Please enter postcode or pharmacy name to search"; ?>