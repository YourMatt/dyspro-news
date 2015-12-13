<?

class dn_plugin_manager {

   public function __construct () {}

   // run when activating the plugin
   function activate () {

      // flush the rewrite rules
      flush_rewrite_rules ();

   }

   // add the news post type - this is loaded on init
   function register_news_post_type () {

      register_post_type (
         DN_POST_TYPE_NAME,
         array(
            'labels' => array (
               'name' => 'News Items',
               'singular_name' => 'News Item',
               'add_new' => 'Add New',
               'add_new_item' => 'Add New News Item',
               'edit_item' => 'Edit News Item'
            ),
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array (
               'slug'=> DN_BASE_PERMALINK,
               'with_front'=> false,
               'feeds'=> true,
               'pages'=> true
            ),
            'capability_type' => 'page',
            'has_archive' => false,
            'hierarchical' => true,
            'menu_icon' => 'dashicons-megaphone',
            'menu_position' => DN_ADMIN_LINK_POSITION,
            'supports' => array (
               'thumbnail',
               'title',
               'editor',
               'excerpt'
            )
         )
      );

   }

}