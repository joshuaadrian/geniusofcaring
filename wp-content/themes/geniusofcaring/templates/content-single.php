<div id="masthead-block_826408495e4ab96f8b6a3a2a2ba4788d" class="masthead is-short-height">

  <div class="masthead--inner">

    <div class="masthead--image" style="background-image:url(<?= get_stylesheet_directory_uri(); ?>/dist/images/Redeye_Hero1.jpg);background-size:cover;background-position-y:bottom;background-position-x:left;"></div>
    
    <div class="masthead--container">

      <div class="masthead--content" style="width:100%;align-content:center;align-items:center;justify-content:left;"><div class="masthead--content-inner"><h1 class="masthead--title h1 is-secondary-before" style="color:#ffffff;text-align:left;"><span>Baggage Claims</span></h1></div></div>
    </div>

  </div>

</div>

<?php

if ( have_posts() ) : while (have_posts()) : the_post();

  $id          = get_the_id();
  $title       = get_the_title();
  $date        = get_the_date('F j, Y');
  $item_id     = 'post--item-' . $id;

  $cats_arr = [];
  $cats = wp_get_post_terms( $id, 'category' );

  if ( !is_wp_error($cats) ) : foreach ($cats as $cat) :
    $cats_arr[] = $cat->name;
  endforeach; endif;

  $cats_html = !empty($cats_arr) ? '<p>' . implode(', ',$cats_arr) . '</p>' : '';

?>

<div class="wp-block-group has-background has-gray-100-background-color padding-top-30 padding-bottom-60 narrower">

  <div class="wp-block-group__inner-container">

    <div class="single-post--container">

      <div class="single-post--meta">
        <p><?= $date; ?></p>
      </div>

      <div class="single-post--content">

        <h1 class="single-post--title h2">
          <?= $title; ?>
        </h1>

        <div class="single-post--copy">
          <?= the_content(); ?>
        </div>

        <div class="single-post--return">
          <p>
            <a href="/baggage-claims/" class="has-orange-400-color has-text-color">Return to Baggage Claims</a>
          </p>
        </div>

      </div>

    </div>

  </div>

</div>

<?php endwhile; endif; ?>

<div class="wp-block-group padding-top-30 padding-bottom-60">

  <div class="wp-block-group__inner-container">

<h2 class="wp-block-heading has-text-align-center margin-top-15" id="stayupdated">Sign Up, Stay Updated.</h2>

<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>

<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>

<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
</div>
</div>