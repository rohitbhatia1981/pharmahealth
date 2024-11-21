<?php include "../../../private/settings.php";

if ($_SESSION['sess_prescriber_id']!="" && $_POST['medicineId']!="")
{
		
		
		$sqlGet="select * from tbl_prescription_medicine where pm_id='".$database->filter($_POST['medicineId'])."'";
		$resGet=$database->get_results($sqlGet);
		$rowGet=$resGet[0];
		
		$pId=$rowGet['pm_pres_id'];
		
		changeMedication($pId);
		
			
			$where_clause = array(
				'pm_id' => $_POST['medicineId']
			);
			$delete = $database->delete('tbl_prescription_medicine_change_requests', $where_clause, 1 );
			
			
			//-------update button stage-----
		
		$curDate=date("Y-m-d");
		
			$update = array(
			 'pres_medicine_change_status' => 1,
			 'pres_medicine_request_date' => $curDate
			);
			
			$where_clause = array(
			'pres_id' => $pId
			);

			$updated = $database->update('tbl_prescriptions', $update, $where_clause, 1 );
			
									
			
		
		
		//--------end update button stage----
			
			
			echo "1";
}
else
echo "2";
?>

