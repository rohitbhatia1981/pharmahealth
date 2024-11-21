<?php include "../../private/settings.php";
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


	//$charge_id="ch_3PXL81Fai0RMyBsI00Qs0Qw0";
		
	try {	
			$charge = Stripe_Charge::retrieve($charge_id);
			$charge->refund();
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



