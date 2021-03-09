<?php

/**
 * Fired during plugin activation
 *
 * @link  https://github.com/sonalirlondhe
 * @since 1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Sonali Londhe <sonalilondhe.01@gmail.com>
 */
class Wp_Book_Activator
{

    /**
     * Create custom table. (use period)
     *
     * /**
     *This function creates a custom table 'wp_custom_metabox_info'
     * to store data publish by our custom metabox
     *
     *
     * @since 1.0.0
     */
    public static function activate()
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

}

