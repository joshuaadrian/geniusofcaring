<?php

/**
 * locations-block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'marquee--block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$id = 'marquee--block';

// Create class attribute allowing for custom "className" and "align" values.
$className = 'marquee--block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$copy = get_field('copy');

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div id="marquee--list" class="marquee--list">

    <div class="marquee--item">
      <?= wpautop($copy); ?>
    </div>

    <div class="marquee--item">
      <?= wpautop($copy); ?>
    </div>

    <div class="marquee--item">
      <?= wpautop($copy); ?>
    </div>

  </div>

</div>


