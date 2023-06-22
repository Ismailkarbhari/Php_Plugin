<?php

$parameters = $request->get_json_params();

//  print_r($parameters);
$id=$parameters['id'];
$type=$parameters['type'];
$url=$parameters['url'];
$book=$parameters['book'];
global $wpdb;
$table_name = $wpdb->prefix . "mediatype";
$sql = $wpdb->update($table_name, array(
    'm_type'=>$type,'media_url'=>$url,'book_type'=>$book),
      array('id'=>$id));
$wpdb->query($sql);
 
$return = array(
    'message'  => 'Updated'
);
return wp_send_json_success($return);