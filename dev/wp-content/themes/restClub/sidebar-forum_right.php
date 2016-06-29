 <div class="group-progress">
   <?php
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
	 $rowCount = $wpdb->num_rows;	
   ?>
   <?php
   if($rowCount > 0)
   {	   
   ?>
   <h2><?php echo $post_title; ?> Progress<br>Board</h2>
   <select class="form-control" id="sortby_forum_1" onchange="sortby_forum_1();" >
	   <option value="">Sort By</option>
	   <option value="name">Name</option>
	   <option value="day">Days</option> 
	</select>   
	
   <div class="user_days">
	   <div class="category-list">
		  <ul>
			<?php
			foreach( $wpdb->get_results("SELECT user_id, COUNT( cr_date )  'total_days'
			FROM rest_user_challenge
			WHERE post_id =  '$post_id'
			GROUP BY user_id
			ORDER BY total_days DESC ") as $key => $row)
			{
			$user_id = $row->user_id;
			$count = $row->total_days;
			$name=get_user_meta($user_id,"first_name",true);
			?>
			<li><?php echo $name; ?><span><?php echo $count; ?> Days</span></li>
			<?php
			}
			?>
		  </ul>
	   </div> <!--category-list-->
   </div> <!--category-list-->
   
   
   <div class="new-badge-maker">
	 <h3>NEWEST BADGES</h3>
	 
	 <select class="form-control">
	   <option>Sort By</option>
	   <option>Name</option>
	   <option>Size</option>
	</select>  
   </div>   <!--new-badge-maker-->
   
   <div class="new-badges-list">
	  <ul>
		<li>Merry Parker<img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="...." /></li>
		<li>Chris Dawson<img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="...." /></li>
		<li>Bob Marley<img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="...." /></li>
		<li>Merry Parker<img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="...." /></li>
		<li>Chris Dawson<img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="...." /></li>
		<li>Bob Marley<img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="...." /></li>
		<li>Merry Parker<img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="...." /></li>
		<li>Chris Dawson<img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="...." /></li>
		<li>Bob Marley<img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="...." /></li>
	  </ul>
   </div> 
   
   <div class="invitation-form">
	 <h3>Invite Friends</h3>
	 
	 <input type="text" class="form-control" placeholder="Enter Email">
	 
	 <input type="text" class="form-control" placeholder="Enter Email">
	 <input type="text" class="form-control" placeholder="Enter Email">
	 
	 <input type="button" class="btn btn-default btn-profil" value="Send Invite">
	 
   </div> <!--invitation-form Close-->
   <?php
   }
   ?>
 </div> 