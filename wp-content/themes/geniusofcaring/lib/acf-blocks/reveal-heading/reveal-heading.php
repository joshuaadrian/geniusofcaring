<?php

/**
 * reveal-heading Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
global $post;

// Create id attribute allowing for custom "anchor" value.
$id = 'reveal-heading-block-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'reveal-heading-block';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$output  = '';
$heading = get_field('heading') ? get_field('heading') : '';
$size    = get_field('size') ? get_field('size') : '';
$background_color    = get_field('background_color') ? get_field('background_color') : '';
$foreground_color    = get_field('foreground_color') ? get_field('foreground_color') : '';
$type    = get_field('type') ? get_field('type') : 'color-change';

// Layout Settings

$output .= '<' . $size . ' class="reveal-heading" data-type="'.$type.'" data-type="fade-in" data-fg-color="'.$foreground_color.'" data-bg-color="'.$background_color.'">' . $heading.'</' . $size . '>';

?>

<div id="<?= esc_attr($id); ?>" class="<?= $className; ?>">

  <?= $output; ?>

</div>
