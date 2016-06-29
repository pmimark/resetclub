<?php
include('../../../../wp-config.php');
global $wpdb;

$user_name=sanitize_text_field($_POST['user_name']);
$email=sanitize_text_field($_POST['user_email']);
$password=sanitize_text_field($_POST['password']);  
$discount_code=$_POST['discount_code'];  

$username = strstr($email, '@', true);

	if (username_exists($username)) {  

	  echo "1";

	}
	else if( email_exists( $email )) {

	  echo "2"; 

	}
	else
	{
	if($discount_code!="") 
	{	
		foreach( $wpdb->get_results("SELECT count(id) 'total' FROM rest_discount where discount_code='".$discount_code."'") as $key => $row)
		{
			$count = $row->total;
		}
		if($count==0)
		{
			echo "4";
			die; 
		}	
	
	}

	
	/*
	$from = get_option('admin_email');
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: '.$from . "\r\n";
    $subject = "IATDG - Verify your Email";
	$url='<a href="'.home_url().'/verify-email/?u='.$en_email.'">Here</a>';
    $msg = "
	<p>Hello".$first_name." ".$last_name."</p>
	<p>You have successfully registered.</p>
	<p>Please click ".$url." to verify the email</p>";  
    wp_mail( $email, $subject, $msg, $headers );
	*/
	
	$today=date("Y-m-d H:i:s");
	
    $user_id=wp_create_user( $username, $password, $email );
	
	update_user_meta( $user_id, "first_name", $user_name); 
	update_user_meta( $user_id, "cr_date", $today); 
	if($discount_code!="") 
	{
		update_user_meta( $user_id, "activate",1);      
	}
	else
	{
		update_user_meta( $user_id, "activate",0);      
	}	
	
	
	$login_data = array();
	$login_data['user_login'] = $username;
	$login_data['user_password'] = $password;
	$login_data['remember'] = $remember;
	wp_signon( $login_data, false );
	 
	echo "3";	   
		
	}	
	
?>