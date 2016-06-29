<?php
include('../../../../wp-config.php');
global $wpdb;

$status=$_POST['status'];
$post_id=$_POST['post_id'];
$user_id=$_POST['user_id'];

$wpdb->query( "DELETE FROM rest_user_like_dislike WHERE post_id = '$post_id' and user_id='$user_id'" );

if($status==1)
{
	$wpdb->insert( 'rest_user_like_dislike', array(
	'post_id' => $post_id,
	'user_id' => $user_id)
	);
}	

if($status==1)
{
	$like_link='<a class="active" onclick="like_dislike("0","'.$post_id.'","'.$user_id.'");" href="javascript:void(0);"> <i aria-hidden="true" class="fa fa-thumbs-up "></i>Like</a>';
	$like_link=stripslashes($like_link); 
}
else
{
	$like_link='<a onclick="like_dislike("1","'.$post_id.'","'.$user_id.'");" href="javascript:void(0);"> <i aria-hidden="true" class="fa fa-thumbs-up"></i>Like</a>';
	$like_link=stripslashes($like_link); 
}	


foreach( $wpdb->get_results("SELECT count(id) 'total' FROM rest_user_like_dislike where post_id='".$post_id."'") as $key => $row)
{
	$count = $row->total;
}
if($count==1)
{
	foreach( $wpdb->get_results("SELECT * FROM rest_user_like_dislike where post_id='".$post_id."' order by id desc limit 0,1") as $key => $row)
	{
		$user_id = $row->user_id;
		$nameee=get_user_meta($user_id,'first_name',true);
		$like_msg=' <a href="javascript:void(0);"><i class="fa fa-thumbs-up" aria-hidden="true"></i>'.$nameee.' like this </a>';	
	} 
}	
if($count > 1)
{
	$count1=$count-1;
	
	foreach( $wpdb->get_results("SELECT * FROM rest_user_like_dislike where post_id='".$post_id."' order by id desc limit 0,1") as $key => $row1)
	{
		$user_idd = $row1->user_id; 
		$namee=get_user_meta($user_idd,'first_name',true);
		$like_msg=' <a href="javascript:void(0);"><i class="fa fa-thumbs-up" aria-hidden="true"></i>'.$namee.' and 
		'.$count1.' like this </a>'; 	 
	} 
}


$array = array('like_link' => $like_link, 'like_msg' => $like_msg);
echo json_encode($array);  
	

?>