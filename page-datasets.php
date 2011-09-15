<?php
/*
Template Name: Data List
*/
?>
<?php get_header(); ?>

<div class="content full"> 
  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2><?php the_title(); ?></h2>

		<?php the_content(); ?>

  	<?php endwhile; endif; ?>          

	<hr />
  
    <?php $departments = get_terms('department','hide_empty=0'); ?>
	<?php foreach($departments as $d) : ?>
		<h2><?php echo $d->name; ?></h2>
		
		<table class='data_sources'> 
		    <col class='title' /> 
		    <col class='description' /> 
		    <?php 
			$query = new WP_Query('department='. $d->slug); 
			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
			
			global $post;
			$url = get_post_meta($post->ID, 'url', true); ?>
			<tr> 
		      <td class='title'><a href="<?php echo $url; ?>"><?php the_title(); ?></a></td> 
		      <td class='description'><?php the_excerpt(); ?></td> 
		    </tr>
			<?php endwhile; endif; ?>  
		  </table>
	<?php endforeach; ?>
 
</div> 

<?php get_footer(); ?>