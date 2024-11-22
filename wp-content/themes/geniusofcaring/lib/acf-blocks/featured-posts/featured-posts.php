<?php

/**
 * featured-posts Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$block_id = 'featured-posts-' . $block['id'];
if( !empty($block['anchor']) ) {
    $block_id = $block['anchor'];
}
$className = [];
// Create class attribute allowing for custom "className" and "align" values.
$className[] = 'featured-posts';
if( !empty($block['className']) ) {
    $className[] = ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className[] = ' align' . $block['align'];
}

$counter     = 1;
$col_counter = 1;
$posts       = get_field('posts');

if ( empty($posts) ) :

  $include_category   = get_field('include_category') ?: false;
  $exclude_category   = get_field('exclude_category') ?: false;
  $post_taxonomy_args = [];
  $post_args          = ['numberposts' => 2,'order' => 'DESC', 'orderby' => 'date' ];

  if ( $include_category ) :
    $post_taxonomy_args[] = [
      'taxonomy' => 'category',
      'terms'    => $include_category,
      'operator' => 'IN'
    ];
  endif;

  if ( $exclude_category ) :
    $post_taxonomy_args[] = [
      'taxonomy' => 'category',
      'terms'    => $exclude_category,
      'operator' => 'NOT IN'
    ];
  endif;

  if ( !empty($post_taxonomy_args) ) :
    $post_args['tax_query'] = $post_taxonomy_args;
  endif;

  $posts = get_posts($post_args);

endif;

$post_items = '';

if ( $posts ) : foreach ( $posts as $p ) :

  $id          = $p->ID;
  $target      = "_self";
  $link        = get_permalink($id);
  $link_text   = 'Read Article';
  $cats_output = [];
  $cats        = wp_get_post_terms( $id, 'category' );

  if ( !is_wp_error($cats) ) :

    foreach ($cats as $cat) :
      $cats_output[] = $cat->name;
    endforeach;

    $cats_output = '<small>' . implode(', ', $cats_output) . '</small>';

  endif;

  if ( get_field('pdf', $id) ) :

    $link      = get_field('pdf', $id);
    $link      = $link['url'];
    $target    = "_blank";

  endif;

  if ( get_field('external_url', $id) ) :

    $link      = get_field('external_url', $id);
    $target    = "_blank";

  endif;

  $class = '';

  if ( strpos($link, 'vimeo' ) !== false || strpos($link, 'youtube' ) !== false ) :
    $class = 'is-video';
  endif;

  $image_id    = get_post_thumbnail_id($id);
  $image       = $image_id ? wp_get_attachment_image_src( $image_id, 'large' ) : '';
  $image       = $image_id ? '<div class="featured-post--image"><div style="background-image:url('.$image[0].');"><a aria-label="'.get_the_title($id).'" href="'.$link.'" target="'.$target.'"></a></div></div>' : '';

  $post_items .= '<div class="featured-post '.$class.'">';

    $post_items .= '<div class="featured-post--content">';

      $post_items .= $image;

      $post_items .= '<div class="featured-post--inner">';

        $post_items .= !is_admin() ? '<a aria-label="'.get_the_title($id).'" class="featured-post--link" href="'.$link.'" target="'.$target.'"></a>' : '';

        

        $post_items .= '<h3 class="featured-post--title">';

            $post_items .= get_the_title($id);

        $post_items .= '</h4>';

        $post_items .= '<p class="featured-post--meta"><span class="featured-post--date">' . get_the_date('F j, Y', $id) . '</span></p>';

      $post_items .= '</div>';

      //$post_items .= get_the_excerpt($id) ? wpautop(get_the_excerpt($id)) : '';

    $post_items .= '</div>';

  $post_items .= '</div>';

endforeach; endif;

?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr(implode(' ', $className ) ); ?>">

  <div class="featured-posts--grid">

    <?= $post_items; ?>

  </div>

</div>
