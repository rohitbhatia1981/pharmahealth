<?php include "../../private/settings.php";

/*if ($_SESSION['sess_pres_id']=="")
print "<script>window.location='".URL."patient/questionnaire/step1'</script>";
*/

$_SESSION['questions3']=array();

include PATH."include/headerhtml.php";
 ?>
 <link type="text/css" href="<?php echo URL?>patient/orakuploader/orakuploader.css" rel="stylesheet"/>
  <body style="padding-top:0px;">  
    <div class="header_2">
       <a href="#"><img src="<?php echo URL?>images/logo.png"></a>
   </div>
 <section class="medication-questionaire setup_option_2 setup_option_3">
     <div class="container">
       <h1>Medical Assessment of <?php getConditionName($_GET['c'])?></h1>
    
        
         </div>
<?php         
         $_SESSION['questions']=array();
$_SESSION['questions'][0]="Are you genetically (i.e. born) male or female?";
$_SESSION['questions'][1]="Please tick if any of the following statements apply to you";
$_SESSION['questions'][2]="Date of birth";
$_SESSION['questions'][3]="Do you smoke?";
$_SESSION['questions'][4]="How much do you smoke?";
$_SESSION['questions'][5]="When did you quit smoking?";
$_SESSION['questions'][6]="Do you often drink more than 21 units";




 ?>
  <body style="padding-top:0px;">  
   

     
       
         <div class="setup_white_box mt-4">
             <h3 class="title_3 mt-0 w100p text-center">About You</h3>
             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group">
                     
                         <label class="form-label"><?php echo $_SESSION['questions'][0]; ?></label>
                         
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" value="Male" class="form-check-input" name="rdGender" onChange="showOptions()" data-validation="required">
                                    <span>Male</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" value="Female" class="form-check-input" name="rdGender" onChange="showOptions()">
                                    <span>Female </span>
                                </label>
                             </div>
                             
                             <div id="femaleOpt" style="display:none;padding-left:5%; padding-top:10px;width:100%; border:1px solid #CCC">
                             
                             <div class="row">
                 <div class="col-sm-12">
                 
                 <?php $question2=""; ?>
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][1]; ?></label>
                          
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" value="You are currently pregnant" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()" data-validation="required">
                                    <span>You are currently pregnant</span>
                                </label>
                                <div style="clear:both"></div>
                                <label class="custom_radio">
                                    <input type="radio" value="You are intending to become pregnant" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()">
                                    <span>You are intending to become pregnant</span>
                                </label>
                                  <div style="clear:both"></div>                             
                                
                                <label class="custom_radio">
                                    <input type="radio" value="You are currently breastfeeding" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()">
                                    <span>You are currently breastfeeding </span>
                                </label>
                                <div style="clear:both"></div>
                                
                                <label class="custom_radio">
                                    <input type="radio" value="You are intending to start breastfeeding within the next 6 months" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()">
                                    <span>You are intending to start breastfeeding within the next 6 months</span>
                                </label>
                                <div style="clear:both"></div>
                                
                                 <label class="custom_radio">
                                    <input type="radio" value="None of the above apply" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()">
                                    <span>None of the above apply</span>
                                </label>
                                
                             </div>
                             <font style="color:#F00; padding-bottom:10px" id="femErr"></font>
                         </div>
                     </div>
                 </div>
             </div>
                             
                             
                             </div>
                             
                             
                         </div>
                     </div>
                 </div>
             </div>
             
             
             
             
             <div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <label class="form-label"><?php echo $_SESSION['questions'][2]; ?></label>
            <div class="row">
                <div class="col-sm-4"> <!-- Adjusted column size for mobile -->
                    <select class="form-control" name="cmbDate" id="cmbDate" data-validation="required" data-validation-error-msg="Please select date of birth" style="appearance: auto; -webkit-appearance: menulist; -moz-appearance: menulist;color:#000">
                        <option value="">Date</option>
                        <?php for ($k=1; $k<=31; $k++) {
                            $prefix = ($k < 10) ? "0" : "";
                        ?>
                        <option value="<?php echo $prefix.$k; ?>"><?php echo $prefix.$k; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4"> <!-- Adjusted column size for mobile -->
                    <select class="form-control custom-select select2" name="cmbMonth" id="cmbMonth" data-validation="required" data-validation-error-msg="Please select month" style="appearance: auto; -webkit-appearance: menulist; -moz-appearance: menulist;color:#000">
                        <option value="">Month</option>
                        <?php for ($r = 1; $r <= 12; $r++){
											if ($r<10)
										   $prefix="0";
										   else
										   $prefix="";
                            $month_name = date('F', mktime(0, 0, 0, $r, 1, 2023));
                            echo '<option value="'.$prefix.$r.'">'.$month_name.'</option>';
                        }?>
                    </select>
                </div>
                <div class="col-sm-4"> <!-- Adjusted column size for mobile -->
                    <select class="form-control custom-select select2" name="cmbYear" id="cmbYear" data-validation="required" data-validation-error-msg="Please select year" style="appearance: auto; -webkit-appearance: menulist; -moz-appearance: menulist;color:#000">
                        <option value="">Year</option>
                        <?php
                        $year = date("Y");
                        for ($y = $year-18; $y >= $year-65; $y--) { ?>
                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <font style="color:#F00; padding-bottom:10px" id="ageErr"></font>
</div>


             <div class="row">
                  <div class="col-sm-12">
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][3]; ?> <img src="<?php echo URL?>images/i-icon.png" style="max-height:22px"  title="Seeking help to stop smoking will help reduce your risk of cancer, COPD and heart disease."></label>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" value="Yes" name="rdSmoke" id="rdSmoke" onChange="chkSmoke()" data-validation="required">
                                    <span>Yes</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" value="No" name="rdSmoke" id="rdSmoke" onChange="chkSmoke()">
                                    <span>No </span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" value="Ex-Smoker" name="rdSmoke" id="rdSmoke" onChange="chkSmoke()">
                                    <span>Ex-Smoker </span>
                                </label>
                             </div>
                             
           <div id="smokeOpt" style="display:none;padding-left:5%; padding-top:10px;width:100%; border:1px solid #CCC">
                             
                             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][4]; ?></label>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio"  class="form-check-input" name="rdHowmuchSmoke" value="More than 15 a day" id="rdHowmuchSmoke" data-validation="required" >
                                    <span>More than 15 a day</span>
                                </label>
                                <div style="clear:both"></div>
                               
                                 <label class="custom_radio">
                                    <input type="radio"  class="form-check-input" name="rdHowmuchSmoke" value="Less than 15 a day" id="rdHowmuchSmoke" >
                                    <span>Less than 15 a day</span>
                                </label>
                             <div style="clear:both"></div>
                             <div style="height:20px"></div>
                             
                                
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
             
             </div>
             
             <div id="smokeOpt2" style="display:none;padding-left:5%; padding-top:10px;width:100%; border:1px solid #CCC">
             
             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][5]; ?></label>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" value="Less than a year ago"  class="form-check-input" name="rdSmoking" id="rdSmoking" data-validation="required" >
                                    <span>Less than a year ago</span>
                                </label>
                                <div style="clear:both"></div>
                               
                                 <label class="custom_radio">
                                    <input type="radio" value="More than a year ago" class="form-check-input" name="rdSmoking" id="rdSmoking" >
                                    <span>More than a year ago</span>
                                </label>
                                
                                 <div style="clear:both"></div>
                             <div style="height:20px"></div>
                             
                                
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
             
            
                             
                             
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                  <div class="col-sm-12">
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][6]; ?></label> <img src="<?php echo URL?>images/i-icon.png" style="max-height:22px"  title="This is likely to be increasing your risk of serious health conditions, such as heart disease, stroke and liver disease. To keep your risk of alcohol-related harm to a minimum, it is recommended not regularly drinking more than 14 units of alcohol a week. If you drink as much as 14 units a week, it's best to spread this over three or more days. ">
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="rdDrink" id="rdDrink" value="Yes"  data-validation="required">
                                    <span>Yes</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="rdDrink" id="rdDrink" value="No" onChange="fnDrinkNote()">
                                    <span>No </span>
                                </label>
                                
                             
                             
                              
                              
                                
                             </div>
                         </div>
                     </div>
                     
                     
                 </div>
             </div>

         </div>
         

     </div>

         
        
         <div class="setup_white_box mt-4">
             <h3 class="title_3 mt-0 w100p text-center">Your Symptoms</h3>
             
             
             <?php
			 
			 	$sqlQ = "SELECT * FROM tbl_medical_questions where mq_status=1 and mq_category=2 and mq_conditions='".$database->filter($_GET['c'])."' order by mq_order asc";
				$resQ = $database->get_results($sqlQ);
				
				if (count($resQ)>0)
				{
				
					for ($q=0;$q<count($resQ);$q++)
					{
						$rowQ=$resQ[$q];
						
						
						
						
					
				 ?>
             
             
                     <div class="form-group">
                         <label class="form-label"><?php echo $rowQ['mq_questions'] ?> <?php if ($rowQ['mq_tooltip_status']==1) { ?> <img src="<?php echo URL?>images/i-icon.png" style="max-height:22px"  title="<?php echo $rowQ['mq_tooltip_text'] ?>"> <?php } ?></label>
                         
                         <?php
						 $arrOptions=array();
						 $arrRisk=array();
						 $arrOptions=unserialize(fnUpdateHTML($rowQ['mq_multiple_options']));
						 $arrRisk=unserialize(fnUpdateHTML($rowQ['mq_risk_level']));
						 
						 $_SESSION['questions3'][$q]['question']=$rowQ['mq_questions'];
						 $_SESSION['questions3'][$q]['id']=$rowQ['mq_id'];
						 $_SESSION['questions3'][$q]['type']=$rowQ['mq_answer_type'];
						
						
						  if ($rowQ['mq_answer_type']==1)
						  {
							  
							   
						 ?>
                         
                         <div class="w100p">
                            <div class="radio_inline_box">
                            
                            <?php 
							
							for ($j=0;$j<count($arrOptions);$j++)
							{
								
								$optIn=$j+1;
								$textAreClass="class_".$rowQ['mq_id'];
									
								
								?>
                                <label class="custom_radio">
                                
                                <?php 
								
								$imageOpt="";
								$sqlCheck="select * from tbl_question_images where qi_question='".$database->filter($rowQ['mq_id'])."' and qi_option='".$database->filter($j)."'"; 
								$resCheck=$database->get_results($sqlCheck);
								if (count($resCheck)>0)
									{
										$rowCheck=$resCheck[0];
										$imageOpt=$rowCheck['qi_image'];
									}
								
								 ?>
                                  <?php if ($imageOpt!="") { ?>
                                 
                                <img src="<?php print URL;?>classes/timthumb.php?src=<?php echo URL?>uploads/questionnaire/<?php echo $imageOpt ?>&w=280&h=220&zc=2" style="vertical-align: middle;padding:30px">
                                  
                                  
                                  
                                 <?php } ?>
                                    <input type="radio" class="form-check-input" <?php if ($rowQ['mq_ask_for_information']==$optIn){ ?> onChange="openFreeText('txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn; ?>',1)" <?php } else { ?> onClick="openFreeText('class_<?php echo $rowQ['mq_id']?>',0)" <?php } ?> name="rd_<?php echo $rowQ['mq_id']?>" value="<?php echo $arrOptions[$j]?>~~~<?php echo $arrRisk[$j]; ?>" <?php if ($j==0) echo 'data-validation="required"'; ?>>
                                    
                                   
                                    <span><?php echo $arrOptions[$j]?> 
                                </label>
                                 <?php if ($rowQ['mq_ask_for_information']==$optIn){ ?>
                                    	<div><textarea  placeholder="Please provide more information" style="display:none; padding:10px; margin-left:10pxbackground-color: #fbfcfc; min-height: 180px; width:100%; border-radius: 2px; resize: none;" rows="3" cols="30" class="<?php echo $textAreClass;?>" name="txtMore_<?php echo $rowQ['mq_id']?>" id="txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn?>"></textarea></div>
                                    <?php } ?>
                            <?php } ?>
                                
                             </div>
                         </div>
                         
                         <?php } 
                         
                          if ($rowQ['mq_answer_type']==2)
						  {
							  
							 	
							   
						 ?>
                         
                         <ul class="conditions_list">
                         
                         	 <?php 
							 
							
							 
							 for ($j=0;$j<count($arrOptions);$j++)
							{
								$optIn=$j+1;
								//$textAreClass="class_".$rowQ['mq_id'];
							   $arrAskOptions=array();
							   if ($rowQ['mq_ask_for_information']!="")
							   $arrAskOptions=explode(",",$rowQ['mq_ask_for_information']);
								
								?>
                         
                             <li><?php echo $arrOptions[$j]?> 
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="ck_<?php echo $rowQ['mq_id']?>[]" id="ck_<?php echo $rowQ['mq_id']?>" type="checkbox" <?php if (in_array($optIn, $arrAskOptions)) { ?> onChange="openFreeText2('txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn; ?>',<?php echo $rowQ['mq_id']?>)" <?php } ?> value="<?php echo $arrOptions[$j]?>~~~<?php echo $arrRisk[$j]; ?>" role="switch"/>
                                </div>
                             </li>
                            
                           <?php if (in_array($optIn, $arrAskOptions)) { ?>
                           
                                    	<div><textarea rows="3"   placeholder="Please provide more information" cols="40"  style="display:none; padding:10px; margin-left:10pxbackground-color: #fbfcfc; min-height: 180px; width:100%; border-radius: 2px; resize: none;" name="txtMore_<?php echo $rowQ['mq_id']?>" id="txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn?>"></textarea></div>
                                    <?php } ?>
                            
                            <?php } ?>

                         </ul>
                         
                         <?php }
						 
						 if ($rowQ['mq_answer_type']==3)
						  {
							
							   
						 ?>
                         
                        
                         
                         
                                <div>
                                    <textarea  rows="4" style="padding:10px; margin-left:10pxbackground-color: #fbfcfc; min-height: 180px; width:100%; border-radius: 2px; resize: none;" name="txt_<?php echo $rowQ['mq_id']?>" placeholder="Plese provide information"></textarea>
                                </div>
                             </li>
                            
                          

                        
                         
                         <?php }
						 
						  if ($rowQ['mq_answer_type']==4)
						  { ?>
                          
                           <div>
                                    <div id="images4ex" orakuploader="on"></div>
                                    
                                    <div style="padding-top:10px; color:#C33">You can upload upto 5 images</div>
                                    
                                </div>
                          
						  <?php }
						 
						  ?>
                          
                          
                         
                     </div> 
                 
                 <?php }
				}
				  ?>    
                     
                     
                     
            <!--<div class="form-group">
                         <label class="form-label">How long have you been sexually active?</label>
                         <div class="radio_inline_box_grid">
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>< 6 months  </span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span> 6-12 months </span>
                                </label>
                             </div>
                         </div>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>1-5 months</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>> 5 years</span>
                                </label>
                             </div>
                         </div>
                     </div>
                     </div>--> 
             
                  
<?php //print_r ($_SESSION['questions3']); ?>
                 
   <div style="clear:both"></div>        
  <div style="" id="error-container"></div>   
  <div style="clear:both"></div>                 
              
  
         </div>
         
         <div class="setup_white_box mt-4">
             <h3 class="title_3 mt-0 w100p text-center">Your Medical History</h3>
             
             
             <?php
			 
			 	$sqlQ = "SELECT * FROM tbl_medical_questions where mq_status=1 and mq_category=3 and mq_conditions='".$database->filter($_GET['c'])."' order by mq_order asc";
				$resQ = $database->get_results($sqlQ);
				
				if (count($resQ)>0)
				{
				
					for ($q=0;$q<count($resQ);$q++)
					{
						$rowQ=$resQ[$q];
						
						
						
						
					
				 ?>
             
             
                     <div class="form-group">
                         <label class="form-label"><?php echo $rowQ['mq_questions'] ?> <?php if ($rowQ['mq_tooltip_status']==1) { ?> <img src="<?php echo URL?>images/i-icon.png" style="max-height:22px"  title="<?php echo $rowQ['mq_tooltip_text'] ?>"> <?php } ?></label>
                         
                         <?php
						 $arrOptions=array();
						 $arrRisk=array();
						 $arrOptions=unserialize(fnUpdateHTML($rowQ['mq_multiple_options']));
						 $arrRisk=unserialize(fnUpdateHTML($rowQ['mq_risk_level']));
						 
						 $_SESSION['questions3'][$q]['question']=$rowQ['mq_questions'];
						 $_SESSION['questions3'][$q]['id']=$rowQ['mq_id'];
						 $_SESSION['questions3'][$q]['type']=$rowQ['mq_answer_type'];
						
						
						  if ($rowQ['mq_answer_type']==1)
						  {
							  
							   
						 ?>
                         
                         <div class="w100p">
                            <div class="radio_inline_box">
                            
                            <?php 
							
							for ($j=0;$j<count($arrOptions);$j++)
							{
								
								$optIn=$j+1;
								$textAreClass="class_".$rowQ['mq_id'];
									
								
								?>
                                <label class="custom_radio">
                                
                                <?php 
								
								$imageOpt="";
								$sqlCheck="select * from tbl_question_images where qi_question='".$database->filter($rowQ['mq_id'])."' and qi_option='".$database->filter($j)."'"; 
								$resCheck=$database->get_results($sqlCheck);
								if (count($resCheck)>0)
									{
										$rowCheck=$resCheck[0];
										$imageOpt=$rowCheck['qi_image'];
									}
								
								 ?>
                                  <?php if ($imageOpt!="") { ?>
                                 
                                <img src="<?php print URL;?>classes/timthumb.php?src=<?php echo URL?>uploads/questionnaire/<?php echo $imageOpt ?>&w=280&h=220&zc=2" style="vertical-align: middle;padding:30px">
                                  
                                  
                                  
                                 <?php } ?>
                                    <input type="radio" class="form-check-input" <?php if ($rowQ['mq_ask_for_information']==$optIn){ ?> onChange="openFreeText('txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn; ?>',1)" <?php } else { ?> onClick="openFreeText('class_<?php echo $rowQ['mq_id']?>',0)" <?php } ?> name="rd_<?php echo $rowQ['mq_id']?>" value="<?php echo $arrOptions[$j]?>~~~<?php echo $arrRisk[$j]; ?>" <?php if ($j==0) echo 'data-validation="required"'; ?>>
                                    
                                   
                                    <span><?php echo $arrOptions[$j]?> 
                                </label>
                                 <?php if ($rowQ['mq_ask_for_information']==$optIn){ ?>
                                    	<div><textarea  placeholder="Please provide more information" style="display:none; padding:10px; margin-left:10pxbackground-color: #fbfcfc; min-height: 180px; width:100%; border-radius: 2px; resize: none;" rows="3" cols="30" class="<?php echo $textAreClass;?>" name="txtMore_<?php echo $rowQ['mq_id']?>" id="txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn?>"></textarea></div>
                                    <?php } ?>
                            <?php } ?>
                                
                             </div>
                         </div>
                         
                         <?php } 
                         
                          if ($rowQ['mq_answer_type']==2)
						  {
							  
							 	
							   
						 ?>
                         
                         <ul class="conditions_list">
                         
                         	 <?php 
							 
							
							 
							 for ($j=0;$j<count($arrOptions);$j++)
							{
								$optIn=$j+1;
								//$textAreClass="class_".$rowQ['mq_id'];
							   $arrAskOptions=array();
							   if ($rowQ['mq_ask_for_information']!="")
							   $arrAskOptions=explode(",",$rowQ['mq_ask_for_information']);
								
								?>
                         
                             <li><?php echo $arrOptions[$j]?> 
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="ck_<?php echo $rowQ['mq_id']?>[]" id="ck_<?php echo $rowQ['mq_id']?>" type="checkbox" <?php if (in_array($optIn, $arrAskOptions)) { ?> onChange="openFreeText2('txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn; ?>',<?php echo $rowQ['mq_id']?>)" <?php } ?> value="<?php echo $arrOptions[$j]?>~~~<?php echo $arrRisk[$j]; ?>" role="switch"/>
                                </div>
                             </li>
                            
                           <?php if (in_array($optIn, $arrAskOptions)) { ?>
                           
                                    	<div><textarea rows="3"   placeholder="Please provide more information" cols="40"  style="display:none; padding:10px; margin-left:10pxbackground-color: #fbfcfc; min-height: 180px; width:100%; border-radius: 2px; resize: none;" name="txtMore_<?php echo $rowQ['mq_id']?>" id="txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn?>"></textarea></div>
                                    <?php } ?>
                            
                            <?php } ?>

                         </ul>
                         
                         <?php }
						 
						 if ($rowQ['mq_answer_type']==3)
						  {
							
							   
						 ?>
                         
                        
                         
                         
                                <div>
                                    <textarea  rows="4" style="padding:10px; margin-left:10pxbackground-color: #fbfcfc; min-height: 180px; width:100%; border-radius: 2px; resize: none;" name="txt_<?php echo $rowQ['mq_id']?>" placeholder="Plese provide information"></textarea>
                                </div>
                             </li>
                            
                          

                        
                         
                         <?php }
						 
						  if ($rowQ['mq_answer_type']==4)
						  { ?>
                          
                           <div>
                                    <div id="images4ex" orakuploader="on"></div>
                                    
                                    <div style="padding-top:10px; color:#C33">You can upload upto 5 images</div>
                                    
                                </div>
                          
						  <?php }
						 
						  ?>
                          
                          
                         
                     </div> 
                 
                 <?php }
				}
				  ?>    
                     
                     
                     
            <!--<div class="form-group">
                         <label class="form-label">How long have you been sexually active?</label>
                         <div class="radio_inline_box_grid">
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>< 6 months  </span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span> 6-12 months </span>
                                </label>
                             </div>
                         </div>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>1-5 months</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>> 5 years</span>
                                </label>
                             </div>
                         </div>
                     </div>
                     </div>--> 
             
                  
<?php //print_r ($_SESSION['questions3']); ?>
                 
   <div style="clear:both"></div>        
  <div style="" id="error-container"></div>   
  <div style="clear:both"></div>                 
              
  
         </div>
         
         <div class="setup_white_box mt-4">
             <h3 class="title_3 mt-0 w100p text-center">Your Medication History</h3>
             
             
             <?php
			 
			 	$sqlQ = "SELECT * FROM tbl_medical_questions where mq_status=1 and mq_category=4 and mq_conditions='".$database->filter($_GET['c'])."' order by mq_order asc";
				$resQ = $database->get_results($sqlQ);
				
				if (count($resQ)>0)
				{
				
					for ($q=0;$q<count($resQ);$q++)
					{
						$rowQ=$resQ[$q];
						
						
						
						
					
				 ?>
             
             
                     <div class="form-group">
                         <label class="form-label"><?php echo $rowQ['mq_questions'] ?> <?php if ($rowQ['mq_tooltip_status']==1) { ?> <img src="<?php echo URL?>images/i-icon.png" style="max-height:22px"  title="<?php echo $rowQ['mq_tooltip_text'] ?>"> <?php } ?></label>
                         
                         <?php
						 $arrOptions=array();
						 $arrRisk=array();
						 $arrOptions=unserialize(fnUpdateHTML($rowQ['mq_multiple_options']));
						 $arrRisk=unserialize(fnUpdateHTML($rowQ['mq_risk_level']));
						 
						 $_SESSION['questions3'][$q]['question']=$rowQ['mq_questions'];
						 $_SESSION['questions3'][$q]['id']=$rowQ['mq_id'];
						 $_SESSION['questions3'][$q]['type']=$rowQ['mq_answer_type'];
						
						
						  if ($rowQ['mq_answer_type']==1)
						  {
							  
							   
						 ?>
                         
                         <div class="w100p">
                            <div class="radio_inline_box">
                            
                            <?php 
							
							for ($j=0;$j<count($arrOptions);$j++)
							{
								
								$optIn=$j+1;
								$textAreClass="class_".$rowQ['mq_id'];
									
								
								?>
                                <label class="custom_radio">
                                
                                <?php 
								
								$imageOpt="";
								$sqlCheck="select * from tbl_question_images where qi_question='".$database->filter($rowQ['mq_id'])."' and qi_option='".$database->filter($j)."'"; 
								$resCheck=$database->get_results($sqlCheck);
								if (count($resCheck)>0)
									{
										$rowCheck=$resCheck[0];
										$imageOpt=$rowCheck['qi_image'];
									}
								
								 ?>
                                  <?php if ($imageOpt!="") { ?>
                                 
                                <img src="<?php print URL;?>classes/timthumb.php?src=<?php echo URL?>uploads/questionnaire/<?php echo $imageOpt ?>&w=280&h=220&zc=2" style="vertical-align: middle;padding:30px">
                                  
                                  
                                  
                                 <?php } ?>
                                    <input type="radio" class="form-check-input" <?php if ($rowQ['mq_ask_for_information']==$optIn){ ?> onChange="openFreeText('txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn; ?>',1)" <?php } else { ?> onClick="openFreeText('class_<?php echo $rowQ['mq_id']?>',0)" <?php } ?> name="rd_<?php echo $rowQ['mq_id']?>" value="<?php echo $arrOptions[$j]?>~~~<?php echo $arrRisk[$j]; ?>" <?php if ($j==0) echo 'data-validation="required"'; ?>>
                                    
                                   
                                    <span><?php echo $arrOptions[$j]?> 
                                </label>
                                 <?php if ($rowQ['mq_ask_for_information']==$optIn){ ?>
                                    	<div><textarea  placeholder="Please provide more information" style="display:none; padding:10px; margin-left:10pxbackground-color: #fbfcfc; min-height: 180px; width:100%; border-radius: 2px; resize: none;" rows="3" cols="30" class="<?php echo $textAreClass;?>" name="txtMore_<?php echo $rowQ['mq_id']?>" id="txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn?>"></textarea></div>
                                    <?php } ?>
                            <?php } ?>
                                
                             </div>
                         </div>
                         
                         <?php } 
                         
                          if ($rowQ['mq_answer_type']==2)
						  {
							  
							 	
							   
						 ?>
                         
                         <ul class="conditions_list">
                         
                         	 <?php 
							 
							
							 
							 for ($j=0;$j<count($arrOptions);$j++)
							{
								$optIn=$j+1;
								//$textAreClass="class_".$rowQ['mq_id'];
							   $arrAskOptions=array();
							   if ($rowQ['mq_ask_for_information']!="")
							   $arrAskOptions=explode(",",$rowQ['mq_ask_for_information']);
								
								?>
                         
                             <li><?php echo $arrOptions[$j]?> 
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="ck_<?php echo $rowQ['mq_id']?>[]" id="ck_<?php echo $rowQ['mq_id']?>" type="checkbox" <?php if (in_array($optIn, $arrAskOptions)) { ?> onChange="openFreeText2('txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn; ?>',<?php echo $rowQ['mq_id']?>)" <?php } ?> value="<?php echo $arrOptions[$j]?>~~~<?php echo $arrRisk[$j]; ?>" role="switch"/>
                                </div>
                             </li>
                            
                           <?php if (in_array($optIn, $arrAskOptions)) { ?>
                           
                                    	<div><textarea rows="3"   placeholder="Please provide more information" cols="40"  style="display:none; padding:10px; margin-left:10pxbackground-color: #fbfcfc; min-height: 180px; width:100%; border-radius: 2px; resize: none;" name="txtMore_<?php echo $rowQ['mq_id']?>" id="txtMore_<?php echo $rowQ['mq_id']?>_<?php echo $optIn?>"></textarea></div>
                                    <?php } ?>
                            
                            <?php } ?>

                         </ul>
                         
                         <?php }
						 
						 if ($rowQ['mq_answer_type']==3)
						  {
							
							   
						 ?>
                         
                        
                         
                         
                                <div>
                                    <textarea  rows="4" style="padding:10px; margin-left:10pxbackground-color: #fbfcfc; min-height: 180px; width:100%; border-radius: 2px; resize: none;" name="txt_<?php echo $rowQ['mq_id']?>" placeholder="Plese provide information"></textarea>
                                </div>
                             </li>
                            
                          

                        
                         
                         <?php }
						 
						  if ($rowQ['mq_answer_type']==4)
						  { ?>
                          
                           <div>
                                    <div id="images4ex" orakuploader="on"></div>
                                    
                                    <div style="padding-top:10px; color:#C33">You can upload upto 5 images</div>
                                    
                                </div>
                          
						  <?php }
						 
						  ?>
                          
                          
                         
                     </div> 
                 
                 <?php }
				}
				  ?>    
                     
                     
                     
            <!--<div class="form-group">
                         <label class="form-label">How long have you been sexually active?</label>
                         <div class="radio_inline_box_grid">
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>< 6 months  </span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span> 6-12 months </span>
                                </label>
                             </div>
                         </div>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>1-5 months</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>> 5 years</span>
                                </label>
                             </div>
                         </div>
                     </div>
                     </div>--> 
             
                  
<?php //print_r ($_SESSION['questions3']); ?>
                 
   <div style="clear:both"></div>        
  <div style="" id="error-container"></div>   
  <div style="clear:both"></div>                 
              
  
         </div>
      
     </div>
 </section>
<?php include PATH."include/footer-simple.php"; ?>

           <script type="text/javascript" src="<?php echo URL?>patient/orakuploader/jquery-ui.min.js"></script>
			<script type="text/javascript" src="<?php echo URL?>patient/orakuploader/orakuploader.js"></script>
        
        
<script language="javascript">
$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : 'images/replies',
		orakuploader_thumbnail_path : 'images/replies',
		
		orakuploader_use_main : true,	
		orakuploader_use_dragndrop : true,
		orakuploader_use_rotation: false,
		orakuploader_use_sortable : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 0,
		orakuploader_thumbnail_size  : 0,
		orakuploader_maximum_uploads : 5,
		orakuploader_attach_images: [],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
	
	
});
</script>	

<script src="<?php echo URL?>js/form-validator/jquery.form-validator.js"></script>
<script language="javascript">
				
				
			
				(function($, window) {
			
					// setup datepicker
					
					
			
					window.applyValidation = function(validateOnBlur, forms, messagePosition, xtraModule) {
			
			
			
						if( !forms )
			
							forms = 'form';
			
						if( !messagePosition )
			
							messagePosition = 'bottom';
			
			
			
						$.validate({
			
							form : forms,
			
							validateOnBlur : validateOnBlur,
			
							errorMessagePosition : messagePosition,
			
							scrollToTopOnError : true,
			
							sanitizeAll : 'trim', // only used on form C
			
			
			
							// borderColorOnError : 'purple',
			
			
			
							modules : 'security, location,' +( xtraModule ? ','+xtraModule:''),
			
							onModulesLoaded: function() {
			
			
			
							   // $('#country-suggestions').suggestCountry();
			
								//$('#swedish-county-suggestions').suggestSwedishCounty();
			
			
			
			
			
			
							},
			
			
			
						
			
			
			
							onValidate : function($f) {
			
								console.log('about to validate form '+$f.attr('id'));
			
								var $callbackInput = $('#callback');
			
								if( $callbackInput.val() == 1 ) {
			
									return {
			
										element : $callbackInput,
			
										message : 'This validation was made in a callback'
			
									};
			
								}
			
			
			
							},
			
			
			
							onError : function($form) {
			
							  //alert('Invalid '+$form.attr('id'));
			
			
			
							},
			
			
			
							onSuccess : function($form) {
			
							// alert('Valid '+$form.attr('id'));
							
							
							/*var isChecked = $("#CkTerms").is(":checked");
							if (!isChecked) { 
							alert ("Please accept the terms and conditions");
							return false;
							} */
							
							
							
			
							// $("#submitBtn").attr('disabled','disabled');
			
							 $("#submitBtn").html("Please wait..</div>");
			
								
			
								var myform = document.getElementById("frmApp");
			
								var fd = new FormData(myform);	
			
								   $.ajax({		
								   type: "POST",			
								   url: "<?php echo URL?>patient/questionnaire/ajax/insert-step3.php",			
								   data: fd,			
								   cache: false,			
								   processData: false,			
								   contentType: false,						   
			
			
			
								   success: function(msg){	
								  // alert (msg);	
								  
								 // $("#error-container").html(msg);		
									if (msg==1)			
									  window.location='<?php echo URL?>patient/questionnaire/step4';	
									   else if (msg==2)			
									   {
			
											
										$("#error-container").html("Something went wrong!");	
			
									   }
			
			
			
								  }
			
			
			
								 });
			
			
			
								return false;
			
			
			
							}
			
			
			
						});
			
			
			
					};
			
			
			
			
			
				   window.applyValidation(true, '#frmApp', $('#error-container'), 'sanitize');
			
			
			
			
			
				})(jQuery, window);
			
			function openFreeText (qId,val)
			{
				
				
				
				 
				 
				 if (val==1)
				 $("#"+qId).show();
				 else
				 $('[class^="'+qId+'"]').hide();
				 	
				 			
				  
				
				
			}
			
			function openFreeText2 (qId,id)
			{
				
				
				
				 
				 
				 if ($("#"+qId).is(":visible"))
   				 $("#"+qId).hide();
				 else				 		
				 $("#"+qId).show();
				
				 
					
				  
				
				
			}
			
			</script>
            
  											
