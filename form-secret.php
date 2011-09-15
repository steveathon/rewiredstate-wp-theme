<?php get_header(); ?>

<?php page_sidebar(); ?>

<div class="content full"> 
  
	<h1>Edit project</h1>
		    
	<form action="" class="rs_form" method="POST" name="project-secret">
		
		<?php if (isset($errors) && count($errors) >= 1) : ?>
			<?php foreach ($errors as $err) : ?>
				<div class="error">
					<?php echo $err; ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		
		<div class="dummy-form-field recaptcha alt">
			<span>To edit this project, please enter this project's secret phrase:</span>
			<p><input type="text" name="rs_secret" size="20" /></p>	
		</div> 
		
		<div class="dummy-form-field recaptcha">
			<input type="submit" name="rs_secret_set" value="Continue" />
			or <a href="<?php bloginfo('url'); ?>/projects">cancel</a>
		</div>
		
	</form>
 
</div> 

</div>
<div class="clear"></div>

<?php get_footer(); ?>