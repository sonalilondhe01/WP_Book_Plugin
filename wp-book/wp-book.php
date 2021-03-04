c<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package Wp_Book
 * @link    https://github.com/sonalirlondhe
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       WP Book
 * Plugin URI:        https://learn.wpeka.com/topic/plugin-development-assignment/
 * Description:       This is a wordpress plugin development assignment.
 * Version:           1.0.0
 * Author:            Sonali Londhe
 * Author URI:        https://github.com/sonalirlondhe
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-book
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC') ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WP_BOOK_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-book-activator.php
 */
function activate_wp_book()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-wp-book-activator.php';
    Wp_Book_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-book-deactivator.php
 */
function deactivate_wp_book()
{
    include_once plugin_dir_path(__FILE__) .
        'includes/class-wp-book-deactivator.php';
    Wp_Book_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wp_book');
register_deactivation_hook(__FILE__, 'deactivate_wp_book');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wp-book.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_wp_book()
{

    $plugin = new Wp_Book();
    $plugin->run();

}
run_wp_book();

/**
 * This function create a custom post type called 'Book'
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
add_action('init', 'render_custom_post_wp_book');

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

add_action('init', 'create_wp_book_taxonomies');

