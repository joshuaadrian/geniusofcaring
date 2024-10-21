<?php

/**
 * locations-items Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'locations--block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
$className = [];
// Create class attribute allowing for custom "className" and "align" values.
$className[] = 'locations--block';
if( !empty($block['className']) ) {
    $className[] = ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className[] = ' align' . $block['align'];
}

$display_filters = get_field('display_filters') ? get_field('display_filters') : true;

if ( $display_filters ) :

  $cities_dropdown = '';
  $cities = get_terms([
    'taxonomy'   => 'locations_cities',
    'hide_empty' => true,
  ]);

  if ( $cities ) :

    $cities_dropdown = '<option value="">All</option>';

    foreach( $cities as $city ) :

      $active = !empty($get_vars['city']) && $get_vars['city'] == $city->slug ? 'selected' : '';
      $cities_dropdown .= '<option value="'.$city->slug.'" '.$active.'>'.$city->name.'</option>';

    endforeach;

    $cities_dropdown = '<div class="locations--dropdown--wrap"><label for="locations-filter--city">City</label><select aria-label="Select City" id="locations-filter--city" name="locations-filter--city" class="locations--dropdown">'.$cities_dropdown.'</select></div>';

  endif;

  $businesses_dropdown = '';
  $businesses = get_terms([
    'taxonomy'   => 'locations_businesses',
    'hide_empty' => true,
  ]);

  if ( $businesses ) :

    $businesses_dropdown = '<option value="">All</option>';

    foreach( $businesses as $business ) :

      $active = !empty($get_vars['business']) && $get_vars['business'] == $business->slug ? 'selected' : '';
      $businesses_dropdown .= '<option value="'.$business->slug.'" '.$active.'>'.$business->name.'</option>';

    endforeach;

    $businesses_dropdown = '<div class="locations--dropdown--wrap"><label for="locations-filter--business">Business</label><select aria-label="Select business" id="locations-filter--business" name="locations-filter--business" class="locations--dropdown">'.$businesses_dropdown.'</select></div>';

  endif;

endif;

$locations_args = [
  'orderby'     => 'post_title',
  'post_type'   => 'locations',
  'numberposts' => -1,
  'order'       => 'ASC'
];

$locations_query = get_posts($locations_args);

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr(implode(' ', $className ) ); ?>">

  <?php

  if ( $display_filters ) :

    echo '<div class="locations--filters">';

      echo '<h2 class="locations--title intro">Locations</h2>';

      echo '<div class="locations--dropdowns">';

        echo $cities_dropdown;
        echo $businesses_dropdown;

      echo '</div>';

    echo '</div>';

  endif;

  ?>

  <div class="locations--grid">

    <?php

    if ( $locations_query  ) : foreach ( $locations_query  as $location ) :

      $pid     = $location->ID;
      $name    = $location->post_title;
      $address = get_field('address',$pid);
      $phone   = get_field('phone',$pid);
      $classes = '';

      $cities = wp_get_post_terms( $pid, 'locations_cities' );

      if ( !is_wp_error($cities) ) : foreach ($cities as $city) :

        if (!empty($get_vars['city']) && $get_vars['city'] == $city->slug) :
          $is_get_var = true;
        endif;

        $classes .= ' ' . $city->slug;

      endforeach; endif;

      $businesses     = wp_get_post_terms( $pid, 'locations_businesses' );
      $businesses_arr = [];

      if ( !is_wp_error($businesses) ) : foreach ($businesses as $business) :

        if (!empty($get_vars['business']) && $get_vars['business'] == $business->slug) :
          $is_get_var = true;
        endif;

        $classes .= ' ' . $business->slug;
        $businesses_arr[] = $business->name;

      endforeach; endif;

      echo '<div id="locations--item-'.$pid.'" class="locations--item '. $classes .'">';

        echo '<h3 class="locations--item--name">' . $name . '</h3>';
        echo '<p class="locations--item--address">'.nl2br(trim($address)).'</p>';
        echo '<p class="locations--item--phone"><a href="tel:'.$phone.'" target="_blank">'.$phone.'</a></p>';
        echo '<p class="locations--item--businesses">'.implode(', ',$businesses_arr).'</p>';

      echo '</div>';

    endforeach; endif;

    ?>

  </div>

</div>
