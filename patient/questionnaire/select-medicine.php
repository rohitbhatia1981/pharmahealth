<?php include "../../private/settings.php";
include PATH."patient/checksession.php";
include PATH."include/headerhtml.php"
 ?>
  <body style="padding-top:0px;">  
    <div class="header_2">
       <a href="#"><img src="<?php echo URL?>images/logo.png"></a>
   </div>
 <section class="medication-questionaire">
     <div class="container">
         <h1>Our Recommended Medicine</h1>
        
        
       <section class="hair_products" id="medicines">
	<div class="container"> 
			
			<div class="row">
            
            <?php 
			$condition=33;
			 $sqlMedicine="select * from tbl_medication where med_conditions='".$database->filter($condition)."' and med_status=1";
			
			$resMedicine=$database->get_results($sqlMedicine);
			
			
			for ($j=0;$j<count($resMedicine);$j++)
			{
				$rowMedicine=$resMedicine[$j];
			
			 ?>
				<div class="col-sm-4">
					<div class="hair_products_box" id="box_<?php echo $rowMedicine['med_id']; ?>">
						<div class="img_box" >
							<a href="javascript:void(0)" onClick="putValue(<?php echo $rowMedicine['med_id']; ?>)"><img src="<?php echo URL?>classes/timthumb.php?src=<?php echo URL?>images/medication/<?php echo $rowMedicine['med_image']; ?>&w=400&h=200&zc=1"></a>
                           
						</div>
						<h4><?php echo $rowMedicine['med_title']?> <span>from <b><?php echo CURRENCY.$rowMedicine['med_price']?></b></span></h4>
					</div>
				</div>
                
				
			<?php } ?>	
				 <input type="hidden" name="hdMed" id="hdMed" value="">
            <div class="row">
           		 <div class="col-sm-4 offset-4" align="center" >
                 <div style="color:#F00" id="errMessage"></div>
				     <button type="button" class="btn btn-danger btn-lg d-inline-flex align-items-center mt-4 mb-4" id="submitBtn" name="submitBtn" onClick="fnRecommend()">Continue</button>	
                 </div>
			</div>
			</div>
	</div>
</section>
        
        
         
         </div>
         
     </div>
 </section>

<?php include PATH."include/footer-simple.php"; ?>
<script language="javascript">
function fnRecommend()
{
	if ($("#hdMed").val()!="")
	{
		
		
		$("#submitBtn").attr('disabled','disabled');
		$("#submitBtn").html("Please wait..</div>");
		
		 $.ajax({
             type: "POST",
              url: "set-medicine.php", // Replace with the actual path to your PHP script
              data: { medid: $("#hdMed").val() }, // You can send any data you need to set in the session
              success: function(response) {
				  
				  //alert (response);
                        // Once the session is set, you can redirect the user to another page
						if (response==1)
                        window.location.href = "checkout"; // Replace with the actual URL you want to redirect to
                    }
                });
	}
	else
	{
		$("#errMessage").html("Please click on medicine image to select");
	}
}

function putValue(id)
{
	
	$("#hdMed").val(id);
	
	 $("[id^='box_']").css("border", "none");
	 $("#box_"+id).css("border", "5px solid #F74EB2");
	
}

</script>
