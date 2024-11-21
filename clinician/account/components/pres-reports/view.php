<?php 
function showListToSelect() {
    global $component;
    include "components/".$_GET['c']."/select-report.php";
?>	
<?php }

function showRecordsListing(&$rows) {
    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
    include "components/".$_GET['c']."/sales-report.php";
?>	
<?php } ?>

<!-----------End Listing function------------------>

<?php
function showPharmacySaleHTML(&$rows) {
    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
?>	
<!--Page header-->
<?php include "components/".$_GET['c']."/pharmacy-sale-report.php"; ?>
<?php } ?>

<?php
function showClinicianHoursReportHTML(&$rows) {
    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
?>	
<!--Page header-->
<?php include "components/".$_GET['c']."/clinician-hours.php"; ?>
<?php }


function showRefundReportHTML(&$rows)
{
	    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
		
		
include "components/".$_GET['c']."/refund-report.php"; 
	
}

function showPatientReportHTML(&$rows)
{
	    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
		
		
include "components/".$_GET['c']."/patient-report.php"; 
	
}

function showClinicianReportHTML(&$rows)
{
	    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
		
		
include "components/".$_GET['c']."/clinician-report.php"; 
	
}

 ?>




