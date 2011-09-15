

<?php
get_header(); ?>

<h1>AVAST YE!</h1>

<h1>HERE BE DRAGYNS</h1>

<hr>

<div class="404_image" style="float:left;width:600px;padding-right:45px;">
	
	<img class="404_image_pic" style="cursor:pointer" src="http://rewiredstate.org/wp-content/themes/rewiredv3/images/404.jpg" style="border: 4px solid #FFFFFF;padding: 0;">
	<br>
	<a href="http://www.bl.uk/magnificentmaps/map1.html" target="_blank">Credit to http://www.bl.uk/</a>

</div>

<div class="404_whatwedo" style="float:right;width:300px;">

	<h2 style="line-height:1.4">Useful Links</h2>
	
	<ul>
		<?php 
		//$mylink = $wpdb->get_row("SELECT * FROM $wpdb->links WHERE link_id = 10", ARRAY_A);
		//<li>Next event (this should be pulled from the database): <a href="..." alt="title, date">Event Title</a></li>
		?>
		
	    <li><a href="http://rewiredstate.org/what">What We Do</a></li>
	    <li><a href="http://rewiredstate.org/hire-us">Contact Us</a></li>
	</ul>
	
	<br>

	<div class="404_search_hide" style="display:none;">
		
		<hr>
		
		<h2 style="line-height:1.4">Search REWIRED</h2>
				
		<?php get_search_form(); ?>
	</div>
	
</div>


<br class="clear">
<br class="clear">



	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>
<script type='text/javascript'> 
jQuery('.404_image_pic').click(function() {
	jQuery('.404_search_hide').fadeIn('slow', function() {
      // Animation complete
    });
  });
</script>