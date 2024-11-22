<?php

/**
 * table Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'table-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'table-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$output = '';

if ( have_rows('table_header') ) :

  $output .= '<thead><tr>';

  while ( have_rows('table_header') ) : the_row();

    $output .= '<th title="' . get_sub_field('header_label') . '">' . get_sub_field('header_label') . '</th>';

  endwhile;

  $output .= '</tr></thead>';

endif;

if ( have_rows('table_rows') ) :

  $output .= '<tbody>';

  while ( have_rows('table_rows') ) : the_row();

    $output .= '<tr>';

    while ( have_rows('row') ) : the_row();

      $output .= '<td title="' . get_sub_field('column_content') . '">' . get_sub_field('column_content') . '</td>';

    endwhile;

    $output .= '</tr>';

  endwhile;

  $output .= '</tbody>';

endif;

$output = '<table class="table">' . $output . '</table>';

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> table-responsive">

  <?= $output; ?>

</div>