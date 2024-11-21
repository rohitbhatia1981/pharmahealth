<?php include "../../../private/settings.php";

if ($_SESSION['sess_pharmacy_id']=="")
{
echo "Kindly login again, your session has been expired";
exit;
}


	
	/*$sql = "SELECT * FROM tbl_properties where property_id='".$database->filter($pid)."' and property_agent_id='".$_SESSION['agentId']."'";
	$loadData = $database->get_results( $sql );
	$rowResult = $loadData[0];*/
	
	$data=URL."patient/set-pharmacy?pid=".$_SESSION['sess_pharmacy_id'];	

?>
<style>

   @media print {
        body {
            margin: 0;
            padding: 0;
            background-color: #03989E !important;
        }
        table {
            background-color: #fff !important;
        }
        td {
            border-radius: 10px !important;
        }
        /* Ensure background color is printed */
        * {
            -webkit-print-color-adjust: exact !important; /* Chrome, Safari */
            color-adjust: exact !important; /* Firefox, Edge */
        }
        img {
            max-width: 100% !important; /* Ensure images are resized for print */
        }
		
		
		
    }
	
	
	
	.button {
		  background-color: #4CAF50; /* Green */
		  border: none;
		  color: white;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 14px;
		}


</style>
<div align="center" id='DivIdToPrint'>



<?php    
   
   
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'qrcode.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';
    //if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        //$errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 10;
   // if (isset($_REQUEST['size']))
       // $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


   
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
       
        
    //display generated file
   // echo '<img src="qrcode/'.$PNG_WEB_DIR.basename($filename).'" />';  
    
	
	
	
  
    // benchmark
  //  QRtools::timeBenchmark();    
?>


<table width="100%" height="400px"  style="background-color:#03989E; border: 50px solid #03989E;">
    <tr>
        <td align="center" style="padding:20px">
            <table width="100%" height="100%" style="background:#fff;border-radius: 10px">
                <tr>
                    <td style="text-align:center" valign="top">
                        <p>&nbsp;</p>
                        <h2 style="font-size:50px; color:#F6C">Scan &amp; Register</h2>
                        
                        <p style="font-size:30px;padding:10px">
                            Scan the QR code to register with our Partner: Pharma Health. Order your common prescription medications without having to wait for your GP!
                        </p>
                        
                        <p><img src="qrcode/<?php echo $PNG_WEB_DIR.basename($filename) ?>" style="height:400px; border:3px solid #F6C" /></p>
                    </td>
                </tr>
                <tr  >
                    <td align="center" style="padding-top:5px">
                        <img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg" style="max-width:400px">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br /><br />
<button type="button" class="button" id="btn" onclick="printDiv()">Print Poster</button>
&nbsp;&nbsp;
<button type="button" class="button" id="btn2" onclick="forceDownload('qrcode/<?php echo $PNG_WEB_DIR.basename($filename)?>','qrcode-<?php echo $rowResult['property_id']?>.png')">Download QR Code</button>


<br /><br />
</div>


<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','QR Code');

  newWin.document.open();
  
  $("#btn").hide();
  $("#btn2").hide();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  $("#btn").show();
   $("#btn2").show();
  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}

function forceDownload(url, fileName){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.responseType = "blob";
    xhr.onload = function(){
        var urlCreator = window.URL || window.webkitURL;
        var imageUrl = urlCreator.createObjectURL(this.response);
        var tag = document.createElement('a');
        tag.href = imageUrl;
        tag.download = fileName;
        document.body.appendChild(tag);
        tag.click();
        document.body.removeChild(tag);
    }
    xhr.send();
}

</script>

    