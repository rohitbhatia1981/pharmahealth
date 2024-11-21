<?php include "../../private/settings.php";

$sql="SELECT m.*
FROM tbl_medication m
JOIN tbl_medication_pricing mp ON m.med_id = mp.mp_medicine
GROUP BY m.med_id
HAVING COUNT(mp.mp_medicine) >0 order by med_title";
$res=$database->get_results($sql);


?>
<script language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
    color: #333;
    margin: 50;
    padding: 0;
    background-color: #f8f9fa;
}

/* Table Cell Styles */
table {
    width: 70%;
    border-collapse: collapse;
    margin: 20px 0;
	padding:0;
}

td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
    vertical-align: middle;
    background-color: #fff;
}

tr:nth-child(even) td {
    background-color: #f2f2f2;
}

td:hover {
    background-color: #e9ecef;
}

/* Select Dropdown Styles */
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
    font-size: 16px;
    color: #333;
    outline: none;
    transition: border-color 0.3s;
}

select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 5px rgba(128, 189, 255, 0.5);
}

/* H3 Header Styles */
h3 {
    font-size: 24px;
    margin: 20px 0;
    color: #007bff;
    border-bottom: 2px solid #007bff;
    padding-bottom: 5px;
}

/* Additional Utility Styles */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px 0;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #0056b3;
}

</style>

<h2>Price Calculator</h2>

<table width="100%">
	<tr>
    	<td width="20%"> Medicine</td>
    	<td>
        	 <select name="cmbMedicine" id="cmbMedicine" onChange="getStrength(this.value)">
            <option value="">Select Medicine</option>
                <?php for ($i=0;$i<count($res);$i++) {
                    $row=$res[$i]; ?>
                <option value="<?php echo $row['med_id'];?>"><?php echo $row['med_title'];?></option>
                <?php } ?>
            </select>
            
        </td>
     </tr>
    <tr>
    <td> Strength</td>
    <td>
    	 <select name="cmbStrength" id="cmbStrength" onChange="getPack()">
            <option value="">Select Strength</option>
         </select>
    
    
    </td><td></td></tr>
    
    <tr>
    <td> Pack Size</td>
    <td>
    	 <select name="cmbPack" id="cmbPack"  onChange="getQuantity()">
            <option value="">Select Pack</option>
         </select>
    
    
    </td><td></td></tr>
    
    <tr>
    <td>Quantity</td>
    <td>
    	 <select name="cmbQty" id="cmbQty">
            <option value="">Select Quantity</option>
         </select>
    
    
    </td><td></td></tr>
    
    <tr>
    <td>Tier</td>
    <td>
    	 <select name="cmbTier" id="cmbTier">
            <option value="">Select Tier</option>
            
            <option value="1">Tier 1</option>
            <option value="2">Tier 2</option>
            <option value="3">Tier 3</option>
           
            
         </select>
    
    
    </td><td></td></tr>
    <tr><td></td><td><input type="checkbox" value="1" name="ckExpress" id="ckExpress" />&nbsp;Express Checkout</td></tr>
    
    <tr><td></td><td><button type="button" class="button" onClick="getPrice()" name="btnSubmit" id="btnSubmit">Get Price</button></td></tr>
	
</table>

<div id="showPricing">

</div>

<script language="javascript">
function getStrength(medId)
{
	
			$.ajax({
			url: 'ajax/get-strength.php', 
			type: 'POST',
			data: { mid: medId},
			success: function(response) {
				$("#cmbStrength").html(response);
			}
			})
			
			getPack();
			
	
}

function getPack()
{
	var medId, sId;
	medId=$("#cmbMedicine").val();
	sId=$("#cmbStrength").val();
	
			$.ajax({
			url: 'ajax/get-pack.php', 
			type: 'POST',
			data: { mid: medId,sid:sId},
			success: function(response) {
				$("#cmbPack").html(response);
			}
			})
			
			getQuantity();
	
}

function getQuantity()
{
	var medId, sId, pId;
	medId=$("#cmbMedicine").val();
	sId=$("#cmbStrength").val();
	pId=$("#cmbPack").val();
	
	
	
			$.ajax({
			url: 'ajax/get-quantity.php', 
			type: 'POST',
			data: { mid: medId,sid:sId,pid:pId},
			success: function(response) {
				$("#cmbQty").html(response);
			}
			})
	
}

function getPrice()
{
	
	    var expr="";
	 // Get values from the fields
        var medicine = $("#cmbMedicine").val();
        var strength = $("#cmbStrength").val();
        var pack = $("#cmbPack").val();
        var qty = $("#cmbQty").val();
        var tier = $("#cmbTier").val();
		
		if ($('#ckExpress:checked').val()==1)
		expr = $('#ckExpress:checked').val();

        // Check if any of the fields are empty
        if (!medicine || !strength || !pack || !qty || !tier) {
            alert("All fields are required.");
            return false;
        }
		
		
		
		
			$.ajax({
			url: 'ajax/get-price.php', 
			type: 'POST',
			data: { mid: medicine,sid:strength,pid:pack,quantity:qty,t:tier,express:expr},
			success: function(response) {
				$("#showPricing").html(response);
			}
			})
		
		
		
}

</script>


<?php
/*function calculatePrice($basePrice, $quantity) {
    // Initial percentages
    $percentages = array(0.6, 0.4, 0.3);
    $increment = 0.3;

    // Calculate the total factor
    $factor = 1;
    for ($i = 0; $i < $quantity - 1; $i++) {
        if ($i < count($percentages)) {
            $factor += $percentages[$i];
        } else {
            $factor += $increment;
        }
    }

    // Calculate the price
    $price = $basePrice * $factor;
    return $price;
}



*/



?>


   
    
    