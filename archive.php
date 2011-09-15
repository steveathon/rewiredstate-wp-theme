<?php get_header(); ?>

<div class="content full"> 

	<h2>
		<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: <span>%s</span>', 'twentyten' ), get_the_date() ); ?>
		<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: <span>%s</span>', 'twentyten' ), get_the_date('F Y') ); ?>
		<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: <span>%s</span>', 'twentyten' ), get_the_date('Y') ); ?>
		<?php else : ?>
						<?php _e( 'Blog', 'twentyten' ); ?>
		<?php endif; ?>
	</h2>
                          
<ul class="dbem_events_list">
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<li> 
		<p class="cal"><?php the_time('d'); ?> <span><?php the_time('F Y'); ?></span></p> 
	
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4> 
	
		<p class="excerpt"><?php echo rs_trim(get_the_excerpt(), 260); ?></p> 
		
		<br class="clear" />
	</li>
<?php endwhile; endif; ?>

</ul>
 
</div>

<?php get_footer(); ?>