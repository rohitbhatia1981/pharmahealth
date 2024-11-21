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
	
	$tierField="mp_tier".$tier."_price";
	
	$baseprice=$rowCategory[$tierField];
	$quantity=$_POST['quantity'];
	$medicationCost=$rowCategory['mp_medication_cost'];
	$tier=$_POST['t'];
	$costPrice=$rowCategory['mp_cost_price'];
	$totalCostPrice=$costPrice*$quantity;
	
	
	if ($totalCostPrice>=6.5)
	{
		$medicationCost=$totalCostPrice;
		
		//if ($medicationCost>=6.5 && $medicationCost<10)
		//$medicationCost=8;
		
		$priceTocharge=calculatePrice_plus($quantity,$medicationCost, $tier,$costPrice);
	}
	else
	$priceTocharge=calculatePrice($baseprice, $quantity);
	
	
	
	
	
	$profitPharma=CONSULTATION_ACTUAL_PAY+($priceTocharge-$medicationCost-CONSULTATION_COST)*0.3;
	$pharmacyProfit=($priceTocharge-$medicationCost-CONSULTATION_COST)*0.7;
	
	
	
}
$pharmacyGrossProfit=$pharmacyProfit+$totalCostPrice;

$ctr=0;

$_SESSION['sessCart'][$ctr]['med_id']=$_POST['mid'];
$_SESSION['sessCart'][$ctr]['med_strength']=$rowCategory['mp_strength']." ".$rowCategory['mp_unit'];
$_SESSION['sessCart'][$ctr]['med_pack']=$_POST['pid'];
$_SESSION['sessCart'][$ctr]['med_qty']=$_POST['quantity'];

$_SESSION['sessCart'][$ctr]['med_price']=round($priceTocharge,2);
$_SESSION['sessCart'][$ctr]['pharma_profit']==round($profitPharma,2);
$_SESSION['sessCart'][$ctr]['pharmacyNetProfit']=round($pharmacyProfit,2);
$_SESSION['sessCart'][$ctr]['medicationCost']=round($totalCostPrice,2);

$_SESSION['sessCart'][$ctr]['medication_actual_cost']=$medicationCost;

$_SESSION['sessCart'][$ctr]['medicineId']=$_POST['mid'];






 ?>

 