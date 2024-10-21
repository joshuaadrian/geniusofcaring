<?php

/**
 * resource Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'resource--block-' . $block['id'];

if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'resource--block';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$image       = get_field('image');
$title       = get_field('title');
$button      = get_field('button');
$button_html = '';

if ( !empty($image) ) :

  $image = '<img src="'.$image['sizes']['medium'].'" alt="'.$title.'" />';

endif;

if ( !empty($button) ) :

  $a_href       = $button['url'];
  $a_title      = $button['title'];
  $a_target     = !empty( $button['target'] ) ? $button['target'] : '_self';
  $attributes   = [];
  $attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
  $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
  $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
  $attributes[] = 'class="wp-block-button__link has-blue-400-color has-blue-400-background-color has-text-color has-background"';
  $attributes   = implode( ' ', $attributes );
  $button_html .= '<div class="resource--button"><p class="wp-block-buttons is-style-outline"><span class="wp-block-button is-style-outline"><a ' . $attributes . '><span>'.$a_title.'</span></a></span></p></div>';

endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div class="resource--image">
    <?= $image; ?>
  </div> 

  <h2 class="resource--title" itemprop="name">
    <?= trim($title); ?>
  </h2>

  <?= $button_html; ?>

</div>
