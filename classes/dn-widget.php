<?

class dn_widget extends WP_Widget {

   function __construct () {
      parent::__construct (
         'dn_widget',
         'News',
         array (
            'description' => 'Displays news items.'
         )
      );
   }

   function widget ($args, $instance) {

      // load the latest news item
      $news_item = dn_utilities::get_news_items (true, 'medium');

      // write the widget contents
      $title = apply_filters ('widget_title', $instance['title']);
      print $args['before_widget'];
      print $args['before_title'] . $title . $args['after_title'];

      if ($news_item) $this->build_latest_news_item ($news_item);
      else $this->build_no_news_message ($instance);

      print $args['after_widget'];

   }

   function build_no_news_message ($instance) {

      $no_news_items_message = $instance['no_news_items_message'];

      print '<div class="newswidget-empty">';
      print '<h3>There are currently no news items.</h3>';
      if ($no_news_items_message) {
         print '<p>' . $instance['no_news_items_message'] . '</p>';
      }
      print '</div>';

   }

   function build_latest_news_item (&$news_item) {

      $url = $news_item->link;
      $target = '';
      $custom_url = get_metadata ('post', $news_item->ID)["_dn_custom_url"][0];
      if ($custom_url) {
         $url = $custom_url;
         $target = '_new';
      }

      print '<div class="newswidget">';
      print '<div class="news-item">';
      if ($news_item->thumb) {
         print '<a href="' . $url . '" target="' . $target . '" class="thumb">' . $news_item->thumb . '</a>';
      }
      print '<h4>' . $news_item->post_title . '</h4>';
      print $news_item->post_excerpt;
      print '<a href="' . $url . '" target="' . $target . '">View Details</a>';
      print '</div>';
      print '</div>';

   }

   function update ($new_instance, $old_instance) {

      return $new_instance;

   }

   function form ($instance) {

      $title = $instance['title'];
      $no_news_items_message = $instance['no_news_items_message'];

      print '<p>';
      print '<label for="' . $this->get_field_id ('title') . '">Title:</label>';
      print '<input id="' . $this->get_field_id ('title') . '" name="' . $this->get_field_name ('title') . '" type="text" value="' . esc_attr ($title) . '"/>';
      print '</p>';

      print '<p>';
      print '<label for="' . $this->get_field_id ('no_news_items_message') . '">No News Items Custom Message:</label>';
      print '<textarea id="' . $this->get_field_id ('no_news_items_message') . '" name="' . $this->get_field_name ('no_news_items_message') . '">' . $no_news_items_message . '</textarea>';
      print '</p>';

   }

}
