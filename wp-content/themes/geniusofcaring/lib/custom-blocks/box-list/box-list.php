<?php

/**
 * box-list Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'box-list--block-' . $block['id'];

if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'box-list--block';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$className .= get_field('box_aspect_ratio') ? ' is-' . get_field('box_aspect_ratio') : ' is-square';

$box_output  = '';
$copy_output = '';

$copy_output .= '<div class="box-list--copy is-showing">';

  $copy_output .= wpautop(get_field('initial_copy'));

$copy_output .= '</div>';


if ( have_rows('boxes') ) :

  while ( have_rows('boxes') ) : the_row();

    $uid       = uniqid();
    $image     = get_sub_field('image');
    $heading   = get_sub_field('heading');
    $copy      = get_sub_field('copy');
    $link      = get_sub_field('link');
    $link_html = '';

    if ( !empty( $link ) ) : 
      $a_href       = $link['url'];
      $a_title      = $link['title'];
      $a_target     = !empty( $link['target'] ) ? $link['target'] : '_self';
      $attributes   = [];
      $attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
      $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
      $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
      $attributes   = implode( ' ', $attributes );
      $link_html   .= '<p><a ' . $attributes . '>'.$a_title.'</a></p>';
    endif;

    $box_output .= '<div class="box-list--box" style="background-image:url('.$image['sizes']['large'].');">';

      $box_output .= '<div class="box-list--box--inner">';
        $box_output .= '<h3><span>'.$heading.'</span></h3>';
        $box_output .= '<div class="box-list--box--content">'.wpautop($copy).$link_html.'</div>';
      $box_output .= '</div>';

    $box_output .= '</div>';

  endwhile;

endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div class="box-list--boxes">
    <?= $box_output; ?>
  </div> 

</div>
