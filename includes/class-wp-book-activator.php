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
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta(
            "CREATE TABLE `wp_bookmeta` (`meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, 
 `book_id` bigint(20) unsigned NOT NULL DEFAULT '0',  
`meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `meta_value` longtext COLLATE utf8mb4_unicode_ci, PRIMARY KEY (`meta_id`),
 KEY `book_id` (`book_id`),  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
        );
    }

}

