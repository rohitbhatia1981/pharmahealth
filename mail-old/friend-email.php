<?php 
include "../private/settings.php";
include "sendmail.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Portman Image</title>
<link href="popupstyle.css" rel="stylesheet" type="text/css" />
<style>
.title-heading {
    background: #035186 none repeat scroll 0 0;
    color: #fff;
    float: left;
    margin: 0;
    padding: 10px 0;
    text-align: center;
    width: 100%;
}
.input-text {
   border: 1px solid #8e8e8e;
    float: left;
    height: 25px;
    margin: 10px 0 0;
    text-align: left;
    width: 94%;
	padding: 0 0 0 8px;
}
textarea{
   border: 1px solid #8e8e8e;
    float: left;
    height: 80px;
    margin: 10px 0 0;
    text-align: left;
    width: 94%;
	padding: 4px 0 0 8px;
}
.form-field {
    margin: 0 auto;
    width: 80%;
}
.send-button {
    float: left;
    font-size: 14px;
    font-weight: bold;
    padding: 10px;
    width: 30%;
	color:#ffffff;
}
fieldset {
    background: #e8e8e8 none repeat scroll 0 0;
}
.send-button {
    background: #035186 none repeat scroll 0 0;
    border: medium none;
    font-size: 14px;
    font-weight: bold;
    margin: 10px auto;
    padding: 10px;
    width: 30%;
}
</style>

</head>

<body>
<div class="email-friend">
<h3 class="title-heading">EMAIL YOUR FRIEND</h3>
<form name="friend-email" action="" method="post" required>
<fieldset>
<center>
<div class="form-field"><input class="input-text" type="email" name="friend_email" placeholder="Friend email" value="" required></div>
<div class="form-field"><input class="input-text" type="text" name="friend_name" placeholder="Friend name" value="" required></div>

<div class="form-field"><input class="input-text" type="email" name="my_email" placeholder="Your email" value="" required></div>
<div class="form-field"><input class="input-text" type="text" name="my_name" placeholder="Your name" value="" required></div>

<div class="form-field"><textarea name="textmsg" placeholder="Message"></textarea></div>

<div class="form-field"><input type="hidden" name="url" value="<?php echo URL?>"></div>

<div class="form-field"><input class="send-button" type="submit" name="send-mail" value="Send"></div>
</center>
</fieldset>
</form>
<?php 
if(isset($_POST['send-mail'])){

	$headers = 'From:' . $_POST['my_email'];	
			$subject = 'Your friend suggest you this product';	
			$messageBody = "<table><tr><td>Dear ".$_POST['friend_name'].",</td></tr><tr><td>Following new registration has done on obasekiestates.co.uk, kindly review and approve his/her account. </td></tr>
			<tr><td><a href='".URL."admin/home.php?option=com_tenant&task=edit&id=".$lastid."'>Click Here</a> to approve his/her account</td></tr></table>\n";		
			$messageBody .= 'Name: ' . $_POST["yourname"]  . "\n";		
			$messageBody .= '<br>' . "\n";		
			$messageBody .= 'Email Address: ' . $_POST['youremail'] .  "\n";		
			$messageBody .= '<br>' . "\n";		
			$messageBody .= 'Phone Number: ' . $_POST['telephone'] .  "\n";		
			$messageBody .= '<br>' . "\n";	
			$messageBody .= 'Property Details: ' . $_POST['pdetail'] .  "\n";

	SendMail($_POST['friend_email'], $_POST['my_email'], "Obaseki Estates", $subject, $messageBody, $CC="");	
			
	print "<script >window.location='".URL."product/detail.php?id=63'</script>";
	
	}
?>

</div>
</body>
</html>