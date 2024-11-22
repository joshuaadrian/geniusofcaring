<?php

global $wp_query, $wpdb;

$sticky_posts__ids = get_option( 'sticky_posts' );
$slug              = $wp_query->queried_object->post_name;
$max_pages         = $wp_query->max_num_pages;
$cur_displaying    = 0;
$cur_page          = get_query_var('paged') ?: 1;
$count             = $wp_query->found_posts;
$counter           = 1;

?>

<div class="masthead is-short-height">

  <div class="masthead--image" style="background-image:url(<?= get_stylesheet_directory_uri(); ?>/dist/images/background-media.jpg);background-size:cover;background-position-x:center;background-position-y:center;"></div>
  
  <div class="masthead--container">

    <div class="masthead--content" style="width:100%;align-content:center;align-items:center;justify-content:left;">
      <div class="masthead--content-inner">
        <h1 class="masthead--title h1 is-secondary-before" style="color:#ffffff;text-align:left;"><span>Media</span></h1>
      </div>
    </div>

  </div>
  
</div>

<?php if ( !empty($sticky_posts__ids ) ) : ?>

<div class="wp-block-group has-gray-100-background-color has-background">

  <div class="wp-block-group__inner-container">

    <h2 class="padding-top-90 margin-top-0 margin-bottom-15 has-text-color has-blue-400-color">Featured Stories</h2>

    <div class="media--featured">

      <?php

      $sticky_posts__query = get_posts([
        'post__in' => $sticky_posts__ids
      ]);

      if ($sticky_posts__query) : foreach($sticky_posts__query as $sticky_post) :

        $id           = $sticky_post->ID;
        $title        = get_the_title($id);
        $item_classes = 'is-sticky-post';
        $item_id      = 'post--item-' . $id;

        $link_text = 'Read More';
        $target    = "_self";

        if ( get_field('pdf', $id) ) :

          $link      = get_field('pdf', $id);
          $link      = $link['url'];
          $target    = "_blank";

        endif;

        if ( get_field('external_url', $id) ) :

          $link      = get_field('external_url', $id);
          $target    = "_blank";

        endif;

      ?>

      <div id="<?= $item_id; ?>" class="media--article <?= $item_classes; ?>">

        <h2 class="media--article--title">
          <a href="<?= get_permalink($id); ?>"><?= $title; ?></a>
        </h2>

        <p><?= get_the_date('F j, Y',$id); ?></p>

      </div>

      <?php

      endforeach; endif;

      ?>
      
    </div>

  </div>

</div>

<?php endif; ?>

<div class="wp-block-group">

  <div class="wp-block-group__inner-container">

    <div class="media--menu">

      <ul>

      <?=

      wp_get_archives([
        'type' => 'yearly',
      ]);

      ?>

      </ul>
      
    </div>

  </div>

</div>

<div class="wp-block-group">

  <div class="wp-block-group__inner-container">

    <div class="media--grid">

      <div class="media--grid--header">
        
        <div>
          <p>Date</p>
        </div>

        <div>
          <p>Title</p>
        </div>

      </div>

      <div class="media--grid--articles">

      <?php

        if ( have_posts() ) : while (have_posts()) : the_post();

          global $post;

          $id            = get_the_id();
          $title         = get_the_title();
          $item_classes  = '';
          $item_classes .= is_sticky() ? ' is-sticky' : ' is-not-sticky';
          $item_tags     = $post->post_name;
          $item_id       = 'media--article-' . $id;

        ?>

        <div id="<?= $item_id; ?>" class="media--article <?= $item_classes; ?>">

          <div class="media--article--date">

            <p>
              <?= get_the_date('F j, Y'); ?>
            </p>

          </div>

          <div class="media--article--title">

            <p>
              <a href="<?= get_permalink($id); ?>"><?= $post->post_title; ?></a>
            </p>

          </div>

        </div>

        <?php $cur_displaying = $cur_displaying + 1; ?>

      <?php endwhile; endif; ?>

        </div>

      </div>

    </div>

    <div class="posts--load--more wp-block-buttons">

      <div class="wp-block-buttons aligncenter is-style-outline">
        <span class="wp-block-button is-style-outline">
          <a href="#" class="posts--load--more-a wp-block-button__link has-blue-400-color has-blue-400-background-color has-text-color has-background" data-next="2">Load More</a>
        </span>
      </div>

      <p class="posts--navigation--current">
        Displaying
        <span class="cur_displaying"><?= $cur_displaying; ?></span>
        of
        <span class="max_count"><?= $count; ?></span>
        Media Articles
      </p>

      <p class="posts--navigation--page-links">
        <span>1</span>
        <a href="#" data-offset="2">2</a>
        <a href="#" data-offset="3">3</a>
        <a href="#" data-offset="4">4</a>
        <a href="#" data-offset="5">5</a>
      </p>

    </div>

  </div>

</div>

<div class="media--footer">

  <div class="wp-block-group">

    <div class="wp-block-group__inner-container">

      <p>For Media Relations, email <a href="mailto:communications@evercore.com">Communications@Evercore.com</a></p>

    </div>

  </div>

</div>

