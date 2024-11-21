<?php

//defined('_VALID_ACCESS') or die("Invalid Access");



$component=$_GET['c'];

$task=@$_GET['task'];

$id=@$_GET['id'];





require_once(PATH.PHARMACY_ADMIN."components/".$component."/functions.php");

require_once(PATH.PHARMACY_ADMIN."components/".$component."/view.php");



switch($task)

	{

		

		case "add":

			createFormForPages(0);

			break;

		

		case "edit":

			createFormForPages($id);

			break;
			
		
		case "detail":
		createFormForPages_detail($id);
		break;
		
		case "presstatus":
		changePresStatus();
		break;
		
		

		

		case "save":

			saveFormValues();

			break;

		case 'sendmessage':
		savemessage();
		break;

		case 'saveedit':



			saveModificationsOperation();



			break;

			

		case 'publishList':

			

			publishSelectedItems();



			break;

			

		case 'unpublishList':

			

			unpublishSelectedItems();



			break;

			

		case 'remove':

			

			removeSelectedItems();



			break;

		

		

			
			
		case 'deleted':
		removeDeletedItems();
		break;	
		
		case 'sale':
		showList();
		break;
		
		case 'payout':
		showPayout();
		break;
		
		case 'presreport':
		showPresReport();
		break;
		
		case 'uncollected':
		showUncollectedReport();
		break;
		
		case 'patientreport':
		showPatientReport();
		break;
		
		case 'perfreport':
		showPerformanceReport();
		break;
		
		default:
		showOptions();
		break;


		/*case "edit":

			createFormForPages($id);

			break;

		case "save":

			saveFormValues();

			break;*/

		

	}







?>

