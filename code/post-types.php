<?php
        
/**
* Registers Custom Post Types and Taxonomies used in template
**/
                                
function rs_register_events() {

	register_post_type( 'events',
	    array(
	      'labels' => array(
	        'name' => __( 'Events' ),
	        'singular_name' => __( 'Event' ),
			'add_new_item' => __('Add New Event'),
			'edit_item' => __('Edit Event'),
		    'new_item' => __('New Event'),
		    'view_item' => __('View Event'),
		    'search_items' => __('Search Events'),
		    'not_found' =>  __('No events found'),
		    'not_found_in_trash' => __('No events found in Trash'), 
		    'parent_item_colon' => '' 
	      ),
	      'public' => true,                   
		  'show_ui' => true,
	      'rewrite' => array('slug' => 'events'),  
		  'supports' => array('title','editor','excerpt'),
		  'menu_icon' => get_bloginfo('stylesheet_directory') .'/images/icon_events.png',
	    )
	  );                         

}      
add_action('init','rs_register_events');
                                           
/**
* Custom Event Columns
**/

/*

function rs_events_column_structure($columns){
		$columns = array(
			"cb" => '<input type="checkbox" />',
			"title" => "Event Title",
			"datetime" => "Date",
			"address" => "Address",
		);

		return $columns;
}

function rs_events_column_data($column){
		global $post;       
		                                                            
		$start = get_post_meta($post->ID,'timestamp',true);
		$end = get_post_meta($post->ID,'timestamp_end',true);                            
		                                                   
		$datetime = date('D jS M Y, H:i', $start);
		if (!empty($end) && ( date('Dmy', $start) !== date('Dmy', $end)) ) {
			$datetime .= ' &rarr; '. date('D jS M Y, H:i', $end);
		}

		
		switch ($column)
		{
			case "datetime":
				echo $datetime;
				break;
			case "address":
				echo htmlentities(get_post_meta($post->ID,'address',true));
				break;
		}
}
         
add_filter("manage_edit-events_columns", "rs_events_column_structure");
add_action("manage_posts_custom_column",  "rs_events_column_data");    
                                                                      

function restrict_manage_events_sort_by_date() {
    if (isset($_GET['post_type'])) {
        $post_type = $_GET['post_type'];
        if (post_type_exists($post_type) && $post_type=='events') {
            global $wpdb;
            $sql=<<<SQL
SELECT pm.meta_key FROM {$wpdb->postmeta} pm
INNER JOIN {$wpdb->posts} p ON p.ID=pm.post_id
WHERE p.post_type='events' AND pm.meta_key='timestamp'
GROUP BY pm.meta_key
ORDER BY pm.meta_key
SQL;
            $results = $wpdb->get_results($sql);
        }
    }
}                            

function sort_events_by_meta_value($query) {
    global $pagenow;
    if (is_admin() && $pagenow=='edit.php' &&
            isset($_GET['post_type']) && $_GET['post_type'] =='events')  {
        $query->query_vars['orderby'] = 'meta_value'; 
		$query->query_vars['order'] = 'desc'; 
        $query->query_vars['meta_key'] = 'timestamp';
    }
}                       

                                                                                              
add_action('restrict_manage_posts','restrict_manage_events_sort_by_date');     
add_filter('parse_query', 'sort_events_by_meta_value' );


*/

function rs_register_projects() {

	register_post_type( 'projects',
	    array(
	      'labels' => array(
	        'name' => __( 'Projects' ),
	        'singular_name' => __( 'Project' ),
			'add_new_item' => __('Add New Project'),
			'edit_item' => __('Edit Project'),
		    'new_item' => __('New Project'),
		    'view_item' => __('View Project'),
		    'search_items' => __('Search Projects'),
		    'not_found' =>  __('No projects found'),
		    'not_found_in_trash' => __('No projects found in Trash'), 
		    'parent_item_colon' => ''
	      ),
	      'public' => true,                   
		  'show_ui' => true,
	      'rewrite' => array('slug' => 'projects'),
		  'supports' => array('title','editor','excerpt','custom-fields'),
		  'menu_icon' => get_bloginfo('stylesheet_directory') .'/images/icon_projects.png',
	    )
	  );

}      
add_action('init','rs_register_projects');                     
                                                 
function rs_disable_editor($function) {
	global $post;
	if ($post->post_type == 'projects') {
		return false;
	}                
	return true;
}               
add_filter('user_can_richedit','rs_disable_editor');
