<footer class="content-info" role="contentinfo">

	<?php

	$footer_page = get_page_by_path( '_Footer' );

	if ( $footer_page ) :

		$footer_content_id = get_page( $footer_page );
		echo do_shortcode(do_blocks(do_shortcode($footer_content_id->post_content)));

	endif;

	?>

</footer>

<?php get_template_part('templates/search'); ?>
<?php get_template_part('templates/disclaimer'); ?>
