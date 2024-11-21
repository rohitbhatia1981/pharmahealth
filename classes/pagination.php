<?php



  
   class pagingRecords
    {
	   var $pageQuery="";
	   var $maxRecords="";
	   var $setWhere="";
	   var $totalPages="0";
	   var $tableName="";
	   var $pageNumber="0";
	   var $setLimit="";
	   var $queryString="";
	   var $queryStringMultiple="";
	   var $pageQueryLimit="";
	   
	   // function to set the name of the table on which the query will be executed
	   function setTableName($tableName)
	    {
		  $this->tableName=$tableName;
		}
		
		// function to provide which page number is currently the user looking into from the total pages formed by setting some particular records per page
		function setPageNumber($pageNo)
		 {
		   $this->pageNumber=$pageNo;
		   if($this->pageNumber=="")
		     $this->pageNumber=1;
		 }
		
		// function to be used if user want to set the Where clause of the sql query, separately.
		function setWhere($setwhere)
		 {
		   $this->setWhere=$setwhere;
		 } 
		
		// function tell about the maximum number of records to be displayed on a page
		function setMaxRecords($maxRecords)
		 {
		   $this->maxRecords=$maxRecords;
		 } 
		
		// function sets the query to be executed in accordance with the different parameters for pagination process 
		function setQuery($query)
		 {
		   global $_GET;
		   if($_GET['pageNo']=="")	
		    $this->pageNumber=1;
		   else
		    $this->pageNumber=$_GET['pageNo'];
			
			$offset = ($this->maxRecords * ($this->pageNumber - 1));
				$limit= $this->maxRecords;
		   		   
		   $this->setLimit=" limit ".$offset.", ".$limit." ";
		   
		   $this->pageQuery=$query;
		   
		   $this->pageQueryLimit=$query.$this->setLimit;
		   
		   return $this->pageQueryLimit;
		 } 
		 
		 
		 //function displays the links to access all the pages formed due to application of the pagination query
		 function displayLinksFront()
		  {
		  //db connection
		   $d2=new DB();
		  
		    global $_GET;
			
			
		 while(list($key, $value) = each($_GET))
			{
			
			if($key	!="pageNo"){
				$this->queryString.="&";
				$this->queryString.=$key."=";
				$this->queryString.=$value;}
			}
			if (strlen($this->queryString)>0 )
			 {
				$this->queryStringMultiple=substr($this->queryString,1);
			}	
			
			
			$resultRes=$d2->get_results( $this->pageQuery );
			 $totalRecs=$d2->num_rows($this->pageQuery);
			
			if($totalRecs > 0 )
			 {
			   $this->totalPages=ceil($totalRecs/$this->maxRecords);
			 }
			
			$prevRec=$this->pageNumber-1;
			$nextRec=$this->pageNumber+1;
			if($prevRec<=0)
			  $prevRec="";
			if($nextRec > $this->totalPages)
			  $nextRec=$this->totalPages;
			  
			$s="<table border='0' width='100%'>";
			$s.="<tr>";
			
			
			if($this->pageNumber!=1)
			{
				$s.="<th align='left'>";
				$s.="<a href='?".$this->queryString."&pageNo=".$prevRec."' class=copyblue13b><img src='".URL."images/btnPrevious.jpg' border='0' alt='pre' /></a>"; 
				$s .= "</th>";
			}
			
	
			 if($this->pageNumber!=$this->totalPages)
			{
				$s.="<th align='right'>";
				$s.="<a href='?".$this->queryString."&pageNo=".$nextRec."' class=copyblue13b><img src='".URL."images/btnNext.jpg' border='0' alt='nxt' /></a>";
				$s .= "</th>";
			}
			
			$s.="</tr>";
			$s.="</table>";
			
			if($this->totalPages > 1)
			 {
			   print $s;
			 }
		  }
		  
		  		 function displayLinks_Front()
		  {
		  	global $currentTemplate;
		  //db connection
		    $d2=new DB();
		  
		    global $_GET;
			
			
		 while(list($key, $value) = each($_GET))
			{
				if($key	!="pageNo"){
					$this->queryString.="&";
					$this->queryString.=$key."=";
					$this->queryString.=$value;}
				}
			
			if (strlen($this->queryString)>0 )
			$this->queryString=substr($this->queryString,1);
			
			
			$resultRes=$d2->get_results( $this->pageQuery );
			 $totalRecs=$d2->num_rows($this->pageQuery);
			
			if($totalRecs > 0 )
			 {
			   $this->totalPages=ceil($totalRecs/$this->maxRecords);
			 }
			
			$prevRec=$this->pageNumber-1;
			$nextRec=$this->pageNumber+1;
			if($prevRec<=0)
			  $prevRec="";
			if($nextRec > $this->totalPages)
			  $nextRec=$this->totalPages;
			  
			$s="<div align='center'>";
			
			
			if($this->pageNumber!=1)
			{
				$s.="<a href='?".$this->queryString."&pageNo=1' class=browntext12link>First</a> &nbsp;
			      <a href='?".$this->queryString."&pageNo=".$prevRec."' class=browntext12link>Prev</a>&nbsp;|&nbsp;&nbsp;&nbsp;"; 
			}
			
			$s .= "<span class='darkgrey12'>Pages :</span> ";
			
			//-----changes made by rohit bhatia 6 june----------
			
			 $pageMultiple=ceil($this->pageNumber/9);
			 $totalPages=10*$pageMultiple;
			if ($totalPages>$this->totalPages)
			$totalPages=$this->totalPages;
			
			if ($pageMultiple>1)
			$ctrVal=$totalPages-10;
			else
			$ctrVal=$totalPages-9;
			
			if($ctrVal<=0)
			{
				$ctrVal=1;
			}
			//--------------end changes----------
			for($pageCounter=$ctrVal;$pageCounter<=$totalPages;$pageCounter++)
			 {
			 	
			   if($pageCounter==$this->pageNumber)
			     $s.="<font class=browntext12link style='color:#69841C;'>".$pageCounter."</font>&nbsp;";			
			   else
			     $s.="<a href='?".$this->queryString."&pageNo=".$pageCounter."' class='browntext12link'>".$pageCounter."</a>&nbsp;";			
			 }
			 
			 if($this->pageNumber!=$this->totalPages)
			 {
				$s.="&nbsp;&nbsp;|&nbsp;<a href='?".$this->queryString."&pageNo=".$nextRec."' class=browntext12link>Next</a>&nbsp;&nbsp;
			      <a href='?".$this->queryString."&pageNo=".$this->totalPages."' class=browntext12link>Last</a>&nbsp;&nbsp;";
			}
			
		    
			$s.="</div>";
			
			if($this->totalPages > 1)
			 {
			   print $s;
			 }
			
		  }
		  
		  
		  
		  
		function displayLinks_adlisting()
		  {
		  	global $currentTemplate;
		  //db connection
		    $d2=new DB();
		  
		    global $_GET;
			
			
		/* while(list($key, $value) = each($_GET))
			{
				if($key	!="pageNo"){
					$this->queryString.="&";
					$this->queryString.=$key."=";
					$this->queryString.=$value;}
				}
			
			if (strlen($this->queryString)>0 )
			$this->queryString=substr($this->queryString,1);*/
			
			
			$queryString_pick=$_SERVER['QUERY_STRING'];
			
			$key = 'pageNo';
			
			$queryString_pick = preg_replace('/(?:&|(\?))' . $key . '=[^&]*(?(1)&|)?/i', "$1", $queryString_pick);
   			$queryString_pick = rtrim($queryString_pick, '?');
   			$queryString_mod = rtrim($queryString_pick, '&');
			
			
			// Remove specific parameter from query string
			//$queryString_mod = preg_replace('~(\?|&)'.$key.'=[^&]*~', '$1', $queryString_pick);
			
			
			$resultRes=$d2->get_results( $this->pageQuery );
			 $totalRecs=$d2->num_rows($this->pageQuery);
			
			if($totalRecs > 0 )
			 {
			   $this->totalPages=ceil($totalRecs/$this->maxRecords);
			 }
			
			$prevRec=$this->pageNumber-1;
			$nextRec=$this->pageNumber+1;
			if($prevRec<=0)
			  $prevRec="";
			if($nextRec > $this->totalPages)
			  $nextRec=$this->totalPages;
			  
			$s="<div align='center' class='page_navi'>";
			
			
			if($this->pageNumber!=1)
			{
				$s.="<a href='?".$queryString_mod."&pageNo=1' class=bluefont11>First</a> &nbsp;
			      <a href='?".$queryString_mod."&pageNo=".$prevRec."' class=bluefont11>Prev</a>&nbsp;|&nbsp;&nbsp;&nbsp;"; 
			}
			
			//$s .= "<span class='darkgrey12'>Pages :</span> ";
			
			//-----changes made by rohit bhatia 6 june----------
			
			 $pageMultiple=ceil($this->pageNumber/9);
			 $totalPages=10*$pageMultiple;
			if ($totalPages>$this->totalPages)
			$totalPages=$this->totalPages;
			
			if ($pageMultiple>1)
			$ctrVal=$totalPages-10;
			else
			$ctrVal=$totalPages-9;
			
			if($ctrVal<=0)
			{
				$ctrVal=1;
			}
			//--------------end changes----------
			for($pageCounter=$ctrVal;$pageCounter<=$totalPages;$pageCounter++)
			 {
			 	
			   if($pageCounter==$this->pageNumber)
			     $s.="<font style='background-color:#587dff; color: #fff; padding:10px 12px; border:1px solid #234ddc'>".$pageCounter."</font>&nbsp;";			
			   else
			    $s.="<a href='?".$queryString_mod."&pageNo=".$pageCounter."' style='background-color:#e5eafa; color: #000; padding:10px 12px; border:1px solid #dde3f3'>".$pageCounter."</a>&nbsp;";			
			 }
			 
			 if($this->pageNumber!=$this->totalPages)
			 {
				$s.="&nbsp;&nbsp;|&nbsp;<a href='".URL."ads/listing.php?".$queryString_mod."&pageNo=".$nextRec."' class=bluefont11>Next</a>&nbsp;&nbsp;
			      <a href='?".$queryString_mod."&pageNo=".$this->totalPages."' class=bluefont11>Last</a>&nbsp;&nbsp;";
			}
			
		    
			$s.="</div>";
			
			if($this->totalPages > 1)
			 {
			   print $s;
			 }
			
		  }
		  
		  
		
		  
		  
		  
		  function displayLinks_dealerlisting()
		  {
		  	global $currentTemplate;
		  //db connection
		    $d2=new DB();
		  
		    global $_GET;
			
			
		/* while(list($key, $value) = each($_GET))
			{
				if($key	!="pageNo"){
					$this->queryString.="&";
					$this->queryString.=$key."=";
					$this->queryString.=$value;}
				}
			
			if (strlen($this->queryString)>0 )
			$this->queryString=substr($this->queryString,1);*/
			
			
			$queryString_pick=$_SERVER['QUERY_STRING'];
			
			$key = 'pageNo';
			
			$queryString_pick = preg_replace('/(?:&|(\?))' . $key . '=[^&]*(?(1)&|)?/i', "$1", $queryString_pick);
   			$queryString_pick = rtrim($queryString_pick, '?');
   			$queryString_mod = rtrim($queryString_pick, '&');
			
			
			// Remove specific parameter from query string
			//$queryString_mod = preg_replace('~(\?|&)'.$key.'=[^&]*~', '$1', $queryString_pick);
			
			
			$resultRes=$d2->get_results( $this->pageQuery );
			 $totalRecs=$d2->num_rows($this->pageQuery);
			
			if($totalRecs > 0 )
			 {
			   $this->totalPages=ceil($totalRecs/$this->maxRecords);
			 }
			
			$prevRec=$this->pageNumber-1;
			$nextRec=$this->pageNumber+1;
			if($prevRec<=0)
			  $prevRec="";
			if($nextRec > $this->totalPages)
			  $nextRec=$this->totalPages;
			  
			$s="<div align='center'>";
			
			
			if($this->pageNumber!=1)
			{
				$s.="<a href='".URL."dealer/detail.php?".$queryString_mod."&pageNo=1' class=bluefont11>First</a> &nbsp;
			      <a href='".URL."dealer/detail.php?".$queryString_mod."&pageNo=".$prevRec."' class=bluefont11>Prev</a>&nbsp;|&nbsp;&nbsp;&nbsp;"; 
			}
			
			$s .= "<span class='darkgrey12'>Pages :</span> ";
			
			//-----changes made by rohit bhatia 6 june----------
			
			 $pageMultiple=ceil($this->pageNumber/9);
			 $totalPages=10*$pageMultiple;
			if ($totalPages>$this->totalPages)
			$totalPages=$this->totalPages;
			
			if ($pageMultiple>1)
			$ctrVal=$totalPages-10;
			else
			$ctrVal=$totalPages-9;
			
			if($ctrVal<=0)
			{
				$ctrVal=1;
			}
			//--------------end changes----------
			for($pageCounter=$ctrVal;$pageCounter<=$totalPages;$pageCounter++)
			 {
			 	
			   if($pageCounter==$this->pageNumber)
			     $s.="<font class=browntext12link style='color:#69841C;'>".$pageCounter."</font>&nbsp;";			
			   else
			    $s.="<a href='".URL."dealer/detail.php?".$queryString_mod."&pageNo=".$pageCounter."' class='redfont11'>".$pageCounter."</a>&nbsp;";			
			 }
			 
			 if($this->pageNumber!=$this->totalPages)
			 {
				$s.="&nbsp;&nbsp;|&nbsp;<a href='".URL."dealer/detail.php?".$queryString_mod."&pageNo=".$nextRec."' class=bluefont11>Next</a>&nbsp;&nbsp;
			      <a href='".URL."dealer/detail.php?".$queryString_mod."&pageNo=".$this->totalPages."' class=bluefont11>Last</a>&nbsp;&nbsp;";
			}
			
		    
			$s.="</div>";
			
			if($this->totalPages > 1)
			 {
			   print $s;
			 }
			
		  }
		  
		  
		  
		  
		  
		  function displayLinksForNavigation()
		  {
		  	
			
			
			global $currentTemplate;
		  //db connection
		   $d2=new DB();
		  
		    global $_GET;
			
			
		 while(list($key, $value) = each($_GET))
			{
			if($key	!="pageNo"){
				$this->queryString.="&";
				$this->queryString.=$key."=";
				$this->queryString.=$value;}
			}
			if (strlen($this->queryString)>0 )
			$this->queryString=substr($this->queryString,1); 
			
			
			$resultRes=$d2->get_results( $this->pageQuery );
			 $totalRecs=$d2->num_rows($this->pageQuery);
			
			if($totalRecs > 0 )
			 {
			   $this->totalPages=ceil($totalRecs/$this->maxRecords);
			 }
			
			$prevRec=$this->pageNumber-1;
			$nextRec=$this->pageNumber+1;
			if($prevRec<=0)
			  $prevRec="";
			if($nextRec > $this->totalPages)
			  $nextRec=$this->totalPages;
			  
			$s="<nav aria-label='Page navigation'>";
			$s.="<ul class='pagination'>";
			$s.="<li class=''>";
			
			if($this->pageNumber!=1)
			{
				$s.="<a href='?".$this->queryString."&pageNo=".$prevRec."' aria-label='Previous'>"; 
				//$s.="<a href='?".$this->queryString."&pageNo=".$prevRec."' class=sidelinks style=text-decoration:none>Previous</a>&nbsp;|&nbsp;";
				$s.="<span aria-hidden='true'>Prev <<</span>";
				$s.="</a>";
			}
			$s.="</li>";
			//-----changes made by rohit bhatia 6 june----------
			
			 $pageMultiple=ceil($this->pageNumber/9);
			 $totalPages=10*$pageMultiple;
			if ($totalPages>$this->totalPages)
			$totalPages=$this->totalPages;
			
			if ($pageMultiple>1)
			$ctrVal=$totalPages-10;
			else
			$ctrVal=$totalPages-9;
			if($ctrVal<=0)
			{
				$ctrVal=1;
			}
			//--------------end changes----------
			
			//for($pageCounter=1;$pageCounter<=$this->totalPages;$pageCounter++)
			for($pageCounter=$ctrVal;$pageCounter<=$totalPages;$pageCounter++)
			{
				
			 	$pgsecond=$pageCounter*10;	
				$pgfirst=$pgsecond-9; 	
			   if($pageCounter==$this->pageNumber){
				   
				   if($pageCounter == $this->pageNumber){
					$classfornav = 'active';
					}
							  
			     $s.="<li class='".$classfornav."'><a href='?".$this->queryString."pageNo=".$pageCounter."'>".$pageCounter."</a></li>";			
			     //$s.="<span style='font-size:12px;'>".$pgfirst."-".$pgsecond."</span>&nbsp;|&nbsp;";			
				 }
			   else
			   	 $s.="<li class=''><a href='?".$this->queryString."pageNo=".$pageCounter."'>".$pageCounter."</a></li>";
			     //$s.="<a href='?".$this->queryString."&pageNo=".$pageCounter."' style='text-decoration:none;font-family:Arial;font-size:12px;' class='sidelinks'>".$pgfirst."-".$pgsecond."</a>&nbsp;|&nbsp;";									  
				 
			 }
			
			 if($this->pageNumber!=$this->totalPages)
			 {
				$s.="<li>";
				$s.="<a href='?".$this->queryString."pageNo=".$nextRec."' aria-label='Next'>";
				$s.="<span aria-hidden='true'>Next >></span>";
				$s.="</a>";
				$s.="</li>";
				//$s.="<a href='?".$this->queryString."&pageNo=".$nextRec."' class=sidelinks style=text-decoration:none>Next</a>&nbsp;&nbsp;";
			}
			
		    $s.="</ul>"; 
			$s.="</nav>";
			//$s.="</table></td></tr>";
			
			if($this->totalPages > 1)
			 {
			   print $s;
			 }
		  }
	
		  
		 function displayLinks()
		  {
		  	global $currentTemplate;
		  //db connection
		   $d2=new DB();
		  
		    global $_GET;
			
			
		 while(list($key, $value) = each($_GET))
			{
				if($key	!="pageNo"){
					$this->queryString.="&";
					$this->queryString.=$key."=";
					$this->queryString.=$value;}
				}
			
			if (strlen($this->queryString)>0 )
			$this->queryString=substr($this->queryString,1);
			
			
			//$resultRes=mysqli_query($this->pageQuery) or die ("unable to execute query $this->pageQuery ".mysqli_error());
			$resultRes=$d2->get_results( $this->pageQuery );
			 $totalRecs=$d2->num_rows($this->pageQuery);
			//echo $totalRecs=mysql_num_rows($resultRes);
			
			if($totalRecs > 0 )
			 {
			   $this->totalPages=ceil($totalRecs/$this->maxRecords);
			 }
			
			$prevRec=$this->pageNumber-1;
			$nextRec=$this->pageNumber+1;
			if($prevRec<=0)
			  $prevRec="";
			if($nextRec > $this->totalPages)
			  $nextRec=$this->totalPages;
			  
			$s="<tr><td align='center'><table border='0' style='text-align:center;'  align='center' width='100%'>";
			$s.="<tr>";
			$s.="<th class='pagination'>";
			$s.="<table align='center' cellspadding='0' cellspacing='3'>";
			$s.="<tr>";		
			if($this->pageNumber!=1)
			{
				$s.="<td><a href='?".$this->queryString."&pageNo=".$prevRec."' class=pagination-active></a></td>"; 
			}
			
			
			
			
			//-----changes made by rohit bhatia 6 june----------
			
			 $pageMultiple=ceil($this->pageNumber/9);
			 $totalPages=10*$pageMultiple;
			if ($totalPages>$this->totalPages)
			$totalPages=$this->totalPages;
			
			if ($pageMultiple>1)
			$ctrVal=$totalPages-10;
			else
			$ctrVal=$totalPages-9;
			
			if($ctrVal<=0)
			{
				$ctrVal=1;
			}
			//--------------end changes----------
			for($pageCounter=$ctrVal;$pageCounter<=$totalPages;$pageCounter++)
			 {
			 	
			   if($pageCounter==$this->pageNumber)
			     $s.="<td class='numberis'>".$pageCounter."</td>&nbsp;";			
			   else
			     $s.="<td class='numberis'><a href='?".$this->queryString."&pageNo=".$pageCounter."' class='purple'>".$pageCounter."</a></td>";			
			 }
			 
			 if($this->pageNumber!=$this->totalPages)
			 {
				$s.="<td><a href='?".$this->queryString."&pageNo=".$nextRec."' class='pagination-active'></a></td>
			      ";
			}
			
			$s.="</tr>";	
			$s.="</table>";
		    $s.="</th>"; 
			$s.="</tr>";
			$s.="</table></td></tr>";
			
			if($this->totalPages > 1)
			 {
			   print $s;
			 }
			
		  }
		  
		  //DISPLAY LINKS FUNCTION FOR FRONT STARTS HERE
		  function displayLinksRed()
		  {
		  	global $currentTemplate;
		  //db connection
		   $d2=new DB();
		  
		    global $_GET;
			
			
		 while(list($key, $value) = each($_GET))
			{
				if($key	!="pageNo"){
					$this->queryString.="&";
					$this->queryString.=$key."=";
					$this->queryString.=$value;}
				}
				$newQuery=$this->queryString;
			if (strlen($this->queryString)>0 )
			$this->queryString=substr($this->queryString,1);
			
			
			$resultRes=$d2->get_results( $this->pageQuery );
			 $totalRecs=$d2->num_rows($this->pageQuery);
			
			if($totalRecs > 0 )
			 {
			   $this->totalPages=ceil($totalRecs/$this->maxRecords);
			 }
			
			$prevRec=$this->pageNumber-1;
			$nextRec=$this->pageNumber+1;
			if($prevRec<=0)
			  $prevRec="";
			if($nextRec > $this->totalPages)
			  $nextRec=$this->totalPages;
			  
			$s="<tr><td align='center'><table border='0' style='text-align:center;font-size:13px;' background='".URL.FOLDER_ADMIN.FOLDER_ADMIN_TEMPLATES.$currentTemplate."/images/background.jpg"."' align='center' width='100%'>";
			$s.="<tr>";
			$s.="<td>";
							
			if($this->pageNumber!=1)
			{
				//<a href='?".$this->queryString."&pageNo=1' class=pagenumber>First</a> &nbsp;
				$s.="<a href='?".$this->queryString."&pageNo=".$prevRec."' class=pagenumber>Previous </a>&nbsp;"; 
			}
			
			//$s .= "Pages : ";
			
			//-----changes made by rohit bhatia 6 june----------
			
			 $pageMultiple=ceil($this->pageNumber/9);
			 $totalPages=10*$pageMultiple;
			if ($totalPages>$this->totalPages)
			$totalPages=$this->totalPages;
			
			if ($pageMultiple>1)
			$ctrVal=$totalPages-10;
			else
			$ctrVal=$totalPages-9;
			if($ctrVal<=0)
			{
				$ctrVal=1;
			}
			//--------------end changes----------
			for($pageCounter=$ctrVal;$pageCounter<=$totalPages;$pageCounter++)
			 {
			 	
			   if($pageCounter==$this->pageNumber)
			     $s.="<span style='font-size:13px;'>| ".$pageCounter."</span>&nbsp;";			
			   else
			     $s.="<a href='".URL."index.php?".$this->queryString."&pageNo=".$pageCounter."' style='text-decoration:none;font-family:Arial;font-size:13px;' class='pagenumber'>| ".$pageCounter." </a>&nbsp;";			
			 }
			 
			 if($this->pageNumber!=$this->totalPages)
			 {
				$s.="|&nbsp;<a href='".URL."index.php?".$this->queryString."&pageNo=".$nextRec."' class=pagenumber>Next</a>&nbsp;&nbsp;";
				//<a href='?".$this->queryString."&pageNo=".$this->totalPages."' class=pagenumber>Last</a>&nbsp;&nbsp;
			}
			
		    $s.="</td>"; 
			$s.="</tr>";
			$s.="</table></td></tr>";
			
			if($this->totalPages > 1)
			 {
			   print $s;
			 }
			  $this->queryString="";
			 $this->queryString=$newQuery;
		  }
		  
		  //DISPLAY LINKS FUNCTION FOR FRONT ENDS HERE
	
	}
  
?>