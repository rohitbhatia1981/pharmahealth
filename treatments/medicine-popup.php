<?php include "../private/settings.php";

$sqlMedicine="select * from tbl_medication where med_id='".$database->filter($_GET['m'])."' and med_status=1";
$resMedicine=$database->get_results($sqlMedicine);
if (count($resMedicine)>0)
$rowMedicine=$resMedicine[0];
else
exit;
/*$sqlTreatments="select * from tbl_conditions where condition_status=1 and condition_id='".$database->filter($_GET['c'])."'";
$resTreatments=$database->get_results($sqlTreatments);

$rowTreatments=$resTreatments[0];*/

include PATH."include/headerhtml.php";
 ?>




<div class="container">
	<div class="row">
		
		<div class="col-md-8">
			<div class="right">
             <form action="" id="frmMedPop" method="POST">
				<h2 class="title_h2" style="font-size:24px"><?php echo $rowMedicine['med_title'] ?></h2>
				<p><?php echo fnUpdateHTML($rowMedicine['med_small_description']); ?></p>
                
                <?php
				$sqlStrength="select mp_strength,mp_unit from tbl_medication_pricing where mp_medicine='".$database->filter($rowMedicine['med_id'])."'";
				$resStrength=$database->get_results($sqlStrength);
				if (count($resStrength)>0)
				{
				?>				
				
				<div class="strength_box">
					<h6>Strength:</h6>
					<ul>
                    
                    <?php
					for ($k=0;$k<count($resStrength);$k++)
					{
						$rowStrength=$resStrength[$k];
						
						if ($_SESSION['sessCart'][$_GET['index']]['med_strength']!="")
						{
							$selStrength=explode(" ",$_SESSION['sessCart'][$_GET['index']]['med_strength']);
							$selStrengthVal=$selStrength[0];
						}
						
						
						
					?>
						<li>
							<label>
								<input  value="<?php echo $rowStrength['mp_strength']; ?>" <?php if ($rowStrength['mp_strength']==$selStrengthVal) echo "checked"; ?> type="radio" id="rdStrength" name="rdStrength" onChange="fnGetStrength()" required>
								<span><small><?php echo $rowStrength['mp_strength'].' '.$rowStrength['mp_unit']; ?></small></span>
							</label>
						</li> 
                    <?php } ?>
					</ul>
				</div>
               <?php } ?>
               
               <div id="spanPack" style="display:none">
                    
                </div>
                
                <div id="spanQty" style="display:none"></div>
                
                 <div id="spanPeriod" style="color:#00C" ></div>
                
                </div>
           </div>   
           
           
           <div class="col-md-4">
				<div style="height:20px"></div>
                <div class="product_price_box">
                
					<h3><span id="showPricing" style="height:20px"></span></h3>
                    
                   	  
					
				</div>
                <div style="clear:both">
                <button class="btn btn-danger btn-lg" id="submitBtn" style="width:100%">Update</button>
                <input type="hidden" name="hdMedicine" value="<?php echo $rowMedicine['med_id'] ?>">
                <input type="hidden" name="hdQty" value="1">
   				</div>             
                
               
				
             </div>  
               
                
                
                
		</div>
        
        
	</div>



  
 
 

</div>





<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
 <script language="javascript">
 
 $(document).ready(function() {
    // Function to open modal
    function openModal(modalId) {
        $('#' + modalId).css('display', 'block');
    }

    // Function to close modal
    function closeModal(modalId) {
        $('#' + modalId).css('display', 'none');
    }

    // Event listener for open modal buttons
    $('.openModalBtn').click(function() {
        var modalId = $(this).data('modal-id');
        openModal(modalId);
    });

    // Event listener for close buttons
    $('.close').click(function() {
        var modalId = $(this).closest('.modal').attr('id');
        closeModal(modalId);
    });

    // Event listener for clicks outside the modal
    $(window).click(function(event) {
        if ($(event.target).hasClass('modal')) {
            closeModal($(event.target).attr('id'));
        }
    });
});
 

 function removefromcart(id)
 {
	 //alert (id);
	 
	 $("#cartInner_"+id).html("<i class='fa fa-spinner fa-spin'></i>");
	 
	 $.ajax({
                    type: 'POST',
                    url: 'ajax/removefromcart-common.php',
                    data: { cid: id },
                    success: function(response){
                        $("#cartInner_"+id).html('<button class="btn btn-primary" onClick="addCommon(<?php echo $rowCom['med_c_id']?>)">Add to Cart</button>');
                    }
                });
				
				location.reload();
 }
 
 				function fnGetStrength() {              
           		 				 
				
				 
				 var medId, sId;
					medId=<?php echo $_GET['m']?>;
						
					sId=$('input[name="rdStrength"]:checked').val();	
				 
				
						$.ajax({
						url: 'ajax/get-pack.php', 
						type: 'POST',
						data: { mid: medId,sid:sId,indexId:<?php echo $_GET['index']?>},
						success: function(response) {
							$("#spanPack").html(response);
							$("#spanPack").show();
							$("#spanQty").hide();
							$("#showPricing").html("");
							getQuantity();
						}
						})
						
				}
				fnGetStrength();
				
				
				function getQuantity()
				{
					
					var medId, sId, pId;
					
				
								
					
					medId=<?php echo $_GET['m']?>;
					sId = $('input[name="rdStrength"]:checked').val();
					pId=$('input[name="rdPack"]:checked').val();
					
	
					$.ajax({
					url: 'ajax/get-quantity.php', 
					type: 'POST',
					data: { mid: medId,sid:sId,pid:pId,indexId:<?php echo $_GET['index']?>},
					success: function(response) {
						$("#spanQty").html(response);
						$("#spanQty").show();
						getPrice();
					}
					})
				
				
				
							
							
						}
						
			function getPrice()
			{
				
				
				 // Get values from the fields
					var medicine = <?php echo $_GET['m']?>;
					var strength = $('input[name="rdStrength"]:checked').val();
					var pack = $('input[name="rdPack"]:checked').val();
					var qty = $('input[name="rdQuantity"]:checked').val();;
					var tier = 1;
					
					
			
					// Check if any of the fields are empty
					//if (!medicine || !strength || !pack || !qty || !tier) {
						//alert("All fields are required.");
						//return false;
					//}
					
					
					
					
						$.ajax({
						url: 'ajax/get-price.php', 
						type: 'POST',
						data: { mid: medicine,sid:strength,pid:pack,quantity:qty,t:tier},
						success: function(response) {							
							
							var resultArray = response.split('~');							
							$("#showPricing").html(resultArray[0]);							
							if (resultArray[1] && resultArray[1].trim() !== "")
							$("#spanPeriod").html(resultArray[1]);
							
						}
						})
					
					
					
			}
			
	
    // Attach a submit event handler to the form
    $('#frmMedPop').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
		
		 $("#submitBtn").attr('disabled','disabled');
		 $("#submitBtn").html("Please wait..</div>");
        
        // Use AJAX to submit the form data
        $.ajax({
            url: 'add-to-cart.php', // The PHP file that will process the form
            type: 'POST', // The HTTP method to use for the request
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                // Handle the success response
               
				parent.$('#myModal2').modal('hide');
                parent.location.reload(); 
                // You can also update the page dynamically, like updating the cart count
            },
            error: function(xhr, status, error) {
                // Handle any errors
                alert('An error occurred while adding to cart.');
            }
        });
    });


				 
 
 </script>