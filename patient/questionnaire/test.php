<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Image upload testing</title>
<link type="text/css" href="orakuploader/orakuploader.css" rel="stylesheet"/>
</head>

<body>

<div id="images4ex" orakuploader="on"></div>

</body>
<?php $pImageStr="";?>

<script type="text/javascript" src="jquery/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script language="javascript">

$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : 'images/ads',
		orakuploader_thumbnail_path : 'images/ads',
		
		orakuploader_use_main : true,	
		orakuploader_use_dragndrop : true,
		orakuploader_use_rotation: false,
		orakuploader_use_sortable : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 0,
		orakuploader_thumbnail_size  : 0,
		orakuploader_maximum_uploads : 10,
		orakuploader_attach_images: [],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
	
	
});
</script>	

<script type="text/javascript" src="orakuploader/orakuploader.js"></script>


</html>