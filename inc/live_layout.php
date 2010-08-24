<?php

include_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/live_fill.php");

$block = 

'
<div class="wrap">
	<script src="'. plugins_url('js/jquery.js',__FILE__).'" type = "text/javascript"></script>
	<script src="'. plugins_url('js/stream.js',__FILE__).'" type = "text/javascript"></script>
	<form action="" method="post" id="form">
	<table>
		<tr valign="top">
			<td width="400px;">
			<div>
				<img class="icon32" style="height:32px; width:auto;" src="'.plugins_url('images/settings_32.png',__FILE__).'" title="Live Stream Settings" alt="Icon"> 
				<h2>Live Stream Settings:</h2>
				
				<table>
					<tr>
						<td>APP ID:</td>
						<td><input type = "text" id = "app_id" size = "30" name = "app_id" placeholder = "Facebook APP ID" '.$app_id_value.' /> </td>
					</tr>
					
					<tr>
						<td>Width:</td>
						<td><input type = "number" id = "width" size = "30" name = "width" placeholder = "Width in PX"  '.$width_value.'/> </td>
					</tr>
					
					<tr>
						<td>Height:</td>
						<td><input type = "number" id = "height" size = "30" name = "height" placeholder = "Height in PX" '.$height_value.'/> </td>
					</tr>
					<tr>
						<td>Widget\'s Title:</td>
						<td><input type = "text" id = "wid_title" size = "30" name = "height" placeholder = "WP Widget\'s Title" '.$wid_value.'/> </td>
					</tr>
					<tr>
					   <td>
					   <input name="submit" class="button-primary" type="submit" value="Save Settings" 
					   style="cursor: pointer;" id="submit" title="Save Settings">
					   </td>
					</tr>
				</table>
				</div>
			</td>
			
			<td width="400px">
				<div>
				<img class="icon32" style="height:32px; width:auto;" src="'.plugins_url('images/preview_32.png',__FILE__).'"title="Live Preview"  alt="Icon"> 
				<h2>Live Preview:</h2>
				<table>
					<tr>
						<td><div id = "live"></div></td>
					</tr>
				</table>
				</div>
			</td>
		</tr>
	
	</table>
	</form>
</div>

';

?>