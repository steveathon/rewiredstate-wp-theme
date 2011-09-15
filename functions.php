<?php
                         
/**
* Includes
**/

$code_dir = TEMPLATEPATH . '/code/';

require $code_dir . 'post-types.php';
require $code_dir . 'meta-boxes.php';  
                             
// bundled libraries
require $code_dir . 'flickrrss.php';
require $code_dir . 'markdown.php';
require $code_dir . 'recaptchalib.php';  

define('recaptcha_public_key','6LdFPr0SAAAAAP4G_VZPobwbw167ODrZm6pvkzvj');
define('recaptcha_private_key','6LdFPr0SAAAAAPDGJbEwc1qzIOFJVVvq64KHyr5h');


/**********************************
 *  Options page for the theme
 **********************************/

// theme options
$options = array (

  array(	
  	"name" => "<strong>Text on the homepage</strong>",
	"id" => "rw2_hometext",
	"default" => ""),
  array(	
  	"name" => "<strong>Text on the homepage</strong>",
	"id" => "rw2_hometext2",
	"default" => ""),
  array(	
  	"name" => "<strong>Text on the homepage</strong>",
	"id" => "rw2_hometext3",
	"default" => ""),
  
  array(	
  	"name" => "<strong></strong>",
	"id" => "rw2_nice_things1",
	"default" => ""),
  array(	
  	"name" => "<strong>Text on the homepage</strong>",
	"id" => "rw2_nice_things2",
	"default" => ""),
  array(	
  	"name" => "<strong>Text on the homepage</strong>",
	"id" => "rw2_nice_things3",
	"default" => ""),
  array(	
  	"name" => "<strong>Text on the homepage</strong>",
	"id" => "rw2_nice_things4",
	"default" => ""),
  array(	
  	"name" => "<strong>Text on the homepage</strong>",
	"id" => "rw2_nice_things5",
	"default" => ""),
   
);


function rw2_options() {
  global $options;

  if ('theme_save'== $_REQUEST['action'] ) {
  
    foreach ($options as $value) {
     if( !isset( $_REQUEST[ $value['id'] ] ) ) {  } else { update_option( $value['id'], stripslashes($_REQUEST[ $value['id']])); } }
     if(stristr($_SERVER['REQUEST_URI'],'&saved=true')) {
     $location = $_SERVER['REQUEST_URI'];
    } else {
     $location = $_SERVER['REQUEST_URI'] . "&saved=true";
    }
    
  	header("Location: $location");
  	die;
    
  } else if('theme_reset' == $_REQUEST['action'] ) {
 
    foreach ($options as $value) {
     delete_option( $value['id'] );
     $location = $_SERVER['REQUEST_URI'] . "&reset=true";
    }
    
  	header("Location: $location");
  	die;
    
  }
  
  add_theme_page('Rewired State Options', 'Rewired State Theme Options', 10, 'rw2-settings', 'rw2_admin');
}

function rw2_admin() {
    global $options;
?>
<div class="wrap">
  <h2 class="alignleft">Rewired State Theme Options</h2>
  <br clear="all" />
  
  <p>These are the paragraphs of text that appear on the homepage and footer.</p>
  
  <p>To disable these features then simply delete all text in the boxes and click save.</p>
  
  <?php 
  	//Check if settings saved!
  	if ( $_REQUEST['saved'] ) {
  ?>
  		<div class="updated fade"><p><strong>Setting Saved</strong></p></div>
  <?php } ?>

<form method="post" id="myForm">
<div id="poststuff" class="metabox-holder">
 
 <!-- BEGIN AEXT Configuration -->
 <div class="stuffbox">
  <h3>Paragraphs on the homepage</h3>
  
  <div class="inside">
	  
	  <p style="font-size:12px;margin-top:15px;">You can have up to three paragraphs of text that fade into one another.</p>
	  
	  <p style="font-size:12px;">If you only have one paragraph of text then it will be static and not fade.</p>
	  
	  <p style="font-size:12px;"><strong>Note:</strong> you can add raw HTML here.</p>
	  
    <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['id'] ) {
        case "rw2_hometext": ?>
        <tr>
          <th scope="row" style="width:135px">
        	<strong>Homepage text Slide 1</strong>        	
          </th>
          <td>
         	<textarea class="code" rows="8" cols="100" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print trim(get_option($value['id'])); ?></textarea>
          </td>
        </tr>

      <?php break;
      
      case "rw2_hometext2": ?>
        <tr>
          <th scope="row" style="width:135px">
        	<strong>Homepage text Slide 2</strong>        	
          </th>
          <td>
         	<textarea class="code" rows="8" cols="100" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print trim(get_option($value['id'])); ?></textarea>
          </td>
        </tr>

      <?php break;
      
      case "rw2_hometext3": ?>
        <tr>
          <th scope="row" style="width:135px">
        	<strong>Homepage text Slide 3</strong>        	
          </th>
          <td>
         	<textarea class="code" rows="8" cols="100" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print trim(get_option($value['id'])); ?></textarea>
          </td>
        </tr>

      <?php break;
		}
	}
	?>
   </table>
  </div>
  
  <br>
  <br>
  
  <h3>Nice things people have said</h3>
  
  <div class="inside">
	  
	  <p style="font-size:12px;margin-top:15px;">There can be up to 5 things here, each should be around 140-180 characters ideally.</p>
	  
	  <p style="font-size:12px;"><strong>Note:</strong> you can add raw HTML here.</p>
	  
    <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['id'] ) {
        
        case "rw2_nice_things1": ?>
        <tr>
          <th scope="row" style="width:135px">
        	<strong>Nice things people have said 1</strong>        	
          </th>
          <td>
         	<textarea class="code" rows="3" cols="100" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print trim(get_option($value['id'])); ?></textarea>
          </td>
        </tr>

      <?php break;
      case "rw2_nice_things2": ?>
        <tr>
          <th scope="row" style="width:135px">
        	<strong>Nice things people have said 2</strong>        	
          </th>
          <td>
         	<textarea class="code" rows="3" cols="100" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print trim(get_option($value['id'])); ?></textarea>
          </td>
        </tr>

      <?php break;
      case "rw2_nice_things3": ?>
        <tr>
          <th scope="row" style="width:135px">
        	<strong>Nice things people have said 3</strong>        	
          </th>
          <td>
         	<textarea class="code" rows="3" cols="100" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print trim(get_option($value['id'])); ?></textarea>
          </td>
        </tr>
      <?php break;
      case "rw2_nice_things4": ?>
        <tr>
          <th scope="row" style="width:135px">
        	<strong>Nice things people have said 4</strong>        	
          </th>
          <td>
         	<textarea class="code" rows="3" cols="100" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print trim(get_option($value['id'])); ?></textarea>
          </td>
        </tr>
      <?php break;
      case "rw2_nice_things5": ?>
        <tr>
          <th scope="row" style="width:135px">
        	<strong>Nice things people have said 5</strong>        	
          </th>
          <td>
         	<textarea class="code" rows="3" cols="100" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print trim(get_option($value['id'])); ?></textarea>
          </td>
        </tr>
      <?php break;
		}
	}
	?>
   </table>
  </div>
 </div>  
 <!-- END AEXT Configuration -->
</div>
<input name="theme_save" type="submit" class="button-primary" value="Save changes" />
<input type="hidden" name="action" value="theme_save" />
</form>

<form method="post">
<input name="theme_reset" type="submit" class="button-primary" value="Reset" />
<input type="hidden" name="action" value="theme_reset" />
</form>


</div>
<?php
}

add_action('admin_menu', 'rw2_options');


// end

/**
* Register Theme Support
**/

add_action('init', 'rs_init');
 
function rs_init() {
	
	// enqueue scripts
	if (is_admin()) {  
		
		wp_enqueue_script('jquery-ui-datepicker', 
			get_bloginfo('template_directory') .'/js/admin/datepicker.js', 
			array('jquery','jquery-ui-core'), 
			'1.7.3'
		);
	} else {
		
		wp_enqueue_script('jquery-lowpro', 
			get_bloginfo('template_directory') .'/js/lowpro.jquery.js',
			array('jquery'),
			'1.0'
		);
		
		wp_enqueue_script('jquery-easing', 
			get_bloginfo('template_directory') .'/js/jquery.easing.1.1.js',
			array('jquery'),
			'1.1'
		);
		
		wp_enqueue_script('jquery-cycle', 
			get_bloginfo('template_directory') .'/js/jquery.cycle.all.min.js',
			array('jquery'),
			'1.0'
		);
		
		wp_enqueue_script('jquery-tweet', 
			get_bloginfo('template_directory') .'/js/jquery.tweet.js',
			array('jquery'),
			'1.0'
		);
		
		wp_enqueue_script('jquery-innerfade', 
			get_bloginfo('template_directory') .'/js/jquery.innerfade.js',
			array('jquery'),
			'1.0'
		);      
		
		wp_enqueue_script('rewired-state', 
			get_bloginfo('template_directory') .'/js/rewiredstate.js',
			array('jquery','jquery-lowpro','jquery-easing','jquery-cycle','jquery-tweet','jquery-innerfade'),
			'1.0'
		);
		
	}
	
	// register nav menus
	
	register_nav_menus( array(
		'main' => __('Header'),
		'footer' => __('Footer')
	));       
	
	add_editor_style();
	
}         

function rs_admin_css() {
	echo '<link href="'. get_bloginfo('template_directory') .'/js/admin/ui-styles.css" rel="stylesheet" type="text/css" />';
}                                                                                    
add_action('admin_head','rs_admin_css');

              
/**
* Menu Separator Hack
**/

function rs_admin_menu_separator() {
	global $menu;                                                                                   
	array_splice($menu, 7, 0, array( array( '', 'read', 'separator3', '', 'wp-menu-separator' ) ) );      
}                                                                                           

add_action('_admin_menu','rs_admin_menu_separator');         

/**
* Custom Field Accessor
**/

function rs_custom($field, $sanitize = true) {
	global $post;
	$value = get_post_meta($post->ID, $field, true);
	if ($sanitize == true) {
		return htmlspecialchars($value);
	} else {
		return $value;
	} 
}         

/**
* Trim Excerpts
**/

function rs_trim($string, $length, $append = '...')
{   
	$total = 0;
    $sub = '';
    
    foreach (explode(' ', $string) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $total += strlen($part);
        
        if (strlen($word) > 3 && strlen($sub) >= $length)
        {
            break;
        }
    }
    
    return $sub . (($total < strlen($string)) ? $append : '');
}                  

/**
 * Remove UL from menu
 **/
function remove_ul ( $menu ){
    return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
}
add_filter( 'wp_nav_menu', 'remove_ul' );

/**
 * Subpage Hack for Sidebar
 **/                         
function page_sidebar() {
	global $post;                   
	
	if (page_has_sidebar($post)) : ?>
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
	<?php endif;
}
function page_has_sidebar($post) {
	$children = get_pages('child_of=' . $post->ID . '&parent=' . $post->ID . '&sort_column=menu_order&sort_order=ASC');
	if (!empty($post->post_parent) || $children) {
		return true;
	}               
	return false;
}   
function hierarchical_submenu($post) {
    $top_post = $post;
    // If the post has ancestors, get its ultimate parent and make that the top post
    if ($post->post_parent && $post->ancestors) {
        $top_post = get_post(end($post->ancestors));
    }
    // Always start traversing from the top of the tree
    $menu = '<ul>';
	$menu .= '<li class="current"><a href="'. get_permalink($top_post) . '" class="current">' . $top_post->post_title . '</a>';
	$menu .= hierarchical_submenu_get_children($top_post, $post);                                                    
	$menu .= '</li></ul>';
	
	return $menu;
}

function hierarchical_submenu_get_children($post, $current_page) {
    $menu = '';
    // Get all immediate children of this page
    $children = get_pages('child_of=' . $post->ID . '&parent=' . $post->ID . '&sort_column=menu_order&sort_order=ASC');
    if ($children) {
        $menu = "\n<ul>\n";
        foreach ($children as $child) {
            // If the child is the viewed page or one of its ancestors, highlight it
            if (in_array($child->ID, get_post_ancestors($current_page)) || ($child->ID == $current_page->ID)) {
                $menu .= '<li class="sel"><a href="' . get_permalink($child) . '" class="sel">' . $child->post_title . '</a>';
            } else {
                $menu .= '<li><a href="' . get_permalink($child) . '">' . $child->post_title . '</a>';
            }
            // If the page has children and is the viewed page or one of its ancestors, get its children
            if (get_children($child->ID) && (in_array($child->ID, get_post_ancestors($current_page)) || ($child->ID == $current_page->ID))) {
                $menu .= hierarchical_submenu_get_children($child, $current_page);
            }
            $menu .= "</li>\n";
        }
        $menu .= "</ul>\n";
    }
    return $menu;
}  
