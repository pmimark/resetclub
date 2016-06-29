<?php
include('../../../../wp-config.php');
global $wpdb;

$post_id=$_POST['post_id'];
$user_id=$_POST['user_id'];
$today=date('Y-m-d'); 

$wpdb->insert( 'rest_user_challenge', array(
'user_id' => $user_id,
'post_id' => $post_id,
'cr_date' => $today)
);

echo "1";

?>