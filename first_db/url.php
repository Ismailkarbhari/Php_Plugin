<?php 
$parameters = $request->get_json_params();
$id=$parameters['id'];
// echo $path;
global $wpdb;
$table_name = $wpdb->prefix . "mediatype"; 
$results = $wpdb->get_results ( "SELECT `media_url`,`book_type` FROM $table_name where m_type='$id'");
foreach($results as $sq)
{

    $url = $sq->media_url;
    $btype = $sq->book_type;
    // echo($url);
}

$response = array(
     array(
    'url' => $url,
    'book'=> $btype
    ),
);

return wp_send_json_success($response);
