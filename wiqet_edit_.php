<script src="http://backend.wiqet.com/2.0/Wiqet.js" type="text/javascript"></script>
<script type="text/javascript">
function validate() {
	wiqet_name = trim(document.getElementById('wiqet_name').value);

	document.getElementById('config_error').style.display = "none";
	document.getElementById('validate_error').style.display = "none";

	if(wiqet_name =='')
	{
		document.getElementById('validate_error').style.display = "block";
		return false;
	}
	else
	{
		document.getElementById('validate_error').style.display = "none";
		
		unique_id = document.getElementById("unique_id").value;
		customer_id = document.getElementById("customer_id").value;
		wiqet_code = document.getElementById("wiqet_code").value;
		
		if(trim(unique_id) =='' || trim(customer_id) == '')
		{
			document.getElementById('config_error').style.display = "block";
			return false;
		}
		else
		{
			document.getElementById("wiqet_name").value = wiqet_name;
			document.getElementById('wiqet_details').style.display = "none";
			document.getElementById('flashWiqet').style.display = "block";
			showPlayer(customer_id,unique_id,wiqet_code);
			return true;
		}	
	}
	
}
function showPlayer(customerid,uniqueid,wiqet_code) 
{
	var IVcustomerId = customerid;
	var IVuniqueId = uniqueid; //Cannot be empty!
	var IVWiqetCode = wiqet_code;  
	var IVplayerUrl = 'http://www.wiqet.com/media/wiqetflashfiles/wordpress/3-0/editor_photo.swf';
	var IVDisplayUrl = '../wp-content/plugins/wiqet';
	var IVwidth = '500px';
	var IVheight = '420px';
	var IValign = 'middle';
	var IVbgColor = '#ffffff';
	var IVdivForm = 'formWiqet';
	var IVdivPlayer = 'flashWiqet';
	var IVdivLink = 'linkWiqet';
	var IVFormName = 'Wiqet';
	var IVFormnameType = 'hidden'; //or text
	var error = play_wiqet(IVDisplayUrl,IVplayerUrl,'editor',IVWiqetCode,IVcustomerId,IVuniqueId,IVwidth,IVheight,IValign,IVbgColor,IVdivLink,IVdivForm,IVdivPlayer,IVFormName,IVFormnameType, '', '');
if (error) document.write(error);
}



function trim(inputString) 
{
   if (typeof inputString != "string") { return inputString; }
   var retValue = inputString;
   var ch = retValue.substring(0, 1);
   while (ch == " ") { // Check for spaces at the beginning of the string
      retValue = retValue.substring(1, retValue.length);
      ch = retValue.substring(0, 1);
   }
   ch = retValue.substring(retValue.length-1, retValue.length);
   while (ch == " ") { // Check for spaces at the end of the string
      retValue = retValue.substring(0, retValue.length-1);
      ch = retValue.substring(retValue.length-1, retValue.length);
   }
   while (retValue.indexOf("  ") != -1) { // Note that there are two spaces in the string - look for multiple spaces within the string
      retValue = retValue.substring(0, retValue.indexOf("  ")) + retValue.substring(retValue.indexOf("  ")+1, retValue.length); // Again, there are two spaces in each of the strings
   }
   return retValue; // Return the trimmed string back to the user
} // Ends the "trim"
</script>
<body>

<?php
		global $wpdb;

		$table_name = $wpdb->prefix . "wiqet";
		$no_row = $wpdb->query( "SELECT * FROM $table_name where id = $wiqet_id" );
		if($no_row) 
		{
		 $qrys_result = $wpdb->get_results( "SELECT * FROM $table_name where id = $wiqet_id" );
		  foreach($qrys_result as $results) 
		  {
			$wiqet_name = trim($results->wiqetname);
			$wiqet_code = trim($results->wiqetcode);
		  }
		}
		else
		{
			$wiqet_name = '';
			$wiqet_code = '';
		}



		$table_name = $wpdb->prefix . "options";
		$no_rows = $wpdb->query( "SELECT * FROM $table_name where option_name = 'customer_id' || option_name = 'unique_id'" );
		if($no_rows) 
		{
		  $qry_result = $wpdb->get_results( "SELECT * FROM $table_name where option_name = 'customer_id' || option_name = 'unique_id'" );
		  foreach($qry_result as $result) 
		  {
			  if($result->option_name == 'customer_id')
			  {
				$customer_id = trim($result->option_value);

			  }
			  else
			  {
				$unique_id = trim($result->option_value);
			  }
		  }
		}
		else
		{
			$unique_id = '';
			$customer_id = '';
		}
?>

<div id="flashWiqet" style="display:none">Waiting for Wiqet to load..</div>
<div id="linkWiqet" style="display:none"></div>
<form method="post">
<div id="formWiqet"></div>
</form>
<div class = 'noresult' id="validate_error" style="display:none">Please enter Wiqet name.</div>
<div class = 'noresult' id="config_error" style="display:none">Please fill Wiqet Configuration details <a href="?page=wiqet/wiqet.php" title="Click to fill Wiqet Configuration details">here</a> to proceed.</div>
<div id="wiqet_details">
<table style="padding:20px"> 
<tr> 
<td> Name of Wiqet </td>
<td> <input type="text" name="wiqet_name" id="wiqet_name" value="<?php echo $wiqet_name?>"> </td>
</tr>
<tr>
<td colspan="2"> <input type="button" class="button-primary" value="<?php _e('Proceed') ?>" onclick="validate()">
</td>
</tr>
</table>
<input type="hidden" id="result" >
</div>

<input type="hidden" id="unique_id" value="<?php echo $unique_id?>">
<input type="hidden" id="customer_id" value="<?php echo $customer_id?>">
<input type="hidden" id="wiqet_code" value="<?php echo $wiqet_code?>">
<input type="hidden" id="wiqet_id" value="<?php echo $wiqet_id?>">
</body>