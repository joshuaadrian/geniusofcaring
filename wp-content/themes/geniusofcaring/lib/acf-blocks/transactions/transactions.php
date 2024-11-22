<?php

/**
 * team-items Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'transactions-' . $block['id'];

if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

$className   = [];
$className[] = 'transactions--block';

if( !empty($block['className']) ) {
  $className[] = ' ' . $block['className'];
}

if( !empty($block['align']) ) {
  $className[] = ' align' . $block['align'];
}

$filters = '';

$posts = get_posts([
  'post_type'      => 'transactions',
  'order'          => 'DESC',
  'orderby'        => 'meta_order',
  'posts_per_page' => 5
]);

$settings                    = [];
$transition_speed            = get_field('transition_speed') ?: 1500;
$settings['autoPlay']        = false;
$settings['pageDots']        = true;
$settings['prevNextButtons'] = false;
$settings['wrapAround']      = true;
$settings['adaptiveHeight']  = false;
$settings['imagesLoaded']    = true;
$settings['cellAlign']       = 'left';
$settings['groupCells']      = true;
$settings                    = json_encode($settings);

$post_items = '';
$counter    = 1;

if ( $posts ) : foreach ( $posts as $p ) :

  $id = $p->ID;

  $classes   = '';
  $roles     = wp_get_post_terms( $id, 'transactions_roles' );
  $roles_arr = [];

  if ( !is_wp_error($roles) ) : foreach ($roles as $role) :
    $roles_arr[] = $role->name;
  endforeach; endif;

  $images   = get_field('images', $id);
  $logo     = !empty($images['logo']) ? $images['logo']['sizes']['large'] : '';
  $meta     = get_field('meta_data', $id);
  $value    = !empty($meta['value']) ? $meta['value'] : 'N/A';

  $post_items .= '<div class="transactions--slide '.$classes.'">';

    $post_items .= $logo ? '<img class="transactions--slide--logo" src="'.$logo.'" />' : '';

    $post_items .= '<ul class="transactions--slide--meta">';

      $post_items .= '<li>'.implode(', ', $roles_arr).'</li>';
      $post_items .= '<li>'.$value.'</li>';

    $post_items .= '</ul>';

    // $post_items .= '<p class="transactions--slide--more wp-block-buttons is-style-outline">';
    //   $post_items .= '<span class="wp-block-button is-style-outline"><a class="wp-block-button__link has-blue-300-color has-blue-300-background-color has-text-color has-background" href="'.get_permalink($id).'"><span>Learn More</span></a></span>';
    // $post_items .= '<p>';

  $post_items .= '</div>';

endforeach; endif;

?>

<div id="<?= $id; ?>" class="<?= implode(' ',$className); ?>">

  <h3 class="transactions--headline intro">Featured Transactions</h3>

  <a href="/our-business-and-capabilities/investment-banking/our-transactions/" class="transactions--all">View All</a>

  <div id="transactions--slider-<?= $block['id']; ?>" class="transactions--slider" data-settings='<?= $settings; ?>'>

    <?= $post_items; ?>

  </div>

</div>
