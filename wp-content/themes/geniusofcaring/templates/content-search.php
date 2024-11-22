<?php

global $post;

$results = [];

while (have_posts()) : the_post();

	$type = get_post_type();
	$parent_title = '';

	if ( $post->post_name == '_footer' ) continue;

	if ( $post->post_parent ) :
		$parent = get_post( $post->post_parent );
		$parent_title = '<small>' . $parent->post_title . ' &rsaquo;</small>';
	endif;

	$output = '<article class="' . implode(' ', get_post_class() ) . '">';
  		$output .= '<header>';
    		$output .= '<h2 class="entry-title"><a href="' . get_permalink() . '">' . $parent_title . get_the_title() . '</a></h2>';
  		$output .= '</header>';
	$output .= '</article>';

	$results[ $type ][] = $output;

endwhile;

echo  '<div class="search--list--wrap">';

$header = '';

foreach ( $results as $key => $value ) :

	if ( $key != $header && empty( $header ) ) :
		$key = $key == 'portfolio' ? 'portfolio companie' : $key;
		echo '<ul class="search--list"><li class="search--header">' . ucwords( $key ) . 's</li><li>' . implode('</li><li>',$value) . '</li>'; 
		$header = $key;
	elseif ( $key != $header ) :
		$key = $key == 'portfolio' ? 'portfolio companie' : $key;
		echo '</ul><ul class="search--list"><li class="search--header">' . ucwords( $key ) . 's</li><li>' . implode('</li><li>',$value) . '</li>'; 
		$header = $key;
	else :
		echo '<li>' . implode('</li><li>',$value) . '</li>';
	endif;

endforeach;

echo  '</div>';

?>
