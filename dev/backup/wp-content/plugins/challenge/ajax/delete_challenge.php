<?php
include('../../../../wp-config.php');
global $wpdb;

$id=$_POST['id'];

$wpdb->query( "DELETE FROM rest_challenge WHERE id = '$id'" );
echo "1"; 
?>