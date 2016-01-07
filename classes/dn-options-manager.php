<?

class dn_options_manager {

    private $nonce_action = 'dn_options';

    public function __construct () {

        // add save callbacks
        add_action ('save_post', array ($this, 'save_options_meta_form'));

    }

    // Administration forms
    function add_meta_boxes () {

        // create the location meta box
        add_meta_box (
            'options',
            'Options',
            array ($this, 'build_contact_meta_form'),
            DN_POST_TYPE_NAME
        );

    }

    function build_contact_meta_form ($post) {

        // create the nonce
        wp_nonce_field ($this->nonce_action, 'dn_options_nonce');

        // load current values
        $option_data = get_metadata ('post', $post->ID);

        // add the form contents
        include (DN_BASE_PATH . "/content/meta-options.php");

    }

    function save_options_meta_form ($post_id) {

        // verify the nonce
        if (! wp_verify_nonce ($_POST['dn_options_nonce'], $this->nonce_action)) return $post_id;

        // save the contact data to meta fields
        dn_utilities::save_meta_field ($post_id, 'custom_url', '_dn_custom_url');

        return $post_id;

    }

}
