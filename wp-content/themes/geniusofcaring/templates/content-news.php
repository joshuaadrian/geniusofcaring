<?php

global $post;

$post_image       = get_the_post_thumbnail_url( $post->ID, 'large' ); 
$post_image_style = $post_image ? 'style="background-image:url(' . $post_image . ');"' : '';

$publication  = get_field('publication', $post->ID);
$link_text    = "Read More";
$link_href    = get_permalink($post->ID);
$link_target  = "_self";
$external_url = get_field('external_url', $post->ID);
$pdf          = get_field('pdf', $post->ID);

if ( $external_url ) :
	$link_href   = $external_url;
	$link_target = "_blank";
elseif ( $pdf ) :
	$link_href   = $pdf;
	$link_target = "_blank";
	$link_text   = "Download PDF";
endif;

?>

<div class="blog-post inview">
	
	<div class="blog-post--inner">

		<a href="<?= $link_href; ?>" target="<?= $link_target; ?>" class="blog-post--link"></a>

		<div class="blog-post--image" <?= $post_image_style; ?>>

			<time class="blog-post--date"><span><?= get_the_date( 'M' ); ?><strong><?= get_the_date( 'j' ); ?></strong></span></time>

		</div>

		<div class="blog-post--content">

			<h2 class="blog-post--title"><?= get_the_title($post->ID); ?></h2>

			<p class="blog-post--more"><span><?= $link_text; ?></span></p>

		</div>

	</div>

</div>