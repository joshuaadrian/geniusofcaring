<?php

/**
 * nominees-items Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'nominees--block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
$className = [];
// Create class attribute allowing for custom "className" and "align" values.
$className[] = 'nominees--block';
if( !empty($block['className']) ) {
    $className[] = ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className[] = ' align' . $block['align'];
}

$output          = '';
$nominees_args       = [];
$nominees_args['post_type'] = 'nominees';
$nominees_members    = get_field('nominees') ?: false;
$filter_by_role  = get_field('filter_by_role') ?: false;
$filter_roles    = get_field('roles') ?: false;
$grid_classes    = '';
$filtered_term   = '';
$counter         = 1;
$board_priority  = '';

if ( $nominees_members ) :

  $nominees_args['post__in'] = $nominees_members;

else :

  $nominees_args['orderby']          = 'meta_value';
  $nominees_args['meta_key']         = 'name_last_name';
  $nominees_args['posts_per_page']   = -1;
  $nominees_args['order']            = 'ASC';
  $nominees_args['tax_query']        = [];

endif;

if ( !$nominees_members && $filter_by_role && $filter_roles ) :

  $nominees_args['tax_query'][] = [
    'taxonomy' => 'nominees_roles',
    'field'    => 'ID',
    'terms'    => $filter_roles,
  ];

  $term = get_term($filter_roles[0], 'nominees_roles');
  $filtered_term = $term->slug;
  $grid_classes .= $term->slug;

endif;

//error_log(var_export($nominees_args, true));

$nominees_query = new WP_Query($nominees_args);

//error_log(var_export($nominees_query, true));

while ( $nominees_query->have_posts() ) :
  
  global $post;
  $nominees_query->the_post();

  $pid         = get_the_ID();
  $images     = get_field('images',$pid);
  $image      = !empty($images['headshot']['sizes']['large']) ? $images['headshot']['sizes']['large'] : '';
  $image_html = $image ? '<div class="nominees--item--image"><div  style="background-image:url('.$image.');"></div></div>' : '';

  // Name
  $name_parts = get_field('name',$pid);
  $name       = array();
  $name[]     = !empty($name_parts['first_name']) ? $name_parts['first_name'] : '';
  $name[]     = !empty($name_parts['middle_name']) ? $name_parts['middle_name'] : '';
  $name[]     = !empty($name_parts['last_name']) ? $name_parts['last_name'] : '';
  $name[]     = !empty($name_parts['suffix']) ? ', ' . $name_parts['suffix'] : '';
  $name       = implode(' ', array_filter( $name ) );
  $name       = $name ? $name : get_the_title($pid);

  $item_classes = '';

  $meta  = get_field('meta_data',$pid);
  $title = !empty($meta['title_archive_page']) ? '<small>'.$meta['title_archive_page'].'</small>' : '';

  $roles     = wp_get_post_terms( $pid, 'nominees_roles' );
  $roles_arr = [];

  if ( !is_wp_error($roles) ) : foreach ($roles as $role) :

    if (!empty($get_vars['role']) && $get_vars['role'] == $role->slug) :
      $is_get_var = true;
    endif;

    $item_classes .= ' ' . $role->slug;
    $roles_arr[] = $role->name;

  endforeach; endif;

  $output .= '<div id="nominees--item-'.$pid.'" class="nominees--item '. $item_classes .'">';

    $output .= '<a class="nominees--item--link" href="'.get_permalink($pid).'" aria-label="'. $name . '" title="'. $name . '"></a>';
    $output .= $image_html;
    $output .= '<p class="nominees--item--name">' . $name.$title . '</p>';

  $output .= '</div>';

endwhile;

wp_reset_query();
wp_reset_postdata();

?>
<div id="<?= esc_attr($id); ?>" class="<?= esc_attr(implode(' ', $className ) ); ?>">

  <div class="nominees--grid">

      <?= $output; ?>

      <!-- <div class="nominees--item nominees--item--view-all"><p><a href="/nominees">Our Nominees</a></p></div> -->

  </div>

</div>
