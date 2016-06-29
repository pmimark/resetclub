<?php
include('../../../../wp-config.php');
$user_id=$_POST['user_id'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$display_name=$_POST['display_name'];
$phone=$_POST['phone'];
$gender=$_POST['gender'];
$address_1=$_POST['address_1'];
$address_2=$_POST['address_2'];
$country=$_POST['country'];
$state=$_POST['state'];
$city=$_POST['city']; 
$service=array_filter($_POST['service']); 
$service_1=serialize($service);


$name=$fname. " ".$lname;
update_user_meta($user_id,"first_name",$name);
update_user_meta($user_id,"display_name",$display_name);
update_user_meta($user_id,"phone",$phone);
update_user_meta($user_id,"gender",$gender);
update_user_meta($user_id,"address_1",$address_1);
update_user_meta($user_id,"address_2",$address_2);
update_user_meta($user_id,"country",$country);
update_user_meta($user_id,"state",$state);
update_user_meta($user_id,"city",$city); 
update_user_meta($user_id,"service",$service_1);  

echo "1";
?>
