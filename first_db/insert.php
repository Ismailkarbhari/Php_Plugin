<?php
// echo "hi";

$parameters = $request->get_json_params();


$type=$parameters['type'];
$url=$parameters['url'];
$book=$parameters['book'];

// print_r($parameters);
// echo $rating;
global $wpdb;
$table_name = $wpdb->prefix . "mediatype";
$sql = $wpdb->insert( $table_name, 
            array(
            'm_type' => $type,
            'media_url' => $url,
            'book_type' => $book,
            ));
$wpdb->query($sql);
 
$return = array(
    'message'  => "Inserted"
);
return wp_send_json_success($return);