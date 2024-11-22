<?php

global $post;

$get_vars = $_GET;

$status_dropdown = '';
$statuses = get_terms([
  'taxonomy'   => 'portfolio_statuses',
  'hide_empty' => true,
]);

if ( $statuses ) :

  $status_dropdown = '<option value="">All</option>';

  foreach( $statuses as $status ) :

    $active = $status->slug == 'active' ? 'selected' : '';

    if ( $get_vars ) :
      $active = in_array($status->slug, $get_vars) ? 'selected' : '';
    endif;

    $status_dropdown .= '<option value="'.$status->slug.'" '.$active.'>'.$status->name.'</option>';

  endforeach;

  $status_dropdown = '<label>Filter by status</label><select aria-label="Select Status" id="portfolio-filter--status" name="portfolio-filter--status" class="portfolio--dropdown">'.$status_dropdown.'</select>';

endif;

$sector_dropdown = '';
$sectors = get_terms([
  'taxonomy'   => 'portfolio_sectors',
  'hide_empty' => true,
]);

if ( $sectors ) :

  $sector_dropdown = '<option value="">All</option>';

  foreach( $sectors as $sector ) :

    $active = in_array($sector->slug, $get_vars) ? 'selected' : '';
    $sector_dropdown .= '<option value="'.$sector->slug.'" '.$active.'>'.$sector->name.'</option>';

  endforeach;

  $sector_dropdown = '<label>Filter by sector</label><select aria-label="Select Sector" id="portfolio-filter--sector" name="portfolio-filter--sector" class="portfolio--dropdown">'.$sector_dropdown.'</select>';

endif;

?>

<div class="masthead is-short-height has-no-text">

  <div class="masthead--image" style="background-image:url(<?= get_stylesheet_directory_uri(); ?>/dist/images/background-portfolio-archive.jpg);background-size:cover;background-position-x:center;background-position-y:top;"></div>

</div>

<div id="all-portfolios" class="wp-block-group portfolio--wrap">

  <div class="wp-block-group__inner-container">

    <div class="portfolio--filters">

      <h1>Investments</h1>

      <div class="portfolio--dropdowns">

        <?= $status_dropdown; ?>
        <?= $sector_dropdown; ?>

      </div>

    </div>

    <div class="portfolio--grid">

      <?php

      if ( have_posts() ) : while (have_posts()) : the_post();

        $id           = get_the_id();
        $title        = get_the_title();
        $item_classes = '';
        $item_tags    = $post->post_name;
        $item_id      = $post->post_name;
        $is_get_var   = false;

        $meta = get_field('meta_data');
        $description = !empty($meta['description']) ? wpautop($meta['description'] . '&nbsp;›') : '';

        $images = get_field('images');
        $logo   = !empty($images['logo']) ? '<img src="'.$images['logo']['sizes']['medium'].'" alt="'.$title.'" />' : '';

        $statuses = wp_get_post_terms( $id, 'portfolio_statuses' );

        if ( !is_wp_error($statuses) ) : foreach ($statuses as $status) :

          if (in_array($status->slug, $get_vars)) :
            $is_get_var = true;
          elseif ( !empty($get_vars['status']) && !in_array($status->slug, $get_vars) ) :
             $item_classes .= ' is-hiding';
          endif;

          $item_classes .= ' ' . $status->slug;

          if ( !$is_get_var && $status->slug != 'active' ) :
            $item_classes .= ' is-hiding';
          endif;

        endforeach; endif;

        $sectors = wp_get_post_terms( $id, 'portfolio_sectors' );

        if ( !is_wp_error($sectors) ) : foreach ($sectors as $sector) :

          if (in_array($sector->slug, $get_vars)) :
            $is_get_var = true;
          elseif ( !empty($get_vars['sector']) && !in_array($sector->slug, $get_vars) ) :
             $item_classes .= ' is-hiding';
          endif;

          $item_classes .= ' ' . $sector->slug;

        endforeach; endif;
 
      ?>

      <div id="<?= $item_id; ?>" class="portfolio--item fadeindown inview <?= $item_classes; ?>">

        <a href="<?= get_permalink(); ?>" class="portfolio--item-link" aria-label="<?= $title; ?>"></a>

        <div class="portfolio--item-logo">

          <div class="portfolio--item-logo-inner">

            <?= $logo; ?>

          </div>

        </div>

        <div class="portfolio--item-content">

          <?= $description; ?>

        </div>

      </div>

    <?php endwhile; endif; ?>

  </div>

</div>
