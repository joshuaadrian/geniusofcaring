<?php

global $wp_query, $wpdb;

$slug              = $wp_query->queried_object->post_name;
$max_pages         = $wp_query->max_num_pages;
$cur_displaying    = 0;
$cur_page          = get_query_var('paged') ?: 1;
$count             = $wp_query->found_posts;
$counter           = 1;

?>

<div id="masthead-block_826408495e4ab96f8b6a3a2a2ba4788d" class="masthead is-short-height">

  <div class="masthead--inner">

    <div class="masthead--image" style="background-image:url(<?= get_stylesheet_directory_uri(); ?>/dist/images/Redeye_Hero1.jpg);background-size:cover;background-position-y:bottom;background-position-x:left;"></div>
    
    <div class="masthead--container">

      <div class="masthead--content" style="width:100%;align-content:center;align-items:center;justify-content:left;"><div class="masthead--content-inner"><h1 class="masthead--title h1 is-secondary-before" style="color:#ffffff;text-align:left;"><span>Baggage Claims</span></h1></div></div>
    </div>

  </div>

</div>

<div class="wp-block-group has-background has-gray-100-background-color padding-top-60 md_padding-top-120 padding-bottom-60 md_padding-bottom-120">

  <div class="wp-block-group__inner-container">

    <?php

    $page_for_posts_id = get_option( 'page_for_posts' );
    $page_for_posts_obj = get_post( $page_for_posts_id );
    echo apply_filters( 'the_content', $page_for_posts_obj->post_content );

    ?>

    <div class="media--grid">

      <?php

        if ( have_posts() ) : while (have_posts()) : the_post();

          global $post;

          $id            = get_the_id();
          $title         = get_the_title();
          $item_classes  = '';
          $item_tags     = $post->post_name;
          $item_id       = 'media--article-' . $id;
          $link          = get_permalink($id);
          $link_target   = "_self";

          $cats_arr = [];
          $cats = get_the_category($id);

          if ( $cats ) : foreach( $cats as $cat ) :
            $cats_arr[] = $cat->name;
          endforeach; endif;

          $pdf = get_field('pdf');
          $external_url = get_field('external_url');

          if ( !empty( $pdf ) ) :
            $link = $pdf['url'];
            $link_target   = "_blank";
          endif;

          if ( !empty( $external_url ) ) :
            $link = $external_url;
            $link_target   = "_blank";
          endif;

          $excerpt = get_the_excerpt($id);

        ?>

        <div id="<?= $item_id; ?>" class="media--article <?= $item_classes; ?>">

          <div class="media--article--meta">

            <p>
              <span><?= get_the_date('F j, Y'); ?></span>
            </p>

          </div>

          <div class="media--article--content">

            <p class="media--article--title">
              <a href="<?= $link; ?>" target="<?= $link_target; ?>"><?= $post->post_title; ?></a>
            </p>

            <?php

            if ( !empty( $excerpt ) ) : echo wpautop($excerpt); endif;

            ?>

          </div>

        </div>

        <?php $cur_displaying = $cur_displaying + 1; ?>

      <?php endwhile; endif; ?>

      </div>

    </div>

    <div class="media--pagination">

      <p>

      <?=

      paginate_links([

      ]);

      ?>

      </p>
      
    </div>

  </div>

</div>

<div class="wp-block-group padding-top-30 padding-bottom-60">

  <div class="wp-block-group__inner-container">

<h2 class="wp-block-heading has-text-align-center margin-top-15" id="stayupdated">Sign Up, Stay Updated.</h2>

<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>

<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>

<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
</div>
</div>