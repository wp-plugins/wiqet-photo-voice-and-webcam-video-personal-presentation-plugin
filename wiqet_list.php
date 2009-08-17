
<div class="wrap">
<h2>List of added Wiqets </h2>
<?php
if(isset($_GET['message']) && $_GET['message'] == 'success')
{
?>
	<h3 class = 'noresult'>Wiqet has been added successfully.</h3>
<?php
}
else if( isset($_GET['message']) && $_GET['message'] == 'delete')
{
?>
	<h3 class = 'noresult'>Wiqet was deleted successfully.</h3>
<?php
}
else if( isset($_GET['message']) && $_GET['message'] == 'updated')
{
?>
	<h3 class = 'noresult'>Wiqet was updated successfully. </h3>
<?php
}
		//$SQLQuery = "Select ";
		global $wpdb;
		$table_name = $wpdb->prefix . "wiqet";
		$no_rows = $wpdb->query( "SELECT * FROM $table_name" );
		if($no_rows) 
		{
			$limit = 25;
			$start = $_GET['no'];
			if($start == '') { $limitstart= 0;}
			else { $limitstart = ($start -1) * $limit; 	}

		$qry_result = $wpdb->get_results( "SELECT id, wiqetname, wiqet_type, wiqetcode FROM $table_name ORDER BY id DESC limit $limitstart, $limit" );
		//print_r($qry_result);
		if($start == '') $start = '1';
		$pages = (($no_rows % $limit) == 0) ? $no_rows / $limit : floor($no_rows / $limit) + 1;
		$paging = pageList($start, $pages);
		?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="admin_grid" id="apps">
            <tr class="headings">
			  <td>Thumb</td>
			  <td>Name</td>
			  <td>Type</td>
              <td>Actions</td>
            </tr>
		<?php
			$i1 = 1;
			foreach($qry_result as $result) 
			{
				if($i1 %2 == 0) { $class = 'class = "altrow"';}
				else {$class = 'class = "row"';}
				?>
				<tr <?php echo $class;?>>
					<td width="120px">
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="110" height="94" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
					<param name="wmode" value="transparent" />
					<param name="src" value="http://www.wiqet.com/media/wiqetflashfiles/wordpress/3-0/player.swf?modus=player&introvoiceCode=<?php echo $result->wiqetcode; ?>/" />
					<embed type="application/x-shockwave-flash" width="110" height="94" 
				src="http://www.wiqet.com/media/wiqetflashfiles/wordpress/3-0/player.swf?modus=player&introvoiceCode=<?php echo $result->wiqetcode; ?>/" wmode="transparent">
					</embed></object>
					</td>
					<td><span class="wiqetListItem"><?php echo $result->wiqetname ?></span></td>
					<td width="40px"><?php if($result->wiqet_type == 'photo'):?>
					<img src="http://www.wiqet.com/media/wiqetflashfiles/wordpress/3-0/photoicon.gif" alt="photo Wiqet" title="voice and photo Wiqet"/>
					<?php else: ?>
					<img src="http://www.wiqet.com/media/wiqetflashfiles/wordpress/3-0/videoicon.gif" alt="video Wiqet" title="video/webcam Wiqet"/>
					<?php endif;?>
					</td>
					<td width="80px"><a href="?page=wiqet-edit&id=<?php echo $result->id ?>"> Edit </a> <br><br><a href="?page=wiqet-delete&id=<?php echo $result->id ?>" onclick="return confirm('Are you sure you want to delete this wiqet?')"> Delete </a> </td>
				</tr>
			
			<?php
			$i1++;
			}
		?>
            
            
			</table>
			<div class="paging">
			<?php echo $paging;?>
			</div>

		<?php
		}
		else
		{
			echo "<h3 class = 'noresult'>No Wiqets have been added.</h3>";
		}
		
?>

</div>

<?php

 function pageList($curpage, $pages)		
{
		
					$page_list = "";
					/* Print the first and previous page links if necessary */
					if (($curpage != 1) && ($curpage))
					{
					$page_list .= " <a href=\"".$_SERVER['PHP_SELF']."?page=wiqet-list&no=1\" title=\"First Page\">First</a> ";
					}

					if (($curpage-1) > 0)
					{
					$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=wiqet-list&no=".($curpage-1)."\" title=\"Previous\"><<<</a> ";
					}

					/* Print the numeric page list; make the current page unlinked and bold */
					for ($i=1; $i<=$pages; $i++)
					{
					if ($i == $curpage)
					{
					$page_list .= $i;
					}
					else
					{
					$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=wiqet-list&no=".$i."\" title=\"Page ".$i."\">".$i."</a>";
					}
					$page_list .= " ";
					}

					/* Print the Next and Last page links if necessary */
					if (($curpage+1) <= $pages)
					{
					$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=wiqet-list&no=".($curpage+1)."\" title=\"Next\">>>></a> ";
					}

					if (($curpage != $pages) && ($pages != 0))
					{
					$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=wiqet-list&no=".$pages."\" title=\"Last Page\">Last</a> ";
					}
					$page_list .= "";
					if(trim($page_list) == '1') {$page_list ='';}
					return $page_list;
}

?>