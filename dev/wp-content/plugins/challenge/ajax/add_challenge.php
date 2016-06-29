<?php
$len=$_POST['len'];
?>
<tr class="row row_<?php echo $len; ?>">
<script>
  jQuery(function() {
   jQuery( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        constrainInput: false,
		minDate : 0
    });
  });
</script> 
	<td><input type="text" class="name_<?php echo $len; ?>"  /></td>
	<td><input type="text" class="start_<?php echo $len; ?> datepicker"  readonly /></td>
	<td><input type="text" class="end_<?php echo $len; ?> datepicker"  readonly /></td>
	<td>Status</td> 
	<td><a href="javascript:void(0);" class="button" onclick="edit_challenge('0','<?php echo $len; ?>');">Save</a></td>
	<td><a href="javascript:void(0);" class="button" onclick="add_challenge('<?php echo $len; ?>');">Add</a></td>
	<td><a href="javascript:void(0);" class="button" onclick="delete_challenge('<?php echo $len; ?>');">Delete</a></td>
</tr> 