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
	$parent_title = get_the_title($post->post_parent);
	$prem = get_permalink(get_the_ID());
	$post_by_id = get_post(get_the_ID(), ARRAY_A);
	
	
	$Meta = '
	<!--Facebook Like Button OpenGraph Settings Start-->';
	$Meta .= '
	<meta property="og:site_name" content="'.$Name.'"/>';
	if(is_front_page()){
		
		$Title ='
	<meta property="og:title" content="'.get_bloginfo('name').'"/>';
		$URL = 
	'
	<meta property="og:url" content="'.get_bloginfo('url').'"/>
	';
	}
	else
	{
	$Title = '
	<meta property="og:title" content="'.$parent_title.'"/>';
	$URL = 
	'
	<meta property="og:url" content="'.$prem.'"/>
	';
	$Title .= '
		<meta property="og:description" content="'.@strip_tags(substr($post_by_id['post_content'], 0, 140)).'"/>
	';
	}
	
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
		$Admeta .= '<meta property="og:type" content="article" />
		';
		}
	if(is_front_page()){
		$Admeta .= '<meta property="og:type" content="blog" />
		';
		}
	$Admeta .= '<!--Facebook Like Button OpenGraph Settings End-->
	';
	echo $Meta . $Title . $URL . $Admeta;
	
}





?>