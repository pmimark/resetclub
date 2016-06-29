<?php
/**
 * Template Name: File Page
 *
*/

get_header(); 
?>
<div class="form-in-page">
  <div class="container">
    <div class="audio-codes"> 
      <?php while ( have_posts() ) : the_post(); ?>
	  <h2>Reset Your Body Audio-Book</h2>
      <p>Not for sale anywhere else. EXCLUSIVE for Reset Club members!</p>
       <br>
      <?php the_content(); ?>
      <?php endwhile; wp_reset_query(); ?>
	</div> <!--audio-codes--> 
    <hr> 
     <div class="audio-codes"> 
      <h2>Weekly Reset Coaching Webinars</h2>
   
      
      <div class="webinar-semi"> 
        <ul>
           <li><a href="#">Sunday 4 / 17 - 3 Mins</a></li>
           <li><a href="#">Sunday 4 / 10 - 29 Mins</a></li>
           <li><a href="#">Sunday 4 / 17 - 3 Mins</a></li>
           <li><a href="#">Sunday 4 / 10 - 29 Mins</a></li>
           <li><a href="#">Sunday 4 / 17 - 3 Mins</a></li>
           <li><a href="#">Sunday 4 / 10 - 29 Mins</a></li>
           <li><a href="#">Sunday 4 / 17 - 3 Mins</a></li>
           <li><a href="#">Sunday 4 / 10 - 29 Mins</a></li>
        </ul>
      </div> <!--webinar-semi-->
       <input type="button" class="btn btn-default btn-webinor" value="Register for next Coach Webinar">
    </div> <!--audio-codes--> 
    
    <hr>
    
    <div class="audio-codes"> 
      <h2>Files</h2>

      
      <div class="pdf-semi"> 
        <ul>
           <li><a href="#">Earthing Book.pdf (4/10/2016)</a></li>
           <li><a href="#">Earthing Book.pdf (4/10/2016)</a></li>
           <li><a href="#">Earthing Book.pdf (4/10/2016)</a></li>
           <li><a href="#">Earthing Book.pdf (4/10/2016)</a></li>
           <li><a href="#">Earthing Book.pdf (4/10/2016)</a></li>
           <li><a href="#">Earthing Book.pdf (4/10/2016)</a></li>
           <li><a href="#">Earthing Book.pdf (4/10/2016)</a></li>
           <li><a href="#">Earthing Book.pdf (4/10/2016)</a></li>
        </ul>
      </div> <!--webinar-semi-->
    </div> <!--audio-codes--> 
      <hr> 
      
      <div class="audio-codes"> 
      <h2>Links</h2> 

      
      <div class="links-semi"> 
        <ul>
           <li><a href="#">curezone.org - Great Site</a></li>
           <li><a href="#">herboc.com - Good herbs</a></li>
        </ul>
      </div> <!--webinar-semi-->
    </div> <!--audio-codes--> 
  </div>
</div>

<?php 
get_footer(); ?> 
