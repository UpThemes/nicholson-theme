<?php 
// Get the text & url from the first link in the content
$content = get_the_content();
$link_string = extract_from_string('<a href=', '/a>', $content);
$link_bits = explode('"', $link_string);
foreach( $link_bits as $bit ) {
	if( substr($bit, 0, 1) == '>') $link_text = substr($bit, 1, strlen($bit)-2);
	if( substr($bit, 0, 4) == 'http') $link_url = $bit;
}?>

<section class="format-link">
	<h3 class="post-title">
		<a href="<?php echo $link_url;?>" title="<?php _e('External link', 'nicholson');?>">
			<span class="icon">&#128279;</span> <?php if ( $link_text != '' ) { echo $link_text; } else { echo 'You have not provided a link.'; } ?>
		</a>
	</h3>
</section>