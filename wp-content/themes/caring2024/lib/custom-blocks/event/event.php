<?php

/**
 * event Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'event--block-' . $block['id'];

if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'event--block';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$dates       = get_field('dates');
$start_date  = $dates ? $dates['start'] : '';
$end_date    = $dates ? $dates['end'] : '';
$date        = '';
$location    = get_field('location');
$title       = get_field('title');
$tooltip     = get_field('tooltip');
$button      = '';

if ( substr($start_date, 6) == substr($start_date, 6) ) :
  $date = date('M j-',strtotime($start_date)) . date('j, Y',strtotime($end_date));
else :
  $date = date('M j, Y',strtotime($start_date)) . ' - ' . date('M j, Y',strtotime($end_date));
endif; 

if ( !empty($tooltip) ) :

  $button .= '<div class="event--button"><p class="wp-block-buttons is-style-outline" data-tooltip="'.$tooltip.'"><span class="wp-block-button is-style-outline"><a class="wp-block-button__link has-blue-400-color has-blue-400-background-color has-text-color has-background"><span>Details</span></a></span></p></div>';

endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div class="event--dates">
    <p class="h2"><?= $date; ?>
    <small><?= $location; ?></small></p>
  </div> 

  <h2 class="event--title" itemprop="name">
    <?= trim($title); ?>
  </h2>

  <?= $button; ?>

</div>
