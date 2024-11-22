<?php

/**
 * featured-case-studies Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$block_id = 'featured-case-studies-' . $block['id'];

if( !empty($block['anchor']) ) {
    $block_id = $block['anchor'];
}

$className = 'featured-case-studies';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$settings                    = [];
$transition_speed            = get_field('transition_speed') ?: 1500;
$settings['autoPlay']        = false;
$settings['pageDots']        = false;
$settings['prevNextButtons'] = true;
$settings['wrapAround']      = true;
$settings['adaptiveHeight']  = false;
$settings['imagesLoaded']    = true;
$settings['cellAlign']       = 'left';
$settings['groupCells']      = true;
$settings                    = json_encode($settings);
$posts       = get_field('posts');
$output      = '';

if ( $posts ) : foreach ( $posts as $p ) :

  $id          = $p->ID;
  $target      = "_self";
  $link        = get_permalink($id);
  $link_text   = 'Read Article';
  $cats_output = [];
  $cats        = wp_get_post_terms( $id, 'case_studies_industries' );

  $images            = get_field('images',$id);
  $hero              = $images['hero'] ? '<div class="case-study--slide--hero" style="background-image:url(' . $images['hero']['sizes']['xlarge'] . ')"></div>' : '';
  $content           = get_field('content',$id);
  $headline          = $content['headline'] ? '<h4 class="case-study--slide--headline">' . $content['headline'] . '</h4>' : '';
  $short_description = $content['short_description'] ? '<div class="case-study--slide--short-description">' . wpautop($content['short_description']) . '</div>' : '';

  if ( !is_wp_error($cats) ) :

    foreach ($cats as $cat) :
      $cats_output[] = $cat->name;
    endforeach;

    $cats_output = '<small>' . implode(', ', $cats_output) . '</small>';

  endif;

  $output .= '<div class="case-study--slide">';

    $output .= $hero;

    $output .= '<div class="case-study--slide--content">';

      $output .= '<div class="case-study--slide--categories">';

        $output .= '<ul>';

          $output .= '<li>Lorem Ipsum</li>';
          $output .= '<li>Lorem Ipsum</li>';
          $output .= '<li>Lorem Ipsum</li>';
          $output .= '<li>Lorem Ipsum</li>';
          $output .= '<li>Lorem Ipsum</li>';
          $output .= '<li>Lorem Ipsum</li>';
          $output .= '<li>Lorem Ipsum</li>';

        $output .= '</ul>';

      $output .= '</div>';

      $output .= '<div class="case-study--slide--copy">';

        $output .= '<p class="has-text-color big has-pink-400-color"><strong>Case Study</strong></p>';

        $output .= $headline;

        $output .= $short_description;

      $output .= '</div>';

    $output .= '</div>';

  $output .= '</div>';

endforeach; endif;

?>

<div id="<?= esc_attr($block_id); ?>" class="<?= esc_attr($className); ?>">

  <div id="featured-case-studies--slider-<?= $block['id']; ?>" class="featured-case-studies--slider" data-settings='<?= $settings; ?>'>

    <?= $output; ?>

  </div>

</div>
