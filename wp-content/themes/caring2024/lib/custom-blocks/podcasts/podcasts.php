<?php

/**
 * podcasts Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'podcasts-block-' . $block['id'];

if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'podcasts-block';

if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$podcasts = get_field('podcasts') ?: false;

if ( empty ( $podcasts ) ) :

  $podcasts = get_posts([
    'orderby'          => 'date',
    'posts_per_page'   => -1,
    'order'            => 'DESC',
    'post_type'        => 'podcasts'
  ]);

endif; 

?>

<div id="<?= esc_attr($id); ?>" class="<?= esc_attr($className); ?>">

  <div class="podcasts--grid">

    <?php foreach( $podcasts as $podcast ) : ?>

      <?php

      $id      = $podcast->ID;
      $title   = $podcast->post_title;
      $season  = get_field('season',$id);
      $episode = get_field('episode',$id);
      $episode_name = get_field('episode_name',$id);
      $episode_name = $episode_name ? $episode_name : $title;
      $image   = has_post_thumbnail($id) ? wp_get_attachment_image_src( get_post_thumbnail_id($id), 'large', true ) : '';
      $image   = !empty( $image[0] ) ? 'background-image:url(' . $image[0] . ');' : '';
      $excerpt = has_excerpt($id) ? wpautop(get_the_excerpt($id)) : '';

      ?>

      <div class="podcast">

        <a href="<?= get_permalink($id); ?>" class="podcast--link"></a>
        
        <div class="podcast--image--wrap">
          <div class="podcast--image" style="<?= $image; ?>"></div>
          <img class="podcast--icon" src="<?= get_stylesheet_directory_uri(); ?>/dist/images/icon_podcast.svg" alt="">
        </div>

        <div class="podcast--content">
          
          <p class="podcast--meta">
            <span class="podcast--season">S<?= $season; ?></span>:
            <span class="podcast--episode">E<?= $episode; ?></span>
          </p>

          <p class="podcast--title">
            <?= $episode_name; ?>
          </p>

          <?= $excerpt; ?>

        </div>

      </div>

    <?php endforeach; ?>

  </div>

</div>
