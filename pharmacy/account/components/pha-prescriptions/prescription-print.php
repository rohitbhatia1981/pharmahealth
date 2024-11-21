<?php include "../../../../private/settings.php";

if ($_SESSION['sess_pharmacy_id']!="" || $_SESSION['sess_prescriber_id']!="")
{

$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."'";
$resPharmacy=$database->get_results($sqlPharmacy);
$rowPharmacy=$resPharmacy[0];

$sql="select * from tbl_prescriptions,tbl_patients where pres_patient_id=patient_id and pres_id='".$database->filter(base64_decode($_GET['id']))."'";

$res=$database->get_results($sql);
$rowPres=$res[0];




 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prescription Preview</title>
<style>




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

/* Style for the print button */
.print-button {
    background-color: #008CBA; /* Change the background color to your preference */
    color: #fff; /* Text color */
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px; /* Rounded corners */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.print-button:hover {
    background-color: #005F82; /* Change the color on hover */
}

/* Style for the PDF download button */
.pdf-button {
    background-color:#C33; /* Change the background color to your preference */
    color: #fff; /* Text color */
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px; /* Rounded corners */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.pdf-button:hover {
    background-color: #388E3C; /* Change the color on hover */
}


@media print {
    .pink-line {
        -webkit-print-color-adjust: exact; /* For Chrome and Safari */
        color-adjust: exact; /* For Firefox */
    }
	
	
	
	
	
	
	
}


</style>
</head>

<body >

<div align="center" >

<table width="800px" >

<tr id="rowBtn"><td><button type="button" onclick="printPage()" id="printBtn" class="print-button">Print</button> &nbsp;&nbsp; <a href="<?php echo URL?>pdf/create-prescription?id=<?php echo $_GET['id']?>" ><button type="button" id="pdfBtn" class="pdf-button">Download PDF</button></a></td></tr>
	<tr><td><img src="<?php echo URL?>images/prescription-header.jpg" style="max-width:100%" /></td></tr>
    
    
    <tr><td>
    <div style="height:50px"></div>
    <img src="<?php echo URL?>images/prescription-background.jpg" style="position:absolute; z-index:-100; opacity:0.5; max-width:600px; top:400px" />
    	<table width="85%" cellpadding="10" >
        	<tr>
            	<td width="100">Full Name</td>
            	<td width="281" class="blue-text" style="border-bottom:1px solid"><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></td>
           
            	<td width="140">Date of Birth</td>
            	<td width="279" class="blue-text" style="border-bottom:1px solid"><?php 
									
									
									$dateFromMySQL=$rowPres['patient_dob'];
									echo $formattedDate = date('d/m/y', strtotime($dateFromMySQL));

									 ?></td>
            </tr>
            
            	<tr>
            	<td>Address</td>
            	<td style="border-bottom:1px solid" class="blue-text"><?php echo $rowPres['patient_address1']." ".$rowPres['patient_address2'].", <br>".$rowPres['patient_city']." <br> ".formatLondonPostcode($rowPres['patient_postcode']) ?></td>
           
            	<td>Date</td>
            	<td style="border-bottom:1px solid" class="blue-text"><?php echo  date("d/m/Y",strtotime($rowPres['pres_clincian_update'])); ?></td>
            </tr>
        </table>
        
        <table width="85%" style="height:200px">
        	<tr><td style="font-weight:bold; font-size:20px">
            
            <?php 
				$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
				$resMedicine=$database->get_results($sqlMedicine);
						for ($m=0;$m<count($resMedicine);$m++)
								{
									$rowMedicine=$resMedicine[$m];
									echo $rowMedicine['pm_med']." (<font style='font-size:14px'>Quantity: ".$rowMedicine['pm_med_qty'].'</font>)';
									echo "<br>";						
                                } ?>
            
            </td></tr>
        </table>
        
        <table width="85%" >
        	<?php
			$sqlSignature="select pres_signature from tbl_prescribers where pres_id='".$database->filter($_SESSION['sess_prescriber_id'])."'";
			$resSignature=$database->get_results($sqlSignature);
			$rowSignature=$resSignature[0];
			$signature=$rowSignature['pres_signature']; 
				if ($signature!="")
					{
			?>
            <tr><td align="right"><img src="<?php echo URL?>signature/uploads/<?php echo $signature; ?>" style="max-width:350px" /></td></tr>
            <?php } ?>
        	<tr><td align="right">_____________________</td></tr>
            <tr><td align="right">Signature of Prescriber</td></tr>
            
            <tr><td align="right"><strong><?php echo getUserNameByType("clinician",$rowPres['pres_prescriber']);?></strong></td></tr>
            
            <tr><td align="right" style="padding-top:10px">
            
           
            
           <strong>Independent Pharmacist Prescriber </strong></td></tr>
        
        </table>
        
        <div style="height:40px"></div>
          <table width="85%" >
        
        	<tr>
            	<td width="127">Serial Number</td>
            	<td width="233" class="blue-text" style="border-bottom:1px solid"><?php echo PRES_ID."-".$rowPres['pres_id']; ?></td>
           
            	<td width="127">GPhC Number</td>
            	<td width="168" class="blue-text" style="border-bottom:1px solid"><?php echo getGhpCRegNo($rowPres['pres_prescriber']); ?></td>
            </tr>
           
        
        </table>
        <div style="height:25px"></div>
        <table width="85%">
        <tr><td><hr class="pink-line"></td></tr>
        </table>
        
        <div style="height:20px"></div>
        <table width="85%">
        <tr>
        	<td>
            	<font style="color:#2B70D4; font-weight:bold">Address</font>
                
                <p>14/2G Docklands Business Centre <br />
                    10-16 Tiller Road London<br />
                    E14 8PX

                </p>
            
            </td>
            <td><font style="color:#2B70D4; font-weight:bold">Contact</font>
            
               <p> admin@pharma-health.co.uk <br />
              clinicians@pharma-health.co.uk
               </p>
            
            </td>
            
           
        </tr>
        </table>
        
        
  </td>
  </tr>
  </table>
  </div>

</body>
</html>



<script language="javascript">
function printPage()
{
	document.getElementById("rowBtn").style.display = "none";
	
	window.print();
	
	document.getElementById("rowBtn").style.display = "block";
}
</script>
<?php } ?>
