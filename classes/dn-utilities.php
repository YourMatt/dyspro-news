<?

class dn_utilities {

   public static function save_meta_field ($post_id, $field_name, $meta_name) {

      $current_value = get_post_meta ($post_id, $meta_name, true);
      $new_value = $_POST[$field_name];

      if ($current_value) {
         if (! $new_value) delete_post_meta ($post_id, $meta_name);
         else update_post_meta ($post_id, $meta_name, $new_value);
      }
      elseif ($new_value) {
         add_post_meta ($post_id, $meta_name, $new_value, true);
      }

   }

   public static function get_news_items ($get_next_only = false, $thumb_size = 'large') {

      // load the base news posts
      $news = get_posts (array (
         'post_type' => DN_POST_TYPE_NAME,
         'posts_per_page' => ($get_next_only) ? 1 : -1, // either return one or all
         'orderby' => 'date',
         'order' => 'DESC'
      ));
      if (!$news) return array ();

      // load meta data for each news item
      $num_news = count ($news);
      for ($i = 0; $i < $num_news; $i++) {
         $news[$i]->meta = get_post_meta ($news[$i]->ID);
         $news[$i]->thumb = get_the_post_thumbnail ($news[$i]->ID, $thumb_size);
         $news[$i]->link = '/' . DN_BASE_PERMALINK . '/' . $news[$i]->post_name;
      }

      // return single only if requested
      return ($get_next_only) ? $news[0] : $news;

   }

}