<?php
include('../../../../wp-config.php');
global $wpdb;
$user_id=$_POST['user_id'];
foreach( $wpdb->get_results("SELECT * FROM rest_profile_img where user_id='".$user_id."'") as $key => $row11)
{
	$name = $row11->name;   
}
unlink(ABSPATH.'wp-content/themes/restClub/user_profile/'.$name);
$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name = '$name'" );
echo "1";  
?>