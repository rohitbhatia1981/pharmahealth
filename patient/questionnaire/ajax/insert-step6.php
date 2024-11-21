<?php include "../../../private/settings.php";

include PATH."patient/checksession.php";

$sqlCheck="select * from tbl_patient_gps where pg_patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
$resCheck=$database->get_results($sqlCheck);
if (count($resCheck)==0)
{

$names = array(
'pg_patient_id' => $_SESSION['sess_patient_id'],
'pg_option' => $_POST['ckGP']);

if ($_POST['ckGP']==1)
{
$names2 = array(
'pg_gp' => $_POST['txtGP']);

$names=array_merge($names,$names2);

}





if ($_POST['ckGP']==2)
{
$names2 = array(
'pg_gp_name' => $_POST['txtGP_request'],
'pg_gp_address' => $_POST['txtAddress'],
'pg_gp_email' => $_POST['txtEmail'],
'pg_gp_phone' => $_POST['txtPhone']

);
$names=array_merge($names,$names2);
}


$add_query = $database->insert( 'tbl_patient_gps', $names );



}
else
{

	
$names = array(
'pg_patient_id' => $_SESSION['sess_patient_id'],
'pg_option' => $_POST['ckGP']);

if ($_POST['ckGP']==1)
{
$names2 = array(
'pg_gp' => $_POST['txtGP']);

$names=array_merge($names,$names2);

}
if ($_POST['ckGP']==2)
{
$names2 = array(
'pg_gp_name' => $_POST['txtGP_request'],
'pg_gp_address' => $_POST['txtAddress'],
'pg_gp_email' => $_POST['txtEmail'],
'pg_gp_phone' => $_POST['txtPhone']

);
$names=array_merge($names,$names2);
}
	
	$where_clause = array(
	'pg_patient_id' => $_SESSION['sess_patient_id']

	 );
	
	$database->update( 'tbl_patient_gps', $names, $where_clause, 1 );
	
}

include PATH."pdf/create-agreement.php";

$update = array(
	'pres_agreement_file' => $fileId.'.pdf',
	'pres_overall_risk' => $_SESSION['sessOverallRisk'],
	'pres_incomplete_active' => 1,
	'pres_gp_option' => $_POST['ckGP']
	);
	
	$where_clause = array(
	'pres_id' => $_SESSION['sess_pres_id']

	 );
	 $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );


echo "1";

 ?>











      



    