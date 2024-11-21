<?php include "../../private/settings.php"; 

if ($_POST['id']!="" && $_POST['val']!="")
{

		$update = array(
			'message_patient_important' => $_POST['val'], 
			);
			
			$where_clause = array(
				'message_id' => $_POST['id']
			);
			
			$database->update( 'tbl_messages', $update, $where_clause, 1 );
			
echo "success";
}





?>