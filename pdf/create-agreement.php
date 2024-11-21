<?php 
// include autoloader
error_reporting(0);

require_once 'dompdf/autoload.inc.php';



// reference the Dompdf namespace

use Dompdf\Dompdf;



// instantiate and use the dompdf class

$dompdf = new Dompdf();


$faxBody='<style>
body {
	font-family: "Source Sans Pro", sans-serif;
	font-size: 16px;
}
</style>



<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="90%" >
<tr><td align="left"><img  src="'.PATH.'images/pharma-logo-admin.png" style="max-width:250px" alt="Pharma Health"></td>

</tr>
<tr><td><h3>Agreement</h3></td></tr>
<tr><td>'.$_SESSION['sessAgreement'].'</p></td></tr>
</table>'.'<p>Generated on: '.date("m-d-Y h:i:s a").'</p>';;





 




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

file_put_contents(PATH.'uploads/patients/agreement/'.$fileId.'.pdf', $dompdf->output());





?>