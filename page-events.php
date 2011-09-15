<?php
/*
Template Name: Events List
*/
?>
<?php get_header(); ?>
                                     
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<h1><?php the_title(); ?></h1>

	<?php the_content(); ?>

<?php endwhile; endif; ?>          

<h2>Upcoming Events</h2> 
	
<ul class="dbem_events_list"> 
  
	<?php 

	$todays_date = time();
	$upcoming_events = new WP_Query('showposts=-1&post_type=events&meta_key=timestamp&meta_compare=>=&meta_value=' . $todays_date . '&orderby=meta_value&order=ASC'); 

	if ($upcoming_events->have_posts()) : while ($upcoming_events->have_posts()) : $upcoming_events->the_post(); ?>

	<li> 
		<?php                                                     
		global $post;
		$date = get_post_meta($post->ID, 'timestamp', true ); 
		$end = get_post_meta($post->ID, 'timestamp_end', true ); 
		?>
		<p class="cal"><?php 
			if (!empty($end) && (date('Dmy', $date) !== date('Dmy', $end)) && (date('my', $date) == date('my', $end)) ) {
				echo date('d', $date) .' - '. date('d', $end);
			} else { 
				echo date('d',$date); 
			}?> <span><?php echo date('F Y', $date); ?></span></p> 
	
		<h4> 
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
		</h4> 
	
		<p class="excerpt"><?php echo rs_trim(get_the_excerpt(), 260); ?></p> 
		
		<br class="clear" />
	</li> 
	<?php endwhile; endif; ?> 
  
</ul>

<h2>Past Events</h2> 
	
<ul class="dbem_events_list"> 
  
	<?php 
                                   
	$past_events = new WP_Query('showposts=-1&post_type=events&meta_key=timestamp&meta_compare=<=&meta_value=' . $todays_date . '&orderby=meta_value&order=DESC'); 

	if ($past_events->have_posts()) : while ($past_events->have_posts()) : $past_events->the_post(); ?>

	<li> 
		<?php                                                     
		global $post;
		$date = get_post_meta($post->ID, 'timestamp', true ); 
		$end = get_post_meta($post->ID, 'timestamp_end', true ); 
		?>
		<p class="cal"><?php 
			if (!empty($end) && (date('Dmy', $date) !== date('Dmy', $end)) && (date('my', $date) == date('my', $end)) ) {
				echo date('j', $date) .' - '. date('j', $end);
			} else { 
				echo date('j',$date); 
			}?> <span><?php echo date('F Y', $date); ?></span></p> 
	
		<h4> 
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
		</h4> 
	
		<p class="excerpt"><?php echo rs_trim(strip_tags(get_the_excerpt()), 160); ?></p>
		<br class="clear" />
	</li> 
	<?php endwhile; endif; ?> 
  
</ul>

<?php get_footer(); ?>