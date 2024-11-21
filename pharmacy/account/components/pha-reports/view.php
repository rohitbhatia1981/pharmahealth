<?php 
function showListToSelect() {
    global $component;
    include "components/".$component."/select-report.php";
?>	
<?php }

function showRecordsListing(&$rows) {
    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
    include "components/".$component."/sales-report.php";
?>	
<?php } ?>

<!-----------End Listing function------------------>

<?php
function showPayoutHTML(&$rows) {
    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
?>	
<!--Page header-->
<?php include "components/".$component."/payout-report.php"; ?>
<?php } ?>

<?php
function showPresReportHTML(&$rows) {
    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
?>	
<!--Page header-->
<?php include "components/".$component."/prescription.php"; ?>
<?php }


function showUncollectedReportHTML(&$rows)
{
	    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
		
		
include "components/".$component."/uncollected-report.php"; 
	
}

function showPatientReportHTML(&$rows)
{
	    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
		
		
include "components/".$component."/patient-report.php"; 
	
}

function showPerformanceReportHTML(&$rows)
{
	    global $component, $database, $pagingObject, $page;
    $totalRecords = count($rows);
    if ($page != 1)    
        $srno = (1 * $page) - 1;
    else
        $srno = 0;
		
		
include "components/".$component."/performance-report.php"; 
	
}

 ?>




