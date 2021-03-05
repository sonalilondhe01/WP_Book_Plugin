<?php

/**
 *  We are creating custom taxonomies for
 * our custom post type here.
 */

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
?>
