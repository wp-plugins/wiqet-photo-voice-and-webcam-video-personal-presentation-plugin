<script src="http://backend.wiqet.com/2.0/Wiqet.js" type="text/javascript"></script>
<script type="text/javascript">
function validate() {
	var wiqet_name = trim(document.getElementById('wiqet_name').value);

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
		
		var unique_id = document.getElementById("unique_id").value;
		var customer_id = document.getElementById("customer_id").value;
		
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
			document.getElementById('flashWiqet').style.visibility = "visible";
			document.getElementById('wiqetExplain').style.visibility = "visible";
			document.getElementById('wiqetExplainRight').style.visibility = "visible";
			//showPlayer(customer_id,unique_id);
			return true;
		}	
	}
	
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

<div class = 'noresult' id="validate_error" style="display:none">Please enter Wiqet name.</div>
<div class = 'noresult' id="config_error" style="display:none">Please fill Wiqet Configuration details <a href="?page=wiqet-options" title="Click to fill Wiqet Configuration details">here</a> to proceed.</div>
<div id="wiqet_details">
<div class="wrap">
<h2>Add voice and photo</h2>
</div>
<table style="padding:20px"> 
<tr> 
<td> Please enter name for Wiqet </td>
<td> <input type="text" name="wiqet_name" id="wiqet_name" ></td>
</tr>
<tr>
<td colspan="2"> <input type="button" class="button-primary" value="<?php _e('Proceed') ?>" onClick="validate()">
</td>
</tr>
</table>
<input type="hidden" id="result" >
</div>
<?php
		global $wpdb;
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
				//echo $unique_id;
			  }
		  }
		}
		else
		{
			$unique_id = '';
			$customer_id = '';
		}
?>
<input type="hidden" id="unique_id" value="<?php echo $unique_id?>">
<input type="hidden" id="customer_id" value="<?php echo $customer_id?>">
<div style="visibility:hidden" class="wiqetExplain" id="wiqetExplain">
<span style="font-size:120%;font-weight:bold;">Upload photos and optional add a voice message or music file.
</span><br>

</div> 
<div class="wrapWiqet">
<div style="visibility:hidden" class="wiqetExplainRight" id="wiqetExplainRight">

<span class="emphisize">Step 1.</span> With the add photos button you can upload one or more (up to 50) photos. Each photo you upload you can edit (zoom in/out or rotate).<br><br>

<span class="emphisize">Step 2.</span> Add a voice message by using your microphone. You press on the microphone icon and then a flash pop-up will occur. You have to press "allow" and then you can record your message by pressing on the record button. This button is also the stop recording button. Instead of recording a voice message you can also choose to upload a music file.<br>
<br>
When you have uploaded a photo and/or added a voice message, music file you can watch the "preview" or 
directly "save" your Wiqet. 
<br>
<br>
Note: you will have always the option to change your Wiqet later on. 

</div>
<div style="visibility:hidden" id="flashWiqet"></div>
<!--<div id="linkWiqet"></div>-->
<form method="post" target="_self" name="Wiqet">
      <div id="formWiqet"></div>
</form>  
</div>
<script language="javascript">

var IVcustomerId = document.getElementById("customer_id").value;
var IVuniqueId = document.getElementById("unique_id").value; //Cannot be empty!
var IVWiqetCode = '';  
var IVplayerUrl = '/wp-content/plugins/wiqet/editor_photo.swf';
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


</script>
<div id="infoWiqet"></div>
</body>
