<?php 

if ( ! defined( 'ABSPATH' ) ) {

    die;

}

        global $wpdb;
	    	$table_name = $wpdb->prefix . "mediatype";
      
      $charset_collate = $wpdb->get_charset_collate();

      $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int NOT NULL AUTO_INCREMENT,
        m_type varchar(255) NOT NULL,
        media_url varchar(255) NOT NULL, 
        book_type varchar(255) NOT NULL,  
        PRIMARY KEY  (id)
      ) $charset_collate;";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);