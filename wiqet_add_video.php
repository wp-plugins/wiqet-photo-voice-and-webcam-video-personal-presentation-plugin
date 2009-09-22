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
<script type="text/javascript" src="http://www.wiqet.com/wiqetapi/?api_key=<?php echo $customer_id?>"></script>
<script type="text/javascript">
function validate() {
	var wiqet_name = trim(document.getElementById("wiqet_name").value);

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
			removeWho('extraWiqetInfo');
			load_editor();
			return true;
		}	
	}
	
}
function removeWho(who) {
     if(typeof who== 'string') who=document.getElementById(who);
    if(who && who.parentNode)who.parentNode.removeChild(who);
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
<h2>Add webcam / video</h2>
</div>
<table style="padding:20px"> 
<tr> 
<td> Please enter name for Wiqet </td>
<td> <input type="text" name="wiqet_name" id="wiqet_name" > </td>
</tr>
<tr>
<td colspan="2"> <input type="button" class="button-primary" value="<?php _e('Proceed') ?>" onClick="validate()">
</td>
</tr>
</table>
<input type="hidden" id="result" >
</div>

<input type="hidden" id="unique_id" value="<?php echo $unique_id?>">
<input type="hidden" id="customer_id" value="<?php echo $customer_id?>">
<div style="visibility:hidden" class="wiqetExplain" id="wiqetExplain">
<span style="font-size:120%;font-weight:bold;">Upload photos and optional add a voice message or music file.
</span><br>

</div> 
<div class="wrapWiqet">
<div style="visibility:hidden" class="wiqetExplainRight" id="wiqetExplainRight">
With the "add video" button you can upload a video file from your computer. A video file size can be maximal 100 Mb. If you want to upload bigger videos you should contact us by email to upgrade your account: <a target="_blank" href="http://www.wiqet.com/?pageid=10&lang=english">via contact form</a>.<br><br>

With the "make webcam" button you can make a webcam video. A flash pop-up will occur which you have to press "allow". You then can start your webcam record by pressing on the "record" button. This button is also the stop recording button. 
When you have uploaded or made a video you can watch the "preview" or directly "save" your Wiqet.

<br>
<br>
Note: you will have always the option to change your Wiqet later on. 

</div>
<div class="extraWiqetInfo" id="extraWiqetInfo">
Wiqets are free but you can order a custom player in your own look and feel and size.<br>
We only want our small Q logo in the corner. <br>
Our standard price for your own look and feel is a one time fee of $200,- dollars.<br>
<br>

<b>The restrictions are:</b>
- Small Q logo in the corner<br>
- Color changes<br>
- Button changes<br>
- Corner changes<br>
- Size of the player (aspect ratio)<br>
<br>

Please contact us by filling in the <a href="http://www.wiqet.com/?pageid=10&lang=english" target="_blank">contact form</a> and requesting custom player (sales).<br>
You can also request a quote for a totally custom player.

</div>
<div style="visibility:hidden" id="flashWiqet"></div>
<!--<div id="linkWiqet"></div>-->
<form method="post" target="_self" name="Wiqet">
      <div id="formWiqet"></div>
</form>  
<script language="javascript">

function load_editor(){
	/**
          Video editor
        */
	 var editor = new wiqet.video.Editor('flashWiqet', {
	        'wiqetCode':            '<?php echo $wiqet_code?>'  //wiqet code for editing only
	      	, 'uniqueId':       '<?php echo $unique_id?>'
	      }
	      , {
	          //default flashplayer properties
	          'width':              '450px'
	        , 'height':             '375px'
	        , 'bgcolor':            '#FFFFFF'
	        , 'align':              'middle'
	        , 'allowScriptAccess':  'always'
	      }, 'onWiqetSaved');
	       
	}

</script>
</body>
