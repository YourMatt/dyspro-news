<?

class dn_shortcode_manager {

   public function build_news_list () {

      $news_list = '';
      $news_items = dn_utilities::get_news_items ();

      // show message for no news items if none found
      if (!$news_items) {
         return $this->build_no_news_message ();
      }

      // display all news items
      foreach ($news_items as $news_item) {

         $date = date ('l, M. jS', strtotime ($news_item->post_date));

         // format the url, overriding with a custom value if provided
         $url = $news_item->link;
         $target = '';
         $custom_url = get_metadata ('post', $news_item->ID)["_dn_custom_url"][0];
         if ($custom_url) {
            $url = $custom_url;
            $target = '_new';
         }

         // add the news item
         $news_list .= '<li>';
         if ($news_item->thumb) {
            $news_list .= '<div class="event-photo"><a href="' . $url . '" target="' . $target . '">' . $news_item->thumb . '</a></div>';
         }
         $news_list .= '<h3 class="title">' . $news_item->post_title . '</h3>';
         $news_list .= '<div class="date">' . $date . '</div>';
         $news_list .= '<div class="description">' . $news_item->post_excerpt . '</div>';
         $news_list .= '<a class="details-link" href="' . $url . '" target="' . $target . '"><span>Details</span></a>';
         $news_list .= '</li>';

      }

      $news_list = '<ul class="news">' . $news_list . '</ul>';

      return $news_list;

   }

   private function build_no_news_message () {

      $message = '<ul class="news">';
      $message .= '<li class="no-news"><p>There are no news items.</p></li>';
      $message .= '</ul>';

      return $message;

   }

}