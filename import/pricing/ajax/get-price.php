<?php include "../../../private/settings.php";

//define ("CONSULTATION_ACTUAL_PAY",5);
//define ("CONSULTATION_COST",5);




// Example usage:






if ($_POST['mid']!="" && $_POST['sid']!="" )
{
	$sqlCategory="select * from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."' and mp_strength='".$database->filter($_POST['sid'])."' and mp_pack_size='".$database->filter($_POST['pid'])."' ";
	$resCategory=$database->get_results($sqlCategory);
	
	$rowCategory=$resCategory[0];
	
	$tierField="mp_tier".$_POST['t']."_price";
	$baseprice=$rowCategory[$tierField];
	$quantity=$_POST['quantity'];
	$medicationCost=$rowCategory['mp_medication_cost'];
	$tier=$_POST['t'];
	$costPrice=$rowCategory['mp_cost_price'];
	$totalCostPrice=$costPrice*$quantity;
	
	
	if ($totalCostPrice>=6.5)
	{
		$medicationCost=$totalCostPrice;
		
		if ($medicationCost>=6.5 && $medicationCost<10)
		$medicationCost=8;
		
		
	$priceTocharge=calculatePrice_plus($quantity,$medicationCost, $tier,$costPrice);
	}
	else
	$priceTocharge=calculatePrice($baseprice, $quantity);
	
	
	if ($_POST['express']==1)
	{
	$expressPrice=10;
	$addPharmaProfit=6;
	$addPharmacyProfit=4;
	}
	else
	{
	$expressPrice=0;
	$addPharmaProfit=0;
	$addPharmacyProfit=0;
	}
	
	
	$profitPharma=CONSULTATION_ACTUAL_PAY+($priceTocharge-$medicationCost-CONSULTATION_COST)*0.3;
	$pharmacyProfit=($priceTocharge-$medicationCost-CONSULTATION_COST)*0.7;
	
	
	
}
$pharmacyGrossProfit=$pharmacyProfit+$totalCostPrice;


 ?>
 <table width="50%">
 	<tr><td width="25%">Cost to charge from patient</td><td><strong>$<?php echo round($priceTocharge,2)+$expressPrice;?></strong></td></tr>
    <tr><td>Profit for Pharma Health</td><td><strong>$<?php echo round($profitPharma,2)+$addPharmaProfit;?></strong></td></tr>
    <tr><td>Profit before excluding Medication cost</td><td><strong>$<?php echo round($pharmacyGrossProfit,2);?></strong></td></tr>
    <tr><td>Net Pharmacy Profit</td><td><strong>$<?php echo round($pharmacyProfit,2)+$addPharmacyProfit;?></strong></td></tr>
    <tr><td>Medication cost</td><td><strong>$<?php echo round($totalCostPrice,2);?></strong></td></tr>
    <tr><td>Medication cost Band</td><td><strong>$<?php echo $rowCategory['mp_medication_cost'];?></strong></td></tr>
    
  </table>
 