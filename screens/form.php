<form id="gantry-import-export" action="" method="POST" enctype="multipart/form-data">
	<table style="width: 100%">
		<tr valign="top">
			<td style="width: 50%">
				<h4>Import Settings</h4>
				<input type="file" name="file" />
				<input type="submit" name="upload" id="upload" class="button-secondary" value=" Upload ">
			</td>
			<td>
				<h4>Export Settings</h4>
				<a href="<?php echo admin_url('admin.php?page=gantry-theme-settings&action=download'); ?>" class="button-secondary">Download as file</a>
			</td>
		</tr>
	</table>
</form>
<script>
	jQuery('#gantry-import-export').insertAfter('#g4-panels').show();
</script>