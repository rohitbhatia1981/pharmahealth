<?php

      class csv
	  {
	      var $Query="";
		  var $dbobj="";
		  var $Path="";
		  var $date_csv="";
		  function csv($path,$query,$date)
		  {
		     $this->Query=$query;
			 $this->Path=$path;
			 $this->date_csv=$date;
		  }
		  function MakeCsv()
		  {
		     $file_name=$this->Path.$this->date_csv.".csv";
			 if(!file_exists($file_name))
			    {
				  $file_pointer=fopen($file_name,"w+");
				  $sql=$this->Query;
				  $result=mysql_query($sql);
				 
				   for($i=0;$i<mysql_num_fields($result);$i++)
				   {
   					    $field=mysql_field_name($result,$i);
					    fwrite($file_pointer,$field);
						fwrite($file_pointer,",");
						
					 }
					    fwrite($file_pointer,"\n");
					while($row=mysql_fetch_object($result))
					       {
						       for($j=0;$j<mysql_num_fields($result);$j++)
							       {
								      $field=mysql_field_name($result,$j);
									   	 $new=str_replace(" ","-",$row->$field);
										 $new=str_replace(",","-",$row->$field);
								         fwrite($file_pointer,$new);
										
									  fwrite($file_pointer,",");
								   }
								    fwrite($file_pointer,"\n");
						   }	
					}
				 elseif(file_exists($file_name))
			      {
				      unlink($file_name);
					  $file_pointer=fopen($file_name,"w+");
					  $sql=$this->Query;
					  $result=mysql_query($sql);
				  
			
					   for($i=0;$i<mysql_num_fields($result);$i++)
					   {
							$field=mysql_field_name($result,$i);
							fwrite($file_pointer,$field);
							fwrite($file_pointer,",");
							
						 }
							fwrite($file_pointer,"\n");
						while($row=mysql_fetch_object($result))
							   {
								   for($j=0;$j<mysql_num_fields($result);$j++)
									   {
										   $field=mysql_field_name($result,$j);
										 $new=str_replace(" ","-",$row->$field);
									     $new=str_replace(",","-",$row->$field);

								         fwrite($file_pointer,$new);
										
									  fwrite($file_pointer,",");
									   }
  										  fwrite($file_pointer,"\n");

							   }	
					    }	
					}	
			    } 
		  
	  
?>