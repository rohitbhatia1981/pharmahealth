<?php
function getProductPrice($menuId)
	{
		global $database;
		$menuPrice=$database->get_row("select * from tbl_prices where price_product_id='".$database->filter($menuId)."' order by price_value asc limit 0,1");
		return $menuPrice[3];
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
	return number_format($row['totalSales']);
	
	
	
	
	
	
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

function getDistance($addressFrom, $addressTo, $unit = ''){
    // Google API key
    $apiKey = 'AIzaSyCPAlbyd1hILtm5kAbqCXnF-4JHOpAKpx4';
    
    // Change address format
    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo     = str_replace(' ', '+', $addressTo);
    
    // Geocoding API request with start address
    $geocodeFrom = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
    $outputFrom = json_decode($geocodeFrom);
    if(!empty($outputFrom->error_message)){
        return $outputFrom->error_message;
    }
    
    // Geocoding API request with end address
    $geocodeTo = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
    $outputTo = json_decode($geocodeTo);
    if(!empty($outputTo->error_message)){
        return $outputTo->error_message;
    }
    
    // Get latitude and longitude from the geodata
    $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
    
    // Calculate distance between latitude and longitude
    $theta    = $longitudeFrom - $longitudeTo;
    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $miles    = $dist * 60 * 1.1515;
    
    // Convert unit and return distance
    $unit = strtoupper($unit);
    if($unit == "K"){
        return round($miles * 1.609344, 2).' km';
    }elseif($unit == "M"){
        return round($miles * 1609.344, 2).' meters';
    }else{
        return round($miles, 2).' miles';
    }
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


function getDistrictId($name)
{
	
	global $database;
	$sql="select * from tbl_districts where district_name like '%".$database->filter(trim($name))."%'";
	$load=$database->get_results($sql);
	$row=$load[0];
	
	if ($row['district_id']!="")
	return $row['district_id'];
	else
	echo "-";
}

function getBlockId($distId)
{
	
	global $database;
	$sql="select * from tbl_districts where district_id='".$database->filter(trim($distId))."'";
	$load=$database->get_results($sql);
	$row=$load[0];
	
	if ($row['district_block_id']!="")
	return $row['district_block_id'];
	else
	return "-";
}


function getTotalPermits($issued=0)
{
	
	global $database;
	$sql="select count(k_id) as ctr_k from tbl_k_form";	
	if ($issued==1)
	$sql.=" where k_status=4";	
	else if ($issued==2)
	$sql.=" where k_status<>4";	
	
	$load=$database->get_results($sql);
	$row=$load[0];
	$ctrK=$row['ctr_k'];
	
	
	
	$sql1="select count(k1_id) as ctr_k1 from tbl_k1_form";	
	if ($issued==1)
	$sql1.=" where k1_status=4";
	else if ($issued==2)
	$sql1.=" where k1_status<>4";
		
	$load1=$database->get_results($sql1);
	$row1=$load1[0];
	$ctrK1=$row1['ctr_k1'];
	
	
	
	$sql2="select count(k2_id) as ctr_k2 from tbl_k2_form";
	if ($issued==1)
	$sql2.=" where k2_status=4";	
	else if ($issued==2)
	$sql2.=" where k2_status<>4";
	
	$load2=$database->get_results($sql2);
	$row2=$load2[0];
	$ctrK2=$row2['ctr_k2'];
	
	$sql3="select count(mp_id) as ctr_mp from tbl_mineplan_form";
	if ($issued==1)
	$sql3.=" where mp_status=4";	
	else if ($issued==2)
	$sql3.=" where mp_status<>4";
	
	$load3=$database->get_results($sql3);
	$row3=$load3[0];
	$ctr_mp=$row3['ctr_mp'];
	
	$sql4="select count(sc_id) as ctr_sc from tbl_stone_crusher_form";
	if ($issued==1)
	$sql4.=" where sc_status=4";
	else if ($issued==2)
	$sql4.=" where sc_status<>4";
		
	$load4=$database->get_results($sql4);
	$row4=$load4[0];
	$ctr_sc=$row4['ctr_sc'];
	
	
	return $total=$ctrK+$ctrK1+$ctrK2+$ctr_mp+$ctr_sc;
	
}

function getTotalOrders($online=0)
{
	
	global $database;
	$sql="select count(transaction_id) as ctr_trans from tbl_transactions";	
	if ($online==1)
	$sql.=" where transaction_online=1";	
	if ($online==2)
	$sql.=" where transaction_online=0";
	
	$load=$database->get_results($sql);
	$row=$load[0];
	$ctr=$row['ctr_trans'];
	
	return $ctr;
	
}


function getTotalOrdersQty()
{
	
	global $database;
	$sql="select sum(order_quantity) as ctr_qty from tbl_orders";	
	
	
	$load=$database->get_results($sql);
	$row=$load[0];
	$ctr=$row['ctr_qty'];
	
	return $ctr;
	
}

function getTotalOptMinings()
{
	
	global $database;
	$sql="select count(mining_id) as ctr_mines from tbl_minings where mining_status=1";	

	
	$load=$database->get_results($sql);
	$row=$load[0];
	$ctr=$row['ctr_mines'];
	
	return $ctr;
	
}

function fnConKgToCu($val)
{
	$ton=$val/1000;
	$cuFt=$ton*25;
	return $val." kg (".$cuFt." cu.ft)";
}

function fnConKgToCu_Val($val)
{
	$ton=$val/1000;
	$cuFt=$ton*25;
	return $cuFt;
}

function fnConKgToTon($val)
{
	$ton=$val/1000;
	
	return $ton;
}

function fnTonToCu($val)
{
	
	$cuFt=$val*25;
	return $cuFt;
}

function fnCuToTon($val)
{
	
	$cuFt=$val/25;
	return $cuFt;
}

function fnVehNumFormat($val)
{
	$part1 =   strtoupper(substr($val, 0, 4));
	$part2   = strtoupper(substr($val, 4, 2));
	$part3   = strtoupper(substr($val, 6, 4));

	return $part1."-".$part2."-".$part3;


}

function fnFundPaymentReceived($year)
{
	global $database;
	
	$nextYear=$year+1;
	
	$sqlFund="select sum(ei_installment_amount) as fundAmount from emfdmf_installments where ei_paid=1 and ei_paid_date>='".$year."-04-01' and ei_paid_date<='".$nextYear."-03-31'";
	$resFund=$database->get_results($sqlFund);
	$rowFund=$resFund[0];
	
	if ($rowFund['fundAmount']!="")
	return $rowFund['fundAmount'];
	else
	return "0";	

}

function fnFundOutstanding($year)
{
	global $database;
	$nextYear=$year+1;
	
	$sqlFund="select sum(ei_installment_amount) as fundAmount from emfdmf_installments where ei_paid=0 and ei_due_date>='".$year."-04-01' and ei_due_date<='".$nextYear."-03-31'";
	$resFund=$database->get_results($sqlFund);
	$rowFund=$resFund[0];
	
	if ($rowFund['fundAmount']!="")
	return $rowFund['fundAmount'];
	else
	return "0";	

}


function fnFundDivison($year,$ty)
{
	global $database;
	$nextYear=$year+1;
	
	if ($ty=="emf")
	$field="ei_emf_payment";
	else if ($ty=="dmf")
	$field="ei_dmf_payment";
	else if ($ty=="royalty")
	$field="ei_royalty_payment";
	else if ($ty=="tcs")
	$field="ei_tcs_payment";
	
	$sqlFund="select sum(".$field.") as fundAmount from emfdmf_installments where ei_paid=1 and ei_paid_date>='".$year."-04-01' and ei_paid_date<='".$nextYear."-03-31'";
	$resFund=$database->get_results($sqlFund);
	$rowFund=$resFund[0];
	
	if ($rowFund['fundAmount']!="")
	return $rowFund['fundAmount'];
	else
	return "0";	

}


function fnFundDivison_outstanding($year,$ty)
{
	global $database;
	$nextYear=$year+1;
	
	if ($ty=="emf")
	$field="ei_emf_payment";
	else if ($ty=="dmf")
	$field="ei_dmf_payment";
	else if ($ty=="royalty")
	$field="ei_royalty_payment";
	else if ($ty=="tcs")
	$field="ei_tcs_payment";
	
	$sqlFund="select sum(".$field.") as fundAmount from emfdmf_installments where ei_paid=0 and ei_due_date>='".$year."-04-01' and ei_due_date<='".$nextYear."-03-31'";
	
	$resFund=$database->get_results($sqlFund);
	$rowFund=$resFund[0];
	
	if ($rowFund['fundAmount']!="")
	return $rowFund['fundAmount'];
	else
	return "0";	

}


function fnFundDuePayments()
{
	global $database;
	
	$todaysDate=date("Y-m-d");
	
	$sqlFund="select sum(ei_installment_amount) as fundAmount from emfdmf_installments where ei_paid=0 and ei_due_date>='".$todaysDate."' and ei_due_date<'DATE_ADD(".$todaysDate.", INTERVAL 15 DAY)'";
	$resFund=$database->get_results($sqlFund);
	$rowFund=$resFund[0];
	
	if ($rowFund['fundAmount']=="")
	return 0;
	else
	return $rowFund['fundAmount'];	

}


function fnFundOverDuePayments()
{
	global $database;
	
	$todaysDate=date("Y-m-d");
	
	$sqlFund="select sum(ei_installment_amount) as fundAmount from emfdmf_installments where ei_paid=0 and ei_due_date<'".$todaysDate."'";
	$resFund=$database->get_results($sqlFund);
	$rowFund=$resFund[0];
	
	if ($rowFund['fundAmount']=="")
	return 0;
	else
	return $rowFund['fundAmount'];	

}


function convertCrtoDecimal($amount) {
     $Arraycheck = array("4"=>"K","5"=>"K","6"=>"Lacs","7"=>"Lacs","8"=>"Cr","9"=>"Cr","10"=>"B");
     // define decimal values
     $numberLength = strlen($amount); //count the length of numbers
     if ($numberLength > 3) {
        foreach ($Arraycheck as $Lengthnum=>$unitval) {
            if ($numberLength == $Lengthnum) {
               if ($Lengthnum % 2 == 0) {
                  $RanNumber = substr($amount,1,2);
                  $NmckGtZer = ($RanNumber[0]+$RanNumber[1]);
                  if ($NmckGtZer < 1) { 
                      $RanNumber = "0";
                  } else {
                     if ($RanNumber[1] == 0) {
                        $RanNumber[1] = "0";
                  } 
             }
      $amount = substr($amount,0,$numberLength-$Lengthnum+1) . "." . $RanNumber . " $unitval ";
    } else {
         $RanNumber = substr($amount,2,2);
         $NmckGtZer = ($RanNumber[0]+$RanNumber[1]);
         if ($NmckGtZer < 1) { 
            $RanNumber  = 0;
        } else {
            if ($RanNumber[1] == 0)  {
                $RanNumber[1] = "0";
            }   
        }
         $amount = substr($amount,0,$numberLength-$Lengthnum+2) . ".". $RanNumber . " $unitval";   
       }
     }
 }
 } else {
     $amount . "Rs";    
 }
 return $amount;
 }



?>