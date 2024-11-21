<?php 
// include autoloader


require_once 'dompdf/autoload.inc.php';



// reference the Dompdf namespace

use Dompdf\Dompdf;



// instantiate and use the dompdf class

$dompdf = new Dompdf();

if ($totalOffer>0)
{
$faxBody='<style>
body {
	font-family: "Source Sans Pro", sans-serif;
	font-size: 13px;
}
</style>



<p>&nbsp;</p>
<table width="90%" >
<tr><td align="left"><img  src="'.PATH.'images/logo@2x.png" style="max-width:150px" alt="Digioffer"></td>
<td align="right"><img  src="'.$agentLogo.'" style="max-width:150px" alt=""></td>
</tr>
</table>
<p>&nbsp;</p>
<h2 style="font-size:30px" align="center">OFI Visitors</h2>
<p>&nbsp;</p>
<h5 style="font-size:17px" align="left">Property Address: <font style="color:#0000FF">'.$propertyAddress.'</font></h5>



<table width="100%" border="1" cellspacing="5" cellpadding="5" style="border-collapse:collapse">
  <tr style="background-color:#F1F3FB">
    <td style="font-size:17px"><strong>S.No.</strong></td>
 	<td style="font-size:17px"><strong>Full Name</strong></td>';
	if ($phoneRep==1)
	$faxBody.='<td style="font-size:17px"><strong>Mobile</strong></td>';
	
	
	if ($emailRep==1)
	$faxBody.='<td style="font-size:17px"><strong>E-mail</strong></td>';
	
	$faxBody.='<td style="font-size:17px"><strong>Notes</strong></td>
	<td style="font-size:17px"><strong>Date</strong></td>
  </tr>
 '; 
$sno=1;
for ($p=0;$p<$totalOffer;$p++)
{ 
$rowOffer=$resultOffer[$p];
 
 $faxBody.=' <tr style="font-size:16px"> 
 	<td>'.$sno.'</td> 	
	<td>'.$rowOffer['ofi_name'].'</td>';
	
	if ($phoneRep==1)
	$faxBody.='<td>'.$rowOffer['ofi_mobile'].'</td>';
	if ($emailRep==1)
	$faxBody.='<td>'.$rowOffer['ofi_email'].'</td>';
	$faxBody.='<td>'.$rowOffer['ofi_notes'].'</td>  
	<td>'.$rowOffer['ofiDate'].'</td>
  </tr>';
  $sno=$sno+1;
}
 

 $faxBody.='</table>


<p>&nbsp;</p>


<p>&nbsp;</p>
<p>Generated on: '.date("m-d-Y h:i:s a").'</p>';

//echo $faxBody;exit;

$dompdf->loadHtml($faxBody);







//$dompdf->loadHtml('<h1>Welcome to CodexWorld.com</h1>');



// (Optional) Setup the paper size and orientation

$dompdf->setPaper('A4', 'portrait');



// Render the HTML as PDF

$dompdf->render();







// Output the generated PDF to Browser

//$dompdf->stream();



file_put_contents(PATH.'agents/ofr/'.$fileId.'.pdf', $dompdf->output());

}

?>