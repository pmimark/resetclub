<?php
/*
Plugin Name: Challenge Plugin
Description: Challenge Plugin
Version: 1.0
Author: Challenge Plugin
*/

if (is_admin())
   {   
      function form_challenge() 
         {  
		add_menu_page("Challenge","Challenge",1,"challenge","");
		add_submenu_page("challenge","Challenge","Challenge",8,"challenge","challenge");
		
         }  
       add_action('admin_menu','form_challenge'); 
   }
function challenge()
{
global $wpdb;
$plugin_url=plugins_url( $path, $plugin );
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  jQuery(function() {
   jQuery( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        constrainInput: false,
		minDate : 0
    });
  });
  
function edit_challenge(status,id)
{
	var name=jQuery('.name_'+id).val();
	var start_date=jQuery('.start_'+id).val();
	var end_date=jQuery('.end_'+id).val();
	
	jQuery.ajax({
		type: "POST",
		url:"<?php echo $plugin_url; ?>/challenge/ajax/edit_challenge.php", 
		data:{name:name,start_date:start_date,end_date:end_date,id:id,status:status,format:'raw'},
		success:function(resp){
			if( resp !="")
			{
				jQuery('.result').empty().append(resp); 
				
			} 
			
		}
    });
	
}



function delete_challenge(id)
{
	jQuery.ajax({
		type: "POST",
		url:"<?php echo $plugin_url; ?>/challenge/ajax/delete_challenge.php", 
		data:{id:id,format:'raw'},
		success:function(resp){
			if( resp !="")
			{
				if(resp==1)
				{
					jQuery('.row_'+id).fadeOut(2000);
					jQuery('.row_'+id).remove(); 
				}	
				
			}
			
		}
    });
}

function delete_challenge1(id)
{
	jQuery('.row_'+id).fadeOut(2000);
	jQuery('.row_'+id).remove(); 
}  

function add_challenge(id)
{
	var len=jQuery('.row').length;
	len=parseInt(len)+1;
	jQuery.ajax({
		type: "POST",
		url:"<?php echo $plugin_url; ?>/challenge/ajax/add_challenge.php", 
		data:{len:len,format:'raw'},
		success:function(resp){
			if( resp !="")
			{
				jQuery(resp).insertAfter('.row_'+id); 
				
			}
			
		}
    });
	
	
	
}

function change_status(status,id)
{
	var loader='<img src="<?php echo $plugin_url; ?>/challenge/images/loader.gif" />';
	jQuery('.status').empty().append(loader);
	
	jQuery.ajax({
		type: "POST",
		url:"<?php echo $plugin_url; ?>/challenge/ajax/change_status.php", 
		data:{status:status,id:id,format:'raw'},
		success:function(resp){
			if( resp !="")
			{
				jQuery('.result').empty().append(resp); 
				
			}
			
		}
    });
	
	
}  
</script>

<div class="wrap">
<h1>Challenge Section</h1>
<div class="result">
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
	foreach( $wpdb->get_results("SELECT count(id) 'total' FROM rest_challenge") as $key => $row1)
	{
		$count = $row1->total;
	}	
	
	if($count > 0)
	{	
		foreach( $wpdb->get_results("SELECT * FROM rest_challenge") as $key => $row)
		{
			$id = $row->id;
			$name = $row->name;
			$start_date = $row->start_date;
			$end_date = $row->end_date;
			$status = $row->status; 
		?>
		<tr class="row_<?php echo $id; ?>">
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
	}
	else
	{	
	?>
	<tr class="row row_1">
		<td><input type="text" class="name_1"  /></td>
		<td><input type="text" class="start_1 datepicker" readonly  /></td>
		<td><input type="text" class="end_1 datepicker" readonly  /></td>
		<td>Status</td> 
		<td><a href="javascript:void(0);" class="button" onclick="edit_challenge('0','1');">Save</a></td>
		<td><a href="javascript:void(0);" class="button" onclick="add_challenge('1');">Add</a></td>
	</tr> 
	<?php
	}
	?>
	</tbody>
	</table>
	
</div>
</div>
<?php
}

		