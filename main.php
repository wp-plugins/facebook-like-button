<?php

/*
Plugin Name: Facebook Like
Plugin URI: http://blog.ahmedgeek.com/facebook-like-button-for-wordpress-v3
Description: Add the facebook like button for your blog. Change the button layout, use XFBML or iFrame and much more just in one plugin. Added in 3.4 multiple language support and you can change the font.
Version: 4.0.1
Author: Ahmed Hussein
Author URI: http://www.ahmedgeek.com
License: GPL2

Translation and Fonts developed and added by Anty (mail@anty.at) http://anty.at

Copyright 2010  Facebook Like Button  (email : me@ahmedgeek.com)

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

require_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/local.inc.php");
require_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/admin.inc.php");
require_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/filters.php");
require_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/buttons.inc.php");
require_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/fun.inc.php");
require_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/options.inc.php");
require_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/update_options.inc.php");
require_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/upgrade.inc.php");
require_once(ABSPATH . "wp-content/plugins/facebook-like-button/inc/activation.php");
function FB_Admin_Box()
{
    add_menu_page('Facebook Like', 'Facebook Like', 8, basename(__file__), '' , plugins_url('icon.png',__FILE__));
    add_submenu_page(basename(__file__), 'Settings', 'Settings', 8, basename(__file__),
        "FB_Admin_Cont");

}

add_option("fblikes_locale", "default");
add_option("fblikes_font", "");
add_action('admin_menu', 'FB_Admin_Box');
add_filter('the_content', 'Add_Like_Button');
add_shortcode('fb_like', 'Short_Button');
add_shortcode('fb_count', 'Count_Button');
add_action('wp_head', 'Add_Site_Name');
register_activation_hook( __FILE__, 'Upgrade_Latest' );
ActivationRobot(Activate());



?>