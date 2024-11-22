<div class="single-case-studies--masthead"></div>

<?php

if ( have_posts() ) : while (have_posts()) : the_post();

  $id          = get_the_id();
  $title       = get_the_title();
  $date        = get_the_date('F j, Y');
  $item_id     = 'case-studies--item-' . $id;

  $cats_arr = [];
  $cats = wp_get_post_terms( $id, 'category' );

  if ( !is_wp_error($cats) ) : foreach ($cats as $cat) :
    $cats_arr[] = $cat->name;
  endforeach; endif;

  $cats_html = !empty($cats_arr) ? '<p>' . implode(', ',$cats_arr) . '</p>' : '';

?>

<div class="<?= $classes; ?>">

  <div class="wp-block-group narrower">

    <div class="wp-block-group__inner-container">

      <div class="single-case-studies--container">

        <div class="single-case-studies--content">

          <h1 class="single-case-studies--title h3">
            <?= $title; ?>
          </h1>

          <div class="single-case-studies--copy">
            <?= the_content(); ?>
          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<?php endwhile; endif; ?>
