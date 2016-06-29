<?php
/**
 * Template Name: My Profile Page
 *
*/

get_header(); 
if ( is_user_logged_in() ) {
$user_id = get_current_user_id();	
$name=get_user_meta($user_id,"first_name",true); 
$name=explode(" ",$name);
$fname=$name[0];
$lname=$name[1]; 

$user = get_user_by( 'id', $user_id );
$user_email=$user->user_email;

$name=get_user_meta($user_id,"first_name",true);
$display_name=get_user_meta($user_id,"display_name",true);
$phone=get_user_meta($user_id,"phone",true);
$gender=get_user_meta($user_id,"gender",true);
$address_1=get_user_meta($user_id,"address_1",true);
$address_2=get_user_meta($user_id,"address_2",true);
$country=get_user_meta($user_id,"country",true);
$state=get_user_meta($user_id,"state",true);
$city=get_user_meta($user_id,"city",true); 
$service=get_user_meta($user_id,"service",true); 
$cr_date=get_user_meta($user_id,"cr_date",true); 

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
<div class="profile-page"> 
  <div class="container">
     <div class="row">
       <div class="col-md-10 col-md-offset-1">
          <h2>My Profile</h2>
        <div class="row">
          <div class="col-sm-4 m-badge">
            <h3>Badges Earned</h3>
            <p>Click a badge if you earned it own your own!</p>
          </div>
          <div class="col-sm-8">
             <ul class="badges">
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/badge1.png" alt="..."></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/badge2.png" alt="..."></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/badge3.png" alt="..."></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/badge4.png" alt="..."></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/badge5.png" alt="..."></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/badge6.png" alt="..."></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/badge7.png" alt="..."></a></li>
             </ul>
          </div>
        </div>  <!--row-->
          
              
        <div class="row profil-setup">
          <div class="col-md-3">
              <div class="prifile-p">
				<div class="user_prof_image">
					<?php
					if($count_1!=0)
					{	
						foreach( $wpdb->get_results("SELECT * FROM rest_profile_img where user_id='".$user_id."'") as $key => $row11)
							{
								$name = $row11->name;   
							}
						?>
						<img src="<?php bloginfo('template_url'); ?>/user_profile/thumb.php?src=<?php echo $name; ?>&w=200&h=200">	 
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
							<img src="https://graph.facebook.com/<?php echo $oauth_uid; ?>/picture?type=large">
							<?php	 
							}
						}
						else
						{
							?>
							<img src="http://placehold.it/200x200&amp;text=No image found">
							<?php
						}		
					} 
					?>
				</div>
				<?php
				if($count_1!=0) {
				?>	
					<a href="javascript:void(0);" onclick="del_user_profile('<?php echo $user_id; ?>');">Delete</a>
				<?php } ?>
                <h3>Resetter since <?php echo date('Y', strtotime($cr_date)); ?></h3> 
                
                <a class="btn btn-default btn-up" onclick="jQuery('#photoimg').click();">upload photo</a>
				<form id="imageform" method="post" enctype="multipart/form-data" action='' style="display:none;">
					<div class="form-group">
						<input type="file" name="photoimg" id="photoimg" onchange="operator_image();">
						<input type="text" name="user_id" value="<?php echo $user_id; ?>"> 
					</div>
					<button type="submit" id="profile_submit" class="btn btn-default">Submit</button>
				</form> 
				
				
              </div> <!--prifile-p-->
          </div>
           <div class="col-md-9 form-section">
            <div class="row">
				<form name="user_personal_1" id="user_personal_1" action="" method="post">
				   <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
				   <div class="col-md-6">
					  <input type="text" class="form-control" placeholder="First Name*" value="<?php echo $fname; ?>" name="fname">
				   </div>
				   <div class="col-md-6">
					  <input type="text" name="lname" class="form-control" placeholder="Last Name*" value="<?php echo $lname; ?>">
				   </div>
				   <div class="col-md-6">
					  <input type="text" class="form-control" placeholder="Display Name" name="display_name" value="<?php echo $display_name; ?>">
				   </div>
				   <div class="col-md-6">
					  <input type="text" class="form-control" placeholder="Cell Phone" name="phone" value="<?php echo $phone; ?>"> 
				   </div>
				   <div class="col-md-6">
					  <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $user_email; ?>" readonly>
				   </div>
				   <div class="col-md-6">
					 <select class="selectpicker form-control" name="gender" >
						  <option value="">Gender</option>
						  <option value="Male" <?php if($gender=="Male") { echo 'selected'; } ?>>Male</option>
						  <option value="Female" <?php if($gender=="Female") { echo 'selected'; } ?>>Female</option>
					 </select> 
				   </div>
				   <div class="col-md-6">
					  <input type="text" class="form-control" placeholder="Address 1" name="address_1" value="<?php echo $address_1; ?>">
				   </div>
				   <div class="col-md-6">
					  <input type="text" class="form-control" placeholder="Address 2" name="address_2" value="<?php echo $address_2; ?>"> 
				   </div>
				   
				   <div class="col-md-6">
					 <select class="selectpicker form-control" name="country" >
						  <option value="">Country</option>
						  <option value="Country 1" <?php if($country=="Country 1") { echo 'selected'; } ?>>Country 1</option>
						  <option value="Country 2" <?php if($country=="Country 2") { echo 'selected'; } ?>>Country 2</option>
						  <option value="Country 3" <?php if($country=="Country 3") { echo 'selected'; } ?>>Country 3</option> 
						
					 </select>
				   </div>
				   
				   <div class="col-md-6">
					 <div class="row">
						<div class="col-md-6 padd-right">
						  <select class="selectpicker form-control" name="state" >
						  <option value="">State</option>
						  <option value="state 1" <?php if($state=="state 1") { echo 'selected'; } ?>>State 1</option>
						  <option value="state 2" <?php if($state=="state 2") { echo 'selected'; } ?>>State 2</option>
						  <option value="state 3" <?php if($state=="state 3") { echo 'selected'; } ?>>State 3</option>
						  
					 </select>
						</div>
						<div class="col-md-6 padd-left">
						  <select class="selectpicker form-control" name="city" >
						  <option value="">City</option>  
						  <option value="city 1" <?php if($city=="city 1") { echo 'selected'; } ?>>City 1</option>  
						  <option value="city 2" <?php if($city=="city 2") { echo 'selected'; } ?>>City 2</option>   
						 
					 </select>
						</div>  
					 </div>
				   </div>
				 	
				  <?php
				  $service=unserialize($service);
				  if(!empty($service))
				  {	   
				  ?>	
				  <div class="col-md-6"> 
					<div class="check-selection">
					  <label>Daily Emails?<input type="checkbox" name="service[]" value="1" <?php if (in_array("1", $service)) { echo 'checked'; } ?>></label>
					  <label>Daily Texts?<input type="checkbox" name="service[]" value="2" <?php if (in_array("2", $service)) { echo 'checked'; } ?>></label>
					  <label>Weekly?<input type="checkbox" name="service[]" value="3" <?php if (in_array("3", $service)) { echo 'checked'; } ?>></label>  
					</div>
				  </div> 
				  <?php
				  }
				  ?>
				  
				  
				   <div class="col-md-12 clearfix">
					<input type="submit" class="btn btn-default btn-update" value="update">
					<img src="<?php bloginfo('template_url'); ?>/images/loader-11.gif" id="loader_1" style="display:none;" />
				  </div> 
			  </form>
            </div>
          </div> <!--col-md-5-->
        </div> <!--profile-setuop-->
         
        
       </div> <!--col-md-10-->
   
     </div> <!--row--> 
    
    <hr>
    
    <div class="row">
       <div class="col-md-10 col-xs-offset-1">
         <div class="Commitment">
		    <?php
			$comment=get_user_meta($user_id,"comment",true);
			$dob=get_user_meta($user_id,"dob",true);
			$start_total_inch=get_user_meta($user_id,"start_total_inch",true);
			$start_weight=get_user_meta($user_id,"start_weight",true);
			$start_pant_size=get_user_meta($user_id,"start_pant_size",true);
			$start_dress_size=get_user_meta($user_id,"start_dress_size",true);
			$goal_total_inch=get_user_meta($user_id,"goal_total_inch",true);
			$goal_weight=get_user_meta($user_id,"goal_weight",true);
			$goal_pant_size=get_user_meta($user_id,"goal_pant_size",true);
			$goal_dress_size=get_user_meta($user_id,"goal_dress_size",true); 
			
			$dob=explode('-',$dob);
			$year=$dob[0];
			$month=$dob[1];
			$day=$dob[2];
			?>
		 
		    <form name="user_personal_2" id="user_personal_2" action="" method="post"> 
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" /> 
            <div class="row"> 
              <div class="col-sm-4">
               <p>My Commitment/Goal</p> 
              </div> 
             <div class="col-sm-8"> 
               <textarea class="form-control" name="comment" ><?php echo $comment; ?></textarea>
            </div>
        </div> 
        
        <br>
        <div class="row">
           <div class="col-md-6">
              <div class="row">
               <div class="col-sm-4"> 
                <p>Date of birth</p>
               </div>
               <div class="col-sm-8">
                   <select class="selectpicker form-control" name="day" >
                      <option value="">Date</option>
                      <?php
					  for($i=1;$i<=31;$i++)
					  {	  
					  ?>
						<option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT);  ?>" <?php if($day==str_pad($i, 2, '0', STR_PAD_LEFT)) { echo 'selected'; } ?> ><?php echo str_pad($i, 2, '0', STR_PAD_LEFT);  ?></option> 
					  <?php
					  }
					  ?>	
                 </select>
                 
                 <select class="selectpicker form-control" name="month" >
                      <option value="">Month</option>
                      <option value="01" <?php if($month=="01") { echo 'selected'; } ?> >Jan</option>
                      <option value="02" <?php if($month=="02") { echo 'selected'; } ?>>Feb</option>
                      <option value="03" <?php if($month=="03") { echo 'selected'; } ?>>Mar</option>
                      <option value="04" <?php if($month=="04") { echo 'selected'; } ?>>Apr</option>
                      <option value="05" <?php if($month=="05") { echo 'selected'; } ?>>May</option>
                      <option value="06" <?php if($month=="06") { echo 'selected'; } ?>>June</option>
                      <option value="07" <?php if($month=="07") { echo 'selected'; } ?>>July</option>
                      <option value="08" <?php if($month=="08") { echo 'selected'; } ?>>Aug</option>
                      <option value="09" <?php if($month=="09") { echo 'selected'; } ?>>Sep</option>
                      <option value="10" <?php if($month=="10") { echo 'selected'; } ?>>Oct</option>
                      <option value="11" <?php if($month=="11") { echo 'selected'; } ?>>Nov</option>
                      <option value="12" <?php if($month=="12") { echo 'selected'; } ?>>Dec</option>
                 </select> 
                 
                 <select class="selectpicker form-control" name="year" >
                      <option>Year</option>
                      <?php
					  for($i=1990;$i<=2000;$i++)
					  {	  
					  ?>
						<option value="<?php echo $i;  ?>" <?php if($year==$i) { echo 'selected'; } ?>><?php echo $i;  ?></option>   
					  <?php
					  }
					  ?>	
                 </select>
                  
               </div>  
              </div> <!--row-->
               <div class="row">
               <div class="col-sm-4"> 
                <p>Start total inches</p>
               </div>
               <div class="col-sm-8">
                  <input type="text" class="form-control" name="start_total_inch" value="<?php echo $start_total_inch; ?>" >                  
               </div>  
              </div> <!--row-->
               <div class="row">
               <div class="col-sm-4"> 
                <p>Start weight</p>
               </div>
               <div class="col-sm-8">
                  
                <input type="text" class="form-control" name="start_weight" value="<?php echo $start_weight; ?>" > 
                  
               </div>  
              </div> <!--row-->
              
              <div class="row">
               <div class="col-sm-4"> 
                <p>Start pant size</p>
               </div>
               <div class="col-sm-8">
                  
                <input type="text" class="form-control" name="start_pant_size" value="<?php echo $start_pant_size; ?>" > 
                  
               </div>  
              </div> <!--row-->
              
              <div class="row">
               <div class="col-sm-4"> 
                <p>Start dress size</p>
               </div>
               <div class="col-sm-8">
                  
                <input type="text" class="form-control" name="start_dress_size" value="<?php echo $start_dress_size; ?>"> 
                  
               </div>  
              </div> <!--row-->
              
              
           </div> <!--col-md-6-->
           
           <div class="col-md-6">
             <div class="row">
               <div class="col-sm-4"> 
                <p>Goal total inches</p>
               </div>
               <div class="col-sm-8">
                  <input type="text" class="form-control" name="goal_total_inch" value="<?php echo $goal_total_inch; ?>" >                  
               </div>  
              </div> <!--row-->
              
              <div class="row">
               <div class="col-sm-4"> 
                <p>Goal weight</p>
               </div>
               <div class="col-sm-8">
                  <input type="text" class="form-control" name="goal_weight" value="<?php echo $goal_weight; ?>" >                  
               </div>  
              </div> <!--row-->
              <div class="row">
               <div class="col-sm-4"> 
                <p>Goal pant size</p>
               </div>
               <div class="col-sm-8"> 
                  <input type="text" class="form-control" name="goal_pant_size" value="<?php echo $goal_pant_size; ?>" >                  
               </div>  
              </div>
               <!--row-->
              
              <div class="row">
               <div class="col-sm-4">  
                <p>Goal dress size</p>
               </div>
               <div class="col-sm-8">
                  <input type="text" class="form-control" name="goal_dress_size" value="<?php echo $goal_dress_size; ?>" >                     
               </div>  
              </div> <!--row-->
              
              <input type="submit" value="update" class="btn btn-default btn-update mar-gin-lef"> 
			  <img src="<?php bloginfo('template_url'); ?>/images/loader-11.gif" id="loader_2" style="display:none;" />
           </div> 
           
         </div> <!--row-->
         </form> 
        
         
       </div>
    </div> <!--row-->
    
  </div>
  
  <hr>
 
 <div class="row"> 
   <div class="col-md-8 col-md-offset-2">
     <div class="payment-info">
     <h2>Payment Info.* All Access Membership $29.95/month</h2> 
    
    <div class="row mb00"> 
      <div class="col-sm-5">
        <p>Cardholder's First Name</p>
      </div>
      <div class="col-sm-7">
        <input type="text" class="form-control" >
      </div>
      
    </div>
    
    <div class="row mb00"> 
      <div class="col-sm-5">
        <p>Cardholder's Last Name</p>
      </div>
      <div class="col-sm-7">
        <input type="text" class="form-control" >
      </div>
      
    </div>
    
    
    <div class="row mb00"> 
      <div class="col-sm-5">
        <p>Credit Card Number</p>
      </div>
      <div class="col-sm-7 text-center">
        <input type="text" class="form-control" >
        <img src="<?php bloginfo('template_url'); ?>/images/payment.png" alt="..." />
      </div>
      
    </div>
    
    <div class="row mb00"> 
      <div class="col-sm-5">
        <p>Cardholder's First Name</p>
      </div>
      <div class="col-sm-7">
        <input type="text" class="form-control" >
      </div>
      
    </div>
    
    <div class="row mb00"> 
      <div class="col-sm-5">
        <p>Expiration Date</p>
      </div>
      <div class="col-sm-7">
        <select class="selectpicker form-control" >
                      <option>Month</option>
                      <option>Jan</option>
                      <option>Feb</option>
                      <option>Mar</option>
                      <option>Apr</option>
                 </select>
                 
                 <select class="selectpicker form-control" >
                      <option>Year</option>
                      <option>2016</option>
                      <option>2015</option>
                 </select>
      </div>
      
    </div>
    
    <div class="row mb00"> 
      <div class="col-sm-5">
        <p>Security Code (CSC)</p>
      </div>
      <div class="col-sm-7">
        <input type="text" class="form-control" >
      </div>
      
    </div>
    
     <div class="row mb00"> 
      <div class="col-sm-7 col-md-offset-5">
       <input type="button" class="btn btn-default btn-update" value="update">
      </div>  
      
    </div>
     
  </div> <!--payment-info-->
  
  
   </div>
 </div> 
  
</div> <!--sign-in-page-->
</div> <!--sign-in-page-->
<?php 
}
else
{
	include(ABSPATH.'wp-content/themes/restClub/page-templates/404.php');
}	
get_footer(); ?>
