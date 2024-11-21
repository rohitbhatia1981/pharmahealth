<?php

// this is to avoid direct access of this file


// function to be used for redirecting purpose
	function teckbiz_RedirectUrl($url,$msg='')
	{
		if($msg != "")
		{
			if(strpos($url,'?'))
				$msg='&msg='.urlencode($msg);
			else
				$msg='?msg='.urlencode($msg);
		}  
		print "<script>window.location.href='".$url.$msg."'</script>";
	}
	
	function teckbiz_GetMeDaysInDisplayFormat($days)
	{
		if($days == 0)
			return SITE_TEXT_FOR_DISPLAYING_TODAY;
		elseif($days < 30)
			return $days." ".SITE_TEXT_FOR_DISPLAYING_DAYS_AGO;
		else
		{
			$division = ($days / 30);
			$value = "";
			if($division > 0 && strpos($division, ".") != false)
			{
				$arrValues = explode(".", $division);
				$value = $arrValues[0];
			}
			
			if($value != "")
			{
				if($value < 12)
				{
					if($value > 1) $monthsValue = SITE_TEXT_FOR_DISPLAYING_MONTHS;
					else $monthsValue = SITE_TEXT_FOR_DISPLAYING_MONTHS;
					$remainingDays = ($days - (30 * $value));
					if(($remainingDays % 30) > 1) $daysValue = ($remainingDays % 30)." ".SITE_TEXT_FOR_DISPLAYING_DAYS;
					else $daysValue = "1 day"; 
					$stringToReturn = $value." ".$monthsValue." ".$daysValue." ".SITE_TEXT_FOR_DISPLAYING_AGO;
				}
				else
				{
					$yearValue = "";
					$yearDivision = "";
					$yearDivision = ($value / 12);
					if($yearDivision > 0 && strpos($yearDivision, ".") != false)
					{
						$arrYearValues = explode(".", $yearDivision);
						$yearValue = $arrYearValues[0];
					}
					if($yearValue != "")
					{
						$finalMonths = ($value % 12);
						if($finalMonths > 1) $monthsValue = SITE_TEXT_FOR_DISPLAYING_MONTHS;
						else $monthsValue = SITE_TEXT_FOR_DISPLAYING_MONTHS;
						if($yearValue > 1) $yearToGo = SITE_TEXT_FOR_DISPLAYING_YEARS;
						else $yearToGo = SITE_TEXT_FOR_DISPLAYING_YEAR;
						$remainingDays = ($days - (30 * $yearValue));
						if(($remainingDays % 30) > 1) $daysValue = ($remainingDays % 30)." ".SITE_TEXT_FOR_DISPLAYING_DAYS;
						else $daysValue = "1 ".SITE_TEXT_FOR_DISPLAYING_DAY; 
						$stringToReturn = $yearValue." ".$yearToGo." ".$finalMonths." ".$monthsValue." ".$daysValue." ".SITE_TEXT_FOR_DISPLAYING_AGO;
						
					}
				}
			}
			else
			{
				if($division > 1) $monthsValue = $division." ".SITE_TEXT_FOR_DISPLAYING_MONTHS;
				else $monthsValue = $division." ".SITE_TEXT_FOR_DISPLAYING_MONTH;
				$stringToReturn = $monthsValue." ".SITE_TEXT_FOR_DISPLAYING_AGO;
			}
			return $stringToReturn;
		}
	}	
	
	function getAboveLinks()
	{
	?>
			<table cellpadding="0" cellspacing="0" width="100%" border="0">
				<tr><td height="10"></td></tr>
				<?php if($_SESSION['sessionUserId'] != "") { ?>
				<tr><td style="padding-left:10px;" align="left" class="style1"><?php echo SITE_TEXT_FOR_DISPLAYING_USERNAME; ?> : <span class="yellow"><?php echo $_SESSION['sessionUserName']; ?></span></td><td class="style1" align="right" style="padding-right:10px;"><a href="<?php echo URL.FILE_FRONT_INDEX."?option=com_profile"; ?>" title="<?php echo SITE_TEXT_FOR_TOOLTIP_TO_PROFILE; ?>" class="yellow"><?php echo SITE_TEXT_FOR_DISPLAYING_MY_PROFILE_TEXT;?></a>&nbsp;&nbsp;<a href="<?php echo URL.FILE_FRONT_INDEX."?option=com_index"; ?>" title="<?php echo SITE_TEXT_FOR_TOOLTIP_TO_HOME; ?>" class="yellow"><?php echo SITE_TEXT_FOR_DISPLAYING_HOME;?></a>&nbsp;&nbsp;<a href="<?php echo URL.FILE_FRONT_INDEX."?option=logout"; ?>" title="<?php echo SITE_TEXT_FOR_TOOLTIP_TO_LOGOUT; ?>" class="yellow"><?php echo SITE_TEXT_FOR_DISPLAYING_LOGOUT;?></a></td></tr>
				<?php } else { ?>
				<tr><td style="padding-left:10px;" align="left" class="style1">&nbsp;</td><td class="style1" align="right" style="padding-right:10px;">&nbsp;&nbsp;<a href="<?php echo URL.FILE_FRONT_INDEX."?option=com_index"; ?>" title="<?php echo SITE_TEXT_FOR_TOOLTIP_TO_HOME; ?>" class="yellow"><?php echo SITE_TEXT_FOR_DISPLAYING_HOME;?></a>&nbsp;&nbsp;<a href="<?php echo URL.FILE_FRONT_INDEX."?option=com_register"; ?>" title="<?php echo SITE_TEXT_FOR_TOOLTIP_TO_LOGIN; ?>" class="yellow"><?php echo SITE_TEXT_FOR_DISPLAYING_LOGIN;?></a></td></tr>
				<?php } ?>
				
			</table>
	<?php
	}
	function bigboxotext($output) 
	{ 
		$output = str_replace(chr(10), "<br />", $output); 
		$output = str_replace(chr(146), "&#8217;", $output); 
		$output = str_replace(chr(130), "&#8218;", $output); 
		$output = str_replace(chr(133), "&#8230;", $output); 
		$output = str_replace(chr(150), "&ndash;", $output);  
		$output = str_replace(chr(151), "&ndash;", $output);  
		$output = str_replace(chr(152), "&ndash;", $output); 
		  
		$output = str_replace(chr(146), "&#39;", $output); // error 146 
		$output = str_replace("'", "&#39;", $output); // error 146 
		$output = str_replace(chr(145), "&#39;;", $output); // error 145  
		$output = str_replace(chr(147), '"', $output); 
		$output = str_replace(chr(148), '"', $output);  
		$output = str_replace(chr(151), "&#8212", $output); 
		return $output; 
	} 
	
	//function to add and strip slashes
	function teckbiz_AddSlashes(&$varName)
	 {
	    if(ini_get('magic_quotes_gpc') != 1) 
	       $varName=addslashes($varName);
		else
		   $varName=$varName; 
	 }
		 
	 function teckbiz_StripSlashes(&$varName)
	 {
	   if(ini_get('magic_quotes_gpc') != 1) 
	       $varName=stripslashes($varName);
		else
		   $varName=$varName;
	 }
	 
	/*
	 function teckbiz_CurrentTemplate($type,$menuItemId='')	 
	  {	
	    global $db;
	    if($menuItemId!="")
			{
		       $sqlForTemplate="select template.template_name from tbl_templates as template,tbl_template_menu as tm,tbl_menu menu where template.template_id=tm.template_id and menu.menu_id=tm.menu_id and template.template_for='".$type."' and template.template_status='1'";
			}
		else
			{
				$sqlForTemplate="select template_name from tbl_templates where template_status=1 and template_for='".$type."'";
			}
		
				$resForTemplate = $db->query($sqlForTemplate);
				if(mysql_num_rows($resForTemplate) > 0)
					{
					 $rowForTemplate=mysql_fetch_object($resForTemplate);
					 $currentTemplate=$rowForTemplate->template_name;
					}
				else
					{
					    $sqlForTemplate="select template_name from tbl_templates where template_status=1 and template_for='".$type."'";
			
		
						$resForTemplate = $db->query($sqlForTemplate);
						if(mysql_num_rows($resForTemplate) > 0)
							{
							 $rowForTemplate=mysql_fetch_object($resForTemplate);
							 $currentTemplate=$rowForTemplate->template_name;
							}
					}
				return $currentTemplate;
	  }	
	  */
	  
	  	 // function to get the template for the component or otherwise default template will be picked up
	function teckbiz_CurrentTemplate($for, $menu)
	{
		global $db;
		if($for == "admin")
			$menuId = teckbiz_GiveSomeValue("tbl_components", "component_option", "component_id", $menu);
		else
			$menuId = teckbiz_GiveSomeValue("tbl_menus", "menu_option", "menu_id", $menu);
		
		$sqlBringMenuTemplateName = "select template_name from tbl_templates,tbl_menus_templates where tbl_menus_templates.menu_id='".$menuId."' and tbl_menus_templates.template_id=tbl_templates.template_id and template_for='".$for."'";
		$resultBringMenuTemplateName = $db->query($sqlBringMenuTemplateName);
		if(mysql_num_rows($resultBringMenuTemplateName))
		{
			$rowBringMenuTemplateName = mysql_fetch_object($resultBringMenuTemplateName);
			return $rowBringMenuTemplateName->template_name;
		}
		else
		{
			$sqlBringMenuTemplateName = "select template_name from tbl_templates,tbl_menus_templates where tbl_menus_templates.menu_id=0 and tbl_templates.template_for='".$for."' and tbl_menus_templates.template_id=tbl_templates.template_id";
			$resultBringMenuTemplateName = $db->query($sqlBringMenuTemplateName);
			if(mysql_num_rows($resultBringMenuTemplateName))
			{
				$rowBringMenuTemplateName = mysql_fetch_object($resultBringMenuTemplateName);
				return $rowBringMenuTemplateName->template_name;
			}
		}
	} 

	  //This function will be used to manipulate the parameters
	function teckbiz_GetParameter(&$paramValue)
	 {
	   return $paramValue;
	 }
	 
	 //function to display alert messages
	 function teckbiz_Alert($msg='')
	 	{
			print "<script>alert('".$msg."')</script>";
		}
	 
	 // To check the login
	function teckbiz_CheckUserLogin($userName,$password,$tableName)
	{
		global $db;

		$sqlCheckAdminLogin	= "select * from ".$tableName." where username='".$userName."' and password='".md5($password)."'";
		$resCheck =	$db->query($sqlCheckAdminLogin);
		if($db->getTotalRows($resCheck) > 0)
		{
			$recArray = $db->getResultArray($resCheck);
			if($recArray['user_status'] == 0)
			{
				return "EnabledProblem";
			}
			else
			{
				$ifAllowed = teckbiz_GiveSomeValue("tbl_groups", "group_id", "group_published", $recArray['groupid']);
				if($ifAllowed == 0)
				{
				return "EnabledProblem";
				}
				else
				{
					return $recArray;
				}
			}
		}
		else
		{
			return "";
		} 
	}
	
	function showCalendarHere()
	{
		?>
		<table id="calendar">
		<tr style="border:0px;">
		<td colspan="7" style="padding:0px;"><table cellpadding="0" style="padding:0px;border:0px solid #313031;" width="100%" cellspacing="0"><tr style="border:0px;">
		  <th align="left" style="border:0px;"><a class="button" style="border:0px;" href="" title="Previous Month"
			 onclick="addMonths(event, -1); return false;"><img src="<?php echo URL.FOLDER_IMAGES."left.gif"; ?>" border="0" /></a></th>
		  <th id="calendarHeader" style="border:0px;">&nbsp;</th>
		  <th style="border:0px;" align="right"><a style="border:0px;" class="button" href="" title="Next Month"
			 onclick="addMonths(event, 1); return false;"><img src="<?php echo URL.FOLDER_IMAGES."right.gif"; ?>" border="0" /></a></th>
			</tr></table></td>
		</tr>
		<tr class="days">
		  <th>Sun</th>
		  <th>Mon</th>
		  <th>Tue</th>
		  <th>Wed</th>
		  <th>Thu</th>
		  <th>Fri</th>
		  <th>Sat</th>
		</tr>
		<tr>
		  <td class="weekend"><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		</tr>
		<tr>
		  <td class="weekend"><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		</tr>
		<tr>
		  <td class="weekend"><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		</tr>
		<tr>
		  <td class="weekend"><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		</tr>
		<tr>
		  <td class="weekend"><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		</tr>
		<tr>
		  <td class="weekend"><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		  <td><a href="#" class="alink" onclick="setTargetDate(event, this); return false;">&nbsp;</a></td>
		</tr>
		</table>
		</td></tr>
	<?php
	}
	 	//-- To check group allowed to login or not
	 function teckbiz_CheckGroupAllowance($table, $published_field, $id_field, $gid)
	 {
	 	global $db;
		$sqlCheckGroup	= "select ".$published_field." from ".$table." where id_field='".$gid."'";
		$resCheckGroup = $db->query($sqlCheckGroup);
		if(mysql_num_rows($resCheckGroup))
		{
			$rowCheckGroup = mysql_fetch_object($resCheckGroup);
			if($rowCheckGroup->$published_field == 1)
				return "yes";
			else
				return "no";
		}
	 }
	 //to check the session set
	 function teckbiz_CheckSession()
	  {
	    global $_SESSION;
	    if(!isset($_SESSION['sessionUserName']) && $_SESSION['sessionUserName']=="" && !isset($_SESSION['sessionUserId']) && $_SESSION['sessionUserId']=="")
		 {
		   teckbiz_RedirectUrl("index.php","Kindly Enter Username and Password to Access this Part of Website");
		 }
	  }
	  
	  function teckbiz_GetHead()
	   {
	      
	   }
	   
	  function  teckbiz_GetHeader()
	   {
	   
	   }
	  
		//--  Load the Module -> $place like left, $style like vertical or horizontal ,
		//--  $for id for admin or front and $class is stylesheet class for table 
	function loadModules($place,$style,$class,$for,$groupId)
	{
		global $db;
		if($for == "admin")
		{
			$absolutePathModules = PATH.FOLDER_ADMIN.FOLDER_ADMIN_MODULES;
		}
		else
		{
			$absolutePathModules = PATH.FOLDER_FRONT_MODULES;
		}
		if($for == "admin")
		{
			$absoluteURLFile = URL.FOLDER_ADMIN.FILE_ADMIN_HOME;
		}
		else
		{
			$absoluteURLFile = URL.FILE_FRONT_HOME;
		}

		$sqlModules = "select * from tbl_modules where module_position = '".$place."' and module_status = '1' and module_for='".$for."' and module_access='".$groupId."' order by module_order asc";
		$resultModules = mysql_query($sqlModules);
		if(mysql_num_rows($resultModules))
		{
		?>
			<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td>
			<?php
			while($module = mysql_fetch_object($resultModules))
			{
			?>
				<table cellpadding="0" width="100%" cellspacing="0" class="<?php echo $class; ?>">
					<tr>
						<td>
							<?php include_once($absolutePathModules.$module->module_option.".php"); ?>
						</td>
					</tr>
				</table>
				
			<?php
			}
			?>
			</td></tr></table>
			<?php	
		}
	} 
	
	function teckbiz_GetMainBody($for)
	{
		global $groupId,$option,$task;
		$sqlLetsMakeBody = "select * from tbl_components where component_id='".$option."'";
		$resultLetsMakeBody = mysql_query($sqlLetsMakeBody);
		if(mysql_num_rows($resultLetsMakeBody))
		{
			$rowLetsMakeBody = mysql_fetch_object($resultLetsMakeBody);
			if($for == 'admin') $default_file_to_pick = "$rowLetsMakeBody->component_admin_controller";
			else $default_file_to_pick = "$rowLetsMakeBody->component_front_controller";
			include_once(PATH.FOLDER_ADMIN.FOLDER_ADMIN_COMPONENTS.$rowLetsMakeBody->component_option."/".$default_file_to_pick);
		}
	}
	
	// in progress..........
	function teckbiz_CreateSelectList($table, $id_field, $name_field, $to_be_selected_value, $where, $selectBoxName, $selectBoxClass, $function_on_change)
	{
		global $db;
		echo "<select name='".$selectBoxName."' id='".$selectBoxName."' class='".$selectBoxClass."' onChange='".$function_on_change."'>";
		$sqlCreate = "select ".$id_field.",".$name_field." from ".$table." where 1.";
		if($where != "") $sqlCreate .= " and " . $where;
		$resultCreate = $db->query($sqlCreate);
		if(mysql_num_rows($resultCreate))
		{
			while($rowCreate = mysql_fetch_object($resultCreate))
			{
				teckbiz_StripSlashes($rowCreate->$name_field);
				echo "<option value='".$rowCreate->$id_field."'";
				if($rowCreate->$id_field == $to_be_selected_value) echo " selected ";
				echo ">".$rowCreate->$name_field."</option>";
			}
		}
		echo "</select>";
	}
	
	function teckbiz_GiveMeDateInDBFormat($datetoupdate)
	{
		if($datetoupdate != '')
		{
			 $rdate = explode("/",$datetoupdate);
			  $m = trim($rdate[0]);
			  $d = trim($rdate[1]);
			  $y = trim($rdate[2]);
			 return  $newDate = $y."-".$m."-".$d;
		}
		else
		{
			return "";
		}
	}
	
	function teckbiz_GiveMeDateInDisplayFormat($datetoupdate)
	{
		$sql="select * from tbl_settings";
		$res=mysql_query($sql);
		if(mysql_num_rows($res)>0)
		{
			$row=mysql_fetch_object($res);
		}
		
		if($datetoupdate!='' && $datetoupdate!='0000-00-00')
		{
			 
			 $rdate = explode("-",$datetoupdate);
			 $y = $rdate[0];
			 $m = $rdate[1];
			 $d = $rdate[2];
			 
			 $format=$row->setting_date_answer;
			
			 switch($format)
			 {
			 case '1':
			 	return $newDate=$m."/".$d."/".$y;
				break;
			 
			 case '2':
			 	return $newDate=$d."/".$m."/".$y;
			 	break;
				
			 case '3':
			 	
				$month['01']="January";
				$month['02']="February";
				$month['03']="March";
				$month['04']="April";
				$month['05']="May";
				$month['06']="June";
				$month['07']="July";
				$month['08']="August";
				$month['09']="September";
				$month[10]="October";
				$month[11]="November";
				$month[12]="December";
				
				return $newDate=$d." ".$month[$m].", ".$y;
			 	break;
				
			case '4':
			 	
				$month['01']="January";
				$month['02']="February";
				$month['03']="March";
				$month['04']="April";
				$month['05']="May";
				$month['06']="June";
				$month['07']="July";
				$month['08']="August";
				$month['09']="September";
				$month[10]="October";
				$month[11]="November";
				$month[12]="December";
				
				return $newDate=$month[$m]." ".$d.", ".$y;
			 	break;
			 }
			// return $newDate=$m."/".$d."/".$y;
		}
		else
		{
			return "";
		}
	}
	

	function teckbiz_GiveMeDateInDisplayFormatOld($datetoupdate)
	{
		if($datetoupdate!='' && $datetoupdate!='0000-00-00')
		{
			 $rdate = explode("-",$datetoupdate);
			 $y = $rdate[0];
			 $m = $rdate[1];
			 $d = $rdate[2];
			 return $newDate=$d."/".$m."/".$y;
		}
		else
		{
			return "";
		}
	}
	
	function teckbiz_GiveSomeValue($table, $id_field, $wanted_value_field, $value_for)
	{
		global $db;
		$sql = "select ".$wanted_value_field." from ".$table." where ".$id_field."='".$value_for."'";
		$result = $db->query($sql);
		if(mysql_num_rows($result))
		{
			while($row = mysql_fetch_object($result))
			{
				teckbiz_StripSlashes($row->$wanted_value_field);
				return $row->$wanted_value_field;
			}
		}
	}
	
	function teckbiz_GetMeTimeInDBFormat($timeToUpdate, $part)
	{
		if($timeToUpdate != "")
		{
			$timeParts = explode(":",$timeToUpdate);
			if($part == 1) $timeParts[0] = $timeParts[0] + 12;
			return $timeParts[0].":".$timeParts[1].":".$timeParts[2];
		}
		else
		{
			return "00:00:00";
		}
	}
	function teckbiz_GetMeTimeInDisplayFormat($timeToUpdate, $part)
	{
		if($timeToUpdate != "")
		{
			$timeParts = explode(":",$timeToUpdate);
			if($timeParts > 12) $timeParts[0] = $timeParts[0] - 12;
			return $timeParts[0].":".$timeParts[1].":".$timeParts[2];
		}
		else
		{
			return "00:00:00";
		}
	}
	function teckbiz_GiveMeDateInDisplayFormatOld1($datetoupdate)
		{
					
			if($datetoupdate!='' && $datetoupdate!='0000-00-00')
			{
				 $rdate = explode("-",$datetoupdate);
				 $y = $rdate[0];
				 $m = $rdate[1];
				 $d = $rdate[2];
				 return $newDate=$d."/".$m."/".$y;
			}
			else
			{
				return "";
			}
		}
	function checkIfInteger($value) 
	{
		if(!filter_var($value, FILTER_VALIDATE_INT))
			return "no";
		else
			return "yes";
	}
	
	function checkIfUserNameAvailable($table,$field,$username)
	{
		global $db;
		$sql = "select count(*) as total from ".$table." where ".$field."='".$username."'";
		$result = $db->query($sql);
		$row = mysql_fetch_object($result);
		if($row->total == 0) return "yes";
		else return "no";
	}
	function teckbiz_GetUserDetails($id)
	{
		global $db;
		$content = "";
		$userid = $id;
		$sqlBringUserDetails = "select name, company, telephone1, email from tbl_users where user_id = '".$userid."'";
		$resultBringUserDetails = $db->query($sqlBringUserDetails);
		$rowBringUserDetails = mysql_fetch_object($resultBringUserDetails);
		$content .= "Name - ".$rowBringUserDetails->name."<br/>Company - ".$rowBringUserDetails->company;
		$content .= "<br/>E-Mail - ".$rowBringUserDetails->email."<br/>Telephone - ".$rowBringUserDetails->telephone1;
		return $content;
	}
	
	function teckbiz_GetUserType($user_type_id)
	{
		$user_types = array(1=>'Administrator', 2=>'Site User', 3=>'Events', 4=>'Trips', 5=>'Tours', 6=>'Training');
		return $user_types[$user_type_id];
	}
	
	function teckbiz_GetLocationType($location_type_id)
	{
		$location_types = array(1=>'Events', 2=>'Trips', 3=>'Tours', 4=>'Training');
		return $location_types[$location_type_id];
	}
	
	function teckbiz_CheckForGlobalSettings($table)
	{
		global $db;
		$sqlGlobalSettings = "select * from ".$table;
		$resultGlobalSettings = $db->query($sqlGlobalSettings);
		if(mysql_num_rows($resultGlobalSettings))
		{
			$rowGlobalSettings = mysql_fetch_object($resultGlobalSettings);
			return $rowGlobalSettings;
		}
	}
	
	function teckbiz_GetHrefOfLinkBasedOnSEO($parameters)
	{
		global $settingOfSEO;
	}
	
	function teckbiz_CountFrontModules($place)
	{
		global $db, $groupId;
		$sqlModules = "select * from tbl_modules where module_position = '".$place."' and module_for='front' order by module_order asc";
		$resultModules = $db->query($sqlModules);
		return mysql_num_rows($resultModules);
	}
	
	function teckbiz_LoadFrontModules($place,$style,$class,$for,$groupId)
	{
		global $db;
		$absolutePathModules = PATH.FOLDER_FRONT_MODULES;
		$absoluteURLFile = URL."index.php";

		$sqlModules = "select * from tbl_modules where module_position = '".$place."' and module_status = '1' and module_for='".$for."' order by module_order asc";
		$resultModules = mysql_query($sqlModules);
		if(mysql_num_rows($resultModules))
		{
		?>
			<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td>
			<?php
			while($module = mysql_fetch_object($resultModules))
			{
			?>
				<table cellpadding="0" width="100%" cellspacing="0">
					<tr>
						<td>
							<?php include($absolutePathModules.$module->module_option.".php"); ?>
						</td>
					</tr>
				</table><br/>
			<?php
			}
			?>
			</td></tr></table>
			<?php	
		}
	} 
   
   function teckbiz_GetFrontHead()
	   {
	     
		  global $currentTemplate,$option,$id,$db, $settingGlobalSiteMetaKeyword, $settingGlobalSiteMetaDescription;
		  $arrayPass=array(); 
		  $arrayGet=array();
		  
 
			  if($option=="com_news" && $id != "")
		      {
				  $arrayPass[]="page_title";
				  $arrayPass[]="meta_keyword";
				  $arrayPass[]="meta_description";
				  
				  $arrayGet=teckbiz_GetMetaTags($arrayPass,'tbl_news','news_id',$id);
			    }		
			  if($option=="com_content" && $id != "")
		      {
				  $arrayPass[]="page_seo_title";
				  $arrayPass[]="page_seo_keywords";
				  $arrayPass[]="page_seo_description";
				  
				  $arrayGet=teckbiz_GetMetaTags($arrayPass,'tbl_page_detail','page_page_id',$id);
				   
			    }		
				
				if($option=="com_ambassador" && $ambassador == "")
		         {
				  $arrayPass[]="page_meta_title";
				  $arrayPass[]="page_meta_keywords";
				  $arrayPass[]="page_meta_description";
				  
				  $arrayGet=teckbiz_GetMetaTags($arrayPass,'tbl_page','page_categoryid',$categoryId);
				   
			      }	
					if($arrayGet[0]!="")
						$metaTitle=$arrayGet[0];
					  else
						$metaTitle=META_TITLE;
						
					  if($arrayGet[1]!="")
						$metaKeywords=$arrayGet[1];
					  else
						$metaKeywords = $settingGlobalSiteMetaKeyword;
						
					  if($arrayGet[2]!="")
						$metaDescription=$arrayGet[2];
					  else
						$metaDescription=$settingGlobalSiteMetaDescription;
			?>	
				<head>
				<title><?php print $metaTitle; ?></title>
                <meta name="keywords" content="<?php print $metaKeywords; ?>" />
                <meta name="description" content="<?php print $metaDescription; ?>" />
	            <link rel="shortcut icon" href="<?php print URL; ?>images/favicon.ico" />
	            </head>
				<?php		
			  }
   function teckbiz_GetMetaTags($arrayFieldNames,$tableName,$idorField,$idorFieldValue)
	  {
	    global $db;
		$arrayReuturn=array();
		$fields=implode(",",$arrayFieldNames);
		$sqlQuery="select ".$fields." from ".$tableName." where ".$idorField."='".$idorFieldValue."'";    
		 
		 $resQuery=$db->query($sqlQuery);
		if(mysql_num_rows($resQuery) > 0 )
		  {
		    $rowQuery=mysql_fetch_object($resQuery);
			for($i=0;$i<count($arrayFieldNames);$i++)
			 {
			    $arrayReuturn[]=$rowQuery->$arrayFieldNames[$i];
			 }
		  } 
		  return $arrayReuturn;
	  }
		//-- Call this function to create inner center part 
	function teckbiz_GetFrontMainBody($for)
	{
		global $option;
		include_once(PATH.FOLDER_FRONT_COMPONENTS.$option."/".$option.".php");
	}
	
	
	function teckbiz_DateFormat($datetoupdate)   //--Function to get date in user's format for display
	{
	 $rdate = explode("-",$datetoupdate);
	 $y = $rdate[0];
	 $m = $rdate[1];
	 $d = $rdate[2];
	 if($datetoupdate!="")
	 return $newDate=$d."/".$m."/".$y;
	 else
	 return "";
	
	}


	function teckbiz_TrueDateFormat($datetoupdate)
	{
	 $rdate = explode("/",$datetoupdate);
	 $d = $rdate[0];
	 $m = $rdate[1];
	 $y = $rdate[2];
	 if($datetoupdate!="") 
	 return $newDate=$y."-".$m."-".$d;
	 else
	 return "";
	}

function checkOfficeStatus()
	{
	$hours = date("H");
	$day=date("N");
	
	//echo $curTime=date("H : i: s");
		if ($day<=5)
		{
			if ($hours>=8 && $hours<=20)
			return true;   //office open
			else
			return false;  //ofice closed
		}
		else
		{
			if ($hours>=8 && $hours<=18)
			return true; //office open
			else
			return false; //office closed
		
		}
	
	}


function getParentCategory($id)
{
	global $database;
	$sqlCategory="select * from tbl_categories where category_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	return $rowCategory['category_name'];
	
}

function netAddSlashes(&$varName)

	 {

	    if(ini_get('magic_quotes_gpc') != 1) 

	       $varName=addslashes($varName);

		else

		   $varName=$varName; 
		   
		   return $varName;

	 }

function netStripSlashes(&$varName)

	 {

	   if(ini_get('magic_quotes_gpc') != 1) 

	       $varName=stripslashes($varName);

		else

		   $varName=$varName;


 return $varName;
	 }	// Create a function for converting the amount in wordsfunction AmountInWords(float $amount){   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;   // Check if there is any number after decimal   $amt_hundred = null;   $count_length = strlen($num);   $x = 0;   $string = array();   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');    while( $x < $count_length ) {      $get_divider = ($x == 2) ? 10 : 100;      $amount = floor($num % $get_divider);      $num = floor($num / $get_divider);      $x += $get_divider == 10 ? 1 : 2;      if ($amount) {       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.'        '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. '        '.$here_digits[$counter].$add_plural.' '.$amt_hundred;        }   else $string[] = null;   }   $implode_to_Rupees = implode('', array_reverse($string));   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . "    " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;}
	 
	 

?>