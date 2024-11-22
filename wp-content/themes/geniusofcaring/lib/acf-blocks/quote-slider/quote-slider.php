<?php

/**
 * quote-slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'quote-slider-' . $block['id'];

if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'quote-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$className .= !empty(get_field('style')) ? ' ' . get_field('style') : ' has-no-style';
$output = '';

$settings                    = [];
$transition_speed            = 1500;
$settings['autoPlay']        = false;
$settings['pageDots']        = true;
$settings['fade']            = false;
$settings['prevNextButtons'] = false;
$settings['wrapAround']      = true;
$settings['adaptiveHeight']  = false;
$settings['imagesLoaded']    = true;
$settings['cellAlign']       = 'left';
$settings['groupCells']      = true;
$settings                    = json_encode($settings);

if ( have_rows('slides') ) :

  while ( have_rows('slides') ) : the_row();

    $video_output = '';
    $quote_output = '';
    $quote        = get_sub_field('quote') ? '<blockquote><q>' . get_sub_field('quote') . '</q></blockquote>' : '';
    $citee_name   = get_sub_field('citee_name') ? get_sub_field('citee_name') : '';
    $citee_title  = get_sub_field('citee_title') ? get_sub_field('citee_title') : '';
    $citee        = '<cite class="qs-item--citee"><span>' . $citee_name . '</span>' . $citee_title . '</cite>';
    $citee_image  = get_sub_field('citee_image') ?: '';
    $citee_image  = $citee_image ? '<div class="qs-item--quote--image"><div style="background-image:url(' . $citee_image['sizes']['medium'] . ');"></div></div>' : '';

    $quote_output .= '<div class="qs-item--quote">';
      $quote_output .= $citee_image;
      $quote_output .= '<div class="qs-item--quote--copy">';
        $quote_output .= $quote;
        $quote_output .= $citee;
      $quote_output .= '</div>';
    $quote_output .= '</div>';

    $output .= '<div class="qs-item">';

      $output .= '<div class="qs-item--container">';

        $output .= '<div class="qs-item--content">';

          $output .= $quote_output;

        $output .= '</div>';

      $output .= '</div>';

    $output .= '</div>';

  endwhile;

endif;

?>

<div id="<?= esc_attr($id); ?>" class="<?= esc_attr($className); ?>">

  <div id="quote-slider--wrapper-<?= $block['id']; ?>" class="quote-slider--wrapper" data-settings='<?= $settings; ?>'>

    <?= $output; ?>

  </div>

</div>
