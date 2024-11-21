<?php include "../../../private/settings.php"; 

if ($_POST['signed']!="") {

 $folderPath = PATH."signature/uploads/";  
  // break the encoded image string
  $image_parts = explode(";base64,", $_POST['signed']);

  // get image type
  $image_type_aux = explode("image/", $image_parts[0]);
  $image_type = $image_type_aux[1];

  // get image data
  $image_base64 = base64_decode($image_parts[1]);

  // create a unique image name
  $image_name = uniqid().time(). '.'.$image_type;

  // concatenate image with the uploads directory
  $file = $folderPath . $image_name;

  // dynamically create an image file
  if(!file_put_contents($file, $image_base64)){
    echo 'Signature did not updated, please contact admin';
  }
  
  		$update = array(
		'pres_signature' => $image_name
		);

		$where_clause = array(
			'pres_id' => $_SESSION['sess_prescriber_id']
		);
		$updated = $database->update( 'tbl_prescribers', $update, $where_clause, 1 );
		
		echo "1";

}




?>