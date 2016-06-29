<?php
/**
 * Template Name: Forum Page
 *
*/

get_header(); 
if ( is_user_logged_in() ) {
$user_id = get_current_user_id();	
$user_name=get_user_meta($user_id,"first_name",true);
//Facebook Image
foreach( $wpdb->get_results("SELECT count(id) 'total' FROM users where email='".$user_email."'") as $key => $row)
{
	$count = $row->total;  
}

foreach( $wpdb->get_results("SELECT count(id) 'total' FROM rest_profile_img where user_id='".$user_id."'") as $key => $row1)
{
	$count_1 = $row1->total;   
}
	
?>
<script>
jQuery(document).ready(function()
{
	
	jQuery('[name=yes_im]').click(function()
	{
		if(jQuery(this).is(':checked'))
		{
			var status=1;
			var loader='<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" />'
			var post_id=jQuery('#post_id').val();	
			var user_id=jQuery('#user_id').val();	
			jQuery('.challenge_result').empty().append(loader);
			jQuery.ajax({  
				type: "POST",
				url:"<?php bloginfo('template_url'); ?>/ajax/user_accept_challenge.php",
				data:{post_id:post_id,user_id:user_id,status:status,format:'raw'},
				success:function(resp){ 
					if( resp !="")
					{
						jQuery('.challenge_result').empty().append(resp); 
					}
					
				}
		    });
		}
		else
		{
			
			var status=0; 
			var loader='<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" />'
			var post_id=jQuery('#post_id').val();	
			var user_id=jQuery('#user_id').val();	
			jQuery('.challenge_result').empty().append(loader);
			jQuery.ajax({  
				type: "POST",
				url:"<?php bloginfo('template_url'); ?>/ajax/user_accept_challenge.php",
				data:{post_id:post_id,user_id:user_id,status:status,format:'raw'},
				success:function(resp){ 
					if( resp !="")
					{
						jQuery('.challenge_result').empty().append(resp); 
					}
					
				}
		    });
			
			
			
		}	
			
		
	});
	
	
	
});

function like_dislike(status,post_id,user_id)
{
	jQuery.ajax({  
			type: "POST",
			url:"<?php bloginfo('template_url'); ?>/ajax/like_dislike.php",
			data:{status:status,post_id:post_id,user_id:user_id,format:'raw'}, 
			success:function(resp){  
				if( resp !="")
				{
					data = JSON.parse(resp);
					//alert(data.like_link);
					//alert(data.like_msg);
					jQuery('.like_'+post_id).empty().append(data.like_link);
					jQuery('.comments_counter_'+post_id).empty().append(data.like_msg);
					
					
				}
				
			}
	});
}


</script>
<input type="hidden" id="curr_user_id" value="<?php echo $user_id; ?>" /> 
<div class="form-pagecontent">	
   <div class="container">
     <div class="row">
       <div class="col-xs-12 col-md-3">
         <div class="progreess-section">
				<div class="user_prof_image">
					<?php
					if($count_1!=0)
					{	
						foreach( $wpdb->get_results("SELECT * FROM rest_profile_img where user_id='".$user_id."'") as $key => $row11)
							{
								$name = $row11->name;   
							}
						?>
						<img src="<?php bloginfo('template_url'); ?>/user_profile/thumb.php?src=<?php echo $name; ?>&w=74&h=74">	  
						<?php
					}  
					else
					{	
						if($count!=0)
						{
							foreach( $wpdb->get_results("SELECT * FROM users where email='".$user_email."'") as $key => $row1)
							{
								$oauth_uid = $row1->oauth_uid;
							?>
							<img src="https://graph.facebook.com/<?php echo $oauth_uid; ?>/picture?type=small">
							<?php	 
							}
						}
						else
						{
							?>
							<img src="http://placehold.it/74x74&amp;text=No image found">
							<?php
						}		
					} 
					?>
				</div>
		 
          
           <h2>My Progress</h2> 
           
           <div class="current-challenge">
             <h3>Current Challenge: <br>
			 <?php
			 $today=date('Y-m-d');
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
			 if($rowCount > 0)
			 { 
				 ?>
				 <span><?php echo $post_title; ?></span></h3>
				 <h3>Group Start Date:<span><?php echo date('m/d/Y', strtotime($start_date)); ?></span></h3>
				 <?php
				 	
			 }
			 else
			 {
			 ?> 
				<div class="alert alert-danger">No challenge activated by admin</div>
			 <?php	
			 }		
			 ?>
			 
		   </div> 
		   
		   <div class="challenge_result">
		   <?php
		   if($rowCount > 0)
			 {
				 
					 foreach( $wpdb->get_results("select count(id) 'total' from rest_user_challenge where post_id='".$post_id."' and user_id='".$user_id."'") as $key => $row11)
					 {
					  $countt = $row11->total; 
					 }
					 if($countt == 0)
					 {		
				 ?>
						<script>
						jQuery(document).ready(function()
						{
							jQuery( ".datepicker" ).datepicker({
								dateFormat: 'yy-mm-dd',
								constrainInput: false,
								minDate : 0
							});
	
						});
						</script>
						<input type="hidden" id="post_id" value="<?php echo $post_id; ?>" />
						<input type="hidden" id="user_id" value="<?php echo $user_id; ?>" />
						<input type="hidden" id="today" value="<?php echo date('Y-m-d'); ?>" /> 
						
						<div class="acept-chalenge accept">
						 <label><input type="checkbox" name="yes_im">Yes - I'm doing this Challenge</label>
						</div> 
						
					   <div class="event-section">
						 <h4>Select the days that you have <br>completed so far</h4>
							  <h4><?php echo date('F', strtotime($start_date)); ?></h4> 
							  <div class="cal-sec">
								<div class="datepicker"></div> 
							  </div>
					   </div>
			   <?php
					 }
					 else
					 {
					 foreach( $wpdb->get_results("select * from rest_user_challenge where post_id='".$post_id."' and user_id='".$user_id."'") as $key => $row111)
					 {
						$cr_date = $row111->cr_date; 
						$date=date('j-n-Y', strtotime($cr_date));
						$val1.="'".$date."'".",";
					 }
					 $val_12=substr($val1,0,-1);	
					 ?> 
					 <script>
						jQuery(document).ready(function()
						{
							jQuery( ".datepicker" ).datepicker({
								dateFormat: 'yy-mm-dd',
								constrainInput: false,
								minDate : 0,
								beforeShowDay: unavailable,  
								onSelect: function(year, month, inst) {
									var datValue=jQuery(this).val();
									var sel_date= jQuery.datepicker.formatDate('yy-mm-dd', new Date(datValue));
									var post_id=jQuery('#post_id').val();	
									var user_id=jQuery('#user_id').val();
									
									jQuery.ajax({  
										type: "POST",
										url:"<?php bloginfo('template_url'); ?>/ajax/day_challenge_complete.php",
										data:{post_id:post_id,user_id:user_id,sel_date:sel_date,format:'raw'},
										success:function(resp){  
											if( resp !="")
											{
												
												if(resp==0) 
												{
													alert('You are not allow to select this date');
												}
												else
												{
													jQuery('.cal-sec').empty().append(resp);
												}	
											}
											
										}
									})
									
								}
							});
	
						});
						
						function unavailable(date) {
						
						var unavailableDates = [<?php echo $val_12; ?>];
						
						dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" +date.getFullYear();

						if (jQuery.inArray(dmy, unavailableDates) < 0) 
						{
							
							return [true,"",""]; 
						} 
						else 
						{
						
							return [false,"book_out",jQuery('#'+dmy).val()];   
						}  

						}
						
						
						</script>
						<input type="hidden" id="post_id" value="<?php echo $post_id; ?>" />
						<input type="hidden" id="user_id" value="<?php echo $user_id; ?>" />
						<input type="hidden" id="today" value="<?php echo date('Y-m-d'); ?>" /> 
						<div class="acept-chalenge accept">
							<div class="alert alert-success">Yes - I'm doing this Challenge</div> 
							 <label><input type="checkbox" name="yes_im" checked>Yes - I'm doing this Challenge</label>
						</div> 
					  
					   <div class="event-section">
						 <h4>Select the days that you have <br>completed so far</h4>
							  <h4><?php echo date('F', strtotime($start_date)); ?></h4> 
							  <div class="cal-sec">
								<div class="datepicker"></div> 
							  </div>	
					   </div>
					 <?php	
					 }	
			}	  
			else
			{ 		
		   ?>
			<div class="alert alert-danger">No challenge activated by admin</div>
		   <?php
			} 
			?>
			</div>
           <div class="my-badges">
             <h3>My Badges:</h3>
             <img src="<?php bloginfo('template_url'); ?>/images/sign0.png" alt="..." />
             <img src="<?php bloginfo('template_url'); ?>/images/sign1.png" alt="..." />
             <img src="<?php bloginfo('template_url'); ?>/images/sign2.png" alt="..." />
             <img src="<?php bloginfo('template_url'); ?>/images/sign3.png" alt="..." />
             <img src="<?php bloginfo('template_url'); ?>/images/sign4.png" alt="..." />
             <img src="<?php bloginfo('template_url'); ?>/images/sign5.png" alt="..." />
             <img src="<?php bloginfo('template_url'); ?>/images/sign6.png" alt="..." />
           </div>
           
           <a class="btn btn-default btn-profil" href="<?php echo site_url(); ?>/my-profile">My Profile</a>
            
         </div> <!--progrees-section-->
       </div> <!--col-xs-12 col-md-3-->
       <div class="col-xs-12 col-md-6">
         <div class="support-group"> 
           <h2>Support Group Forum</h2>
          <div class="form-frame">
			<div class="post_forum_box">
				 <form name="user_forum_sec" id="user_forum_sec" action="" method="post">
					 <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />    	
					 <div class="blog-profile">
						<?php 
						if($count_1!=0)
						{	
							foreach( $wpdb->get_results("SELECT * FROM rest_profile_img where user_id='".$user_id."'") as $key => $row11)
								{
									$name = $row11->name;   
								}
							?>
							<img src="<?php bloginfo('template_url'); ?>/user_profile/thumb.php?src=<?php echo $name; ?>&w=74&h=74">	  
							<?php
						}  
						else
						{	
							if($count!=0)
							{
								foreach( $wpdb->get_results("SELECT * FROM users where email='".$user_email."'") as $key => $row1)
								{
									$oauth_uid = $row1->oauth_uid;
								?>
								<img src="https://graph.facebook.com/<?php echo $oauth_uid; ?>/picture?type=small">
								<?php	 
								}
							}
							else
							{
								?>
								<img src="http://placehold.it/74x74&amp;text=No image found">
								<?php
							}		
						} 
						?>
						<h4><?php echo $user_name; ?></h4>
						
					 </div> <!--blog-profile Close-->
					 
					 <div class="r-pofile-post"> 
					   <textarea class="form-control" name="post_content" placeholder="Whats in your mind.."></textarea>
					 </div>
					 <input type="submit" name="submit" value="post">
					 <img src="<?php bloginfo('template_url'); ?>/images/loader.gif" id="forum_loader" style="display:none;" />	
				 </form>
			 </div>
		  
			 <div class="all-user-forum-box">	 
				 <?php 
				 global $post;
				 query_posts('post_type=post&showposts=20'); ?>
                 <?php 
				 while (have_posts()) : the_post(); 
				 $post_author=$post->post_author;
				 $post_date=$post->post_date;
				 $auth_name=get_user_meta($post_author,"first_name",true); 
				 
				 ?>	
				 <div class="forum-box">	 
					 <div class="blog-profile">
						<?php user_profile_image($post_author); ?>
						<h4><?php echo $auth_name; ?></h4>
						<p><?php echo date('F j', strtotime($post_date)); ?> at <?php echo date('g:i a', strtotime($post_date)); ?></p> 
					 </div> <!--blog-profile Close--> 
					 
					 <div class="r-pofile-post"> 
					  <?php the_content(); ?>
					 </div>
					 
					 <div class="commect-section"> 
					    <?php 
						$curr_user_id = get_current_user_id();	
						
						$is_like=get_like_dislike($post->ID,$curr_user_id); ?>
						<ul>
						   <?php
						 						    
						   if($is_like==0) 
						   {	   
						   ?>
						   <li class="like_<?php echo $post->ID ?>"><a href="javascript:void(0);"  onclick="like_dislike('1','<?php echo $post->ID ?>','<?php echo $curr_user_id; ?>');"> <i class="fa fa-thumbs-up" aria-hidden="true"></i>Like</a></li> 
						   <?php
						   }
						   else
						   {	   
						   ?>
						   <li class="like_<?php echo $post->ID ?>"><a href="javascript:void(0);" class="active" onclick="like_dislike('0','<?php echo $post->ID ?>','<?php echo $curr_user_id; ?>');"> <i class="fa fa-thumbs-up" aria-hidden="true"></i>Like</a></li>  
						   <?php 
						   }
						   ?>
						   <li><a href="javascript:void(0);" onclick="focus_comment('<?php echo $post->ID; ?>');"> <i class="fa fa-comments" aria-hidden="true"></i>Comment</a></li>
						</ul>
					 </div> <!--commect-section Close-->
					 
					 <div class="coments-views">
					   <div class="comments-counter comments_counter_<?php echo $post->ID; ?>">
					    <?php
						
						foreach( $wpdb->get_results("SELECT count(id) 'total' FROM rest_user_like_dislike where post_id='".$post->ID."'") as $key => $row11)
						{
							 $countt = $row11->total;
						}
						if($countt > 0)
						{	
							
							if($countt==1)
							{
								foreach( $wpdb->get_results("SELECT * FROM rest_user_like_dislike where post_id='".$post->ID."' order by id desc limit 0,1") as $key => $row2)
								{
									$user_id = $row2->user_id;
									$nameee=get_user_meta($user_id,'first_name',true);
									?>
									<a href="javascript:void(0);"><i class="fa fa-thumbs-up" aria-hidden="true"></i><?php echo $nameee; ?> like this </a>
									<?php
								} 
							}	
							if($countt > 1)
							{
								$count1=$count-1;
								foreach( $wpdb->get_results("SELECT * FROM rest_user_like_dislike where post_id='".$post->ID."' order by id desc limit 0,1") as $key => $row2)
								{
									$user_id = $row2->user_id; 
									$nameee=get_user_meta($user_id,'first_name',true);
									?>
										<a href="javascript:void(0);"><i class="fa fa-thumbs-up" aria-hidden="true"></i><?php echo $nameee; ?> and <?php echo $countt; ?> like this </a>
									<?php
								} 
							}
							
						}
						?>
					   </div> 
					   <!--<a class="view-comments" href="">View 2 more comments</a>--> 
					  
					   <div class="comments-list comments_list_<?php echo $post->ID; ?>">  
							<?php
													
							foreach( $wpdb->get_results("SELECT * FROM rest_comments where comment_post_ID='".$post->ID."' order by comment_date desc") as $key => $row)
							{
							$user_idd = $row->user_id;
							$comment_content = $row->comment_content;
							?>
							<div class="comments-people">  
							 <?php user_profile_image($user_idd); ?>
							 <div class="commnent-block">
							  <p><?php echo $comment_content; ?></p> 
							 </div> 
							</div> 
							<?php
							}
							?>	
					   </div>
					   
					   <div class="your-comments"> 
						 <div class="coment-pic"> 
							 <?php user_profile_image($user_id); ?>
						 </div>
						 <div class="comment-box">
							<textarea class="comment form-control comment_<?php echo $post->ID; ?>" data-text="<?php echo $post->ID; ?>" placeholder="Write a comment"></textarea> 
						 </div>
										  
					   </div>  <!--your-comments Close--> 
					 </div> <!--coments-views-->
				 </div>  
				 <?php endwhile; wp_reset_query(); ?>	
             </div>               
          </div> <!--form-frame-->
         </div>  <!--support-group-->
       </div> <!--col-xs-12 col-md-3-->
       
       <div class="col-xs-12 col-md-3">
        <?php get_sidebar('forum_right'); ?> 
       </div> <!--col-xs-12 col-md-3-->
     </div>
   </div>  
</div> <!--form-pagecontent-->
<?php 
}
else
{
	include(ABSPATH.'wp-content/themes/restClub/page-templates/404.php');
}	
get_footer(); ?> 
