    <?php if (!is_front_page()) : ?>
		</div>
	</div>
	<?php endif; ?> 
 
	<div id="footer">
		<div class="wrap">
				                                                       
				<!--<div class="button right"><a href="#">Geeks Click Here!</a></div>--> 
		        <ul class="footer_nav right">
					<?php wp_nav_menu(  array( 'theme_location' => 'footer' ));  ?>                         
				</ul>
				
				<?php 
				$output = array();
				$text_slide = array(
					'n1' => get_option( 'rw2_nice_things1' ),
					'n2' => get_option( 'rw2_nice_things2' ),
					'n3' => get_option( 'rw2_nice_things3' ),
					'n4' => get_option( 'rw2_nice_things4' ),
					'n5' => get_option( 'rw2_nice_things5' )
				);
				if ($text_slide['n1']) {
					$output[] = "<div id=\"testimonials_text\">";
					foreach ($text_slide as $key => $value) {
						if ($value) {							
							$output[] = "	<div>".nl2br($value)."</div>";
						}
					}
					echo "<script type='text/javascript'> jQuery( document ).ready( function($) { $('#testimonials_text').cycle({ timeout: 6000, cleartype: 1, speed: 800, pause:true }); }); </script>";
					$output[] = "</div>";
					echo implode("\n", $output);
				}			
				?>
			
				<div class="copyright left">&copy; <a href="http://companiesopen.org/uk/07149780/rewired-state-ltd">Rewired State Ltd</a></div>  
				
				<div class="clear"></div>
		</div>
	</div>
	
	<?php wp_footer(); ?>
	
</body>