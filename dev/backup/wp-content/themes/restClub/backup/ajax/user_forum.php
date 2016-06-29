<?php
include('../../../../wp-config.php');
global $wpdb;
$post_content=$_POST['post_content'];
$user_id=$_POST['user_id'];
$post_title="Posts";

$my_post = array(
  'post_title'    => wp_strip_all_tags($post_title),
  'post_content'  => $post_content,
  'post_status'   => 'publish',
  'post_author'   => $user_id
);
 

$post_id=wp_insert_post( $my_post );

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
jQuery('.comment').on('keydown', function(e)
	{
        if ((e.keyCode == 13) && (!e.shiftKey)) 
		{
			
			
            var comment=jQuery(this).val();
			if(comment!="")
			{	
			   
			   var post_id=jQuery(this).attr('data-text');
			   var user_id=jQuery('#curr_user_id').val();
			  jQuery(this).val('');	
			   jQuery.ajax({
					type: "POST", 
					url:"<?php bloginfo('template_url'); ?>/ajax/insert_post_comment.php", 
					data:{post_id:post_id,user_id:user_id,comment:comment,format:'raw'}, 
					success:function(resp) 
					{ 
						if( resp !="")
						{
							
							jQuery('.comments_list_'+post_id).empty().append(resp); 
						}
						
					}
			   });
			}    
		 }
    });
</script>
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


$post_date=get_the_date('F j',$post_id);
$post_time=get_the_date('g:i a',$post_id);
?>
<h4><?php echo $user_name; ?></h4>
<p><?php echo $post_date; ?> at <?php echo $post_time; ?></p>

</div> <!--blog-profile Close-->

<div class="r-pofile-post"> 
<?php echo $post_content; ?>
</div> 
<div class="commect-section"> 
<ul>
  <li><a href="#"> <i aria-hidden="true" class="fa fa-thumbs-up"></i>Like</a></li>
   <li><a href="javascript:void(0);" onclick="focus_comment('<?php echo $post_id; ?>');"> <i class="fa fa-comments" aria-hidden="true"></i>Comment</a></li>
</ul>
</div>
<div class="coments-views">
   <div class="your-comments">
	 <div class="coment-pic"> 
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
	 
	 <div class="comment-box">
		<textarea class="comment form-control comment_<?php echo $post_id; ?>" data-text="<?php echo $post_id; ?>" placeholder="Write a comment"></textarea> 
	 </div>
			  
   </div>  <!--your-comments Close--> 
    <div class="comments-list comments_list_<?php echo $post_id; ?>"></div>  
 </div>