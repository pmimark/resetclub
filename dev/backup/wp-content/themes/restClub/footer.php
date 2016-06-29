<?php
if(!is_front_page())
{	
?>
	<div class="site-footer">    
		   
		 <div class="quicklinks"> 
		   <ul>
			   <?php
				  $defaults = array( 'menu' => 'main_menu', 'container' => '', 'container_class' => '', 'container_id' => '', 'menu_class' => '', 'menu_id' => '','echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '%3$s',
					'depth' => 0, 'walker' => '', 'theme_location' => '' );
					wp_nav_menu($defaults);
			   ?>
			  <?php
			  if ( is_user_logged_in() ) {
			  ?>
			  <li><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
			  <?php } ?>		
		   </ul>
		 </div> 
		 
		<div class="copy-right">
			 <p>Copyright &copy; <?php echo date('Y'); ?> The Reset Club.  All rights reserved</p>
			 
		   <ul class="social-icons">
			  <li class="facebook"><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
			  <li class="twitter"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> 
			  <li class="google-plus"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li> 
		   </ul>  
		</div>       
		</div>
	  
	</div>
<?php
}
?>
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/my-script.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/form.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
</body>
</html>
