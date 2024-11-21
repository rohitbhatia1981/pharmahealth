<?php include "../../../private/settings.php";


if ($_POST['txtMedicine']!="" && $_POST['pId']!="")
{


//-----------Insert old history in change request table first time------

	changeMedication($_POST['pId']);

//------------end first time entry in change request table------

		$medId=$_POST['txtMedicine'];
		$mName=getMedicineName($medId);
		
		
		
		$qty=$_POST['txtQty'];
		
		$pack = $_POST['txtPack'];
		$packParts = explode(' ', trim($pack));
		$packValue = $packParts[0];
		
		$strength = $_POST['txtStrength'];
		$strengthParts = explode(' ', trim($strength));
		$strengthValue = $strengthParts[0];
		
		

		
		$tier=$_POST['hdTier'];
		
		
		if ($_POST['txtDosage']==1)
		$dosageText=$_POST['txtDosage_freetext'];
		else
		$dosageText=$_POST['txtDosage'];
		
		
		
		$price=getMedicinePrice($medId,$strengthValue,$packValue,$qty,$tier);
		
		$totalPrice=$price*$qty;
		
		$names = array(
		'pm_pres_id' => $_POST['pId'],
		'pm_med' => $mName,
		'pm_med_price' => $price,
		'pm_med_qty' => $qty,
		'pm_med_packsize' => $pack,
		'pm_med_dosage' => $dosageText,
		'pm_med_strength' => $strength,
		'pm_med_total' => $totalPrice
		
		);
		$add_query = $database->insert('tbl_prescription_medicine_change_requests', $names );
		
		
		//-------update button stage-----
		
		$curDate=date("Y-m-d");
		
			$update = array(
			 'pres_medicine_change_status' => 1
			 
			);
			
			$where_clause = array(
			'pres_id' => $_POST['pId']
			);

			$updated = $database->update('tbl_prescriptions', $update, $where_clause, 1 );
		
		
		//--------end update button stage----



echo "1";
}
else
echo "2";
?>