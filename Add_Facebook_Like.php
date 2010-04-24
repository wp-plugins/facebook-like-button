<?php 
/*
Plugin Name: Facebook Like
Plugin URI: http://www.ahmedgeek.com
Description: Add the facebook like button for your blog.
Version: 2.0 
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
             `pos` VARCHAR( 32 ) NOT NULL 
	);";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

   
 
      add_option("jal_db_version", $jal_db_version);

   }
}
register_activation_hook(__FILE__,'jal_install');

//End Create Table


//start print button
function Add_Like_Button($content) {
//Get type and appid

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
 global $wpdb;
 $table_name = $wpdb->prefix . "FBLikes";
 


$type = $wpdb->get_var( "SELECT type FROM `$table_name` WHERE id = '1'" ); //Type
$pos = $wpdb->get_var( "SELECT pos FROM `$table_name` WHERE id = '1'" );
$appid= $wpdb->get_var( "SELECT appid FROM `$table_name` WHERE id = '1'" ); //App ID

$SDK = '<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({appId: "'.$appid.'", status: true, cookie: true,
             xfbml: true});
  };
  (function() {
    var e = document.createElement("script"); e.async = true;
    e.src = document.location.protocol +
      "//connect.facebook.net/en_US/all.js";
    document.getElementById("fb-root").appendChild(e);
  }());
</script>';

//iFrame Version

if(($type == 'iframe') && ($pos == 'after')){
    
$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

        $content .="<br><iframe src='http://www.facebook.com/widgets/like.php?href=$url'
        scrolling='no' frameborder='0'
        style='border:none; width:450px; height:80px'></iframe>";
}

if(($type == 'iframe') &&  ($pos == 'before')){
    
$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $but = "<br><iframe src='http://www.facebook.com/widgets/like.php?href=$url'
        scrolling='no' frameborder='0'
        style='border:none; width:450px; height:80px'></iframe>";
        $content = $but.$content;
}
//End iFrame Version

//XFBML Version

if(($type == "xfbml") && ($pos == 'after') ){
    
     $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
     $but = $SDK.
     '<div><fb:like href="'.$url.'" layout="standard" show_faces="true" width="450" action="like" colorscheme="light" /></div>';
     $content = $content.$but;
     
}
if(($type == "xfbml") && ($pos == 'before') ){
    
     $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
     $but = $SDK.
     '<div><fb:like href="'.$url.'" layout="standard" show_faces="true" width="450" action="like" colorscheme="light" /></div>';
     $content = $but.$content;
     
}

//XFBML Version
        return $content;
        
        }
        
        add_filter('the_content', 'Add_Like_Button');
 //end print button
 

 
 add_filter('the_excerpt', 'Remove_EX');       
        
//Save Settings
if($_POST['sub']){
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $type = ($_POST['type'] == 'xfbml') ? 'xfbml' : 'iframe' ;
    $appid= $_POST['appid'];
    $pos  = $_POST['pos'];
    global $wpdb;
    $table_name = $wpdb->prefix . "FBLikes";
    
    
    $no3 = $wpdb->get_var( "SELECT type FROM `$table_name` WHERE id = '1'" );
    
    if(($no3 == 'iframe')|| ($no3 == "xfbml")){
        
        mysql_query("UPDATE `$table_name` SET type ='".$type."', appid ='".$appid."', pos ='".$pos."' WHERE id = '1'") or die(mysql_error());
        
    }
    
    if(($no3 != 'iframe')|| ($no3 != "xfbml")){
       
       mysql_query('INSERT INTO `'.$table_name.'` (`type`, `appid`, `pos`) VALUES("'.$type.'", "'.$appid.'", "'.$pos.'")')  or die(mysql_error());; 
        
     }
     
     echo "<script>$(document).ready(function(){
        $('.suc').show();
        
     });</script>"; 

}
// End Save Settings


//Admin Start

add_action('admin_menu','FB_Admin_Box');

function FB_Admin_Cont()
{

       global $wpdb;
       $Layout ='<style>
       .suc{
	-moz-border-radius: 15px;
	border-radius: 15px;
  -webkit-border-radius: 15px;
  height:20px;
  width: 400px;
  background:#B8F1AD;
  color:#666;
  text-align:center; 
}
#error{
    	-moz-border-radius: 15px;
	border-radius: 15px;
  -webkit-border-radius: 15px;
  height:20px;
  width: 400px;
  background:#ff8d8d;
  color:#666;
  text-align:center;
} 
}
</style>
<script src = "http://static.zingyso.com/js/jquery.js" type = "text/javascript" ></script>
<script>
    $(document).ready(function(){
      $("#options").hide();
      $(".suc").hide();
      $("#error").hide();
        
        $("#know").hide();
        $("#xf").change(function(){
            if($("#xf").attr("checked", true)){
                
                $("#options").slideDown("slow");  
            }
        });
         $("#if").change(function(){ 
         if($("#if").attr("checked", true)){
                
                $("#options").slideUp("slow");
                }
               });
              $("#showk").click(function(){
              $("#know").toggle("slow");
       });        
    });
    </script>
    <br><br>
    <center><img src="../wp-content/plugins/Facebook Like/images/ban.png"></center>
    <bR><bR><bR>    
<center><div class="suc">Saved ;)...</div></center><br>
<center><div id = "error"></div></center>
<form id="form" action = "" method="POST">
<table>
<tr>
<h2>General Settings:</h2><br>

<br>
<td>Button Type:</td></tr><tr><br><td>XFBML:<input type="radio" name="type" value="xfbml" id="xf" checked = "'.$xfbml.'"/></td>
                     <td>iFrame:<input type="radio" name="type" value="iframe" id="if" checked = "'.$iframe.'"/></td><td><a href="#" id="showk">What is the deference?</a></td>
</table>
<div id="options">
<label for="addid">App ID:</label><input type="text" name="appid" id="appid"  size="30" value = "'.$id.'"/>
<a href="http://developers.facebook.com/setup/" target="_blank" title="Register Your Site on Facebook">Don"t have one?</a>
</div>
<br><table>
<tr><td>Position:</td><td><select name = "pos" value="$pos"><option value = "after">After Content</option><option value = "before">Before Content</option></select></td></tr>
</table>
<br>
<table><tr><td><input type="submit" name="sub" id="but" value="Save Settings" /></td></tr></table>
</form>
<div id="know">
<p><h2>XFBML</h2><br /><p>XFBML (Facebook Markup Language), It"s more functional then the iFrame version and one of the unique feature that it can show the post of facebook option while the user clicking on the Like button.</p>
<br />
<h2>iFrame</h2><br /><p>iFrame version doesn"t include the post on Facebook feature.</p>
<br><br><center><div>&copy 2010 <a href="http://www.ahmedgeek.com" target="_blank">Ahmed The Geek</a></div></center>';   
    echo $Layout;  
}



function FB_Admin_Box()
{
     add_menu_page('Facebook Like', 'Facebook Like',8,basename(__FILE__));
     add_submenu_page(basename(__FILE__), 'Settings', 'Settings', 8, basename(__FILE__),"FB_Admin_Cont");
  
}

//Admin End


?>