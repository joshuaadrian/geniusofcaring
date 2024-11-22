<?php

/**
 * image-grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'image-grid-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'image-grid';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$output     = '';
$className .= get_field('layout_options') ? ' is-layout-' . get_field('layout_options') : '';
$count      = 0;

if ( have_rows('icon_grid_items') ) :

  while ( have_rows('icon_grid_items') ) : the_row();

    $background = get_sub_field('background');
    $background = $background ? 'style="background-image:url( ' . $background['sizes']['large'] . ');"' : '';
    $button     = get_sub_field('link') ?: '';
    $copy       = get_sub_field('copy') ? '<small>' . get_sub_field('copy') . '</small>' : '';
    $link       = '';
    $title      = '';
    $class      = '';

    if ( !empty($button) ) :

      $class        = 'has-link';
      $a_href       = $button['url'];
      $a_title      = $button['title'];
      $a_target     = !empty( $button['target'] ) ? $button['target'] : '_self';
      $attributes   = [];
      $attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
      $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
      $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
      $attributes[] = 'class="image-grid-item--link"';
      $attributes   = implode( ' ', $attributes );
      $link         = '<a ' . $attributes . '></a>';
      $title        = '<p><span>' . $a_title . '</span>'.$copy.'</p>';

    endif;

    $output .= '<div class="image-grid-item fadein inview '.$class.'">';
      $output .= !is_admin() ? $link : '';
      $output .= '<div class="image-grid-item--image" '.$background.'></div>';
      $output .= '<div class="image-grid-item--content">'.$title.'</div>';
    $output .= '</div>';

    $count = $count + 1;

  endwhile;

  $className .= ' has-'.$count.'-images';

endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div class="image-grid-items">

    <?= $output; ?>

  </div>

</div>
