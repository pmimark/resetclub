<?php
include('../../../../wp-config.php');
global $wpdb;
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
</script>
<?php
$post_id=$_POST['post_id'];
$user_id=$_POST['user_id'];
$status=$_POST['status'];
$today=date('Y-m-d'); 

$start_date =get_post_meta($post_id,"start_date",true);
$end_date =get_post_meta($post_id,"end_date",true);

if($status==1)
{
	$wpdb->insert( 'rest_user_challenge', array(
	'user_id' => $user_id,
	'post_id' => $post_id,
	'cr_date' => $today)
	);
}
else
{
	 $wpdb->query( "DELETE FROM rest_user_challenge WHERE user_id = '$user_id' and post_id='$post_id'" );
	
}


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
?>
