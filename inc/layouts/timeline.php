<div id="fb-root"></div>
<script>
		(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php  echo get_option('fb_like_appid');?>
		";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
</script>


<div class="wrap">
	<div class="icon32" id="icon-options-general"></div>
	<h2>Post to Timeline Plugin</h2>
	<div id='banner_fb_like'>
		<center><img src='<?php echo plugins_url() . '/facebook-like-button/inc/images/open_graph.png' ?>' /></center>
		
		<div id="message" class="updated fade"><p><strong><?php _e('Settings Have Been Updated') ?></strong></p></div>
		
	</div>
	<div class="metabox-holder has-right-sidebar" id="poststuff">
		<div class="inner-sidebar">
			<div style="position: relative;" class="meta-box-sortabless ui-sortable" id="side-sortables">
				<div class="postbox">
					<h3 class="hndle"><span>Live Preview</span></h3>
					<div class="inside">
						<fb:add-to-timeline show-faces="true" mode="button"></fb:add-to-timeline>
					</div><!--/inside-->
				</div><!--/postbox-->
			</div>
		</div>
		<div class="has-sidebar-content" id="post-body-content">
			<div class="postbox" >
				<h3 class="hndle"><span>General Application Settings</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td>APP ID:</td>
							<td><input type='text' size="30" /></td>
						</tr>
						<tr>
							<td>APP Secret:</td>
							<td><input type='text' size="30" /></td>
						</tr>
					</table>
					<input type='submit' name='save_app_settings_time' value='Save Settings' />
				</div>
			</div>
			
			<div class="postbox" >
				<h3 class="hndle"><span>Open Graph Actions & Objects</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td>APP ID:</td>
							<td><input type='text' size="30" /></td>
						</tr>
						<tr>
							<td>APP Secret:</td>
							<td><input type='text' size="30" /></td>
						</tr>
					</table>
					<input type='submit' name='save_app_settings_time' value='Save Settings' />
				</div>
			</div>
		</div>
	</div>
