<?php

/**
 * responsive-slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'responsive-slider-' . $block['id'];

if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'responsive-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$className .= get_field('wrap_onto_multiple_rows') ? ' is-wrapping' : '';
$output = '';

$settings                    = [];
$transition_speed            = get_field('transition_speed') ?: 1500;
$settings['autoPlay']        = get_field('autoplay') ? true : false;
$settings['autoPlay']        = $transition_speed ? $transition_speed : $settings['autoPlay'];
$settings['pageDots']        = get_field('show_pagination') ? true : false;
$settings['fade']            = get_field('fade') ? true : false;
$settings['prevNextButtons'] = get_field('show_navigation_arrows') ? true : false;
$settings['wrapAround']      = get_field('wrap_around') ? true : false;
$settings['adaptiveHeight']  = get_field('adaptive_height') ? true : false;
$settings['imagesLoaded']    = true;
$settings['cellAlign']       = 'left';
$settings['groupCells']      = true;
$settings                    = json_encode($settings);

$gutter = get_field('gutter_width') ?: 0;

if ( have_rows('slides') ) :

  while ( have_rows('slides') ) : the_row();

    $styles       = [];
    $copy         = get_sub_field('slide_copy') ? wpautop( get_sub_field('slide_copy') ) : '';
    $image        = get_sub_field('slide_image') ?: '';
    $image_sizing = get_sub_field('image_sizing') ?: 'cover';
    $slide_width  = get_sub_field('slide_width') ?: '100';
    $caption      = $image['caption'] ? '<h4 class="responsive-slider-item--caption">'.$image['caption'].'</h4>' : '';

    if ( $image ) :
      $styles[] = 'background-image:url(' . $image['sizes']['xlarge'] . ');';
      $styles[] = 'background-size:'.$image_sizing.';';
    endif;

    $output .= '<div class="responsive-slider-item is-width-'.$slide_width.'" style="padding-left:'.$gutter.'px;padding-right:'.$gutter.'px;">';
      $output .= '<div class="responsive-slider-item--image" style="'.implode('',$styles).'"></div>';
      $output .= $caption;
    $output .= '</div>';

  endwhile;

endif;

?>

<div id="<?= esc_attr($id); ?>" class="<?= esc_attr($className); ?>">

  <div id="responsive-slider--wrapper-<?= $block['id']; ?>" class="responsive-slider--wrapper" data-settings='<?= $settings; ?>'>

    <?= $output; ?>

  </div>

</div>
