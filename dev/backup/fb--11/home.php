<?php
include('../wp-config.php');

$username=$user_profile['email'];
$name=$user_profile['name'];
$first_name=$user_profile['first_name'];
$last_name=$user_profile['last_name'];
$fb_id=$user_profile['id'];
$profile_url='<img height="100" src="https://graph.facebook.com/'.$fb_id.'/picture?type=large">';

if (username_exists($username)) 
{
	$user = get_user_by( 'email', $username );
	$user_id=$user->ID;
	tml_new_user_registered( $user_id );
	?>
	<script>window.location.href="<?php echo site_url(); ?>"</script>
	<?php
}
else
{
	$password="admin123#";
	
	$user_id=wp_create_user( $username, $password, $username );
	
	update_user_meta($user_id,"first_name",true);   
	update_user_meta($user_id,"last_name",true);
	update_user_meta($user_id,"fb_id",true);
	update_user_meta($user_id,"profile_url",true); 
	
    $from = get_option('admin_email');
    $headers = 'From: '.$from . "\r\n";
    $subject = "Wonder Box Registration";
    $msg = "Your Registration successful.\nYour login details\nUsername: $username\nPassword: $password";
    wp_mail( $email, $subject, $msg, $headers );
	
	
    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    wp_signon( $login_data, false ); 
	?>
	<script>window.location.href="<?php echo site_url(); ?>"</script>
	<?php
} 

/*
echo 'id : ' . $_SESSION['id'];
echo '<br/>Name : ' . $_SESSION['username'];
echo '<br/>Email : ' . $_SESSION['email'];
echo '<br/>You are login with : ' . $_SESSION['oauth_provider'];
echo '<br/><img height="100" src="https://graph.facebook.com/'.$_SESSION['oauth_id'].'/picture?type=large">';
echo '<br/>Logout from <a href="logout.php?logout">' . $_SESSION['oauth_provider'] . '</a>';
*/

?>