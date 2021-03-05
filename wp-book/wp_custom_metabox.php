<?php

/**
 *  We are creating custom meta_box for
 * our custom post type here.
 */

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
        'wp_book_meta_box_html',
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
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row"><label for="author_name">Author Name</label></th>
            <td><input name="author_name" type="text" id="author_name"
                       value="" class="regular-text"
                       placeholder="Author name" required></td>
            <td>
        </tr>
        <tr>
            <th scope="row"><label for="price">Price</label></th>
            <td><input name="price" type="number" id="price"
                       value="" class="regular-text"
                       placeholder="E.g. 204.10" step="any" required></td>
        </tr>
        <tr>
            <th scope="row"><label for="publisher">Publisher</label></th>
            <td><input name="publisher" type="text" id="publisher"
                       value="" class="regular-text"
                       placeholder="Publisher name" required></td>
        </tr>
        <tr>
            <th scope="row"><label for="year">Year</label></th>
            <td><input name="year" type="month" id="year"
                       value="" class="regular-text year"
                       placeholder="E.g. 2014" required></td>
        </tr>
        <tr>
            <th scope="row"><label for="edition">Edition</label></th>
            <td><input name="edition" type="text" id="edition"
                       value="" class="regular-text"
                       placeholder="Edition" required></td>
        </tr>
        <tr>
            <th scope="row"><label for="url">URL</label></th>
            <td><input name="url" type="url" id="url"
                       value="" class="regular-text"
                       placeholder="E.g. https://abc.com" required></td>
        </tr>
        </tbody>
    </table>
    <?php
}
add_action('add_meta_boxes', 'create_wp_book_meta_box');


/**
 * This hook adds wp_jquery.js file so that
 * we can validate our html meta_box.
 */
add_action('admin_enqueue_scripts', 'wp_book_enqueue_scripts');

/**
 * This function allows to include scripting file
 * we have used script to validate html form
 *
 * @param object $hook optional
 * Parameter indicates which hook we are going to import script
 * default entire admin panel
 */
function wp_book_enqueue_scripts( $hook)
{
    wp_enqueue_script(
        'wp_book_jquery',
        plugins_url('/js/wp_jquery.js', __FILE__), array('jquery')
    );
}
