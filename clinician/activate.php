<?php include "../private/settings.php";

$sqlCheck="select * from tbl_prescribers where pres_verification_code='".$database->filter($_GET['auth'])."' and pres_email_verify=0 and pres_id='".$database->filter(base64_decode($_GET['e']))."'";

$resCheck=$database->get_results($sqlCheck);
if (count($resCheck)>0)
{

$rowMemberid=$resCheck[0];



$authorize=1;


$update="update tbl_prescribers set pres_email_verify=1 where pres_id='".$rowMemberid['pres_id']."'";
$database->query($update);


}
else
$authorize=0;

include PATH."include/headerhtml.php"
 ?>
  <body style="padding-top:0px;">  
<section class="register_screen">
    <div class="container">
        <div class="logo_box">
        <a href="<?php echo URL?>" class="logo"><img src="<?php echo URL?>images/logo.png"></a>
        </div>
        <div class="register_box">
        
        			 <div align="center">
                     	<h3>Email Verified</h3>
                        <br>
                        <?php if ($authorize==1)
						{ ?>
                     	<p>Your email has been verified successfully. Kindly await further notification via email regarding the approval of your account.</p>
                       
                        <?php } else {?>
                        <p style="color:#F00">Wrong / expired verification link.</p>
                        <?php } ?>
                     </div>
        
        </div>
    </div>
</section>



<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  </body>
</html>

