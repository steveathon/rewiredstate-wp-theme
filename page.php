<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); global $post; ?> 

<?php if (page_has_sidebar($post)) : ?>
<div class="sidebar left">
	
	<div class="inner">
		
        <?php $submenu = hierarchical_submenu($post); ?> 
		                            
		<!-- subpages menu -->
		<h3>In this section</h3> 
		
		<?php echo $submenu; ?>
		
	</div>
	
</div>
<div class="main right"> 
<?php else: ?>
<div class="fullwidth">
<?php endif; ?>  

	<h1><?php the_title(); ?></h1>
                         
	<?php the_content(); ?>
       
</div>
                          
<div class="clear"></div> 

<?php endwhile; endif; ?> 

<?php get_footer(); ?>