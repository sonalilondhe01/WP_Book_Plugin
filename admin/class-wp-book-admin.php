<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link  https://github.com/sonalirlondhe
 * @since 1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Sonali Londhe <sonalilondhe.01@gmail.com>
 */

class Wp_Book_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $plugin_name The name of this plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * An instance of this class should be passed to the run() function
         * defined in Wp_Book_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wp_Book_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url(__FILE__) . 'css/wp-book-admin.css',
            array(), $this->version, 'all'
        );

    }

    /**
     * Register the JavaScript for the admin area.
     * This function allows to include scripting file
     * we have used script to validate html form
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * An instance of this class should be passed to the run() function
         * defined in Wp_Book_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wp_Book_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__) . 'js/wp-book-admin.js',
            array( 'jquery' ), $this->version, false
        );

    }


    /**
     * This class create a custom post type called 'Book'
     */
    function render_custom_post_wp_book()
    {
        $labels = array(
            'name'                  => _x(
                'Books',
                'Post type general name',
                'textdomain'
            ),
            'singular_name'         => _x(
                'Book',
                'Post type singular name',
                'textdomain'
            ),
            'menu_name'             => _x(
                'Books',
                'Admin Menu text',
                'textdomain'
            ),
            'name_admin_bar'        => _x(
                'Book',
                'Add New on Toolbar',
                'textdomain'
            ),
            'add_new'               => __(
                'Add New',
                'textdomain'
            ),
            'add_new_item'          => __(
                'Add New Book',
                'textdomain'
            ),
            'new_item'              => __(
                'New Book',
                'textdomain'
            ),
            'edit_item'             => __(
                'Edit Book',
                'textdomain'
            ),
            'view_item'             => __(
                'View Book',
                'textdomain'
            ),
            'all_items'             => __(
                'All Books',
                'textdomain'
            ),
            'search_items'          => __(
                'Search Books',
                'textdomain'
            ),
            'parent_item_colon'     => __(
                'Parent Books:',
                'textdomain'
            ),
            'not_found'             => __(
                'No books found.',
                'textdomain'
            ),
            'not_found_in_trash'    => __(
                'No books found in Trash.',
                'textdomain'
            ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'book' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'supports'           => array(
                'title',
                'editor',
                'author',
                'thumbnail',
                'excerpt',
                'comments'
            ),
            'menu_position'      => 5,

        );
        register_post_type('Book', $args);

    }

    /**
     * This function creates 2 taxonomies for post type = 'Book'
     * Hierarchical taxonomy: 'Book Category'
     * Non-Hierarchical taxonomy: 'Book Tag'
     */
    function create_wp_book_taxonomies()
    {
        $labels = array(
            'name'              => _x(
                'Book Categories',
                'taxonomy general name',
                'textdomain'
            ),
            'singular_name'     => _x(
                'Book Category',
                'taxonomy singular name',
                'textdomain'
            ),
            'search_items'      => __(
                'Search Book Category',
                'textdomain'
            ),
            'all_items'         => __(
                'All Book Categories',
                'textdomain'
            ),
            'parent_item'       => __(
                'Parent Book Category',
                'textdomain'
            ),
            'parent_item_colon' => __(
                'Parent Book Category:',
                'textdomain'
            ),
            'edit_item'         => __(
                'Edit Book Category',
                'textdomain'
            ),
            'update_item'       => __(
                'Update Book Category',
                'textdomain'
            ),
            'add_new_item'      => __(
                'Add New Book Category',
                'textdomain'
            ),
            'new_item_name'     => __(
                'New Book Category Name',
                'textdomain'
            ),
            'menu_name'         => __(
                'Book Categories',
                'textdomain'
            ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'book-category' ),
        );
        register_taxonomy('Book Category', 'book', $args);

        unset($labels);
        unset($args);

        $labels = array(
            'name'                       => _x(
                'Book Tags',
                'taxonomy general name',
                'textdomain'
            ),
            'singular_name'              => _x(
                'Book Tag',
                'taxonomy singular name',
                'textdomain'
            ),
            'search_items'               => __(
                'Search Book Tag',
                'textdomain'
            ),
            'popular_items'              => __(
                'Popular Book Tags',
                'textdomain'
            ),
            'all_items'                  => __(
                'All Book Tags',
                'textdomain'
            ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __(
                'Edit Book Tag',
                'textdomain'
            ),
            'update_item'                => __(
                'Update Book Tag',
                'textdomain'
            ),
            'add_new_item'               => __(
                'Add New Book Tag',
                'textdomain'
            ),
            'new_item_name'              => __(
                'New Book Tag Name',
                'textdomain'
            ),
            'separate_items_with_commas' => __(
                'Separate Book Tags with commas',
                'textdomain'
            ),
            'add_or_remove_items'        => __(
                'Add or remove Book Tag',
                'textdomain'
            ),
            'choose_from_most_used'      => __(
                'Choose from the most used Book Tags',
                'textdomain'
            ),
            'not_found'                  => __(
                'No Book Tag found.',
                'textdomain'
            ),
            'menu_name'                  => __(
                'Book Tags',
                'textdomain'
            ),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'book-tag' ),
        );
        register_taxonomy('Book Tag', 'book', $args);
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
     *                     Parameter describes the post to which
     *                     Meta_box refers
     */
    function wp_book_meta_box_html( $post )
    {
        global $wpdb;
        $result = $wpdb->get_row(
            "SELECT * FROM wp_book_meta WHERE post_id = '$post->ID'"
        );
        ?>

        <div>
        <form id="author-book-info" name="author-book-info" method="post" action="">
        <div>
            <label for="wp_author"><b>Author Name:</b></label>
            <input
                type="text"
                name="wp_author"
                id="wp_author"
                class="form-control"
                required="true"
                style = "display: inline; width: 60%;margin: 5px 0 10px 50px;"
                value="<?php if($result) {
                    echo esc_html($result->author_name);
                       }
                       ?>"
            />
        </div>
        <div>
            <label for="wp_price"><b>Price( In <?php echo get_option( 'wp_currency_settings_field',
                        'rupee' )
                    ?> ) :</b></label>
            <input
                type="number"
                name="wp_price"
                id="wp_price"
                class="form-control"
                required="true"
                style = "display: inline; width: 60%;margin: 5px 0 10px 30px;"
                step="0.10"
                min = '1'
                value="<?php if($result) {
                    echo esc_html($result->price);
                       } ?>"
            />
        </div>
        <div>
            <label for="wp_publisher"><b>Publisher:</b></label>
            <input
                type="text"
                name="wp_publisher"
                id="wp_publisher"
                class="form-control"
                required="true"
                style = "display: inline; width: 60%;margin: 5px 0 10px 78px;"
                value="<?php if($result) {
                    echo esc_html($result->publisher);
                       } ?>"
            />
        </div>
        <div>
            <label for="wp_year"><b>Publishing date:</b></label>
            <input
                type="month"
                name="wp_year"
                id="wp_year"
                style = "display: inline; width: 60%;margin: 5px 0 10px 42px;"
                class="form-control"
                value="<?php if($result) {
                    echo esc_html($result->year);
                       } ?>"
            />
        </div>
        <div>
            <label for="wp_edition"><b>Edition:</b></label>
            <input
                type="text"
                name="wp_edition"
                id="wp_edition"
                class="form-control"
                required="true"
                style = "display: inline; width: 60%;margin: 5px 0 10px 90px;"
                value="<?php if($result) {
                    echo esc_html($result->edition);
                       } ?>"
            />
        </div>
        <div>
            <label for="wp_url"><b>URL:</b></label>
            <input
                type="url"
                name="wp_url"
                id="wp_url"
                class="form-control"
                required="true"
                style = "display: inline; width: 60%;margin: 5px 0 10px 110px;"
                value="<?php if($result) {
                    echo esc_url($result->url);
                       } ?>"
            />
        </div>
        </form>
        </div>

        <?php
    }

    /**
     * This function saves custom fields from custom meta box
     * into custom table.
     *
     * @param int $post_id optional Indicates post_id for post
     *                     that will be store in custom database
     */
    function save_wp_book_meta_box_meta(int $post_id)
    {
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        {
            return;
        }
        if($parent_id = wp_is_post_revision($post_id) ) {
            $post_id = $parent_id;
        }

        $GLOBALS['post_id'] = $post_id;

        if(isset($_POST['wp_author'])) {
            $author_name    = $_POST['wp_author'];
            $price          = $_POST['wp_price'];
            $publisher      = $_POST['wp_publisher'];
            $year           = $_POST['wp_year'];
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

            $count = $wpdb->get_var(
                "SELECT COUNT(*) FROM wp_book_meta WHERE post_id = '$post_id'"
            );
            if ( $count == 1 ) {
                $wpdb->update('wp_book_meta',
                    $args,
                    array(
                        'post_id' => $post_id
                    )
                );
            } else {
                $wpdb->insert('wp_book_meta', $args );
            }
        }
    }
    /**
     * This function creates sub_menu_page under 'book'
     * post type.
     */
    function add_custom_book_sub_menu_page()
    {
        add_submenu_page(
            'edit.php?post_type=book',
            __( 'Books Settings Page', 'wp_book' ),
            __( 'Book Settings', 'wp_book' ),
            'manage_options',
            'book-settings',
            array($this, 'render_custom_book_settings_page')
        );
    }

    /**
     * This function defines how the custom submenu_page
     * will render by defining settings for it.
     */
    function render_custom_book_settings_page()
    {
        ?>
        <div class = "wrap">
            <h1><?php echo esc_html(get_admin_page_title());?></h1>
            <form id = "custom_book_settings_page_form"
                  method = "post"
                  action = "options.php">
                <?php
                settings_fields('book-settings');
                do_settings_sections('book-settings');
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * This function defines Setting section, adds settings fields
     * to our custom submenu page..
     */
    function custom_sub_menu_page_init()
    {

        add_settings_section(
            'wp_custom_settings_section',
            'Custom Book Settings',
            '',
            'book-settings'
        );
        register_setting(
            'book-settings',
            'wp_currency_settings_field'
        );
        register_setting(
            'book-settings',
            'wp_books_per_page_field'
        );
        add_settings_field(
            'wp_currency_settings_field',
            __('Currency Settings', 'wp-book'),
            array($this, 'wp_render_currency_setting'),
            'book-settings',
            'wp_custom_settings_section'
        );
        add_settings_field(
            'wp_books_per_page_field',
            __('Books per page', 'wp-book'),
            array($this, 'wp_render_books_per_page_setting'),
            'book-settings',
            'wp_custom_settings_section'
        );

    }

    /**
     * This function renders currency settings in setting section.
     */
    function wp_render_currency_setting()
    {
        $wp_currency_settings_field = get_option("wp_currency_settings_field"); ?>
        <select name = "wp_currency_settings_field"
                id = "wp_currency_settings_field"
                value = <?php echo isset($wp_currency_settings_field)?
                    esc_attr($wp_currency_settings_field): '';?>
                style = "width: 30%; margin-left: 30px;">
        <option value = 'none' selected disabled hidden>Select an option
        </option>
        <option value = 'euro'>Euro</option>
        <option value = 'rupee'>Rupee</option>
        <option value = 'yen'>Yen</option>
        <option value = 'pound'>Pound</option>
        <option value = 'dollar'>Dollar</option>
        </select>
        <br /><br />
        <?php

    }

    /**
     * This function renders books per page settings in setting section.
     */
    function wp_render_books_per_page_setting()
    {
        $wp_books_per_page_field = get_option("wp_books_per_page_field"); ?>
        <input type="number" name="wp_books_per_page_field"  min="1"
               value= "<?php echo isset($wp_books_per_page_field)?
                   esc_attr($wp_books_per_page_field): '';?>"
               style = "width: 30%; margin-left: 30px;"/>
        <?php
    }
}
