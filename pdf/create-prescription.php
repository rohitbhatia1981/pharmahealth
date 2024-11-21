<?php error_reporting(0);
include "../private/settings.php";

if ($_SESSION['sess_pharmacy_id']!="" || $_SESSION['sess_prescriber_id']!="")
{

$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."'";
$resPharmacy=$database->get_results($sqlPharmacy);
$rowPharmacy=$resPharmacy[0];

$sql="select * from tbl_prescriptions,tbl_patients where pres_patient_id=patient_id and pres_id='".$database->filter(base64_decode($_GET['id']))."' ";

$res=$database->get_results($sql);
$rowPres=$res[0];
}

$presText="<style>
td {
	font-family:Arial, Helvetica, sans-serif;
	font-size:16px;
	color:#333;
}
.blue-text {
	color:#036;
	font-weight:bold;
}
.pink-line {
    border: none; /* Remove the default hr border */
    height: 4px; /* Set the thickness of the line */
    background-color: #F540A8; /* Set the line color */
    margin: 20px 0; /* Add margin to position the line as needed */
}
	
}
</style>";

$presText.='<table width="100%" >
	<tr><td><img src="../images/prescription-header.jpg" style="width:780px"   /></td></tr>';

$dateFromMySQL=$rowPres['patient_dob'];
$formattedDate = date('d/m/y', strtotime($dateFromMySQL));

$presText.='<tr><td>
    <div style="height:50px"></div>
    <img src="../images/prescription-background.jpg" style="position:absolute; z-index:-100; opacity:0.5; max-width:600px; top:400px" />
    	<table width="720px" cellpadding="10" >
        	<tr>
            	<td width="20%">Full Name</td>
            	<td width="25%" class="blue-text" style="border-bottom:1px solid">'.$rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name'].'</td>
           
            	<td width="20%">Date of Birth</td>
            	<td width="25%" class="blue-text" style="border-bottom:1px solid">'.$formattedDate.'</td>
            </tr>
            
            	<tr>
            	<td>Address</td>
            	<td style="border-bottom:1px solid" class="blue-text">'.$rowPres['patient_address1']." ".$rowPres['patient_address2'].", ".$rowPres['patient_city']." <br> ".formatLondonPostcode($rowPres['patient_postcode']) .'</td>
           
            	<td>Date</td>
            	<td style="border-bottom:1px solid" class="blue-text">'.date("d/m/Y",strtotime($rowPres['pres_clincian_update'])).'</td>
            </tr>
        </table>';	
		
		$presText.=' <table width="85%" style="height:100px">
        	<tr><td style="font-weight:bold; font-size:20px">';
			
			$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
				$resMedicine=$database->get_results($sqlMedicine);
						for ($m=0;$m<count($resMedicine);$m++)
								{
									$rowMedicine=$resMedicine[$m];
									$medStr.=$rowMedicine['pm_med']." (<font style='font-size:14px'>Quantity:  ".$rowMedicine['pm_med_qty'].").";
									$medStr.="<br>";						
                                }
			
			$presText.=$medStr.'</td></tr>
        </table>
        
        <table width="720px" >';
		
		$sqlSignature="select pres_signature from tbl_prescribers where pres_id='".$database->filter($rowPres['pres_prescriber'])."'";
		$resSignature=$database->get_results($sqlSignature);
		$rowSignature=$resSignature[0];
		$signature=$rowSignature['pres_signature'];
		
		if ($signature!="")
		{
		$signaturePath=PATH."signature/uploads/".$signature;
		$presText.='<tr><td align="right"><img src="'.$signaturePath.'" style="max-width:180px" /></td></tr>';
		}
		
        
			$presText.='
        	<tr><td align="right">_____________________</td></tr>
            <tr><td align="right">Signature of Prescriber</td></tr>
			<tr><td align="right"><strong>'.getUserNameByType("clinician",$rowPres['pres_prescriber']).'</strong></td></tr>
            <tr><td align="right" style="padding-top:10px"> <strong>Independent Pharmacist Prescriber</strong></td></tr>
        
        </table>';
		
	
	
$presText.='<div style="height:20px"></div>
          <table width="720px" >
        
        	<tr>
            	<td width="20%">Serial Number</td>
            	<td width="25%" class="blue-text" style="border-bottom:1px solid">'.PRES_ID."-".$rowPres['pres_id'].'</td>
           
            	<td width="20%">GPhC Number</td>
            	<td width="25%" class="blue-text" style="border-bottom:1px solid">'.getGhpCRegNo($rowPres['pres_prescriber']).'</td>
            </tr>
           
        
        </table>
        <div style="height:25px"></div>
        <table width="720px">
        <tr><td><hr class="pink-line"></td></tr>
        </table>
        
        <div style="height:20px"></div>
        <table width="720px">
        <tr>
        	<td width=70%>
            	<font style="color:#2B70D4; font-weight:bold">Address</font>
                
                <p>14/2G Docklands Business Centre <br />
                    10-16 Tiller Road London <br />                    
                    E14 8PX

                 </p>
            
            </td>
            <td><font style="color:#2B70D4; font-weight:bold">Contact</font>
            
               <p>admin@pharma-health.co.uk <br />
              clinicians@pharma-health.co.uk
               </p>
            
            </td>
            
           
        </tr>
        </table>
        
        
  </td>
  </tr>
  </table>
  </div>';

require_once 'dompdf/autoload.inc.php';



// reference the Dompdf namespace

use Dompdf\Dompdf;



// instantiate and use the dompdf class

$dompdf = new Dompdf();


$faxBody=$presText;





 




//echo $faxBody;exit;

$dompdf->loadHtml($faxBody);







//$dompdf->loadHtml('<h1>Welcome to CodexWorld.com</h1>');



// (Optional) Setup the paper size and orientation

$dompdf->setPaper('A4', 'portrait');



// Render the HTML as PDF

$dompdf->render();







// Output the generated PDF to Browser

//$dompdf->stream();

$fileId=uniqid();

file_put_contents(PATH.'uploads/prescriptions/'.$fileId.'.pdf', $dompdf->output());


// Your PDF generation code here, using a library like TCPDF, FPDF, or any other of your choice.
// Make sure to save the PDF to a temporary file.

$pdfFilePath = PATH.'uploads/prescriptions/'.$fileId.'.pdf'; // Replace with the actual path to your generated PDF.

// Set the HTTP headers to trigger the download.
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="PH-'.$rowPres['pres_id'].'.pdf"'); // You can change the filename as needed.

// Output the PDF content to the browser.
readfile($pdfFilePath);
unlink ($pdfFilePath);



exit;
?>





?>