<?php



	function showList()

	{

	

	global $database,$pagingObject,$page;


		$sql = "SELECT * FROM tbl_groups where 1";


		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and group_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}

		$sql .= " order by group_name asc";

		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		

		$results = $pagingObject->setQuery($results);

		

		$results = $database->get_results( $sql );

		

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		

		

		$groupNameEntered = $_POST['txtGroupName'];

		$groupPublishedEntered = $_POST['rdoPublished'];



		

		

		$names = array(

			'group_name' => $groupNameEntered,

			'group_published' => $groupPublishedEntered //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_groups', $names );

		$lastInsertedId=$database->lastid();

		

		$sqlInsertForMenusAndGroups = array(

			'rights_group_id' => $lastInsertedId,

			'rights_menu_id' => '1',

			'rights_add' => '1',

			'rights_edit' => '1',

			'rights_delete' => '1', 

			'rights_enable' => '1', 

			'rights_disable' => '0' 

		);

		$add_query = $database->insert( 'tbl_rights_groups', $sqlInsertForMenusAndGroups );

		

		for($i = 1; $i <= $_POST['hidTotalMenus']; $i++)  //Loop for number of times of checkboxes

			{

				$checkBoxName = "chkSection".$i;

				if($_POST[$checkBoxName] != "")

				{

					$rightsAdd = "";

					$rightsEdit = "";

					$rightsDelete = "";

					$rightsEnable = "";

					$rightsDisable = "";

					

					$nameCheckBoxAdd = "chkPermitAdd".$i;

					$nameCheckBoxEdit = "chkPermitEdit".$i;

					$nameCheckBoxDelete = "chkPermitDelete".$i;

					$nameCheckBoxEnable = "chkPermitEnable".$i;

					$nameCheckBoxDisable = "chkPermitDisable".$i;

					

					if($_POST[$nameCheckBoxAdd] == "") $rightsAdd = 0;

					else $rightsAdd = 1;

					if($_POST[$nameCheckBoxEdit] == "") $rightsEdit = 0;

					else $rightsEdit = 1;

					if($_POST[$nameCheckBoxDelete] == "") $rightsDelete = 0;

					else $rightsDelete = 1;

					if($_POST[$nameCheckBoxEnable] == "") $rightsEnable = 0;

					else $rightsEnable = 1;

					if($_POST[$nameCheckBoxDisable] == "") $rightsDisable = 0;

					else $rightsDisable = 1;

					

					$sqlInsertForMenusAndGroups = array(

							'rights_group_id' => $lastInsertedId,

							'rights_menu_id' => $_POST[$checkBoxName],

							'rights_add' => $rightsAdd,

							'rights_edit' => $rightsEdit,

							'rights_delete' => $rightsDelete, 

							'rights_enable' => $rightsEnable, 

							'rights_disable' => $rightsDisable 

						);

						$add_query = $database->insert( 'tbl_rights_groups', $sqlInsertForMenusAndGroups );

				}

			}

		//exit;

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=1'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				 $sql = "SELECT * FROM tbl_groups where group_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );
				
				
				

			

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			

				$groupNameEntered = $_POST['txtGroupName'];

				$groupPublishedEntered = $_POST['rdoPublished'];	

				$groupId=$_POST['groupId'];

			

			$update = array(

				'group_name' => $groupNameEntered, 

				'group_published' => $groupPublishedEntered

			);

		//Add the WHERE clauses

		$where_clause = array(

			'group_id' => $groupId

		);

		$updated = $database->update( 'tbl_groups', $update, $where_clause, 1 );

		

		for($i = 1; $i <= $_POST['hidTotalMenus']+1; $i++)

		{

		$where_clause = array(

			'rights_group_id' => $groupId

		);

		$delete = $database->delete( 'tbl_rights_groups', $where_clause, 1 );

		}

		

		$sqlInsertForMenusAndGroups = array(

			'rights_group_id' => $groupId,

			'rights_menu_id' => '1',

			'rights_add' => '1',

			'rights_edit' => '1',

			'rights_delete' => '1', 

			'rights_enable' => '1', 

			'rights_disable' => '1' 

		);

		$add_query = $database->insert( 'tbl_rights_groups', $sqlInsertForMenusAndGroups );

		

		for($i = 1; $i <= $_POST['hidTotalMenus']; $i++)  //Loop for number of times of checkboxes

			{

				$checkBoxName = "chkSection".$i;

				if($_POST[$checkBoxName] != "")

				{

					$rightsAdd = "";

					$rightsEdit = "";

					$rightsDelete = "";

					$rightsEnable = "";

					$rightsDisable = "";

					

					$nameCheckBoxAdd = "chkPermitAdd".$i;

					$nameCheckBoxEdit = "chkPermitEdit".$i;

					$nameCheckBoxDelete = "chkPermitDelete".$i;

					$nameCheckBoxEnable = "chkPermitEnable".$i;

					$nameCheckBoxDisable = "chkPermitDisable".$i;

					

					if($_POST[$nameCheckBoxAdd] == "") $rightsAdd = 0;

					else $rightsAdd = 1;

					if($_POST[$nameCheckBoxEdit] == "") $rightsEdit = 0;

					else $rightsEdit = 1;

					if($_POST[$nameCheckBoxDelete] == "") $rightsDelete = 0;

					else $rightsDelete = 1;

					if($_POST[$nameCheckBoxEnable] == "") $rightsEnable = 0;

					else $rightsEnable = 1;

					if($_POST[$nameCheckBoxDisable] == "") $rightsDisable = 0;

					else $rightsDisable = 1;

					

					$sqlInsertForMenusAndGroups = array(

							'rights_group_id' => $groupId,

							'rights_menu_id' => $_POST[$checkBoxName],

							'rights_add' => $rightsAdd,

							'rights_edit' => $rightsEdit,

							'rights_delete' => $rightsDelete, 

							'rights_enable' => $rightsEnable, 

							'rights_disable' => $rightsDisable 

						);

						$add_query = $database->insert( 'tbl_rights_groups', $sqlInsertForMenusAndGroups );

				}

			}

			

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=1'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'group_published' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'group_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_groups', $update, $where_clause, 1 );

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

				'group_published' => 2

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'group_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_groups', $update, $where_clause, 1 );

		}

		

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

				'group_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_groups', $where_clause, 1 );

			

			$where_clause = array(

			'rights_group_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_rights_groups', $where_clause, 100 );

			

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

			$sqlForGroups = "select * from tbl_banners where  banner_id='".$valueId."'";

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

		

	

		$sqlUserRegister = "insert into tbl_banners

							set

								banner_title='".$_POST['txtBanners']."',

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

				$thumbnail->updateTable("banner_image","tbl_banners","banner_id");

		

		}

		

		

		

		fn_RedirectUrl(FILE_ADMIN_HOME.'?option='.$option.'&task=edit&id='.$lastInsertedId);

		

	}

	

	function saveModificationsOperation()

	{

		

			global $db,$option;		

			

		

			

			include PATH."classes/class_thumbnails.php";

			  $sqlInsertPages = "update tbl_banners

							set

								banner_title='".$_POST['txtBanners']."',

								banner_date='".fn_GiveMeDateInDBFormat($_POST['txtDate'])."',

								banner_status='".$_POST['rdoPublished']."'

								where banner_id='".$_POST['idToEdit']."'"; 

								

		$resultInsertPages = $db->query($sqlInsertPages);

		$lastInsertedId = $_POST['idToEdit'];	

	

		

			if($_POST['chkdel1']!="" && file_exists(PATH."images/banners/".$_POST['chkdel1']))

			{

				unlink(PATH."images/banners/".$_POST['chkdel1']);

				$sqlupdate="update tbl_news set banner_image='' where banner_id='".$lastInsertedId."'";

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

				$thumbnail->updateTable("banner_image","tbl_banners","banner_id");

		

		}

		

		

		fn_RedirectUrl(FILE_ADMIN_HOME.'?option='.$option.'&task=edit&id='.$lastInsertedId);

	}

	

	function removeSelectedItems()

	{

		global $db, $option, $newQueryString;

		for($p = 0; $p < count($_GET['deletes']); $p++)

		{

			 $countryIdToDelete = $_GET['deletes'][$p];

			 $sqlDeleteSelectedItems = "delete from tbl_banners where banner_id='".$countryIdToDelete."'";

			 $db->query($sqlDeleteSelectedItems);			 

		}

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}

	

	function modifyToPublish($id)

	{

		global $db, $option, $newQueryString;

		setValueForRecord("tbl_banners", "banner_id", "banner_status", $id, "1");

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}

	function modifyToUnPublish($id)

	{

		global $db, $option, $newQueryString;

		setValueForRecord("tbl_banners", "banner_id", "banner_status", $id, "0");

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}

	function publishSelectedItems()

	{

		global $db, $option, $newQueryString;

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			$provinceIdToPublish = $_GET['deletes'][$i];

			setValueForRecord("tbl_banners", "banner_id", "banner_status", $provinceIdToPublish, "1");

		}

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}

	function unpublishSelectedItems()

	{

		global $db, $option, $newQueryString;

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			 setValueForRecord("tbl_banners", "banner_id", "banner_status", $provinceIdToPublish, "0");

		}

		fn_RedirectUrl(FILE_ADMIN_HOME.'?'.$newQueryString);

	}*/

?>