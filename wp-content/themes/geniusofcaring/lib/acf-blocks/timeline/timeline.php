<?php

/**
 * timeline Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'timeline-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'timeline';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$cur_year       = '';
$cur_switch     = 0;
$cur_align      = ['right','left'];
$timeline_items = [];


$settings        = get_field('timeline_settings');
$settings__order = !empty($settings['order']) ? $settings['order'] : 'desc';

$timeline_items          = get_field('timeline_items');
$timeline__heading_color = !empty($timeline_items['heading_color']) ? $timeline_items['heading_color'] : '#ffffff';
$timeline__copy_color    = !empty($timeline_items['copy_color']) ? $timeline_items['copy_color'] : '#ffffff';
$timeline_item           = $timeline_items['timeline_item'];
$timeline_output         = [];

if ( $timeline_item ) :

  foreach( $timeline_item as $ti ) :

    $ti_output = '';

    $selected_leadership_transactions = $ti['selected_leadership_transactions'];
    $slt_output = '';
    $date    = !empty($ti['date']) ? $ti['date'] . date('his') : date('Ymdhis');
    $year    = substr($date,0,4);
    $heading = !empty($ti['heading']) ? '<h4 style="color:'.$timeline__heading_color.';">' . $ti['heading'] . '</h4>' : '';
    $copy    = !empty($ti['copy']) ? '<span style="color:'.$timeline__copy_color.';">' . wpautop( $ti['copy'] ) . '</span>' : '';
    $logo = !empty($ti['logo']['url']) ? '<img class="timeline-item--logo" src="'.$ti['logo']['url'].'" alt="' . $ti['heading'] . '" />' : '';

    error_log(var_export($selected_leadership_transactions,true));

    if ( $selected_leadership_transactions ) : 

      $slt_output = '<div class="timeline-item--case-studies">';

      foreach( $selected_leadership_transactions as $slt ) :

        //var_dump($slt);

        $images = get_field('images', $slt);
        $logo   = empty($images['logo']) ? '' : $images['logo']['sizes']['medium'];
        $link   = !empty($slt->post_content) ? '<a href="' . get_permalink($slt) . '">Case Study</a>' : '';

        $output = '<div class="timeline-item--case-study">';
          $output .= '<div style="background-image:url('.$logo.');"></div>';
          $output .= $link;
        $output .= '</div>';

        $slt_output .= $output;

      endforeach;

      $slt_output .= '</div>';

    endif;

                    //error_log($selected_leadership_transactions_output);


    $timeline_output[$year][$date] = '<div class="timeline-item inview fadein">' . $heading . $copy . $slt_output . '</div>';

  endforeach;

endif;

if ( $settings__order == 'asc' ) :
  ksort($timeline_output);
else :
  krsort($timeline_output);
endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  
  <div class="timeline--items">

    <?php foreach( $timeline_output as $year => $items ) : ?>

      <?php

      if ( $year != $cur_year ) :

        $cur_year   = $year;
        $cur_switch = ( $cur_switch + 1 ) % 2;

      endif;

      $items = array_reverse($items, true);

      ?>

      <div class="timeline--item-year timeline--item-year-<?= $cur_align[$cur_switch]; ?>">

        <h2 class="inview fadein"><?= $year; ?></h2>

        <div class="timeline--item-year-wrap">

          <?php foreach( $items as $date => $t_item ) : ?>

            <?= $t_item; ?>

          <?php endforeach; ?>

        </div>

      </div>

    <?php endforeach; ?>

  </div>

</div>