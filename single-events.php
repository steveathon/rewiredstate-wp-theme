<?php get_header(); ?>

 
  
<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
<?php 
global $post;
$address = get_post_meta($post->ID, 'address', true);
$date = get_post_meta($post->ID, 'timestamp', true);       
$end = get_post_meta($post->ID, 'timestamp_end', true); 
$flickr = get_post_meta($post->ID, 'flickr', true); 
$hashtag = get_post_meta($post->ID, 'hashtag', true);
$lanyrd = get_post_meta($post->ID, 'lanyrd', true);
$sponsors = get_post_meta($post->ID, 'sponsors', true);  
?>

<h1><?php the_title(); ?></h1>  

<div class="event-left-col"> 

	<p class='date'><?php echo date('F d, Y', $date); ?><?php if (!empty($end) && ( date('Dmy', $date) !== date('Dmy', $end) ) ) { echo ' &rarr; '. date('F d, Y', $end); } ?></p>
	                 
	<?php the_content(); ?>

</div>
<div class="event-right-col"> 
	
	<?php if (!empty($date)) : ?>
	<h4>When</h4> 
	  <p><?php echo '<span style="font-size: 15px; color: #444;"> '. date('F d, Y H:i', $date) .'</span>'; ?><?php if (!empty($end) && ( date('Dmy', $date) !== date('Dmy', $end) ) ) { echo '<br /><span style="font-size: 15px; color: #444;"> &rarr; '. date('F d, Y H:i', $end) .'</span>'; } ?></p>
	<?php endif; ?>

	<?php if (!empty($lanyrd)) : ?>
	<h4>Lanyrd</h4>
        <p><a href="<?php echo ($lanyrd); ?>"><?php echo '<span style="font-size: 15px; color: #444;"> '. ($lanyrd) .'</span>'; ?></a></p> 
	<?php endif; ?>

	<?php if (!empty($hashtag)) : ?>
	<h4>Hashtag</h4> 
        <p><a href="https://twitter.com/#!/search/<?php echo ($hashtag); ?>"><?php echo '<span style="font-size: 15px; color: #444;"> '. ($hashtag) .'</span>'; ?></a></p>
	<?php endif; ?>

	<?php if (!empty($address)) : ?>
	<h4>Where</h4> 
	  <address> 
	    <p><?php echo nl2br($address); ?></p>
	  </address>                      
	  <?php if (get_post_meta($post->ID, 'gmap', true)) : ?>
	  <div class="inline-gmap">
		<a href="http://maps.google.co.uk/maps?q=<?php echo urlencode($address); ?>" title="View in Google Maps">
			<img src="http://maps.google.com/maps/api/staticmap?center=<?php echo urlencode(trim($address)); ?>&zoom=14&size=230x200&&markers=color:red|<?php echo urlencode($address); ?>&maptype=roadmap&sensor=false" alt="Google Map" />
		</a>
	  </div>
	  <?php endif; ?><br />
    <?php endif; ?>


	<?php if (!empty($sponsors)) : ?>
	<h4>Sponsors</h4> 
	  <p><?php echo nl2br($sponsors); ?></p>
	<?php endif; ?>       

	<?php if (!empty($flickr)) : ?>
	<h4>Photos</h4>
		<div class="flickr_list"><?php get_flickrRSS(array(
		    'num_items' => 12, 
		    'type' => 'public', 
		    'tags' => $flickr)); 
		?></div>
		<p class="flickr_tag_hint">Add photos from this event by tagging them with <em><?php echo $flickr; ?></em> on Flickr</p>
	<?php endif; ?>
</div>
<?php endwhile; endif; ?>
 
<br class="clear" />

<?php get_footer(); ?>
