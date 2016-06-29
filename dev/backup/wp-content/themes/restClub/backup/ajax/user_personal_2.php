<?php
include('../../../../wp-config.php');
$user_id=$_POST['user_id'];
$comment=$_POST['comment'];
$day=$_POST['day'];
$month=$_POST['month'];
$year=$_POST['year'];
$start_total_inch=$_POST['start_total_inch'];
$start_weight=$_POST['start_weight'];
$start_pant_size=$_POST['start_pant_size'];
$start_dress_size=$_POST['start_dress_size'];
$goal_total_inch=$_POST['goal_total_inch'];
$goal_weight=$_POST['goal_weight'];
$goal_pant_size=$_POST['goal_pant_size'];
$goal_dress_size=$_POST['goal_dress_size'];



$dob=$year."-".$month."-".$day;
update_user_meta($user_id,"comment",$comment);
update_user_meta($user_id,"dob",$dob);
update_user_meta($user_id,"start_total_inch",$start_total_inch);
update_user_meta($user_id,"start_weight",$start_weight);
update_user_meta($user_id,"start_pant_size",$start_pant_size);
update_user_meta($user_id,"start_dress_size",$start_dress_size);
update_user_meta($user_id,"goal_total_inch",$goal_total_inch);
update_user_meta($user_id,"goal_weight",$goal_weight);
update_user_meta($user_id,"goal_pant_size",$goal_pant_size);
update_user_meta($user_id,"goal_dress_size",$goal_dress_size); 


echo "1";
?>
