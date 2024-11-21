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



	
$sqlPharmacy="select pharmacy_name, pharmacy_p_landline,pharmacy_o_mobile,pharmacy_address,pharmacy_address2,pharmacy_city,pharmacy_postcode from tbl_pharmacies where 1"; 

$sqlPharmacy.=" and FIND_IN_SET(REPLACE(pharmacy_postcode, ' ', ''), REPLACE('$strPostcodes', ' ', ''))";

$resPharmacy=$database->get_results($sqlPharmacy);
 
}
else if ($_POST['pid']!="")
{
 $sqlPharmacy="select pharmacy_name, pharmacy_p_landline,pharmacy_o_mobile,pharmacy_address,pharmacy_address2,pharmacy_city,pharmacy_postcode from tbl_pharmacies where pharmacy_id='".$database->filter($_POST['pid'])."'"; 
 $resPharmacy=$database->get_results($sqlPharmacy);
 
}

?>

 <p >
            		<table width="100%" style="color:#393939; " cellpadding="10" cellspacing="10">
                    	<tr><td colspan="3" ><h5>Pharmacy Contact Details</h5></td></tr>
                        
                        <tr><td><strong>Name</strong></td><td><strong>Phone</strong></td><td><strong>Address</strong></td></tr>
                        
                        <?php if (count($resPharmacy)>0)
						{
							for ($k=0;$k<count($resPharmacy);$k++)
							{
							$rowPharmacy=$resPharmacy[$k];
						?>	
                        <tr style="font-size:14px">
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
						} else {?>
                        <tr><td colspan="3">No Pharmacy Found!</td></tr>
                        <?php } ?>
                    </table>
                   </p>