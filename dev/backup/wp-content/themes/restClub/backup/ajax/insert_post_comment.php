<?php
include('../../../../wp-config.php');
global $wpdb;
$post_id=$_POST['post_id'];
$user_id=$_POST['user_id'];
$comment=$_POST['comment'];

$user = get_user_by( 'id', $user_id );
$user_email=$user->user_email;
$user_login=$user->user_login; 

$time = current_time('mysql');

$data = array(
    'comment_post_ID' => $post_id,
    'comment_author' => $user_login,
    'comment_author_email' => $user_email,
    'comment_author_url' => '',
    'comment_content' => $comment,
    'comment_type' => '',
    'comment_parent' => 0,
    'user_id' => $user_id,
    'comment_author_IP' => '',
    'comment_agent' => '',
    'comment_date' => $time,
    'comment_approved' => 1,
);

wp_insert_comment($data);


foreach( $wpdb->get_results("SELECT * FROM rest_comments where comment_post_ID='".$post_id."' order by comment_date desc") as $key => $row)
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