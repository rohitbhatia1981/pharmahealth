<?php
  // folder where signature will be stored
  $folderPath = "uploads/";
  
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
     echo 'Error! the image is not created';
  }
?>