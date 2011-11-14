<?php

/**
* Custom Write Panel / Meta Boxes for Custom Post Types
**/
                            
/**
* Events
**/

function rs_add_metabox_events() {
	
	add_meta_box( 'rs_events_metabox', __( 'Event Details', 'rs_textdomain' ), 
	                'rs_metabox_events', 'events', 'normal', 'high' );
}   
add_action('admin_menu', 'rs_add_metabox_events');
                                                
function rs_metabox_events() {
	global $post;
	?>
	<div class="form-wrap rs-form-wrap">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), 'rs_events_wpnonce', false ); ?> 
		<div class="form-field form-required">  
			<label for="rs_date">Event Start:</label>  
			<div>
				<input type="text" id="rs_date" size="20" name="rs_date" value="<?php echo htmlentities(get_post_meta($post->ID, 'date', true)); ?>" />  
				<p>The date of the event. (Required!)</p>
			</div>  
		</div>       
		<div class="form-field form-required">  
			<label for="rs_time">Event Start Time:</label>  
			<div>
				<input type="text" id="rs_time" size="20" name="rs_time" value="<?php echo htmlentities(get_post_meta($post->ID, 'time', true)); ?>" />  
				<p>The time of the event. (24hr clock)</p>
			</div>  
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_end">Event End:</label>  
			<div>
				<input type="text" id="rs_end" size="20" name="rs_end" value="<?php echo htmlentities(get_post_meta($post->ID, 'end', true)); ?>" />  
				<p>If the event spans multiple days, choose the end date here. (Optional)</p>
			</div>  
		</div> 
		<div class="form-field form-required">  
			<label for="rs_time">Event End Time:</label>  
			<div>
				<input type="text" id="rs_end_time" size="20" name="rs_end_time" value="<?php echo htmlentities(get_post_meta($post->ID, 'end_time', true)); ?>" />  
				<p>The end time of the event. (24hr clock)</p>
			</div>  
		</div>
		            
		<script type="text/javascript">
		<!--
		jQuery(document).ready(function($) {
			$('#rs_date, #rs_end').datepicker();
		});                            
		-->
		</script>
		

		
		<div class="form-field form-required">  
			<label for="rs_address">Address:</label>  
			<div>
				<textarea id="rs_address" cols="30" rows="6" name="rs_address"><?php echo htmlentities(get_post_meta($post->ID,'address',true)); ?></textarea>
				<p>The address of the venue.</p>
			</div>                         
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_hashtag">Hashtag:</label>  
			<div>
                        <input type="text" id="rs_hashtag" size="20" name="rs_hashtag" value="<?php echo htmlentities(get_post_meta($post->ID, 'hashtag', true)); ?>" />  
		    	<p>Hashtag for the event (add to twapper, now, too).</p>
			</div>                         
		</div>

		<div class="form-field form-required">  
			<label for="rs_address">Sponsors:</label>  
			<div>
				<textarea id="rs_sponsors" cols="30" rows="6" name="rs_sponsors"><?php echo htmlentities(get_post_meta($post->ID,'sponsors',true)); ?></textarea>
				<p>Any sponsor details to display in the sidebar.</p>
			</div>                         
		</div>                             
		
		<div class="form-field form-required">  
			<label for="rs_gmap">Show Google Map?</label>  
			<div>
				<input type="checkbox" id="rs_gmap" name="rs_gmap" value="1" <?php if (get_post_meta($post->ID,'gmap',true) == 1) { echo 'checked'; } ?> />
				<p>Check the box to show a Google Map of the venue on the event listing.</p>
			</div>                         
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_time">Flickr Tag:</label>  
			<div>
				<input type="text" id="rs_flickr" size="35" name="rs_flickr" value="<?php echo htmlentities(get_post_meta($post->ID, 'flickr', true)); ?>" />  
				<p>Enter a tag to display recent photos in the sidebar.</p>
			</div>  
		</div>
		
		<div style="clear: both;"></div>
	</div>
	<?php
}                   
function rs_save_metabox_events() {
	global $post;
	                                    
	if ($post->post_type != 'events')
		return;
	
	$date = $_POST['rs_date'];
	$end = $_POST['rs_end'];
	$time = $_POST['rs_time'];
	$end_time = $_POST['rs_end_time'];
        $hashtag = $_POST['rs_hashtag'];
	$address = $_POST['rs_address'];
	$gmap = $_POST['rs_gmap'];                   
	$flickr = $_POST['rs_flickr'];
	$sponsors = $_POST['rs_sponsors'];
	
	update_post_meta($post->ID, 'date', $date);                  
	update_post_meta($post->ID, 'time', $time);  
	update_post_meta($post->ID, 'timestamp', strtotime($date .' '. $time));
	
	update_post_meta($post->ID, 'end', $end);    
	update_post_meta($post->ID, 'end_time', $end_time);    
	update_post_meta($post->ID, 'timestamp_end', strtotime($end .' '. $end_time));  

	update_post_meta($post->ID, 'address', $address);
	update_post_meta($post->ID, 'hashtag', $hashtag);
	update_post_meta($post->ID, 'gmap', $gmap);
	update_post_meta($post->ID, 'flickr', $flickr); 
	update_post_meta($post->ID, 'sponsors', $sponsors); 
}   

add_action( 'save_post', 'rs_save_metabox_events' );

/**
* Datasets
**/

function rs_add_metabox_datasets() {
	
	add_meta_box( 'rs_datasets_metabox', __( 'Dataset Details', 'rs_textdomain' ), 
	                'rs_metabox_datasets', 'datasets', 'normal', 'low' );
}   
add_action('admin_menu', 'rs_add_metabox_datasets');
                                                
function rs_metabox_datasets() {
	global $post;
	?>
	<div class="form-wrap rs-form-wrap">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), 'rs_datasets_wpnonce', false ); ?> 
		<div class="form-field form-required">  
			<label for="rs_time">URL:</label>  
			<div>
				<input type="text" id="rs_url" size="80" name="rs_url" value="<?php echo htmlentities(get_post_meta($post->ID, 'url', true)); ?>" />  
				<p>The URL of the dataset.</p>
			</div>  
		</div>
		
		<div style="clear: both;"></div>
	</div>
	<?php
}                   
function rs_save_metabox_datasets() {
	global $post;                      
	
	if ($post->post_type != 'datasets')
		return;
	
	$url = $_POST['rs_url'];
		
	update_post_meta($post->ID, 'url', $url);

}   

add_action( 'save_post', 'rs_save_metabox_datasets');       

/**
* Projects
**/

function rs_add_metabox_projects() {
	
	add_meta_box( 'rs_projects_metabox', __( 'Project Details', 'rs_textdomain' ), 
	                'rs_metabox_projects', 'projects', 'normal', 'low' );
}   
add_action('admin_menu', 'rs_add_metabox_projects');
                                                
function rs_metabox_projects() {
	global $post;
	?>
	<div class="form-wrap rs-form-wrap">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), 'rs_projects_wpnonce', false ); ?> 
		<div class="form-field form-required">  
			<label for="rs_event">Event:</label>  
			<div>
				
				<select name="rs_event" id="rs_event">
				<?php 
					
				$events = new WP_Query('showposts=-1&post_type=events&meta_key=timestamp&orderby=meta_value&order=DESC');
				if ($events->have_posts()) : foreach($events->posts as $evt) : 
				                           
				$selected = '';
				$event_id = get_post_meta($post->ID,'event',true);
				if ($evt->post_name == $event_id) {
					$selected = 'selected';
				}
				
				?>
				<option value="<?php echo $evt->post_name; ?>" <?php echo $selected; ?>><?php echo $evt->post_title; ?></option>
				<?php endforeach; endif; ?>
				</select>
				
				<p>The event where the project was created.</p>
			</div>  
		</div>
		
		
		<div class="form-field form-required">  
			<label for="rs_builders">Build Team:</label>  
			<div>
				<input type="text" id="rs_builders" size="80" name="rs_builders" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'builders', true)); ?>" />  
				<p>The URL of the project.</p>
			</div>  
		</div>

		<div class="form-field form-required">  
			<label for="rs_url">URL:</label>  
			<div>
				<input type="text" id="rs_url" size="80" name="rs_url" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'url', true)); ?>" />  
				<p>The URL of the project.</p>
			</div>  
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_ideas">Ideas:</label>  
			<div>
				<textarea id="rs_ideas" cols="50" rows="6" name="rs_ideas"><?php echo htmlspecialchars(get_post_meta($post->ID,'ideas',true)); ?></textarea>
				<p>Ideas for taking this project forward.</p>
			</div>  
		</div>  
		
		<div class="form-field form-required">  
			<label for="rs_costs">Estimated costs:</label>  
			<div>
				<textarea id="rs_costs" cols="50" rows="6" name="rs_costs"><?php echo htmlspecialchars(get_post_meta($post->ID,'costs',true)); ?></textarea>
				<p>Estimated costs of taking this project forward.</p>
			</div>  
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_data">About the data:</label>  
			<div>
				<textarea id="rs_data" cols="50" rows="6" name="rs_data"><?php echo htmlspecialchars(get_post_meta($post->ID,'data',true)); ?></textarea>
				<p>About the data used in this project.</p>
			</div>  
		</div>                
		
		<div class="form-field form-required">  
			<label for="rs_twitter">Twitter Username:</label>  
			<div>
				<input type="text" id="rs_twitter" size="80" name="rs_twitter" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'twitter', true)); ?>" />  
				<p>Application Twitter username.</p>
			</div>  
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_gh_user">Github Username:</label>  
			<div>
				<input type="text" id="rs_gh_user" size="80" name="rs_gh_user" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'gh_user', true)); ?>" />  
				<p>The name of the GitHub repository owner.</p>
			</div>  
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_gh_repo">Github Repository:</label>  
			<div>
				<input type="text" id="rs_gh_repo" size="80" name="rs_gh_repo" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'gh_repo', true)); ?>" />  
				<p>Name of the GitHub repository.</p>
			</div>  
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_svn">Subversion URL:</label>  
			<div>
				<input type="text" id="rs_svn" size="80" name="rs_svn" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'svn', true)); ?>" />  
				<p>The URL to the Subversion repository.</p>
			</div>  
		</div> 
		
		<div class="form-field form-required">  
			<label for="rs_project_url">Project Code URL:</label>  
			<div>
				<input type="text" id="rs_project_url" size="80" name="rs_project_url" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'project_url', true)); ?>" />  
				<p>Any other project code URL.</p>
			</div>  
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_secret">Secret Word:</label>  
			<div>
				<input type="text" id="rs_secret" size="20" name="rs_secret" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'secret', true)); ?>" />  
				<p>The secret word shared between owners of the project to make changes.</p>
			</div>  
		</div>
		
		<div class="form-field form-required">
			<label for="rs_winner">Winner?:</label>
			<div>
				<input type="text" id="rs_winner" size="20" name="rs_winner" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'winner', true)); ?>" />
				<p>What prize this project won at the Hack day</p>
			</div>
		</div>
		
		<div class="form-field form-required">  
			<label for="rs_spesh">Special Mention?</label>  
			<div>
				<input type="checkbox" id="rs_spesh" name="rs_spesh" value="1" <?php if (get_post_meta($post->ID,'spesh',true) == 1) { echo 'checked'; } ?> />
				<p>Did this project gain a special mention?</p>
			</div>                         
		</div>
		
		<div style="clear: both;"></div>
	</div>
	<?php
}                   
function rs_save_metabox_projects() {
	global $post;                      
	
	if ($post->post_type != 'projects')
		return;
	
   	update_post_meta($post->ID, 'event', $_POST['rs_event']);                        
	update_post_meta($post->ID, 'url', $_POST['rs_url']);
	update_post_meta($post->ID, 'builders', $_POST['rs_builders']);
    update_post_meta($post->ID, 'ideas', $_POST['rs_ideas']);
    update_post_meta($post->ID, 'costs', $_POST['rs_costs']);
    update_post_meta($post->ID, 'data', $_POST['rs_data']); 
	update_post_meta($post->ID, 'twitter', $_POST['rs_twitter']); 
	update_post_meta($post->ID, 'gh_user', $_POST['rs_gh_user']);    
	update_post_meta($post->ID, 'gh_repo', $_POST['rs_gh_repo']);
	update_post_meta($post->ID, 'svn', $_POST['rs_svn']); 
	update_post_meta($post->ID, 'project_url', $_POST['rs_project_url']);
	update_post_meta($post->ID, 'secret', $_POST['rs_secret']);
	update_post_meta($post->ID, 'winner', $_POST['rs_winner']);
    update_post_meta($post->ID, 'spesh', $_POST['rs_spesh']);  
}   

add_action( 'save_post', 'rs_save_metabox_projects');
