<?php include "../../private/settings.php"; 
$resPharmacy=array();
if ($_GET['code']!="")
{
	
$postcode=$database->filter($_GET['code']);
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



	
$sqlPharmacy="select pharmacy_id, pharmacy_name, pharmacy_p_landline,pharmacy_o_mobile,pharmacy_address,pharmacy_address2,pharmacy_city,pharmacy_postcode from tbl_pharmacies where 1"; 

$sqlPharmacy.=" and FIND_IN_SET(REPLACE(pharmacy_postcode, ' ', ''), REPLACE('$strPostcodes', ' ', ''))";

$resPharmacy=$database->get_results($sqlPharmacy);
 
}
else if ($_POST['pid']!="")
{
 $sqlPharmacy="select pharmacy_id,pharmacy_name, pharmacy_p_landline,pharmacy_o_mobile,pharmacy_address,pharmacy_address2,pharmacy_city,pharmacy_postcode from tbl_pharmacies where pharmacy_id='".$database->filter($_POST['pid'])."'"; 
 $resPharmacy=$database->get_results($sqlPharmacy);
 
}

?>
<form action="" method="POST">
 <p >
            		<table width="100%" style="color:#393939; background:#e8f5fc; border:1px solid #0C74AE " cellpadding="10" cellspacing="10">
                    	<tr><td colspan="4" ><h5>
                   	  <h6>Please select your pharmacy to view  accurate medicine pricing</h6></h5></td></tr>
                        
                        <tr>
                        <td></td>
                        <td><strong>Name</strong></td><td><strong>Phone</strong></td><td><strong>Address</strong></td></tr>
                        
                        <?php if (count($resPharmacy)>0)
						{
							for ($k=0;$k<count($resPharmacy);$k++)
							{
							$rowPharmacy=$resPharmacy[$k];
						?>	
                        <tr style="font-size:14px">
                        	<td><input type="radio" id="rdPid" name="rdPid" value="<?php echo $rowPharmacy['pharmacy_id']?>" /></td>
                        	<td><?php echo $rowPharmacy['pharmacy_name']?></td>
                        	<td><?php echo $rowPharmacy['pharmacy_o_mobile']?></td>
                            <td>
                            	<?php
								$address=$rowPharmacy['pharmacy_address'];
								if ($rowPharmacy['pharmacy_address2']!="")
								$address.=", ".$rowPharmacy['pharmacy_address2'];
								$address.=",<br>".$rowPharmacy['pharmacy_city'];
								$address.=", ".$rowPharmacy['pharmacy_postcode'];
								
								print $address;
								?>
                            </td>
                        
                    	</tr>
                       <?php } 
					   ?>
                       			<tr><td colspan="4" align="center">
                                	
                                    
                                    <button type="button" id="submitBtn" onclick="submitPharmacy()" style="margin-top:40px;padding:0px 20px !important; min-height:40px; font-size:14px " class="ms-2 btn btn-primary btn-lg d-inline-flex align-items-center">Submit</button>
                                    
                                    </td></tr>
						<?php } else {?>
                        <tr><td colspan="3">No Pharmacy Found!</td></tr>
                        <?php } ?>
                    </table>
                   </p>
            </form>
            
            <script language="javascript">
			function submitPharmacy()
			{
				
   				 if ($('input[name="rdPid"]:checked').length > 0) {
        		 var selectedValue = $('input[name="rdPid"]:checked').val();
				
				$("#submitBtn").attr('disabled','disabled');
				$("#submitBtn").html("Please wait..</div>");
				
					$.ajax({
						url: 'ajax/set-pharmacy-cookie.php', 
						type: 'POST',
						data: { pid: selectedValue},
						success: function(response) {
						
							window.location.reload();	
							
						}
						})
				
				
					
				} else {
					alert("Please select atleast one pharmacy");
				}
			

			}
			
			</script>