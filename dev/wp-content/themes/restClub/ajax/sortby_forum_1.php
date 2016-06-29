<?php
include('../../../../wp-config.php');
$sortby=$_POST['sortby'];
$post_id=$_POST['post_id'];
$sortby;
?>
<script>
jQuery(document).ready(function()
{
	jQuery(".category-list, .new-badges-list").mCustomScrollbar({
		setHeight:170, 
		theme:"minimal-dark" 
	});
});
</script>
<?php
if($sortby=="name")
{
?>
<div class="category-list">
  <ul>
<?php	
	$i=0;
	foreach( $wpdb->get_results("SELECT user_id, COUNT( cr_date )  'total_days'
	FROM rest_user_challenge
	WHERE post_id =  '$post_id'
	GROUP BY user_id
	ORDER BY total_days DESC ") as $key => $row)
	{ 
		$user_id = $row->user_id;
		$count[] = $row->total_days;
		$user_name[] = get_user_meta($user_id,"first_name",true);
	}
	
	sort($user_name);
	foreach($user_name as $val)
	{
	?>
		<li><?php echo $val; ?><span><?php echo $count[$i]; ?> Days</span></li>
	<?php 
	$i++;
	}
?>
</ul>
</div>
<?php		
}
else
{
?>
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
</div>
<?php	
}	
?>