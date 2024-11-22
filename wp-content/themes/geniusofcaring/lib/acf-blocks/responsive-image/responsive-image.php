<?php

/**
 * Responsive Image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'responsive-image-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'responsive-image';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$alignment  = get_field('alignment') ?: 'left';
$height     = get_field('height') ?: 'auto';
$width      = get_field('width') ?: '100%';
$max_width  = get_field('max_width') ?: '100%';
$link       = get_field('link') ?: '';
$link_start = '';
$link_end   = '';
$image      = get_field('image') ?: '';
$image_size = get_field('image_size') ?: 'large';
$caption    = !empty( $image['caption'] ) ? '<div class="responsive-image--caption">' . wpautop($image['caption']) . '</div>' : '';
$alt    = !empty( $image['alt'] ) ? $image['alt'] : '';
$className .= $caption ? ' has-caption' : '';
$className .= ' ' . $alignment;

if ( $image ) :
  $image = $image['sizes'][$image_size];
  $image_html = '<img src="'.$image.'" style="height:'.$height.';width:'.$width.';max-width:'.$max_width.';" alt="'.$alt.'" aria-label="'.$alt.'">';
endif;

if ( $link ) :
  $link_start = '<a href="'.$link['url'].'" target="'.$link['target'].'">';
  $link_end   = '</a>';
endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <?= $link_start; ?>

    <?= $image_html; ?>

    <?= $caption; ?>

  <?= $link_end; ?>

</div>
