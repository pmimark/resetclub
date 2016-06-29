var link="http://resetclub.stagingdevsite.com/dev/"; 
jQuery(document).ready(function()
{
	jQuery('#login').validate({
		
		rules: { 
			email: {
				required: true,
				email: true
			},
			password: {
				required: true 
				 
			} 
		},
		
		submitHandler: function(form) {
			jQuery('.result').empty();
			jQuery('.result').show();  			
			jQuery('#loader').show();  			
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: link+'wp-content/themes/restClub/ajax/login.php',   
				success: function(data)     
				{
					
					if(data==1)
					{
						jQuery('.result').empty().append('<div class="alert alert-danger">User not exists</div>');
						jQuery('.result').fadeOut(3000);
						jQuery('#loader').hide();  			
					}
					else if(data==2)
					{
						jQuery('.result').empty().append('<div class="alert alert-danger">Incorrect password</div>');
						jQuery('.result').fadeOut(3000);
						jQuery('#loader').hide();  			 
					}
					else
					{
						jQuery('.result').empty().append('<div class="alert alert-success">Login Successful</div>');
						jQuery('.result').fadeOut(3000); 
						window.location.href=link+"forum"; 
						jQuery('#loader').hide();  	    		
					}  
				}
			});
		}
		
	});	
	
	jQuery('#signup').validate({
		
		rules: { 
			user_name: {
				required: true
			},
			user_email: {
				required: true,
				email: true
			},
			password: {
				required: true    
				 
			} 
		},
		
		submitHandler: function(form) {
			jQuery('.result').empty();
			jQuery('.result').show();  			
			jQuery('#loader').show();  			
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: link+'wp-content/themes/restClub/ajax/signup.php',    
				success: function(data)     
				{
					
					if(data==1)
					{
						jQuery('.result').empty().append('<div class="alert alert-danger">Username already exists. Please try another email</div>');
						jQuery('.result').fadeOut(3000);  
						jQuery('#loader').hide();    			
					}
					else if(data==2)
					{
						jQuery('.result').empty().append('<div class="alert alert-danger">Incorrect password</div>');
						jQuery('.result').fadeOut(3000);
						jQuery('#loader').hide();  			 
					}
					else
					{
						jQuery('.result').empty().append('<div class="alert alert-success">Login Successful</div>');
						jQuery('.result').fadeOut(3000); 
						window.location.href=link+"forum"; 
						jQuery('#loader').hide();   	    		
					}   
				}
			});
		}
		
	});	
	
	jQuery('#user_personal_1').validate({
		
		rules: { 
			fname: {
				required: true
			},
			lname: {
				required: true
			},
			display_name: {
				required: true
			},
			
			email: {
				required: true,
				email: true
			},
			gender: {
				required: true    
			},
			
			country: {
				required: true    
			},
			state: {
				required: true    
			},
			city: {
				required: true    
			} 
		},
		
		submitHandler: function(form) {
			
			var count= jQuery("[name='service[]']:checked").length;
			if(count==0)
			{
				alert('Please select atleast 1 option'); 
				return false;
			}	
					
			jQuery('#loader_1').show();  			
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: link+'wp-content/themes/restClub/ajax/user_personal_1.php',    
				success: function(data)     
				{
					
					if(data==1)
					{
						jQuery('#loader_1').hide();   	 
					}	 
				}
			});
		}
		
	});	
	
	jQuery('#user_personal_2').validate({
		
		rules: { 
			dob: {
				required: true
			},
			start_total_inch: {
				required: true
			},
			start_weight: {
				required: true
			},
			start_pant_size: {
				required: true    
			},
			start_dress_size: {
				required: true    
			} ,
			goal_total_inch: {
				required: true    
			},
			goal_weight: {
				required: true    
			},
			goal_pant_size: {
				required: true    
			},
			goal_dress_size: { 
				required: true    
			} 
		},
		
		submitHandler: function(form) {
					
			jQuery('#loader_2').show();  			
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: link+'wp-content/themes/restClub/ajax/user_personal_2.php',    
				success: function(data)     
				{
					
					if(data==1) 
					{
						jQuery('#loader_2').hide();   	 
					}	 
				}
			});
		}
		
	});	
	
	jQuery('#imageform').validate({ 
		submitHandler: function(form) {
			var loader='<img class="upload_prof_loader" src='+link+'wp-content/themes/restClub/images/loader.gif>';
			jQuery('.user_prof_image').empty().append(loader);	  
			 
			jQuery(form).ajaxSubmit({  
				type: "POST",
				data: jQuery(form).serialize(), 
				url:link+'wp-content/themes/restClub/ajax/upload_profile_image.php',
				success: function(data)     
				{
					jQuery('.user_prof_image').empty().append(data);				
				}
			});
	   
	   
		}
		
	});	
	
	
	jQuery('#user_forum_sec').validate({
		
		rules: { 
			post_content: {
				required: true 
			}
		},
		submitHandler: function(form) {
			jQuery('#forum_loader').show();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: link+'wp-content/themes/restClub/ajax/user_forum.php',     
				success: function(data)     
				{
					jQuery('#forum_loader').hide();
					jQuery(data).insertAfter('.post_forum_box');
					jQuery('#user_forum_sec').trigger('reset'); 
				}
			});
		}
		
	});	
	
	
	jQuery('.comment').on('keydown', function(e)
	{
        if ((e.keyCode == 13) && (!e.shiftKey)) 
		{
            var comment=jQuery(this).val();
			
			if(comment!="")
			{	
			   
			   var post_id=jQuery(this).attr('data-text');
			   var user_id=jQuery('#curr_user_id').val();
			   jQuery(this).val('');	
			   jQuery.ajax({
					type: "POST", 
					url:link+"wp-content/themes/restClub/ajax/insert_post_comment.php", 
					data:{post_id:post_id,user_id:user_id,comment:comment,format:'raw'}, 
					success:function(resp) 
					{ 
						if( resp !="")
						{
							
							jQuery('.comments_list_'+post_id).empty().append(resp); 
						}
						
					}
			   });
			}    
		 }
    });
	
	
});

function operator_image()
{
	//Get reference of FileUpload.
        var fileUpload = jQuery("#photoimg")[0];

        //Check whether the file is valid Image.
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
        if (regex.test(fileUpload.value.toLowerCase())) {

            //Check whether HTML5 is supported.
            if (typeof (fileUpload.files) != "undefined") {
                //Initiate the FileReader object.
					var reader = new FileReader();
					reader.readAsDataURL(fileUpload.files[0]);
					reader.onload = function (e) 
					{
					var image = new Image();
					image.src = e.target.result;
                    image.onload = function () 
					{
					var height = this.height; 
                    var width = this.width;
												
                        if (width > 1000)  
						{
                            
							alert('Profile Image is higher as expected');
						}
						else
						{
							jQuery('#profile_submit').submit();
						} 	
						
                    };
                }
            } else {
                alert("This browser does not support HTML5.");
               
            }
			} else {
				alert("Please select a valid Image file.");
				
			} 
			
}

function del_user_profile(user_id)
{
	 var user_id;
	 var loader='<img class="upload_prof_loader" src='+link+'wp-content/themes/restClub/images/loader.gif>';
	 jQuery('.user_prof_image').empty().append(loader);	 
	 
	 jQuery.ajax({
		type: "POST", 
		url:link+"wp-content/themes/restClub/ajax/del_user_profile.php", 
		data:{user_id:user_id,format:'raw'},
		success:function(resp){
			if( resp !="")
			{
				if(resp==1)
				{
					jQuery('.user_prof_image').empty().append('<img src="http://placehold.it/200x200&amp;text=No image found">'); 
				}	
			}
			
		}
    });
}


function focus_comment(post_id)
{
	setTimeout(function() {
  jQuery('.comment_'+post_id).focus();
}, 0);
}

function sortby_forum_1()
{
	var post_id=jQuery('#post_id').val();
	var sortby=jQuery('#sortby_forum_1').val();
	jQuery.ajax({
		type: "POST", 
		url:link+"wp-content/themes/restClub/ajax/sortby_forum_1.php", 
		data:{sortby:sortby,post_id:post_id,format:'raw'},
		success:function(resp){
			if( resp !="")
			{
				
				jQuery('.user_days').empty().append(resp);
			}
			
		}
    });
}