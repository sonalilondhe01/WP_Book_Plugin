<?php


/**
 *  We are creating custom post called 'book'.
 */

/**
 * This function create a custom post type called 'Book'
 */
class create_custom_post_type {

    function __construct() {

        add_action('init', array($this, 'render_custom_post_wp_book'));
    }
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

}
new create_custom_post_type();
