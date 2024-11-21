<?php //include_once "../../private/settings.php";







function generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading="",$bottomText="")



{







if ($bottomHeading=="")

$bottomHeading="Know more about Smart Agent";





if ($bottomText=="")

$bottomText="Some text about ".SITE_NAME.".";





 $emailBodyTemplate='<style type="text/css">







    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}



    a img { border: none; }



    table { border-collapse: collapse !important;}







    .ReadMsgBody { width: 100%; }



    .ExternalClass { width: 100%; }



    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }



    table td { border-collapse: collapse; }



    .ExternalClass * { line-height: 115%; }



    .container-for-gmail-android { min-width: 600px; }











    * {



      font-family: Helvetica, Arial, sans-serif;



    }







    body {



      -webkit-font-smoothing: antialiased;



      -webkit-text-size-adjust: none;



      width: 100% !important;



      margin: 0 !important;



      height: 100%;



      color: #676767;



    }







    td {



      font-family: Helvetica, Arial, sans-serif;



      font-size: 14px;



      color: #777777;



      text-align: left;



      line-height: 21px;



    }







    a {



      color: #676767;



      text-decoration: none !important;



    }







    .pull-left {



      text-align: left;



    }







    .pull-right {



      text-align: right;



    }







    .header-lg,



    .header-md,



    .header-sm {



      font-size: 32px;



      font-weight: 700;



      line-height: normal;



      padding: 35px 0 0;



      color: #4d4d4d;



    }







    .header-md {



      font-size: 24px;



    }







    .header-sm {



      padding: 5px 0;



      font-size: 18px;



      line-height: 1.3;



    }







    .content-padding {



      padding: 20px 0 30px;



    }







    .mobile-header-padding-right {



      width: 290px;



      text-align: right;



      padding-left: 10px;



    }







    .mobile-header-padding-left {



      width: 290px;



      text-align: left;



      padding-left: 10px;



    }







    .free-text {



      width: 100% !important;



      padding: 10px 0px 0px;



	  text-align:left;



    }







    .block-rounded {



      border-radius: 5px;



      border: 1px solid #e5e5e5;



      vertical-align: top;



    }







    .button {



      padding: 30px 0;



    }







    .info-block {



      padding: 0 20px;



      width: 260px;



    }







    .block-rounded {



      width: 260px;



    }







    .info-img {



      width: 258px;



      border-radius: 5px 5px 0 0;



    }







    .force-width-img {



      width: 480px;



      height: 1px !important;



    }







    .force-width-full {



      width: 600px;



      height: 1px !important;



    }







    .force-width-gmail {



      min-width:600px;



      height: 0px !important;



      line-height: 1px !important;



      font-size: 1px !important;



    }







    .button-width {



      width: 228px;



    }







  </style>







  <style type="text/css" media="screen">



    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);



  </style>







  <style type="text/css" media="screen">



    @media screen {



    



      * {



        font-family: "Oxygen", "Helvetica Neue", "Arial", "sans-serif" !important;



      }



    }



  </style>







  <style type="text/css" media="only screen and (max-width: 480px)">



    /* Mobile styles */



    @media only screen and (max-width: 480px) {







      table[class*="container-for-gmail-android"] {



        min-width: 290px !important;



        width: 100% !important;



      }







      table[class="w320"] {



        width: 320px !important;



      }







      img[class="force-width-gmail"] {



        display: none !important;



        width: 0 !important;



        height: 0 !important;



      }











      a[class="button-width"],



      a[class="button-mobile"] {



        width: 248px !important;



      }







      td[class*="mobile-header-padding-left"] {



        width: 160px !important;



        padding-left: 0 !important;



      }







      td[class*="mobile-header-padding-right"] {



        width: 160px !important;



        padding-right: 0 !important;



      }







      td[class="header-lg"] {



        font-size: 24px !important;



        padding-bottom: 5px !important;



      }







      td[class="header-md"] {



        font-size: 18px !important;



        padding-bottom: 5px !important;



      }







      td[class="content-padding"] {



        padding: 5px 0 30px !important;



      }







       td[class="button"] {



        padding: 5px !important;



      }







      td[class*="free-text"] {



        padding: 10px 18px 30px !important;



      }







      img[class="force-width-img"],



      img[class="force-width-full"] {



        display: none !important;



      }







      td[class="info-block"] {



        display: block !important;



        width: 280px !important;



        padding-bottom: 40px !important;



      }







      td[class="info-img"],



      img[class="info-img"] {



        width: 278px !important;



      }



    }



  </style>



</head>







<table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%">



  <tr>



    <td align="left" valign="top" width="100%" style="background:repeat-x url("'.URL.'images/email/bg_top_02.jpg) #ffffff;">



      <center>



      <img src="'.URL.'images/email/transparent.png" class="force-width-gmail">



        <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background=""'.URL.'images/email/bg_top_02.jpg" style="background-color:transparent">



          <tr>



            <td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">



            <!--[if gte mso 9]>



            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:80px; v-text-anchor:middle;">



              <v:fill type="tile" src="'.URL.'images/email/topbg.jpg" color="#ffffff" />



              <v:textbox inset="0,0,0,0">



            <![endif]-->



              <center>



                <table cellpadding="0" cellspacing="0" width="600" class="w320">



                  <tr>



                    <td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">



                      <a href="'.URL.'"><img  src="'.URL.'images/email/logo.png" alt="logo"></a>



                    </td>



                    <td class="pull-right mobile-header-padding-right" style="color: #4d4d4d;">



                      <a href=""><img width="44" height="47" src="'.URL.'images/email/twitter.gif" alt="twitter" /></a>



                      <a href=""><img width="38" height="47" src="'.URL.'images/email/facebook.gif" alt="facebook" /></a>



                     



                    </td>



                  </tr>



                </table>



              </center>



              <!--[if gte mso 9]>



              </v:textbox>



            </v:rect>



            <![endif]-->



            </td>



          </tr>



        </table>



      </center>



    </td>



  </tr>



  <tr>



    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">



      <center>



        <table cellspacing="0" cellpadding="0" width="600" class="w320">



          <tr>



            <td class="header-lg">



              '.$headingTemplate.'



            </td>



          </tr>



          <tr>



            <td class="free-text">



              '.$headingContent.'



            </td>



          </tr>



           ';



		   if ($buttonTitle != "")       



         	{



			  $emailBodyTemplate.='<tr>



            <td class="button">



              <div><a  href="'.$buttonLink.'"  style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:255px;-webkit-text-size-adjust:none;mso-hide:all;"> '.$buttonTitle.'</a></div>



              



			</tr>';



			}



		  



        $emailBodyTemplate.='</table>



      </center>



    </td>



  </tr>



  <tr>



  <td align="center" valign="top" width="100%" style="background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;">



    <center>



      <table cellpadding="0" cellspacing="0" width="600" class="w320">



        <tr>



          <td class="content-padding">



            <table cellpadding="0" cellspacing="0" width="100%">



              <tr>



                <td class="header-md">



                 '.$bottomHeading.'



                </td>



              </tr>



			    <tr>



             	<td style="padding-top:10px">'.$bottomText.'</td>  



                



              </tr>



            </table>



          </td>



        </tr>



      



      </table>



    </center>



  </td>



  <tr>



    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">



      <center>



        <table cellspacing="0" cellpadding="0" width="600" class="w320">



          <tr>



            <td style="padding: 25px 0 25px; text-align:center">



              <strong>'.SITE_NAME.' Pty ltd</strong><br />



              Australia <br />



            



            </td>



          </tr>



        </table>



      </center>



    </td>



  </tr>



</table>';







return $emailBodyTemplate;







}



/*



$headingTemplate="Thank you for Registering";



$headingContent="You have registered with magicbricks now, you can log into your account and start selling your property";



$buttonTitle="My Account";



$buttonLink="#";











echo generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);



*/



?>







