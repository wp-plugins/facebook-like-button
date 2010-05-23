<?php

/*
File Name: options.inc.php
Descreption: Add options and update them
*/


$Names = array(
            
			'appid'  => 'appid', //AppID
			'type'   => 'type', //Button Type
			'pos'    => 'pos', //Position
			'layout' => 'layout', //Layout
			'face'   => 'face', //Show Faces
			'verb'   => 'verb', //Verb to display
			'color'  => 'color', //Button Color
			'width'  => 'width', //Container Width
			'height' => 'height', //Container Height
			'ht'     => 'ht', //Height Type px or em
			'css'    => 'css', //Container CSS Class
			'home'   => 'home', //Show in home
			'page'   => 'page', //Show in pages
			'post'   => 'post'  //show in posts
			
               
			   );


	
	foreach($Names as $Na){ //Get Options Names
		
		add_option("fb_like_".$Na, '');
		
	}

/*
Add locale and fonts options by Anty
*/	
add_option("fblikes_locale", "default");
add_option("fblikes_font", "");

?>