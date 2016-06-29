<?php
include('../../../../wp-config.php');
$email=$_POST['email'];
$password=$_POST['password'];

if( email_exists( $email )) 
{
	$user = get_user_by( 'email', $email ); 
    $user_id=$user->ID;
	$verify=get_user_meta($user_id,"verify",true);
	
	if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID) ) 
	{
	$login_data = array();
	$login_data['user_login'] = $user->user_login;
	$login_data['user_password'] = $password;
	$login_data['remember'] = $remember; 
	wp_signon( $login_data, false );
	
	echo "3"; 

	}
	else 
	{

	echo "2";

	}
}
else
{ 
	echo "1";
}
?>