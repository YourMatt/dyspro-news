<?php
/*
Plugin Name: Dyspro News
Plugin URI:
Description: Creates a new news content type with simple retrieval through shortcodes.
Version: 0.9
Author: Dyspro Media
Author URI: http://dyspromedia.com
*/

// load configuration variables
require_once(dirname(__FILE__) . '/config.php');

// initialize objects
$dn_plugin_manager = new dn_plugin_manager ();
$dn_shortcode_manager = new dn_shortcode_manager ();

// add installation script
register_activation_hook (__FILE__, array ($dn_plugin_manager, 'activate'));

// set up actions
add_action ('init', array ($dn_plugin_manager, 'register_news_post_type'));
add_action ('widgets_init', function () { register_widget ('dn_widget'); });

// set up shortcodes
add_shortcode ('dn_news_list', array ($dn_shortcode_manager, 'build_news_list'));
