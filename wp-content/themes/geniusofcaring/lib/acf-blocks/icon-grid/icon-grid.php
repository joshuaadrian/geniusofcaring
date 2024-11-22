<?php

/**
 * icon-grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'icon-grid-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'icon-grid';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$output           = '';
$column_width     = get_field('column_width');
$width            = $column_width ? 'flex-basis:' .$column_width.'%;width:' .$column_width.'%;max-width:' .$column_width.'%;' : '';

if ( have_rows('icon_grid_items') ) :

  while ( have_rows('icon_grid_items') ) : the_row();

    $icon       = get_sub_field('icon');
    $icon       = $icon ? $icon['sizes']['large'] : '';
    $text       = get_sub_field('text');

    $output .= '<div class="icon-grid-item" style="'.$width.'">';
      $output .= $icon ? '<div class="icon-grid-item--icon"><div class="icon-grid-item--icon-inner" style="background-image:url('.$icon.');"></div></div>' : '';
      $output .= $text ? '<div class="icon-grid-item--text">'.wpautop($text).'</div>' : '';
    $output .= '</div>';

  endwhile;

endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?= $containerStyle; ?>">

  <div class="icon-grid-items">

    <?= $output; ?>

  </div>

</div>
