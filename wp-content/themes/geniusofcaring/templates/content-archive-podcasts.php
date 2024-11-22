<?php

global $post;

$podcasts_page = get_page_by_path( 'podcasts' );

if ( $podcasts_page ) :

  $podcasts_content_id = get_page( $podcasts_page );
  echo do_shortcode(do_blocks(do_shortcode($podcasts_content_id->post_content)));

endif;

?>

<div class="wp-block-group podcasts--wrap">

  <div class="wp-block-group__inner-container">

    <div class="podcasts--grid">

      <?php

        if ( have_posts() ) : while (have_posts()) : the_post();

          global $post;

          $id            = get_the_id();
          $title         = get_the_title();
          $item_classes  = '';
          $item_tags     = $post->post_name;
          $item_id       = 'podcast-' . $id;
          $link          = get_permalink($id);
          $link_target   = "_self";
          $season        = get_field('season');
          $episode       = get_field('episode');

        ?>

        <div id="<?= $item_id; ?>" class="podcast <?= $item_classes; ?>">

          <div class="podcast--meta">

            <p>
              <span><?= get_the_date('F j, Y'); ?></span>
            </p>

          </div>

          <div class="podcast--content">

            <p class="podcast--title">
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

</div>
