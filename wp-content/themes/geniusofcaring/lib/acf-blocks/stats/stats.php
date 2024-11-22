<?php

/**
 * Masthead Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'stats-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'stats';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$disable_animation_mobile = empty(get_field('disable_animation')) ? 0 : 1;

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div class="stats--inner">

    <?php

    $counter = 1;

    if( have_rows('stat') ):

      // loop through the rows of data
      while ( have_rows('stat') ) : the_row();

        $disable_animation = empty(get_sub_field('disable_animation')) ? 0 : 1;
        $width             = get_sub_field('width') ? 'flex:1 0 calc(' . get_sub_field('width') . ' - 30px);width:calc(' . get_sub_field('width') . ' - 30px);max-width:calc(' . get_sub_field('width') . ' - 30px);' : '';
        $background_color  = get_sub_field('background_color') ? 'background-color:'.get_sub_field('background_color').';' : '';
        $luma              = hexdec(substr(get_sub_field('background_color'),1,2))+hexdec(substr(get_sub_field('background_color'),3,2))+hexdec(substr(get_sub_field('background_color'),5,2)) >  400 ? ' is-light-color' : ' is-dark-color';
        $disable_separator = get_sub_field('disable_separator') ? 1 : 0;
        $prefix            = get_sub_field('statistic_prefix') ? '<span class="stat--prefix">' . get_sub_field('statistic_prefix') . '</span>' : '';
        $prefix_large            = get_sub_field('statistic_prefix_large') ? '<span class="stat--prefix-large">' . get_sub_field('statistic_prefix_large') . '</span>' : '';
        $number            = get_sub_field('statistic_number') ? '<span id="stat-number-'.rand(1, 100000).'" class="stat--number number" data-disable="'.$disable_animation.'" data-disable-mobile="'.$disable_animation_mobile.'" data-endval="' . get_sub_field('statistic_number') . '" data-separator="'. $disable_separator . '">' . get_sub_field('statistic_number') . '</span>' : '';
        $suffix            = get_sub_field('statistic_suffix') ? '<span class="stat--suffix">' . get_sub_field('statistic_suffix') . '</span>' : '';
        $suffix_small      = get_sub_field('statistic_suffix_small') ? '<span class="stat--suffix-small">' . get_sub_field('statistic_suffix_small') . '</span>' : '';
        $footnote              = get_sub_field('statistic_footnote') ? '<small class="stat--footnote">' . get_sub_field('statistic_footnote') . '</small>' : '';
        $text              = get_sub_field('statistic_text') ? '<p class="stat--text">' . get_sub_field('statistic_text') . $footnote . '</p>' : '';

        ?>

        <div class="stat <?= $luma; ?> inview fadein" style="color:inherit;<?= $width; ?><?= $background_color; ?>"><h2><?= $prefix . $prefix_large . $number . $suffix . $suffix_small; ?></h2><?= $text; ?></div>

        <?php $counter++;

      endwhile;

    endif;

    ?>

  </div>

</div>
