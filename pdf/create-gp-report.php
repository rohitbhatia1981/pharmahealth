<?php error_reporting(0);
include "../private/settings.php";

/*if ($_SESSION['sess_pharmacy_id']!="")
{

$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."'";
$resPharmacy=$database->get_results($sqlPharmacy);
$rowPharmacy=$resPharmacy[0];

$sql="select * from tbl_prescriptions,tbl_patients where pres_patient_id=patient_id and pres_id='".$database->filter($pid)."' and patient_pharmacy='".$database->filter($_SESSION['sess_pharmacy_id'])."'";


$res=$database->get_results($sql);
$rowPres=$res[0];



}
*/
$genDate=date("d/m/Y");
$sqlEmail2="select * from tbl_emails where email_id=59 and email_status=1";
$resEmail2=$database->get_results($sqlEmail2);

$getConditionId="select pres_condition from tbl_prescriptions where pres_id='".$database->filter($pid)."'";
					$resConditionId=$database->get_results($getConditionId);
					$conditionId=$resConditionId[0]['pres_condition'];
				
					$condition=getConditionNameVar($conditionId);

		$rowEmail2=$resEmail2[0];

			$emailContent2="<p><img src='../../images/letter-head.jpg' style='width:780px'   /></p>
					<p style='font-weight:bold;text-align:right'>
					
						14/2G Docklands Business Centre\n10-16 Tiller Road\nLondon\nE14 8PX\nTel 020 475 5761\n
						Email: admin@promanhelth.co.uk<br>
											 
						
					</p>";
					
					
					

					$emailContent2.="<p style='text-align:left'>".fnUpdateHTML($rowEmail2['email_description'])."<p>";
					$emailContent2=str_replace("<date>","<span style='color:#00F'>".$genDate."</span>",$emailContent2);
					$emailContent2=str_replace("<gp_details>","<font style='font-weight:bold>".$gpDetails."</font>",$emailContent2);
					$emailContent2=str_replace("<patient_name>","<span style=''>".$receiverName."</span>",$emailContent2);
					$emailContent2=str_replace("<dob>","<span style='color:#00F'>".$patient_dob."</span>",$emailContent2);
					$emailContent2=str_replace("<address>","<span style='color:#00F'>".$patient_address."</span>",$emailContent2);
					$emailContent2=str_replace("<condition>","<span style='color:#00F'>".$condition."</span>",$emailContent2);
					$emailContent2=str_replace("<accute/repeat>","<span style='color:#00F'>accute</span>",$emailContent2);
					$emailContent2=str_replace("<format>","<span style='color:#00F'>as a one off/on 6/12 months repeat dispensing batch</span>",$emailContent2);
					$emailContent2=str_replace("<medication_name>","<span style='color:#00F'>".$medicineName."</span>",$emailContent2);
					//$emailContent2=str_replace("<pharmacy_details>","<span style='color:#00F'>".$pharmacy_details."</span>",$emailContent2);
					
					$emailContent2=str_replace("\n","<br>",$emailContent2);
					
					//$emaiContent2.="<br><br><br>Thank you,
					//Pharma Health Team";
					
					$faxBody=$emailContent2;
					
					
					

require_once 'dompdf/autoload.inc.php';



// reference the Dompdf namespace

use Dompdf\Dompdf;



// instantiate and use the dompdf class

$dompdf = new Dompdf();





//echo $faxBody;exit;

$dompdf->loadHtml($faxBody);







//$dompdf->loadHtml('<h1>Welcome to CodexWorld.com</h1>');



// (Optional) Setup the paper size and orientation

$dompdf->setPaper('A4', 'portrait');



// Render the HTML as PDF

$dompdf->render();







// Output the generated PDF to Browser

//$dompdf->stream();



file_put_contents(PATH.'uploads/prescriptions/attachment/'.$fileId, $dompdf->output());


// Your PDF generation code here, using a library like TCPDF, FPDF, or any other of your choice.
// Make sure to save the PDF to a temporary file.

//$pdfFilePath = PATH.'uploads/prescriptions/attachment/'.$fileId.'.pdf'; // Replace with the actual path to your generated PDF.

// Set the HTTP headers to trigger the download.
//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename="PH-'.$rowPres['pres_id'].'.pdf"'); // You can change the filename as needed.



?>