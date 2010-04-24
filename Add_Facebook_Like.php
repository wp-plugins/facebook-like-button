<?php

/*
Plugin Name: Facebook Like
Plugin URI: http://www.ahmedgeek.com
Description: Add the facebook like button for your blog. Change the button layout, use XFBML or iFrame and much more just in one plugin.
Version: 2.5.0.1 
Author: Ahmed Hussein
Author URI: http://www.ahmedgeek.com
License: LGPL3
*/

/*  Copyright 2010  Facebook Like Button  (email : me@ahmedgeek.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



//Start Create Table
$jal_db_version = "1.0";

function jal_install () {
   global $wpdb;
   global $jal_db_version;

   $table_name = $wpdb->prefix . "FBLikes";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      
      $sql = "CREATE TABLE " . $table_name . " (
	         `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
             `appid` VARCHAR( 64 ) NULL ,
             `type` VARCHAR( 32 ) NOT NULL,
             `pos` VARCHAR( 32 ) NOT NULL,
			 `layout` VARCHAR(32) NULL,
			 `face` VARCHAR(32) NULL,
			 `verb` VARCHAR(32) NULL,
			 `color` VARCHAR(32) NULL,
			 `width` VARCHAR(32) NULL
	);";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
 
      add_option("jal_db_version", $jal_db_version);

   }
}
register_activation_hook(__FILE__,'jal_install');

//End Create Table

	  //Create ALTER table if not existed
       require_once(ABSPATH . "wp-config.php");
       require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
       global $wpdb;
       $table_name = $wpdb->prefix . "FBLikes";
       
	   $fields = mysql_list_fields(DB_NAME, $table_name);

	   $columns = mysql_num_fields($fields);

	   for ($i = 0; $i < $columns; $i++) {$field_array[] = mysql_field_name($fields, $i);}
  
		if (!in_array('layout', $field_array))
		{
		$result = mysql_query("ALTER TABLE $table_name ADD layout VARCHAR(32) NULL");
		}
		
		if (!in_array('face', $field_array))
		{
		$result = mysql_query("ALTER TABLE $table_name ADD face VARCHAR(32) NULL");
		}
		
		if (!in_array('verb', $field_array))
		{
		$result = mysql_query("ALTER TABLE $table_name ADD verb VARCHAR(32) NULL");
		}
		
		if (!in_array('color', $field_array))
		{
		$result = mysql_query("ALTER TABLE $table_name ADD color VARCHAR(32) NULL");
		}
		
		//Create ALTER table is not existed END
		

function FB_Admin_Cont()
{
	
	 require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	 global $wpdb;
     $table_name = $wpdb->prefix . "FBLikes";
	 
	 $Type = $wpdb->get_var("SELECT type FROM $table_name WHERE id = '1'"); //Get Type
	 $AppID= $wpdb->get_var("SELECT appid FROM $table_name WHERE id = '1'"); //Get appid
	 $Pos= $wpdb->get_var("SELECT pos FROM $table_name WHERE id = '1'"); //Get posetion
	 $Layout= $wpdb->get_var("SELECT layout FROM $table_name WHERE id = '1'"); //Get layout
	 $verb= $wpdb->get_var("SELECT verb FROM $table_name WHERE id = '1'"); //Get verb
	 $color= $wpdb->get_var("SELECT color FROM $table_name WHERE id = '1'"); //Get color
	 $Face= $wpdb->get_var("SELECT face FROM $table_name WHERE id = '1'"); //Get Face
	 
	 $xfbml = ($Type == 'xfbml') ? 'CHECKED' : '';
	 $iframe = ($Type == 'iframe') ? 'CHECKED' : '';
	 
	 $stan = ($Layout == 'standard') ? 'SELECTED' : '';
	 $count = ($Layout == 'button_count') ? 'SELECTED' : '';
	 
	 $face  = ($Face == 'true') ? 'CHECKED' : '';
	 
	 $like = ($verb == 'like') ? 'SELECTED' : '';
	 $reco = ($verb == 'recommend') ? 'SELECTED' : '';
	 
	 $light = ($color == 'light') ? 'SELECTED' : '';
	 $dark  = ($color == 'dark') ? 'SELECTED' : '';
     
     $after = ($Pos == 'after') ? 'SELECTED' : '';
     $before = ($Pos == 'before') ? 'SELECTED"' : '';
     
	$Layout = '
	          <form action = "" method = "POST">
	          <h1>Facebook Like Button</h1><br><br>
			  <h2>General Settings:</h2>
		  <table>
			  <tr>
				  <td>
				  AppID for XFBML version: 
				  </td>
				  <td>
				  <input type="text" name="appid" size="30" value = "'.$AppID.'"/> <a href="http://developers.facebook.com/setup/" target="_blank" title="Register Your Site on Facebook">Don"t have one?</a>
				  </td>
			  </tr>
			  
			  <tr>
				  <td>
				  Type: 
				  </td>
			  </tr>
			  <tr>
				  <td><label for="xfbml">XFBML:</label><input type="radio" id="xfbml" name="type" value="xfbml" '.$xfbml.'/></td>
				  <td><label for="iframe">iFrame:</label><input type="radio" id="iframe" name="type" value="iframe" '.$iframe.'/></td>
			  </tr>
              <tr>
              <td>
              Position:
              </td>
              <td>
              <select name = "pos" value="$pos">
              <option value = "after" '.$after.'>
              After Content
              </option>
              <option value = "before" '.$before.'>
              Before Content
              </option>
              </select>
              </td>
              </tr>
		  </table>
		  
		  <h2>Layout Settings:</h2>
		  <table width="300" border="0">
			<tr>
			  <td>Layout Style:</td>
			  <td>
			  <select name="layout">
			  <option value="standard" '.$stan.'>Standard</option>
			  <option value="button_count" '.$count.'>Count Button</option>
			  </select>
			  </td>
			</tr>
			<tr>
			  <td>Show Faces:</td>
			  <td><input type="checkbox" name="face" value="true" '.$face.'/>
			</tr>
			<tr>
			  <td>Verb to display:</td>
			  <td>
			  <select name="verb">
			  <option value="like" '.$like.'>Like</option>
			  <option value="recommend" '.$reco.'>Recommend</option>
			  </select>
			  </td>
			</tr>
			<tr>
			  <td>Color Scheme:</td>
			  <td>
			  <select name="color">
			  <option value="light" '.$light.'>Light</option>
			  <option value="dark" '.$dark.'>Dark</option>
			  </select>
			  </td>
			</tr>
		  </table>
		  
		  <input type = "submit" name = "sub" value = "Save Settings">
		</form>	  
	
	
	';
	
	echo $Layout;
	
	}
    
	function FB_Admin_Box()
{
     add_menu_page('Facebook Like', 'Facebook Like',8,basename(__FILE__));
     add_submenu_page(basename(__FILE__), 'Settings', 'Settings', 8, basename(__FILE__),"FB_Admin_Cont");
  
}

	add_action('admin_menu','FB_Admin_Box');
	
	
//Save Settings
if($_POST['sub']){
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    $type = ($_POST['type'] == 'xfbml') ? 'xfbml' : 'iframe' ;
    
    $appid= $_POST['appid'];
    
    $pos  = $_POST['pos'];
    
    $color =  $_POST['color'];
    
    $layout = $_POST["layout"];
    
    $verb =$_POST["verb"];
    
    $face = $_POST["face"];
    
    $table_name = $wpdb->prefix . "FBLikes";
    
    
    $Query = mysql_Query('SELECT * FROM `'.$table_name.'`');
    
    if(mysql_num_rows($Query) == 1){
        
        $wpdb->query("UPDATE `$table_name` SET type ='".$type."', appid ='".$appid."', pos ='".$pos."', 
                     layout ='".$layout."', color ='".$color."', verb ='".$verb."', face ='".$face."' WHERE id = '1'") or die(mysql_error());
        
    }
    
    if(mysql_num_rows($Query) < 1){
       
       $wpdb->query('INSERT INTO `'.$table_name.'` (`type`, `appid`, `pos`, `layout`, `color`, `verb`, `face`)
       VALUES("'.$type.'", "'.$appid.'", "'.$pos.'" , "'.$layout.'" , "'.$color.'" , "'.$verb.'", "'.$face.'")')  or die(mysql_error());; 
        
     }
     
     

}
// End Save Settings

//Export the button
add_filter('the_content', 'Add_Like_Button');
function Add_Like_Button($content){
    
     require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	 global $wpdb;
     $table_name = $wpdb->prefix . "FBLikes";
	 
	 $Type = $wpdb->get_var("SELECT type FROM $table_name WHERE id = '1'"); //Get Type
	 $AppID= $wpdb->get_var("SELECT appid FROM $table_name WHERE id = '1'"); //Get appid
	 $Pos= $wpdb->get_var("SELECT pos FROM $table_name WHERE id = '1'"); //Get posetion
	 $Layout= $wpdb->get_var("SELECT layout FROM $table_name WHERE id = '1'"); //Get layout
	 $verb= $wpdb->get_var("SELECT verb FROM $table_name WHERE id = '1'"); //Get verb
	 $color= $wpdb->get_var("SELECT color FROM $table_name WHERE id = '1'"); //Get color
	 $Face= $wpdb->get_var("SELECT face FROM $table_name WHERE id = '1'"); //Get Face
     
     $face = ($Face == "true") ? 'true' : 'false';
     
$SDK = '<div id="fb-root"></div>
       <script>
       window.fbAsyncInit = function() {
       FB.init({appId: "'.$AppID.'", status: true, cookie: true,
             xfbml: true});
        };
     (function() {
      var e = document.createElement("script"); e.async = true;
     e.src = document.location.protocol +
       "//connect.facebook.net/en_US/all.js";
     document.getElementById("fb-root").appendChild(e);
   }());
   </script>';
   
   $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

   
   $xfbml = '<div><fb:like href="'.$url.'" layout="'.$Layout.'" show_faces="'.$face.'" width="450" action="'.$verb.'" colorscheme="'.$color.'" /></div>';
   $iframe = ' 
   <div><iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'"&layout='.$Layout.'&show_faces='.$face.'&width=450&action='.$verb.'&colorscheme='.$color.'" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:450px; height:px"></iframe></div>
   ';
   
   if(($Type == "xfbml") && ($Pos == 'after') ){
    
     $but = $SDK.$xfbml;
     $content = $content.$but;
     
}
if(($Type == "xfbml") && ($Pos == 'before') ){
     
     $but = $SDK.$xfbml;
     $content = $but.$content;   
}

if(($Type == 'iframe') && ($Pos == 'after')){
        $content .= $iframe;
}

if(($Type == 'iframe') &&  ($Pos == 'before')){
        
        $content = $iframe.$content;
}


return $content;   

}

		


?>