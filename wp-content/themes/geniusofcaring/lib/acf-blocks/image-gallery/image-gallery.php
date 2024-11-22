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
$id = 'image-gallery--' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'image-gallery';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$className .= get_field('wrap_onto_multiple_rows') ? ' is-wrapping' : '';

$output = '';
$styles = [];
$containerClass = '';
$containerStyle = '';

$image_grid_items_shape   = get_field('image_grid_items_shape') ?: 'square';
$image_grid_items_spacing = get_field('spacing') ? 'padding: ' . ( get_field('spacing') / 2 ) . 'px;'  : '';
$image_grid_items_width   = get_field('width_of_image_grid_items') ? get_field('width_of_image_grid_items') . '%;' : '';

if ( have_rows('image_grid_item') ) :

  if ( $image_grid_items_width ) :
    $styles[] = 'width:'.$image_grid_items_width.'flex-basis:'.$image_grid_items_width;
  else :
    $width = 100 / count(get_field('image_grid_item'));
    $styles[] = 'width:'.$width.'%;flex-basis:'.$width.'%;';
  endif;

  if ( $image_grid_items_spacing ) :
    $styles[] = $image_grid_items_spacing;
    $containerStyle = 'margin-left:-'.(get_field('spacing') / 2 ).'px;margin-right:-'.(get_field('spacing') / 2 ).'px;';
  endif;

  $image_spacer = '<img src="'.get_stylesheet_directory_uri().'/dist/images/spacers/spacer-square.png">';

  if ( $image_grid_items_shape == 'landscape' ) :
    $image_spacer = '<img src="'.get_stylesheet_directory_uri().'/dist/images/spacers/spacer-landscape.png">';
  elseif ( $image_grid_items_shape == 'portrait' ) :
    $image_spacer = '<img src="'.get_stylesheet_directory_uri().'/dist/images/spacers/spacer-portrait.png">';
  endif;

  while ( have_rows('image_grid_item') ) : the_row();

    $image     = get_sub_field('image_grid_image');
    $image_style = get_sub_field('image_style') ? 'background-size:'.get_sub_field('image_style').';' : 'background-size:contain;';
    
    if ( $image ) :
      $image = 'background-image:url(' . $image['sizes']['large'] . ');';
    endif;

    $output .= '<div class="image-gallery--item" style="'.implode('',$styles).'">';
      $output .= '<div class="image-gallery--item--inner"><div style="'.$image.$image_style.'"></div>';
        $output .= $image_spacer;
      $output .= '</div>';
    $output .= '</div>';

  endwhile;

endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?= $containerStyle; ?>">

  <div class="image-gallery--grid">

    <?= $output; ?>

  </div>

</div>