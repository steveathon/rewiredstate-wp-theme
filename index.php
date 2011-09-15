<?php get_header(); ?>

<div id="intro">
	<div class="wrap">
		<div id="welcome" class="left">
			<h1 id="logo">Rewired State</h1>
			<p id="strapline">Coding a Better Country</p>
			
			<?php 
			$output = array();
			$text_slide = array(
				'p1' => get_option( 'rw2_hometext' ),
				'p2' => get_option( 'rw2_hometext2' ),
				'p3' => get_option( 'rw2_hometext3' )			
			);
			if ($text_slide['p1']) {
				echo "<script type='text/javascript'> jQuery( document ).ready( function($) { $('#homepage_text').cycle({ fx:'scrollDown', timeout: 12000, cleartype: 1, speed: 800, pause:true }); }); </script>";
				$output[] = "<div id=\"homepage_text\">";
				foreach ($text_slide as $key => $value) {
					if ($value) {
						$output[] = "	<div>".nl2br($value)."</div>";
					}				
				}
				$output[] = "</div>";
				echo implode("\n", $output);
			}			
			?>
			
		</div>
		
		
		
		<div id="image_rotate">
			<ul><?php
			     
			$carousel_directory = TEMPLATEPATH . '/images/carousel/';
			$carousel_url = get_bloginfo('template_url') .'/images/carousel/';
			
			if ($directory = opendir($carousel_directory)) {
			    while (($file = readdir($directory)) !== false) {
		            if (preg_match('/^(carousel[0-9]+\.jpg)$/', $file)) {
			        	echo '<li><img src="'. $carousel_url . $file .'" alt="'. $file .'" /></li>'; 
					}
		        }
		        closedir($directory);
		    } 
			
			?></ul>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>