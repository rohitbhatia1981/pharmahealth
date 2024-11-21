<?php 
function showListToSelect() {
    global $component;
    include "components/reports/select-report.php";
?>	
<?php }

function showRecordsListing(&$rows) {
    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
    include "components/reports/sales-report.php";
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
<?php include "components/reports/pharmacy-sale-report.php"; ?>
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
<?php include "components/reports/clinician-hours.php"; ?>
<?php }


function showRefundReportHTML(&$rows)
{
	    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
		
		
include "components/reports/refund-report.php"; 
	
}

function showPatientReportHTML(&$rows)
{
	    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
		
		
include "components/reports/patient-report.php"; 
	
}

function showClinicianReportHTML(&$rows)
{
	    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
		
		
include "components/reports/clinician-report.php"; 
	
}

 ?>




