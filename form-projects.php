<?php
//
// form-project.php:
//     Rewired State Projects wotsit
//
?>

<?php get_header(); ?>


<?php      

$resp = null;

?>

<?php page_sidebar(); ?>

<div class="content full"> 
  
	<?php if ($action == 'new') : ?>
		<h1>Add your project</h1>
	<?php else : ?>
		<h1>Edit project</h1>
	<?php endif; ?>
	    
	<form action="" class="rs_form" method="POST" name="projects">
		
		<?php if (isset($errors) && count($errors) >= 1) : ?>
			<?php foreach ($errors as $err) : ?>
				<div class="error">
					<?php echo $err; ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		
		<div class="form-field">
			<div class="wrap">
				<label for="rs_event">Event:</label><select name="rs_event" id="rs_event"><?php 
					
				$events = new WP_Query('post_type=events&meta_key=timestamp&orderby=meta_value&order=DESC');
				if ($events->have_posts()) : foreach($events->posts as $evt) : 
					$selected = '';
					if (isset($event) && $event == $evt->post_name) {
						$selected = 'selected';
					}
				?>
				<option value="<?php echo $evt->post_name; ?>" <?php echo $selected; ?>><?php echo $evt->post_title; ?></option>
				<?php endforeach; endif; ?></select>
				<span>At which event did you create it?</span>
			</div>
			<div class="end"></div>
		</div>
		
		<div class="form-field alt">
			<div class="wrap">
				<label for="rs_title">Project Title:</label><input type="text" id="rs_title" value="<?php echo htmlspecialchars($title); ?>" name="rs_title" size="60" />
			</div>
			<div class="end"></div>		
		</div>
		
		<div class="form-field">
			<div class="wrap">
				<label for="rs_builders">Project Builders:</label><input type="text" id="rs_builders" value="<?php echo htmlspecialchars($builders); ?>" name="rs_builders" size="60" />
                                <span>Who was involved in building this project? Names/Twitter handles please</span>
			</div>
			<div class="end"></div>
		</div>

		<div class="form-field alt">
			<div class="wrap">
				<label for="rs_description">Description:</label><textarea id="rs_description" name="rs_description" rows="12"><?php echo htmlspecialchars($description); ?></textarea>
				<span>An overview of your project. You can use <a href="http://daringfireball.net/projects/markdown/syntax" title="Markdown Syntax">Markdown</a> here.</span>
			</div>
			<div class="end"></div>		
		</div>
		
		<div class="form-field">
			<div class="wrap">
				<label for="rs_url">URL:</label><input type="text" id="rs_url" name="rs_url" value="<?php echo htmlspecialchars($url); ?>" size="60" />
				<span>The web address of your project.</span>
			</div>
			<div class="end"></div>		
		</div>
		
		<div class="form-field alt">
			<div class="wrap">
				<label for="rs_ideas">Ideas for taking it forward:</label><textarea id="rs_ideas" name="rs_ideas" rows="12"><?php echo htmlspecialchars($ideas); ?></textarea>
				<span>You can use <a href="http://daringfireball.net/projects/markdown/syntax" title="Markdown Syntax">Markdown</a> here too.</span>
			</div>
			<div class="end"></div>		
		</div>
		
		<div class="form-field">
			<div class="wrap">
				<label for="rs_costs">Estimated costs:</label><textarea id="rs_costs" name="rs_costs" rows="12"><?php echo htmlspecialchars($costs); ?></textarea>
				<span>Any estimated costs for taking your project forward. You can use <a href="http://daringfireball.net/projects/markdown/syntax" title="Markdown Syntax">Markdown</a> here.</span>
			</div>
			<div class="end"></div>		
		</div>
		
		<div class="form-field alt">
			<div class="wrap">
				<label for="rs_data">About the data:</label><textarea id="rs_data" name="rs_data" rows="12"><?php echo htmlspecialchars($data); ?></textarea>
				<span>What data did you use? Was it useful? Could it be improved?<br />Again, you can use <a href="http://daringfireball.net/projects/markdown/syntax" title="Markdown Syntax">Markdown</a> here.</span>
			</div>
			<div class="end"></div>		
		</div> 
		
		<div class="form-field">
			<div class="wrap">
				<label for="rs_gh_user">Github username:</label><input type="text" id="rs_gh_user" name="rs_gh_user" value="<?php echo htmlspecialchars($gh_user); ?>" size="60" />
				<span>If you've made a repository for the project on <a href="http://github.com/" title="GitHub">GitHub</a>, fill in your username here and your repository name below.</span>
			</div>
			<div class="end"></div>		
		</div>     
		
		<div class="form-field alt">
			<div class="wrap">
				<label for="rs_gh_repo">Github repository:</label><input type="text" id="rs_gh_repo" name="rs_gh_repo" value="<?php echo htmlspecialchars($gh_repo); ?>" size="60" />
			</div>
			<div class="end"></div>		
		</div>
		
		<div class="form-field">
			<div class="wrap">
				<label for="rs_svn">Subversion URL:</label><input type="text" id="rs_svn" name="rs_svn" value="<?php echo htmlspecialchars($svn); ?>" size="60" /> 
				<span>If Subversion's more your thing, then enter the URL to your repository here.</span>
			</div>    
			<div class="end"></div>		
		</div> 
		
		<div class="form-field alt">
			<div class="wrap">
				<label for="rs_project_url">Project code URL:</label><input type="text" id="rs_project_url" name="rs_project_url" value="<?php echo htmlspecialchars($project_url); ?>" size="60" />
				<span>If there's any other code repository or tracker you'd like to link to, enter it here.</span>
			</div>
			<div class="end"></div>		
		</div>
		
		<div class="form-field">
			<div class="wrap">
				<label for="rs_twitter">Twitter username:</label><input type="text" id="rs_twitter" name="rs_twitter" value="<?php echo htmlspecialchars($twitter); ?>" size="60" />
				<span>You can add multiple Twitter accounts, separated with commas.</span> 
			</div>    
			<div class="end"></div>		
		</div>  
		
		<?php if ($action == 'new') : ?>
		<div class="form-field">
			<div class="wrap">
				<label for="rs_secret">Secret word:</label><input type="text" id="rs_secret" name="rs_secret" value="<?php echo htmlspecialchars($secret); ?>" size="10" />
				<span>Enter a word to share between the project owners needed to make changes.</span>
			</div>
			<div class="end"></div>		
		</div>
		
		<div class="dummy-form-field recaptcha alt">
			<span>To prove you are human and to help us stop spam, please complete the captcha:</span>
			<?php echo recaptcha_get_html(recaptcha_public_key, $resp->error); ?>	
		</div> 
		<?php endif; ?>
		
		<div class="dummy-form-field recaptcha">
			<?php if ($action == 'new') : ?>
				<input type="submit" name="rs_save" value="Add project" />
			<?php else: ?>
			    <input type="submit" name="rs_save" value="Save project" />
			<?php endif; ?> or <a href="<?php bloginfo('url'); ?>/projects">cancel</a>
		</div>
		
	</form>
 
</div> 

</div>
<div class="clear"></div>

<?php get_footer(); ?>
