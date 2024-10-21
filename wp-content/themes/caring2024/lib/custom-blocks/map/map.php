<?php

/**
 * locations-block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'map--block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'map--block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$locations_arr = [];

$locations_args = [
  'orderby'     => 'menu_order',
  'post_type'   => 'locations',
  'numberposts' => -1,
  'order'       => 'ASC'
];

$locations_query = get_posts($locations_args);

if ( $locations_query  ) : foreach ( $locations_query  as $location ) :

  $pid     = $location->ID;
  $name    = $location->post_title;
  $image   = get_field('image',$pid);
  $image   = !empty($image) ? $image['sizes']['large'] : get_stylesheet_directory_uri() . '/dist/images/city-popup.jpg';
  $address = get_field('address',$pid);
  $lat     = get_field('latitude',$pid);
  $lng     = get_field('longitude',$pid);
  $classes = '';

  $businesses     = wp_get_post_terms( $pid, 'locations_businesses' );
  $businesses_arr = [];

  if ( !is_wp_error($businesses) ) : foreach ($businesses as $business) :

    if (!empty($get_vars['business']) && $get_vars['business'] == $business->slug) :
      $is_get_var = true;
    endif;

    $classes .= ' ' . $business->slug;
    $businesses_arr[] = $business->name;

  endforeach; endif;

  $types     = wp_get_post_terms( $pid, 'locations_types' );
  $types_arr = [];
  $types_slug = '';

  if ( !is_wp_error($types) ) : foreach ($types as $type) :
    $types_arr[] = $type->name;
    $types_slug = $type->slug;
  endforeach; endif;

  if ( empty( $lat ) || empty( $lng ) ) continue;

  $locations_arr[] = [
    'image'      => $image,
    'name'       => $name,
    'address'    => nl2br(trim($address)),
    'businesses' => implode(', ', $businesses_arr),
    'type'       => $types_slug,
    'lat'        => $lat,
    'lng'        => $lng,
  ];

endforeach; endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <script>
    var locationsJSON = <?= json_encode($locations_arr); ?>;
  </script>

  <div class="map--header">

    <h4>Global Firm</h4>

    <ul class="map--legend">
      <li>Evercore Office</li>
      <li>Strategic Alliance</li>
    </ul>

  </div>

  <div id="map" class="map"></div>

</div>


