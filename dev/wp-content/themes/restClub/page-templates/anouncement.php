<?php
/**
 * Template Name: Anouncement Page
 *
*/
get_header(); 
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="anouncement">
   <div class="container">
     
      <div class="row welcome-section">
        <div class="col-xs-12 col-md-6 rest-section">
          <?php the_content(); ?>
          
        </div> <!--col-xs-12 col-md-6-->
        <div class="col-xs-12 col-md-6 rest-video-section">
            <div class="embed-responsive embed-responsive-16by9">
                <?php the_field('video_section'); ?>
            </div>
            
            
        </div> <!--col-xs-12 col-md-6 rest-video-section-->
        
        <div class="col-xs-12 text-center ins">
          <h4>They will super charge you. Wash away fat. Melt inches off your waist. And reverse years of damage in your body.
               <span style="text-transform:uppercase;">YOU WILL GROW YOUNGER AS YOU AGE...</span></h4>
        </div>
        
      </div> <!--welcome-section-->
     
   </div>
   
   <div class="reminders">
     <div class="container">
       <div class="row">
          <div class="col-xs-12 col-md-6">
            <?php 
			global $post;
			query_posts('post_type=announcement&showpost=1'); ?>
            <?php while (have_posts()) : the_post(); ?>
			<h3><?php the_title(); ?></h3>
            <ul class="dated-post">
               <li class="calendar-block"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date('m F Y',$post->ID); ?></li>
               <li class="author-block">By: <?php the_author(); ?></li>
            </ul> 
            
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            <?php endwhile; wp_reset_query(); ?>
          </div> <!--col-xs-12 col-md-6-->
          
           <div class="col-xs-12 col-md-6">
            <h3>Reminders:</h3>
            
           <div class="row reminder-section">         
              <div class="col-xs-12 col-sm-6"> 
                <p>Enter Phone number for text alerts</p> 
              </div>
              <div class="col-xs-12 col-sm-6"> 
                <input type="text" class="form-control" placeholder="Enter Phone No"> 
              </div> <!--col-sm-6-->
              
              <div class="col-xs-12 col-sm-6"> 
                <p>Invite Friends:</p> 
              </div>
              <div class="col-xs-12 col-sm-6"> 
                <input type="text" class="form-control" placeholder="Enter Email"> 
              </div> <!--col-sm-6-->
              
              <div class="col-sm-6 col-sm-offset-6"> 
                <input type="text" class="form-control" placeholder="Enter Email"> 
              </div> <!--col-sm-6-->
              <div class="col-sm-6 col-sm-offset-6"> 
                <input type="text" class="form-control" placeholder="Enter Email"> 
              </div> <!--col-sm-6-->
              <div class="col-sm-6 col-sm-offset-6"> 
                <input type="text" class="form-control" placeholder="Enter Email"> 
              </div> <!--col-sm-6-->
              <div class="col-sm-6 col-sm-offset-6"> 
                <input type="button" class="btn btn-default btn-continue" value="continue"> 
              </div> <!--col-sm-6-->        

           </div> <!--row--> 
          </div> <!--col-xs-12 col-md-6-->
          
       </div> <!--row-->       
     </div>  
   </div> <!--reminders close-->
   
   <div class="container bottom-text">
		<?php
		 global $wpdb;
		 $today=date('Y-m-d');
		 $user_id = get_current_user_id();
		 foreach( $wpdb->get_results("select a.*,b.* from rest_posts as a
		 inner join rest_postmeta as b
		 on a.ID=b.post_id
		 where a.post_type='challenge' and a.post_status='publish' and b.meta_key='status' and b.meta_value='1'") as $key => $row1)
		 {
		  $post_id = $row1->ID; 
		  $post_title = get_the_title($post_id);
		   $start_date =get_post_meta($post_id,"start_date",true);
		   $end_date =get_post_meta($post_id,"end_date",true);
		 }
		 
		 
		 foreach( $wpdb->get_results("select count(id) 'total' from rest_user_challenge where post_id='".$post_id."' and user_id='".$user_id."'") as $key => $row1111)
		 { 
		   $countt = $row1111->total; 
		 }	

		 
		 $rowCount = $wpdb->num_rows;	
		 if($rowCount > 0)
		 { 
			$date1=strtotime($start_date);
			$date2=strtotime($today);
			$diff=$date2-$date1;
			$days = floor($diff / (60*60*24) );
		 ?>
		  <h3>The Group is on Day <span><?php echo $days; ?></span> of the <span>10</span> <?php echo $post_title; ?> <br>
		  <?php
		  if($countt > 0) 
		  {	  
				foreach( $wpdb->get_results("SELECT user_id, COUNT( cr_date )  'total_days'
				FROM rest_user_challenge
				WHERE post_id =  '$post_id'
				AND user_id =  '$user_id'
				GROUP BY user_id
				ORDER BY total_days DESC") as $key => $row111111)
				{
					$countttt = $row111111->total_days; 	
				}	
		  ?>
		  You are on Day <?php echo $countttt; ?><span> GREAT JOB!</span></h3> 
		 <?php	
		  }		
		 }
		?>	 
   
   
     

      <input type="button" class="btn btn-default btn-continue width" value="continue">
   </div>  
</div>
<?php endwhile; wp_reset_query(); ?>
<?php 
get_footer(); ?> 
