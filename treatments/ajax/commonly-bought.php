<?php include "../../private/settings.php";
$sqlGetUnique="select * from tbl_commonly_bought where med_c_id='".$database->filter($_GET['id'])."'";
$resGetUnique=$database->get_results($sqlGetUnique);
$rowCom=$resGetUnique[0];
?>
<style>
.right-side {
    max-height: 400px; /* Limit the height to 400px */
    overflow-y: auto;  /* Enable vertical scrolling if content overflows */
    padding: 10px;     /* Optional padding for inner content */
    border: 0px solid #ccc; /* Optional border for styling */
    border-radius: 5px; /* Rounded corners */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Custom scrollbar styling */
.right-side::-webkit-scrollbar {
    width: 8px; /* Scrollbar width */
}

.right::-webkit-scrollbar-track {
    background: #f1f1f1; /* Background color for scrollbar track */
    border-radius: 10px; /* Rounded corners */
}

.right-side::-webkit-scrollbar-thumb {
    background: linear-gradient(90deg, #F8FAFB, #1C9CA0); /* Gradient color for scrollbar */
    border-radius: 10px; /* Rounded corners for scrollbar */
}

.right-side::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(90deg, #388e3c, #689f38); /* Darker gradient on hover */
}

</style>

<div class="container">
	<div class="row">
		<div class="col-sm-5">
        <?php //print_r ($_SESSION['sessCart_common']); ?>
			<div class="product_img">
				<img src="<?php echo URL?>classes/timthumb.php?src=<?php echo URL?>images/medication/common/<?php echo $rowCom['med_c_image']; ?>&w=540&h=331&zc=2">
			</div>
			<div class="product_note">
				<p>*  Images for illustrative purposes only</p>
				<p>*  Brand supplied may vary depending on stock availability</p>
				<!--<ul class="list_item">
					<li>Proven hair loss treatment</li>
					<li>Reduces hair loss</li>
					<li>New hair growth</li>
				</ul>-->
                
               
                
                
			</div>	
		</div>
		<div class="col-md-7">
			<div class="right right-side">
            <?php echo fnUpdateHTML($rowCom['med_c_desc']); ?>
            </div>
           </div>     
               
          </div>
          
</div>