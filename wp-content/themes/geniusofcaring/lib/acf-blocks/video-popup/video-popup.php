<?php

/**
 * video-popup Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'video-popup-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'video-popup';
if ( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if ( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$mp4        = get_field('video_mp4') ?: '';
$url        = get_field('video_link') ?: '';
$url        = $mp4 ? $mp4['url'] : $url;
$url        = is_admin() ? '#' : $url;
$image      = get_field('background_image') ?: '';
$title      = get_field('title') ?: '';
$desc       = get_field('description') ?: '';
$image_size = get_field('image_size') ? ' is-' . get_field('image_size') : ' is-square';

$className .= $image_size;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background-image:url('<?= $image['sizes']['large']; ?>');">

  <div class="wp-block-buttons"><div class="wp-block-button is-style-outline"><a href="<?= $url; ?>" class="video-link wp-block-button__link has-white-color has-white-background-color has-text-color has-background wp-element-button"><span>Watch Video</span></a></div></div>

  <?php if ($title || $desc) : ?>

  <div class="video-popup--content">

    <div class="video-popup--content-inner">

      <?php if ($title) : ?>
        <p class="intro"><?= $title; ?></p>
      <?php endif; ?>
      <?php if ($desc) : ?>
        <h2><?= $desc; ?></h2>
      <?php endif; ?>

    </div>

  </div>

  <?php endif; ?>

</div>
