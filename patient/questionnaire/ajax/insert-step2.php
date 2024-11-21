<?php include "../../../private/settings.php";

include PATH."patient/checksession.php";
//print_r ($_POST['txtAbtQue']);


$arrayAbout=array();

 $dob=$_POST['cmbDate']."-".$_POST['cmbMonth']."-".$_POST['cmbYear'];

$arrayAbout[base64_encode($_SESSION['questions'][0])]=base64_encode($_POST['rdGender']);

if ($_POST['rdGender']=="Female")
$arrayAbout[base64_encode($_SESSION['questions'][1])]=base64_encode($_POST['rdFemale']);
$arrayAbout[base64_encode($_SESSION['questions'][2])]=base64_encode($dob);
$arrayAbout[base64_encode($_SESSION['questions'][3])]=base64_encode($_POST['rdSmoke']);

if ($_POST['rdSmoke']=="Yes")
$arrayAbout[base64_encode($_SESSION['questions'][4])]=base64_encode($_POST['rdHowmuchSmoke']);

if ($_POST['rdSmoke']=="Ex-Smoker")
$arrayAbout[base64_encode($_SESSION['questions'][5])]=base64_encode($_POST['rdSmoking']);
$arrayAbout[base64_encode($_SESSION['questions'][6])]=base64_encode($_POST['rdDrink']);



$add_date = date('Y-m-d H:i:s');
$sqlCheck="select * from tbl_prescriptions where pres_id='".$database->filter($_SESSION['sess_pres_id'])."'";
$resCheck=$database->get_results($sqlCheck);
if (count($resCheck)==0)
{

include PATH."pdf/create-disclaimer.php";

$names = array(
'pres_patient_id' => $_SESSION['sess_patient_id'],
'pres_pharmacy_id' => $_SESSION['sess_patient_pharmacy'],
'pres_condition' => $_SESSION['sessCondition'],
'pres_stage' => 0,
'pres_about_you' => serialize($arrayAbout),
'pres_disclaimer_file' => $fileId.'.pdf',
'pres_date' => $add_date

);
$add_query = $database->insert( 'tbl_prescriptions', $names );
$_SESSION['sess_pres_id']=$database->lastid();



}
else
{
	
	$update = array(
	'pres_about_you' => serialize($arrayAbout),
	'pres_condition' => $_SESSION['sessCondition'],
	'pres_date' => $add_date
	);
	
	$where_clause = array(
	'pres_id' => $_SESSION['sess_pres_id']

	 );
	
	$database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
	
	
}



echo "1";

 ?>











      



    