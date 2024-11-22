<?php

/**
 * content-box Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'content-box-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'content-box';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$styles                  = [];
$classes                 = [];
$lead_in                 = get_field('lead_in') ?  '<small>' . get_field('lead_in') . '</small>' : '';
$title                   = get_field('title') ? '<h1 class="content-box--title">' . $lead_in . get_field('title') . '</h1>' : '';
$copy                    = get_field('copy') ? wpautop( get_field('copy') ) : '';
$button                  = get_field('button') ?: '';
$background_image        = get_field('background_image') ?: '';
$mobile_background_image = get_field('mobile_background_image') ?: '';
$classes[]               = get_field('text_location') ?: '';
$classes[]               = get_field('text_style') ?: '';
$classes[]               = get_field('logo_mark') ?: '';
$classes[]               = get_field('display_blue_gradient') ? 'is-showing-blue-gradient' : '';
$classes[]               = get_field('display_blue_background') ? 'is-showing-blue-background' : '';
$classes[]               = get_field('display_blue_v') ? 'is-showing-blue-v' : '';
$classes[]               = get_field('padding_size') ?: '';
$className              .= ' ' . implode(' ', $classes);

$mobile_image = '';

if ( $mobile_background_image ) :
  $mobile_background_image = $mobile_background_image['sizes']['xlarge'];
  $mobile_image = 'background-image:url('.$mobile_background_image.');';
endif;

$image = '';

if ( $background_image ) :
  $background_image = $background_image['sizes']['xlarge'];
  $image = 'background-image:url('.$background_image.');';
endif;

$buttons = '';

if ( have_rows('buttons') ) : while ( have_rows('buttons') ) : the_row();

  $button = get_sub_field('button');

  if ( !empty($button) ) :

    $a_href       = $button['url'];
    $a_title      = $button['title'];
    $a_target     = !empty( $button['target'] ) ? $button['target'] : '_self';
    $attributes   = [];
    $attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
    $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
    $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
    $attributes[] = 'class="content-box--button-link wp-block-button__link has-orange-400-color has-orange-400-background-color has-text-color has-background"';
    $attributes   = implode( ' ', $attributes );
    $buttons     .= '<div class="wp-block-button"><a ' . $attributes . '><span>'.$a_title.'</span></a></div>';

  endif;

endwhile; endif;

$buttons = $buttons ? '<p class="content-box--buttons">' . $buttons . '</p>' : '';

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div class="content-box--image" style="<?= $image; ?>" data-mobile-image="<?= $mobile_image; ?>" data-desktop-image="<?= $image; ?>"></div>

  <div class="content-box--inner">

    <div class="content-box--content">

      <div class="content-box--content-inner">

        <div class="fadein inview"><?= $title . $copy . $buttons; ?></div>

      </div>

    </div>

  </div>

</div>
