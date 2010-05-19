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
	
	$Meta = '<meta property="og:site_name" content="'.$Name.'"/>';
	
	echo $Meta;
	
}





?>