<?php

include('../../../../wp-config.php');
global $wpdb;
$today=date('Y-m-d');

$post_id=$_POST['post_id'];
$user_id=$_POST['user_id'];
$sel_date=$_POST['sel_date'];


if($sel_date!=$today)  
{
	echo "0";
	die;  
} 
 
$wpdb->insert( 'rest_user_challenge', array(
'user_id' => $user_id,
'post_id' => $post_id,
'cr_date' => $sel_date) 
);


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
<div class="datepicker"></div>