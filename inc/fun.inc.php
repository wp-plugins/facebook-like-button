<?php

/*
File Name: functions.inc.php
Descreption: All kind of functions will be here
*/


/*
Add the website name to the header using
og:sitename meta for opengraph
*/

function Add_Site_Name(){
	
	$Name = get_bloginfo('name');
	
	$Meta = '
	<meta property="og:site_name" content="'.$Name.'"/>
	';
	$Admeta = '<meta property="fb:admins" content="'.get_option("fb_like_admeta").'" />';
	$Admeta.= 
	'
	<meta property="fb:app_id" content="'.get_option("fb_like_appid").'" />
	';
	if(get_option("fb_like_enimg") == true){
		
		$Admeta .= '<meta property="og:image" content="'.get_option("fb_like_dimage").'" />
	';
		}else{
			
			}
	
	
	if((is_single) || (is_page())){
		$admeta .= '
		<meta property="og:type" content="article" />
		';
		}
	if(is_front_page()){
		$Admeta .= '<meta property="og:type" content="blog" />
		';
		}
	
	echo $Meta . $Admeta;
	
}





?>