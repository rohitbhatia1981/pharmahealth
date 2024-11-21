<?php include "../private/settings.php";

if ($_SESSION['sess_patient_id']!="")
{
unset ($_SESSION['sessCart']);
if (!isset($_SESSION['sessCart']))
$_SESSION['sessCart']=array();

$ctr=count($_SESSION['sessCart']);

//if (!in_array($_POST['hdMedicine'],$_SESSION['sessCart']))
//{
$_SESSION['sessCart'][$ctr]['med_id']=$_SESSION['sessPricing']['medicineId'];
$_SESSION['sessCart'][$ctr]['med_strength']=$_SESSION['sessPricing']['strength'];
$_SESSION['sessCart'][$ctr]['med_pack']=$_SESSION['sessPricing']['packsize'];
$_SESSION['sessCart'][$ctr]['med_qty']=$_SESSION['sessPricing']['quantity'];

$_SESSION['sessCart'][$ctr]['med_price']=$_SESSION['sessPricing']['priceTocharge'];
$_SESSION['sessCart'][$ctr]['pharma_profit']=$_SESSION['sessPricing']['profitPharma'];
$_SESSION['sessCart'][$ctr]['pharmacyNetProfit']=$_SESSION['sessPricing']['pharmacyNetProfit'];
$_SESSION['sessCart'][$ctr]['medicationCost']=$_SESSION['sessPricing']['medicationCost'];

$_SESSION['sessCart'][$ctr]['medication_actual_cost']=$_SESSION['sessPricing']['medication_actual_cost'];

$_SESSION['sessCart'][$ctr]['medicineId']=$_SESSION['sessPricing']['medicineId'];


unset ($_SESSION['sessPricing']);

//}
//print_r ($_SESSION['sessCart']);

print "<script>window.location='".URL."patient/questionnaire/step1'</script>";
}
else
{
	$_SESSION['sessRedirectURL'] = URL."treatments/medicine?m=".$_POST['hdMedicine'];
	print "<script>window.location='".URL."patient/login'</script>";
}

?>