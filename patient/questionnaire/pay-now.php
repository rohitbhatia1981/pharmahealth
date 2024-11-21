<?php include "../../private/settings.php";

if ($_GET['s']==1)
$_SESSION['sessSameDayCost']=10;
else
unset($_SESSION['sessSameDayCost']);


include PATH."patient/checksession.php";
include PATH."include/headerhtml.php";


require 'stripe/Stripe.php';

include PATH."private/stripe-settings.php";

if ($params['testmode'] == "on") {
	Stripe::setApiKey($params['private_test_key']);
	$pubkey = $params['public_test_key'];
} else {
	Stripe::setApiKey($params['private_live_key']);
	$pubkey = $params['public_live_key'];
}

if(isset($_POST['stripeToken']))
{
	
	$token = $_POST['stripeToken'];	
	$amount=$_SESSION['sessNetTotal']*100;  
	
	
	$getPatient="select * from tbl_patients where patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
	$resPatient=$database->get_results($getPatient);
	$rowPatient=$resPatient[0];
	
	try {
		
		$customer_name=$rowPatient['patient_first_name']." ".$rowPatient['patient_last_name'];
		
		$customer = Stripe_Customer::create(array(
		'name' => $customer_name,
    	"email" => $rowPatient['patient_email'], // You can replace this with the customer's email
   		"source" => $token, 
		)); 
		
		$customer_id = $customer['id'];	
				
			$charge = Stripe_Charge::create(array(
            'description' => $customer_name . " Amount charged for Prescription ID:" . $_SESSION['sess_pres_id'],
            'customer' => $customer_id,
            'amount' => $amount,
            'currency' => 'GBP',
            'capture' => false // Authorize the charge without capturing it
       		 ));
			 
			 
			 $result = "success";
			} 
	catch(Stripe_CardError $e) {			

	$error = $e->getMessage();
		
		$result = "declined";

	} catch (Stripe_InvalidRequestError $e) {
		$error = $e->getMessage();
		//echo $error;
		$result = "declined";		  
	} catch (Stripe_AuthenticationError $e) {
		$result = "declined";
	} catch (Stripe_ApiConnectionError $e) {
		$result = "declined";
	} catch (Stripe_Error $e) {
		$result = "declined";
	} catch (Exception $e) {

		if ($e->getMessage() == "zip_check_invalid") {
			$result = "declined";
		} else if ($e->getMessage() == "address_check_invalid") {
			$result = "declined";
		} else if ($e->getMessage() == "cvc_check_invalid") {
			$result = "declined";
		} else {
			$result = "declined";
		}		  
	}
	
		if($result == "success" ){
		
		 $add_date = date('Y-m-d H:i:s');
		 
		 
		$chargeId=$charge['id'];
	
		
		 
		 
		 //1.-----updating prescription table to mark it completed and available for clinician--
		 
		 			if (isset($_SESSION['sessSameDayCost']))
					$sameDay=1;
					else
					$sameDay=0;
		 		
					$med_expiry_date= date("Y-m-d", strtotime("+28 days", strtotime($add_date)));	
					$update = array(
					'pres_stage' => 1,
					'pres_incomplete_active' => 0,
					'pres_same_day' => $sameDay,					
					'pres_expiry_date' => $med_expiry_date,
					'pres_date' => $add_date
					);
					
					$where_clause = array(
					'pres_id' => $_SESSION['sess_pres_id']
				
					 );
					
					$database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
		 
		 //--end 1.-------
		 
		 
		 //2. adding medication main and common in table-------
		 
		 $arrMedicineName=array();
		 $pharmaProfit=0;
		 $pharmacyProfit=0;
		 $medicationCost=0;
	
	for ($j=0;$j<count($_SESSION['sessCart']);$j++)
	{
		
		$mName=getMedicineName($_SESSION['sessCart'][$j]['med_id']);
		
		$names = array(
		'pm_pres_id' => $_SESSION['sess_pres_id'],
		'pm_med' => $mName,
		'pm_med_price' => $_SESSION['sessCart'][$j]['med_price'],
		'pm_med_qty' => $_SESSION['sessCart'][$j]['med_qty'],		
		'pm_med_strength' => $_SESSION['sessCart'][$j]['med_strength'],
		'pm_med_packsize' => $_SESSION['sessCart'][$j]['med_pack'],					
		'pm_med_total' => $_SESSION['sessCart'][$j]['med_price']
		
		);
		$add_query = $database->insert('tbl_prescription_medicine', $names );
		
		
		$pharmaProfit=$pharmaProfit+$_SESSION['sessCart'][$j]['pharma_profit'];
		$pharmacyProfit=$pharmacyProfit+$_SESSION['sessCart'][$j]['pharmacyNetProfit'];
		
		$medicationCost=$_SESSION['sessCart'][$j]['medication_actual_cost'];
		$medicineId=$_SESSION['sessCart'][$j]['medicineId'];
		
		array_push($arrMedicineName,$mName);
	}
	
	if (isset($_SESSION['sessCart_common']))
	{
		if (count($_SESSION['sessCart_common'])>0)
		{
		for ($j=0;$j<count($_SESSION['sessCart_common']);$j++)
		{
			
			$mName=getMedicineName_common($_SESSION['sessCart_common'][$j]['med_id']);
			$medPrice=getMedicinePrice_common($_SESSION['sessCart_common'][$j]['med_id']);
			$totalMedCPrice=$medPrice*$_SESSION['sessCart_common'][$j]['med_qty'];
			
			$names = array(
			'pm_pres_id' => $_SESSION['sess_pres_id'],
			'pm_med' => $mName,
			'pm_med_price' => getMedicinePrice_common($_SESSION['sessCart_common'][$j]['med_id']),
			'pm_med_qty' => $_SESSION['sessCart_common'][$j]['med_qty'],
			'pm_med_common' => 1,
			'pm_med_total' => $totalMedCPrice
			
			);
			$add_query = $database->insert('tbl_prescription_medicine', $names );
			
			
			
			array_push($arrMedicineName,$mName);
		}
		}
	}
		 
		 //--end 2.
		 
		  //3. updating medical background
		  
	
		  
	if (isset($_SESSION['arrAllergy']) && count($_SESSION['arrAllergy'])>0)
	{
		foreach ($_SESSION['arrAllergy'] as $value)
		{
			$curDate=date("Y-m-d");
				$names = array(	
					'mb_details' => $value, 
					'mb_patient_id' => $_SESSION['sess_patient_id'],
					'mb_type' => 1,
					'mb_added_date' => $curDate,
					'mb_added_type' => 'through assessment'		
				);
		
				$add_query = $database->insert( 'tbl_patient_medical_background', $names );		
	
	}
	}

	if (count($_SESSION['arrCondition'])>0)
	{
	foreach ($_SESSION['arrCondition'] as $value)
	{
			$curDate=date("Y-m-d");
				$names = array(	
					'mb_details' => $value, 
					'mb_patient_id' => $_SESSION['sess_patient_id'],
					'mb_type' => 2,
					'mb_added_date' => $curDate,
					'mb_added_type' => 'through assessment'		
				);
		
				$add_query = $database->insert( 'tbl_patient_medical_background', $names );		
	
	}
	}

	if (count($_SESSION['arrMedication'])>0)
	{
	foreach ($_SESSION['arrMedication'] as $value)
	{
			$curDate=date("Y-m-d");
				$names = array(	
					'mb_details' => $value, 
					'mb_patient_id' => $_SESSION['sess_patient_id'],
					'mb_type' => 3,
					'mb_added_date' => $curDate,
					'mb_added_type' => 'through assessment'		
				);
		
				$add_query = $database->insert( 'tbl_patient_medical_background', $names );		
	
	}
	}
		  
		  
		 
		 //--end 3.
		 
		  //4. Insert into payment table---
		  
	 	
				$names = array(	
					'payment_amount' => $_SESSION['sessNetTotal'], 
					'payment_sameday' => $_SESSION['sessSameDayCost'], 
					'payment_date' => $add_date,
					'payment_pres_id' => $_SESSION['sess_pres_id'],
					'payment_patient_id' => $_SESSION['sess_patient_id'],
					'payment_condition' => $_SESSION['sessCondition'],
					'payment_pharma_profit' => $pharmaProfit,
					'payment_pharmacy_profit' => $pharmacyProfit,
					'payment_pharmacy_id'=> $rowPatient['patient_pharmacy'],
					'payment_medication_cost' => $medicationCost,
					'payment_consultation_cost' => CONSULTATION_COST,					
					'payment_medicine_id' => $medicineId,					
					'payment_stripe_token' => $token,
					'payment_stripe_customer_id' => $customer_id,	
					'payment_stripe_charge_id' => $chargeId,								
					'payment_status' => 0
							
				);
		
				$add_query = $database->insert( 'tbl_payments', $names );
				
				
			$fullNumber = $_POST['txtNumber'];			
			// Remove spaces
			$numberWithoutSpaces = str_replace(' ', '', $fullNumber);			
			// Get the last four digits
			$lastFourDigits = substr($numberWithoutSpaces, -4);	
				
				
			//----Adding token for patient patient---
			$names = array(	
			'patient_p_id' => $_SESSION['sess_patient_id'],
		    'patient_stripe_cust_id' => $customer_id,
			'patient_stripe_token' => $token,
			'patient_stripe_added' => $add_date,
			'patient_stripe_card_number' => $lastFourDigits
			);
		
		  $add_query = $database->insert( 'tbl_patient_payment_token', $names );		
		  
	
		 
		 //--end 4.
		 
		 
		//------------- sending email---
	
			    include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
		//--------Settings all values--------
		
		if (count($arrMedicineName)>0)
		$strMedicine=implode(",",$arrMedicineName);
		
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
				$orderId=PRES_ID.$_SESSION['sess_pres_id'];
				$medicineName=$strMedicine;
				$subPrice=$_SESSION['sessTotal'];
				$totalPrice=$_SESSION['sessNetTotal'];
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				
				//$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=16 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$emailContent=str_replace("<order_id>",$orderId,$emailContent);
					$emailContent=str_replace("<medicine_name>",$medicineName,$emailContent);
					$emailContent=str_replace("<price>",CURRENCY.$subPrice,$emailContent);
					$emailContent=str_replace("<total_price>",CURRENCY.$totalPrice,$emailContent);				
					$emailContent=str_replace("<name>",$receiverName,$emailContent);										
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$rowMemberid['patient_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Order Confirmation";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
	
	
	//----------Creating log--------
		
					$name=$_SESSION['name'];
					$uid=$_SESSION['sess_patient_id'];
					$utype="patient";
					$action=$name." has submitted a new medical questionnaire Id: PH-".$_SESSION['sess_pres_id'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
	
	
	//-------- send email----
	
	
	unset ($_SESSION['sessCondition']);
	unset ($_SESSION['sess_pres_id']);
	
	unset ($_SESSION['questions']);
	unset ($_SESSION['questions3']);
	unset ($_SESSION['sessCart']);
	unset ($_SESSION['sessTotal']);
	unset ($_SESSION['sessNetTotal']);
	
	unset ($_SESSION['sessCart_common']);
	
	unset ($_SESSION['arrAllergy']);
	unset ($_SESSION['arrCondition']);
	unset ($_SESSION['arrMedication']);
	
	
	
				
				
	
	print "<script>window.location='order-submitted'</script>"; 
		 

}

}


?>
<style>
.card-label {
    position: relative;
    margin-bottom: 20px; /* Adjust as needed */
}

.card-label input[type="tel"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.card-label img.card-icon {
    position: absolute;
    top: 25px; /* Adjust vertical positioning */
    right: 10px; /* Adjust horizontal positioning */
    max-height: 20px; /* Adjust the size of the icon */
}
.card-label input[type="tel"]:focus,
.card-label input[type="text"]:focus,
.card-label input[type="number"]:focus {
    outline: none; /* Remove default focus outline */
    border-color: transparent; /* Set border color to transparent */
    box-shadow: none; /* Remove any box shadow */
}


</style>
  <body style="padding-top:0px;"> 
   <div class="header_2">
       <a href="#"><img src="<?php echo URL?>images/logo.png"></a>
   </div>  
   <section class="patient-order-checkout checkout2">
       <div class="container">
           <ul class="checkout_link">
               <li>
                <a href="#">
                   <span><i class="fa-regular fa-cart-shopping"></i></span>
                   <h6>Your Basket </h6>
                </a>
               </li>
               <li class="active">
                <a href="#">
                   <span><i class="fa-regular fa-credit-card"></i></span>
                   <h6>Payment</h6>
                </a>
               </li>
           </ul>
           <h3 class="title_3 mt-4">Payment</h3>
           <div class="white_card mt-2">
           <form action="" method="POST" name="frmCheckout" id="frmCheckout">
               <div class="row">
                   <div class="col-sm-7 left">
                       <h4 class="title_4">Please enter your Debit or Credit Card details for payment</h4>
                       
                       <div id="payment-errors" style="color:#F00;padding-top:40px"></div>
                       <div class="card_info" style="border:1px solid; " >
                       
                       <div class="payment-tab-content" >
                    
                   <div align="center" style="padding-bottom:20px"> <img src="<?php echo URL?>images/card-icons.png" style="max-width:200px"></div>
                    
                    <div class="row">

							<div class="col-md-12">
								<div class="card-label">
									<label for="cardNumber">Cardholder Name</label>
									<input type="text" value="<?php echo $_SESSION['name'];?>"  name="txtCCName" id="txtCCName"  placeholder="" required >
								</div>
							</div>
                            </div>
						
                         
                          <div class="row">
                            <div class="col-md-12">
                                <div class="card-label">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="tel" data-stripe="number" name="txtNumber" id="txtNumber" placeholder="" value="4242 4242 4242 4242" required>
                                    <img class="card-icon" id="cardTypeIcon" src="" alt="">
                                </div>
                            </div>
                        </div>
                            
                             <div class="row">
                <div class="col-md-6">
                    <div class="card-label">
                        <label for="expiryDate">Expiry Date (MM/YY)</label>
                        <input id="expiryDate" class="form-control" placeholder="MM/YY" value="06/28" name="expiryDate" type="text" required>
                        
                        <input type="hidden" name="txtMM" id="txtMM" value="06" data-stripe="exp_month">
                        <input type="hidden" name="txtYY" id="txtYY" value="28" data-stripe="exp_year">
                        
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-label">
                        <label for="cvv">CVV</label>
                        <input id="cvv" class="form-control" type="text" name="cvv" data-stripe="cvc" value="121" maxlength="4" required>
                    </div>
                </div>
            </div>
					</div>
                           
                        
                        </div>
                       
                       <div class="title_icon mt-4"><i class="fa-regular fa-location-dot"></i> Billing Address</div>
                       <div class="bottom_form">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-label">
                                    <label style="font-size:15px">Address</label>
                                    <input type="text" placeholder="" class="form-control" value="some address" required>
                                </div>
                            </div>
                         
                            <div class="col-sm-6">
                                <div class="card-label">
                                    <label style="font-size:15px">City</label>
                                    <input type="text" placeholder="" class="form-control" value="London">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card-label">
                                    <label style="font-size:15px">Postcode</label>
                                    <input type="text" placeholder="" class="form-control" value="W12 123">
                                </div>
                            </div>
                            
                            <div class="col-sm-10">
                                <button type="submit" id="submitBtn" class="mt-3 btn btn-primary w100p">Confirm & Pay</button>
                            </div>
                        </div>
                    </div>
                   </div>
                   <div class="col-sm-5">
                       <div class="gray_box">
                           <h4 class="title_4">Order Summary</h4>
                           <ul class="card_list mb-5 mt-4">
                               <li>Total Medication Cost:  <span><?php echo CURRENCY?><?php echo formatToTens($_SESSION['sessTotal']); ?></span></li>
                               
                               <?php if (isset($_SESSION['sessSameDayCost'])) { ?>
                               <li>Same-day Service: <span><?php echo CURRENCY?><?php echo $_SESSION['sessSameDayCost']; ?></span></li>
                               <?php } ?>
                               <li>Total Medication Cost:  <span><?php echo CURRENCY?><?php $_SESSION['sessNetTotal']=$_SESSION['sessTotal']+$_SESSION['sessSameDayCost']; echo formatToTens($_SESSION['sessNetTotal']); ?></span></li>
                              
                              
                           </ul>
                           
                           <font style="color:#F00">(Your card will be authorized for the full amount, but no charges will be made until your prescription is approved by our clinical team. 
If your prescription request is rejected by our clinical team, the authorization will be canceled and no charges will be made. If an alternative treatment is available, our clinical team will contact you.)</font>
                           
                       </div>
                   </div>
                    
               </div>
               </form>
           </div>
           
           <!-- Add images for card types -->
<img id="visaIcon" src="<?php echo URL?>images/cards/visa.svg" style="display: none;">
<img id="mastercardIcon" src="<?php echo URL?>images/cards/mastercard.svg" style="display: none;">
<img id="amexIcon" src="<?php echo URL?>images/cards/amex.svg" style="display: none;">
<img id="discoverIcon" src="<?php echo URL?>images/cards/discover.svg" style="display: none;">
           
      <?php include PATH."include/footer-simple.php"; ?>

     <script src="<?php echo URL?>js/jquery.validate.js"></script>
     
     <script language="javascript">
	 $("#frmCheckout").validate({

			rules: {
				
				txtCCName: "required"	

       		 },


			messages: {

				txtCCName: "Please enter your name",				

				/*txtEmail: "Please enter valid email ID",

				txtMobile: "Please enter mobile number",*/

				}
	return false;
	});			
	 
	 </script>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
<script>
 $(document).ready(function() {
    $('#txtNumber').payment('formatCardNumber');
    $('#cvv').payment('formatCardCVC');

    $('#expiryDate').on('input', function(e) {
        var input = $(this).val().replace(/[^0-9]/g, '');
        var formattedInput = '';

        // Get the current year and calculate the maximum year
        var currentYear = new Date().getFullYear();
        var maxYear = (currentYear + 30) % 100; // Only take the last two digits of the year

        if (input.length === 1 && input > '1') {
            formattedInput = '0' + input + '/';
        } else if (input.length === 1 && input <= '1') {
            formattedInput = input;
        } else if (input.length === 2) {
            var month = parseInt(input);
            if (month > 12) {
                formattedInput = '12/';
            } else {
                formattedInput = input + '/';
            }
        } else if (input.length > 2) {
            var month = input.substring(0, 2);
            var year = input.substring(2, 4);
            if (parseInt(month) > 12) {
                month = '12';
            }
            if (parseInt(year) > maxYear) {
                year = maxYear.toString().padStart(2, '0');
            }
            formattedInput = month + '/' + year;
        } else {
            formattedInput = input;
        }

        $(this).val(formattedInput);
    });
	
	
	//--------Card type script
	
	$('#txtNumber').on('input', function() {
        var cardNumber = $(this).val().replace(/ /g, '');

        // Remove all card type images initially
        $('#visaIcon, #mastercardIcon, #amexIcon, #discoverIcon').hide();

        // Regular expressions for card types
        var cardRegex = {
            visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
            mastercard: /^5[1-5][0-9]{14}$/,
            amex: /^3[47][0-9]{13}$/,
            discover: /^6(?:011|5[0-9]{2})[0-9]{12}$/
        };

        // Check each card type and display corresponding icon
        if (cardRegex.visa.test(cardNumber)) {
            $('#cardTypeIcon').attr('src', $('#visaIcon').attr('src')).show();
        } else if (cardRegex.mastercard.test(cardNumber)) {
            $('#cardTypeIcon').attr('src', $('#mastercardIcon').attr('src')).show();
        } else if (cardRegex.amex.test(cardNumber)) {
            $('#cardTypeIcon').attr('src', $('#amexIcon').attr('src')).show();
        } else if (cardRegex.discover.test(cardNumber)) {
            $('#cardTypeIcon').attr('src', $('#discoverIcon').attr('src')).show();
        }
    });	
	
	
	//--------Putting expiry month and year into hidden inputbox
	
	 $('#expiryDate').on('input', function() {
        var expiryDate = $(this).val();
        var parts = expiryDate.split('/');
        
        if (parts.length === 2) {
            $('#txtMM').val(parts[0]);
            $('#txtYY').val(parts[1]);
        }
    });
	
});

    </script>
 
 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<!-- TO DO : Place below JS code in js file and include that JS file -->
<script type="text/javascript">

	Stripe.setPublishableKey('<?php echo $pubkey; ?>');
  
	$(function() {
	  var $form = $('#frmCheckout');
	 
	  $form.submit(function(event) {
		  
		
		 
		 
	//if ($("#txtPhone").val()=="" || $("#txtFirstName").val()=="" || $("#txtLastName").val()==""  || $("#cmbCity").val()=="" ||  $("#txtAddress").val()=="" ||  $("#txtEmail").val()=="" ||  $("#txtPostCode").val()=="")   
	//return false;
		  
		 
		
		// Disable the submit button to prevent repeated clicks:
		$form.find('#submitBtn').prop('disabled', true);
		
		 $("#submitBtn").attr('disabled','disabled');
		 $("#submitBtn").html("Please wait..");
	
		// Request a token from Stripe:
		Stripe.card.createToken($form, stripeResponseHandler);
	
		// Prevent the form from being submitted:
		return false;
	  });
	});

	function stripeResponseHandler(status, response) {
	  // Grab the form:
	   
	 
	  var $form = $('#frmCheckout');
	
	  if (response.error) { // Problem!
	 //alert (response.error.message);
		// Show the errors on the form:
		$('#payment-errors').html(response.error.message);
		$form.find('#submitBtn').prop('disabled', false); // Re-enable submission
		$("#submitBtn").html("Confirm & Pay");
	
	  } else { // Token was created!
	
		// Get the token ID:
		var token = response.id;

		// Insert the token ID into the form so it gets submitted to the server:
		$form.append($('<input type="hidden" name="stripeToken">').val(token));
	
		// Submit the form:
		$form.get(0).submit();
	  }
	};
	
	
</script>	