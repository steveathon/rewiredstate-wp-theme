<?php
/*
Template Name: Projects List

page-projects.php

*/    
session_start();
       
if (!empty($_GET['action'])) {
	
	$action = $_GET['action'];
	
	if ($action == 'new') {
	    header('Location: http://hacks.rewiredstate.org/events');
	    die();
	}
	
	if ($action !== 'new' && $action !== 'edit') 
		die('invalid action');
	             
	if ($action == 'edit') {
		$project_id = $_GET['pid']; 
		if (empty($project_id) || !is_numeric($project_id)) {
			die('Invalid project ID.');
		}                              
		
		$project = new WP_Query('post_type=projects&p='. $project_id);
		$the_secret = get_post_meta($project_id, 'secret', true); 
		
		if (!$project->have_posts()) {
			die('Project does not exist.');
		}     
		
		if (!empty($_POST['rs_secret_set'])) {
        	$secret = $_POST['rs_secret'];
			if ($secret == $the_secret) {
				$_SESSION['rs_secret'] = $secret;
			} else {
				$errors[] = 'The secret phrase is incorrect.';
			}
		}
		
		if ($_SESSION['rs_secret'] !== $the_secret) {
			require('form-secret.php');
			return;
		}
	}
	                       
	if (!empty($_POST['rs_save']) && ($action == 'edit' || $action == 'new')) {
        
		$event = $_POST['rs_event'];
		$title = $_POST['rs_title'];
                $builders = $_POST['rs_builders'];
		$description = $_POST['rs_description'];
		$url = $_POST['rs_url'];
		$ideas = $_POST['rs_ideas'];
		$costs = $_POST['rs_costs'];
		$data = $_POST['rs_data'];
		$gh_user = $_POST['rs_gh_user'];
		$gh_repo = $_POST['rs_gh_repo'];
		$svn = $_POST['rs_svn'];
		$project_url = $_POST['rs_project_url'];
		$twitter = $_POST['rs_twitter'];
		$secret = $_POST['rs_secret'];
                $winner = $_POST['rs_winner'];
                $spesh = $_POST['rs_spesh'];

		$errors = array();
        
		if ($action == 'new') {
			// captcha
			$resp = recaptcha_check_answer( recaptcha_private_key, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

		 	if (!$resp->is_valid) {
				$errors[] = 'The captcha was incorrect. Please try again.';
			}  
			
			if (empty($secret)) {
				$errors[] = 'The secret phrase cannot be blank.';
			}                    
		}

		if (empty($title)) {
			$errors[] = 'Please enter a title for your project.';
		}                                                        

		if (empty($builders)) {
			$errors[] = 'Please enter who was involved in this project.';
		}                                                        

		if (count($errors) < 1) {
			// ok, insert the project 

			$new_project = array(
				'post_title' => $title,
				'post_content' => $description,
				'post_type' => 'projects',
				'post_status' => 'publish'
                                //post_category => ('hacks', '$HASHTAG', '$YEAR')
			);
			
			if ($action == 'new') {
				$project_id = wp_insert_post($new_project);
				$new_project = get_post($project_id);
            } else {                     
				$new_project['ID'] = $project_id;
				wp_update_post($new_project);
			}

			update_post_meta($project_id, 'event', $event);                     
			update_post_meta($project_id, 'builders', $builders);                     
			update_post_meta($project_id, 'url', $url);
                        update_post_meta($project_id, 'ideas', $ideas);
                        update_post_meta($project_id, 'costs', $costs);
                        update_post_meta($project_id, 'data', $data); 
			update_post_meta($project_id, 'twitter', $twitter); 
			update_post_meta($project_id, 'gh_user', $gh_user);    
			update_post_meta($project_id, 'gh_repo', $gh_repo);
			update_post_meta($project_id, 'svn', $svn); 
			update_post_meta($project_id, 'project_url', $project_url);

                        // Staffers have WP logins so add some extra bits for them:
                        if (is_user_logged_in()) {
                            update_post_meta($project_id, 'winner', $winner);
                            update_post_meta($project_id, 'spesh', $spesh);
                        }
			                                                        
			if ($action == 'new') {
				update_post_meta($project_id, 'secret', $secret);     
				
				$suffix = '?created=true';
			} else {
				$suffix = '?updated=true';
			}

			header('Location: '. get_permalink($project_id) .$suffix);
			return;

		}
		
		// errors - will fallback to new form again
		
	}
	
	if ($action == 'new') {
		require('form-projects.php');
	}
	
	if ($action == 'edit') {

		$pid = $project_id;
		
		if (empty($_POST['rs_save'])) {		                 
			$title = get_the_title($project_id);
            $builders = get_post_meta($project_id, 'builders', true);
			$description = $project->post->post_content;
			$event = get_post_meta($project_id, 'event', true);  
			$url = get_post_meta($project_id, 'url', true);
			$ideas = get_post_meta($project_id, 'ideas', true);
			$costs = get_post_meta($project_id, 'costs', true);
			$data = get_post_meta($project_id, 'data', true);
			$gh_user = get_post_meta($project_id, 'gh_user', true);
			$gh_repo = get_post_meta($project_id, 'gh_repo', true);     
			$svn = get_post_meta($project_id, 'svn', true);
			$twitter = get_post_meta($project_id, 'twitter', true);     
			$project_url = get_post_meta($project_id, 'project_url', true);
		} 
		
		require('form-projects.php');
	}                                
	
	return;
	
}

global $post;
?>
<?php get_header(); ?>
 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  	<?php page_sidebar(); ?>

	<h1><?php the_title(); ?></h1>

	<?php the_content(); ?>

<?php endwhile; endif; ?>          
                                    
<div class="project_add_button">
	<a href="?action=new">Add your project</a>
</div>                                   

<div class="projects_list">  

    <h3 id="social-tv-education"><a href="http://hacks.rewiredstate.org/events/social-tv-education">Rewired State: Social TV — Education</a></h3>
    
    <p>The projects created at <strong>Rewired State: Social TV — Education</strong> can be found on <a href="http://hacks.rewiredstate.org/events/social-tv-education"><strong>hacks.rewiredstate.org</strong></a>.</p>

    <h3 id="lwf-2012"><a href="http://hacks.rewiredstate.org/events/lwf-2012">Learning Without Frontiers 2012</a></h3>
    
    <p>The projects created at <strong>Learning Without Frontiers 2012</strong> can be found on <a href="http://hacks.rewiredstate.org/events/lwf-2012"><strong>hacks.rewiredstate.org</strong></a>.</p>
    
    <h3 id="honda-hack"><a href="http://hacks.rewiredstate.org/event/power-of-minds">Power of Minds Hack</a></h3>
    
    <p>The projects created at the <strong>Honda Power of Minds Hack</strong> can be found on <a href="http://hacks.rewiredstate.org/events/power-of-minds"><strong>hacks.rewiredstate.org</strong></a>.</p>
    
<?php
// get all the events

$events_query = new WP_Query('post_type=events&meta_key=timestamp&showposts=-1&orderby=meta_value&order=desc');

if ($events_query->have_posts()) : foreach ($events_query->posts as $event) : ?> 
    
	<?php
	
	$projects_query = new WP_Query('showposts=-1&post_type=projects&meta_key=event&meta_value='. $event->post_name);
	
	if ($projects_query->have_posts()) : ?>
        <?php
        /* global $post;
        /* $builders = get_post_meta($post->ID, 'builders', true);
        /* $winner = get_post_meta($post->ID, 'winner', true);
        /* $spesh = get_post_meta($post->ID, 'spesh', true); 
        */
        ?>
	
	<h3 id="<?php echo $event->post_name; ?>"><a href="<?php echo get_permalink($event); ?>"><?php echo $event->post_title; ?></a></h3>    
	  
	<ul class="hacks">
		
		<?php while ($projects_query->have_posts()) : $projects_query->the_post(); ?>
        
		<li>
			<div> 
				<div class='<?php echo $post->post_name; ?> span-2'> 
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src='http://s3.amazonaws.com/twitter_production/profile_images/66680232/rs_bigger.png' /></a>
				</div>

				<div class='span-6 last'> 
				    <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4> 

                                    <?php if (!empty($builders)) : ?>
                                        <p>Developed by: <strong><?php echo ($builders); ?></strong></p>
                                    <?php endif; ?>

                                    <?php if (!empty($winner)) : ?> 
                                        <p><strong>Winner!</strong><em><?php echo '<span style="color: #FFD700;">'. ($winner) .'</span>'; ?></em></p>
                                    <?php endif; ?> 

                                    <?php if (get_post_meta($post->ID, 'spesh', true)) : ?>
                                        <p><span style="color: #C0C0C0; font-weight: heavy;">Judges' Special Mention</span></p>
                                    <?php endif; ?> 

				    <p><?php echo rs_trim(get_the_excerpt(), 350); ?></p> 
				</div>   

				<div class="end"></div>
			</div> 
		</li>   
			
		<?php endwhile; ?>
	
	</ul>	
	<?php else: ?>
	
	<?php endif; ?>

<?php endforeach; endif; ?>
 
<div class="project_add_button">
	<a href="?action=new">Add your project</a>
</div>
   
</div>        
</div>
<div class="clear"></div>

                  

<script type="text/javascript">
<!--
	<?php 
	$js_projects = new WP_Query('post_type=projects');
	if ($js_projects->have_posts()) : while ($js_projects->have_posts()) : $js_projects->the_post(); ?>
	jQuery('.<?php echo $post->post_name; ?> img').attach(FirstFlickrTag, 'rewiredstate:project="<?php echo $post->post_name; ?>"');
	<?php endwhile; endif; ?>
-->
</script>

<?php get_footer(); ?>
