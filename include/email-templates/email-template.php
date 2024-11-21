<?php //include_once "../../private/settings.php";


function generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading="",$bottomText="")
{
if ($buttonTitle=="")

$buttonTitle="Contact us";



if ($buttonLink=="")

$buttonLink=URL."pages/contact";



$siteurl=URL;



$logoURL=$siteurl."images/logo.png";

$fbImage=$siteurl."images/facebook.png";

$fbURL="https://www.facebook.com";

$twitterImage=$siteurl."images/twitter.png";

$twitterURL="https://twitter.com/";



$emailBody = <<<EMAILBODY



    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>

      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

      <title>[SUBJECT]</title>

      <style type="text/css">

      body {

       padding-top: 0 !important;

       padding-bottom: 0 !important;

       padding-top: 0 !important;

       padding-bottom: 0 !important;

       margin:0 !important;

       width: 100% !important;

       -webkit-text-size-adjust: 100% !important;

       -ms-text-size-adjust: 100% !important;

       -webkit-font-smoothing: antialiased !important;

     }

     .tableContent img {

       border: 0 !important;

       display: block !important;

       outline: none !important;

     }

     a{

      color:#382F2E;

    }



    p, h1{

      color:#000;

      margin:0;

    }

    p{

      text-align:left;

      color:#000;

      font-size:14px;

      font-weight:normal;

      line-height:19px;

    }



    a.link1{

      color:#382F2E;

    }

    a.link2{

      font-size:16px;

      text-decoration:none;

      color:#ffffff;

    }



    h2{

      text-align:left;

       color:#222222; 

       font-size:19px;

      font-weight:normal;

    }

    div,p,ul,h1{

      margin:0;

    }



    .bgBody{

      background: #ffffff;

    }

    .bgItem{

      background: #ffffff;

    }

	

@media only screen and (max-width:480px)

		

{

		

table[class="MainContainer"], td[class="cell"] 

	{

		width: 100% !important;

		height:auto !important; 

	}

td[class="specbundle"] 

	{

		width:100% !important;

		float:left !important;

		font-size:13px !important;

		line-height:17px !important;

		display:block !important;

		padding-bottom:15px !important;

	}

		

td[class="spechide"] 

	{

		display:none !important;

	}

	    img[class="banner"] 

	{

	          width: 100% !important;

	          height: auto !important;

	}

		td[class="left_pad"] 

	{

			padding-left:15px !important;

			padding-right:15px !important;

	}

		 

}

	

@media only screen and (max-width:540px) 



{

		

table[class="MainContainer"], td[class="cell"] 

	{

		width: 100% !important;

		height:auto !important; 

	}

td[class="specbundle"] 

	{

		width:100% !important;

		float:left !important;

		font-size:13px !important;

		line-height:17px !important;

		display:block !important;

		padding-bottom:15px !important;

	}

		

td[class="spechide"] 

	{

		display:none !important;

	}

	    img[class="banner"] 

	{

	          width: 100% !important;

	          height: auto !important;

	}

	.font {

		font-size:18px !important;

		line-height:22px !important;

		

		}

		.font1 {

		font-size:18px !important;

		line-height:22px !important;

		

		}

}



    </style>







  </head>

  <body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">

    <table bgcolor="#ffffff" width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent" align="center"  style='font-family:Helvetica, Arial,serif;'>

  <tbody>

    <tr>

      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" class="MainContainer">

 

  <tbody>

    <tr>

      <td valign="top" width="40">&nbsp;</td>

      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

  

    <tr>

    	<td height='75' class="spechide">

			 <a href="$siteurl"><img  src="$logoURL" alt="" style="max-width:150px"></a>

		</td>

        



    </tr>

    <tr>

      <td class='movableContentContainer ' valign='top'>

      	<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">

        	<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

    
    <tr>

      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

  

  </tbody>

</table>

</td>

    </tr>

  </tbody>

</table>

        </div>

        <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">

        	

        </div>

        <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">

        	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">

                          <tr><td height='55'></td></tr>

                          <tr>

                            <td align='left'>

                              <div class="contentEditableContainer contentTextEditable">

                                <div class="contentEditable" align='center'>

                                  <h2 style='font-family:Helvetica, Arial,serif; font-size:18px'>$headingTemplate</h2>

                                </div>

                              </div>

                            </td>

                          </tr>



                          <tr><td height='15'> </td></tr>



                          <tr>

                            <td align='left'>

                              <div class="contentEditableContainer contentTextEditable">

                                <div class="contentEditable" align='center'>

                                  <p style='color:#000; font-family:Helvetica, Arial,serif'>

                                   $headingContent

                                  

                                  </p>

                                </div>

                              </div>

                            </td>

                          </tr>



                          <tr><td height='55'></td></tr>



							

                          

                         

						 

						   <tr>

                            <td align='left'>

                              <div class="contentEditableContainer contentTextEditable">

                                <div class="contentEditable" align='left'>

                                  <p style='color:#000; font-family:Helvetica, Arial,serif'>

                                  

                                    Thank you,

                                    <br>

                                    <span style='color:#222222;'>Pharma Health Team</span>

                                  </p>

                                </div>

                              </div>

                            </td>

                          </tr>



                        </table>

        </div>

        <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">

        	<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>
	<tr><td height="20px"></td></tr>
    <tr>

      <td style='text-align:left;color:#999;font-size:12px;font-weight:normal;line-height:20px;'><br><br>You are receiving this email because you are registered on pharma-health.co.uk. For any questions or comments please contact us at support@pharma-health.co.uk.<br><br></td>

    </tr>

    <tr>

      <td  style='border-bottom:1px solid #DDDDDD;'></td>

    </tr>

    <tr><td height='25'></td></tr>

    <tr>

      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

    <tr>

      <td valign="top" class="specbundle"><div class="contentEditableContainer contentTextEditable">

                                      <div class="contentEditable" align='center'>

                                        <p  style='text-align:left;color:#999;font-size:12px;font-weight:normal;line-height:20px;'>

                                          <span style='font-weight:bold;'>Copyright &copy; 2023 pharma-health.co.uk. All Rights Reserved.</span>

                                         

                                         

                                        </p>

                                      </div>

                                    </div></td>

      <td valign="top" width="30" class="specbundle">&nbsp;</td>

      <td valign="top" class="specbundle"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

    

  </tbody>

</table>

</td>

    </tr>

  </tbody>

</table>

</td>

    </tr>

    <tr><td height='88'></td></tr>

  </tbody>

</table>



        </div>

        



      

      </td>

    </tr>

  </tbody>

</table>

</td>

      <td valign="top" width="40">&nbsp;</td>

    </tr>

  </tbody>

</table>

</td>

    </tr>

  </tbody>

</table>

</td>

    </tr>

  </tbody>

</table>





    

      </body>

      </html>





EMAILBODY;







return $emailBody;







}


function generateEmailBody2($headingContent,$preHead)
{
	
$siteurl=URL;
$logoURL=$siteurl."images/logo-email.png";
	
$emailBody = <<<EMAILBODY



   <!doctype html>
<html>
  <head>
    
    <style>
@media only screen and (max-width: 620px) {
  table.body h1 {
    font-size: 28px !important;
    margin-bottom: 10px !important;
  }

  table.body p,
table.body ul,
table.body ol,
table.body td,
table.body span,
table.body a {
    font-size: 16px !important;
  }

  table.body .wrapper,
table.body .article {
    padding: 10px !important;
  }

  table.body .content {
    padding: 0 !important;
  }

  table.body .container {
    padding: 0 !important;
    width: 100% !important;
  }

  table.body .main {
    border-left-width: 0 !important;
    border-radius: 0 !important;
    border-right-width: 0 !important;
  }

  table.body .btn table {
    width: 100% !important;
  }

  table.body .btn a {
    width: 100% !important;
  }

  table.body .img-responsive {
    height: auto !important;
    max-width: 100% !important;
    width: auto !important;
  }
}
@media all {
  .ExternalClass {
    width: 100%;
  }

  .ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
    line-height: 100%;
  }

  .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important;
  }

  #MessageViewBody a {
    color: inherit;
    text-decoration: none;
    font-size: inherit;
    font-family: inherit;
    font-weight: inherit;
    line-height: inherit;
  }

  .btn-primary table td:hover {
    background-color: #34495e !important;
  }

  .btn-primary a:hover {
    background-color: #34495e !important;
    border-color: #34495e !important;
  }
}
</style>
  </head>
  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">$preHead</span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
          <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">
			 
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                        
                        
						$headingContent
                        <br><br>
						Kind Regards <br>
						Pharma Health <br>
						<img src="$logoURL" style="max-width:100px">
						
                        
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Copyright &copy; 2023 pharma-health.co.uk. All Rights Reserved</span>
                    
                  </td>
                </tr>
                
              </table>
            </div>
            <!-- END FOOTER -->

          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>






EMAILBODY;


return $emailBody;
	
}


function generateEmailBody3($headingContent,$preHead)
{
	
$siteurl=URL;
$logoURL=$siteurl."images/logo-email.png";
	
$emailBody = <<<EMAILBODY



   <!doctype html>
<html>
  <head>
    
    <style>
@media only screen and (max-width: 620px) {
  table.body h1 {
    font-size: 28px !important;
    margin-bottom: 10px !important;
  }

  table.body p,
table.body ul,
table.body ol,
table.body td,
table.body span,
table.body a {
    font-size: 16px !important;
  }

  table.body .wrapper,
table.body .article {
    padding: 10px !important;
  }

  table.body .content {
    padding: 0 !important;
  }

  table.body .container {
    padding: 0 !important;
    width: 100% !important;
  }

  table.body .main {
    border-left-width: 0 !important;
    border-radius: 0 !important;
    border-right-width: 0 !important;
  }

  table.body .btn table {
    width: 100% !important;
  }

  table.body .btn a {
    width: 100% !important;
  }

  table.body .img-responsive {
    height: auto !important;
    max-width: 100% !important;
    width: auto !important;
  }
}
@media all {
  .ExternalClass {
    width: 100%;
  }

  .ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
    line-height: 100%;
  }

  .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important;
  }

  #MessageViewBody a {
    color: inherit;
    text-decoration: none;
    font-size: inherit;
    font-family: inherit;
    font-weight: inherit;
    line-height: inherit;
  }

  .btn-primary table td:hover {
    background-color: #34495e !important;
  }

  .btn-primary a:hover {
    background-color: #34495e !important;
    border-color: #34495e !important;
  }
}
</style>
  </head>
  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">$preHead</span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
          <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                        
                        
						$headingContent
                        <br><br>
						Kind Regards <br>
						Pharma Health <br>
						

						<img src="$logoURL" style="max-width:100px">
						
                        
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Copyright &copy; 2023 Pharma-health.co.uk All Rights Reserved</span>
                    
                  </td>
                </tr>
                
              </table>
            </div>
            <!-- END FOOTER -->

          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>






EMAILBODY;


return $emailBody;
	
}











/*$headingTemplate="Thank you for Registering";







$headingContent="You have registered with magicbricks now, you can log into your account and start selling your property";







$buttonTitle="My Account";







$buttonLink="#";























echo generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);



*/


















?>















