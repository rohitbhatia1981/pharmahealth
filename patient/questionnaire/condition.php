<?php include "../../private/settings.php";

$_SESSION['sessCondition']=base64_decode($_GET['cmbCondition']);
print "<script>window.location='".URL."patient/questionnaire/step1'</script>";

?>