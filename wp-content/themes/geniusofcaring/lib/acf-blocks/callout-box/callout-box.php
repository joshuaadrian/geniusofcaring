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
$id = 'callout-box-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'callout-box';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

// Image Settings
$image = get_field('image_settings');

$className .= !empty($image['image_placement']) ? ' image-placement--'.$image['image_placement'] : ' image-placement--left';
$className .= !empty($image['image_overlay']) ? ' image-overlay--'.$image['image_overlay'] : ' image-overlay--under';
$image__sizing = !empty($image['image_sizing']) ? 'background-size:' . $image['image_sizing'] . ';' : 'background-size:cover;';
$image__width = !empty($image['image_width']) ? 'width:' . $image['image_width'] . '%;' : 'width:50%;';
$image__width = !empty($image['image_overlap']) ? 'width:calc(' . $image['image_width'] . '% + ' . $image['image_overlap'] . 'px);' : $image__width;
$image_y_alignment = !empty($image['image_y_alignment']) ? 'background-position-y:' . $image['image_y_alignment'] . ';' : 'background-position-y:center;';
$image_x_alignment = !empty($image['image_x_alignment']) ? 'background-position-x:' . $image['image_x_alignment'] . ';' : 'background-position-x:center;';
$image__offset_top = !empty($image['image_offset_top']) ? 'margin-top:' . $image['image_offset_top'] . 'px;' : 'margin-top:0;';
$image_html = !empty($image['image']['url']) ? '<div class="callout-box--image inview fadeinslow" style="background-image:url('.$image['image']['url'].');'.$image__sizing.$image__offset_top.$image__width.$image_y_alignment.$image_x_alignment.'"></div>' : '';

// Layout Settings
$layout = get_field('layout_settings');
$layout__padding = '';

if ( !empty($image['image_offset_top']) ) :

  if ( $image['image_offset_top'] > 0 ) :
    $layout__padding = 'padding-bottom:' . $image['image_offset_top'] . 'px';
  else :
    $layout__padding = 'padding-top:' . abs($image['image_offset_top']) . 'px';
  endif;

endif;

$layout__background_color = !empty($layout['background_color']) ? 'background-color:' . $layout['background_color'] . ';' : 'background-color:transparent;';

// Content Settings
$content = get_field('content_settings');

$content__title_logo_mark = !empty($content['title_logo_mark']) ? ' ' . $content['title_logo_mark'] : '';
$content__secondary_title_color     = !empty($content['secondary_title_color']) ? $content['secondary_title_color'] : '#ffffff';
$content__secondary_title_placement = !empty($content['secondary_title_placement']) ? ' is-secondary-' . $content['secondary_title_placement'] : ' is-secondary-before';
$content__secondary_title           = !empty($content['secondary_title']) ? '<small class="callout-box--secondary-title" style="color:'.$content__secondary_title_color.';">'.$content['secondary_title'].'</small>' : '';

$content__title_color = !empty($content['title_color']) ? $content['title_color'] : '#ffffff';
$content__title       = !empty($content['title']) ? '<h3 class="callout-box--title '.$content__title_logo_mark.$content__secondary_title_placement.'" style="color:'.$content__title_color.';">'.$content__secondary_title.'<span>'.nl2br($content['title']).'</span></h3>' : '';

$content__copy_color = !empty($content['copy_color']) ? $content['copy_color'] : '#ffffff';
$content__copy       = !empty($content['copy']) ? '<div class="callout-box--copy" style="color:'.$content__copy_color.';">'.wpautop($content['copy']).'</div>' : '';

$content__buttons = !empty($content['buttons']) ? $content['buttons'] : '';
$buttons          = '';

$content__background_color = !empty($content['background_color']) ? 'background-color:' . $content['background_color'] . ';' : '';
$content__background_color_stretcher = $content__background_color ? '<div class="content--background-color-stretcher" style="'.$content__background_color.'"></div>' : '';
$className .= $content__background_color ? ' has-content-background-color' : ' has-no-content-background-color';

if ( $content__buttons ) : foreach( $content__buttons as $content__button ) :

  $content__button = $content__button['button'];

    if ( !empty($content__button) ) :

      $button_class = empty($content__background_color) || strpos($content__background_color, '#fff') > 0 ? 'has-pink-400-color has-pink-400-background-color' : 'has-white-color has-white-background-color';
      $a_href       = $content__button['url'];
      $a_title      = $content__button['title'];
      $a_target     = !empty( $content__button['target'] ) ? $content__button['target'] : '_self';
      $attributes   = [];
      $attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
      $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
      $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
      $attributes[] = 'class="callout-box--button wp-block-button__link '.$button_class.' has-text-color has-background"';
      $attributes   = implode( ' ', $attributes );
      $buttons     .= '<div class="wp-block-button alignleft is-style-outline"><a ' . $attributes . '>'.$a_title.'</a></div>';

    endif;

  endforeach;

  $content__buttons = '<div class="callout-box--buttons wp-block-buttons is-content-justification-left">'.$buttons.'</div>';

endif;

$content__padding = !empty($layout['padding']) ? 'padding:'.$layout['padding'].'px '. ($layout['padding'] * 3) .'px;' : 'padding:45px;';
$content__width   = 'width:50%;';

if ( !empty($image['image_width']) ) :

  if ( 100 - $image['image_width'] == 0 ) :
    $content__width = 'width:40%;';
  else :
    $content__width = 'width:' . (100 - $image['image_width']) . '%;';
  endif;

endif;

$content_class = $image['image_placement'] == 'left' ? 'fadeinright' : 'fadeinleft';
$content       = '<div class="callout-box--content inview '.$content_class.'" style="'.$content__width.$content__padding.$content__background_color.'"><div class="callout-box--content-inner">'.$content__title.$content__copy.$content__buttons.'</div>'.$content__background_color_stretcher.'</div>';


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

<div id="<?= esc_attr($id); ?>" class="<?= $className; ?>" style="<?= $layout__padding; ?>">

  <div class="callout-box--wrap" style="<?= $layout__background_color; ?>">

    <?= $image_html; ?>

    <div class="callout-box--container">

      <?= $content; ?>

    </div>

  </div>

</div>
