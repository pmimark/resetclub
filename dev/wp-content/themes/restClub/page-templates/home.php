<?php
/**
 * Template Name: Home Page
 *
*/

get_header(); 
?>
<div class="welcome-page">
  <div class="chat-blog">
    <div class="col-md-6">
      <?php 
	  $i=1;
	  query_posts('post_type=testimonial&showposts=12'); ?>
      <?php while (have_posts()) : the_post(); ?>
	  <div class="chat-box-wrap">
        <div class="pp"> 
			<?php the_post_thumbnail('testimonial'); ?>
		</div>
        <div class="content-box">
          <?php the_excerpt(); ?>
          <!-- 
		  <ul>
            <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</a></li>
            <li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i>Comments</a></li>
          </ul>
		  -->
        </div>
        
      </div>
      <?php
	  if($i%6==0)
	  {
	  ?>
	  </div>
	  <div class="col-md-6">
	  <?php
	  }
	  $i++;
	  endwhile; wp_reset_query(); ?>
    </div>
    
  </div>
  <!--chat-blog Close-->
  
  <div class="start-container"> <a class="logo" href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="..." /></a>
    <?php while ( have_posts() ) : the_post(); ?>
	<div class="intent-container">
      <p>Reset Your Body Support Group<br>
		<?php
		foreach( $wpdb->get_results("SELECT count(ID) 'total' FROM rest_users where ID!=1") as $key => $row)
		{
			$count = $row->total;
		}
		?>
        <span class="yellow-color"><?php echo $count; ?></span> Members</p>
      <br>
      <p>Never fall off the Monthly Reset Challenges again! Ask questions. Get answers. Be held accountable.
        Learn more tips. Track your progress. Be part of a community. Don't do it alone</p>
      <a class="btn btn-default btn-home-join" href="<?php echo site_url(); ?>/login/">JOIN THE GROUP FOR FREE</a> <br>
      <p> Already have an account? Click here to <a href="<?php echo site_url(); ?>/login/">login</a></p>
    </div>
    <div class="welcome-page-footer">
      <div class="quicklinks">
        <ul>
         <?php
		  $defaults = array( 'menu' => 'main_menu', 'container' => '', 'container_class' => '', 'container_id' => '', 'menu_class' => '', 'menu_id' => '','echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '%3$s',
			'depth' => 0, 'walker' => '', 'theme_location' => '' );
			wp_nav_menu($defaults);
		 ?>
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
  <!--start-container--> 
</div> 

<?php 
endwhile; wp_reset_query();
get_footer(); ?> 
