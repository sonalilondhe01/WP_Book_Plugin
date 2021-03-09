<?php

/**
 *  We are creating custom meta_box for
 * our custom post type here.
 */

class create_custom_book_meta_box {

    function __construct()
    {
        add_action('add_meta_boxes', array($this, 'create_wp_book_meta_box'));

        /**
         * This hook adds wp_jquery.js file so that
         * we can validate our html meta_box.
         */
        add_action('admin_enqueue_scripts', array($this, 'wp_book_enqueue_scripts'));
        add_action('save_post', array($this, 'save_wp_book_meta_box_meta'));
        add_action('init', array($this, 'create_custom_wp_table'));

    }

    /**
* This function creates a meta_box for custom type book
 * Contains Author Name, Price, Publisher, Year etc.
 */
    function create_wp_book_meta_box()
    {
        $screen = 'book';
        add_meta_box(
            'wp_book_meta_box_id',
            'Book Information',
            array($this, 'wp_book_meta_box_html'),
            $screen
        );
    }


    /**
     * This function shows html elements that will be shown in
     * our custom meta_box for 'book' post type in table.
     *
     * @param object $post optional
     * Parameter describes the post to which
     * Meta_box refers
     */
    function wp_book_meta_box_html( $post )
    {
        global $wpdb;
        $post_id = $GLOBALS['post_id'];
        $result = $wpdb->get_row("SELECT * FROM wp_book_meta WHERE post_id = '$post_id'");
        ?>

        <div>
        <style scoped>
            .form-control {
                display: block;
                width: 100%;
                margin: 5px 0 10px 0;
            }
        </style>
        <form id="author-book-info" name="author-book-info" method="post" action="">
        <div>
            <label for="wp_author"><b>Author Name:</b></label>
            <input
                    type="text"
                    name="wp_author"
                    id="wp_author"
                    class="form-control"
                    required="true"
                    value="<?php if($result){echo esc_html( sanitize_text_field($result->author_name) );} ?>" />
        </div>
        <div>
            <label for="wp_price"><b>Price:</b></label>
            <input
                    type="number"
                    name="wp_price"
                    id="wp_price"
                    class="form-control"
                    required="true"
                    step="0.10"
                    value="<?php if($result){echo esc_html( sanitize_text_field($result->price) );} ?>" />
        </div>
        <div>
            <label for="wp_publisher"><b>Publisher:</b></label>
            <input
                    type="text"
                    name="wp_publisher"
                    id="wp_publisher"
                    class="form-control"
                    required="true"
                    value="<?php if($result){echo esc_html( sanitize_text_field($result->publisher) );} ?>" />
        </div>
        <div>
            <label for="wp_year"><b>Publishing Month, Year:</b></label>
            <input
                    type="month"
                    name="wp_year"
                    id="wp_year"
                    class="form-control"
                    value="<?php if($result){echo esc_html( sanitize_text_field($result->year) );} ?>" />
        </div>
        <div>
            <label for="wp_edition"><b>Edition:</b></label>
            <input
                    type="text"
                    name="wp_edition"
                    id="wp_edition"
                    class="form-control"
                    required="true"
                    value="<?php if($result){echo esc_html( sanitize_text_field($result->edition) );} ?>" />
        </div>
        <div>
            <label for="wp_url"><b>URL:</b></label>
            <input
                    type="text"
                    name="wp_url"
                    id="wp_url"
                    class="form-control"
                    required="true"
                    value="<?php if($result){echo esc_url( sanitize_text_field($result->url) , true);} ?>" />
        </div>

        <?php
    }


    /**
     * This function allows to include scripting file
     * we have used script to validate html form
     */
    function wp_book_enqueue_scripts()
    {
        wp_enqueue_script(
            'wp_book_jquery',
            plugins_url('/js/wp_jquery.js', __FILE__), array('jquery')
        );
    }

    /**
     *This function creates a custom table 'wp_custom_metabox_info'
     * to store data publish by our custom metabox
     */
    function create_custom_wp_table ()
    {
        $table_name = 'wp_book_meta';
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta(
            "CREATE TABLE $table_name (
          ID bigint(20) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
          post_id int(10) NOT NULL,
          author_name varchar(60) NOT NULL DEFAULT '',
          price decimal(6,2) NOT NULL DEFAULT 0000.00,
          publisher varchar(100) NOT NULL DEFAULT '',
          year varchar(20) NOT NULL,
          edition varchar(55) NOT NULL,
          url varchar(64) DEFAULT '' NOT NULL
        ) CHARACTER SET utf8 COLLATE utf8_general_ci;"
        );
    }
    function save_wp_book_meta_box_meta($post_id) {
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if( $parent_id = wp_is_post_revision( $post_id ) ) {
            $post_id = $parent_id;
        }

        $GLOBALS['post_id'] = $post_id;

        if(isset( $_POST['wp_author'] ))
        {
            $author_name    = $_POST['wp_author'];
            $price          = $_POST['wp_price'];
            $publisher      = $_POST['wp_publisher'];
            $year           = $_POST['wp_date'];
            $edition        = $_POST['wp_edition'];
            $url            = $_POST['wp_url'];

            global $wpdb;
            $args = array(
                'author_name'   => $author_name,
                'post_id'       => $post_id,
                'price'         => $price,
                'publisher'     => $publisher,
                'year'          => $year,
                'edition'       => $edition,
                'url'           => $url);

            $count = $wpdb->get_var("SELECT COUNT(*) FROM wp_book_meta WHERE post_id = '$post_id'");
            if ($count == 1) {
                $wpdb->update('wp_book_meta', $args, array('post_id' => $post_id));
            } else {
                $wpdb->insert('wp_book_meta', $args);
            }
        }
    }
}
new create_custom_book_meta_box();





