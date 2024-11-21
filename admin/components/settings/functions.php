<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;



		$sql = "SELECT * FROM tbl_settings where 1";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and setting_resname like '%".$_GET['txtSearchByTitle']."%' ";

		}

		$sql .= " order by setting_resname asc";

		//print_r($sql);

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

		// print_r($_POST);

		// exit;

		

	global $database, $component;

		$cid = $_POST['CId'];

		$setting_resname = $_POST['txtsetting_resname'];

		$setting_email = $_POST['txtsetting_email'];

		$setting_phone = $_POST['txtsetting_phone'];

		$setting_address = $_POST['txtAddress'];

		$setting_zipcode = $_POST['txtsetting_zipcode'];

		$setting_service_radious = $_POST['txtservice_radious'];

		$setting_res_odr_email = $_POST['txtres_odr_email'];

		$setting_res_odr_phone = $_POST['txtres_odr_phone'];
		
		$setting_res_odr_fax = $_POST['txtres_odr_fax'];

		$setting_opening_timing = $_POST['txtOpentime'];

		$setting_deliverytime_start = $_POST['txtdeliverytime_start'];
		
		$setting_deliverytime_end = $_POST['txtdeliverytime_end'];

		$setting_delivery_area = $_POST['txtdelivery_area'];

		$setting_delivery_fee = $_POST['txtdelivery_fee'];

		$setting_fax_enable = $_POST['EnableFax'];



		

		

		$names = array(

			'setting_resname' => $setting_resname, 

			'setting_email' => $setting_email, 

			'setting_phone' => $setting_phone, 

			'setting_address' => $setting_address //Random thing to insert

		);

		

		$add_query = $database->insert( 'tbl_settings', $names );

		$lastInsertedId=$database->lastid();

		

		$target=PATH."images/gallery/";

		$preFix = "gallery";

		

		if($_FILES['txtImage']['name'] != "")

		{

			

			$ext = substr($_FILES['txtImage']['name'],strpos($_FILES['txtImage']['name'],"."));

			copy($_FILES['txtImage']['tmp_name'],$target.$preFix."-".$lastInsertedId.$ext);

			

			$imageName = $preFix."-".$lastInsertedId.$ext;

			$updateimage = array(

					'gallery_image' => $imageName, 

					

				);

				

			$where_clause = array(

				'gallery_id' => $lastInsertedId

			);

			

			$database->update( 'tbl_galleries', $updateimage, $where_clause, 1 );

		}

		

		if( $add_query )

		{

		

			print "<script>window.location='index.php?c=".$component."&Cid=".$cid."'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_settings where setting_id='".$id."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		// print_r($_POST);

		// print_r($_FILES['txtImage']['name']);

		// exit;

			global $database,$component;	

				$cid = $_POST['CId'];

				$setting_resname = $_POST['txtsetting_resname'];

				$setting_email = $_POST['txtsetting_email'];

				$setting_phone = $_POST['txtsetting_phone'];
				
				
				$setting_address = $_POST['txtAddress'];

				$setting_zipcode = $_POST['txtsetting_zipcode'];
				
				$setting_tax = $_POST['txtTax'];	

				$setting_service_radious = $_POST['txtservice_radious'];

				$setting_res_odr_email = $_POST['txtres_odr_email'];

				$setting_res_odr_phone = $_POST['txtres_odr_phone'];
				
				$setting_res_odr_fax = $_POST['txtres_odr_fax'];

				$setting_opening_timing = $_POST['txtOpentime'];

				$setting_deliverytime_start = $_POST['txtdeliverytime_start'];
				
				$setting_deliverytime_end = $_POST['txtdeliverytime_end'];

				$setting_delivery_area = $_POST['txtdelivery_area'];

				$setting_delivery_fee = $_POST['txtdelivery_fee'];	
				
				$setting_suffix = $_POST['txtSuffix'];
				
				$setting_emailfrom = $_POST['txtEmailFrom'];
				
				$setting_menu_backgrnd_clr = $_POST['txtmenu_backgrnd_clr'];
				
				$setting_menu_text_clr = $_POST['txtmenu_text_clr'];	

				$setting_website_backgrnd_clr = $_POST['txtwebsite_backgrnd_clr'];	

				$setting_website_text_clr = $_POST['txtwebsite_text_clr'];	
				
				$setting_fax_enable = $_POST['EnableFax'];

				$userId=$_POST['userId'];

			

			$update = array(

				'setting_resname' => $setting_resname, 

				'setting_email' => $setting_email, 

				'setting_phone' => $setting_phone, 
				
				'setting_address' => $setting_address //Random thing to insert

			);

//Add the WHERE clauses

		$where_clause = array(

			'setting_id' => $userId

		);

		$updated = $database->update( 'tbl_settings', $update, $where_clause, 1 );

		

		$lastInsertedId = $userId;

		

		$target=PATH."images/setting/";
		
		$preFix = "menu";
	
		if($_FILES['txtImage']['name'] != "")
		{

		

			$ext = substr($_FILES['txtImage']['name'],strpos($_FILES['txtImage']['name'],"."));

			copy($_FILES['txtImage']['tmp_name'],$target.$preFix."-".$lastInsertedId.$ext);

			

			$imageName = $preFix."-".$lastInsertedId.$ext;

			$updateimage = array(

					'setting_ordr_bckgrnd_image' => $imageName, 

					

				);

				

			$where_clause = array(

				'setting_id' => $lastInsertedId

			);
			
			$database->update( 'tbl_settings', $updateimage, $where_clause, 1 );
		}	
			//-------------uploading logo-----------
			
			
		$preFix = "logo";
	
		if($_FILES['txtLogo']['name'] != "")
		{

			$ext = substr($_FILES['txtLogo']['name'],strpos($_FILES['txtLogo']['name'],"."));
			
			

			copy($_FILES['txtLogo']['tmp_name'],$target.$preFix."-".$lastInsertedId.$ext);


			$imageName = $preFix."-".$lastInsertedId.$ext;

			$updateimage = array(

					'setting_logo' => $imageName, 

					

				);

			

			$where_clause = array(

				'setting_id' => $lastInsertedId

			);
			
		
			//------------end uploading logo--------------

		$database->update( 'tbl_settings', $updateimage, $where_clause, 1 );

		}
		
		
		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=".$cid."'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'banner_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'setting_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_settings', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=1'</script>";

		}

	}

	

	function unpublishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'banner_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'setting_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_settings', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=1'</script>";

		}

	}

	

	function removelmage($imageName,$prodId)

	{

		global $database,$component;	

		    @unlink(PATH."images/userpic/".$imageName);

			

				$update = array(

				'banner_image' => ''

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'setting_id' => $prodId

			);

			$updated = $database->update( 'tbl_settings', $update, $where_clause, 1 );

		

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=1'</script>";

		}

			

    }

	

	function removeSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			

			//Add the WHERE clauses

			$where_clause = array(

				'setting_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_settings', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=1'</script>";

		}

	}

	

	

	

	

	

	

	/*function createFormForPages($id)

	{

		global $db;

		$valueId = $id;

		if($valueId!="" && $_GET['lid']=="")

		{

			$sqlForGroups = "select * from tbl_settings where  setting_id='".$valueId."'";

			$resultForGroups = $db->query($sqlForGroups);

			if(mysql_num_rows($resultForGroups))

			{

				$row = mysql_fetch_object($resultForGroups);

			}

		}

		

		createFormForPagesHtml($row);

	}

	function cancelOperation() 

	{

		global $option;

		fn_RedirectUrl(FILE_ADMIN_HOME.'?option='.$option);

	}

	function saveFormValues()

	{

		global $db,$option;				

	

	include PATH."classes/class_thumbnails.php";

		

	

		$sqlUserRegister = "insert into tbl_settings

							set

								setting_resname='".$_POST['txtBanners']."',

								banner_date='".fn_GiveMeDateInDBFormat($_POST['txtDate'])."',

								banner_status='".$_POST['rdoPublished']."'

							";

				$res = $db->query($sqlUserRegister);	

		$lastInsertedId = mysql_insert_id();

		

		if($_FILES['txtImg1']['name'] != "")

		{

			$target = PATH."images/banners/";

						

			$thumbnail = new Thumbnail($target,$_FILES['txtImg1'],'1000','1000',"banners_",$lastInsertedId);

			$check = $thumbnail->createThumbnail($target,$_FILES['txtImg1'],"banners_",$lastInsertedId);

			

			

			if($check=="no")

				print "File not uploaded.";

			else

				$thumbnail->updateTable("banner_image","tbl_settings","setting_id");

		

		}

		

		

		

		fn_RedirectUrl(FILE_ADMIN_HOME.'?option='.$option.'&task=edit&id='.$lastInsertedId);

		

	}

	

	function saveModificationsOperation()

	{

		

			global $db,$option;		

			

		

			

			include PATH."classes/class_thumbnails.php";

			  $sqlInsertPages = "update tbl_settings

							set

								setting_resname='".$_POST['txtBanners']."',

								banner_date='".fn_GiveMeDateInDBFormat($_POST['txtDate'])."',

								banner_status='".$_POST['rdoPublished']."'

								where setting_id='".$_POST['idToEdit']."'"; 

								

		$resultInsertPages = $db->query($sqlInsertPages);

		$lastInsertedId = $_POST['idToEdit'];	

	

		

			if($_POST['chkdel1']!="" && file_exists(PATH."images/banners/".$_POST['chkdel1']))

			{

				unlink(PATH."images/banners/".$_POST['chkdel1']);

				$sqlupdate="update tbl_news set banner_image='' where setting_id='".$lastInsertedId."'";

				$db->query($sqlupdate);

			}

				

				

				

		if($_FILES['txtImg1']['name'] != "")

		{

			$target = PATH."images/banners/";

			$thumbnail = new Thumbnail($target,$_FILES['txtImg1'],'1000','1000',"banners_",$lastInsertedId);

			$check = $thumbnail->createThumbnail($target,$_FILES['txtImg1'],"banners_",$lastInsertedId);

			if($check=="no")

				print "File not uploaded.";

			else

				$thumbnail->updateTable("banner_image","tbl_settings","setting_id");

		

		}

		

		

		fn_RedirectUrl(FILE_ADMIN_HOME.'?option='.$option.'&task=edit&id='.$lastInsertedId);

	}

	

	function removeSelectedItems()

	{

		global $db, $option, $newQueryString;

		for($p = 0; $p < count($_GET['deletes']); $p++)

		{

			 $countryIdToDelete = $_GET['deletes'][$p];

			 $sqlDeleteSelectedItems = "delete from tbl_settings where setting_id='".$countryIdToDelete."'";

			 $db->query($sqlDeleteSelectedItems);			 

		}

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}

	

	function modifyToPublish($id)

	{

		global $db, $option, $newQueryString;

		setValueForRecord("tbl_settings", "setting_id", "banner_status", $id, "1");

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}

	function modifyToUnPublish($id)

	{

		global $db, $option, $newQueryString;

		setValueForRecord("tbl_settings", "setting_id", "banner_status", $id, "0");

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}

	function publishSelectedItems()

	{

		global $db, $option, $newQueryString;

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			$provinceIdToPublish = $_GET['deletes'][$i];

			setValueForRecord("tbl_settings", "setting_id", "banner_status", $provinceIdToPublish, "1");

		}

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}

	function unpublishSelectedItems()

	{

		global $db, $option, $newQueryString;

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			 setValueForRecord("tbl_settings", "setting_id", "banner_status", $provinceIdToPublish, "0");

		}

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}*/

?>