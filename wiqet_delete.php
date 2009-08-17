<?php
		global $wpdb;
		$table_name = $wpdb->prefix . "wiqet";
		$result = $wpdb->query("DELETE FROM $table_name WHERE id = $wiqet_id");
		?>
		<script type="text/javascript">
		document.location.href= "?page=wiqet/wiqet.php&message=delete";
		</script>
		<?php
		exit();
?>