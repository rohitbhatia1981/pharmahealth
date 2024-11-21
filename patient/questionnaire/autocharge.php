<?php include "../../../private/settings.php";
//include PATH."include/headerhtml.php";

require 'stripe/Stripe.php';

include PATH."private/stripe-settings.php";

if ($params['testmode'] == "on") {
	Stripe::setApiKey($params['private_test_key']);
	$pubkey = $params['public_test_key'];
} else {
	Stripe::setApiKey($params['private_live_key']);
	$pubkey = $params['public_live_key'];
}


	
	//$token = "tok_1OacZQBOJPiL5nbDkHpfPYca";
	//$customer_id = $stripe_customerId;	
	$amount=$amountCharge*100;
	
	
	try {	
			$subs = Stripe_Charge::create(array(
			'description' =>  $customerName." Prescription ID: ".$presId." is Approved",
			"customer" => $customer_id,
			
			"amount" => $amount,
             "currency" => "GBP"			
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
	
	
	
	




 ?>



