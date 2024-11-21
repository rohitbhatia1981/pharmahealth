<?php
function getProductPrice($menuId)
	{
		global $database;
		$menuPrice=$database->get_row("select * from tbl_prices where price_product_id='".$database->filter($menuId)."' order by price_value asc limit 0,1");
		return $menuPrice[3];
	}

function fn_uk_format_date_time($date)
{
	$dateTime = new DateTime($date);
	$ukFormattedDate = $dateTime->format('d/m/Y h:i A');
	return $ukFormattedDate;
}

function fn_TrueDateFormat($datetoupdate)

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

function getCountBlog($catId)
{
	global $database;
	
	$sql="select * from tbl_blogs where blog_categories='".$database->filter($catId)."' and blog_status=1";
	
	$load=$database->get_results($sql);
	$total = count($load);

	return $total;
}

function fn_GiveMeDateInDisplayFormat($datetoupdate)
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

function getPatientGP($patientId)
{
	global $database;
	 $sqlGP="select * from tbl_patient_gps where pg_patient_id='".$database->filter($patientId)."'";
	 $resGP=$database->get_results($sqlGP);
	 $rowGP=$resGP[0];
	 if ($rowGP['pg_option']==1)
	 return $rowGP['pg_gp'];
	 else if ($rowGP['pg_option']==2)
	 return $rowGP['pg_gp_name'];
	 else if ($rowGP['pg_option']==3)
	 return "I don’t know my GP Practice details";
	 else if ($rowGP['pg_option']==4)
	 return "I do not have a registered GP in the UK";
	 else if ($rowGP['pg_option']==5)
	 return  "I will take responsibility to inform my GP";
													
}

function displayDateTimeFormat($getdate)
{
	
	
	 $dateTime = new DateTime($getdate);
    
    // Format the datetime as required
    $formattedDatetime = $dateTime->format('d/m/y h:i A');
    
    return $formattedDatetime;
}

function displayDateFormat($getdate)
{
	
	
	 $dateTime = new DateTime($getdate);
    
    // Format the datetime as required
    $formattedDatetime = $dateTime->format('d/m/y');
    
    return $formattedDatetime;
}


function fnDateOrTime($date) {
    $currentDate = date("d/m/Y");
    $givenDate = date("d/m/Y", strtotime($date));
    
    if ($currentDate == $givenDate) {
        // If the given date is today's date, display just the time
        return date("h:i A", strtotime($date));
    } else {
        // If the given date is later, display just the date
        return date("d/m/Y", strtotime($date));
    }
}


function fnUpdateHTML($text)
{
	$description=str_replace("&lt;","<",$text);
	$description=str_replace("&gt;",">",$description);
	$description=str_replace("&quot;",'"',$description);
	$description=str_replace("&amp;rsquo;","'",$description);
	$description=str_replace("&amp;nbsp;"," ",$description);
	$description=str_replace("&amp;","&",$description);
	 
	
	return $description;
}




function getParentCategory($id)
{
	global $database;
	$sqlCategory="select * from tbl_categories where category_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['category_name']!="")
	echo $rowCategory['category_name'];
	else
	echo "-";
	
	
}

function getTranTruckNumber($id)
{
	global $database;
	$sqlCategory="select * from tbl_weighbridge_requests where wbr_transaction_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['wbr_truck_number']!="")
	echo $rowCategory['wbr_truck_number'];
	else
	echo "-";
	
	
}

function moneyFormat($amount) {
	
 list ($number, $decimal) = explode('.', sprintf('%.2f', floatval($amount)));

    $sign = $number < 0 ? '-' : '';

    $number = abs($number);

    for ($i = 3; $i < strlen($number); $i += 3)
    {
        $number = substr_replace($number, ',', -$i, 0);
    }

   
	if ($decimal>0)
	return $sign . $number . "." .$decimal;
	else
	return $sign . $number;
	
}

function getDriverName($phone)
{
	global $database;
	$sqlCategory="select * from tbl_drivers where driver_phone='".$database->filter($phone)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['driver_name']!="")
	echo $rowCategory['driver_name'];
	else
	echo "-";
	
	
}





function getSoldQtyMining($id,$dateFrom='',$dateTo='')
{
	global $database;
	
	$sqlContent="select sum(order_quantity) as totalQty from tbl_transactions,tbl_orders where transaction_id=order_transactionid  and transaction_mining='".$id."' and transaction_status='2'";
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sqlContent.=" and transaction_date>='".$dateFrom."'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sqlContent.=" and transaction_date<='".$dateTo."'"; 
	}
	
	$getContent=$database->get_results($sqlContent);
	$rowContent=$getContent[0];
	
	
	return fnCuToTon($rowContent['totalQty']);
	
	
	/*$sqlContent="select * from tbl_weighbridge_requests,tbl_transactions where wbr_transaction_id=transaction_id and wbr_status=2 and transaction_mining='".$database->filter($id)."' ";
	
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sqlContent.=" and wbr_reviewed_datetime>='".$dateFrom." 00:00:00'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sqlContent.=" and wbr_reviewed_datetime<='".$dateTo." 23:59:59' "; 
	}
	
	$getContent=$database->get_results($sqlContent);
	
	
	$totalQty=0;
	for ($i=0;$i<count($getContent);$i++)
			{
			$rowContent=$getContent[$i];
			//$sqlOrder="select sum(order_quantity) as totalQty from tbl_orders where order_transactionid='".$rowContent['transaction_id']."'";
			
						  if ($rowContent['wbr_loaded_truck_weight']>0)
							 {
							 $netWeight=$rowContent['wbr_loaded_truck_weight']-$rowContent['wbr_empty_truck_weight'];
							 
							 $totalQty=$totalQty+$netWeight;
							 
							// $netWeight=fnConKgToCu($netWeight);
							 //echo $netWeight;
							 
							 }
			
			
			
		}
		*/
		
		
}

function getContractorName($id)
{
	global $database;
	$sqlCategory="select * from tbl_contractors where contractor_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['contractor_name']!="")
	echo $rowCategory['contractor_name'];
	else
	echo "-";
	
	
}

function getInterestRate($aid)
{
	global $database;
	$sqlCategory="select * from emdmf_contractor where ec_id='".$database->filter($aid)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['ec_late_fees']!="")
	return $rowCategory['ec_late_fees'];
	else
	echo "0";
	
}

function getGraceDays($aid)
{
	global $database;
	$sqlCategory="select * from emdmf_contractor where ec_id='".$database->filter($aid)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['ec_grace_period']!="")
	return $rowCategory['ec_grace_period'];
	else
	echo "0";
	
}


function fnMiningOrders($id,$dateFrom='',$dateTo='')
{
	global $database;
	$sql = "SELECT count(transaction_id) as ctr FROM tbl_transactions where transaction_mining='".$database->filter($id)."' and transaction_status=2";
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sql.=" and transaction_date>='".$dateFrom."'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sql.=" and transaction_date<='".$dateTo."'"; 
	}
	
	
	$res = $database->get_results($sql);
	$row = $res[0];
	return $row['ctr'];
	
	
}

function fnGetMiningOfficer($id)
{
	global $database;
	$sql = "SELECT * FROM tbl_mining_officers where mo_id='".$database->filter($id)."'";
	$res = $database->get_results($sql);
	$row = $res[0];
	return $row['mo_name']." (".$row['mo_phone'].")";
}

function fnGetProductPrice($id,$pid)
{
	global $database;
	
	$sql = "SELECT * FROM tbl_custom_pricing where cp_mining_id='".$database->filter($id)."' and cp_product_id='".$database->filter($pid)."'";
	$res = $database->get_results($sql);
	if (count($res)>0)
	{
		$row = $res[0];
		$price=$row['cp_price'];
	}
	else
	{
		
		$sql = "SELECT * FROM tbl_products where product_id='".$database->filter($pid)."'";
		$res = $database->get_results($sql);
		if (count($res)>0)
		{
			$row = $res[0];
			$price=$row['product_price'];
		}
		
	}
	
	return $price;
	
}

/*
function fnMiningSales($id,$dateFrom='',$dateTo='')
{
	global $database;
	$sql = "SELECT sum(transaction_total_amount) as sumTotal FROM tbl_transactions where transaction_mining='".$database->filter($id)."' and transaction_status<>3";
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sql.=" and transaction_date>='".$dateFrom."'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sql.=" and transaction_date<='".$dateTo."'"; 
	}
	
	
	$res = $database->get_results($sql);
	$row = $res[0];
	return $row['sumTotal'];
}
*/

function fnMiningSales($id,$dateFrom='',$dateTo='')
{
	
	//----------Get total quantity approved by JE so far-----//
	
	global $database;
	
	
	
	$sql="select sum(transaction_total_amount) as totalSales from tbl_transactions where transaction_mining='".$database->filter($id)."' and transaction_status=2";
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sql.=" and transaction_date>='".$dateFrom."'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sql.=" and transaction_date<='".$dateTo."'"; 
	}
	
	
	$res = $database->get_results($sql);
	$row = $res[0];
	return formatToTens($row['totalSales']);
	
	
	
	
	
	
	/*$sqlContent="select * from tbl_weighbridge_requests where wbr_status=2 and wbr_mining_id='".$database->filter($id)."' ";
	
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sqlContent.=" and wbr_reviewed_datetime>='".$dateFrom." 00:00:00'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sqlContent.=" and wbr_reviewed_datetime<='".$dateTo." 23:59:59' "; 
	}
	
	$getContent=$database->get_results($sqlContent);
	
	
	$totalQty=0;
	$totalRevenue=0;
	for ($i=0;$i<count($getContent);$i++)
			{
			$rowContent=$getContent[$i];
			//$sqlOrder="select sum(order_quantity) as totalQty from tbl_orders where order_transactionid='".$rowContent['transaction_id']."'";
			
						  if ($rowContent['wbr_loaded_truck_weight']>0)
							 {
							 $netWeight=$rowContent['wbr_loaded_truck_weight']-$rowContent['wbr_empty_truck_weight'];
							 
							 //$totalQty=$totalQty+$netWeight;
							 $totalPerRev=fnConKgToCu_Val($netWeight)*$rowContent['wbr_product_price'];
							 $totalRevenue=$totalRevenue+$totalPerRev;
							// $netWeight=fnConKgToCu($netWeight);
							 //echo $netWeight;
							 
							 }
			
			
			
		}
		
		
		
		
		
		return $revenue=number_format($totalRevenue);
		
		*/
	
	//---------Get total quantity approved by je----------//
}


function htCategoryName_link($catName)
	{
			$categoryName=str_replace(" ","-",$catName);
			 $categoryName=str_replace("/","-",$categoryName);
			 $categoryName=str_replace(",","",$categoryName);
			 $categoryName=str_replace("ä","a",$categoryName);
			 $categoryName=str_replace(".com","",$categoryName);
			  $categoryName=str_replace("|","",$categoryName);
			 
			
			 $categoryName=str_replace("&amp;","",$categoryName);
			 $categoryName=str_replace("&","",$categoryName);
			 
			 $categoryName=str_replace("---","-",$categoryName);
			 $categoryName=str_replace("--","-",$categoryName);
			 $categoryName=str_replace("'","",$categoryName);
			  $categoryName=str_replace('"',"",$categoryName);
			 $categoryName=str_replace("?","",$categoryName);
			 $categoryName=str_replace("#","",$categoryName);
			 $categoryName=str_replace("!","",$categoryName);
			 $categoryName=str_replace(":","",$categoryName);
			 $categoryName=str_replace("(","",$categoryName);
			 $categoryName=str_replace(")","",$categoryName);
			 
			return urlencode(strtolower($categoryName));
	}

function shippingFree($totalAmount)
{
	if ($_SESSION['sesRegion']==9)
	{
		//if ($totalAmount<50)
		$awayPrice=round(50-$totalAmount,2);
		//else
		//$awayPrice=0;
	}
	else
	{
		//if ($totalAmount<99)
		$awayPrice=round(99-$totalAmount,2);
		//else
		//$awayPrice=0;
	}
	return $awayPrice;
}



function getMining_multi($ids)

{
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);		

		foreach ($arrayDcat as $val)

				{											

					$sql = "SELECT * FROM tbl_minings where mining_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];													

					array_push($arrayDcat_r,$resultCategory['mining_name']);

													//print $resultCategory['category_name'];

				}

			

			return $strDcat=implode(", ",$arrayDcat_r);

}

function getDistrictsFBlocks($id)

{
		global $database;	
		$arrayDcat_r=array();
		
												

		$sql = "SELECT * FROM tbl_districts where district_block_id='".$database->filter($id)."'";
		$dCategories = $database->get_results( $sql );
		if (count($dCategories)>0)
		{
				for ($j=0;$j<count($dCategories);$j++)
				{
					$resultCategory = $dCategories[$j];													
					array_push($arrayDcat_r,$resultCategory['district_name']);
				}
		}

													//print $resultCategory['category_name'];

			

			return $strDcat=implode(", ",$arrayDcat_r);

}




function getDistrict_multi($ids)

{
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);		

		foreach ($arrayDcat as $val)

				{											

					$sql = "SELECT * FROM tbl_districts where district_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];													

					array_push($arrayDcat_r,$resultCategory['district_name']);

													//print $resultCategory['category_name'];

				}

			

			return $strDcat=implode(", ",$arrayDcat_r);

}

function getSubDistrict_multi($ids)

{
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);		

		foreach ($arrayDcat as $val)

				{											

					$sql = "SELECT * FROM tbl_sub_districts where sd_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];													

					array_push($arrayDcat_r,$resultCategory['sd_name']);

													//print $resultCategory['category_name'];

				}

			

			return $strDcat=implode(", ",$arrayDcat_r);

}

function getProduct_multi($ids)

{
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);		

		foreach ($arrayDcat as $val)

				{											

					$sql = "SELECT * FROM tbl_products where product_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];													

					array_push($arrayDcat_r,$resultCategory['product_title']);

													//print $resultCategory['category_name'];

				}

			

			return $strDcat=implode(", ",$arrayDcat_r);

}



function getMemberEmailId($id)
{
	
	global $database;
	$sql="select * from tbl_member where member_id='".$database->filter($id)."'";
	$load=$database->get_results($sql);
	$row=$load[0];
	
	if ($row['member_email']!="")
	echo $row['member_email'];
	else
	echo "-";
}



// Create a function for converting the amount in words








function pageheading(){
		
	global $database;

	if(isset($_GET['c']) && $_GET['c'] !='' )
	{
		
		$comp_name = $_GET['c'];
		$pages_query = "SELECT * FROM `tbl_components` WHERE `component_option` = '".$database->filter($comp_name)."'";
		$results = $database->get_results($pages_query); 
		 $DashboardTitle = $results[0]['component_text'];
		
	}else{
	
	$DashboardTitle = 'Dashboard';
	$ClassDashboard = 'active';
	
	}

return $DashboardTitle;
}


function getConditionName($id)
{
	global $database;
	$sqlCategory="select * from tbl_conditions where condition_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['condition_title']!="")
	echo $rowCategory['condition_title'];
	else
	echo "-";
	
	
}

function getConditionId($id)
{
	global $database;
	$sqlCategory="select * from tbl_conditions where condition_title='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['condition_id']!="")
	return $rowCategory['condition_id'];
	else
	echo "-";
	
	
}

function getConditionNameVar($id)
{
	global $database;
	$sqlCategory="select * from tbl_conditions where condition_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['condition_title']!="")
	return $rowCategory['condition_title'];
	else
	return "-";
	
	
}



function getCategoryName($id)
{
	global $database;
	$sqlCategory="select * from tbl_faq_categories where faq_categories_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['faq_categories_name']!="")
	echo $rowCategory['faq_categories_name'];
	else
	echo "-";
	
	
}

function getCategoryName_pharmacy($id)
{
	global $database;
	$sqlCategory="select * from tbl_faq_categories_pharmacy where faq_categories_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['faq_categories_name']!="")
	echo $rowCategory['faq_categories_name'];
	else
	echo "-";
	
	
}

function getPharmacyName($id)
{
	global $database;
	$sqlCategory="select * from tbl_pharmacies where pharmacy_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['pharmacy_name']!="")
	echo $rowCategory['pharmacy_name'];
	else
	echo "-";
	
	
}

function getPharmacyTier($id)
{
	global $database;
	$sqlCategory="select pharmacy_tier from tbl_pharmacies where pharmacy_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['pharmacy_tier']!="")
	return $rowCategory['pharmacy_tier'];
	
	
	
}

function getPharmacyIncome($pid,$startDate='',$endDate='')
{
	global $database;
	
	$sql="select sum(payment_pharmacy_profit) as pharmacy_income from tbl_payments where payment_pharmacy_id='".$database->filter($pid)."' and payment_status=1";
		if ($startDate!="")
		$sql.=" and payment_date>='".$database->filter($startDate)."'";
	
		if ($endDate!="")
		{
			$endDate = $database->filter($endDate) . ' 23:59:59';
			$sql.=" and payment_date<='".$database->filter($endDate)."'";
		}
		
		
	$res=$database->get_results($sql);
	$row=$res[0];
	$income=$row['pharmacy_income'];
	if ($income!="")
	return $row['pharmacy_income'];
	else
	return "0";
	
}

function getGenderName($id)
{
	global $database;
	$sqlCategory="select * from tbl_gender where gender_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['gender_name']!="")
	echo $rowCategory['gender_name'];
	else
	echo "-";
	
	
}


function getMedicineName($id)
{
	global $database;
	$sqlCategory="select * from tbl_medication where med_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['med_title']!="")
	return $rowCategory['med_title'];
	else
	return "-";
	
	
}


function getMedicineName_common($id)
{
	global $database;
	 $sqlCategory="select * from tbl_commonly_bought where med_c_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['med_c_title']!="")
	return $rowCategory['med_c_title'];
	else
	return "-";
	
	
}


function getMedicineId($name)
{
	global $database;
	$sqlCategory="select * from tbl_medication where med_title='".$database->filter($name)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['med_id']!="")
	return $rowCategory['med_id'];
	else
	return "-";
	
	
}

function getMedicineId_common($name)
{
	global $database;
	$sqlCategory="select * from tbl_commonly_bought where med_c_title='".$database->filter($name)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['med_c_id']!="")
	return $rowCategory['med_c_id'];
	else
	return "-";
	
	
}

function getPrescriberName($id)
{
	global $database;
	$sqlCategory="select * from tbl_prescribers where pres_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	
	return $rowCategory['pres_forename']." ".$rowCategory['pres_surname'];
	
	
	
}

function getMedicinePrice($medId, $strength, $pack, $qty, $tier) {
    global $database;
    
    // Fetch the medication pricing details from the database
    $sqlCategory = "SELECT * FROM tbl_medication_pricing 
                    WHERE mp_medicine='" . $database->filter($medId) . "' 
                    AND mp_strength='" . $database->filter($strength) . "' 
                    AND mp_pack_size='" . $database->filter($pack) . "'";
    
    $resCategory = $database->get_results($sqlCategory);
    $rowCategory = $resCategory[0];
    
    if ($tier == "") {    
        $tier = 1;
    }
    
    $tierField = "mp_tier" . $tier . "_price";
    $baseprice = $rowCategory[$tierField];
    $quantity = $qty;
    $medicationCost = $rowCategory['mp_medication_cost'];
    $tier = $_POST['t'];
    $costPrice = $rowCategory['mp_cost_price'];
    $totalCostPrice = $costPrice * $quantity;
    
    if ($totalCostPrice >= 6.5) {
        $medicationCost = $totalCostPrice;
        
        $multipliers = array(1, 0.6, 0.4, 0.3);
        $sumMultipliers = 0;
        
        for ($i = 0; $i < $quantity; $i++) {
            if ($i < count($multipliers)) {
                $sumMultipliers += $multipliers[$i];
            } else {
                $sumMultipliers += $multipliers[count($multipliers) - 1]; // use the last multiplier (0.3) for remaining quantities
            }
        }

        // Adjust base price based on the tier
        if ($tier == 1) $baseprice = 20; 
        else if ($tier == 2) $baseprice = 24; 
        else if ($tier == 3) $baseprice = 28; 
        else if ($tier == 4) $baseprice = 39;

        // Calculate the base cost using the multipliers
        $baseCost = $baseprice * $sumMultipliers;

        // Adjust medication cost if needed
        if ($medicationCost >= 6.5 && $medicationCost <= 8) {
            $medicationCost = 8;
        }

        // Calculate the price to charge
        $priceTocharge = $baseCost + ($medicationCost - 4);
    } else {
        // Calculate price using percentage-based increments
        $percentages = array(0.6, 0.4, 0.3);
        $increment = 0.3;
        $factor = 1;
        
        for ($i = 0; $i < $quantity - 1; $i++) {
            if ($i < count($percentages)) {
                $factor += $percentages[$i];
            } else {
                $factor += $increment;
            }
        }
        
        // Calculate the price
        $priceTocharge = $baseprice * $factor;
    }
    
    return $priceTocharge;
}


function getMedicinePrice_common($id)
{
	global $database;
	$sqlCategory="select med_c_price from tbl_commonly_bought where med_c_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['med_c_price']!="")
	return $rowCategory['med_c_price'];
	else
	return "-";
	
	
}


function getCategoryName_multi($ids)
{
	
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);
		
		foreach ($arrayDcat as $val)
				{											
					$sql = "SELECT * FROM tbl_condition_categories where condition_categories_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];
													
					array_push($arrayDcat_r,$resultCategory['condition_categories_name']);
													//print $resultCategory['category_name'];
				}
			
			return $strDcat=implode(", ",$arrayDcat_r);
}


function getConditionName_multi($ids)
{
	
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);
		
		foreach ($arrayDcat as $val)
				{											
					$sql = "SELECT * FROM tbl_conditions where condition_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];
													
					array_push($arrayDcat_r,$resultCategory['condition_title']);
													//print $resultCategory['category_name'];
				}
			
			return $strDcat=implode(", ",$arrayDcat_r);
}


function getMedicineName_multi($ids)
{
	
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);
		
		foreach ($arrayDcat as $val)
				{											
					$sql = "SELECT * FROM tbl_medication where med_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];
													
					array_push($arrayDcat_r,$resultCategory['med_title']);
													//print $resultCategory['category_name'];
				}
			
			return $strDcat=implode(", ",$arrayDcat_r);
}


function getMedicineName_common_multi($ids,$rType)
{
	
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);
		
		foreach ($arrayDcat as $val)
				{											
					$sql = "SELECT * FROM tbl_commonly_bought where med_c_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];
													
					array_push($arrayDcat_r,$resultCategory['med_c_title']);
													//print $resultCategory['category_name'];
				}
			if ($rType==1)
			return $strDcat=implode(", ",$arrayDcat_r);
			else if ($rType==2)
			return $strDcat=implode("<br>",$arrayDcat_r);
}


function formatTextareaContent($content)
{
	$str=str_replace("\n","<br>",$content);
	
	
	
	return $str;
	
}

function getPrescriptionStatus($status,$pid)
{
	global $database;
		
	if ($status==0)
	$val='<span class="tag tag-grey">Incomplete</span>';
	else if ($status==1)
	$val='<span class="tag tag-blue">Pending</span>';
	else if ($status==2)
	{
		
	$val='<span class="tag tag-orange">Query</span>';
	
		$sqlMesFrom="select * from tbl_messages where message_pres_id='".$pid."' order by message_id desc limit 0,1";
		$resMesFrom=$database->get_results($sqlMesFrom);
		$rowMes=$resMesFrom[0];
		
		if ($_SESSION['sess_prescriber_id']!="")
		{												
			if ($rowMes['message_sender_type']=="Clinician")
			$val.="<br><div style='padding-top:5px'><font style='color:#ff0000'>To be Responsed</font></div>";
			else
			$val.="<br><div><font style='color:#0C3'>Replied</font></div>";
		}
		
	
	}
	else if ($status==3)
	$val='<span class="tag tag-pink">Ready for Collection</span>';
	else if ($status==4)
	$val='<span class="tag tag-red">Rejected</span>';
	else if ($status==5)
	$val='<span class="tag tag-yellow">Cancelled</span>';
	else if ($status==6)
	$val='<span class="tag tag-green">Approved by Clinician</span>';
	else if ($status==7)
	$val='<span style="background-color:#090;color:#fff;padding:7px;font-size:12px">Collected</span>';
	
	return $val;
	
	
	
}

function getPrescriptionStatus_clinician($status,$pid)
{
	
	global $database;
		
	if ($status==1)
	$val='<span class="tag tag-blue">Pending</span>';
	else if ($status==2)
	{
	$val='<span class="tag tag-orange">Query</span>';	
	
			$sqlMesFrom="select pres_patient_query_status from tbl_prescriptions where pres_id='".$pid."' order by pres_id";
			$resMesFrom=$database->get_results($sqlMesFrom);
			$rowMes=$resMesFrom[0];
	
			if ($rowMes['pres_patient_query_status']=="0")
			$val.="<br><div style='padding-top:5px'><font style='color:orange'>Response awaited</font></div>";
			else
			$val.="<br><div><font style='color:#ff0000'>Action required</font></div>";
	
	
	 	/*$sqlMesFrom="select * from tbl_messages where message_pres_id='".$pid."' order by message_id desc limit 0,1";
		$resMesFrom=$database->get_results($sqlMesFrom);
		$rowMes=$resMesFrom[0];
																
			if ($rowMes['message_sender_type']=="Clinician")
			$val.="<br><div style='padding-top:5px'><font style='color:orange'>Response awaited</font></div>";
			else
			$val.="<br><div><font style='color:#ff0000'>Action required</font></div>";*/
	}
	else if ($status==4)
	$val='<span class="tag tag-red">Rejected</span>';
	else if ($status==5)
	$val='<span class="tag tag-yellow">Cancelled</span>';
	else if ($status==3 || $status==6)
	$val='<span class="tag tag-green">Approved</span>';
	
	return $val;
	
	
	
}

function getPrescriptionStatus_pharmacy($status)
{
		
	if ($status==1)
	$val='<span class="tag tag-blue">To Process</span>';
	else if ($status==2)
	$val='<span class="tag tag-orange">Query</span>';	
	
	else if ($status==4)
	$val='<span class="tag tag-yellow">Cancellation Requested</span>';

	else if ($status==3)
	$val='<span class="tag tag-pink">Ready for Collection</span>';
	
	else if ($status==5)
	$val='<span class="tag tag-green">Collected</span>';
	
	
	
	return $val;
	
	
	
}

function getPrescriptionStatus_pharmacy_plain($status)
{
		
	if ($status==1)
	$val='To Process';
	else if ($status==2)
	$val='Query';	
	
	else if ($status==4)
	$val='Cancellation Requested';

	else if ($status==3)
	$val='Ready for Collection';
	
	else if ($status==5)
	$val='Collected';
	
	
	
	return $val;
	
	
	
}

function getTitleName($id)
{
	global $database;
	$sqlCategory="select * from tbl_titles where title_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['title_name']!="")
	return $rowCategory['title_name'];
	else
	return "-";
	
	
}
function getProfName($id)
{
	global $database;
	$sqlCategory="select * from tbl_professions where prof_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['prof_title']!="")
	return $rowCategory['prof_title'];
	else
	return "-";
}

function getGhpCRegNo($id)
{
	global $database;
	$sqlCategory="select * from tbl_prescribers where pres_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	$regNum="-";
	
	if ($rowCategory['pres_profession']==1 && $rowCategory['pres_gmc_reg_number']!="") $regNum=$rowCategory['pres_gmc_reg_number'];
	else if ($rowCategory['pres_profession']==2 && $rowCategory['pres_gphc_reg_number']!="") $regNum=$rowCategory['pres_gphc_reg_number'];
	else if ($rowCategory['pres_profession']==3 && $rowCategory['pres_nmc_reg_number']!="") $regNum=$rowCategory['pres_nmc_reg_number'];
	
	/*if ($rowCategory['pres_gphc_reg_number']!="")
	return $rowCategory['pres_gphc_reg_number'];*/
	return $regNum;
	
}

function fn_formatDateTime($datetime) {
    $now = new DateTime();
    $inputDateTime = new DateTime($datetime);

    // Calculate the difference in hours and minutes
    $diff = $now->diff($inputDateTime);
    $hours = $diff->h + ($diff->days * 24);
    $minutes = $diff->i;

    if ($hours <= 24) {
        if ($hours < 1) {
            // Return time in minutes
            return $minutes . ' minutes ago';
        } else {
            // Return time in hours
            return $hours . ' hours ago';
        }
    } elseif ($hours <= 48) {
        // Return "Yesterday"
        return 'Yesterday';
    } else {
        // Return the date
        return $inputDateTime->format('d-m-Y');
    }
}




function fntimeDifference($date) {
    $currentDate = new DateTime();
    $inputDate = new DateTime($date);
    $interval = $currentDate->diff($inputDate);

    if ($interval->y > 0) {
        return $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
    } elseif ($interval->m > 0) {
        return $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
    } elseif ($interval->d > 0) {
        return $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
    } elseif ($interval->h > 0) {
        return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '');
    } elseif ($interval->i > 0) {
        return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '');
    } else {
        return $interval->s . ' second' . ($interval->s > 1 ? 's' : '');
    }
}

// Example usage





function changeReadStatus($id)
{
	global $database;
	$sqlCategory="update tbl_messages set message_read_status=1 where message_id='".$database->filter($id)."'";
	
	$database->query($sqlCategory);
	
}

function changeReadStatus2($id)
{
	global $database;
	$sqlCategory="update tbl_tickets set message_read_status=1 where message_id='".$database->filter($id)."'";
	
	$database->query($sqlCategory);
	
}
function changeReadStatus2_admin($id)
{
	global $database;
	$sqlCategory="update tbl_tickets set message_read_status_admin=1 where message_id='".$database->filter($id)."'";
	
	$database->query($sqlCategory);
	
}


function getPresAction($pid,$uid,$utype,$action)
{
	global $database;
	
	$curDate=date("Y-m-d H:i:s");
	
	$names = array(
				'pa_user_type' => $utype,
				'pa_pres_id' => $pid, 
				'pa_user_id' => $uid, 
				'pa_action_details' => $action, 
				'pa_date_time' => $curDate			
				
				);

				$add_query = $database->insert( 'tbl_prescriptions_actions', $names );
	
	
	if ($utype=="patient")
	{
		
		$sql="select * from tbl_prescriptions where pres_id='".$database->filter($pid)."' and pres_patient_query_status=0";
		$res=$database->get_results($sql);
		if (count($res)>0)
		{
			$row=$res[0];
		
		 $sql="update tbl_prescriptions set
		 pres_patient_query_status=1,
		 pres_patient_query_date='".$curDate."'
		 where pres_id='".$database->filter($pid)."'";
		 
		 $database->query($sql);
		}
		  
		
	}
	
	if ($utype=="clinician")
	{
		
		
		 $sql="select * from tbl_prescriptions where pres_id='".$database->filter($pid)."'";
		$res=$database->get_results($sql);
		
		if (count($res)>0)
		{
			$row=$res[0];
			$presAssigned=$row['pres_prescriber'];
			
			if ($presAssigned==0)
			{
				
				
				 $sqlCategory="update tbl_prescriptions set pres_prescriber='".$uid."' where pres_id='".$database->filter($pid)."'";
				$database->query($sqlCategory);
				
				
			}
			else
			{
				$numbersArray = explode(",", $presAssigned);	
						
				if (!in_array($uid, $numbersArray))
				 {	
				 
				 
				 	array_push($numbersArray,$uid);	
					$strPres=implode(",",$numbersArray);	
					
					
				$sqlCategory="update tbl_prescriptions set pres_prescriber='".$strPres."' where pres_id='".$database->filter($pid)."'";
				$database->query($sqlCategory);		
					
				}
				
				
			}
			
			//-------- Changing patient status back to responded----
			
			 $sql="update tbl_prescriptions set
			 pres_patient_query_status=0
			 where pres_id='".$database->filter($pid)."'";
			 
			 $database->query($sql);
			
			//--------end changing patient status
		}
		
	}
	
	
	
	
}

function getUserNameByType($type,$id)
{
	global $database;
	if ($type=="patient")
	{
		$sqlCategory="select * from tbl_patients where patient_id='".$database->filter($id)."'";
		$loadCategory=$database->get_results($sqlCategory);
		$rowCategory=$loadCategory[0];
		$name=$rowCategory['patient_first_name']." ".$rowCategory['patient_last_name'];
		
	}
	else if ($type=="clinician")
	{
		
		$sqlCategory="select * from tbl_prescribers where pres_id='".$database->filter($id)."'";
		$loadCategory=$database->get_results($sqlCategory);
		$rowCategory=$loadCategory[0];
		$name=$rowCategory['pres_forename']." ".$rowCategory['pres_surname'];
	}
	
	else if ($type=="pharmacy")
	{
		
		$sqlCategory="select * from tbl_pharmacies where pharmacy_id='".$database->filter($id)."'";
		$loadCategory=$database->get_results($sqlCategory);
		$rowCategory=$loadCategory[0];
		$name=$rowCategory['pharmacy_name'];
	}
	
	return $name;
	
	
	
}

function getClincianNameWithTitle($id)
{
	global $database;
	
	$sqlClinician="select * from tbl_prescribers where pres_id='".$database->filter($id)."'";
	$resClinician=$database->get_results($sqlClinician);
	$rowClinician=$resClinician[0];
	return $clinicianName=getTitleName($rowClinician['pres_title'])." ".$rowClinician['pres_forename']." ".$rowClinician['pres_surname'];
}

function formatLondonPostcode($postcode) {
   // Remove any existing spaces
    $postcode = str_replace(' ', '', $postcode);

    // Check if the postcode is valid (5 or 6 continuous digits)
    //if (preg_match('/^\d{5,6}$/', $postcode)) {
        // Add a space in the middle (if it's a 6-digit postcode)
        if (strlen($postcode) === 6) {
            $formattedPostcode = substr($postcode, 0, -3) . ' ' . substr($postcode, -3);
        } else if (strlen($postcode) === 5) {
            $formattedPostcode = substr($postcode, 0, -2) . ' ' . substr($postcode, -3); }
		else {
            $formattedPostcode = $postcode;
        }
        return $formattedPostcode;
   // } else {
        // Not a valid London postcode
       // return "Invalid postcode";
    //}
}




function getOverDueTotal()

	{

		global $database;
		$sql = "select count(*) as ctr from tbl_prescriptions where (pres_stage=1 && pres_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) || (pres_stage=2 and pres_patient_query_status=1 && pres_patient_query_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) ))";
		$res=$database->get_results($sql);
		$total=$res[0]['ctr'];
		return $total;

	}	
	


function createLogs($uid,$utype,$action)
{
	global $database;
	
	$curDate=date("Y-m-d H:i:s");
	
	$names = array(
				'log_user_type' => $utype,
				'log_user_id' => $uid, 
				'log_activity' => $action, 
				'log_date_time' => $curDate			
				
				);

				$add_query = $database->insert( 'tbl_logs', $names );
	

	
}

function changeMedication($pid)
{
	global $database;
	$sqlCkChgReq="select * from tbl_prescription_medicine_change_requests where pm_pres_id='".$database->filter($pid)."'";
	$resCkChgReq=$database->get_results($sqlCkChgReq);
	
	
	if (count($resCkChgReq)==0)
	{
		$sqlCkChgReq="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($pid)."'";
		$resCkChgReq=$database->get_results($sqlCkChgReq);
		
		for ($j=0;$j<count($resCkChgReq);$j++)
		{
			$rowCkChgReq=$resCkChgReq[$j];
			
			$names = array(
			'pm_pres_id' => $rowCkChgReq['pm_pres_id'],
			'pm_med' => $rowCkChgReq['pm_med'],
			'pm_med_price' => $rowCkChgReq['pm_med_price'],
			'pm_med_qty' => $rowCkChgReq['pm_med_qty'],
			'pm_med_packsize' => $rowCkChgReq['pm_med_packsize'],
			'pm_med_dosage' => $rowCkChgReq['pm_med_dosage'],
			'pm_med_strength' => $rowCkChgReq['pm_med_strength'],
			'pm_med_total' => $rowCkChgReq['pm_med_total']
			
			);
			$add_query = $database->insert('tbl_prescription_medicine_change_requests', $names );
			
		}
		
	}
}

function findNearbyPostcodes($latitude,$longitude, $radius) {
    // Connect to MySQL database
    global $database;
	
	
	
	if ($latitude!="" & $longitude!="")
	{

    // Define Haversine formula query
    $sql = "SELECT id, postcode, latitude, longitude,
            (3959 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) AS distance
            FROM tbl_postcodes
            HAVING distance <= $radius
            ORDER BY distance";

    // Execute the query
    $result = $database->get_results($sql);
	

    // Check if there are any results
    if (count($result) > 0) {
        // Array to store nearby postcodes
        $nearbyPostcodes = array();

        // Fetch rows from the result set
       for ($i=0;$i<count($result);$i++)
	    {
			$row=$result[$i];
            $nearbyPostcodes[] = $row['postcode'];
			
        }

        // Close database connection
       

        // Return nearby postcodes
        return $nearbyPostcodes;
    } else {
        // Close database connection
       
        
        // Return empty array if no nearby postcodes found
        return array();
    }
	}
	else
	 return array();
	
}


function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 3959) {
    // Convert latitude and longitude from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    // Haversine formula
    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $a = sin($latDelta / 2) * sin($latDelta / 2) +
         cos($latFrom) * cos($latTo) *
         sin($lonDelta / 2) * sin($lonDelta / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Calculate the distance
    $distance = $earthRadius * $c;
	
	$distance=round($distance,2);

    return $distance; // Distance in miles
}





function getCoordinates($postcode) {
    // Replace 'YOUR_API_KEY' with your actual Google Maps API key
    $apiKey = GOOGLE_MAP_KEY;
    
    // Format the postcode for the API request
    $formattedPostcode = urlencode($postcode);
    
    // API endpoint URL
    $apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=$formattedPostcode&key=$apiKey";
    
    // Make the API request
    $response = file_get_contents($apiUrl);
    
    // Decode the JSON response
    $data = json_decode($response, true);
    
    // Check if the response contains results
    if ($data['status'] == 'OK' && isset($data['results'][0])) {
        // Extract latitude and longitude from the first result
        $latitude = $data['results'][0]['geometry']['location']['lat'];
        $longitude = $data['results'][0]['geometry']['location']['lng'];
        
        // Return latitude and longitude
        return array('latitude' => $latitude, 'longitude' => $longitude);
    } else {
        // Return null if no results found or if there was an error
        return null;
    }
}

function updateSessionLog($sessId,$userId)
{
	global $database;
	
	$sqlCheck="select cs_id from tbl_clinician_sessions where cs_session_id='".$database->filter($sessId)."' and cs_user_id='".$database->filter($userId)."'";
	$resCheck=$database->get_results($sqlCheck);
	
	if (count($resCheck)==0)
	{
		$curDate=date("Y-m-d H:i:s");
	
		$names = array(
				'cs_login' => $curDate,
				'cs_last_activity' => $curDate, 
				'cs_user_id' => $userId, 
				'cs_session_id' => $sessId
							
				
				);

		$add_query = $database->insert( 'tbl_clinician_sessions', $names );
	} else {
		
		$curDate=date("Y-m-d H:i:s");
		
		 $sql="update tbl_clinician_sessions set
		 cs_last_activity='".$curDate."' where		
		 cs_session_id='".$database->filter($sessId)."' and cs_user_id='".$userId."'";
		 
		 $database->query($sql);
		
		
	}
	
}


function getUserActivityDuration($month, $year, $userId) {
    global $database;

    // Prepare the start and end dates for the specified month and year
    $startDate = "$year-$month-01 00:00:00";
    $endDate = date("Y-m-t 23:59:59", strtotime($startDate)); // t gives the last day of the month

    // Query to get the login and logout times for the specified month and user
    $sql = "
        SELECT cs_login, cs_last_activity 
        FROM tbl_clinician_sessions 
        WHERE cs_user_id = '" . $database->filter($userId) . "' 
        AND cs_login BETWEEN '" . $database->filter($startDate) . "' AND '" . $database->filter($endDate) . "'
    ";

    // Execute the query
    $res = $database->get_results($sql);

    $totalSeconds = 0;

    // Iterate through the results and calculate the time spent for each session
    foreach ($res as $row) {
        $loginTime = new DateTime($row['cs_login']);
        $logoutTime = new DateTime($row['cs_last_activity']);
        $interval = $logoutTime->diff($loginTime);
        $totalSeconds += $interval->h * 3600;
        $totalSeconds += $interval->i * 60;
        $totalSeconds += $interval->s;
    }

    // Calculate total hours and minutes
    $totalHours = floor($totalSeconds / 3600);
    $totalMinutes = floor(($totalSeconds % 3600) / 60);

	if ($totalHours>0)
    return $totalHours." hours ".$totalMinutes." mins";
	else if ($totalMinutes>0)
	return $totalMinutes." mins";
	else
	return "-";
	
}



function getTimeSpent($timeFrame,$id='',$month='',$year='') {
    global $database;

    // Determine the date range based on the time frame
    $startDate = '';
    $endDate = date("Y-m-d H:i:s");

    switch ($timeFrame) {
        case 'today':
            $startDate = date("Y-m-d 00:00:00");
            break;
        case 'yesterday':
            $startDate = date("Y-m-d 00:00:00", strtotime("-1 day"));
            $endDate = date("Y-m-d 23:59:59", strtotime("-1 day"));
            break;
		case 'this_week':
		// Calculate the start of the week (Monday)
		$startDate = date("Y-m-d 00:00:00", strtotime('last monday', strtotime('tomorrow')));
		// Calculate the end of the week (Sunday)
		$endDate = date("Y-m-d 23:59:59", strtotime('next sunday', strtotime('yesterday')));
		break;
        case 'this_month':
            $startDate = date("Y-m-01 00:00:00");
            break;
		
		case 'specific_month_year':
		
        // Assuming $month and $year are defined and passed as parameters
        $startDate = date("Y-m-01 00:00:00", strtotime("$year-$month-01"));
        $endDate = date("Y-m-t 23:59:59", strtotime("$year-$month-01"));
        break;
		
        default:
            return 0; // Invalid time frame
    }

    // Query to get the login and logout times within the specified date range
    $sql = "
        SELECT cs_login, cs_last_activity 
        FROM tbl_clinician_sessions 
        WHERE cs_login BETWEEN '" . $database->filter($startDate) . "' AND '" . $database->filter($endDate) . "'
    ";
	
	if ($id!="")
	$sql.=" and cs_user_id='".$database->filter($id)."'";

    // Execute the query
    $res = $database->get_results($sql);

    $totalSeconds = 0;

    // Iterate through the results and calculate the time spent for each session
    foreach ($res as $row) {
        $loginTime = new DateTime($row['cs_login']);
        $logoutTime = new DateTime($row['cs_last_activity']);
        $interval = $logoutTime->diff($loginTime);
        $totalSeconds += $interval->h * 3600;
        $totalSeconds += $interval->i * 60;
        $totalSeconds += $interval->s;
    }

    // Calculate total hours and minutes
    $totalHours = floor($totalSeconds / 3600);
    $totalMinutes = floor(($totalSeconds % 3600) / 60);

    if ($totalHours>0)
    return $totalHours." hours ".$totalMinutes." mins";
	else
	return $totalMinutes." mins";
}

function CalTimeSpent($start,$end)
{
		$loginTime = new DateTime($start);
        $logoutTime = new DateTime($end);
        $interval = $logoutTime->diff($loginTime);
        $totalSeconds += $interval->h * 3600;
        $totalSeconds += $interval->i * 60;
        $totalSeconds += $interval->s;
		
	$totalHours = floor($totalSeconds / 3600);
    $totalMinutes = floor(($totalSeconds % 3600) / 60);

    if ($totalHours>0)
    return $totalHours." hours ".$totalMinutes." mins";
	else
	return $totalMinutes." mins";
}


function getOrderPrice($presId)
{
	
	global $database;
	
	$sql="select * from tbl_payments where payment_pres_id='".$database->filter($presId)."'";
	$res=$database->get_results($sql);
	$row=$res[0];
	$priceCharged=$row['payment_amount'];
	
	return $priceCharged;
	
	
}

function getTotalPayment()
{
	
	global $database;
	
	$sql="select sum(payment_amount) as totalRevenue from tbl_payments";
	$res=$database->get_results($sql);
	$row=$res[0];
	$revenue=$row['totalRevenue'];
	
	return $revenue;
	
	
}

function getTotalProfit()
{
	
	global $database;
	
	$sql="select sum(payment_pharma_profit) as totalProfit from tbl_payments where payment_status=1";
	$res=$database->get_results($sql);
	$row=$res[0];
	$profit=$row['totalProfit'];
	
	return $profit;
	
	
}

function getPaymentStats($type,$subtype)
{
    global $database;
    
    $currentDate = date('Y-m-d');
    $revenue = 0;
	
	if ($subtype=="payment")
	$fieldName="payment_amount";
	else if ($subtype=="profit")
	$fieldName="payment_pharma_profit";
    
    switch ($type) {
        case 1:
            $sql = "SELECT SUM(".$fieldName.") AS totalRevenue 
                    FROM tbl_payments 
                    WHERE DATE(payment_date) = '$currentDate'";
					
					if ($subtype=="profit")
					$sql.=" and payment_status = 1 ";
                  
					
            break;
            
        case 2:
            $dateAgo = date('Y-m-d', strtotime('-7 days'));
            $sql = "SELECT SUM(".$fieldName.") AS totalRevenue 
                    FROM tbl_payments 
                    WHERE DATE(payment_date) BETWEEN '$dateAgo' AND '$currentDate'";
					
					if ($subtype=="profit")
					$sql.=" and payment_status = 1 ";
            break;
            
        case 3:
            $dateAgo = date('Y-m-d', strtotime('-30 days'));
            $sql = "SELECT SUM(".$fieldName.") AS totalRevenue 
                    FROM tbl_payments 
                    WHERE DATE(payment_date) BETWEEN '$dateAgo' AND '$currentDate'";
					
					if ($subtype=="profit")
					$sql.=" and payment_status = 1 ";
					
            break;
            
        case 4:
            $sql = "SELECT SUM(".$fieldName.") AS totalRevenue
                    FROM tbl_payments
                    WHERE MONTH(payment_date) = MONTH(CURRENT_DATE())
                    AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
					
					if ($subtype=="profit")
					$sql.=" and payment_status = 1 ";
            break;
            
        case 5:
            $sql = "SELECT SUM(".$fieldName.") AS totalRevenue
                    FROM tbl_payments
                    WHERE payment_date >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)
                    AND payment_date < DATE_SUB(CURRENT_DATE(), INTERVAL DAY(CURRENT_DATE())-1 DAY)";
					
					if ($subtype=="profit")
					$sql.=" and payment_status = 1 ";
            break;
            
        default:
            return $revenue; // If type doesn't match any case, return 0
    }
    
    $res = $database->get_results($sql);
    if (!empty($res)) {
        $row = $res[0];
        $revenue = $row['totalRevenue'];
    }
    
    return $revenue ? $revenue : 0;
}

function pharmacySale($pid,$type)
{
	 global $database;
	 $currentDate = date('Y-m-d');
	 
	  switch ($type) {
        case 1:
            $sql = "SELECT SUM(payment_pharma_profit)+SUM(payment_medication_cost) AS totalRevenue 
                    FROM tbl_payments 
                    WHERE DATE(payment_date) = '$currentDate'";
					
			
            break;
		
		case 2: // This month
        $startDate = date('Y-m-01'); // First day of the current month
        $endDate = date('Y-m-t'); // Last day of the current month
        $sql = "SELECT SUM(payment_pharma_profit) + SUM(payment_medication_cost) AS totalRevenue 
                FROM tbl_payments 
                WHERE DATE(payment_date) BETWEEN '$startDate' AND '$endDate'";
        break;

    	case 3: // Last month
        $startDate = date('Y-m-01', strtotime('first day of last month')); // First day of the last month
        $endDate = date('Y-m-t', strtotime('last day of last month')); // Last day of the last month
        $sql = "SELECT SUM(payment_pharma_profit) + SUM(payment_medication_cost) AS totalRevenue 
                FROM tbl_payments 
                WHERE DATE(payment_date) BETWEEN '$startDate' AND '$endDate'";
        break;
		
		 case 4: // This year
            $startDate = date('Y-01-01'); // First day of the current year
            $endDate = date('Y-12-31'); // Last day of the current year
            $sql = "SELECT SUM(payment_pharma_profit) + SUM(payment_medication_cost) AS totalRevenue 
                    FROM tbl_payments 
                    WHERE DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
            break;
		
	  }
	  
	  
	   $res = $database->get_results($sql);
		if (!empty($res)) {
			$row = $res[0];
			$revenue = $row['totalRevenue'];
		}
    
   		 return $revenue ? $revenue : 0;
	  
	 
}


function getPatientCount($type)
{
    global $database;
    
    $currentDate = date('Y-m-d');   
    
    switch ($type) {
        case 1:
            $sql = "SELECT count(patient_id) AS totalPatient 
                    FROM tbl_patients 
                    WHERE DATE(patient_registered_date) = '$currentDate'";
				
            break;
            
        case 2:
            $dateAgo = date('Y-m-d', strtotime('-7 days'));
            $sql = "SELECT count(patient_id) AS totalPatient 
                    FROM tbl_patients 
                    WHERE DATE(patient_registered_date) BETWEEN '$dateAgo' AND '$currentDate'";				
					
            break;
            
        case 3:
            $dateAgo = date('Y-m-d', strtotime('-30 days'));
            $sql = "SELECT count(patient_id) AS totalPatient 
                    FROM tbl_patients 
                    WHERE DATE(patient_registered_date) BETWEEN '$dateAgo' AND '$currentDate'";
			
					
            break;
            
        case 4:
            $sql = "SELECT count(patient_id) AS totalPatient
                    FROM tbl_patients";
					
					
            break;
            
       
            
        default:
            return "0"; // If type doesn't match any case, return 0
    }
    
    $res = $database->get_results($sql);
    if (!empty($res)) {
        $row = $res[0];
        $totalPatients = $row['totalPatient'];
    }
    
    return $totalPatients ? $totalPatients : 0;
}

function getClinicianCount($type)
{
    global $database;
    
    $currentDate = date('Y-m-d');   
    
    switch ($type) {
        case 1:
            $sql = "SELECT count(pres_id) AS totalClinician 
                    FROM tbl_prescribers 
                    where pres_approve=1";
				
            break;
		
		 case 2:
		 	 $dateAgo = date('Y-m-d', strtotime('-30 days'));
            $sql = "SELECT count(pres_id) AS totalClinician 
                    FROM tbl_prescribers 
                    where pres_approve=1
					and DATE(pres_registered_on) BETWEEN '$dateAgo' AND '$currentDate'
					";
				
            break;
	 default:
            return "0"; // If type doesn't match any case, return 0
    }
    
    $res = $database->get_results($sql);
    if (!empty($res)) {
        $row = $res[0];
        $totalClinician = $row['totalClinician'];
    }
    
    return $totalClinician ? $totalClinician : 0;
	}



function calculatePrice($basePrice, $quantity) {
    // Initial percentages
	
	
    $percentages = array(0.6, 0.4, 0.3);
    $increment = 0.3;

    // Calculate the total factor
    $factor = 1;
    for ($i = 0; $i < $quantity - 1; $i++) {
        if ($i < count($percentages)) {
            $factor += $percentages[$i];
        } else {
            $factor += $increment;
        }
    }


	


    // Calculate the price
    $price = $basePrice * $factor;
	
	$saving=($basePrice*$quantity)-$price;
	
	if ($saving==0)
    return formatToTens($price);
	else
	return formatToTens($price)." <font style='color:red;font-size:17px'>Save ".CURRENCY.$saving."</font>";
	
	
}

function calculatePrice_plus($quantity, $medicationCost, $tier,$costPrice) {
    // Initialize the multipliers
    $multipliers = array(1, 0.6, 0.4, 0.3);

    // Determine base price based on the tier
    if ($tier == 1) {
        $baseprice = 20;
    } else if ($tier == 2) {
        $baseprice = 24;
    } else if ($tier == 3) {
        $baseprice = 28;
    } else if ($tier == 4) {
        $baseprice = 39;
    }

    // Calculate price for quantity = 1
    // First multiplier is always used for quantity = 1

    // Calculate the sum of multipliers for the provided quantity
    $sumMultipliers = 0;
    for ($i = 0; $i < $quantity; $i++) {
        if ($i < count($multipliers)) {
            $sumMultipliers += $multipliers[$i];
        } else {
            $sumMultipliers += $multipliers[count($multipliers) - 1]; // Use the last multiplier (0.3) for remaining quantities
        }
    }

    // Calculate the base cost using the multipliers
    $baseCost = $baseprice * $sumMultipliers;
	
	//---Calculate price for one-----
	
	
	 $priceForOneBaseCost = $baseprice * $multipliers[0];
	
	 if ($costPrice<=10)
	 $costPrice=8;
		 
	 
	 $priceForOne = formatToTens($priceForOneBaseCost + ($costPrice - 4), 2);
	 
	
	 
	 
	  if ($medicationCost >= 6.5 && $medicationCost <= 10) {
        $medicationCost = 8;
    }
	
	
	
	//-----end calculate price for one--

    // Adjust medication cost if within specific range
    if ($medicationCost >= 6.5 && $medicationCost <= 10) {
        $medicationCost = 8;
    }
	
	
	

    // Calculate the total cost
    $totalCost = formatToTens($baseCost + ($medicationCost - 4), 2);
	
	
   // $saving=$baseCost-$baseprice;
	
	$saving = $priceForOne * $quantity - $totalCost;
	
	if ($saving==0)
    return $totalCost;
	else
	return $totalCost." <font style='color:red;font-size:17px'>Save ".CURRENCY.$saving."</font>";
}

function calculatePriceOveride($basePrice, $targetTier) {
    
	if ($targetTier==2)
	$currentPrice=$basePrice+4;
	else if ($targetTier==3)
	$currentPrice=$basePrice+8;


    // Return the calculated price, rounded to 2 decimal places
    return formatToTens($currentPrice, 2);
}

function getMedicationStringWithInfo($presid)
{
	global $database;
	
	$medStr="";
	$commonHeading=0;
	
	$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($presid)."'";
	$resMedicine=$database->get_results($sqlMedicine);
	for ($m=0;$m<count($resMedicine);$m++)
		{
			$rowMedicine=$resMedicine[$m];
			if ($rowMedicine['pm_med_common']==0)
			$medStr.=$rowMedicine['pm_med']."  ".$rowMedicine['pm_med_strength'].", <br>(Pack Qty: ".$rowMedicine['pm_med_qty'].", Pack size: ".$rowMedicine['pm_med_packsize'].")";
			else
			{
			if ($commonHeading==0)
			{
				$medStr.="<br><u><strong>Commonly Bought Medications</strong></u><br>";
				$commonHeading=1;
			}
			
			$medStr.=$rowMedicine['pm_med'].", <br>(Pack Qty: ".$rowMedicine['pm_med_qty'].")";
			}
			
			
			$medStr.="<br>";
						                               
         } 
	
	return $medStr;
	
	
		 
		 
}

function getMedicationStringWithInfo_table($presid,$priceHide=0)
{
	global $database;
	
		
	$medStr='<div class="table-responsive">
	
											<table class="table border-top" style="background:#fff; width:95%; margin:auto; border:1px solid #d9d9d9; margin-bottom:15px">
												<thead style="padding-left:20px">
                                                
													<tr>
														<th>Medication</th>
														<th>Strength</th>
														<th>Quantity</th>
														<th>Pack Size</th>';
                                                      
													  if ($priceHide==0)
													$medStr.='<th>Price</th>';
                                                        
                                                      $medStr.=' <th></th>
                                                        <th></th>
													</tr>
												</thead>
												<tbody style="padding-left:20px">';
												 $commonHeading=0;
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($presid)."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
												if ($rowMedicine['pm_med_common']==0)
												{
																	
												 $medStr.='<tr>
														<th scope="row">'.$rowMedicine['pm_med'].'</th>';
														$medStr.='<td>'.$rowMedicine['pm_med_strength'].'</td>';
														$medStr.='<td>'.$rowMedicine['pm_med_qty'].'</td>';
														$medStr.='<td>'.$rowMedicine['pm_med_packsize'].'</td>';
														if ($priceHide==0)														
														$medStr.='<td>'.CURRENCY.$rowMedicine['pm_med_price'].'</td>
                                                       
													</tr>';
													
                                               
                                                }
												else
												{ 
													if ($commonHeading==0)
													{		
												$medStr.='<tr><td colspan="4"><h6 style="color:#00F">Commonly Bought Medication</h6></td></tr>';
                                                     
													$commonHeading=1;
													} 
													$medStr.='<tr>
														<th scope="row">'.$rowMedicine['pm_med'].'</th>';
														$medStr.='<td></td>';
														$medStr.='<td>'.$rowMedicine['pm_med_qty'].'</td>';
														$medStr.='<td></td>';	
														if ($priceHide==0)													
														$medStr.='<td>'.CURRENCY.$rowMedicine['pm_med_price'].'</td>
                                                       
													</tr>';
												 }
												}
                                               
                                               
												$medStr.='</tbody>
											</table>
                                            
                                            
                                           
										</div>';
										return $medStr;
		 
		 
}

function getMedicineFromPrice($medId)
{
	
	global $database;
	
	
	
	$sqlMedicine="select * from tbl_medication_pricing where mp_medicine='".$database->filter($medId)."' and mp_quantity=1 order by mp_id limit 0,1";
	$resMedicine=$database->get_results($sqlMedicine);
	$rowMedicine=$resMedicine[0];
	
	$tier=1;
	$tierField="mp_tier".$tier."_price";
	$baseprice=$rowMedicine[$tierField];
	$medicationCost=$rowCategory['mp_medication_cost'];
	
	$quantity=1;
	$costPrice=$rowMedicine['mp_cost_price'];
	$totalCostPrice=$costPrice*$quantity;
	
	if ($totalCostPrice>=6.5)
		{
		$medicationCost=$totalCostPrice;	
		$priceTocharge=calculatePrice_plus($quantity,$medicationCost, $tier,$costPrice);
	}
	else
	$priceTocharge=calculatePrice($baseprice, $quantity);
	
	return $priceTocharge;
}

function fnPatientAddressStr($address1,$address2,$city,$postcode)
{
	
	
	$address=$address1;
	if ($address2!="")
	$address.=", ".$address2;
	$address.=", <br>".$city;
	return $address.=", ".$postcode;
															
}

function fnPharmacyAddressStr($address1,$address2,$city,$postcode)
{
	
	
	$address=$address1;
	if ($address2!="")
	$address.=", ".$address2;
	$address.=", <br>".$city;
	return $address.=", ".$postcode;
															
}





function encryptId($id) {
    $encryption_key = base64_decode(ENCRYPTION_KEY);  // Decode the encryption key
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));  // Generate a random IV

    // Encrypt the data
    $encrypted = openssl_encrypt($id, 'aes-256-cbc', $encryption_key, 0, $iv);

    // Return the encrypted data combined with the IV, properly encoded
    return base64_encode($encrypted . '::' . base64_encode($iv));  // Encode IV as well
}

function decryptId($encryptedId) {
    $encryption_key = base64_decode(ENCRYPTION_KEY);  // Decode the encryption key

    // Split the encrypted data and the IV
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($encryptedId), 2), 2, null);

    // Decode the IV from base64 to ensure it's properly retrieved
    $iv = base64_decode($iv);

    // Ensure IV is 16 bytes long
    if (strlen($iv) !== 16) {
        return false;  // Handle error or return false if the IV is invalid
    }

    // Decrypt the data and return the result
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}



function formatToTens($number) {
    // Check if the number is a whole number or has a decimal part
    return ($number == round($number)) ? number_format($number, 0) : number_format($number, 2, '.', '');
}




?>