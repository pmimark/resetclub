<?php
include_once("../wp-config.php");  
include_once("config.php");
include_once("includes/functions.php");
//destroy facebook session if user clicks reset
if(!$fbuser)
{
	$fbuser = null;
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
	$output = '<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>'; 	
}
else
{
	$user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
	$user = new Users();
	$user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender'],$user_profile['locale'],$user_profile['picture']['data']['url']);
	if(!empty($user_data))
	{
		/*
		echo "<pre>";
			print_r($user_data);
		echo "</pre>";
		$output = '<h1>Facebook Profile Details </h1>';
		$output .= '<img src="'.$user_data['picture'].'">';
        $output .= '<br/>Facebook ID : ' . $user_data['oauth_uid'];
        $output .= '<br/>Name : ' . $user_data['fname'].' '.$user_data['lname'];
        $output .= '<br/>Email : ' . $user_data['email'];
        $output .= '<br/>Gender : ' . $user_data['gender'];
        $output .= '<br/>Locale : ' . $user_data['locale'];
        $output .= '<br/>You are login with : Facebook';
        $output .= '<br/>Logout from <a href="logout.php?logout">Facebook</a>'; 
		*/
	 
	$user_name=sanitize_text_field($user_data['fname'].' '.$user_data['lname']);
	$email=sanitize_text_field($user_data['email']);
	$password='password'; 
	$username = strstr($email, '@', true);
	if( email_exists( $email )) 
	{

	 $login_data = array();
	 $login_data['user_login'] = $username;
	 $login_data['user_password'] = $password;
	 $login_data['remember'] = $remember;
	 wp_signon( $login_data, false );

	}
	else
	{
		$today=date("Y-m-d H:i:s");
		$user_id=wp_create_user( $username, $password, $email );
		update_user_meta( $user_id, "first_name", $user_name); 
		update_user_meta( $user_id, "cr_date", $today); 
		update_user_meta( $user_id, "activate",0);      
	
	}	  
	
	}
?>
<script>window.location.href="<?php echo  site_url(); ?>/forum/";</script>
<?php	 
}
?>
