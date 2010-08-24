<?php

function Live_Page(){
	
	include_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/live_layout.php");
	
	if($_POST['submit']){
	   include_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/rec_save.php");

	   update_rec_options();
	   include_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/rec_fill.php");
	   ?>
       <div id="message" class="updated fade"><p><strong><?php _e('Settings saved!') ?></strong></p></div>
	   <?php
	   
	   
	}

	echo $block;
	
	}
	
	
function Add_Live_Admin(){

	add_submenu_page("main.php", 'Live Stream Settings', 'Live Stream', 8, basename(__file__),
        "Live_Page");
	
	}
	
	


?>