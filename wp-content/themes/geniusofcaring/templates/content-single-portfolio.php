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
  $images              = get_field('images');
  $logo_image      = !empty($images['logo']['sizes']['large']) ? $images['logo']['sizes']['large'] : '';
  $logo_image_html = $logo_image ? '<div class="single-portfolio--logo--image fadein inview"><div  style="background-image:url('.$logo_image.');"></div></div>' : '';
  $masthead_image      = !empty($images['masthead']['sizes']['xxlarge']) ? $images['masthead']['sizes']['xxlarge'] : '';
  $masthead_image_html = $masthead_image ? '<div class="single-portfolio--masthead--image fadein inview" style="background-image:url('.$masthead_image.');"></div>' : '';

  // Meta Data
  $meta              = get_field('meta_data');
  $executives             = !empty($meta['executives']) ? nl2br($meta['executives'], false) : '';
  $executives             = !empty($executives ) ? '<p class="single-portfolio--header--executives">' . str_replace('<br>', '<span></span>', $executives ) . '</p>' : '';
  $website             = !empty($meta['website']) ? $meta['website'] : '';
  $website         = !empty($meta['website']) ? '<span class="wp-block-button is-style-outline"><a href="' . $meta['website'] . '" target="_blank" class="wp-block-button__link has-green-400-color has-text-color" target="_blank"><span>Visit Website</span></a></span>' : '';
  $case_study          = !empty($meta['case_study']) ? $meta['case_study'] : '';
  $case_study          = !empty($case_study) ? '<span class="wp-block-button is-style-fill"><a href="' . get_permalink($case_study->ID) . '" class="wp-block-button__link has-white-color has-green-400-background-color has-text-color has-background"><span>Visit Case Study</span></a></span>' : '';

  // Taxonomies
  $industries_arr = [];
  $industries = wp_get_post_terms( $id, 'team_industries' );

  if ( !is_wp_error($industries) ) : foreach ($industries as $industry) :
    $industries_arr[] = $industry->name;
  endforeach; endif;

  $locations_arr = [];
  $locations = wp_get_post_terms( $id, 'team_locations' );

  if ( !is_wp_error($locations) ) : foreach ($locations as $location) :
    $locations_arr[] = $location->name;
  endforeach; endif;

?>

<div class="single-portfolio--masthead">
  <?= $masthead_image_html; ?>
</div>

<div class="wp-block-group has-background has-black-background-color single-portfolio--header">

  <div class="wp-block-group__inner-container">

    <?= $logo_image_html; ?>

    <div class="single-portfolio--header--content">

      <h1>
        <small>Portfolio</small>
        <?= the_title(); ?>
      </h1>

      <?= $executives; ?>

      <p>
        <?= $website; ?>
        <?= $case_study; ?>
      </p>

    </div>

  </div>

</div>

<div class="wp-block-group single-portfolio--content">

  <div class="wp-block-group__inner-container">

    <?= the_content(); ?>

    <div class="single-portfolio--return">

      <p>
        <a class="single-portfolio--content--return" href="/portfolio/<?= $query_string; ?>">Return to Portfolio</a>
      </p>

    </div>

  </div>

</div>

<?php endwhile; endif; ?>
