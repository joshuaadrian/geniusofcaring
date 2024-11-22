<?php

/**
 * portraits Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'portraits-block-' . $block['id'];

if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'portraits-block';

if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$background_video   = get_field('background_video');
$title   = get_field('title');
$content = get_field('content');
$portraits = get_field('portraits');
$counter = 1;
$output   = '';

if ( have_rows('portraits') ) :

  while ( have_rows('portraits') ) : the_row();

    $thumbnail = get_sub_field('thumbnail');

    $title = get_sub_field('title');
    $link  = get_sub_field('link');

    if ( !empty($link) ) :

      $a_href       = $link['url'];
      $a_title      = $link['title'];
      $a_target     = !empty( $link['target'] ) ? $link['target'] : '_self';
      $attributes   = [];
      $attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
      $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
      $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
      $attributes   = implode( ' ', $attributes );
      $link         = '<a class="portrait--link" ' . $attributes . '></a>';

    endif;

    $output .= '<div class="portrait inview fadeinup">';

        $output .= $thumbnail ? '<div class="portrait--image"><img class="portrait--image--inner" src="'.$thumbnail['sizes']['large'].'" /></div>' : '';

        $output .= $link;

        // $output .= '<div class="portrait--content">';

        //   $output .= '<p>';
        //     $output .= '<span>'.$title.'</span>';
        //   $output .= '</p>';

        // $output .= '</div>';

    $output .= '</div>';

    $counter = $counter + 1;

  endwhile;

endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div class="portraits--video">
  <iframe src="https://player.vimeo.com/video/76979871?background=1" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
  </div>

  <div class="portraits--grid">
    <?= $output; ?>
  </div>

</div>
