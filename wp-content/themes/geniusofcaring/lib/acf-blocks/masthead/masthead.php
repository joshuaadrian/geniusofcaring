<?php

/**
 * Masthead Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
global $post;

// Create id attribute allowing for custom "anchor" value.
$id = 'masthead-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'masthead';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

// Layout Settings
$layout = get_field('layout_settings');

$className .= !empty($layout['height']) ? ' is-'.$layout['height'].'-height' : '';
$layout__arrow = !empty($layout['display_advance_arrow']) ? '<a class="masthead--advance-arrow"><svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M441.9 167.3l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 328.2 42.9 147.5c-4.7-4.7-12.3-4.7-17 0L6.1 167.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"></path></svg>
</a>' : '';

// Content Settings
$content = get_field('content_settings');

$content__secondary_title_color = !empty($content['secondary_title_color']) ? $content['secondary_title_color'] : '#ffffff';
$content__secondary_title_placement = !empty($content['secondary_title_placement']) ? ' is-secondary-' . $content['secondary_title_placement'] : ' is-secondary-before';
$content__secondary_title = !empty($content['secondary_title']) ? '<small class="masthead--secondary-title sans" style="color:'.$content__secondary_title_color.';">'.$content['secondary_title'].'</small>' : '';

$content__title_size = !empty($content['title_size']) ? $content['title_size'] : 'h1';
$content__title_color = !empty($content['title_color']) ? $content['title_color'] : '#ffffff';
$content__title_alignment = !empty($content['title_alignment']) ? $content['title_alignment'] : 'left';
$content__title = !empty($content['title']) ? '<h1 class="masthead--title '.$content__title_size.$content__secondary_title_placement.'" style="color:'.$content__title_color.';text-align:'.$content__title_alignment.';">'.$content__secondary_title.'<span>'.nl2br($content['title']).'</span></h1>' : '';

$content__copy_color = !empty($content['copy_color']) ? $content['copy_color'] : '#ffffff';
$content__copy_alignment = !empty($content['copy_alignment']) ? $content['copy_alignment'] : 'left';
$content__copy = !empty($content['copy']) ? '<div class="masthead--copy" style="color:'.$content__copy_color.';text-align:'.$content__copy_alignment.';">'.wpautop($content['copy']).'</div>' : '';

$content__buttons = !empty($content['buttons']) ? $content['buttons'] : '';
$content__buttons_alignment = !empty($content['buttons_alignment']) ? $content['buttons_alignment'] : '';
$buttons  = '';
$content__breadcrumb = !empty($content['breadcrumb']) ? '<p class="masthead--breadcrumb">' . $content['breadcrumb'] . '</p>' : '';
$className .= !$content__title && !$content__copy && !$content__secondary_title && !$content__buttons ? ' has-no-text' : '';

if ( $content__buttons ) : foreach( $content__buttons as $content__button ) :

  $content__button = $content__button['button'];

    if ( !empty($content__button) ) :

      $a_href       = $content__button['url'];
      $a_title      = $content__button['title'];
      $a_target     = !empty( $content__button['target'] ) ? $content__button['target'] : '_self';
      $attributes   = [];
      $attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
      $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
      $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
      $attributes[] = 'class="masthead--button wp-block-button__link"';
      $attributes   = implode( ' ', $attributes );
      $buttons     .= '<span class="wp-block-button is-style-fill"><a ' . $attributes . '><span>'.$a_title.'</span></a></span>';

    endif;

  endforeach;

  $content__buttons = '<p class="masthead--buttons wp-block-buttons is-style-outline" style="justify-content:'.$content__buttons_alignment.';">'.$buttons.'</p>';

endif;

$content__vertical_alignment = !empty($content['content_vertical_alignment']) ? 'align-content:'.$content['content_vertical_alignment'].';align-items:'.$content['content_vertical_alignment'].';' : '';
$content__horizontal_alignment = !empty($content['content_horizontal_alignment']) ? 'justify-content:'.$content['content_horizontal_alignment'].';' : '';
$content__width = !empty($content['content_width']) ? 'width:'.$content['content_width'].'%;' : '';
$content = '<div class="masthead--content" style="'.$content__width.$content__vertical_alignment.$content__horizontal_alignment.'">' . $content__breadcrumb . '<div class="masthead--content-inner">'.$content__title.$content__copy.$content__buttons.'</div></div>';

// Background Settings
$background = get_field('background_settings');

$background__color = !empty($background['background_color']) ? 'background-color:'.$background['background_color'].';' : '';
$background__image_sizing = !empty($background['image_sizing']) ? 'background-size:' . $background['image_sizing'] . ';' : '';
$background__vertical_alignment = !empty($background['image_vertical_alignment']) ? 'background-position-y:' . $background['image_vertical_alignment'] . ';' : '';
$background__horizontal_alignment = !empty($background['image_horizontal_alignment']) ? 'background-position-x:' . $background['image_horizontal_alignment'] . ';' : '';
$background__image = !empty($background['image']['url']) ? '<div class="masthead--image" style="background-image:url('.$background['image']['url'].');'.$background__image_sizing.$background__vertical_alignment.$background__horizontal_alignment.$background__color.'"></div>' : '';

$background__video_mp4 = !empty($background['video_mp4']) ? '<div class="masthead--video"><video class="inview fadein" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" loop muted><source src="'.$background['video_mp4']['url'].'" type="video/mp4"></video></div>' : '';

$background__overlay_color = !empty($background['overlay_color']) ? $background['overlay_color'] : '';
$background__overlay_opacity = !empty($background['overlay_opacity']) ?: '';
$background__overlay = $background__overlay_color && $background__overlay_opacity ? '<div class="masthead--overlay" style="background-color:'.$background__overlay_color.';opacity:'.($background['overlay_opacity'] / 100).';"></div>' : '';
//
// if ( $palette ) :
//
//   foreach ($palette as $p_color) :
//
//     if ( strtoupper($color) == strtoupper($p_color['color']) ) :
//       $className .= ' is-' . $p_color['slug'];
//       $button_classes = ' has-' . $p_color['slug'] . '-color has-text-color';
//       $is_palette_color = true;
//     endif;
//
//   endforeach;
//
// endif;
//
// if ( !$is_palette_color ) :
//   $color_style = 'style="color:' . $color . '"';
//   $button_style = 'style="color:' . $color . ';border-color:'.$color.';"';
// endif;
//


?>

<div id="<?= esc_attr($id); ?>" class="<?= $className; ?>">

  <div class="masthead--inner">

    <?= $background__video_mp4.$background__image.$background__overlay; ?>

    <?php if ($content__title) : ?>

    <div class="masthead--container">

      <?= $content; ?>

    </div>

    <?php endif; ?>

    <?php if (is_front_page()) : ?>

    <!-- <div class="masthead--motto"><p><span>Client Focus</span><span class="bullet">&bull;</span><span>Integrity</span><span class="bullet">&bull;</span><span>Excellence</span><span class="bullet">&bull;</span><span>Respect</span><span class="bullet">&bull;</span><span>Diversity, Equity and Inclusion</span><span class="bullet">&bull;</span><span>Investment in People</span><span class="bullet">&bull;</span><span>Partnership</span></p></div> -->

    <?php endif; ?>

    <?= $layout__arrow; ?>

  </div>

</div>
