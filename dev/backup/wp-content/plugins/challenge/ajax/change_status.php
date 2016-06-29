<script>
  jQuery(function() {
   jQuery( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        constrainInput: false,
		minDate : 0
    });
  });
 </script>
<?php
include('../../../../wp-config.php');
$status=$_POST['status'];
$id=$_POST['id'];
global $wpdb;
if($status==0)
{
	$wpdb->query( "UPDATE rest_challenge SET status = '1' WHERE id = '$id'" );
}
else
{
	$wpdb->query( "UPDATE rest_challenge SET status = '0' WHERE id = '$id'" );
}	

$wpdb->query( "UPDATE rest_challenge SET status = '0' WHERE id != '$id'" );

?>
<table class="wp-list-table widefat">
<thead>
<tr>
	<th>Name</th>
	<th>Start Date</th>
	<th>End Date</th>
	<th>Status</th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
foreach( $wpdb->get_results("SELECT * FROM rest_challenge") as $key => $row)
{
	$id = $row->id;
	$name = $row->name;
	$start_date = $row->start_date;
	$end_date = $row->end_date;
	$status = $row->status; 
?>

<tr class="row row_<?php echo $id; ?>">
	<td><input type="text" class="name_<?php echo $id; ?>" value="<?php echo $name; ?>" /></td>
	<td><input type="text" class="start_<?php echo $id; ?> datepicker" value="<?php echo $start_date; ?>" readonly /></td>
	<td><input type="text" class="end_<?php echo $id; ?> datepicker" value="<?php echo $end_date; ?>" readonly /></td>
	<td>
	<?php
	if($status==0)
	{	
	?>
	<a href="javascript:void(0);" class="status stat_<?php echo $id; ?>" onclick="change_status('<?php echo $status;  ?>','<?php echo $id;  ?>');">Hide</a>
	<?php
	}
	else
	{	
	?>
	<a href="javascript:void(0);" class="status stat_<?php echo $id; ?>" onclick="change_status('<?php echo $status;  ?>','<?php echo $id;  ?>');">Show</a>
	<?php
	}
	?>
	</td> 
	<td><a href="javascript:void(0);" class="button" onclick="edit_challenge('1','<?php echo $id; ?>');">Save</a></td>
	<td><a href="javascript:void(0);" class="button" onclick="add_challenge('<?php echo $id; ?>');">Add</a></td>
	<td><a href="javascript:void(0);" class="button" onclick="delete_challenge('<?php echo $id; ?>');">Delete</a></td>
</tr>
<?php 
} 
?>
</tbody>
</table>