<?php
/**
* Plugin Name: Profile Picture 
* Version:1.0
* Author: Arul Jayaraj
* Author URI: http://www.aruljayaraj.com
* Description: Upload and set user's custom profile picture in your local, and you may have options to allow (like Subscriber, Contributor) to upload their profile picture based on user permission
**/
if (!defined('WP_CONTENT_URL')){
	define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
}
if (!defined('WP_CONTENT_DIR')){
	define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
}
if (!defined('WP_PLUGIN_URL') ){
	define('WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins');
}
if (!defined('WP_PLUGIN_DIR') ){
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
}
if (!defined('PP_PLUGIN_URL') ){
	define('PP_PLUGIN_URL', WP_CONTENT_URL. '/plugins/profile-picture');
}
if (!defined('PP_PLUGIN_DIR') ){
	define('PP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins/profile-picture');
}
if (!defined('DS') ){
	define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('PP_PLUGIN_ASSETS_URL') ){
	define('PP_PLUGIN_ASSETS_URL', PP_PLUGIN_URL.'/assets');
}
if (!defined('PP_PLUGIN_HTML_DIR') ){
	define('PP_PLUGIN_HTML_DIR', PP_PLUGIN_DIR.DS.'html');
}

require_once PP_PLUGIN_DIR.DS.'class'.DS.'class_pp.php';
new ProfilePicture();
?>
