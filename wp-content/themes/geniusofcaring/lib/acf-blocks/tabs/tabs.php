<?php

/**
 * tabs Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tabs-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'tabs-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$links   = '';
$output  = '';
$counter = 1;

if ( have_rows('tabs') ) : while ( have_rows('tabs') ) : the_row();

  $uniqid = uniqid(rand());
  $class  = $counter == 1 ? 'is-showing' : '';
  $title  = get_sub_field('tab_title');
  $icon   = get_sub_field('tab_icon');

  if ( $icon ) :

    $title = '<img src="'.$icon['sizes']['medium'].'" alt="'.$title.'" />';

  endif;

  $anchor = get_sub_field('tab_anchor');

  $links .= '<div class="tabs--link tabs--link-'.$counter.'">';
    $links .= '<a href="#'.$anchor.'">' . $title . '</a>';
  $links .= '</div>';

  $counter = $counter + 1;

endwhile; endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> tabs">

  <div class="tabs--links">

    <?= $links; ?>

  </div>

</div>
