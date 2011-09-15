<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 

<?php          

global $post;
                 
$event_id = rs_custom('event');
$event_q = new WP_Query('post_type=events&name='. $event_id);
$event = $event_q->post->post_title;        

$url = rs_custom('url');
$ideas = rs_custom('ideas');
$costs = rs_custom('costs');
$data = rs_custom('data');
$gh_user = rs_custom('gh_user');
$gh_repo = rs_custom('gh_repo');     
$svn = rs_custom('svn');
$twitter = rs_custom('twitter');     
$code_url = rs_custom('project_url');
 
?>  
<h1><?php the_title(); ?></h1>

<div class="project-left-col">
    
	<?php if ($_GET['created']) : ?>
		<div class="success_box">
			Your project has been created.
		</div>
   	<?php elseif ($_GET['updated']) : ?>
		<div class="success_box">
			Your project has been updated.
		</div>
	<?php endif; ?>
             
	<div class="markdown_box">
		<h3>Description</h3>
	
		<?php echo markdown(htmlspecialchars(get_the_content())); ?>
	</div> 
	
	<div class="markdown_box">
		<h3>Ideas for taking this project forward</h3>
		
		<?php echo markdown($ideas); ?>
	</div> 
	
	<div class="markdown_box">
		<h3>Estimated costs for taking this project forward</h3>
		
		<?php echo markdown($costs); ?>
	</div> 
	
	<div class="markdown_box">
		<h3>About the data used for this project</h3>
		
		<?php echo markdown($data); ?>
	</div> 
	
	<hr />                                   
	                 
	<?php 
	if (!empty($url)) : ?>
	<p class='alt'> 
		Project URL: <a href="<?php echo $url; ?>"><?php echo $url; ?></a> 
	</p>
	<?php endif; ?>
	
	<?php if (!empty($gh_user) && !empty($gh_repo)) : $gh_url = 'http://github.com/'. $gh_user .'/'. $gh_repo; ?>                          
	<p class='code_link'> 
		Github repository: <a href="<?php echo $gh_url; ?>"><?php echo $gh_url; ?></a> 
	</p>	
	<?php endif; ?>
	
	<?php if (!empty($svn)) : ?>
	<p class='alt'> 
		Subversion repository: <a href="<?php echo $svn; ?>"><?php echo $svn; ?></a> 
	</p>
	<?php endif; ?>

	<?php if (!empty($twitter)) : ?>
	<p class="alt">
	   Twitter:
	<?php $twitter_accounts = explode(',', $twitter);
	foreach ($twitter_accounts as $tw_acc) : $tw_acc = trim($tw_acc); ?>
	<?php $twitter_url = 'http://twitter.com/'. $tw_acc; ?>
		<a href="<?php echo $twitter_url; ?>">@<?php echo $tw_acc; ?></a>
	<?php endforeach; ?> 
	</p>
	<?php endif; ?>
	
	<hr />       
	
</div>      
<div class="project-right-col">
	<?php if (!empty($event)) : ?>
		<h4>Created at</h4>
		<p><a href="<?php echo get_permalink($event_q->post); ?>" title="<?php echo $event; ?>"><?php echo $event; ?></a></p>
    <?php endif; ?>

	<h4>Flickr Photos</h4>
	<div class="flickr_list"><?php get_flickrRSS(array(
	    'num_items' => 12, 
	    'type' => 'public', 
	    'tags' => 'rewiredstate:project="'. $post->post_name .'"')); 
	?></div>
	<p class="flickr_tag_hint">Add photos by tagging them with <em>rewiredstate:project="<?php echo $post->post_name?>"</em></p>
	
	<p class="edit_link"><a href="<?php bloginfo('url'); ?>/projects?action=edit&pid=<?php the_ID(); ?>" title="Edit this project">Edit this project.</a></p>                                                       
</div>

<?php endwhile; endif; ?>
 
<br class="clear" />

<?php get_footer(); ?>