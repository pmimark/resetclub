<?php
/**
 * Template Name: Login Page
 *
*/


include_once(ABSPATH."fb/config.php");
include_once(ABSPATH."fb/includes/functions.php"); 


$fbuser = null;
$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));


get_header(); 
?>


<div class="sign-in-page">
  <div class="container">
     <div class="sign-in-section"> 
        <h2>Login</h2>
       <?php 
	   if ( !is_user_logged_in() ) {
	   ?>	
       <a href="<?php echo $loginUrl; ?>" class="btn btn-default btn-fb">LOGin with facebook</a>
       <br>
        <br>
       <h4>OR</h4>
       <br>
	   <div class="result"></div>
       <form name="login" id="login" action="" method="post">
          <input type="text" class="form-control" placeholder="Email" id="email" name="email">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password">
         
         <label class="remb-check"><input type="checkbox">Remeber me</label> 
         
         <input type="submit" class="btn btn-default btn-submit" value="login">
		 <img src="<?php bloginfo('template_url'); ?>/images/loader-11.gif" id="loader" style="display:none;" />
          
          <p><a href="">Forgot your password?</a><br>Dont have an account? <a href="<?php echo site_url(); ?>/sign-up">Sign up Free!</a></p>
       </form> 
	   <?php } else { ?>
	   <?php global $current_user;
		  get_currentuserinfo();
			
		 ?>
		<h3>You are login with</h3> 
		<h4><?php echo $current_user->user_login; ?></h4>
		<a href="<?php echo wp_logout_url( home_url() ); ?>" class="btn btn-default btn-home-join">Logout</a>
	   <?php } ?> 
     </div> <!--sign-in-section-->
  </div>
</div> <!--sign-in-page-->

<?php 
get_footer(); ?> 
