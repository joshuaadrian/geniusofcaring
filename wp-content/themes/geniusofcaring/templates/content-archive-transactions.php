<?php

global $wp_query, $wpdb;

$max_pages         = $wp_query->max_num_pages;
$cur_displaying    = 0;
$cur_page          = get_query_var('paged') ?: 1;
$count             = $wp_query->found_posts;
$counter           = 1;

$carousel_query = get_posts([
  'post_type'   => 'transactions',
  'numberposts' => -1,
  'paged'       => false,
  'orderby'     => 'date',
  'order'       => 'DESC',
  'meta_query'  => [
    [
      'key'     => 'add_to_carousel',
      'value'   => 'yes',
      'compare' => 'LIKE'
    ]
  ]
]);

//error_log(var_export($carousel_query,true));

?>

<div class="masthead is-short-height">

  <div class="masthead--image" style="background-image:url(<?= get_stylesheet_directory_uri(); ?>/dist/images/background-transaction.jpg);background-size:cover;background-position-x:center;background-position-y:center;"></div>
  
  <div class="masthead--container">

    <div class="masthead--content" style="width:100%;align-content:center;align-items:center;justify-content:left;">
      <p class="masthead--breadcrumb">Our Businesses &amp; Capabilities</p>
      <div class="masthead--content-inner">
        <h1 class="masthead--title h1 is-secondary-before" style="color:#ffffff;text-align:left;"><span>Our Transactions</span></h1>
      </div>
    </div>

  </div>
  
</div>

<?php if ( !empty( $carousel_query ) ) : ?>

<div class="wp-block-group has-gray-100-background-color has-background">

  <div class="wp-block-group__inner-container">

    <h2 class="padding-top-90 margin-top-0 margin-bottom-15 has-text-color has-blue-400-color">Leadership across the largest and most complex situations</h2>

    <?php

    $settings                    = [];
    $transition_speed            = get_field('transition_speed') ?: 1500;
    $settings['autoPlay']        = false;
    $settings['pageDots']        = false;
    $settings['fade']            = false;
    $settings['prevNextButtons'] = true;
    $settings['wrapAround']      = true;
    $settings['adaptiveHeight']  = false;
    $settings['imagesLoaded']    = true;
    $settings['cellAlign']       = 'left';
    $settings['groupCells']      = false;
    $settings                    = json_encode($settings);

    ?>

    <div id="transactions--carousel" class="transactions--carousel" data-settings='<?= $settings; ?>'>

      <?php

      if ($carousel_query) : foreach($carousel_query as $carousel) :

        $id           = $carousel->ID;
        $title        = get_the_title($id);
        $item_classes = 'is-carousel-transaction';
        $item_id      = 'post--item-' . $id;

        $images     = get_field('images', $id);
        $image      = !empty($images['logo']['sizes']['large']) ? '<img class="transactions--carousel--item--logo" src="' . $images['logo']['sizes']['large'] . '" />' : '';

        $meta = get_field('meta_data', $id);
        $description = $meta['description'];

        $roles     = wp_get_post_terms( $id, 'transactions_roles' );
        $roles_arr = [];

        if ( !is_wp_error($roles) ) : foreach ($roles as $role) :
          $roles_arr[] = $role->name;
        endforeach; endif;

       

      ?>

      <div id="<?= $item_id; ?>" class="transactions--carousel--item <?= $item_classes; ?>">

        <div class="transactions--carousel--item--inner">

        <p class="transactions--carousel--item--role"><?= implode(', ',$roles_arr); ?></p>

        <?= $image; ?>

        <div class="transactions--carousel--item--description">
          <?= wpautop($description); ?>
        </div>

        <p class="transactions--carousel--item--date"><?= get_the_date('Y',$id); ?></p>

        </div>

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

    <div class="transactions--menu">

      <ul>

      <?=

      wp_get_archives([
        'type' => 'yearly',
        'post_type' => 'transactions'
      ]);

      ?>

      </ul>
      
    </div>

  </div>

</div>

<div class="wp-block-group">

  <div class="wp-block-group__inner-container">

    <div class="transactions--grid">

      <div class="transactions--grid--header">
        
        <div>
          <p>Anouncement Date<sup>1</sup></p>
        </div>

        <div>
          <p>Status</p>
        </div>

        <div>
          <p>Title</p>
        </div>

        <div>
          <p><sup>*</sup>Value(M)</p>
        </div>

      </div>

      <div class="transactions--grid--articles">

      <?php

        if ( have_posts() ) : while (have_posts()) : the_post();

          global $post;

          $id            = get_the_id();
          $title         = get_the_title();
          $item_classes  = '';
          $item_classes .= is_sticky() ? ' is-sticky' : ' is-not-sticky';
          $item_tags     = $post->post_name;
          $item_id       = 'transactions--article-' . $id;

          $meta  = get_field('meta_data', $id);
          $value = $meta['value'];

          $statuses     = wp_get_post_terms( $id, 'transactions_statuses' );
          $statuses_arr = [];

          if ( !is_wp_error($statuses) ) : foreach ($statuses as $status) :
            $statuses_arr[] = $status->name;
          endforeach; endif;

        ?>

        <div id="<?= $item_id; ?>" class="transactions--article <?= $item_classes; ?>">

          <div class="transactions--article--date">

            <p data-label="Date:">
              <?= get_the_date('F j, Y'); ?>
            </p>

          </div>

          <div class="transactions--article--status">

            <p data-label="Status:">
              <?= $statuses_arr[0]; ?>
            </p>

          </div>

          <div class="transactions--article--title">

            <p data-label="Title:">
              <?= $post->post_title; ?>
            </p>

          </div>

          <div class="transactions--article--value">

            <p data-label="Value:">
              <?= $value; ?>
            </p>

          </div>

        </div>

        <?php $cur_displaying = $cur_displaying + 1; ?>

      <?php endwhile; endif; ?>

        </div>

      </div>

    </div>

    <div class="transactions--legal">

      <p><small><sup>1</sup>Announcement date for M&A transactions represents the date publicly announced; announcement date for restructurings represents the date publicly announced or filed; announcement date for capital markets transactions represents the pricing date.</small></p>

    </div>

    <div class="transactions--pagination">

      <p>

      <?=

      paginate_links([

      ]);

      ?>

      </p>
      
    </div>
    
  </div>

</div>

