<?php

global $post;

$get_vars = $_GET;

$classifications_section_arr = [
  'senior-leadership' => 'is-hiding',
  'all-leadership'    => 'is-hiding'
];

$classifications_arr = [
  'senior-leadership' => [],
  'all-leadership'    => []
];

$role_dropdown = '';
$roles = get_terms([
  'taxonomy'   => 'team_roles',
  'hide_empty' => true,
]);

if ( $roles ) :

  $role_dropdown = '<option value="">All</option>';

  foreach( $roles as $role ) :

    $active = !empty($get_vars['role']) && $get_vars['role'] == $role->slug ? 'selected' : '';
    $role_dropdown .= '<option value="'.$role->slug.'" '.$active.'>'.$role->name.'</option>';

  endforeach;

  $role_dropdown = '<label for="team-filter--role">Filter by Role</label><select aria-label="Select Role" id="team-filter--role" name="team-filter--role" class="team--dropdown">'.$role_dropdown.'</select>';

endif;

$title_dropdown = '';
$titles = get_terms([
  'taxonomy'   => 'team_titles',
  'hide_empty' => true,
]);

if ( $titles ) :

  $title_dropdown = '<option value="">All</option>';

  foreach( $titles as $title ) :

    $active = !empty($get_vars['title']) && $get_vars['title'] == $title->slug ? 'selected' : '';
    $title_dropdown .= '<option value="'.$title->slug.'" '.$active.'>'.$title->name.'</option>';

  endforeach;

  $title_dropdown = '<label for="team-filter--title">Filter by Title</label><select aria-label="Select title" id="team-filter--title" name="team-filter--title" class="team--dropdown">'.$title_dropdown.'</select>';

endif;

$office_dropdown = '';
$offices = get_terms([
  'taxonomy'   => 'team_offices',
  'hide_empty' => true,
]);

if ( $offices ) :

  $office_dropdown = '<option value="">Office</option>';

  foreach( $offices as $office ) :

    $active = !empty($get_vars['office']) && $get_vars['office'] == $office->slug ? 'selected' : '';
    $office_dropdown .= '<option value="'.$office->slug.'" '.$active.'>'.$office->name.'</option>';

  endforeach;

  $office_dropdown = '<label>Filter by role</label><select aria-label="Select Office" id="team-filter--office" name="team-filter--office" class="team--dropdown">'.$office_dropdown.'</select>';

endif;

?>

<div class="masthead is-short-height has-no-text">

  <div class="masthead--image" style="background-image:url(<?= get_stylesheet_directory_uri(); ?>/dist/images/background-team-single.jpg);background-size:cover;background-position-x:center;background-position-y:top;"></div>

</div>

<div id="all-team" class="wp-block-group team--wrap has-background has-blue-100-background-color">

  <div class="wp-block-group__inner-container">

    <div class="team--filters">

      <div class="team--dropdowns">

        <?= $role_dropdown; ?>
        <?= $title_dropdown; ?>

      </div>

      <div class="team--search">
        <input type="text" id="team--search-input" name="team--search-input" value="" placeholder="Search">
      </div>

    </div>

    <div class="team--grid">

      <?php

      if ( have_posts() ) : while (have_posts()) : the_post();

        $id           = get_the_id();
        $title        = get_the_title();
        $item_classes = '';
        $item_tags    = $post->post_name;
        $item_id      = $post->post_name;

        $images     = get_field('images');
        $image      = !empty($images['headshot']['sizes']['large']) ? $images['headshot']['sizes']['large'] : '';
        $name_parts = get_field('name');
        $name       = array();
        $name[]     = !empty($name_parts['first_name']) ? $name_parts['first_name'] : '';
        //$name[]     = !empty($name_parts['nickname']) ? '('.$name_parts['nickname'].')' : '';
        $name[]     = !empty($name_parts['middle_name']) ? $name_parts['middle_name'] : '';
        $name[]     = !empty($name_parts['last_name']) ? $name_parts['last_name'] : '';
        $name[]     = !empty($name_parts['suffix']) ? ', ' . $name_parts['suffix'] : '';
        $name       = implode(' ', array_filter( $name ) );
        $name       = $name ? $name : get_the_title();

        $meta               = get_field('meta_data');
        $title_archive_page = !empty($meta['title_archive_page']) ? '<strong>'.$meta['title_archive_page'].'</strong>' : '';
        $fund_title = '';
        $classification_key = '';
        $is_get_var         = false;
        $is_hiding_fund     = false;

        $titles = wp_get_post_terms( $id, 'team_titles' );

        if ( !is_wp_error($titles) ) : foreach ($titles as $title) :

          if (!empty($get_vars['title']) && $get_vars['title'] == $title->slug) :
            $is_get_var = true;
          endif;

          $item_classes .= ' ' . $title->slug;
        endforeach; endif;

        $roles = wp_get_post_terms( $id, 'team_roles' );
        $roles_arr = [];

        if ( !is_wp_error($roles) ) : foreach ($roles as $role) :

          if (!empty($get_vars['role']) && $get_vars['role'] == $role->slug) :
            $is_get_var = true;
          endif;

          $item_classes .= ' ' . $role->slug;
          $roles_arr[] = $role->name;

        endforeach; endif;

        $offices = wp_get_post_terms( $id, 'team_offices' );

        if ( !is_wp_error($offices) ) : foreach ($offices as $office) :

          if (!empty($get_vars['office']) && $get_vars['office'] == $office->slug) :
            $is_get_var = true;
          endif;

          $item_classes .= ' ' . $office->slug;

        endforeach; endif;

        $classifications = wp_get_post_terms( $id, 'team_classification' );

        if ( !is_wp_error($classifications) ) : foreach ($classifications as $classification) :

          if (!empty($get_vars['classification']) && $get_vars['classification'] == $classification->slug) :
            $is_get_var = true;
          endif;

          if ( in_array($classification->slug,['senior-leadership','senior-leadership','managing-directors']) ) :
            $is_hiding_fund = true;
            $fund_title = '';
          endif;

          $item_classes .= ' ' . $classification->slug;
          $classification_key = $classification->slug;

        endforeach; endif;

        $classification_key = $classification_key ?: 'all-leadership';

        $tags = wp_get_post_terms( $id, 'team_tags' );

        if ( !is_wp_error($tags) ) : foreach ($tags as $tag) :
          $item_tags .= ' ' . $tag->slug;
        endforeach; endif;

        if ( $get_vars && !$is_get_var ) : 
          $item_classes .= ' is-hiding';
        else :
          $classifications_section_arr[$classification_key] = '';
        endif;

        $output = '<div id="' . $item_id . '" class="team--item fadeindown inview ' . $item_classes . '" data-searchtags="' . $item_tags . '">';

          $output .= '<a href="' . get_permalink() . '" title="'. $name . '" class="team--item-link" aria-label="'. $name . '"></a>';

          $output .= '<div class="team--item-image">';
            $output .= '<div class="lazy" data-bg="' . $image . '"></div>';
          $output .= '</div>';

          $output .= '<div class="team--item-content">';

            $output .= '<h4>'. $name . $title_archive_page . $fund_title . '</h4>';

          $output .= '</div>';

        $output .= '</div>';

        $classifications_arr[$classification_key][] = $output;

    endwhile; endif;

    //ksort($classifications_arr['senior-leadership']);

    ?>

    <h3 id="team--item-section__senior-leadership" class="team--item-section <?= $classifications_section_arr['senior-leadership']; ?>">Senior Leadership</h3>
    <?= implode('',$classifications_arr['senior-leadership']); ?>
    <h3 id="team--item-section__all-leadership" class="team--item-section <?= $classifications_section_arr['all-leadership']; ?>">Our Team</h3>
    <?= implode('',$classifications_arr['all-leadership']); ?>

  </div>

</div>
