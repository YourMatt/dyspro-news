<?php
global $wpdb;

// define paths
define ('DN_BASE_PATH', dirname (__FILE__));
define ('DN_BASE_WEB_PATH', plugin_dir_url ( __FILE__ ));

// define roles
define ('DN_POST_TYPE_NAME', 'dn_news');

// set plugin settings
define ('DN_BASE_PERMALINK', 'news');
define ('DN_ADMIN_LINK_POSITION', 22);

// load support files
require_once (DN_BASE_PATH . '/classes/dn-utilities.php');
require_once (DN_BASE_PATH . '/classes/dn-plugin-manager.php');
require_once (DN_BASE_PATH . '/classes/dn-shortcode-manager.php');
require_once (DN_BASE_PATH . '/classes/dn-widget.php');
