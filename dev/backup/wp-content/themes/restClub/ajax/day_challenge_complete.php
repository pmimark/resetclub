<?php

include('../../../../wp-config.php');
global $wpdb;
$today=date('Y-m-d');

$post_id=$_POST['post_id'];
$user_id=$_POST['user_id'];
$sel_date=$_POST['sel_date'];


if($sel_date!=$today)  
{
	echo "0";
	die;  
}	
 
$wpdb->insert( 'rest_user_challenge', array(
'user_id' => $user_id,
'post_id' => $post_id,
'cr_date' => $sel_date) 
);
  
echo "1";


?>