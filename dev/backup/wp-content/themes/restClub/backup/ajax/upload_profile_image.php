<?php
include('../../../../wp-config.php');
global $wpdb;
$user_id = $_POST['user_id'];
$rand=date('ymdHis');
$imagename = str_replace(" ","_",$rand.$_FILES['photoimg']['name']); 
$size = $_FILES['photoimg']['size'];  
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
$ext = pathinfo($imagename, PATHINFO_EXTENSION); 
$path=ABSPATH.'wp-content/themes/restClub/user_profile/'; 

if(in_array($ext,$valid_formats))  
{
				
		$wpdb->query( "DELETE FROM rest_profile_img WHERE user_id = '$user_id'" );  
		$actual_image_name = time().substr(str_replace(" ", "_", $imagename), 5); 
		
		$uploadedfile = $_FILES['photoimg']['tmp_name'];
											 
		$widthArray = array(500);  
		include ABSPATH.'image/includes/compressImage.php';	
		
		foreach($widthArray as $newwidth)
		{
			$filename=compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth);
			$file=strstr($filename, 'user_profile/');
			$file=str_replace("user_profile/","",$file);  
			
			$wpdb->insert( 'rest_profile_img', array(
				'user_id' => $user_id,   
				'name' => $file )    
			);
			
			
			 
		}								
		?>
		<img src="<?php bloginfo('template_url'); ?>/user_profile/thumb.php?src=<?php echo $file; ?>&w=200&h=200">
		<?php
							
}
else
{
?>
<img src="http://placehold.it/200x200&amp;text=&nbsp;" alt="" title="">  
	<div class="alert alert-danger">Upload correct file format</div>     
<?php 
}
?>