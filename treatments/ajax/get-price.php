<?php include "../../private/settings.php";

// Example usage:

if ($_POST['mid']!="" && $_POST['sid']!="" )
{
	$sqlCategory="select * from tbl_medication_pricing where mp_medicine='".$database->filter($_POST['mid'])."' and mp_strength='".$database->filter($_POST['sid'])."' and mp_pack_size='".$database->filter($_POST['pid'])."' ";
	$resCategory=$database->get_results($sqlCategory);
	$rowCategory=$resCategory[0];
	
	
	
	$prefix="";
	if ($_SESSION['sess_tier']=="")
	{
	$prefix="From ";
	$tier=1;
	}
	else
	$tier=$_SESSION['sess_tier'];
	
	//$tierField="mp_tier".$tier."_price";
	
	//$baseprice=$rowCategory[$tierField];
	
	
	//$sqlORide="select * from tbl_medication_price_override where po_medicine_id='".$database->filter($_POST['mid'])."'";
	//$resORide=$database->get_results($sqlORide);
	
	if ($rowCategory['mp_override_active']==0)
	{	
	
	if ($tier==1)
	$baseprice = 20; 
	else if ($tier==2)
	$baseprice = 24; 
	if ($tier==3)
	$baseprice = 28; 
	
	
	
	$quantity=$_POST['quantity'];
	$medicationCost=$rowCategory['mp_medication_cost'];
	$tier=$_POST['t'];
	$costPrice=$rowCategory['mp_cost_price'];
	$totalCostPrice=$costPrice*$quantity;
	
	$treatment_length=$rowCategory['mp_length_treatment'];
	$arrTreatment=array();
	$arrTreatment=explode("\n",$treatment_length);
	$arrIndex=$quantity-1;
	$strTreatment=$arrTreatment[$arrIndex];
	
	if ($strTreatment!="")
	$strTreatment='<i class="fa-regular fa-clock" style="color:#f63aa9; font-weight:bold"></i> '.$strTreatment;
	
	
	if ($totalCostPrice>=6.5)
	{
		$medicationCost=$totalCostPrice;
		
		//if ($medicationCost>=6.5 && $medicationCost<10)
		//$medicationCost=8;
		
		$priceTocharge=calculatePrice_plus($quantity,$medicationCost, $tier,$costPrice);
	}
	else
	$priceTocharge=calculatePrice($baseprice, $quantity);
	}
	else
	{
		$medicationCost=$rowCategory['mp_medication_cost'];
		$tier=$_POST['t'];
		$costPrice=$rowCategory['mp_cost_price'];
		$quantity=$_POST['quantity'];
		
		if ($rowCategory['mp_override_price']!="")
		{
			
			$arrOR_price=unserialize(fnUpdateHTML($rowCategory['mp_override_price']));
			
			
			$priceTocharge=$arrOR_price[$quantity-1];
			if ($tier>1)
			$priceTocharge=calculatePriceOveride($priceTocharge,$tier);
			
		}
		else
		$priceTocharge=0;
		
		
	}
	
	
	
	
	$profitPharma=CONSULTATION_ACTUAL_PAY+($priceTocharge-$medicationCost-CONSULTATION_COST)*0.3;
	$pharmacyProfit=($priceTocharge-$medicationCost-CONSULTATION_COST)*0.7;
	
	
	
}
$pharmacyGrossProfit=$pharmacyProfit+$totalCostPrice;
echo $prefix.CURRENCY.$priceTocharge."~".$strTreatment;

unset ($_SESSION['sessPricing']);
$_SESSION['sessPricing']=array();

$_SESSION['sessPricing']['medicineId']=$_POST['mid'];
$_SESSION['sessPricing']['strength']=$rowCategory['mp_strength']." ".$rowCategory['mp_unit'];
$_SESSION['sessPricing']['packsize']=$_POST['pid'];
$_SESSION['sessPricing']['quantity']=$_POST['quantity'];

$_SESSION['sessPricing']['priceTocharge']=round($priceTocharge,2);
$_SESSION['sessPricing']['profitPharma']=round($profitPharma,2);
$_SESSION['sessPricing']['pharmacyNetProfit']=round($pharmacyProfit,2);

$_SESSION['sessPricing']['medication_actual_cost']=$medicationCost;

$_SESSION['sessPricing']['medicationCost']=round($totalCostPrice,2);
$_SESSION['sessPricing']['pharmaProfit']=$profitPharma;
$_SESSION['sessPricing']['pharmacyProfit']=$pharmacyProfit;

$_SESSION['sessPricing']['medicineId']=$_POST['mid'];


 ?>
 <!--<table width="50%">
 	<tr><td width="25%">Cost to charge from patient</td><td><strong>$<?php echo round($priceTocharge,2);?></strong></td></tr>
    <tr><td>Profit for Pharma Health</td><td><strong>$<?php echo round($profitPharma,2);?></strong></td></tr>
    <tr><td>Profit before excluding Medication cost</td><td><strong>$<?php echo round($pharmacyGrossProfit,2);?></strong></td></tr>
    <tr><td>Medication cost</td><td><strong>$<?php echo round($totalCostPrice,2);?></strong></td></tr>
    <tr><td>Net Pharmacy Profit</td><td><strong>$<?php echo round($pharmacyProfit,2);?></strong></td></tr>
  </table>-->
 