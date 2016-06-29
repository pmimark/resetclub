<?php
/**
 * Template Name: Sign-up Page
 *
*/


include_once(ABSPATH."fb/config.php");
include_once(ABSPATH."fb/includes/functions.php"); 
$fbuser = null;
$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));

get_header(); 
?>
<script>
jQuery(document).ready(function()
{
	jQuery('.btn-create').click(function()
	{
		
		jQuery('html, body').animate({
			scrollTop: jQuery(".account-information").offset().top
		}, 2000);  
	});	
});
</script>
<div class="sign-in-page">
  <div class="container">
     <div class="member-log-in-section"> 
	 <?php 
	 if ( !is_user_logged_in() ) {
	 ?>	 
		<form name="signup" id="signup" action="" method="post">
       <h2>Create your <strong>14 Day</strong> Trial Membership</h2>
      <div class="login-with-social">  
       <a href="<?php echo $loginUrl; ?>" class="btn btn-default btn-fb">LOGin with facebook</a> 
	   <span class="seperater">OR</span>   
       <a class="btn btn-default btn-create" href="javascript:void(0);">create free account</a>    
       
       <h3>Already have an account? Click here to <a href="">login</a>. <br>
<a href="">Forgot your username or password?</a></h3>


        </div> <!--login-with-social-->
        
       <div class="account-information"> 
          <h3>Your Account Information</h3> 
          <div class="basic-information"> 
            <input type="text" class="form-control" placeholder="Name" name="user_name">
            <input type="text" class="form-control" placeholder="Email Address" name="user_email">
            <input type="password" class="form-control" placeholder="Password" name="password"> 
           
           <div class="promo-code-section"> 
             <p>Do you have a discount code ?</p> <input type="text" class="form-control" placeholder="Enter your discount code" name="discount_code"> 
           </div> 
           
           <ul>
              <li>14 Day Free Trial</li>
              <li>No credit card required - Membership expires after 14 Days.</li>
              <li>Once your two weeks are up (or even before), you can sign up for a full membership.</li>
           </ul>
           
          </div> <!--basic-information-->

       </div>  <!--account-information-->
       
           <br>
           <br>
           <br>
		   <div class="result"></div>
        <input type="submit" value="create free account" class="btn btn-default btn-home-join"> 
		<img src="<?php bloginfo('template_url'); ?>/images/loader-11.gif" id="loader" style="display:none;"/> 
     </form> 
	 <?php } else { ?>
	 <div class="account-information">
		<?php global $current_user;
		  get_currentuserinfo();
			
		 ?>
		<h3>You are login with</h3> 
		<h4><?php echo $current_user->user_login; ?></h4>
		<a href="<?php echo wp_logout_url( home_url() ); ?>" class="btn btn-default btn-home-join">Logout</a>
	 </div> 
	 <?php } ?>
	 </div> 
  </div>
</div> <!--sign-in-page-->

<?php 
get_footer(); ?> 
