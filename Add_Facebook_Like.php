<?php

/*
Plugin Name: Facebook Like
Plugin URI: http://blog.ahmedgeek.com/facebook-like-button-for-wordpress-v3
Description: Add the facebook like button for your blog. Change the button layout, use XFBML or iFrame and much more just in one plugin.
Version: 3.3
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

function jal_install()
{
    global $wpdb;
    global $jal_db_version;

    $table_name = $wpdb->prefix . "FBLikes";
    if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {

        $sql = "CREATE TABLE " . $table_name . " (
	         `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
             `appid` VARCHAR( 64 ) NULL ,
             `type` VARCHAR( 32 ) NOT NULL,
             `pos` VARCHAR( 32 ) NOT NULL,
			 `layout` VARCHAR(32) NULL,
			 `face` VARCHAR(32) NULL,
			 `verb` VARCHAR(32) NULL,
			 `color` VARCHAR(32) NULL,
			 `width` VARCHAR(32) NULL,
             `height` VARCHAR(32) NULL,
             `ht`     VARCHAR(32) NULL,
			 `home`     VARCHAR(32) NULL,
			 `page`     VARCHAR(32) NULL,
			 `post`     VARCHAR(32) NULL
			 
	);";

        require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        $wpdb->query("UPDATE `$table_name` SET height ='40', ht = 'px'");
        add_option("jal_db_version", $jal_db_version);

    }
}
register_activation_hook(__file__, 'jal_install');

//End Create Table

//Create ALTER table if not existed
require_once (ABSPATH . "wp-config.php");
require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
global $wpdb;
$table_name = $wpdb->prefix . "FBLikes";

$fields = mysql_list_fields(DB_NAME, $table_name);

$columns = mysql_num_fields($fields);

for ($i = 0; $i < $columns; $i++) {
    $field_array[] = mysql_field_name($fields, $i);
}

if (!in_array('layout', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD layout VARCHAR(32) NULL");
}

if (!in_array('face', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD face VARCHAR(32) NULL");
}

if (!in_array('verb', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD verb VARCHAR(32) NULL");
}

if (!in_array('color', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD color VARCHAR(32) NULL");
}

if (!in_array('width', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD width VARCHAR(32) NULL");
}

if (!in_array('css', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD css VARCHAR(255) NULL");
}

if (!in_array('height', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD height VARCHAR(32) NULL");
}

if (!in_array('ht', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD ht VARCHAR(32) NULL");
    $wpdb->query("UPDATE `$table_name` SET height ='40', ht = 'px'");
}

if (!in_array('home', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD home VARCHAR(32) NULL");

}

if (!in_array('post', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD post VARCHAR(32) NULL");

}

if (!in_array('page', $field_array)) {
    $result = mysql_query("ALTER TABLE $table_name ADD page VARCHAR(32) NULL");
    
}
//Create ALTER table is not existed END

//Recreate Table Start
if ($_POST["create"]) {

    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    $table_name = $wpdb->prefix . "FBLikes";

    //Drop the table
    $wpdb->query("DROP TABLE $table_name");

    //Create Again

    if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {

        $sql = "CREATE TABLE " . $table_name . " (
	         `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
             `appid` VARCHAR( 64 ) NULL ,
             `type` VARCHAR( 32 ) NOT NULL,
             `pos` VARCHAR( 32 ) NOT NULL,
			 `layout` VARCHAR(32) NULL,
			 `face` VARCHAR(32) NULL,
			 `verb` VARCHAR(32) NULL,
			 `color` VARCHAR(32) NULL,
			 `width` VARCHAR(32) NULL,
             `height` VARCHAR(32) NULL,
             `ht`     VARCHAR(32) NULL,
			 `home`     VARCHAR(32) NULL,
			 `page`     VARCHAR(32) NULL,
			 `post`     VARCHAR(32) NULL
	);";

        require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        $wpdb->query("INSERT INTO `$table_name` (`height`, `ht`) VALUES('40','px')");
?><div class="updated"><p><strong><?php _e('Table recreated successfully!'); ?></strong></p></div><?php
    }

}
//Recreate Table End

function FB_Admin_Cont()
{

    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    $table_name = $wpdb->prefix . "FBLikes";

    $Type = $wpdb->get_var("SELECT type FROM $table_name WHERE id = '1'"); //Get Type
    $AppID = $wpdb->get_var("SELECT appid FROM $table_name WHERE id = '1'"); //Get appid
    $Pos = $wpdb->get_var("SELECT pos FROM $table_name WHERE id = '1'"); //Get posetion
    $Layout = $wpdb->get_var("SELECT layout FROM $table_name WHERE id = '1'"); //Get layout
    $verb = $wpdb->get_var("SELECT verb FROM $table_name WHERE id = '1'"); //Get verb
    $color = $wpdb->get_var("SELECT color FROM $table_name WHERE id = '1'"); //Get color
    $Face = $wpdb->get_var("SELECT face FROM $table_name WHERE id = '1'"); //Get Face
    $width = $wpdb->get_var("SELECT width FROM $table_name WHERE id = '1'"); //Get Width
    $CSS = $wpdb->get_var("SELECT css FROM $table_name WHERE id = '1'"); //Container Class
    $height = $wpdb->get_var("SELECT height FROM $table_name WHERE id = '1'"); //Get Heigh
	$HT = $wpdb->get_var("SELECT ht FROM $table_name WHERE id = '1'"); //Get Height Type
	
    $Home = $wpdb->get_var("SELECT home FROM $table_name WHERE id = '1'"); //Get Home Type
	$Page = $wpdb->get_var("SELECT page FROM $table_name WHERE id = '1'"); //Get Page Type
	$Post = $wpdb->get_var("SELECT post FROM $table_name WHERE id = '1'"); //Get Post Type
	
    $xfbml = ($Type == 'xfbml') ? 'CHECKED' : '';
    $iframe = ($Type == 'iframe') ? 'CHECKED' : '';

    $stan = ($Layout == 'standard') ? 'SELECTED' : '';
    $count = ($Layout == 'button_count') ? 'SELECTED' : '';

    $face = ($Face == 'true') ? 'CHECKED' : '';

    $like = ($verb == 'like') ? 'SELECTED' : '';
    $reco = ($verb == 'recommend') ? 'SELECTED' : '';

    $light = ($color == 'light') ? 'SELECTED' : '';
    $dark = ($color == 'dark') ? 'SELECTED' : '';
    $evil = ($color == 'evil') ? 'SELECTED' : '';

    $after = ($Pos == 'after') ? 'SELECTED' : '';
    $before = ($Pos == 'before') ? 'SELECTED' : '';
    $baf = ($Pos == 'baf') ? 'SELECTED' : '';

    $px = ($HT == "px") ? 'SELECTED' : '';
    $em = ($HT == "em") ? 'SELECTED' : '';
    
	$home = ($Home == 'true') ? 'CHECKED' : '';
	$page = ($Page == 'true') ? 'CHECKED' : '';
	$post = ($Post == 'true') ? 'CHECKED' : '';
	
    $Width = ($width == null) ? '450' : $width;
	

    $Live  = 

  "
  <script src='". plugins_url('js/jquery.js',__FILE__)."' type = 'text/javascript'></script>
  <script>
  $(document).ready(function(){
	  
	  var appid = $(\"#appid\").val();
		  var xfbml =  ($(\"#xfbml\").is(':checked')) ? true : false;
		  var iframe= ($(\"#iframe\").is(':checked')) ? true : false;
		  var pos   = $(\"#pos :selected\").val();
		  var layout= $(\"#layout :selected\").val();
		  var height= $(\"#height\").val();
		  var width = $(\"#width\").val();
		  var css   = $(\"#css\").val();
		  var verb  = $(\"#verb\").val();
		  var face  = ($(\"#face\").is(\":checked\")) ? true : false;
		  var color = $(\"#color :selected\").val();
		  var ht    = $(\"#ht :selected\").val();
		  
		  var SDK  = '<div id=\"fb-root\"></div>';
			  SDK += '<script>';
			  SDK += 'window.fbAsyncInit = function() {';
			  SDK += 'FB.init({appId: '+appid+', status: true, cookie: true, xfbml: true}); };';
			  SDK += '(function() {';
			  SDK += 'var e = document.createElement(\"script\"); e.async = true;';
			  SDK += 'e.src = document.location.protocol +';
			  SDK += '\"//connect.facebook.net/en_US/all.js\";';
			  SDK += 'document.getElementById(\"fb-root\").appendChild(e); }()); <\/script>';
		  
		  var iver = '<iframe src=\"http://www.facebook.com/plugins/like.php?';
			  iver+= 'href=http%3A%2F%2Fblog.ahmedgeek.com';
			  iver+= '&amp;layout='+layout+'&amp;show_faces='+face+'';
			  iver+= '&amp;width=450&amp;action='+verb+'&amp;colorscheme='+color+'\"';
			  iver+= 'scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\"';
			  iver+= 'style=\"border:none; overflow:hidden; width:450px; height:px\"></iframe>';
			  
		  var xver = '<fb:like href=\"http://blog.ahmedgeek.com\"';
			  xver+= 'layout=\"'+layout+'\" show_faces=\"'+face+'\" width=\"450\"';
			  xver+= 'action=\"'+verb+'\" colorscheme=\"'+color+'\"></fb:like>';
			  
	  
			  $(\"#live\").html(iver);
			  
	  
	  
	  $(\"#form\").change(function(){
		  
		  var appid = $(\"#appid\").val();
		  var xfbml =  ($(\"#xfbml\").is(':checked')) ? true : false;
		  var iframe= ($(\"#iframe\").is(':checked')) ? true : false;
		  var pos   = $(\"#pos :selected\").val();
		  var layout= $(\"#layout :selected\").val();
		  var height= $(\"#height\").val();
		  var width = $(\"#width\").val();
		  var css   = $(\"#css\").val();
		  var verb  = $(\"#verb\").val();
		  var face  = ($(\"#face\").is(\":checked\")) ? true : false;
		  var color = $(\"#color :selected\").val();
		  var ht    = $(\"#ht :selected\").val();
		  
		  var SDK  = '<div id=\"fb-root\"></div>';
			  SDK += '<script>';
			  SDK += 'window.fbAsyncInit = function() {';
			  SDK += 'FB.init({appId: '+appid+', status: true, cookie: true, xfbml: true}); };';
			  SDK += '(function() {';
			  SDK += 'var e = document.createElement(\"script\"); e.async = true;';
			  SDK += 'e.src = document.location.protocol +';
			  SDK += '\"//connect.facebook.net/en_US/all.js\";';
			  SDK += 'document.getElementById(\"fb-root\").appendChild(e); }()); <\/script>';
		  
		  var iver = '<iframe src=\"http://www.facebook.com/plugins/like.php?';
			  iver+= 'href=http%3A%2F%2Fblog.ahmedgeek.com';
			  iver+= '&amp;layout='+layout+'&amp;show_faces='+face+'';
			  iver+= '&amp;width=450&amp;action='+verb+'&amp;colorscheme='+color+'\"';
			  iver+= 'scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\"';
			  iver+= 'style=\"border:none; overflow:hidden; width:450px; height:px\"></iframe>';
			  
		  var xver = '<fb:like href=\"http://blog.ahmedgeek.com\"';
			  xver+= 'layout=\"'+layout+'\" show_faces=\"'+face+'\" width=\"450\"';
			  xver+= 'action=\"'+verb+'\" colorscheme=\"'+color+'\"></fb:like>';
			  
	  
			  $(\"#live\").html(iver);
			  
			  
		  
		  });
	  
	  });
  </script>"; 



    $Layout = '
	          <div class="wrap">
			  
			    
              <form action = "" method = "POST" id="form">
	          <img s class="icon32" style="height:15px; width:auto;" src="'.plugins_url('icon.png',__FILE__).'" title="Facebook Like Button" alt="Icon"> <h2>Facebook Like Button</h2>
			  <h3>Live Preview</h3>
			  <div id="live" style="height:60px;"></div>
			  <h2>General Settings:</h2>
		  <table>
			  <tr>
				  <td>
				  AppID for XFBML version: 
				  </td>
				  <td>
				  <input type="text" name="appid" size="30" value = "' . $AppID .
        '"/> <a href="http://developers.facebook.com/setup/" target="_blank" title="Register Your Site on Facebook">Don"t have one?</a>
				  </td>
			  </tr>
			  
			  <tr>
				  <td>
				  Type: 
				  </td>
			  </tr>
			  <tr>
				  <td><label for="xfbml">XFBML:</label><input type="radio" id="xfbml" name="type" value="xfbml" ' .
        $xfbml . '/></td>
				  <td><label for="iframe">iFrame:</label><input type="radio" id="iframe" name="type" value="iframe" ' .
        $iframe . '/></td>
			  </tr>
			  	  <tr>
			  <td>Show in Home:</td><td><input type = "checkbox" name = "home" value = "true" '.$home.'></td>
			  </tr>
			  <tr>
			  <td>Show in Pages:</td><td><input type = "checkbox" name = "page" value = "true" '.$page.'></td>
			  </tr>
			  <tr>
			  <td>Show in Posts:</td><td><input type = "checkbox" name = "post" value = "true" '.$post.'></td>
			  </tr>
              <tr>
              <td>
              Position:
              </td>
              <td>
              <select name = "pos" value="$pos" id="pos">
              <option value = "after" ' . $after . '>
              After Content
              </option>
              <option value = "before" ' . $before . '>
              Before Content
              </option>
              <option value = "baf" ' . $baf . '>
              Before and after content
              </option>
              </select>
              </td>
              </tr>
		
		  </table>
		  
		  <h2>Layout Settings:</h2>
		  <table width="400px" border="0">
			<tr>
			  <td>Layout Style:</td>
			  <td>
			  <select name="layout" id="layout">
			  <option value="standard" ' . $stan . '>Standard</option>
			  <option value="button_count" ' . $count . '>Count Button</option>
			  </select>
			  </td>
			</tr>
			<tr>
			  <td>Show Faces:</td>
			  <td><input type="checkbox" id="face" name="face" value="true" ' . $face . '/>
			</tr>
			<tr>
			  <td>Verb to display:</td>
			  <td>
			  <select name="verb" id="verb">
			  <option value="like" ' . $like . '>Like</option>
			  <option value="recommend" ' . $reco . '>Recommend</option>
			  </select>
			  </td>
			</tr>
			<tr>
			  <td>Color Scheme:</td>
			  <td>
			  <select name="color" id="color">
			  <option value="light" ' . $light . '>Light</option>
			  <option value="dark" ' . $dark . '>Dark</option>
              <option value = "evil" '. $evil .'>Evil</option>
			  </select>
			  </td>
			</tr>
            	<tr>
			  <td>Width:</td>
			  <td>
			  <input type = "text" name = "width" value = "' . $Width . '"  id="width"/>
			  </td>
			</tr>
            <tr>
			  <td>Height:</td>
			  <td>
			  <input type = "number" name = "height" value = "' . $height . '" id="height" />
			  </td>
              <td>
              <select name = "ht" id="ht">
              <option value = "px" ' . $px . '>px</option>
              <option value = "em" ' . $em . '>em</option>
              </selecte>
              </td>
              <td style = "width: 100px;"><div><i>Default is 40px!</i></div></td>
			</tr>
            	<tr>
			  <td>Container Class:</td>
			  <td>
			  <input type = "text" name = "css" value = "' . $CSS . '" id="css" />
			  </td>
			</tr>
		  </table>
          <input type = "submit" name = "sub" value = "Save Settings">
		  <h2>Advanced</h2>
          <form action "" method = "">
          <input type = "submit" name = "create" value = "Recreate Database Table">
          <i><font color = "#3d3d3d" size= "1">You will lose all settings. (Use only if save is not working!)</font></i>
          </form>
		  
		</form>	  
	              </div>
	
	';

    echo $Live.$Layout;

}

function FB_Admin_Box()
{
    add_menu_page('Facebook Like', 'Facebook Like', 8, basename(__file__), '' , plugins_url('icon.png',__FILE__));
    add_submenu_page(basename(__file__), 'Settings', 'Settings', 8, basename(__file__),
        "FB_Admin_Cont");

}

add_action('admin_menu', 'FB_Admin_Box');


//Save Settings
if ($_POST['sub']) {

    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    $type = ($_POST['type'] == 'xfbml') ? 'xfbml' : 'iframe';

    $appid = $_POST['appid'];

    $pos = $_POST['pos'];

    $color = $_POST['color'];

    $layout = $_POST["layout"];

    $verb = $_POST["verb"];

    $face = $_POST["face"];

    $width = $_POST["width"];

    $css = $_POST["css"];

    $height = $_POST["height"];

    $HT = $_POST["ht"];
	
	$page = $_POST["page"];

    $home = $_POST["home"];

    $post = $_POST["post"];

    $table_name = $wpdb->prefix . "FBLikes";


    $Query = mysql_Query('SELECT * FROM `' . $table_name . '`');

    if (mysql_num_rows($Query) == 1) {

        $wpdb->query("UPDATE `$table_name` SET type ='" . $type . "', appid ='" . $appid .
            "', pos ='" . $pos . "', 
                     layout ='" . $layout . "', color ='" . $color .
            "', verb ='" . $verb . "', face ='" . $face . "', 
                     width = '" . $width . "', css = '" . $css . "', height = '" .
            $height . "', ht = '" . $HT . "', home = '".$home."', page = '".$page."', post = '".$post."' WHERE id = '1'") or die(mysql_error());

    }

    if (mysql_num_rows($Query) < 1) {

        $wpdb->query('INSERT INTO `' . $table_name .
            '` (`type`, `appid`, `pos`, `layout`, `color`, `verb`, `face` ,`width`, `css`, `height`, `ht`, `home`, `page`, `post`)
       VALUES("' . $type . '", "' . $appid . '", "' . $pos . '" , "' . $layout .
            '" , "' . $color . '" , "' . $verb . '", "' . $face . '", "' . $width . '", "' .
            $css . '", "' . $height . '", "' . $HT . '", "' .
            $home . '", "' . $page . '", "' . $post . '")') or die(mysql_error());
        ;

    }

?><div class="updated"><p><strong><?php _e('Settings Saved!')?></strong></p></div><?php
}
// End Save Settings

//Export the button
add_filter('the_content', 'Add_Like_Button');
function Add_Like_Button($content)
{

    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    $table_name = $wpdb->prefix . "FBLikes";

    $Type = $wpdb->get_var("SELECT type FROM $table_name WHERE id = '1'"); //Get Type
    $AppID = $wpdb->get_var("SELECT appid FROM $table_name WHERE id = '1'"); //Get appid
    $Pos = $wpdb->get_var("SELECT pos FROM $table_name WHERE id = '1'"); //Get posetion
    $Layout = $wpdb->get_var("SELECT layout FROM $table_name WHERE id = '1'"); //Get layout
    $verb = $wpdb->get_var("SELECT verb FROM $table_name WHERE id = '1'"); //Get verb
    $color = $wpdb->get_var("SELECT color FROM $table_name WHERE id = '1'"); //Get color
    $Face = $wpdb->get_var("SELECT face FROM $table_name WHERE id = '1'"); //Get Face
    $width = $wpdb->get_var("SELECT width FROM $table_name WHERE id = '1'"); //Get width
    $Width = ($width == null) ? '450' : $width;
    $CSS = $wpdb->get_var("SELECT css FROM $table_name WHERE id = '1'"); //Get width
    $height = $wpdb->get_var("SELECT height FROM $table_name WHERE id = '1'"); //Get Height
    $HT = $wpdb->get_var("SELECT ht FROM $table_name WHERE id = '1'"); //Get Height Type
    
	$Home = $wpdb->get_var("SELECT home FROM $table_name WHERE id = '1'"); //Get Home Type
	$Page = $wpdb->get_var("SELECT page FROM $table_name WHERE id = '1'"); //Get Page Type
	$Post = $wpdb->get_var("SELECT post FROM $table_name WHERE id = '1'"); //Get Post Type 
    
    $face = ($Face == "true") ? 'true' : 'false';

    $SDK = '<div id="fb-root"></div>
       <script>
       window.fbAsyncInit = function() {
       FB.init({appId: "' . $AppID . '", status: true, cookie: true,
             xfbml: true});
        };
     (function() {
      var e = document.createElement("script"); e.async = true;
     e.src = document.location.protocol +
       "//connect.facebook.net/en_US/all.js";
     document.getElementById("fb-root").appendChild(e);
   }());
   </script>';

    $url = get_permalink(get_the_ID());


    $xfbml = '<div class = "' . $CSS . '"  style = "height: ' . $height . $HT .
        '"><fb:like href="' . $url . '" layout="' . $Layout . '" show_faces="' . $face .
        '" width="' . $Width . '" action="' . $verb . '" colorscheme="' . $color .
        '" /></div><br>';
    $iframe = ' 
   <div class = "' . $CSS . '" style = "height: ' . $height . $HT .
        '"><iframe src="http://www.facebook.com/plugins/like.php?href=' . $url .
        '"&layout=' . $Layout . '&show_faces=' . $face . '&width=' . $Width . '&action=' .
        $verb . '&colorscheme=' . $color .
        '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:450px; height:px"></iframe></div><br>';

    if((is_front_page()) && ($Home == "true") || (is_single()) && ($Post == "true") || (is_page()) && ($Page == "true") ){  
    if (($Type == "xfbml") && ($Pos == 'after')) {

        $but = $SDK . $xfbml;
        $content = $content . $but;
        str_replace('[Like_Button]', $but , $content);

    }
    if (($Type == "xfbml") && ($Pos == 'before')) {

        $but = $SDK . $xfbml;
        $content = $but . $content;
        str_replace('[Like_Button]', $but , $content);
    }

    if (($Type == "xfbml") && ($Pos == 'baf')) {

        $but = $SDK . $xfbml;
        $content = $but . $content . $but;
        
        str_replace('[Like_Button]', $but, $content);
    }

    if (($Type == 'iframe') && ($Pos == 'after')) {
        $content .= $iframe;
    }

    if (($Type == 'iframe') && ($Pos == 'before')) {

        $content = $iframe . $content;
    }

    if (($Type == 'iframe') && ($Pos == 'baf')) {

        $content = $iframe . $content . $iframe;
    }
	
	}
	
	
	if((is_front_page()) && ($Home == "") || (is_single()) && ($Post == "") || (is_page()) && ($Page == "") ){  
	
	$content = $content;
	
	}


    return $content;

}

function Short_Button(){
	
	
    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    $table_name = $wpdb->prefix . "FBLikes";

    $Type = $wpdb->get_var("SELECT type FROM $table_name WHERE id = '1'"); //Get Type
    $AppID = $wpdb->get_var("SELECT appid FROM $table_name WHERE id = '1'"); //Get appid
    $Pos = $wpdb->get_var("SELECT pos FROM $table_name WHERE id = '1'"); //Get posetion
    $Layout = $wpdb->get_var("SELECT layout FROM $table_name WHERE id = '1'"); //Get layout
    $verb = $wpdb->get_var("SELECT verb FROM $table_name WHERE id = '1'"); //Get verb
    $color = $wpdb->get_var("SELECT color FROM $table_name WHERE id = '1'"); //Get color
    $Face = $wpdb->get_var("SELECT face FROM $table_name WHERE id = '1'"); //Get Face
    $width = $wpdb->get_var("SELECT width FROM $table_name WHERE id = '1'"); //Get width
    $Width = ($width == null) ? '450' : $width;
    $CSS = $wpdb->get_var("SELECT css FROM $table_name WHERE id = '1'"); //Get width
    $height = $wpdb->get_var("SELECT height FROM $table_name WHERE id = '1'"); //Get Height
    $HT = $wpdb->get_var("SELECT ht FROM $table_name WHERE id = '1'"); //Get Height Type

    $face = ($Face == "true") ? 'true' : 'false';

    $SDK = '<div id="fb-root"></div>
       <script>
       window.fbAsyncInit = function() {
       FB.init({appId: "' . $AppID . '", status: true, cookie: true,
             xfbml: true});
        };
     (function() {
      var e = document.createElement("script"); e.async = true;
     e.src = document.location.protocol +
       "//connect.facebook.net/en_US/all.js";
     document.getElementById("fb-root").appendChild(e);
   }());
   </script>';

    $url = get_permalink(get_the_ID());


    $xfbml = '<div class = "' . $CSS . '"  style = "height: ' . $height . $HT .
        '"><fb:like href="' . $url . '" layout="' . $Layout . '" show_faces="' . $face .
        '" width="' . $Width . '" action="' . $verb . '" colorscheme="' . $color .
        '" /></div>';
    $iframe = ' 
   <div class = "' . $CSS . '" style = "height: ' . $height . $HT .
        '"><iframe src="http://www.facebook.com/plugins/like.php?href=' . $url .
        '"&layout=' . $Layout . '&show_faces=' . $face . '&width=' . $Width . '&action=' .
        $verb . '&colorscheme=' . $color .
        '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:450px; height:px"></iframe></div>';

     
    if ($Type == "xfbml") {

        $but = $SDK . $xfbml;
        

    }

    if ($Type == 'iframe') {

        $but = $iframe;
        
        
    }
	
    return $but;

	
}

function Count_Button(){
	
	
    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    $table_name = $wpdb->prefix . "FBLikes";

    $Type = $wpdb->get_var("SELECT type FROM $table_name WHERE id = '1'"); //Get Type
    $AppID = $wpdb->get_var("SELECT appid FROM $table_name WHERE id = '1'"); //Get appid
    $Pos = $wpdb->get_var("SELECT pos FROM $table_name WHERE id = '1'"); //Get posetion
    $Layout = $wpdb->get_var("SELECT layout FROM $table_name WHERE id = '1'"); //Get layout
    $verb = $wpdb->get_var("SELECT verb FROM $table_name WHERE id = '1'"); //Get verb
    $color = $wpdb->get_var("SELECT color FROM $table_name WHERE id = '1'"); //Get color
    $Face = $wpdb->get_var("SELECT face FROM $table_name WHERE id = '1'"); //Get Face
    $width = $wpdb->get_var("SELECT width FROM $table_name WHERE id = '1'"); //Get width
    $Width = ($width == null) ? '450' : $width;
    $CSS = $wpdb->get_var("SELECT css FROM $table_name WHERE id = '1'"); //Get width
    $height = $wpdb->get_var("SELECT height FROM $table_name WHERE id = '1'"); //Get Height
    $HT = $wpdb->get_var("SELECT ht FROM $table_name WHERE id = '1'"); //Get Height Type

    $face = ($Face == "true") ? 'true' : 'false';

    $SDK = '<div id="fb-root"></div>
       <script>
       window.fbAsyncInit = function() {
       FB.init({appId: "' . $AppID . '", status: true, cookie: true,
             xfbml: true});
        };
     (function() {
      var e = document.createElement("script"); e.async = true;
     e.src = document.location.protocol +
       "//connect.facebook.net/en_US/all.js";
     document.getElementById("fb-root").appendChild(e);
   }());
   </script>';

    $url = get_permalink(get_the_ID());


    $xfbml = '<div class = "' . $CSS . '"  style = "height: ' . $height . $HT .
        '"><fb:like href="' . $url . '" layout="button_count" show_faces="' . $face .
        '" width="' . $Width . '" action="' . $verb . '" colorscheme="' . $color .
        '" /></div><br>';
    $iframe = ' 
   <div class = "' . $CSS . '" style = "height: ' . $height . $HT .
        '"><iframe src="http://www.facebook.com/plugins/like.php?href=' . $url .
        '"&layout=button_count&show_faces=' . $face . '&width=' . $Width . '&action=' .
        $verb . '&colorscheme=' . $color .
        '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:450px; height:px"></iframe></div><br>';

     
    if ($Type == "xfbml") {

        $but = $SDK . $xfbml;
        

    }

    if ($Type == 'iframe') {

        $but = $iframe;
        
        
    }
	
    return $but;

	
}


function Add_Site_Name(){
	
	$Name = get_bloginfo('name');
	
	$Meta = '<meta property="og:site_name" content="'.$Name.'"/>';
	
	echo $Meta;
	
}

add_shortcode('fb_like', 'Short_Button');
add_shortcode('fb_count', 'Count_Button');
add_action('wp_head', 'Add_Site_Name');

 

?>