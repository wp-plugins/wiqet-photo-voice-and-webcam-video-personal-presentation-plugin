<?php
/*
Plugin Name: Wiqet Plugin
Plugin URI: http://www.wiqet.com/
Description: Wiqet is the easy to use multimedia tool for personalisation of your Worpress blog. Upload photos (and edit them in/outzoom, rotate), Add voice comment (via your own microphone), Upload all type of videos, Upload music files, Make webcam videos and share your Wiqet.

Version: 1.05
Author: <a href="http://www.wiqet.com" target="_blank">Wiqet Media.</a> and Smart Buzz Inc.

License: LGPL v3 - http://www.gnu.org/licenses/lgpl.html

Requires WordPress 2.6 or later. Not for use with WPMU.

Recent changes:
see readme.txt

*/



$wiqet_db_version = "2.9";

function wiqet_install() {
	global $wpdb;
    $table_name = $wpdb->prefix . "wiqet";

	// check if table already exists 
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$sql = "CREATE TABLE " . $table_name . " (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  wiqetname varchar(55) NOT NULL,
	  wiqetcode varchar(55) NOT NULL,
	  wiqet_type varchar(10) NOT NULL,
	  UNIQUE KEY id (id)
	);";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	
	add_option("wiqet_db_version", $wiqet_db_version);
	
	}
}

function wiqet_uninstall() {
	global $wpdb;
    $table_name = $wpdb->prefix . "wiqet";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	//dbDelta($sql); 
	
}


// call when plugin is activated by admin
register_activation_hook(__FILE__,'wiqet_install');

//call when plugin is deactivated
register_deactivation_hook(__FILE__,'wiqet_uninstall');


//add administrative menu 
add_action('admin_menu', 'wiqet_menu');

//add javascript code in header
add_action('admin_print_scripts', 'wiqet_js_admin_header' );

//add function which will handle ajax events
add_action('wp_ajax_wiqet_elev_lookup', 'wiqet_ajax_elev_lookup' );

// add function to catch media event
add_action('admin_head','remove');



function wiqet_menu() {
 
  //add_menu_page(page_title, menu_title, access_level/capability, file, [function], [icon_url]); 
 
  add_menu_page('Wiqet| Voice and Media Player', 'Wiqet Options', 8, __FILE__, '', '../../wp-content/plugins/wiqet-photo-voice-and-webcam-video-personal-presentation-plugin/images/wiqetlogo16.png');
  add_submenu_page(__FILE__, 'Wiqet List - Voice and Media Player', 'List Wiqets', 8, __FILE__, 'wiqet_list');
  add_submenu_page(__FILE__, 'Wiqet Add - Voice and Media Player', 'Add voice and photo', 8, 'wiqet-add', 'wiqet_add');
  add_submenu_page(__FILE__, 'Wiqet Add - Webcam and video Player', 'Add webcam / video', 8, 'wiqet-add-video', 'wiqet_add_video');
  add_submenu_page(__FILE__, 'Wiqet Configuration - Voice and Media Player', 'Configuration', 8, 'wiqet-options', 'wiqet_options');

	
  //hidden menus
  add_submenu_page('tmpMenu', 'Wiqet Edit - Voice and Media Player', 'a', 8, 'wiqet-edit', 'wiqet_edit');
  add_submenu_page('tmpMenu', 'Wiqet Delete - Voice and Media Player', 'ab', 8, 'wiqet-delete', 'wiqet_delete');
  add_submenu_page('tmpMenu', 'Wiqet Media - Voice and Media Player', 'ac', 8, 'wiqet-media', 'wiqet_media');
  
  
}


function wiqet_list() { 
	include("wiqet_list.php");
 
}



function wiqet_options() {
  include("wiqet_options.php"); 
  
}

function wiqet_add() {
  include("wiqet_add.php"); 
}

function wiqet_add_video() {
  include("wiqet_add_video.php"); 
}

function wiqet_edit() {
  $wiqet_id = addslashes($_GET['id']);
  include("wiqet_edit.php"); 
}

function wiqet_delete() {
  $wiqet_id = addslashes($_GET['id']);
  include("wiqet_delete.php"); 
}

function wiqet_media() {
  
  include("wiqet_media.php"); 
}

function wiqet_js_admin_header() {
	wp_print_scripts( array( 'sack' ));
	?>
	<script type="text/javascript">
	//<![CDATA[
		
		function onWiqetSaved(wiqetCode, deleteCode, deletePinCode) {
		      var wiqetCode = wiqetCode;
		      //alert('wiqetCode:'+wiqetCode+', deleteCode:'+deleteCode+', deletePinCode:'+deletePinCode);
			  code = wiqetCode;
			  url =  'http://www.wiqet.com/index.php?wiqetCode='+wiqetCode;
			  name = document.getElementById("wiqet_name").value;
			  wiqet_code = '';;
			  wiqet_id = '';
			  
			  if(document.getElementById("wiqet_code"))
			  { wiqet_code = document.getElementById("wiqet_code").value;}
			  if(document.getElementById("wiqet_id"))
			  { wiqet_id = document.getElementById("wiqet_id").value;}
			  
			 
			  //for addition of new wiqet
			 if(wiqet_code == '' && wiqet_id == '')
			 {
			  var mysack = new sack("<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php" );    
			  mysack.execute = 1;
			  mysack.method = 'POST';
			  mysack.setVar( "action", "wiqet_elev_lookup" );
			  mysack.setVar( "wiqet_code", code );
			  mysack.setVar( "wiqet_name",  name );
			  mysack.onError = function() { alert('Ajax error in Wiqet Plugin' )};
			  mysack.runAJAX();
			  alert('Wiqet was saved successfully');
			  //reply = confirm('Do you wish to add some more images to this Wiqet?','');
			  //if(!reply)
			  document.location.href= "?page=wiqet-photo-voice-and-webcam-video-personal-presentation-plugin/wiqet.php&message=success";
			  return true;
			 }
			
			else
			{
				
				//for editing wiqet 
			  var mysack = new sack("<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php" );    
			  mysack.execute = 1;
			  mysack.method = 'POST';
			  mysack.setVar( "action", "wiqet_elev_lookup" );
			  mysack.setVar( "wiqet_name", name );
			  mysack.setVar( "wiqet_id",  wiqet_id );
			  mysack.onError = function() { alert('Ajax error in Wiqet Plugin' )};
			  mysack.runAJAX();
			  alert('Wiqet was updated successfully');
			  //reply = confirm('Do you wish to add some more images to this Wiqet?','');
			  //if(!reply)
			  document.location.href= "?page=wiqet-photo-voice-and-webcam-video-personal-presentation-plugin/wiqet.php&message=updated";
			}
		}
		
		//]]>
		</script>
		<link href="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wiqet-photo-voice-and-webcam-video-personal-presentation-plugin/css/style.css" rel="stylesheet" type="text/css" />
		<?php
}
		
function wiqet_ajax_elev_lookup () {
	// for ajax call 
	if(isset($_POST['wiqet_code']) && isset($_POST['wiqet_name']))
	{
		if (substr($_POST['wiqet_code'], 0, 3) == 'w3-') {
			$wType= 'video';
		}else $wType = 'photo';
		global $wpdb;
		$code = $_POST['wiqet_code'];
		$name = $_POST['wiqet_name'];
		$table_name = $wpdb->prefix . "wiqet";
		$val = $wpdb->insert( $table_name, array( 'wiqetname' => $name, 'wiqetcode' => $code, 'wiqet_type' => $wType ), array( '%s', '%s' ) );
		die("document.getElementById('result').value = " . $val); 
	}
	else if(isset($_POST['wiqet_id']) && isset($_POST['wiqet_name']))
	{
		global $wpdb;
		$id = $_POST['wiqet_id'];
		$name = $_POST['wiqet_name'];
		$table_name = $wpdb->prefix . "wiqet";
		$val = $wpdb->update( $table_name, array( 'wiqetname' => $name), array( 'id' => $id ), array( '%s'), array( '%d' ) );
		die("document.getElementById('result').value = " . $val); 
	}
}

function remove() {
	add_action('media_buttons','media');
}

function media(){
	
	global $post_ID, $temp_ID;
	$uploading_iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);
	
	$media_upload_iframe_src = "admin.php?page=wiqet-media";
	
	//$audio_upload_iframe_src = apply_filters('audio_upload_iframe_src', "$media_upload_iframe_src&amp;type=audio");
	//$audio_title = __('Add Wiqet');
	$out = <<<EOF
	
	<a href="{$media_upload_iframe_src}&amp;TB_iframe=true" id="add_media" class="thickbox" title='Add Wiqet' onclick="return false;"><img src='../wp-content/plugins/wiqet-photo-voice-and-webcam-video-personal-presentation-plugin/images/logo20high.png' alt='Add Wiqet' /></a>
EOF;
	printf($out);;
}
?>