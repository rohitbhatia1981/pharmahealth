<?php include "../../../../private/settings.php"; 


if ($_GET['mode']==1)
{

$sqlPosition="select * from tbl_medical_questions where mq_category='".$database->filter($_GET['cat'])."' and mq_conditions='".$database->filter($_GET['cond'])."' order by mq_order asc";
$resPosition=$database->get_results($sqlPosition);
echo '<option value="0">At first Position</option>';
if (count($resPosition)>0)
{
	
	
	
	
for ($i=0;$i<count($resPosition);$i++)
{
$rowPosition=$resPosition[$i];



if ($i==count($resPosition)-1)
$selected="selected";



?>


<option value="<?php echo $rowPosition['mq_order']; ?>" <?php echo $selected; ?>>After - <?php echo substr($rowPosition['mq_questions'],0,100); ?></option>

<?php }
}
}
else if ($_GET['mode']==2) 
{
$sqlPosition="select * from tbl_medical_questions where mq_id<>'".$database->filter($_GET['mid'])."' and mq_category='".$database->filter($_GET['cat'])."' and mq_conditions='".$database->filter($_GET['cond'])."' order by mq_order asc";
$resPosition=$database->get_results($sqlPosition);
echo '<option value="0">At first Position</option>';
if (count($resPosition)>0)
{
	
	
	
	
for ($i=0;$i<count($resPosition);$i++)
{
$rowPosition=$resPosition[$i];


?>


<option value="<?php echo $rowPosition['mq_order']; ?>" <?php if ($rowPosition['mq_order']==$_GET['position']-1) echo "selected"; ?>>After - <?php echo substr($rowPosition['mq_questions'],0,100); ?></option>

<?php }
}	
}

?>