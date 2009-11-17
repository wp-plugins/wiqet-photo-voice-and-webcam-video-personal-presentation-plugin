<style type="text/css">
#wphead {display:none}
#wpbody #adminmenu {display:none}
#footer {display:none}
#update-nag {display:none}
#screen-meta-links {display:none}
#wpbody  #wpbody-content {width:100%;}
</style>
<script type="text/javascript">
function insertContent(code)
{
	<?php if (@fclose(@fopen("http://backend.wiqet.com/wiqetembeds/".get_option('customer_id')."/player.swf", "r"))):?>
	
		content = '<object width="450" height="380"><param name="movie" value="http://backend.wiqet.com/wiqetembeds/<?php echo get_option('customer_id');?>/player.swf?modus=player&introvoiceCode='+code+'/"></param><param name="wmode" value="transparent"></param><param name="allowFullScreen" value="true"></param><embed src="http://backend.wiqet.com/wiqetembeds/<?php echo get_option('customer_id');?>/player.swf?modus=player&introvoiceCode='+code+'" type="application/x-shockwave-flash" wmode="transparent" allowFullScreen="true" width="450" height="380"></embed></object>';
	<?php else :?>
		content = '<object width="450" height="380"><param name="movie" value="http://backend.wiqet.com/wiqetembeds/default/player.swf?modus=player&introvoiceCode='+code+'/"></param><param name="wmode" value="transparent"></param><param name="allowFullScreen" value="true"></param><embed src="http://backend.wiqet.com/wiqetembeds/default/player.swf?modus=player&introvoiceCode='+code+'" type="application/x-shockwave-flash" wmode="transparent" allowFullScreen="true" width="450" height="380"></embed></object>';
	<?php endif;?>
	
	var win = window.dialogArguments || opener || parent || top;
	win.send_to_editor(content);
	//parent.send_to_editor(content);
	parent.tb_remove();
}
</script>
<div class="wrap">
<h2>List of added Wiqets </h2>
<a href="admin.php?page=wiqet-add" target="_parent">add photo</a> -- <a href="admin.php?page=wiqet-add-video" target="_parent" >add video</a>
<?php
		global $wpdb;
		$table_name = $wpdb->prefix . "wiqet";
		$no_rows = $wpdb->query( "SELECT * FROM $table_name" );
		if($no_rows) 
		{
			$limit = 25;
			$start = $_GET['no'];
			if($start == '') { $limitstart= 0;}
			else { $limitstart = ($start -1) * $limit; 	}

			$media_result = $wpdb->get_results("SELECT id, wiqetname, wiqet_type, wiqetcode FROM $table_name ORDER BY id DESC");
			?>
			<table style="width:50%" cellpadding ="12" cellspacing="14">
			<?php
			foreach($media_result as $result_media) 
			{
				echo "<tr>";
				echo  '<td><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="90" height="84" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
					<param name="wmode" value="transparent" />
					<param name="src" value="http://backend.wiqet.com/wiqetembeds/default/player_thumb.swf?modus=player&introvoiceCode='.$result_media->wiqetcode.'" />
					<embed type="application/x-shockwave-flash" width="90" height="84" 
				src="http://backend.wiqet.com/wiqetembeds/default/player_thumb.swf?modus=player&introvoiceCode='.$result_media->wiqetcode.'" wmode="transparent">
					</embed></object></td>';
				echo "<td>".$result_media->wiqetname ."</td>";
				
				if($result_media->wiqet_type == 'photo')
					echo '<td><img src="http://backend.wiqet.com/wiqetembeds/externalimages/wordpressplugin/photoicon.gif" alt="photo Wiqet" title="voice and photo Wiqet" /> </td>';
			 	else
					echo '<td><img src="http://backend.wiqet.com/wiqetembeds/externalimages/wordpressplugin/videoicon.gif" alt="video Wiqet" title="video/webcam Wiqet" /> </td>';
				
				echo "<td><a href='#' id = 'TB_closeWindowButton' value='Close' onclick='insertContent(".'"'.$result_media->wiqetcode.'"'.")'> Add to Post </a>" ."</td>";
				echo "</tr>";
			}
			?>
			</table>
			<?php
		}
		else
		{
			echo "No wiqets have been added yet";
		}
?>
</div>