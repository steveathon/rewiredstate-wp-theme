<!doctype html>
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	
	
	<title>Rewired State <?php wp_title('-',true,''); ?></title>
	
	<!-- import stylesheet -->                                                                                            
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	
	<!-- javascripts -->
  	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
 
  	<link rel="icon" href="/favicon.ico" type="image/x-icon" /> 
  	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />  

	<?php wp_head(); ?>
 
  
</head> 
<body>
	<!-- full width header -->
	<div id="header">        
		<div class="wrap">
			<?php if (is_front_page()) : ?>
			
			<div class="twitter_bird left">
				<a href="http://twitter.com/rewiredstate/" ><img src="/wp-content/themes/rewiredv3/images/twitter.png" title="Follow Us!"></a>
			</div>
			<div class="twitter left"></div>
			<?php endif; ?>
			
			<h1 id="logo" <?php if (is_front_page()) : ?>style="display: none;"<?php endif; ?>><a href="<?php bloginfo('url'); ?>" title="Rewired State Homepage">Rewired State</a></h1>
		  	<ul id="navigation">                       
				<!--<li<?php if (is_front_page()) : ?> class="selected" <?php endif; ?>><a href="<?php bloginfo('url'); ?>">Home</a></li>-->
				<?php wp_nav_menu(  array( 'container' => false, 'theme_location' => 'main' ));  ?>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
    
	<?php if (!is_front_page()) : ?>
	<div id="content">              
		<div class="wrap">
	<?php endif; ?>