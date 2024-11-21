<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;



		$sql = "SELECT * FROM tbl_users where 1";

		if($_GET['selGroup'] != "")

		{

			$sql .= " and groupid = '".$_GET['selGroup']."'";

		}

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and username like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}

		$sql .= " order by username asc";

		//print_r($sql);

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

		//print_r($_POST);

		//exit;

		

	global $database, $component;

		$cid = $_POST['CId'];

		$userName = $_POST['txtUsername'];

		$Name = $_POST['txtName'];

		$userEmail = $_POST['txtEmail'];

		$userAltemail = $_POST['txtAltemail'];

		$userGroup= $_POST['txtGroup'];

		$userCity= $_POST['txtcityid'];

		$userPhone= $_POST['txtPhone'];

		$txtAddress= $_POST['txtAddress'];

		$userPassword= md5($_POST['txtPassword']);

		$userCPassword= $_POST['txtPassword'];

		$verify_code=md5($_POST['txtEmail']);

		$userDate= date('Y-m-d');

		$userPublished = $_POST['rdoPublished'];



		

		

		$names = array(

			'username' => $userName, 
			'name' => $Name, 
			'email' => $userEmail,
			'alt_email' => $userAltemail,
			'password' => $userPassword,
			'groupid' => $userGroup,
			'telephone1' => $userPhone,
			'register_date' => $userDate,
			'emailverify'=>0,
			'emailverify_code'=>$verify_code,
			'user_status' => $userPublished //Random thing to insert

		);

		

		$add_query = $database->insert( 'tbl_users', $names );

		$lastInsertedId=$database->lastid();
		
		
		//Sending welcome email to new user created----------
		
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				$sqlEmail="select * from tbl_emails where email_id=56 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$contact_link="<a href='".URL."contact-us'>Contact us</a>";
					$admin_link="<a href='".URL."admin'>Click here</a>";
					
					$emailContent=str_replace("<name>",$Name,$emailContent);
					$emailContent=str_replace("<username>",'<strong>'.$userName.'</strong>',$emailContent);
					$emailContent=str_replace("<password>",'<strong>'.$_POST['txtPassword'].'</strong>',$emailContent);
					$emailContent=str_replace("<admin_link>",$admin_link,$emailContent);
					$emailContent=str_replace("<contact_link>",$contact_link,$emailContent);
										
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
									


					$ToEmail=$userEmail;
					$FromEmail=ADMIN_FORM_EMAIL;
					$FromName=FROM_NAME;
					
					$SubjectSend="Welcome to Pharma Health - Admin Account Activation";
					 $BodySend=$mailBody;	
					
					
	
					SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
					
									}
				
				//------------end sending email

		

		$target=PATH."images/userpic/";

		$preFix = "user";

		

		if($_FILES['txtImage']['name'] != "")

		{

			

			$ext = substr($_FILES['txtImage']['name'],strpos($_FILES['txtImage']['name'],"."));

			copy($_FILES['txtImage']['tmp_name'],$target.$preFix."-".$lastInsertedId.$ext);

			

			$imageName = $preFix."-".$lastInsertedId.$ext;

			$updateimage = array(

					'user_image' => $imageName, 

					

				);

				

			$where_clause = array(

				'user_id' => $lastInsertedId

			);

			

			$database->update( 'tbl_users', $updateimage, $where_clause, 1 );

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

				

				$sql = "SELECT * FROM tbl_users where user_id='".$id."'";

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
				$userName = $_POST['txtUsername'];
				$Name = $_POST['txtName'];
				$userEmail = $_POST['txtEmail'];
				$userAltemail = $_POST['txtAltemail'];
				$userGroup= $_POST['txtGroup'];
				$userCity= $_POST['txtcityid'];
				$userPhone= $_POST['txtPhone'];
				$txtAddress= $_POST['txtAddress'];
				$verify_code=md5($_POST['txtEmail']);
				$userPublished = $_POST['rdoPublished'];
				$userId=$_POST['userId'];

			

			$update = array(

				'username' => $userName, 
				'name' => $Name, 
				'email' => $userEmail,
				'alt_email' => $userAltemail,
				'groupid' => $userGroup,
				'cityid' => $userCity,
				'telephone1' => $userPhone,
				'address' => $txtAddress,
				'emailverify'=>0,
				'emailverify_code'=>$verify_code,
				'user_status' => $userPublished

			);
			
			
			if ($_POST['txtPassword']!="")
					{
					$user_password= md5($_POST['txtPassword']);			
					$update_add = array(
						'password' => $user_password,			
		
					);
					
					$update=array_merge($update, $update_add);
					
					}

//Add the WHERE clauses

		$where_clause = array(

			'user_id' => $userId

		);

		$updated = $database->update( 'tbl_users', $update, $where_clause, 1 );

		

		$lastInsertedId = $userId;

		$target=PATH."images/userpic/";

		$preFix = "user";

		

		if($_FILES['txtImage']['name'] != "")

		{

			

			$ext = substr($_FILES['txtImage']['name'],strpos($_FILES['txtImage']['name'],"."));

			copy($_FILES['txtImage']['tmp_name'],$target.$preFix."-".$lastInsertedId.$ext);

			

			$imageName = $preFix."-".$lastInsertedId.$ext;

			$updateimage = array(

					'user_image' => $imageName, 

					

				);

				

			$where_clause = array(

				'user_id' => $lastInsertedId

			);

			

			$database->update( 'tbl_users', $updateimage, $where_clause, 1 );

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

				'user_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'user_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_users', $update, $where_clause, 1 );

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

				'user_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'user_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_users', $update, $where_clause, 1 );

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

				'user_image' => ''

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'user_id' => $prodId

			);

			$updated = $database->update( 'tbl_users', $update, $where_clause, 1 );

		

		

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

				'user_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_users', $where_clause, 1 );

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