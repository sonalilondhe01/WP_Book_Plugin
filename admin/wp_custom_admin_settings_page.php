<?php

class create_custom_admin_settings_page {
    function __construct() {
        add_action('admin_menu', array($this, 'add_custom_book_sub_menu_page'));
        add_action('admin_init', array($this, 'custom_sub_menu_page_init'));
    }
    function add_custom_book_sub_menu_page() {
        add_submenu_page('edit.php?post_type=book',
            __('Books Settings Page', 'wp_book'),
            __('Book Settings', 'wp_book'),
            'manage_options',
            'book-settings',
            array($this, 'render_custom_book_settings_page')
        );
    }
    function custom_sub_menu_page_init() {

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
            'wp_custom_settings_section' );

    }

    function wp_render_currency_setting() {
        $wp_currency_settings_field = get_option("wp_currency_settings_field"); ?>
        <select name = "wp_currency_settings_field" id = "wp_currency_settings_field"
                value = <?php echo isset($wp_currency_settings_field)?
                    esc_attr($wp_currency_settings_field): '';?>
                style = "width: 30%; margin-left: 30px;">
        <option value = 'none' selected disabled hidden>Select an option</option>
        <option value = 'euro'>Euro</option>
        <option value = 'rupee'>Rupee</option>
        <option value = 'yen'>Yen</option>
        <option value = 'pound'>Pound</option>
        <option value = 'dollar'>Dollar</option>
        </select>
        <br /><br />
        <?php

    }

    function wp_render_books_per_page_setting() {
        $wp_books_per_page_field = get_option("wp_books_per_page_field"); ?>
        <input type="number" name="wp_books_per_page_field"  min="1"
               value= "<?php echo isset($wp_books_per_page_field)?
                   esc_attr($wp_books_per_page_field): '';?>"
               style = "width: 30%; margin-left: 30px;"/>
        <?php
    }

    function render_custom_book_settings_page() { ?>
        <div class = "wrap">
            <h1><?php echo esc_html(get_admin_page_title());?></h1>
            <form id = "custom_book_settings_page_form" method = "post" action = "options.php">
                <?php
                settings_fields('book-settings');
                do_settings_sections('book-settings');
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }
}
new create_custom_admin_settings_page();



