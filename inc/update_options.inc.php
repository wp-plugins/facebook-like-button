<?php

/*
File name: update_options.inc.php
Descreption: Save settings and update options
*/
if (isset($_POST['sub'])) {


    $type = ($_POST['type'] == 'xfbml') ? 'xfbml' : 'iframe';
    $appid = $_POST['appid'];
    $pos = $_POST['pos'];
    $color = $_POST['color'];
    $layout = $_POST["layout"];
    $verb = $_POST["verb"];

    if (isset($_POST["face"])) {
        $face = $_POST["face"];
    } else {
        $face = false;
    }

    $width  = $_POST["width"];
    $css    = $_POST["css"];
    $height = $_POST["height"];
    $HT     = $_POST["ht"];
	$page   = $_POST["page"];
    $home   = $_POST["home"];
    $post   = $_POST["post"];
	$css    = $_POST["css"];
	$admeta = $_POST["admeta"];
	$dimage = (($_POST['dimage'] == null) && (get_option("fb_like_dimage") != null) ) ? get_option("fb_like_dimage") : $_POST['dimage'];
	$enimg  = ($_POST['enimg'] == true) ? true : false;

	//Options' Values
	$Values = array(
	 
	        '0'   => $appid,   //AppID
			'1'   => $type,    //Button Type
			'2'   => $pos,     //Position
			'3'   => $layout,  //Layout
			'4'   => $face,    //Show Faces
			'5'   => $verb,    //Verb to display
			'6'   => $color,   //Button Color
			'7'   => $width,   //Container Width
			'8'   => $height,  //Container Height
			'9'   => $HT,      //Height Type px or em
			'10'  => $css,     //Container CSS Class
			'11'  => $home,    //Show in home
			'12'  => $page,    //Show in pages
			'13'  => $post,     //show in posts
			'14'  => $admeta,
			'15'  => $dimage,
			'16'  => $enimg
	
	               );
	$Names = array(
	 
	        '0'   => 'appid',  //AppID
			'1'   => 'type',   //Button Type
			'2'   => 'pos',    //Position
			'3'   => 'layout', //Layout
			'4'   => 'face',   //Show Faces
			'5'   => 'verb',   //Verb to display
			'6'   => 'color',  //Button Color
			'7'   => 'width',  //Container Width
			'8'   => 'height', //Container Height
			'9'   => 'ht',     //Height Type px or em
			'10'  => 'css',    //Container CSS class
			'11'  => 'home',   //Show in home
			'12'  => 'page',   //Show in pages
			'13'  => 'post',    //show in posts
			'14'  => 'admeta',
			'15'  => 'dimage',
			'16'  => 'enimg'
	
	               );
				   
	for($i = 0; $i <=16 ; $i++){
			
		update_option("fb_like_".$Names[$i], $Values[$i]);

	       }//End for Names
   
    if (isset($_POST["fblikes_locale"])) {
        update_option("fblikes_locale", $_POST["fblikes_locale"]);
    }

    if (isset($_POST["fblikes_font"])) {
        update_option("fblikes_font", $_POST["fblikes_font"]);
    }
?><div id="message" class="updated fade"><p><strong><?php _e('Settings saved!') ?></strong></p></div><?php
}
// End Save Settings


?>