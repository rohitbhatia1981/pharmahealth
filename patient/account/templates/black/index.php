<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<!-- Title -->
		<title>Patient Account - <?php echo TITLE; ?></title>

		<!--Favicon -->
		<link rel="icon" href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/images/brand/favicon.ico" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/css/style.css" rel="stylesheet" />
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/css/dark.css" rel="stylesheet" />
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/css/skin-modes.css" rel="stylesheet" />


		
		<!-- Animate css -->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/css/animated.css" rel="stylesheet" />
		
		<!--Sidemenu css -->
        <link  href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/css/sidemenu.css" rel="stylesheet">

		<!--Texteditor css -->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/wysiwyag/richtext.css" rel="stylesheet">
		
		<!-- P-scroll bar css-->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/css/icons.css" rel="stylesheet" />

		<!---Sidebar css-->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/sidebar/sidebar.css" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/select2/select2.min.css" rel="stylesheet" />
		

		<!--- INTERNAL jvectormap css-->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/jvectormap/jqvmap.css" rel="stylesheet" />

		<!-- INTERNAL Data table css -->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

		<!-- INTERNAL Time picker css -->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />

		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        
        <link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/date-picker/date-picker.css" rel="stylesheet" />
        
        <link rel="stylesheet" href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css">
        
       
        

		<!-- INTERNAL jQuery-countdowntimer css -->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.css" rel="stylesheet" />
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/accordion/accordion.css" rel="stylesheet" />
		
		
        <!-- INTERNAL WYSIWYG Editor css -->
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />
        
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/quill/quill.snow.css" rel="stylesheet">
		<link href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/quill/quill.bubble.css" rel="stylesheet">

		
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
        <script src="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/jquery/jquery.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>-->
		
		<script src="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/jquery.tokeninput.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/token-input.css">
		
		<!-- Orakuploader CSS-->
		<link type="text/css" href="<?php echo URL?><?php echo PATIENT_ADMIN?>orakuploader/orakuploader.css" rel="stylesheet"/>
	
		<!-- Jquery js-->
		
		<script src="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/jquery/jquery.validate.js"></script>

		<link rel="stylesheet" href="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/multipleselect/multiple-select.css">

		<script src="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/multipleselect/multiple-select.js"></script>
		<script src="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/multipleselect/multi-select.js"></script>


		<!-- Orakuploader js-->
		<script type="text/javascript" src="<?php echo URL?><?php echo PATIENT_ADMIN?>orakuploader/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo URL?><?php echo PATIENT_ADMIN?>orakuploader/orakuploader.js"></script>
        
        <script src="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/modal-datepicker/datepicker.js"></script>
   
    <script src="<?php echo URL?><?php echo PATIENT_ADMIN?>templates/black/assets/plugins/date-picker/date-picker.js"></script>
		
	

	</head>
<!-- BEGIN BODY -->
<body class="app sidebar-mini">

		<div class="page">
			<div class="page-main">
        
         <?php require_once(PATH.PATIENT_ADMIN."templates/black/includes/sidebar.php"); ?>
		 <div class="app-content main-content">
			<div class="side-app">
				<?php require_once(PATH.PATIENT_ADMIN."templates/black/includes/header.php"); ?>
		
						<?php 
				
					
				

				if ($_GET['c']=="")
				$component="dashboard";
				else
				$component=$_GET['c'];
				
				
				 $filename = PATH.PATIENT_ADMIN."components/".$component."/controller.php";
				
				if (file_exists($filename))
				require_once($filename);
				else
				require_once(PATH.PATIENT_ADMIN."components/error/view.php");
				 ?>
        
			</div>
        </div>
                
              <?php require_once(PATH.PATIENT_ADMIN."templates/black/includes/footer.php"); ?>  
			


			<?php
				$user_sql = "SELECT * FROM tbl_users where user_id=".$_SESSION['sess_patient_id'];
				$user = $database->get_results( $user_sql );
			?>



<script>
	$("document").ready(function(){
		<?php if($_GET['c'] != "managepassword" && $user[0]['updatedpassword'] == 0) { ?>
			$("#password_alert").show();
		<?php } ?>
		$(".model_opener").on("click", function(){
			$("#leaveapplictionmodal .ev_logs").show();
			var staffcode = $(this).attr("data-staffcode");
			var staffname = $(this).attr("data-staffname");
			var leavetype = $(this).attr("data-leavetype");
			var startdate = $(this).attr("data-startdate");
			var enddate = $(this).attr("data-enddate");
			var applieddate = $(this).attr("data-applieddate");
			var status = $(this).attr("data-status");
			var comment = $(this).attr("data-comment");
			var log = $(this).attr("data-log");
			var file = $(this).attr("data-file");
			$("#leaveapplictionmodal").show();
			$("#leaveapplictionmodal .staffcode").text(staffcode);
			$("#leaveapplictionmodal .staffname").text(staffname);
			$("#leaveapplictionmodal .leavetype").text(leavetype);
			$("#leaveapplictionmodal .file").html(file);
			$("#leaveapplictionmodal .startdate").text(startdate);
			$("#leaveapplictionmodal .enddate").text(enddate);
			$("#leaveapplictionmodal .applieddate").text(applieddate);
			$("#leaveapplictionmodal .status").text(status);
			$("#leaveapplictionmodal .comment").text(comment);
			$("#leaveapplictionmodal .ev_log_data").html(log);
			if(log == "") {
				$("#leaveapplictionmodal .ev_logs").hide();
			}
		});
		$(".model_petitionsopener").on("click", function(){
			var title = $(this).attr("data-title");
			var description = $(this).attr("data-description");
			var file = $(this).attr("data-file");
			var court_type = $(this).attr("data-court_type");
			var created_by = $(this).attr("data-created_by");
			var created_at = $(this).attr("data-created_at");
			var log = $(this).attr("data-log");
			$("#petitionmodal").show();
			$("#petitionmodal .title").text(title);
			$("#petitionmodal .description").text(description);
			$("#petitionmodal .file").html(file);
			$("#petitionmodal .court_type").text(court_type);
			$("#petitionmodal .created_by").text(created_by);
			$("#petitionmodal .created_at").text(created_at);
			$("#petitionmodal .ev_log_data").html(log);
			if(log == "") {
				$("#petitionmodal .ev_logs").hide();
			}
		});
		$(".modal-footer a").on("click", function(){
			$("#leaveapplictionmodal, #petitionmodal").hide();
		});
		$(".forwardopener").on("click", function(){
			var href = $(this).attr("data-href");
			var id = $(this).attr("data-id");
			$("#forwardmodal form [name='claim_id']").val(id);
			$("#forwardmodal").show();
			$("#forwardmodal form").attr("action",href);
		});
		$(".objectionopener").on("click", function(){
			var href = $(this).attr("data-href");
			var id = $(this).attr("data-id");
			$("#forwardmodal form [name='petition_id']").val(id);
			$("#forwardmodal").show();
			$("#forwardmodal form").attr("action",href);
		});
		$(".proceedtoforward").on("click", function(){
			$("#forwardmodal form").submit();
		});
		$(".rejectopener").on("click", function(){
			$(".proceedtoreject").attr("data-href","");
			var href = $(this).attr("data-href");
			$(".proceedtoreject").attr("data-href",href);
			$("#leaverejectmodal").show();
		});
		$(".proceedtoreject").on("click", function(){
			var href = $(this).attr("data-href");
			href = href + "&remark=" + $("[name='remarkmessage']").val();
			window.location= href;
		});
		$('[name="groupid"]').on("change", function(){
			$('#establishment_office').removeAttr('multiple');
			if($(this).val() == 3) {
				$('#establishment_office').attr('multiple','multiple');
			}
		});
		$('.ev_budgetopener').on("click", function(){
			$(".budget_row").hide();
			$(this).parent("div").parent("div").parent("td").parent("tr").next("tr").show();
		});
		$('[name="leave_from"],[name="leave_to"]').on("change", function(){
			$(".ev_errormsg").remove();
			$('[type="submit"]').prop('disabled', false);
			var start = $('[name="leave_from"]').val();
			var end = $('[name="leave_to"]').val();
			var days = daysdifference(start, end);
			var available = $('[name="leave_subject"]').find("option:selected").attr("data-avaliable");
			if(days > available) {
				$(".card-footer").append('<span class="badge badge-danger ev_errormsg mt-4" style="float: left;width: 100%;">Your '+$('[name="leave_subject"]').val()+' leave budget is not sufficient to apply for the period selected.</span>')
				$('[type="submit"]').prop('disabled', true);
			}
		});
		function daysdifference(firstDate, secondDate){  
			var startDay = new Date(firstDate);  
			var endDay = new Date(secondDate);     
			var millisBetween = startDay.getTime() - endDay.getTime();  
			var days = millisBetween / (1000 * 3600 * 24);  
			return Math.round(Math.abs(days));  
		}
		$(".item_chckboxctrl").on("change",function(){
			if($(".item_chckboxctrl").is(':checked')){
				$(".item_chckbox").prop('checked', true);
			} else{
				$(".item_chckbox").prop('checked', false);
			}
		});
		$(".action_btn").on("click",function(){
			href = $(this).attr("data-href");
			$('[name="adminForm"]').attr("action",href);
			var item_chckbox = $(".item_chckbox:checked").map(function(){
                return $(this).val();
            }).get();
            if(item_chckbox.length > 0) {
            	href = href + "&itemaction=" + item_chckbox;
            }
			window.location=href;
		});
	});
</script>