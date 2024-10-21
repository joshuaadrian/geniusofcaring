<?php

/**
 * accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-block-' . $block['id'];

if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion-block';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$title          = get_field('title');
$content        = get_field('content');

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">

  <p class="accordion--title" itemprop="name">

    <a href="#<?= esc_attr($id); ?>" class="accordion--title-link">

      <?= trim($title); ?>

      <span>
      <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="chevron-down" class="svg-inline--fa fa-chevron-down fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path d="M441.9 167.3l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 328.2 42.9 147.5c-4.7-4.7-12.3-4.7-17 0L6.1 167.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"></path>
      </svg>
      </span>

    </a>

  </p>

  <div class="accordion--content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">

    <div itemprop="text">

      <?= wpautop( do_shortcode( $content ) ); ?>

    </div>

  </div>

</div>
