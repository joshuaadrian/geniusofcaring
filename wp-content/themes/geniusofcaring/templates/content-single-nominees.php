<?php

$query_string   = [];
$query_string[] = !empty($_GET['strategy']) ? 'strategy='.htmlspecialchars($_GET['strategy'], ENT_QUOTES) : '';
$query_string[] = !empty($_GET['role']) ? 'role='.htmlspecialchars($_GET['role'], ENT_QUOTES) : '';
$query_string[] = !empty($_GET['office']) ? 'office='.htmlspecialchars($_GET['office'], ENT_QUOTES) : '';
$query_string   = array_filter($query_string);
$query_string   = !empty($query_string) ? '?' . implode('&',$query_string) : '';

if ( have_posts() ) : while (have_posts()) : the_post();

  global $post;

  $id       = get_the_ID();
  $title    = get_field('title',$id) ? '<small class="uppercase">' . get_field('title',$id) . '</small>' : '';

  // Images
  $images     = get_field('images');
  $headshot      = !empty($images['headshot']['sizes']['xlarge']) ? $images['headshot']['sizes']['xlarge'] : '';
  $headshot_html = $headshot ? '<div class="single-team--col-1"><div class="single-team--headshot" style="background-image:url('.$headshot.');"></div></div>' : '';
  $has_headshot = $headshot_html ? true : false;

  // Name
  $name_parts = get_field('name');
  $name       = array();
  $name[]     = !empty($name_parts['first_name']) ? $name_parts['first_name'] : '';
  //$name[]     = !empty($name_parts['nickname']) ? '('.$name_parts['nickname'].')' : '';
  $name[]     = !empty($name_parts['middle_name']) ? $name_parts['middle_name'] : '';
  $name[]     = !empty($name_parts['last_name']) ? $name_parts['last_name'] : '';
  $name[]     = !empty($name_parts['suffix']) ? '<span>,</span> ' . $name_parts['suffix'] : '';
  $name       = implode(' ', array_filter( $name ) );
  $name       = $name ? $name : get_the_title();

  // Meta Data
  $meta              = get_field('meta_data');
  $title_detail_page = !empty($meta['title_detail_page']) ? '<li class="meta-title-detail">' . $meta['title_detail_page'] . '</li>' : '';
  $podcast_links = !empty($meta['podcast_links']) ? $meta['podcast_links'] : '';

  // Taxonomies
  $specialties_arr = [];
  $specialties = wp_get_post_terms( $id, 'team_specialty' );

  if ( !is_wp_error($specialties) ) : foreach ($specialties as $specialty) :
    $specialties_arr[] = $specialty->name;
  endforeach; endif;

  $specialties = !empty($specialties_arr) ? '<li class="meta-specialties">' . implode(', ',$specialties_arr) . '</li>' : '';

  // $businesses_arr = [];
  // $businesses = wp_get_post_terms( $id, 'team_businesses' );

  // if ( !is_wp_error($businesses) ) : foreach ($businesses as $business) :
  //   $businesses_arr[] = $business->name;
  // endforeach; endif;

  // $businesses = !empty($businesses_arr) ? '<li class="meta-businesses">' . implode(', ',$businesses_arr) . '</li>' : '';

  $roles_arr = [];
  $roles_names = [];
  $roles = wp_get_post_terms( $id, 'team_roles' );

  if ( !is_wp_error($roles) ) : foreach ($roles as $role) :
    $roles_arr[] = $role->slug;
    $roles_names[] = $role->name;
  endforeach; endif;

  $roles = !empty($roles_names) ? '<li class="meta-roles">' . implode(', ',$roles_names) . '</li>' : '';
  $path = !empty($roles_arr) ? $roles_arr[0] : '';

  $networks_arr = [];
  $networks = wp_get_post_terms( $id, 'team_networks' );

  if ( !is_wp_error($networks) ) : foreach ($networks as $network) :
    $networks_arr[] = $network->name;
  endforeach; endif;

  $networks = !empty($networks_arr) ? '<li class="meta-networks">' . implode(', ',$networks_arr) . '</li>' : '';

  $locations_arr = [];
  $locations = wp_get_post_terms( $id, 'team_locations' );

  if ( !is_wp_error($locations) ) : foreach ($locations as $location) :
    $locations_arr[] = $location->name;
  endforeach; endif;

  $locations = !empty($locations_arr) ? '<li class="meta-locations">' . implode(', ',$locations_arr) . '</li>' : '';

  $class = empty($video_url) && empty($quote) && empty($past_partnerships) ? ' has-no-content' : '';

?>

<div class="masthead is-short-height">

  <div class="masthead--inner">

    <div class="masthead--image" style="background-image:url(<?= get_stylesheet_directory_uri(); ?>/dist/images/Redeye_Hero1.jpg);background-size:cover;background-position-y:bottom;background-position-x:center;"></div>
    
    <div class="masthead--container">

      <div class="masthead--content" style="width:100%;align-content:center;align-items:center;justify-content:left;"><div class="masthead--content-inner"><h1 class="masthead--title h1 is-secondary-before" style="color:#ffffff;text-align:left;"><span>Nominees</span></h1></div></div>
    </div>

  </div>

</div>

<div class="single-team--wrap">

  <div class="single-team--container <?php if ( !$has_headshot ) : echo 'has-no-headshot'; endif; ?>">

    <?= $headshot_html; ?>

    <div class="single-team--col-2">

      <div class="single-team--bio">

        <h1 class="single-team--name h2">
          <?= $name; ?>
        </h1>

        <ul class="single-team--meta">
          <?= $title_detail_page; ?>
        </ul>

        <?= the_content(); ?>

        <?php

        if ( $podcast_links ) : 

          echo '<p class="single-team--podcast-links"><strong>Podcasts</strong>';

          foreach( $podcast_links as $podcast_link ) :
            echo '<a class="single-team--podcast-link" href="'.$podcast_link['podcast_link']['url'].'" title="'.$podcast_link['podcast_link']['title'].'" target="'.$podcast_link['podcast_link']['target'].'">'.$podcast_link['podcast_link']['title'].'</a>';
          endforeach;

          echo '</p>';

        endif;

        ?>

      </div>

      <div class="single-team--return">

        <div class="wp-block-buttons" style="justify-content:flex-start;">
          <div class="wp-block-button">
            <a href="/nominees/" title="Nominees" target="_self" class="wp-block-button__link">
              <span>Return to Nominees</span>
            </a>
          </div>
        </div>

      </div>

    </div>

  </div>

</div>

<?php endwhile; endif; ?>
