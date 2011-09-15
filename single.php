<?php get_header(); ?>

<div class="content full"> 
  
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<h2><?php the_title(); ?></h2>
    
	<div class="meta">Posted by <?php the_author(); ?> on <?php the_date(); ?></div>
                     
	<?php the_content(); ?> 
	
	<div class="post-navigation">
		<div class="previous"><?php previous_post_link( ); ?></div>
		<div class="next"><?php next_post_link( ); ?></div>
		<div class="end"></div>
	</div>

<?php endwhile; endif; ?>
 
</div>

<?php get_footer(); ?>