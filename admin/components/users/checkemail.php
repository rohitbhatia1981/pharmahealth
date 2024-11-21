<?php
 include "../../../private/settings.php";
global $database;
				
		$sql = "SELECT * FROM tbl_users where email='".$_POST['txtEmail']."' and user_id !='".$_POST['user_id']."'";
		$results = $database->get_results( $sql );
		if(count($results)>0){

		echo 'false';

		}else{

		echo 'true';

		}
		
?>