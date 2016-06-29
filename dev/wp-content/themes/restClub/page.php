<?php get_header(); ?>
<div class="profile-page"> 
  <div class="container">
     <div class="row">
       <div class="col-md-10 col-md-offset-1">
        <?php while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
		<?php endwhile; wp_reset_query(); ?>
		   	
       </div> <!--col-md-10-->
     </div> <!--row--> 
</div> <!--sign-in-page-->
<?php get_footer(); ?>
