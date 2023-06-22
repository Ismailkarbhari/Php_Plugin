<?php 

if ( ! defined( 'ABSPATH' ) ) {

    die;

}

	 global $wpdb;
     $table_name = $wpdb->prefix . "mediatype";
     $sql = "DROP TABLE IF EXISTS $table_name";
     $wpdb->query($sql);

     $response = array(
        'data' =>'Delete' );